<?php

namespace App\Http\Controllers\API;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NotifyModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile' => 'required|regex:/(1)[0-9]{9}/|unique:tbl_user,mobile',
            'email' => 'required|string|email|max:255|unique:tbl_user,email',
            'password' => 'required|string|min:6',
            'fid' => 'sometimes|string|max:255',
            'status' => 'required',
            'c_code' => 'required|string|max:255',
            'line_id' => 'sometimes|string|max:255',
            'player_id' => 'required|string|max:255',
            'push_token' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $error_messages = $validator->errors()->all();
            $message = 'The given data was invalid. ' . implode(' ', $error_messages);
            return response(['message' => $message], 422);
        }

        $data = $validator->validated();

        $user = UserModel::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'address' => $data['address'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
            'fid' => $data['fid'],
            'status' => $data['status'],
            'c_code' => $data['c_code'],
            'line_id' => $data['line_id'],
        ]);

        $token = $user->createToken('XorMediShopReg')->plainTextToken;

        $userData = [
            'id' => isset($user['id']) ? $user['id'] : null, // Varying field 'id'
            'fname' => $user['fname'],
            'lname' => $user['lname'],
            'address' => $user['address'],
            'mobile' => $user['mobile'],
            'email' => $user['email'],
            'status' => array_key_exists('status', $user) ? (int) $user['status'] : 1, // Convert to integer
            'c_code' => $user['c_code'],
            'line_id' => isset($user['line_id']) ? $user['line_id'] : null, // Varying field 'line_id'
            'fid' => $user['fid'],
            'created_at' => $user['created_at'],
            'updated_at' => isset($user['updated_at']) ? $user['updated_at'] : null, // Varying field 'updated_at'

        ];


        $notifyModel = new NotifyModel;

        $notifyModel->uid = $user->id;
        $notifyModel->player_id = $data['player_id'];
        $notifyModel->token = $data['push_token'];

        $notifyModel->save();

        $response = [
            'user' => $userData,
            'token' => $token,
        ];


        return response($response, 200);
    }



    public function login(Request $request)
    {
        $data = $request->validate([
            'email_or_mobile' => 'required|string|max:255',
            'password' => 'required|string',
            'player_id' => 'required|string|max:255',
            'push_token' => 'required|string|max:255',
        ]);

        $user = UserModel::where(function ($query) use ($data) {
            $query->where('email', $data['email_or_mobile'])
                ->orWhere('mobile', $data['email_or_mobile']);
        })->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response(['message' => 'Invalid Credentials'], 401);
        } elseif ($user->status == 0) {
            return response(['message' => 'Your account has been deactivated'], 401);
        } else {
            $token = $user->createToken('XorMediShopLogin')->plainTextToken;

            $notifyModel = new NotifyModel;

            $notifyModel->uid = $user->id;
            $notifyModel->player_id = $data['player_id'];
            $notifyModel->token = $data['push_token'];

            $notifyModel->save();

            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response($response, 200);
        }
    }



    public function check_user(Request $request)
    {
    $data = $request->validate([
        'mobile' => 'required|string'
    ]);

    $user = UserModel::where('mobile', $data['mobile'])->first();

    if ($user) {
        return response()->json(['status' => true, 'message' => 'User already exist'], 200);
    }
    elseif(!$user)
    {
        return response()->json(['status' => false, 'message' => 'User not found'], 200);
    }

    else {
        return response()->json(['message' => 'something went wrong'], 401);
    }
}



    public function logout(Request $request)
    {

        // auth()->user()->tokens()->delete();
        auth()->user()->currentAccessToken()->delete();

        $data = $request->validate([
            'player_id' => 'required|string|max:255',
        ]);

        NotifyModel::where('player_id', 'LIKE', $data['player_id'])->delete();


        return response(['message' => 'Logged out successfully'], 200);
    }


    public function forget_password(Request $request, $mobile)
{
    $data = $request->validate([
        'password' => 'required|string|min:6',
    ]);

    $user = UserModel::where('mobile', $mobile)->first();

    if ($user) {
        $user->password = Hash::make($data['password']);
        $user->save();


        $token = $user->createToken('XorMediShopReg')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 200);

        //return response()->json(['message' => 'Password updated successfully'], 200);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }
}


    //update_profile
    public function update_profile(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $error_messages = $validator->errors()->all();
            $message = 'The given data was invalid. ' . implode(' ', $error_messages);
            return response(['message' => $message], 422);
        }

        $data = $validator->validated();

        $data['email'] = strtolower($data['email']); // Convert email to lowercase

        $user = UserModel::find($user_id);

        if ($user) {
            // Check if the provided email is different from the current user's email
            if ($data['email'] !== $user->email) {
                // Perform unique validation for the email
                $validator2 = Validator::make(['email' => $data['email']], [
                    'email' => 'unique:tbl_user,email',
                ]);

                if ($validator2->fails()) {
                    $error_messages = $validator2->errors()->all();
                    $message = 'The given data was invalid. ' . implode(' ', $error_messages);
                    return response(['message' => $message], 422);
                }
            }

            $user->fname = $data['fname'];
            $user->lname = $data['lname'];
            $user->email = $data['email'];
            $user->address = $data['address'];

            $user->save();

            $token = $user->createToken('XorMediShopReg')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response($response, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }


    public function line_updated(Request $request, $user_id)
    {
        $data = $request->validate([

            'line_id' => 'required|string|',
        ]);

        $user = UserModel::find($user_id);

         if ($user) {

            $user->line_id =  $data['line_id'];
            $user->update();
            return response()->json(['message' => 'line updated successfully'], 200);
        } else {

             return response()->json(['message' => 'User not found'], 404);
        }
    }



}
