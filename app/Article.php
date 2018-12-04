<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Article';

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