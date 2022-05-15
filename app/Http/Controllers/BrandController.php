<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
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

          $name_gen = hexdec(uniqid());
          $img_ext = strtolower($brand_image->getClientOriginalExtension());
          $img_name = $name_gen.'.'.$img_ext;
          $up_location = 'image/brand/';
          $last_img = $up_location.$img_name;
          $brand_image->move($up_location,$img_name);

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
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);
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
}
