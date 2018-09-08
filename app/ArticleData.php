<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ArticleData';

    /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	/*public function getRouteKeyName()
	{
	    return 'userToken';
	}*/
}