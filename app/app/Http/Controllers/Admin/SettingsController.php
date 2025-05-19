<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicSettingModel;
use App\Models\PagesSettingModel;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function pages_view(){
        $pageSetting = PagesSettingModel::first();
        if (!$pageSetting) {
            $pageSetting = new PagesSettingModel(); // Create a new instance if no data is found
        }
        // return view('admin.settings.pages_settings');
        return view('admin.settings.pages_settings', compact('pageSetting'));
        
   }
   public function basic_view(){
    $basicSetting = BasicSettingModel::first(); // Retrieve the first record from the table
    if (!$basicSetting) {
        $basicSetting = new BasicSettingModel(); // Create a new instance if no data is found
    }
    return view('admin.settings.basicsetting', compact('basicSetting'));
   
}
public function store_basic_view(Request $request){
    $user = auth()->user();
    $b_setting = BasicSettingModel::where('created_by', $user->id)->first(); // get existing record
    if (!$b_setting) {
        $b_setting = new BasicSettingModel; // if no record exists, create a new one
    }
    $b_setting->d_title = $request->input('d_title');
    $b_setting->tax = $request->input('tax');
    $b_setting->currency = $request->input('currency');
    $b_setting->push_id = $request->input('push_id');
    $b_setting->insurance_status = $request->input('insurance_status');
    $b_setting->created_by =  $user->id;
    $b_setting->save();
    $ids = $b_setting->id;
    return redirect()->back()->with('status', 'Setting info has been updated.');
}

public function store_pages_view(Request $request){
    $user = auth()->user();
    $pages_setting = PagesSettingModel::where('created_by', $user->id)->first(); // get existing record
    if (!$pages_setting) {
        $pages_setting = new PagesSettingModel; // if no record exists, create a new one
    }
    $pages_setting->privacy = $request->input('privacy');
    $pages_setting->about = $request->input('about');
    $pages_setting->contact = $request->input('contact');
    $pages_setting->terms = $request->input('terms');
    $pages_setting->created_by =  $user->id;
    $pages_setting->save();
    $ids = $pages_setting->id;
    return redirect()->back()->with('status', 'Setting info has been updated.');
}

public function api_pages_view(){
    $pageSetting = PagesSettingModel::first();
    if (!$pageSetting) {
        $pageSetting = new PagesSettingModel(); // Create a new instance if no data is found
    }
    // return view('admin.settings.pages_settings');
    if($pageSetting){
        return response()->json(['pages'=>$pageSetting],200);
    }else{
        return response()->json(['message'=>'settings  not found'],200);
    }

    
}
public function api_settings_view(){
    $basicSetting = BasicSettingModel::first(); // Retrieve the first record from the table
    if (!$basicSetting) {
        $basicSetting = new BasicSettingModel(); // Create a new instance if no data is found
    }
    // return view('admin.settings.pages_settings');
    if($basicSetting){
        return response()->json(['settings'=>$basicSetting],200);
    }else{
        return response()->json(['message'=>'settings  not found'],200);
    }

    
}


}
