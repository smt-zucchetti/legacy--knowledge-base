<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;

use App\Articles;
use App\Categories;
use App\Articles_Categories;
use App\User;

class UserController extends Controller
{

	public function logIn(){
		if(empty($_POST)){
			return view('login');
		}else{

			$user = User::where(array(

				array('userName', $_POST['userName']), 
				array('password', $_POST['password'])
			))->first();


			if(!empty($user)){
				$user->lastLoggedIn = date('Y-m-d: H:i:s');
				$user->save();


				return redirect('readArticles');
			}else{
				return view('login', array('failedLogin' => true));
			}
		}
	}

}

