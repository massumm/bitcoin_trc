<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\NotificationModel;
use App\Models\OrderDetailsModel;
use App\Http\Controllers\Controller;
use App\Models\NotifyModel;
use Illuminate\Support\Facades\Http;
use App\Models\PrescriptionOrderModel;
use Illuminate\Support\Facades\DB;

class PendingOrderController extends Controller
{
    public function view()
    {
        $p_order = DB::table('deposit')
            ->where('status', 'Pending')
            ->get();

        return view('admin.prescription.pending_prescrip', compact('p_order'));
    }

    public function getOrderDetails(Request $request)
    {
        $order_id = $request->input('order_id');

        $orderDetails = OrderDetailsModel::where('p_id', $order_id)->get();

        // Return the order details as JSON response
        return response()->json($orderDetails);
    }

    public function p_sts_update($p_order_id)
    {
        $Pending_Order =  PrescriptionOrderModel::find($p_order_id);
        $userId = $Pending_Order->uid;
        $user = UserModel::find($userId);
        $data = request()->all();
        $userName = $user->fname;
        $orderNo = $Pending_Order->id;
        if ($Pending_Order->status == 0) {
            $Pending_Order->status = 1;
        } else {
            $Pending_Order->status = 0;
            $notification_title = 'Prescription Order Approved';
            $notification_descrip =  $userName . ', your prescription order #' . $orderNo . ' has been approved.';

            $notifyModels = NotifyModel::where('uid', 'LIKE', $userId)->get();
            $playerIds = $notifyModels->pluck('player_id');
            $this->sendPushNotificationToUser($userId, $playerIds, $notification_title, $notification_descrip);
        }

        // Get user name and order number


        $Pending_Order->save();

        $notification = new NotificationModel();
        $notification->uid = $Pending_Order->uid;
        $notification->date = date('Y-m-d H:i:s');
        $notification->title = $notification_title;

        $notification->description = $notification_descrip;
        $notification->save();

        return redirect('admin/view-pending-order')->with('status', 'Status updated Successfully');
    }

    public function o_sts_update($p_order_id)
    {
        $Pending_Order =  PrescriptionOrderModel::find($p_order_id);
        $data = request()->all();
        $userId = $Pending_Order->uid;
        $user = UserModel::find($userId);
        $userName = $user->fname;
        $orderNo = $Pending_Order->id;
        if ($Pending_Order->o_status == 0) {
            $Pending_Order->o_status = 1;
        } else {
            $Pending_Order->status = 2;
            $Pending_Order->o_status = 0;
            $notification_title = 'Prescription Order Rejected';
            $notification_descrip =  $userName . ', your prescription order #' . $orderNo . ' has been rejected.';

            $notifyModels = NotifyModel::where('uid', 'LIKE', $userId)->get();
            $playerIds = $notifyModels->pluck('player_id');
            $this->sendPushNotificationToUser($userId, $playerIds, $notification_title, $notification_descrip);
        }



        $Pending_Order->save();
        $notification = new NotificationModel();
        $notification->uid = $Pending_Order->uid;
        $notification->date = date('Y-m-d H:i:s');
        $notification->title = $notification_title;

        $notification->description = $notification_descrip;
        $notification->save();

        return redirect('admin/view-pending-order')->with('status', 'Status updated Successfully');
    }


    public function cart_sts_update($p_order_id)
    {
        $Pending_Order =  PrescriptionOrderModel::find($p_order_id);
        $data = request()->all();
        $userId = $Pending_Order->uid;
        $user = UserModel::find($userId);
        $userName = $user->fname;
        $orderNo = $Pending_Order->id;
        if ($Pending_Order->cart_status == 2) {
            $Pending_Order->cart_status = 1;
            $notification_title = 'Prescription Order Cart Ready';
            $notification_descrip =  $userName . ', your prescription order #' . $orderNo . ' Cart Ready.';

            $notifyModels = NotifyModel::where('uid', 'LIKE', $userId)->get();
            $playerIds = $notifyModels->pluck('player_id');
            $this->sendPushNotificationToUser($userId, $playerIds, $notification_title, $notification_descrip);

        } else {
            $Pending_Order->cart_status = 0;
        }



        $Pending_Order->save();

        $notification = new NotificationModel();
        $notification->uid = $Pending_Order->uid;
        $notification->date = date('Y-m-d H:i:s');
        $notification->title = $notification_title;

        $notification->description = $notification_descrip;
        $notification->save();

        return redirect('admin/view-pending-order')->with('status', 'Status updated Successfully');
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

    public function updateAmount(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|min:0']);

        DB::table('deposit')
            ->where('id', $id)
            ->update(['amount' => $request->amount]);

        return redirect()->back()->with('status', 'Amount updated successfully');
    }

    public function approve($id)
    {
        // Get the deposit record
        $deposit = DB::table('deposit')->where('id', $id)->first();
        
        if ($deposit) {
            // Start a database transaction
            DB::beginTransaction();
            
            try {
                // Update deposit status
                DB::table('deposit')
                    ->where('id', $id)
                    ->update(['status' => 'Success']);
                
                // Get user's current task status
                $userTask = DB::table('users')
                    ->where('id', $deposit->user_id)
                    ->value('today_task');
                
                // Update user balance and total_deposit
                $updateData = [
                    'balance' => DB::raw('balance + ' . $deposit->amount),
                    'total_deposit' => DB::raw('total_deposit + ' . $deposit->amount)
                ];
                
                // If user-task is 0, update initial_balance from balance
                if ($userTask == "0" || $userTask == "25") {
                    $updateData['initial_balance'] = DB::raw('balance');
                }
                
                DB::table('users')
                    ->where('id', $deposit->user_id)
                    ->update($updateData);
                
                // Commit the transaction
                DB::commit();
                
                return redirect()->back()->with('status', 'Deposit approved successfully');
            } catch (\Exception $e) {
                // Rollback the transaction in case of error
                DB::rollback();
                return redirect()->back()->with('error', 'Failed to approve deposit: ' . $e->getMessage());
            }
        }
        
        return redirect()->back()->with('error', 'Deposit record not found');
    }

    public function reject($id)
    {
        DB::table('deposit')
            ->where('id', $id)
            ->update(['status' => 'Failed']);

        return redirect()->back()->with('status', 'Deposit rejected successfully');
    }
}
