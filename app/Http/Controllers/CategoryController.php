<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Article;
use App\Category;
use App\Article_Category;
use App\Traits\SortResults;

class CategoryController extends Controller
{

	use SortResults;

 	
	public function createCategory(){

 		DB::table('Category')->insert(array(
 			'Name' 			=> $_POST['name'], 
 			'dateCreated' 	=> date('Y-m-d H:i:s'),
 			'createdBy'		=> Auth::user()->id
 		));

 		return self::readCategories();
 	}

 	public function readCategories($param = null, $dir = null){
 		if (Auth::user()){

 			$categories = DB::table('Category')->where('deleted','=',false)->orderBy('dateCreated', 'DESC')->get();

 			$categories = $this->sortResults($categories, $param, $dir);

 			return view('readCategories', ['categories' => $categories]);

 		}else{
 			return view('authLandingPage');
 		}
 	}

 	public function updateCategory($categoryID){
 		DB::table('Category')
	 		->where('id', $categoryID)
	 		->update(array(
	 			'Name' 			=> $_POST['name'],
	 			'lastUpdated' 	=> date('Y-m-d H:i:s'),
	 			'lastUpdatedBy'	=> Auth::user()->id
 		));

 		return self::readCategories();
 	}

 	public function deleteCategory($categoryId){
 		DB::table('Category')
	 		->where('id', $categoryId)
	 		->update(array(
				'deleted'		=> true,	
	 			'lastUpdatedBy'	=> Auth::user()->id
 		));

 		return self::readCategories();
 	}

 	
}

