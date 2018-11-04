<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait CreateFolderHierarchy
{
    private function getFolders(){
        $first = DB::table('Folders as f')
                ->leftJoin('Articles as a', function($leftJoin){
                    $leftJoin->on('f.id', '=', 'a.folderId');
                    $leftJoin->where('a.deleted', '=', 0);
                    $leftJoin->orWhere('a.deleted', '=', null);
                })
                ->select(['f.name', 'f.id', 'f.parentId', 'f.dateCreated',                
                        DB::raw('group_concat(a.Title) as articleTitles'), 
                        DB::raw('group_concat(a.ID) as articleIds')
                    ])
                ->groupBy('f.name','f.id');

        $folders = DB::table('Folders as f')
            ->rightJoin('Articles as a', function($rightJoin){
                $rightJoin->on('f.id', '=', 'a.folderId');
            })
            ->select(array(
                    'f.name', 'f.id', 'f.parentId', 'f.dateCreated',                
                    DB::raw('group_concat(a.Title) as articleTitles'), 
                    DB::raw('group_concat(a.ID) as articleIds')

                ))
            ->where('a.deleted', '=', 0)
            ->orWhere('a.deleted', '=', null)
            ->union($first)
            ->groupBy('f.name','f.id')
            ->get();

        return $folders;
    }

    private function getFolderById($folders, $folderId){
        foreach($folders as $folder){
            if($folder->id == $folderId){
                return $folder;
            }
        }
        return null;
    }

    private function __createFolderHierarchy($folders, $scalar = false)
    {
      
        if(!$scalar && !$this->hasRoot($folders)){
            $folder = new \stdClass();
            $folder->id = null;
            $folder->name = null;
            $folder->parentId = null;
            $folder->articleIds = null;
            $folder->articleTitles = null;

            $folders[] = $folder;
        }

    	foreach($folders as $folder){
            $folder->depth = null;
            $folder->articlesArr = [];
            $folder->children = [];
    		$folder->childFolders = [];
    	}

        $this->convertArticlesToArray($folders);
        
        $folders = $this->addChildFolders($folders, $scalar);

        foreach($folders as $folder){
            $this->addChildren($folder);
        }

        if($scalar){
            foreach($folders as $folder){
                $folder->childFolders = [];
            }
        }else{
            foreach($folders as $key => $folder){
                if($folder->name !== null){
                    unset($folders[$key]);
                }
            }
        }

        foreach($folders as $folder){
            $this->addDepthValue($folder, 1);    
        }

 		return $folders;
    }

    private function hasRoot($folders){
        $hasRoot = false;
        foreach($folders as $key => $folder){
            if($folder->name === null){
                $hasRoot = true;
            }
        }

        return $hasRoot;
    }

    private function convertArticlesToArray($folders){
        foreach($folders as $key => $folder){
            $articleIdsTmpArr = $folder->articleIds == null?[]:explode(",",$folder->articleIds);
            $articleTitlesTmpArr = $folder->articleTitles == null?[]:explode(",",$folder->articleTitles);

            unset($folders[$key]->articleIds);
            unset($folders[$key]->articleTitles);

            for($i = 0; $i < count($articleIdsTmpArr); $i++){
                $folder->articlesArr[$articleIdsTmpArr[$i]] = $articleTitlesTmpArr[$i];    
            }
        }
    }

    private function addChildFolders($folders){
        //dd($folders);
        foreach($folders as $folder){
            foreach($folders as $folder2){
                //$folder is parent of $folder2 
                if($folder2->parentId == $folder->id){
                    //folder is either a child of root or root 
                    if($folder->id !== null || ($folder->name == null && $folder2->name !== null)){
                        $folder->childFolders[] = $folder2;
                    }
                }
            }
        }
        
        return $folders;
    }

    private function addDepthValue($folder, $level=1){

        $folder->depth = $level;

        $level += count($folder->childFolders) > 0 ?1:-1;
  
        foreach($folder->childFolders as $folder){
            $this->addDepthValue($folder, $level);
        }
    }

    private function addChildren($curFolder, $childFolders = null){

        $childFolders = $childFolders == null?$curFolder->childFolders:$childFolders;

        foreach($childFolders as $childFolder){
            if(!in_array($childFolder->id, $curFolder->children)){
                $curFolder->children[] = $childFolder->id;        
            }

            if(count($childFolder->childFolders) > 0){
                $this->addChildren($curFolder, $childFolder->childFolders);
                $this->addChildren($childFolder, $childFolder->childFolders);
            }
        }
    }
}

