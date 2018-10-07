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
use App\Folders;

class FolderController extends Controller
{
 	
	public function createFolder(){

 		DB::table('Folders')->insert(array(
 			'Name' 			=> $_POST['name'], 
 			'dateCreated' 	=> date('Y-m-d H:i:s'),
 			'createdBy'		=> Auth::user()->id
 		));

 		return self::readFolders();
 	}

 	public function readFolders(){
 		if (Auth::user()){

 			$folders = DB::table('Folders')->orderBy('dateCreated', 'DESC')->get();

 			return view('readFolders', array('folders' => $folders, 'sorted' => array(false)) );
 		}else{
 			return view('home');
 		}
 	}

 	public function updateFolder($folderID){
 		DB::table('Folders')
	 		->where('id', $folderID)
	 		->update(array(
	 			'Name' 			=> $_POST['name'],
	 			'lastUpdated' 	=> date('Y-m-d H:i:s'),
	 			'lastUpdatedBy'	=> Auth::user()->id
 		));

 		return self::readFolders();
 	}

 	public function deleteFolder($folderId){

 		Folders::where('id', $folderId)->delete();

 		return self::readFolders();
 	}

 	public function sortCategories($param, $dir){
 		

 		$categories = Categories::orderBy($param, $dir)
 			->where('deleted', 0)
 			->get();
 			

		return view('readCategories')->with(array('categories' => $categories, 'sorted' => array(true, $param, $dir)));
 	}
}

