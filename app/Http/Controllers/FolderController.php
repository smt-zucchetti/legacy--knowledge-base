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
use App\Traits\SortResults;

class FolderController extends Controller
{

	use CreateFolderHierarchy;
 	use SortResults;

	public function createFolder(){

 		DB::table('Folders')->insert(array(
 			'Name' 			=> $_POST['name'], 
 			'dateCreated' 	=> date('Y-m-d H:i:s'),
 			'parentId'		=> !empty($_POST['parentId'])?$_POST['parentId']:null,
 			'createdBy'		=> Auth::user()->id
 		));

 		return self::readFolders();
 	}

 	public function readFolders($param = null, $dir = null){
 		if (Auth::user()){

 			$folders = $this->getFolders();

	        //deep clone $folders
 			$folderHierarchy = clone $folders;
 			foreach($folderHierarchy as $key => $value){
 				$folderHierarchy[$key] = clone $value;
 			}
	        $this->__createFolderHierarchy($folderHierarchy, false);
	        
	        $foldersScalar = $folders;
	        $this->__createFolderHierarchy($foldersScalar, true);
	 		$foldersScalar = $this->sortResults($foldersScalar, $param, $dir);

 			return view('readFolders', ['foldersScalar' => $foldersScalar, 'folderHierarchy' => $folderHierarchy, 'sorted' => [$param !== null?true:false]] );
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

