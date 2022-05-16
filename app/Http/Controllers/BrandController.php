<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AllBrand(){
        $brands=Brand::latest()->paginate(10);



        return view('admin.brand.index',compact('brands'));
    }
    public function StoreBrand(Request $request){

        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'brand_name.required'=> 'هذا الحقل مطلوب',
                'brand_name.min'=> 'هذا الاسم أقل من 4 أحرف',
                'brand_image.mimes'=> 'jpg.jpeg,png',

            ]
        );
          $brand_image = $request->file('brand_image');
//رفع الصور بالطريقة العادية//
        /*  $name_gen = hexdec(uniqid());
          $img_ext = strtolower($brand_image->getClientOriginalExtension());
          $img_name = $name_gen.'.'.$img_ext;
          $up_location = 'image/brand/';
          $last_img = $up_location.$img_name;
          $brand_image->move($up_location,$img_name);*/
   //رفع الصور بالطريقة مع قصها//
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;

//insert1
       Brand::create([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
        ]);


        return Redirect()->back()->with('success','تم الإدخال بنجاح');

    }
    public function EditBrand($id){
        $brands=Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }
    public function UpdateBrand(Request $request,$id){
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ],
            [
                'brand_name.required'=> 'هذا الحقل مطلوب',
                'brand_name.min'=> 'هذا الاسم أقل من 4 أحرف',
                'brand_image.mimes'=> 'jpg.jpeg,png',

            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');
        if ($brand_image){
            //رفع الصور بالطريقة العادية//
            /*$name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);*/

            //رفع الصور بالطريقة مع قصها//
            $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
            $last_img = 'image/brand/'.$name_gen;


            unlink($old_image);
        }else{
            $last_img = $old_image;
        }


//insert1
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
        ]);


        return Redirect()->back()->with('success','تم التعديل بنجاح');
    }
    public function forceDelete($id){
        $delete=Brand::find($id);
        unlink($delete->brand_image);
            $delete->forceDelete();
        return Redirect()->back()->with('delete','تم الحذف بنجاح');
    }


    //// multi image
    public function Multipic(){
        $images=Multipic::latest()->paginate(10);
        return view('admin.multipic.index',compact('images'));
    }
    public function StoreImages(Request $request){


        $image = $request->file('image');
        foreach ($image as $multi_img){
            //رفع الصور بالطريقة مع قصها//
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300,200)->save('image/multi/'.$name_gen);
            $last_img = 'image/multi/'.$name_gen;

            //insert1
            Multipic::create([
                'image' => $last_img,
            ]);
        }



        return Redirect()->back()->with('success','تم الإدخال بنجاح');
    }
    public function forceDeleteMultipic($id){
        $delete=Multipic::find($id);
        unlink($delete->image);
        $delete->forceDelete();
        return Redirect()->back()->with('delete','تم الحذف بنجاح');
    }

}
