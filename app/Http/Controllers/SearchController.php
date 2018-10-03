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

class SearchController extends Controller
{

	public function search(){

		if(!empty($_POST)){

			if(empty($_POST['Title']) && empty($_POST['category']) && empty($_POST['dateCreated'])){
				$articles = array();
			}else{

				$articles = DB::table('Articles as a')
		         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
		            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
		            ->select('a.*', 
		            	DB::raw('group_concat(c.Name) as categoryNames'), 
		            	DB::raw('group_concat(c.ID) as categoryIds'))
		            ->where('a.deleted', 0)
		            ->orderBy('dateCreated', 'DESC')
		           	->groupBy('a.ID');

		        if(!empty($_POST['Title'])){
	        		$articles->where('a.Title', 'like', '%'.$_POST['Title'].'%');	
		        }

		        if(!empty($_POST['category'])){
		        	$articles->having('categoryNames', 'like', '%'.$_POST['category'].'%');	
		        }

		        if(!empty($_POST['dateCreated'])){
		        	$articles->where('a.dateCreated', '>=', $_POST['dateCreated']);	
		        }

		        $articles = $articles->get();

		        //dd($articles);

		        //die();
		   }

	       return view('readArticles')->with(array('articles' => $articles, 'searchTerm' => $_POST['Title'], 'sorted' => array(false)));
		}


		$categories = Categories::where('deleted','0')->get();

		return view('search')->with(array('categories' => $categories));
	}



}

