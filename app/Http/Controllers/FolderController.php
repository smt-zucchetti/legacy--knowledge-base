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
 			'parentId'		=> !empty($_POST['parentId'])?$_POST['parentId']:null,
 			'createdBy'		=> Auth::user()->id
 		));

 		return self::readFolders();
 	}


 	public function __createFolderHierarchy($folders){ 		

 		//deep clone array of objects
 		$foldersCopy = array();
	    foreach($folders as $key => $value) {
	        $foldersCopy[$key] = clone $value;
	    }

	    //reorganize as needed into hierarchy
 		foreach($foldersCopy as $key => $folderA){
 			if(!property_exists($folderA, 'childFolders')){
 				$folderA->childFolders = array();
 			}
 			if($folderA->parentId !== null){
 				foreach($foldersCopy as $folderB){
 					if($folderA->parentId === $folderB->id){
 						$folderB->childFolders[] = $folderA;
 						unset($foldersCopy[$key]);
 					}
 				}
 			}
 		}

 		//print_r($foldersCopy);
 		//die();

 		return $foldersCopy;
 	}

 	public function readFolders(){
 		if (Auth::user()){

 			$folders = DB::table('Folders')->orderBy('dateCreated', 'DESC')->get();
 			$folderHierarchy = self::__createFolderHierarchy($folders);

 			return view('readFolders', array('folders' => $folders, 'folderHierarchy' => $folderHierarchy, 'sorted' => array(false)) );
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
	 			'lastUpdatedBy'	=> Auth::user()->id,
	 			'parentId'		=> !empty($_POST['parentId'])?$_POST['parentId']:null
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

