<?php

namespace App\Traits;

trait CreateFolderHierarchy
{

    protected function __createFolderHierarchy($folders, $withArticles = false)
    {
      
    	foreach($folders as $folder){
            $folder->depth = null;
            $folder->articlesArr = [];
            $folder->children = [];
    		$folder->childFolders = [];
    	}



        if($withArticles){
            $this->convertArticlesToArray($folders);
        }

        $folders = $this->addChildFolders($folders);

        foreach($folders as $folder){
            $this->addDepthValue($folder, 1);    
        }

        foreach($folders as $folder){
            $this->addChildren($folder);
        }

 		return $folders;
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
                    //parent $folder is not top level or 
                    if($folder->id !== null || ($folder->name == null && $folder2->name !== null)){
                        $folder->childFolders[] = $folder2;
                    }
                }
            }
        }

        foreach($folders as $key => $folder){
            if($folder->name !== null){
                unset($folders[$key]);
            }
        }

        //dd($folders);

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

