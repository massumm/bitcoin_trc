<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SebastianBergmann\Environment\Console;

class PaymentListController extends Controller
{
    public function view(){
        $paymentlistmodel = PaymentListModel::all();
        return view('admin.payment.paymentList',compact('paymentlistmodel'));
      }

      public function edit_view($payment_id){
        $payment_id = PaymentListModel::find($payment_id);
        return view('admin.payment.editpayment',compact('payment_id'));
      }


      public function update_payment(Request $request,$payment_id){
        $payment_id = PaymentListModel::find($payment_id);
        $data = request()->all();
        $payment_id->title = $data['title'];
        $payment_id->subtitle = $data['subtitle'];
        $payment_id->status = $data['status'];
      
        $payment_id->attributes = $data['attributes'];
        if($request->hasfile('img')){
            $destination='uploads/payments/'.$payment_id->img;
            echo($destination);

            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/payments/',$filename);
            $payment_id->img= 'uploads/payments/' . $filename;
        }


        $payment_id->update();

        return redirect('admin/view-payment-list')-> with('status','payment Updated Successfully');
      }

      public function api_view(){
        $paymentlistmodel = PaymentListModel::all();
        if($paymentlistmodel){
            return response()->json(['paymentlist'=>$paymentlistmodel],200);
        }else{
            return response()->json(['message'=>'payment list not found'],200);
        }
      

      }
}
