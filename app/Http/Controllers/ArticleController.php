<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;

use App\ArticleData;
use App\Categories;

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

	 		 $CategoryIDs = !empty($_POST['CategoryIDs'])?implode(($_POST['CategoryIDs']), ","):"";

			DB::table('ArticleData')->insert(array(
				'Title' => $_POST['title'], 
				'Content' => $_POST['content'], 
				'textOnlyContent' => $_POST['textOnlyContent'], 
				'CategoryIDs' => $CategoryIDs, 
				'dateCreated'	=> date('Y-m-d')
			) );

			$articles = ArticleData::all();
			$articlesWithCats = self::__mergeArticleCatIdsWithCats($articles);

			return view('readArticles')->with(array('articles' => $articlesWithCats));
		}
 	}   

 	public function updateArticle($articleId){

 		if(empty($_POST)){
	 		$article = ArticleData::where('ID', $articleId)->first();
			$categories = Categories::all(); 		

			return view('updateArticle')->with(array('article' => $article, 'categories' => $categories)); 
		}else{

			$CategoryIDs = !empty($_POST['CategoryIDs'])?implode($_POST['CategoryIDs'],","):"";

	 		DB::table('ArticleData')->where('id', $articleId)->update(array(
	 			'Title' => $_POST['title'], 
	 			'Content' => $_POST['content'], 
	 			'textOnlyContent' => $_POST['textOnlyContent'], 
	 			'CategoryIDs' => $CategoryIDs,
	 			'lastUpdated'	=> date('Y-m-d')  
	 		));

	 		$articles = ArticleData::all();
	 		$articlesWithCats = self::__mergeArticleCatIdsWithCats($articles);

			return view('readArticles')->with(array('articles' => $articlesWithCats));
		}
 	}


 	public function readArticles(){
		$articles = ArticleData::all();
		$articlesWithCats = self::__mergeArticleCatIdsWithCats($articles);

		return view('readArticles')->with(array('articles' => $articlesWithCats));
 	}

 	public function sortArticles(){
		$articles = ArticleData::all()->sortBy('Title');
		$articlesWithCats = self::__mergeArticleCatIdsWithCats($articles);

		return view('readArticles')->with(array('articles' => $articlesWithCats, 'sort' => 'sorted'));
 	}

 	public function readArticle($articleId){

 		$article = DB::table('ArticleData')->where('ID', $articleId)->first();

 		return view('readArticle')->with(array('article' => $article));
 	}


 	public function __mergeArticleCatIdsWithCats($articles){

		foreach($articles as $key => $article){

			$CatIdArr = !empty($article->CategoryIDs)?explode(',', $article->CategoryIDs):NULL;
			
			$catArr = [];
			if(!empty($CatIdArr)){
				foreach ($CatIdArr as $catId) {				 
					$category = Categories::where('ID', $catId)->first();
					$catArr[] = array('id' => $category['ID'], 'name' => $category['Name']);
				}
			}
			$articles[$key]['CategoryArr']  = $catArr;

		}

		return $articles;
 	}



 	public function deleteArticle($articleId){

 		ArticleData::where('ID', $articleId)->delete();

		$articles = ArticleData::all();
		$articlesWithCats = self::__mergeArticleCatIdsWithCats($articles);

 		return view('readArticles')->with(array('articles' => $articlesWithCats));
 	}


}

