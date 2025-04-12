<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateMedicineFormRequest;
use App\Imports\MedicineListImport;
use App\Models\MedicineListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class MedcineListController extends Controller
{

    public function view()
    {

        return view('admin.medicine.addmedicinecsv');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048'
        ]);
        $file = $request->file('file');
        // return $file;
        // Get the file contents as an array of rows
        $rows = array_map('str_getcsv', file($file));

        // Get the header row and remove it from the data array
        $header = array_shift($rows);

        // DB::table('tbl_product')->delete();

        // return $header;
        // Loop through the rows and create a new record for each
        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            $data['created_by'] = $user->id;
            // Save the data to the database
            // return $data;
            DB::table('products')->updateOrInsert(
                ['product_id' => $data['product_id']],
                $data
            );
        }

        // Excel::import(new MedicineListImport, $request->file);
        return redirect('admin/view-medicine')->with('status', 'Medicine List added successfully');
    }


    public function downloadMedicineList()
    {
        // Get the data from the 'medicine_list' table
        $medicine_list = DB::table('tbl_product')->get();

        if ($medicine_list->isEmpty()) {
            return back()->with('error', 'No data available for download.');
        }

        // Set the file name for the downloaded CSV file
        // Generate a unique filename with the current timestamp
        $file_name = 'medicine_list_' . time() . '.csv';

        // Set the response headers for the download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $file_name . '"',
        ];
        // Define the callback function for writing the CSV rows
        $callback = function () use ($medicine_list) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['id', 'product_id','image', 'title', 'type', 'daily_dose', 'pieces_per_dose', 'instruction', 'stock_status', 'price', 'created_at','updated_at','created_by','delete_flag']);
            foreach ($medicine_list as $row) {

                fputcsv($file, (array) $row);
            }
            fclose($file);
        };

        // Create a download response with the CSV string and headers
        return response()->stream($callback, 200, $headers);
    }



    public function view_medicine_list()
    {
        // $medicineListModel = MedicineListModel::all();
        $medicineListModel = MedicineListModel::where('delete_flag', 1)->get();
        return view('admin.medicine.viewmedicinecsv', compact('medicineListModel'));
    }

    public function destroy($medicine_id)
    {

        // $Medicine_id = MedicineListModel::find($medicine_id);
        // if ($Medicine_id) {
        //     $Medicine_id->delete();
        //     return redirect('admin/view-medicine')->with('status', 'Country Code Deleted Successfully');
        // } else {
        //     return redirect('admin/view-medicine')->with('status', 'Id Not Found');
        // }

        $medicine = MedicineListModel::find($medicine_id);
        if ($medicine) {
            // Set the delete_flag column value to 0
            $medicine->delete_flag = 0;
            $medicine->save();
            return redirect('admin/view-medicine')->with('status', 'Medicine Record Restored Successfully');
        } else {
            return redirect('admin/view-medicine')->with('status', 'Medicine Record Not Found');
        }

    }

    public function edit($medicine_id)
    {
        // return 'This is Dashboard';
        $Medicine_id = MedicineListModel::find($medicine_id);
        return view('admin.medicine.editmedicinecsv', compact('Medicine_id'));
    }

    public function update(UpdateMedicineFormRequest $request, $medicine_id)
    {

        $data = $request->validated();

        $Medicine_id = MedicineListModel::find($medicine_id);

        $Medicine_id->title = $data['title'];
        $Medicine_id->price = $data['price'];
        $Medicine_id->type = $data['type'];
        $Medicine_id->discount = $data['discount'];
        $Medicine_id->stock_status = $data['stock_status'];
        $Medicine_id->description = $data['description'];

        if ($request->hasfile('image')) {
            $destination = 'uploads/medicins/' . $Medicine_id->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/medicins/', $filename);
            $Medicine_id->image = 'uploads/medicins/' . $filename;
        }

        //$Medicine_id->created_by = 0;
        $Medicine_id->update();

        return redirect('admin/view-medicine')->with('status', 'Medicine updated successfully');
    }
}
