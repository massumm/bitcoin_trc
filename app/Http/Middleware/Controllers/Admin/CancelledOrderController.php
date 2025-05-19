<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrescriptionOrderModel;

class CancelledOrderController extends Controller
{
    public function view(){
        $p_order = PrescriptionOrderModel::where('o_status', 0)->get();
           return view('admin.prescription.cancelled_prescrip', compact('p_order'));

        //    $p_order = PrescriptionOrderModel::where('o_status', 1)->get();
        //    return view('admin.prescription.pending_prescrip', compact('p_order'));
      }
}
