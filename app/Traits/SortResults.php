<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait SortResults
{

    private function sortResults($results, $param, $dir){
        if($param !== null){
            if($dir === "ASC" || $dir === null){
                $results = $results->sortBy($param, SORT_NATURAL|SORT_FLAG_CASE);
            }else if ($dir === "DESC"){
                $results = $results->sortByDesc($param, SORT_NATURAL|SORT_FLAG_CASE);
            }
        }

        return $results;
    }
}

