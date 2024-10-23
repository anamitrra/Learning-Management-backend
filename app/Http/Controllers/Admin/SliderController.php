<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SliderController extends Controller
{

    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slider_name' => 'required|string|max:255',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('slider_image')->store('sliders', 'public');

        Slider::create([
            'slider_name' => $request->slider_name,
            'slider_image' => $path,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider created successfully.');
    }


    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'slider_name' => 'required|string|max:255',
            'slider_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('slider_image')) {
            if ($slider->slider_image && Storage::disk('public')->exists($slider->slider_image)) {
                Storage::disk('public')->delete($slider->slider_image);
            }

            $path = $request->file('slider_image')->store('sliders', 'public');
            $slider->slider_image = $path;
        }

        $slider->slider_name = $request->slider_name;
        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider soft deleted successfully.');
    }

    public function restore(Slider $slider)
    {
        $slider->restore();
        return redirect()->route('slider.index')->with('success', 'Slider restored successfully.');
    }


    public function forceDelete($id)
    {
        $slider = Slider::withTrashed()->findOrFail($id);

        if ($slider->slider_image && Storage::disk('public')->exists($slider->slider_image)) {
            Storage::disk('public')->delete($slider->slider_image);
        }

        $slider->forceDelete();
        return redirect()->route('slider.index')->with('success', 'Slider permanently deleted.');
    }
}
