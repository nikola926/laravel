<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function AllBrand() {

    	$brands = Brand::latest()->paginate(5);

    	return view('admin.brand.index', compact('brands'));

    }

    public function AddBrand(Request $request) {
    	$validated = $request->validate([
	        'brand_name' => 'required|unique:brands|max:255',
	        'brand_image' => 'required|mimes:jpg,jpeg,png'
		    ],
			[
	        'brand_name.required' => 'This field can`t be empty!',
	        'brand_name.max' => 'Category less then 255Chars!',
	    ]);

	    $brand_image = $request->file('brand_image');

	    $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
	    Image::make($brand_image)->resize(300, 200)->save('image/brand/'.$name_gen);

	    $last_image = 'image/brand/'.$name_gen;


	    // $name_gen = hexdec(uniqid());
	    // $image_ext = strtolower($brand_image->getClientOriginalExtension());
	    // $img_name = $name_gen.'.'.$image_ext;
	    // $up_location = 'image/brand/';
	    // $last_image = $up_location.$img_name;
	    // $brand_image->move($up_location,$img_name);


	    Brand::insert([
	    	'brand_name' => $request->brand_name,
	    	'brand_image' => $last_image,
	    	'created_at' => Carbon::now()
	    ]);


	    return Redirect()->back()->with('success', 'Brand Inserted Successfully');

    }

    public function Edit($id) {
    	$brands = Brand::find($id);

    	return view('admin.brand.edit', compact('brands'));

    }

    public function Update(Request $request , $id) {

    	$validated = $request->validate([
	        'brand_name' => 'required|max:255',
	        'brand_image' => 'mimes:jpg,jpeg,png'
		    ],
			[
	        'brand_name.required' => 'This field can`t be empty!',
	        'brand_name.max' => 'Category less then 255Chars!',
	    ]);

	    $old_image = $request->old_image;

	    $brand_image = $request->file('brand_image');

	    if($brand_image){

		    $name_gen = hexdec(uniqid());
		    $image_ext = strtolower($brand_image->getClientOriginalExtension());
		    $img_name = $name_gen.'.'.$image_ext;
		    $up_location = 'image/brand/';
		    $last_image = $up_location.$img_name;
		    $brand_image->move($up_location,$img_name);

		    unlink($old_image);
		    Brand::find($id)->update([
		    	'brand_name' => $request->brand_name,
		    	'brand_image' => $last_image,
		    	'created_at' => Carbon::now()
		    ]);

	    }else{

		    Brand::find($id)->update([
		    	'brand_name' => $request->brand_name,
		    	'created_at' => Carbon::now()
		    ]);

	    }


	    return Redirect()->back()->with('success', 'Brand Updated Successfully');

    }

    public function Delete($id) {

    	$get_image = Brand::find($id);
    	$old_image = $get_image->brand_image;
    	unlink($old_image);

    	Brand::find($id)->delete();

    	return Redirect()->back()->with('success', 'Brand Deleted Successfully');

    }

    //Multi image

    public function Multipic() {

    	$images = Multipic::all();
    	return view('admin.multipic.index', compact('images'));

    }

    public function AddMultiImg(Request $request) {
        
        $image = $request->file('image');

        foreach ($image as $singl_img) {

		    $name_gen = hexdec(uniqid()).'.'.$singl_img->getClientOriginalExtension();
		    Image::make($singl_img)->resize(300, 300)->save('image/multi/'.$name_gen);

		    $last_image = 'image/multi/'.$name_gen;


		    Multipic::insert([
		    	'image' => $last_image,
		    	'created_at' => Carbon::now()
		    ]);

		}//Endforeach


	    return Redirect()->back()->with('success', 'Brand Inserted Successfully');

    }
}









