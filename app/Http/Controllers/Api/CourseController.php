<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    
    public function index()
        {
            $courses = Course::all()->map(function($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'description' => $course->description,
                    'image' => asset('storage/'.$course->image),
                ];
            });
            return response()->json([
                'success' => true,
                'message' => 'Data Fetched Successfully',
               'slider' => $courses]);
        }
}
