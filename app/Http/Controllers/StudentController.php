<?php

namespace App\Http\Controllers;

Use Illuminate\Http\Request;
Use DB;
Use Auth;
Use Response;
Use App\Models\Level;
Use App\Models\Session;
Use App\Models\Semester;
Use App\Models\Student;
Use App\Models\Course;
Use App\Models\RegisteredCourse;



class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('studentGuard');
    }
    protected function dashboard(){

        $registered_courses=DB::table('registered_courses')->where(['username'=>Auth::user()->username])->get()->count();
        $results=DB::table('results')->where(['username'=>Auth::user()->username])->get()->count();

         return view('student.dashboard',compact('registered_courses','results'));
    }

    protected function mycourses(Request $request){
        if($request->isMethod('GET')){

            $levels = Level::all();
            return view('student.mycourses_dialog',compact('levels'));


        }elseif($request->isMethod('POST'))
        {
            $courses_1 = DB::table('courses')->where(['semester'=>'1','level'=>$request->level])->get();
            $courses_2 = DB::table('courses')->where(['semester'=>'2','level'=>$request->level])->get();
            $level = $request->level;
            return view('student.mycourses',compact('courses_1','courses_2','level'));

        }

    }

    protected function registered_courses(Request $request){
        if($request->isMethod('GET')){

            $sessions = Session::all();
            $semesters = Semester::all();

            return view('student.registered_courses_dialog',compact('sessions','semesters'));


        }
        elseif($request->isMethod('POST'))
        {
            $student = Student::find(Auth::user()->username);
            $current_session = DB::table('sessions')->where(['current_session'=>1])->first();

            $registerd_courses = DB::table('registered_courses')->where(['session'=>$request->session,'semester'=>$request->semester,'username'=>Auth::user()->username])->get();
            $session = $request->session;
            $semester = $request->semester;
            //dd($registerd_courses);
            return view('student.registered_courses',compact('student','registerd_courses','session','semester','current_session'));

        }
        // return view('student.registered_courses');
    }

    protected function register_courses(Request $request){
         if($request->isMethod('GET')){

           $session = DB::table('sessions')->where(['current_session'=>1])->first();

            $semesters = Semester::all();

            return view('student.register_courses_dialog',compact('session','semesters'));


        }
         elseif($request->isMethod('POST'))
        {
            if($request->action =="show"){

                $student = Student::find(Auth::user()->username);
                $courses = DB::table('courses')->where(['level'=>$student->current_level,'semester'=>$request->semester])->get();
                $session = $request->session;
                $semester = $request->semester;
                //dd($co);
                return view('student.register_courses',compact('courses','session','semester'));
            }
            elseif($request->action =="register"){
                 //validate and ensure the dude only registers one course per session
                foreach($request->course_chosen as $course_code){

                    $registerd_courses = DB::table('registered_courses')->where(['username'=>Auth::user()->username,'session'=>$request->session,'semester'=>$request->semester,'course_code'=>$course_code])->count();

                    //no duplicateregistration allowed
                   if($registerd_courses > 0){

                    return back()->with('error', $course_code.' have already been registered. duplicates not allowed');
                   }

                }


                // loop through the courses selected
                foreach($request->course_chosen as $course_code){

                    //get the courses
                    $course = Course::find($course_code);
                    //get student student
                    $student = Student::find(Auth::user()->username);
                    //start the registration
                    $register = new RegisteredCourse();
                    $register->student_name = Auth::user()->name;
                    $register->username = Auth::user()->username;
                    $register->course_code = $course->course_code;
                    $register->course_title = $course->course_title;
                    $register->unit = $course->unit;
                    $register->semester = $request->semester;
                    $register->level = $student->current_level;
                    $register->session = $request->session;
                    $register->approved = 0;

                    $register->save();


                }

                    $student = Student::find(Auth::user()->username);
                    $current_session = DB::table('sessions')->where(['current_session'=>1])->first();


                    //after successful registration, show what he registered
                    $registerd_courses = DB::table('registered_courses')->where(['username'=>Auth::user()->username,'session'=>$request->session,'semester'=>$request->semester,'approved'=>0])->get();
                    $total_units = DB::table('registered_courses')->where(['username'=>Auth::user()->username,'session'=>$request->session,'semester'=>$request->semester,'approved'=>0])->pluck('unit')->sum();

                    //dd($total_units);
                    //dd($registerd_courses);
                    $session = $request->session;
                    $semester = $request->semester;
                    //dd($co);
                   return view('student.registered_courses',compact('total_units','registerd_courses','session','semester','current_session','student'));



            }else{
                return back()->with('error','Unrecognized input');
            }


        }


    }

    protected function edit_registered_dialog(Request $request, $id=null){
       if($request->isMethod('GET')){
            if($id == null){
            $sessions = Session::all();
            $semesters = Semester::all();

            return view('student.edit_registered_dialog',compact('sessions','semesters'));
            }
            else{
             $courses = DB::table('registered_courses')->where(['id'=>$id])->delete();
              return back()->with('success','Course successfully unregistered');
            }
       }
       elseif($request->isMethod('POST')){
        //check if it is show
        if($request->action == 'show'){

            $student = Student::find(Auth::user()->username);
            $courses = DB::table('registered_courses')->where(['username'=>$student->username,'semester'=>$request->semester,'session'=>$request->session,'approved'=>0])->get();
            $session = $request->session;
            $semester = $request->semester;

            return view('student.edit_registered',compact('session','semester','courses'));

        }


       }

    }


    protected function view_results(Request $request){

        if($request->isMethod('GET')){

            $sessions = Session::all();
            $semesters = Semester::all();

            return view('student.view_result_dialog',compact('sessions','semesters'));


        }
        elseif($request->isMethod('POST'))
        {
            $selection = DB::table('results')->where(['session'=>$request->session,'semester'=>$request->semester,'username'=>Auth::user()->username]);
            $results = $selection->get();
            $session = $request->session;
            $semester = $request->semester;
            //dd($registerd_courses);
            //do the guys gp

            //$total_courses = $selection->count();

            $total_unit = $selection->pluck('unit_load')->sum();

            if($total_unit < 1){
                return back()->with('error','You didnt register any course for the selected session');
            }

            $total_point = $selection->pluck('point')->sum();
            $gp  = $total_point / $total_unit;

            return view('student.results',compact('results','session','semester','gp'));

        }
        // return view('student.results');
    }

    protected function result_statement(){
         //I assumed normal,nigerian university system
        $total_point5 = $total_point4 = $total_point3 = $total_point2 = $total_point1 = 0;
        $total_unit5 =  $total_unit4 =  $total_unit3 = $total_unit2 = $total_unit1 = 0;
        $results11 = 0;


        //first year,first semseter
        $selection11 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>100 ,'semester'=>1 ]);
        if($selection11->count() != 0){

            $results11 = $selection11->get();

                //do the guys gp
                $total_unit11 = $selection11->pluck('unit_load')->sum();
                $total_point11 = $selection11->pluck('point')->sum();

            //first year,second semseter
            $selection12 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>100 ,'semester'=>2 ]);
            $results12 = $selection12->get();

                //do the guys gpa
                $total_unit12 = $selection12->pluck('unit_load')->sum();
                $total_point12 = $selection12->pluck('point')->sum();

                //cgpa
                $total_unit1 = $total_unit11 + $total_unit12;
                $total_point1 = $total_point11 + $total_point12;
                $gp1 = $total_point1 / $total_unit1;

        }

        //second year,first semseter
        $selection21 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>200 ,'semester'=>1 ]);

        if($selection21->count() != 0){

            $results21 = $selection21->get();

                //do the guys gp
                $total_unit21 = $selection21->pluck('unit_load')->sum();
                $total_point21 = $selection21->pluck('point')->sum();

            //second year,second semseter
            $selection22 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>200 ,'semester'=>2 ]);
            $results22 = $selection22->get();

                //do the guys gpa
                $total_unit22 = $selection22->pluck('unit_load')->sum();
                $total_point22 = $selection22->pluck('point')->sum();

                //cgpa
                $total_unit2 = $total_unit21 + $total_unit22;
                $total_point2 = $total_point21 + $total_point22;
                $gp2 = $total_point2 / $total_unit2;

        }

         //third year,first semseter
        $selection31 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>300 ,'semester'=>1 ]);

        if($selection31->count() != 0){

            $results31 = $selection31->get();

                //do the guys gp
                $total_unit31 = $selection31->pluck('unit_load')->sum();
                $total_point31 = $selection31->pluck('point')->sum();

            //third year,second semseter
            $selection32 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>300 ,'semester'=>2 ]);
            $results32 = $selection32->get();

                //do the guys gpa
                $total_unit32 = $selection32->pluck('unit_load')->sum();
                $total_point32 = $selection32->pluck('point')->sum();

                //cgpa
                $total_unit3 = $total_unit31 + $total_unit32;
                $total_point3 = $total_point31 + $total_point32;
                $gp3 = $total_point3 / $total_unit3;

        }


        //fouth year,first semseter
        $selection41 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>400 ,'semester'=>1 ]);

        if($selection21->count() != 0){

            $results41 = $selection41->get();

                //do the guys gp
                $total_unit41 = $selection41->pluck('unit_load')->sum();
                $total_point41 = $selection41->pluck('point')->sum();

            //fouth year,second semseter
            $selection42 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>400 ,'semester'=>2 ]);
            $results42 = $selection42->get();

                //do the guys gpa
                $total_unit42 = $selection42->pluck('unit_load')->sum();
                $total_point42 = $selection42->pluck('point')->sum();

                //cgpa
                $total_unit4 = $total_unit41 + $total_unit42;
                $total_point4 = $total_point41 + $total_point42;
                $gp4 = $total_point4 / $total_unit4;

        }


         //fifth year,first semseter
        $selection51 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>500 ,'semester'=>1 ]);

        if($selection51->count() != 0){

            $results51 = $selection51->get();

                //do the guys gp
                $total_unit51 = $selection51->pluck('unit_load')->sum();
                $total_point51 = $selection51->pluck('point')->sum();

            //fifth year,second semseter
            $selection52 = DB::table('results')->where(['username'=>Auth::user()->username,'level'=>500 ,'semester'=>2 ]);
            $results52 = $selection52->get();

                //do the guys gpa
                $total_unit52 = $selection52->pluck('unit_load')->sum();
                $total_point52 = $selection52->pluck('point')->sum();

                //cgpa
                $total_unit5 = $total_unit51 + $total_unit52;
                $total_point5 = $total_point51 + $total_point52;
                $gp5 = $total_point5 / $total_unit5;

        }

        if(($total_unit5 + $total_unit4 + $total_unit3 + $total_unit2 + $total_unit1 ) < 1){
                return back()->with('error','You didnt register any course for the selected session');
            }

        //calculate cgpa
        $total_cgpa = ($total_point5 + $total_point4 + $total_point3 + $total_point2 + $total_point1 ) /  ($total_unit5 + $total_unit4 + $total_unit3 + $total_unit2 + $total_unit1 ) ;
            return view('student.result_statement',compact('results11','results12','results21','results22',
            'results31','results32','results41','results42','results51','results52','gp1','gp2','gp3','gp4','gp5','total_cgpa'));


    }

    protected function profile(Request $request){
         if($request->isMethod('GET')){

            $student = Student::find(Auth::user()->username);
            $current_session = DB::table('sessions')->where(['current_session'=>1])->first();
            $current_semester = DB::table('semesters')->where(['current_semester'=>1])->first();

            return view('student.profile',compact('student','current_session','current_semester'));
        }

    }

    protected function edit_profile(Request $request){
        if($request->isMethod('GET')){

            $student = Student::find(Auth::user()->username);

            return view('student.edit_profile',compact('student'));
        }
        elseif($request->isMethod('POST')){


            $student = Student::find(Auth::user()->username);

            $student->name = $request->name;
            $student->phone = $request->phone;
            $student->lga = $request->lga;
            $student->state_of_origin = $request->state;
            $student->country = $request->country;
            $student->about = $request->about;

            $student->update();

            return back()->with('success','Profile Successfully Updated');
        }

}
//this is to edit the profile_pic
protected function edit_profile_pic(Request $request){
    if($request->isMethod('GET')){

        $student = Student::find(Auth::user()->username);

        return view('student.edit_profile',compact('student'));
    }
    elseif($request->isMethod('POST')){

        //get the filename with the extension
        $filenamewithExt=$request->file('profile_pic')->getClientOriginalName();
        //get just the $filename
        $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
        $extension=$request->file('profile_pic')->getClientOriginalExtension();
        //the file to store
        $filenameTostore=$filename.'_'.time().$extension;
        //upload the image
        $path=$request->file('profile_pic')->STOREAS('public/profile_images',$filenameTostore);

        $student = Student::find(Auth::user()->username);

        $student->profile_pic=$filenameTostore;

        $student->update();

        return back()->with('success','Profile Picture Successfully Updated');
    }


}
}
