<?php

namespace App\Http\Controllers;

use App\Models\AppliedCourse;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
class DashBoardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $current_date=date('Y-m-d');
        $courses = Course::where('reg_end','>=',$current_date)->get();
        return view('dashboard',compact('courses'));
    }

    public function status()
    {
        $user_id=auth()->user()->id;
        

        $status = DB::table('applied_courses')
        ->select(
            'applied_courses.status',
            'users.name',
            'courses.course'
        )
        ->leftJoin('users', 'users.id', '=', 'applied_courses.user_id')
        ->leftJoin('courses', 'courses.id', '=', 'applied_courses.course_id')
        ->where('applied_courses.user_id', $user_id)
        ->get();
        
        return view('status',compact('status'));
    }

    public function course()
    {
        
        $courses = Course::all();
        return view('course',compact('courses'));
    }

    public function student_course(Request $request)
    {
        $request->validate([
            'course' => 'required',
        ]);
        $aplied_course=new AppliedCourse();
        $aplied_course->user_id=auth()->user()->id;
        $aplied_course->course_id=$request->course;
        $aplied_course->save();
        return redirect()->route('dashboard')->with('success','Course Applied Successfully');
    }

    public function save_course(Request $request)
    {
        $request->validate([
            'course'=>'required',
            'description'=>'required',
            'reg_end'=>'required',
        ]);

        $course = new Course;
        $course->user_id=auth()->user()->id;
        $course->course = $request->course;
        $course->description = $request->description;
        $course->reg_end = $request->reg_end;
        $course->save();
        return redirect('/course')->with('success', 'Course has been added');
    }

    public function application()
    {
        $status = DB::table('applied_courses')
        ->select(
            
            'users.name',
            'users.state',
            'users.city',
            'users.qualification',
            'applied_courses.id',
            'applied_courses.course_id',
            'applied_courses.status'
        )
        ->leftJoin('users', 'users.id', '=', 'applied_courses.user_id')
        ->get();
         
        return view('application',compact('status'));
    }

    public function application_edit($id)
    {
        $status = DB::table('applied_courses')
        ->select(
            
            'users.name',
            'applied_courses.id',
            'applied_courses.status',
        )
        ->leftJoin('users', 'users.id', '=', 'applied_courses.user_id')
        ->leftJoin('courses', 'courses.id', '=', 'applied_courses.course_id')
        ->where('applied_courses.id', $id)
        ->first();
        return response()->json($status);
    }

    public function application_update(Request $request,$id)
    {
        $request->validate([
            'status'=>'required',
        ]);
        $aplied_course=AppliedCourse::find($id);
        $aplied_course->status=$request->status;
        $aplied_course->save();
        return response()->json(['success'=>'Status Updated Successfully']);
    }
}
