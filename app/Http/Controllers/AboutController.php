<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function homeAbout(){
        $abouts = HomeAbout::latest()->paginate(10);
        return view('admin.home.index',compact('abouts'));
    }
    public function EditAbout ($id){
        $abouts=HomeAbout::find($id);
        return view('admin.home.edit',compact('abouts'));
    }
    public function forceDelete ($id){

    }

    public function StoreAbout (Request $request){
        $validated = $request->validate([
            'title' => 'required|min:4',
        ],
            [
                'title.required'=> 'هذا الحقل مطلوب',
                'title.min'=> 'هذا الاسم أقل من 4 أحرف',
            ]
        );

        HomeAbout::create([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
        ]);
        return Redirect()->back()->with('success','تم الإدخال بنجاح');
    }
    public function UpdateAbout (Request $request,$id){
        $validated = $request->validate([
            'title' => 'required|min:4',
        ],
            [
                'title.required'=> 'هذا الحقل مطلوب',
                'title.min'=> 'هذا الاسم أقل من 4 أحرف',
            ]
        );
        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
        ]);
        return Redirect()->back()->with('success','تم التعديل بنجاح');
    }
}
