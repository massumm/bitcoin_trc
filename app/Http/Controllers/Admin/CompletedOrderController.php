<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrescriptionOrderModel;

class CompletedOrderController extends Controller
{
    public function view(){
        $p_order = PrescriptionOrderModel::where('o_status', 2)->get();
           return view('admin.prescription.completed_prescrip', compact('p_order'));
      }
}
