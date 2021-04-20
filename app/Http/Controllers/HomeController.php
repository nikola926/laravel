<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //////HOME SLIDER

    public function AllSlider() {

        $sliders = Slider::latest()->paginate(5);

        return view('admin.slider.index', compact('sliders'));

    }

    public function AddSlider() {

        return view('admin.slider.add');

    }

    public function StoreSlider(Request $request) {

        $validated = $request->validate([
            'slider_title' => 'required|max:255',
            'slider_image' => 'required|mimes:jpg,jpeg,png'
            ],
            [
            'slider_title.required' => 'This field can`t be empty!',
            'slider_title.max' => 'Category less then 255Chars!',
        ]);

        $slider_image = $request->file('slider_image');

        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);

        $last_image = 'image/slider/'.$name_gen;


        Slider::insert([
            'title' => $request->slider_title,
            'image' => $last_image,
            'description' => $request->slider_text,
            'created_at' => Carbon::now()
        ]);


        return Redirect()->route('slider.all')->with('success', 'Slider Inserted Successfully');

    }

    public function Edit($id) {
        $sliders = Slider::find($id);

        return view('admin.slider.edit', compact('sliders'));

    }

    public function Update(Request $request, $id) {

        $validated = $request->validate([
            'slider_title' => 'required|max:255',
            'slider_image' => 'mimes:jpg,jpeg,png'
            ],
            [
            'slider_title.required' => 'This field can`t be empty!',
            'slider_title.max' => 'Category less then 255Chars!',
        ]);

        $slider_image = $request->file('slider_image');

        if($slider_image) {

            $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);

            $last_image = 'image/slider/'.$name_gen;


            Slider::find($id)->update([
                'title' => $request->slider_title,
                'image' => $last_image,
                'description' => $request->slider_text,
                'created_at' => Carbon::now()
            ]);

        }else {

            Slider::find($id)->update([
                'title' => $request->slider_title,
                'description' => $request->slider_text,
                'created_at' => Carbon::now()
            ]);

        }


        return Redirect()->route('slider.all')->with('success', 'Slider Updated Successfully');

    }

    public function Delete($id){

        Slider::find($id)->delete();

        return Redirect()->route('slider.all')->with('success', 'Slider Deleted Successfully');

    }

    /////END HOME SLIDER




}
