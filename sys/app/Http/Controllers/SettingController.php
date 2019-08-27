<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use File;

class SettingController extends Controller
{

    public function index(){
      $data['setting'] = Setting::first()->get();
      return view('setting/index', $data);
    }

    public function change(Request $request, $id){
      $setting = Setting::find($id);

     if ($request->hasFile('logo')) {
        $images = $setting -> logo;
        File::delete('images/'.$images);
        $path          = $request->file('logo');
        $pathName      = time().'.'.$path->GetClientOriginalExtension();
        $path->move('images/',$pathName);
        $setting->logo = $pathName;
      } else {
        $setting->logo = $setting->logo;
      }

      $setting->name        = $request->name;
      $setting->description = $request->description;
      $setting->company     = $request->company;
      $setting->address     = $request->address;
      $setting->phone       = $request->phone;
      $setting->email       = $request->email;

      $setting->save();

      return redirect()->back()->with('ok', 'berhasil edit data.');
    }

}
