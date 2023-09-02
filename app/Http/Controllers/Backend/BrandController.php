<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brands'));
    } // End Method 
    
    public function AddBrand(){
        return view('backend.brand.brand_add');
   } // End Method 

   public function StoreBrand(Request $request){

    $image = $request->file('brand_image');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
    $save_url = 'upload/brand/'.$name_gen;

    Brand::insert([
        'brand_name' => $request->brand_name,
        'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
        'brand_image' => $save_url, 
    ]);

   $notification = array(
        'message' => 'Brand Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('all.brand')->with($notification); 

}// End Method 






}