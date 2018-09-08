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

class SearchController extends Controller
{
	/*TODO

		Featured Articles
		Required fields on forms
		Sort by category
	*/


 	public function searchArticles(){

 		$filteredArticles = DB::table('ArticleData')
                ->where('Title', 'like', '%'.$_POST['search'].'%')
                ->orWhere('textOnlyContent', 'like', '%'.$_POST['search'].'%')
                ->get();

        $filteredArticlesWithCats = self::__mergeArticleCatIdsWithCats($filteredArticles);

        return view('listArticles')->with(array('articles' => $filteredArticlesWithCats));
 	}

}

