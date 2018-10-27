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

use App\Traits\CreateFolderHierarchy;

class SortController extends Controller
{

	use CreateFolderHierarchy;

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

		return view('dashboard')->with(array('articles' => $articles, 'sorted' => array(true, $param, $dir)));
 	}

 	public function sortCategories($param, $dir){
 		
 		$categories = Categories::orderBy($param, $dir)->where('deleted', 0)->get();
 			
		return view('readCategories')->with(array('categories' => $categories, 'sorted' => array(true, $param, $dir)));
 	}

 	public function sortFolders($param, $dir){
 		
 		$folders = DB::table('Folders')->orderBy($param, $dir)->get();
 		//dd($folders);
 		$folderz = clone $folders;
 		$folderHierarchy = $this->__createFolderHierarchy($folders);
 			
 		
 			
		return view('readFolders')->with(array('folders' => $folderz, 'folderHierarchy' => $folderHierarchy, 'sorted' => array(true, $param, $dir)));
 	}

}

