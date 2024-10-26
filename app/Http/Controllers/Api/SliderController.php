<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all()->map(function($slider) {
            return [
                'id' => $slider->id,
                'slider_name' =>$slider->slider_name,
                'slider_image' => asset('public/storage/'.$slider->slider_image),
            ];
        });
        return response()->json([
            'Success' => true,
           'message' => 'Data Fetched Successfully',
           'data' => $sliders],200);
    }

}
