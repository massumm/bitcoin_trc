<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrescriptionOrderModel;
use Illuminate\Support\Facades\DB;

class CompletedOrderController extends Controller
{
    public function view(){
        $p_order = DB::table('withdraw')
            ->where('status', 'Pending')
            ->get();
        
        return view('admin.prescription.completed_prescrip', compact('p_order'));
    }

    public function approve($id)
    {
        $withdraw = DB::table('withdraw')->where('id', $id)->first();
        
        if ($withdraw) {
            DB::table('withdraw')
                ->where('id', $id)
                ->update(['status' => 'Success']);

            DB::table('users')
                ->where('id', $withdraw->user_id)
                ->update(['balance' => DB::raw('balance - ' . $withdraw->amount)]);

            DB::table('users')
                ->where('id', $withdraw->user_id)
                ->update(['total_withdraw' => DB::raw('total_withdraw + ' . $withdraw->amount)]);

                
            return redirect()->back()->with('status', 'Withdrawal approved successfully');
        }   
    }

    public function reject($id)
    {
        DB::table('withdraw')
            ->where('id', $id)  
            ->update(['status' => 'Failed']);

        return redirect()->back()->with('status', 'Withdrawal rejected successfully');
    }

}
