<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
   public function get_users()
   {
      $users=User::all();
      return response()->json(['users'=>$users,'success'=>true,'code'  =>200], 200);
   }
}
