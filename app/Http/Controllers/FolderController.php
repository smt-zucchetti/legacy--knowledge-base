<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Folders;
use App\Traits\CreateFolderHierarchy;

class FolderController extends Controller
{

	use CreateFolderHierarchy;
 	
	public function createFolder(){

 		DB::table('Folders')->insert(array(
 			'Name' 			=> $_POST['name'], 
 			'dateCreated' 	=> date('Y-m-d H:i:s'),
 			'parentId'		=> !empty($_POST['parentId'])?$_POST['parentId']:null,
 			'createdBy'		=> Auth::user()->id
 		));

 		return self::readFolders();
 	}

 	public function readFolders(){
 		if (Auth::user()){

 			$folders = DB::table('Folders as f')
		 		->leftJoin('Articles as a', 'f.id', '=', 'a.folderId')
	            ->select(array(
			            	'f.name', 'f.id', 'f.parentId', 'f.dateCreated',       			
	            			DB::raw('group_concat(a.Title) as articleTitles'), 
	            			DB::raw('group_concat(a.ID) as articleIds')
	            		))
	            ->where('a.deleted', '=', 0)
	            ->orWhere('a.deleted', '=', null)
	           	->groupBy('f.name','f.id')->get();

 			$folderz = clone $folders;

 			//dd($folders);

 			$folderHierarchy = $this->__createFolderHierarchy($folders);
 			//To do: fix object cloning issue

 			return view('readFolders', array('folders' => $folderz, 'folderHierarchy' => $folderHierarchy, 'sorted' => array(false)) );
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

 	
}

