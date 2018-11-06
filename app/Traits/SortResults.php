<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait SortResults
{

    private function sortResults($results, $param, $dir){
        if($param !== null){
            if($dir === "ASC" || $dir === null){
                $results = $results->sortBy($param);
            }else if ($dir === "DESC"){
                $results = $results->sortByDesc($param);
            }
        }

        return $results;
    }
}

