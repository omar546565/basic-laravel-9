<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function AllCategory(){
        $categories=Category::latest()->paginate(5);

       /* $categories=DB::table('categories')
            ->join('users','categories.user_id','users.id')
            ->select('categories.*','users.name')
            ->latest()->paginate(5);*/

          return view('admin.category.index',compact('categories'));
    }
    public function AddCategory(Request $request){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:25',
        ],
        [
            'category_name.required'=> 'هذا الحقل مطلوب',
            'category_name.unique'=> 'هذا الاسم موجود',
            'category_name.max'=> 'يجب أن يكون أقل من 25 حرف'
        ]
        );

//insert1
          Category::create([
             'user_id' => Auth::user()->id,
             'category_name' => $request->category_name,
          ]);

//insert2
         /* Category::insert([
             'user_id' => Auth::user()->id,
             'category_name' => $request->category_name,
             'created_at' => Carbon::now(),
          ]);*/

//insert3
      /*  $Category = new Category;
        $Category->category_name = $request->category_name;
        $Category->user_id = Auth::user()->id;
        $Category->created_at = Carbon::now();
        $Category->save();*/

//insert3
       /* $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);*/

          return Redirect()->back()->with('success','تم الإدخال بنجاح');

    }
    public function UpdateCategory(Request $request,$id){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:25',
        ],
        [
            'category_name.required'=> 'هذا الحقل مطلوب',
            'category_name.unique'=> 'هذا الاسم موجود',
            'category_name.max'=> 'يجب أن يكون أقل من 25 حرف'
        ]
        );
        $update = Category::find($id)->update([
            'user_id' => Auth::user()->id,
            'category_name' => $request->category_name,
        ]);

          return Redirect()->route('all.category')->with('success','تم التحديث بنجاح');

    }
    public function EditCategory($id){
        $categories=Category::find($id);

        return view('admin.category.edit',compact('categories'));
    }
}
