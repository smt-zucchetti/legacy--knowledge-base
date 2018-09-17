<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Articles;
use App\Categories;
use App\Articles_Categories;

class CategoryController extends Controller
{
	/*TODO

		Featured Articles
		Required fields on forms
		Auto fill pop up update forms
	*/

	/* BUG
		after create, update, and delete, the view returned is not sortable
	*/

 	
	public function createCategory(){
 		DB::table('Categories')->insert(array(
 			'Name' => $_POST['name'], 
 			'dateCreated' => date('Y-m-d H:i:s')
 		));

 		return self::readCategories();
 	}

 	public function readCategories(){
 		if (Auth::user()){
 			return view('readCategories', array('categories' => Categories::orderBy('dateCreated', 'DESC')->get() ));
 		}else{
 			return view('home');
 		}
 	}

 	public function updateCategory($categoryID){
 		DB::table('Categories')
 		->where('id', $categoryID)
 		->update(array(
 			'Name' => $_POST['name'],
 			'lastUpdated' => date('Y-m-d H:i:s') 
 		));

 		return self::readCategories();
 		//return view('readCategories', array('categories' => Categories::all()));
 	}

 	public function deleteCategory($categoryId){
 		Categories::where('ID', $categoryId)->delete();
 		Articles_Categories::where('categoryId', $categoryId)->delete();

 		return self::readCategories();
 		//return view('readCategories', array('categories' => Categories::all()));
 	}

 	public function sortCategories($param, $dir){
 		

 		$categories = Categories::orderBy($param, $dir)->get();
 			

		return view('readCategories')->with(array('categories' => $categories, 'sort' => 'sorted'));
 	}
}

