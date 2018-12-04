<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Folder';

    /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	/*public function getRouteKeyName()
	{
	    return 'userToken';
	}*/


	private function getFolders($withRoot = true){

        if($withRoot){
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
                ->select('f.name', 'f.id', 'f.parentId', 'f.dateCreated',                
                        DB::raw('group_concat(a.Title) as articleTitles'), 
                        DB::raw('group_concat(a.ID) as articleIds')
                )
                ->where('a.deleted', '=', 0)
                ->orWhere('a.deleted', '=', null)
                ->union($first)
                ->groupBy('f.name','f.id')
                ->get();
        }else{
            $folders = DB::table('Folders as f')
                ->leftJoin('Articles as a', function($leftJoin){
                    $leftJoin->on('f.id', '=', 'a.folderId');
                    $leftJoin->where('a.deleted', '=', 0);
                    $leftJoin->orWhere('a.deleted', '=', null);
                })
                ->select(['f.name', 'f.id', 'f.parentId', 'f.dateCreated',                
                        DB::raw('group_concat(a.Title) as articleTitles'), 
                        DB::raw('group_concat(a.ID) as articleIds')
                    ])
                ->groupBy('f.name','f.id')
                ->get();
        }

        return $folders;
    }
}