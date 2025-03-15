<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function view(){
  
        $UsersList = UserModel::all();
         return view('admin.users.userslist', compact('UsersList'));
    }

    public function destroys($user_id){
         //return 'This is Dashboard';
       $UsersList = UserModel::find($user_id);
        if( $UsersList){
            $UsersList->delete();
            return redirect('admin/view-userslist')-> with('status','User Deleted Successfully');

        }else{
            return redirect('admin/view-userslist')-> with('status','Id Not Found');

        }

     }
     public function sts_update($user_id){
              //return 'This is Dashboard';
        $UsersList =  UserModel::find($user_id);
        $data = request()->all();
        if($UsersList->status==0){
            $UsersList->status = 1;
        }else{
            $UsersList->status = 0; 
        }
     


        $UsersList->save();

        return redirect('admin/view-userslist')-> with('status','Status updated Successfully');

     }


}
