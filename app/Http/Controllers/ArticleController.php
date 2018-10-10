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

class ArticleController extends Controller
{


 	public function createArticle(Request $request){
 		if(empty($_POST)){
	 		$categories = Categories::all();

	 		 return view('createArticle', array('categories' => $categories));
	 	}else{


	 		$validatedData = $request->validate([
		        'title' => 'required|unique:Articles',
		        'content' => 'required',
		    ]);

			$articleId = DB::table('Articles')->insert(array(
				'Title' 			=> $_POST['title'], 
				'Content' 			=> $_POST['content'], 
				'textOnlyContent' 	=> $_POST['textOnlyContent'],  
				'dateCreated'		=> date('Y-m-d: H:i:s'),
				'createdBy' 		=> Auth::user()->id,
				'featured'			=> !empty($_POST['featured'])?$_POST['featured']:0
			) );

			foreach(!empty($_POST['CategoryIDs'])?$_POST['CategoryIDs']:array() as $categoryId){
				DB::table('Articles_Categories')->insert(array(
					'articleId' => $articleId, 
					'categoryId' => $categoryId			
				));			
			}

			return self::readArticles();
		}
 	}   

 	public function __getAllArticles(){

 		$results = DB::table('Articles as a')
		 		->leftJoin('Folders as f', 'f.id', '=', 'a.folderId')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
	            ->select(array(
	            			'a.*', 
	            			'f.name as folderName',
	            			'f.id as folderId',
	            			DB::raw('group_concat(c.Name) as categoryNames'), 
	            			DB::raw('group_concat(c.ID) as categoryIds')
	            	))
	            ->where('a.deleted', '=', false)
	            ->orderBy('dateCreated', 'DESC')
	           	->groupBy('a.ID')
	            ->get();

	    return $results;
 	}

 	public function readAllArticles(){

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

		return view('readAllArticles')->with(array('articles' => $articles, 'featuredArticles' => $featuredArticles, 'sorted' => array(false)));
 	}

 	public function __getFolderPath($curFolderId){
 		
 		$pathArr = array();

 		while($curFolderId !== null){
	 		$folder = DB::table('Folders as f')
	 				->select('id', 'parentId', 'name')
	 				->where('id', '=', $curFolderId)
	 				->first();
	 		
	 		$curFolderId = $folder->parentId;

	 		$pathArr[] = array('name' => $folder->name, 'id' => $folder->id);
	 	}

	 	return array_reverse($pathArr);

 	}

 	public function readArticleGUI($curFolderId = null){
 	
		$folders = self::__getArticleGUI($curFolderId);

		$pathArr = self::__getFolderPath($curFolderId);

		//dd($pathArr);

		return view('readArticleGUI')->with(array('folders' => $folders, 'curFolderId' => $curFolderId, 'pathArr' => $pathArr) );
 	}


 	public function __getArticleTree(){
 		return array();
 	}

	public function readArticleTree($curFolderId = null){
 	
		$folders = self::__getArticleTree();

		return view('readArticlesWrapper')->with(array('folders' => $folders, 'curFolderId' => $curFolderId, 'type' => 'articleTree') );
 	} 	


 	public function __getArticleGUI($parentFolderId = null){

 		$results = DB::table('Folders as f')
		 		->leftJoin('Articles as a', 'f.id', '=', 'a.folderId')
	            ->select(array(
			            	'f.name as folderName','f.id as folderId',       			
	            			DB::raw('group_concat(a.Title) as articleTitles'), 
	            			DB::raw('group_concat(a.ID) as articleIds')
	            		))
	            ->where('f.parentId', '=', $parentFolderId)
	            /*->where(function($query) use($parentFolderId){
		            $query->where('a.folderId', '=', $parentFolderId)
		            ->orWhere('f.parentId', '=', $parentFolderId);
		        })*/
		        //->where('a.deleted', '=', false)
	            ->orderBy('f.id', 'DESC')
	           	->groupBy('f.name','f.id')
	            ->get();
	           	//->toSql();

	            //dd($results);

	    return $results;
 	}

 	public function __getArticle($articleId){

 		$result = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'a_c.categoryId', '=','c.ID')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	            ->where('a.ID', '=', $articleId)
	           	->groupBy('a.ID')
	            ->first();

	    return $result;
 	}

 	public function readArticle($articleId){

 		$article = self::__getArticle($articleId);

	    return view('readArticle')->with(array('article' => $article));
 	}

 	public function updateArticle(Request $request, $articleId){

 		if(empty($_POST)){

	 		$article = self::__getArticle($articleId);

	        $categories = Categories::all();

	        $folders = Folders::all();

			return view('updateArticle')->with(array('article' => $article, 'categories' => $categories, 'folders' => $folders));

		}else{

			$validatedData = $request->validate([
		        'title' => 'required|unique:Articles,ID,$articleId',
		        'content' => 'required',
		    ]);

	 		DB::table('Articles')->where('id', $articleId)->update(array(
	 			'Title' 			=> $_POST['title'], 
	 			'featured'			=> !empty($_POST['featured'])?$_POST['featured']:0,
	 			'folderId'			=> !empty($_POST['folderId'])?$_POST['folderId']:null,
	 			'Content' 			=> $_POST['content'], 
	 			'textOnlyContent' 	=> $_POST['textOnlyContent'], 
	 			'lastUpdated'		=> date('Y-m-d'),
	 			'lastUpdatedBy' 	=> Auth::user()->id 
	 		));

	 		Articles_Categories::where('articleId', $articleId)->delete();
	 		foreach(!empty($_POST['CategoryIDs'])?$_POST['CategoryIDs']:array() as $categoryId){
	 			Articles_Categories::insert(
	 				['articleId' => $articleId, 'categoryId' => $categoryId]
				);
	 		}

	 		return self::readAllArticles();
		}
 	}

 	public function deleteArticle($articleId){

 		DB::table('Articles')->where('id', $articleId)->update(array(
 			'lastUpdatedBy' 	=> Auth::user()->id,
 			'deleted' => true 
 		));

		$articles = Articles::all();
		
		return self::readArticles();
 	}



 	public function sortArticles($param, $dir, $searchTerm = null){

 		if(empty($searchTerm)){
	 		$articles = DB::table('Articles as a')
		         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
		            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
		            ->select('a.*', 
		            	DB::raw('group_concat(c.Name) as categoryNames'), 
		            	DB::raw('group_concat(c.ID) as categoryIds'))
		        	->where('a.deleted', 0)
		           	->groupBy('a.ID')
		           	->orderBy($param, $dir)
		            ->get();
		 }else{
		 	
		 	$articles = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	            ->where('a.deleted', 0)
	            ->where(function($query) use($searchTerm){
	            	$query->where('a.Title', 'like', '%'.$searchTerm.'%')
                	->orWhere('a.textOnlyContent', 'like', '%'.$searchTerm.'%');
	            })
	            ->orderBy($param, $dir)
	           	->groupBy('a.ID')
	            ->get();
		 }

		return view('readArticles')->with(array('articles' => $articles, 'sorted' => array(true, $param, $dir)));
 	}

 	public function sortArticles2($param, $dir, $searchTerm = null){
 		die('1234');
 	}

 	public function fullPageArticle($articleId){
 		$article = DB::table('Articles')->where('ID', $articleId)->first();

 		return view('fullPageArticle')->with(array('article' => $article));
 	}

 	public function searchArticles(){

 		$articles = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	            ->where('a.deleted', 0)
	            ->where(function($query){
	            	$query->where('a.Title', 'like', '%'.$_POST['search'].'%')
                	->orWhere('a.textOnlyContent', 'like', '%'.$_POST['search'].'%');	
	            })
	            ->orderBy('dateCreated', 'DESC')
	           	->groupBy('a.ID')
	            ->get();

        return view('readArticles')->with(array('articles' => $articles, 'searchTerm' => $_POST['search'], 'sorted' => array(false)));
 	}

}

