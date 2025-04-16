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
     public function updateUser(Request $request)
{
    try {
        $user = User2::findOrFail($request->user_id);
        
        $user->update([
            'name' => $request->name,
            'balance' => $request->balance
        ]);

        return redirect()->back()->with('success', 'User updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update user: ' . $e->getMessage());
    }
}
     public function sts_update($user_id){
              //return 'This is Dashboard';
        $UsersList =  User2::find($user_id);
        $data = request()->all();
        if($UsersList->status=="0"){
            $UsersList->status = "1";
        }else{
            $UsersList->status = "0"; 
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
            'demostatus' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('admin/view-userslist')->with('status', 'User added successfully!');
    }

    public function userDetails($user_id)
    {
        $user = User2::findOrFail($user_id);
        $products = DB::table('products')
            ->inRandomOrder()
            ->limit(5)
            ->get();
        return view('admin.users.user_details', compact('user', 'products'));
    }

    public function storeCombo(Request $request)
    {
        try {
            $data = $request->json()->all();
            
            // Delete existing combos for this user
           // DB::table('combos')->where('user_id', $data['user_id'])->delete();
            
            // Prepare products array with all required fields
            $products = array_map(function($product) {
                return [
                    'id' => rand(1000, 9999), // Generate a random ID
                    'product_id' => $product['product_id'],
                    'image' => 'uploads/medicins/'.$product['image'], // Default image
                    'title' => $product['title'],
                    'stock_status' => 'in_stock',
                    'price' => $product['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                    'created_by' => 'admin',
                    'delete_flag' => 0,
                    'quantity' => $product['quantity']
                ];
            }, $data['products']);
            
            // Insert single combo record with JSON encoded products
            DB::table('combos')->insert([
                'user_id' => $data['user_id'],
                'task_number' => $data['task_number'],
                'commission' => $data['commission_percent'],
                'products' => json_encode($products),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
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
