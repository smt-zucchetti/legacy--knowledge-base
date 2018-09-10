<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles_Categories extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Articles_Categories';

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