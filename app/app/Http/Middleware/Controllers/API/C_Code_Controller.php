<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddMedicineFormRequest;
use App\Http\Requests\admin\C_Code_FormRequest;
use App\Models\CountryCode;
use Illuminate\Http\Request;

class C_Code_Controller extends Controller
{
    public function index(){
       // return 'This is Dashboard';

         return view('admin.country_code.add_c_code');
    }
    public function liff_view(){
        // return 'This is Dashboard';
 
          return view('admin.country_code.liff_view');

     }
    public function view(){
        // return 'This is Dashboard';
        $CountryCodes = CountryCode::all();
          return view('admin.country_code.view_c_code', compact('CountryCodes'));
     }

    public function store(C_Code_FormRequest $request){

        $data = $request->validated();

        $addC_Code = new CountryCode;

        $addC_Code->C_Code = $data['c_code'];
        $addC_Code->status = $data['status'];

        $addC_Code->save();

        return redirect('admin/view-country-code')-> with('status','Country Code Added Successfully');


    }
    public function api_view(){
        // return 'This is Dashboard';
        $CountryCodes = CountryCode::all();
        return response()->json(['country_codes'=>$CountryCodes],200);
     }
     public function api_show($c_code_id){
        // return 'This is Dashboard';
        $CountryCodes = CountryCode::find($c_code_id);
        return response()->json(['country_codes'=>$CountryCodes],200);
     }

    public function api_store(C_Code_FormRequest $request){

        $data = $request->validated();

        $addC_Code = new CountryCode;

        $addC_Code->C_Code = $data['c_code'];
        $addC_Code->status = $data['status'];

        $addC_Code->save();

        return response()->json(['message'=>'added succesfully'],200);


    }

    public function edit($c_code_id){
        // return 'This is Dashboard';
        $CountryCodes = CountryCode::find($c_code_id);
        return view('admin.country_code.edit_c_code', compact('CountryCodes'));
     }

     public function update(C_Code_FormRequest $request,$c_code_id){
        $data = $request->validated();

        $addC_Code =  CountryCode::find($c_code_id);

        $addC_Code->C_Code = $data['c_code'];
        $addC_Code->status = $data['status'];

        $addC_Code->update();

        return redirect('admin/view-country-code')-> with('status','Country Code Updated Successfully');

     }
     public function api_update(C_Code_FormRequest $request,$c_code_id){
        $data = $request->validated();

        $addC_Code =  CountryCode::find($c_code_id);

        $addC_Code->C_Code = $data['c_code'];
        $addC_Code->status = $data['status'];

        $addC_Code->update();

        return response()->json(['message'=>'updated succesfully'],200);

     }

     public function destroy($c_code_id){
         //return 'This is Dashboard';
        $CountryCodes = CountryCode::find($c_code_id);
        if( $CountryCodes){
            $CountryCodes->delete();
            return redirect('admin/view-country-code')-> with('status','Country Code Deleted Successfully');

        }else{
            return redirect('admin/view-country-code')-> with('status','Id Not Found');

        }

     }

     public function api_destroy($c_code_id){
        // return 'This is Dashboard';
        $CountryCodes = CountryCode::find($c_code_id);
        if( $CountryCodes){
            $CountryCodes->delete();
            return response()->json(['message'=>'deleted succesfully'],200);

        }else{
            return response()->json(['message'=>'id not found'],400);

        }

     }


}
