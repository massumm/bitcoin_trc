<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\User2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function view(){
  
        $UsersList = User2::all();
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

    public function addUser()
    {
        return view('admin.users.add_user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'balance' => 'required|numeric|min:0',
            'status' => 'required|in:0,1'
        ]);

        // Generate a unique referral code
        $refer_code = rand(10000, 99999);

        DB::table('users')->insert([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'balance' => $request->balance,
            'status' => $request->status,
            'refer_code' => $refer_code,
            'refer_by' => null,  // Admin created users don't have a referrer
            'refer_earn' => 0.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('admin/view-userslist')->with('status', 'User added successfully!');
    }

    public function userDetails($user_id)
    {
        $user = User2::findOrFail($user_id);
        $products = DB::table('products')->get();
        return view('admin.users.user_details', compact('user', 'products'));
    }

    public function storeCombo(Request $request)
    {
        try {
            $data = $request->json()->all();
            
            // Delete existing combos for this user
            DB::table('combos')->where('user_id', $data['user_id'])->delete();
            
            // Insert new combos
            foreach ($data['products'] as $product) {
                DB::table('combos')->insert([
                    'user_id' => $data['user_id'],
                    'product_id' => $product['product_id'],
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'stock_status' => 'in_stock',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Combo stored successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to store combo: ' . $e->getMessage()
            ], 500);
        }
    }
}
