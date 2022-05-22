<?php

namespace App\Http\Controllers;


use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function homeSlider(){
       $sliders = Slider::latest()->paginate(10);
        return view('admin.slider.index',compact('sliders'));
    }
    public function Editslider($id){
        $sliders=Slider::find($id);
        return view('admin.slider.edit',compact('sliders'));
    }
    public function StoreSlider(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:4',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'title.required'=> 'هذا الحقل مطلوب',
                'title.min'=> 'هذا الاسم أقل من 4 أحرف',
                'image.mimes'=> 'jpg.jpeg,png',

            ]
        );
        $image = $request->file('image');
//رفع الصور بالطريقة العادية//
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/slider/';
        $last_img = $up_location.$img_name;
        $image->move($up_location,$img_name);
        //رفع الصور بالطريقة مع قصها//
      /*  $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,200)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;*/

//insert1
        Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
        ]);


        return Redirect()->back()->with('success','تم الإدخال بنجاح');
    }

    public function UpdateSlider(Request $request,$id){
        $validated = $request->validate([
            'title' => 'required|min:4',
        ],
            [
                'title' => 'required|min:4',
                'image' => 'required|mimes:jpg,jpeg,png',
            ]
        );

        $old_image = $request->old_image;

        $image = $request->file('image');
        if ($image){
            //رفع الصور بالطريقة العادية//
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/slider/';
            $last_img = $up_location.$img_name;
            $image->move($up_location,$img_name);

            //رفع الصور بالطريقة مع قصها//
            /* $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
             Image::make($brand_image)->resize(300,200)->save('image/slider/'.$name_gen);
             $last_img = 'image/slider/'.$name_gen;*/


            unlink($old_image);
        }else{
            $last_img = $old_image;
        }


//insert1
        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
        ]);


        return Redirect()->back()->with('success','تم التعديل بنجاح');
    }
    public function forceDelete($id){
        $delete= Slider::find($id);
        unlink($delete->image);
        $delete->forceDelete();
        return Redirect()->back()->with('delete','تم الحذف بنجاح');
    }
}
