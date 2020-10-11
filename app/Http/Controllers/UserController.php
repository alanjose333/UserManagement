<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;
use App\Exports\UsersExport;
use Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
   public function index()
   {
      return view('users/index');
   }

   public function getUsers(Request $request)
   {

      $user = User::query();
      if (!empty($request->gender)) {
         $user->where('gender', $request->gender);
      }
      // $user->orderBy('created_at','desc');
      return Datatables::of($user)->make(true);
   }

   public function create()
   {

      return view('users/create');
   }
   public function updateUser(Request $request)
   {

      if ($request->ajax()) {

         $user = User::find($request->id);

         $user->name = $request->name;
         $user->age = $request->age;
         $user->gender = $request->gender;

         $user->save();


         return response()->json($request);
      }
   }

   public function storeUser(Request $request)
   {

      $validatedData = $request->validate([
         'name' => ['string', 'max:100'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         'mobile' => ['max:12'],
      ]);

      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->mobile = $request->mobile;
      $user->age = $request->age;
      $user->gender = $request->gender;
      $user->save();
      return redirect('/');
   }

   public function export_csv()
   {
      return Excel::download(new UsersExport, 'users.csv');
   }
   ///import csv file with header in the format of Name,Email,Mobile,Age,Gender///
   public function import(Request $request)
   {


      //  file validation
      $request->validate([
         "csv_file" => "required:file",
      ]);

      $file = $request->file("csv_file");

      $csvData = file_get_contents($file);

      $rows = array_map("str_getcsv", explode("\n", $csvData));
      $header = array_shift($rows);

      foreach ($rows as $row) {
         if (isset($row[0])) {

         

               $row = array_combine($header, $row);


               // ----------- check if email id already exists ----------------
               $checkUser = User::where("email", "=", $row["Email"])->first();

               if (!is_null($checkUser)) {
               
                  $checkUser->name=$row["Name"];
                  $checkUser->age = !empty($row["Age"])? $row["Age"]: '0';
                  $checkUser->gender=!empty($row["Gender"])? $row["Gender"]: 'Male';
                  $checkUser->save();
            } else {
                  $user = new User;
                  $user->name = $row["Name"];
                  $user->email = $row["Email"];
                  $user->mobile = $row["Mobile"];
                  $user->age = !empty($row["Age"])? $row["Age"]: '0';
                  $user->gender = !empty($row["Gender"])? $row["Gender"]: 'Male';
                  $user->save();
                
               }
            
         }
      }


      return redirect()->route('users')->with('toastr', ['type' => 'success', 'text' => 'csv file imported successfully',]);
   }
 
}
