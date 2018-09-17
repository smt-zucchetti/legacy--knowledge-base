<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;

use App\Articles;
use App\Categories;
use App\Articles_Categories;

class ArticleController extends Controller
{
	/*TODO

		Featured Articles
		Required fields on forms
		Sort by category
	*/


 	public function createArticle(){
 		if(empty($_POST)){
	 		$categories = Categories::all();

	 		 return view('createArticle', array('categories' => $categories));
	 	}else{
	 		//print_r($_POST);
	 		//die();

			$articleId = DB::table('Articles')->insert(array(
				'Title' => $_POST['title'], 
				'Content' => $_POST['content'], 
				'textOnlyContent' => $_POST['textOnlyContent'],  
				'dateCreated'	=> date('Y-m-d: H:i:s')
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

 	public function readArticles(){
 	
		$articles = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	            ->orderBy('dateCreated', 'DESC')
	           	->groupBy('a.ID')
	            ->get();
	    $articles->sortBy('dateCreated');

		return view('readArticles')->with(array('articles' => $articles));
 	}

 	public function readArticle($articleId){

 		$article = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'a_c.categoryId', '=','c.ID')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	            ->where('a.ID', '=', $articleId)
	           	->groupBy('a.ID')
	            ->first();

	    return view('readArticle')->with(array('article' => $article));
 	}

 	public function updateArticle($articleId){

 		if(empty($_POST)){

	 		$article = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	            ->where('a.ID', '=', $articleId)
	           	->groupBy('a.ID')
	            ->first();

	        $categories = Categories::all();

			return view('updateArticle')->with(array('article' => $article, 'categories' => $categories));

		}else{

	 		DB::table('Articles')->where('id', $articleId)->update(array(
	 			'Title' => $_POST['title'], 
	 			'Content' => $_POST['content'], 
	 			'textOnlyContent' => $_POST['textOnlyContent'], 
	 			'lastUpdated'	=> date('Y-m-d')  
	 		));

	 		Articles_Categories::where('articleId', $articleId)->delete();
	 		foreach(!empty($_POST['CategoryIDs'])?$_POST['CategoryIDs']:array() as $categoryId){
	 			Articles_Categories::insert(
	 				['articleId' => $articleId, 'categoryId' => $categoryId]
				);
	 		}

	 		return self::readArticles();
		}
 	}

 	public function deleteArticle($articleId){

 		Articles::where('ID', $articleId)->delete();
 		Articles_Categories::where('articleId', $articleId)->delete();

		$articles = Articles::all();
		
		return self::readArticles();
 	}



 	public function sortArticles($param, $dir){
 		

 		$articles = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))
	           	->groupBy('a.ID')
	           	->orderBy($param, $dir)
	            ->get();

		return view('readArticles')->with(array('articles' => $articles, 'sort' => 'sorted'));
 	}

}

