<?php

namespace App\Http\Controllers\API;

use App\Models\UserModel;
use App\Models\NotifyModel;
use Illuminate\Http\Request;
use App\Models\NotificationModel;
use App\Models\OrderDetailsModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\PrescriptionOrderModel;
use App\Http\Requests\Admin\AcceptOrderRequest;
use App\Http\Requests\Admin\CancelOrderRequest;
use App\Http\Requests\admin\PrescriptionOrderFormRequest;

class PrescriptionOrderController extends Controller
{
    public function order_from_api(PrescriptionOrderFormRequest $request)
    {

        $data = $request->validated();

        $user = UserModel::find($data['uid']);
        if (!$user) {
            return response()->json(['message' => 'Invalid User'], 404);
        }

        if ($user->status == 0) {
            return response(['message' => 'Your account has been deactivated'], 404);
        }else{

            $prescriptionOrderModel = new PrescriptionOrderModel;

        // $prescriptionOrderModel->uid = $data['uid'];
        $prescriptionOrderModel->uid = $user->id;

        $files = $request->file('p_image');
        $image_name = '';

        // foreach($files as $file){
        //     $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        //     $file->move('uploads/prescriptions/',$filename);
        //     $image_name = $image_name."uploads/prescriptions/".$filename.";";
        // }
        // $prescriptionOrderModel->p_image= $image_name;

        $lastIndex = count($files) - 1;
        foreach ($files as $index => $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/prescriptions/', $filename);
            $image_name .= "uploads/prescriptions/" . $filename;

            if ($index !== $lastIndex) {
                $image_name .= ";";
            }
        }

        $prescriptionOrderModel->p_image = $image_name;

        $prescriptionOrderModel->save();
        // create a new notification
        $userName = $user->fname;
        $order_id = $prescriptionOrderModel->id;
        $notification = new NotificationModel();


        $notification_title = 'Order Recieved';
        $notification_descrip =  $userName . ', your prescription order #' . $order_id . ' has been Recieved.';


        $userId = $user->id;

        $notifyModels = NotifyModel::where('uid', 'LIKE', $userId)->get();
        $playerIds = $notifyModels->pluck('player_id');
        $this->sendPushNotificationToUser($userId, $playerIds, $notification_title, $notification_descrip);

        $notification->uid = $userId;
        $notification->date = date('Y-m-d H:i:s');
        $notification->title = $notification_title;
        //neeed to add order id
        $notification->description = $notification_descrip;
        $notification->save();

        return response()->json(['message' => 'Prescription added succesfully'], 200);

        }


    }


    public function sendPushNotificationToUser($id,$playerIds, $notification_title , $notification_descripo)
    {

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic NmNjZTI2NDEtMTY4Zi00M2ZhLThhMWMtN2YyMGU2ZjZmODcx',
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id' => '6f8b95c7-430b-4395-be4d-c8a983cace33',
            'include_player_ids' => $playerIds,
            'data' => ['Page' => 'Prescriptions'],
            'contents' => ['en' => $notification_descripo],
            'headings' => ['en' => $notification_title],
        ]);

        // Check the response status and handle accordingly
        if ($response->successful()) {
            // Notification sent successfully
            return response()->json(['message' => 'Notification has been sent']);
        } else {
            // Failed to send notification
            return response()->json(['error' => 'Failed to send push notification'], $response->status());
        }
    }

    public function api_show($user_id)
    {
        // return 'This is Dashboard';
        $prescriptionOrder = PrescriptionOrderModel::where('uid', $user_id)->get();

        if ($prescriptionOrder->isEmpty()) {
            return response()->json(['message' => 'No order found for this user'], 401);
        }
        return response()->json(['data' => $prescriptionOrder], 200);
    }

    public function order_medicine_list($order_id)
    {
        // return 'This is Dashboard';
        $orderDetailsModel = OrderDetailsModel::where('p_id', $order_id)->get();

        // if ($orderDetailsModel->isEmpty()) {
        //     return response()->json(['message' => 'Medicine cart is not ready yet'], 401);
        // }
        return response()->json(['data' => $orderDetailsModel], 200);
    }


    public function rejectOrder(CancelOrderRequest $request, $order_id)
    {
        $data = $request->validated();

        $prescriptionOrder = PrescriptionOrderModel::find($order_id);
        // $user = UserModel::where('id', $user_id)->first();

        if ($prescriptionOrder) {

            $prescriptionOrder->o_status =  $data['o_status'];
            $prescriptionOrder->status = $data['status'];


            $prescriptionOrder->update();

            return response($prescriptionOrder, 200);
            // return response()->json(['message' => 'Order Canceled'], 200);
        } else {

            return response()->json(['message' => 'Order not found'], 404);
        }
    }


    public function acceptOrder(AcceptOrderRequest $request, $order_id)
    {
         //$data = $request->validated();

        $data = $request->validate([
            'o_status' => ['required', 'integer', new ValidateInteger],
            'status' => ['required', 'integer', new ValidateInteger],
            'pay_methode' => 'required|string',
        ]);


        $prescriptionOrder = PrescriptionOrderModel::find($order_id);
        // $user = UserModel::where('id', $user_id)->first();

        if ($prescriptionOrder) {

            $prescriptionOrder->o_status =  $data['o_status'];
            $prescriptionOrder->status = $data['status'];
            $prescriptionOrder->pay_methode = $data['pay_methode'];


            $prescriptionOrder->update();

            return response($prescriptionOrder, 200);

        } else {

            return response()->json(['message' => 'Order not found'], 404);
        }
    }
}

use Illuminate\Contracts\Validation\Rule;

class ValidateInteger implements Rule
{
    public function passes($attribute, $value)
    {
        return is_int($value);
    }

    public function message()
    {
        return 'The :attribute must be an integer.';
    }
}
