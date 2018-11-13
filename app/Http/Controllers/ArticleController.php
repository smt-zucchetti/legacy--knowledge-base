<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Articles;
use App\Categories;
use App\Articles_Categories;
use App\Folders;
use App\Traits\RelateFolders;
use App\Traits\SortResults;

class ArticleController extends Controller
{

	use RelateFolders;
	use SortResults;

 	public function createArticle(Request $request){
 		if(empty($_POST)){
	 		$categories = DB::table('Categories')->where('deleted', '=', '0')->get();

	 		$folders = $this->getFolders();
	 		$this->__relateFolders($folders);

	 		return view('createArticle', ['categories' => $categories, 'folderTree' => $folders]);
	 	}else{

	 		$validatedData = $request->validate([
		        'title' => 'required|unique:Articles',
		        'content' => 'required',
		    ]);

			$articleId = DB::table('Articles')->insertGetId([
				'Title' 			=> $_POST['title'], 
				'featured'			=> !empty($_POST['featured'])?$_POST['featured']:0,
	 			'folderId'			=> !empty($_POST['parentId'])?$_POST['parentId']:null,
				'Content' 			=> $_POST['content'], 
				'textOnlyContent' 	=> $_POST['textOnlyContent'],  
				'dateCreated'		=> date('Y-m-d: H:i:s'),
				'createdBy' 		=> Auth::user()->id,
			]);

			if(isset($_POST['categoryIds'])){
				foreach($_POST['categoryIds'] as $categoryId){
					DB::table('Articles_Categories')->insert([
						'articleId' => $articleId, 
						'categoryId' => $categoryId			
					]);			
				}
			}

			return self::homePage();
		}
 	}   

 	public function sortArticles($param, $dir, $srchTrm = null){

	 	$articles = self::__getAllArticles($param, $dir, $srchTrm);

	 	return view('partials/articleList')->with(['articles' => $articles]);

 	}

 	public function __getAllArticles($param = null, $dir = null, $srchTrm = null){

 		$articles = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', function($leftJoin){
	            	$leftJoin->on('c.ID', '=', 'a_c.categoryId');
	            	$leftJoin->where('c.deleted', 0);
	            })
	            ->select('a.*', 
	            			DB::raw('group_concat(c.Name) as categoryNames'), 
	            			DB::raw('group_concat(c.ID) as categoryIds')
	            	)
	            ->where('a.deleted', 0)
	            ->when($srchTrm !== null, function($query) use($srchTrm){
	            	$query->where(function($query2) use($srchTrm){
	            		$query2->where('a.Title', 'like', '%'.$srchTrm.'%');
                		$query2->orWhere('a.textOnlyContent', 'like', '%'.$srchTrm.'%');
	            	});
	            })
	            ->orderBy('dateCreated', 'DESC')
	           	->groupBy('a.ID')
	            ->get();

	    $articles = $this->SortResults($articles, $param, $dir);

	    /*foreach($articles as $key => $article){
	    	$catNamesArr = !empty($article->categoryNames)?explode(",", $article->categoryNames):[];
	    	//$catIdsArr = !empty($article->categoryIds)?explode(",", $article->categoryIds):[];

	    	$catArr = [];
	    	for($i=0; $i<count($catNamesArr); $i++){
	    		$catArr[] = $catNamesArr[$i];
	    	}

	    	$article->categories = $catArr;
	    	unset($articles[$key]->categoryNames);
	    	unset($articles[$key]->categoryIds);
	    }*/

	    return $articles;
 	}

 	public function homePage(){

 		$articles = self::__getAllArticles();
 	
	    $featuredArticles = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	            ->groupBy('a.ID')
	            ->where('a.deleted', '=', false)
	            ->where('a.featured', '=', 1)
	            ->orderBy('dateCreated', 'DESC')
	            ->get();
	    $featuredArticles->sortBy('dateCreated');

		return view('homePage')->with(['articles' => $articles, 'featuredArticles' => $featuredArticles]);
 	}

 	public function searchArticles(){

 		$articles = self::__getAllArticles(null, null, $_GET['search']);

 		return view('homePage')->with(['articles' => $articles, 'srchTrm' => $_GET['search']]);
 	}

 
	public function readArticleTree($curFolderId = null){

		$folders = $this->getFolders();
	    $this->__relateFolders($folders, false);

		return view('readArticlesWrapper')->with(['folders' => $folders, 'curFolderId' => $curFolderId, 'type' => 'tree']);
 	} 	

 	public function articleList(){

 		$articles = self::__getAllArticles();

		return view('readArticlesWrapper')->with(['articles' => $articles, 'type' => 'list']);
 	}

 	public function readArticleGUI($curFolderId = null){
 	
		$results = self::__getArticleGUI($curFolderId);

		$pathArr = self::__getFolderPath($curFolderId);

		return view('readArticlesWrapper')->with(['results' => $results, 'curFolderId' => $curFolderId, 'pathArr' => $pathArr, 'type' => 'GUI']);
 	}

 	public function __getFolderPath($curFolderId){
 		
 		$pathArr = array();

 		while($curFolderId !== null){
	 		$folder = DB::table('Folders as f')
	 				->select('id', 'parentId', 'name')
	 				->where('id', '=', $curFolderId)
	 				->first();
	 		
	 		$curFolderId = $folder->parentId;

	 		$pathArr[] = ['name' => $folder->name, 'id' => $folder->id];
	 	}

	 	return array_reverse($pathArr);

 	}

 	public function __getArticleGUI($parentFolderId = null){

 		$articles = DB::table('Articles as a')
	            ->select('a.Title', 'a.ID')
	            ->where('a.folderId', '=', $parentFolderId)
	            ->where('a.deleted', '=', 0)
	            ->orderBy('a.ID')
	           	->get();
	           	
	    $folders = DB::table('Folders as f')
	            ->where('f.parentId', '=', $parentFolderId)
	           	->orderBy('f.id', 'DESC')
	           	->get();

	    return ['articles' => $articles, 'folders' => $folders];
 	}

 	public function __getArticle($articleId){

 		$result = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'a_c.categoryId', '=','c.ID')
				->leftJoin('Folders as f', 'f.id', '=', 'a.folderId')
	            ->select('a.*', 'f.name as parentFolder',
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	            ->where('a.ID', '=', $articleId)
	           	->groupBy('a.ID')
	            ->first();

	    return $result;
 	}

 	public function readArticle($articleId){

 		$article = self::__getArticle($articleId);

	    return view('readArticle')->with(['article' => $article]);
 	}

 	public function updateArticle(Request $request, $articleId){
 		if(empty($_POST)){

	 		$article = self::__getArticle($articleId);
	        $categories = DB::table('Categories')->where('deleted', 0)->get();
	        
	        $folders = $this->getFolders();
	        $curFolder = $this->getFolderById($folders, $article->folderId);
	        $this->__relateFolders($folders);


			return view('updateArticle')->with(['article' => $article, 'categories' => $categories, 'folderTree' => $folders,'curFolder' => $curFolder]);

		}else{

			$validatedData = $request->validate([
		        'title' => 'required|unique:Articles,ID,$articleId',
		        'content' => 'required',
		    ]);

	 		DB::table('Articles')->where('id', $articleId)->update([
	 			'Title' 			=> $_POST['title'], 
	 			'featured'			=> !empty($_POST['featured'])?$_POST['featured']:0,
	 			'folderId'			=> !empty($_POST['parentId'])?$_POST['parentId']:null,
	 			'Content' 			=> $_POST['content'], 
	 			'textOnlyContent' 	=> $_POST['textOnlyContent'], 
	 			'lastUpdated'		=> date('Y-m-d'),
	 			'lastUpdatedBy' 	=> Auth::user()->id 
	 		]);

	 		Articles_Categories::where('articleId', $articleId)->delete();
	 		if(isset($_POST['categoryIds'])){
	 			foreach($_POST['categoryIds'] as $categoryId){
		 			Articles_Categories::insert(
		 				['articleId' => $articleId, 'categoryId' => $categoryId]
					);
		 		}
	 		}

	 		return self::homePage();
		}
 	}

 	public function deleteArticle($articleId){

 		DB::table('Articles')->where('id', $articleId)->update(array(
 			'lastUpdatedBy' 	=> Auth::user()->id,
 			'deleted' => true 
 		));

		$articles = Articles::all();
		
		return self::homePage();
 	}

 	public function fullPageArticle($articleId){
 		$article = DB::table('Articles')->where('ID', $articleId)->first();

 		return view('fullPageArticle')->with(array('article' => $article));
 	}

}

