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

class CategoryController extends Controller
{
	/*TODO

		Featured Articles
		Required fields on forms
		Sort by category
	*/


 	
 	public function readCategories(){
 		$categories = Categories::all();

 		return view('readCategories', array('categories' => $categories));
 	}


 	public function createCategory(){
 		DB::table('Categories')->insert(array(
 			'Name' => $_POST['name'], 
 			'dateCreated' => date('Y-m-d')
 		));

 		$categories = Categories::all();

 		return view('readCategories', array('categories' => $categories));
 	}

 	public function updateCategory($categoryID){
 		DB::table('Categories')->where('id', $categoryID)->update(array(
 			'Name' => $_POST['name'],
 			'lastUpdated' => date('Y-m-d') 
 		));

 		$categories = Categories::all();
 		return view('readCategories', array('categories' => $categories));
 	}


 	public function deleteCategory($categoryID){
 		Categories::where('ID', $categoryID)->delete();
 		$articlesWithCat = ArticleData::where('CategoryIDs', '=', $categoryID)
 					->orWhere('CategoryIDs', 'like', '%,'.$categoryID.',%')
 					->orWhere('CategoryIDs', 'like', $categoryID.',%')
 					->orWhere('CategoryIDs', 'like', '%,'.$categoryID)
 					->get();

 		self::__removeCategoryFromArticles($articlesWithCat, $categoryID);


 		$categories = Categories::all();

 		return view('readCategories', array('categories' => $categories));
 	}

 	public function __removeCategoryFromArticles($articlesWithCat, $categoryID){

 		foreach($articlesWithCat as $article){
 			$catIDArr = explode(",",$article->CategoryIDs);
 			$curatedCatIDArr = array_diff($catIDArr, array($categoryID));

 			DB::table('ArticleData')->where('ID', $article->ID)->update(['CategoryIDs' => implode(',',$curatedCatIDArr)]);
 		}
 	}
}

