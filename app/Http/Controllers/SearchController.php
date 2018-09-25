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

class SearchController extends Controller
{
	/*TODO

		Featured Articles
		Required fields on forms
		Sort by category
	*/


 	public function searchArticles(){

 		$articles = DB::table('Articles as a')
	         	->leftJoin('Articles_Categories as a_c', 'a.ID', '=', 'a_c.articleId')
	            ->leftJoin('Categories as c', 'c.ID', '=', 'a_c.categoryId')
	            ->select('a.*', 
	            	DB::raw('group_concat(c.Name) as categoryNames'), 
	            	DB::raw('group_concat(c.ID) as categoryIds'))

	            ->where('a.Title', 'like', '%'.$_POST['search'].'%')
                ->orWhere('a.textOnlyContent', 'like', '%'.$_POST['search'].'%')

	            ->orderBy('dateCreated', 'DESC')
	           	->groupBy('a.ID')
	            ->get();



        //$filteredArticlesWithCats = self::__mergeArticleCatIdsWithCats($filteredArticles);

        return view('readArticles')->with(array('articles' => $articles, 'searchTerm' => $_POST['search'], 'sorted' => array(false)));
 	}

}

