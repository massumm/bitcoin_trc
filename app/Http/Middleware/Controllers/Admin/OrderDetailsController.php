<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicineListModel;
use App\Http\Controllers\Controller;
use App\Models\OrderDetailsModel;
use App\Models\PrescriptionOrderModel;

class OrderDetailsController extends Controller
{


    // public function add_cart($order_id)
    // {

    //     // $medicineListModel = MedicineListModel::all();
    //     $medicineListModel = MedicineListModel::where('delete_flag', 1)->get();
    //     $PrescriptionOrderId = PrescriptionOrderModel::find($order_id);
    //     $orderDetailsModel = OrderDetailsModel::where('p_id', $order_id)->get();
    //     return view('admin.prescription.add_product_cart', compact('PrescriptionOrderId', 'medicineListModel', 'orderDetailsModel'));
    // }

    public function add_cart(Request $request)
    {
        $order_id = $request->query('order_id');

        $medicineListModel = MedicineListModel::where('delete_flag', 1)->get();
        $PrescriptionOrderId = PrescriptionOrderModel::find($order_id);
        $orderDetailsModel = OrderDetailsModel::where('p_id', $order_id)->get();
        return view('admin.prescription.add_product_cart', compact('PrescriptionOrderId', 'medicineListModel', 'orderDetailsModel'));
    }

    public function store(Request $request)
    {

        $user = auth()->user();
        $items = $request->input('items');
        $id = $request->input('id');
        $subtotal = $request->input('subtotal');
        $insTotal = $request->input('insTotal');
        $tax = $request->input('tax');
        $total = $request->input('total');

        $insCode = $request->input('insCode');
        $hospital = $request->input('hospital');
        $department = $request->input('department');
        $doctor_name = $request->input('doctor_name');

        $PrescriptionOrderId = PrescriptionOrderModel::find($id);



        foreach ($items as $item) {
            // ['p_id', 'm_id', 'm_title', 'm_image', 'm_discount', 'm_price', 'quantity', 'tottal_price'];
            $newItem = new OrderDetailsModel([
                'p_id' => $id,
                'm_id' => $item['id'],
                'm_title' => $item['name'],
                'm_types' => $item['types'],

                'm_image' => $item['image'],
                'm_discount' => $item['quantity'],
                'm_price' => $item['price'] / $item['quantity'],

                'quantity' => $item['quantity'],

                'm_days' => $item['days'],

                'm_daily_dose' => $item['daily_dose'],
                'm_piese_per_dose' => $item['piese_per_dose'],
                'm_instruction' => $item['instruction'],
                'm_times' => $item['menu'],
                'm_notes' => $item['notes'],
                'created_by' => $user->id,

                'tottal_price' => $item['price'],
            ]);
            $newItem->save();
        }

        // $PrescriptionOrderId->update([
        //     'subtotal' => $subtotal,
        //     'tax' => $tax,
        //     'total' => $total,
        //     'cart_status' => 2,
        // ]);

        $PrescriptionOrderId = PrescriptionOrderModel::find($id);

        $PrescriptionOrderId->subtotal = $subtotal;
        $PrescriptionOrderId->insurance_total = $insTotal;
        $PrescriptionOrderId->tax = $tax;
        $PrescriptionOrderId->total = $total;

        $PrescriptionOrderId->ins_code = $insCode;
        $PrescriptionOrderId->hospital = $hospital;
        $PrescriptionOrderId->department = $department;
        $PrescriptionOrderId->doctor_name = $doctor_name;
        $PrescriptionOrderId->created_by = $user->id;

        $PrescriptionOrderId->cart_status = 2; //cart status 2 means new cart added in the list.
        $PrescriptionOrderId->update();

        $p_order = PrescriptionOrderModel::with('user')->where('o_status', 1)->get();
        return view('admin.prescription.pending_prescrip', compact('p_order'));
    }


    public function update(Request $request)
    {

        $items = $request->input('items');
        $id = $request->input('id');
        $subtotal = $request->input('subtotal');
        $insTotal = $request->input('insTotal');
        $tax = $request->input('tax');
        $total = $request->input('total');

        $insCode = $request->input('insCode');
        $hospital = $request->input('hospital');
        $department = $request->input('department');
        $doctor_name = $request->input('doctor_name');

        $delete_items = $request->input('delete_items');


        $PrescriptionOrderId = PrescriptionOrderModel::find($id);


        foreach ($items as $item) {

            $user = auth()->user();
            $orderDetailsModel = OrderDetailsModel::where('p_id', $id)->where('m_id', $item['id'])->first();


            if ($orderDetailsModel) {
                $orderDetailsModel->m_title = $item['name'];
                $orderDetailsModel->m_types = $item['types'];

                $orderDetailsModel->m_image = $item['image'];
                $orderDetailsModel->m_price = $item['price'] / $item['quantity'];
                $orderDetailsModel->quantity = $item['quantity'];
                $orderDetailsModel->m_days = $item['days'];

                $orderDetailsModel->m_daily_dose = $item['daily_dose'];
                $orderDetailsModel->m_piese_per_dose = $item['piese_per_dose'];
                $orderDetailsModel->m_instruction = $item['instruction'];
                $orderDetailsModel->m_times = $item['menu'];
                $orderDetailsModel->m_notes = $item['notes'];
                $orderDetailsModel->created_by = $user->id;
                $orderDetailsModel->tottal_price = $item['price'];

                $orderDetailsModel->update();
            } else {

                $newItem = new OrderDetailsModel([
                    'p_id' => $id,
                    'm_id' => $item['id'],
                    'm_title' => $item['name'],
                    'm_types' => $item['types'],
                    'm_image' => $item['image'],
                    'm_discount' => $item['quantity'],
                    'm_price' => $item['price'] / $item['quantity'],

                    'quantity' => $item['quantity'],

                    'm_days' => $item['days'],

                    'm_daily_dose' => $item['daily_dose'],
                    'm_piese_per_dose' => $item['piese_per_dose'],
                    'm_instruction' => $item['instruction'],
                    'm_times' => $item['menu'],
                    'm_notes' => $item['notes'],
                    'created_by' => $user->id,

                    'tottal_price' => $item['price'],
                ]);
                $newItem->save();
            }
        }


        // foreach ($delete_items as $delete_item) {

        //     foreach ($items as $item) {
        //         if($item['id'] == $delete_item){
        //             return;
        //         }
        //     }

        //     $orderDetailsModel = OrderDetailsModel::where('p_id', $id)->where('m_id', $delete_item)->first();
        //     $orderDetailsModel->delete();
        // }


        $PrescriptionOrderId = PrescriptionOrderModel::find($id);

        $PrescriptionOrderId->subtotal = $subtotal;
        $PrescriptionOrderId->insurance_total = $insTotal;
        $PrescriptionOrderId->tax = $tax;
        $PrescriptionOrderId->total = $total;

        $PrescriptionOrderId->ins_code = $insCode;
        $PrescriptionOrderId->hospital = $hospital;
        $PrescriptionOrderId->department = $department;
        $PrescriptionOrderId->doctor_name = $doctor_name;
        $PrescriptionOrderId->created_by = $user->id;

        $PrescriptionOrderId->cart_status = 2; //cart status 2 means new cart added in the list.
        $PrescriptionOrderId->update();

        $p_order = PrescriptionOrderModel::with('user')->where('o_status', 1)->get();
        return view('admin.prescription.pending_prescrip', compact('p_order'));
    }


    public function pendingPrescrip()
    {
        $p_order = PrescriptionOrderModel::with('user')->where('o_status', 1)->get();
        return view('admin.prescription.pending_prescrip', compact('p_order'));
    }
}
