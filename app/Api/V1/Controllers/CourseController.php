<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;
use App\Course;
use Illuminate\Http\Request;
use App\Jobs\Courses;
use Carbon\Carbon;
use  Maatwebsite\Excel\Facades\Excel as Excel;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return response()->json($courses);

    }

    public function create(Request $request)
    {

      

        try {
            $course = new Course;
            $course->course_title = $request->title;
            $course->course_code = $request->code;
            $course->course_unit = $request->unit;
            $course->save();

        } catch (JWTException $e) {
            throw new HttpException(500);
        }

        return response()
        ->json([
            'status' => 'ok',
                'message' => 'successfully added course'
        ]);

       

       
    }

    public function faker()
    {
       try{
           $job = (new Courses())
           ->delay(Carbon::now()->addMinutes(30));


        dispatch($job);
       }
       catch (JWTException $e) {
            throw new HttpException(500);
        }

        return response()
        ->json([
            'status' => 'ok',
                'message' => 'successfully added courses'
        ]);


    }

    public function download()
    {
        $courses = Course::all();

        return Excel::download($courses, 'course.xlsx');
    }
}
