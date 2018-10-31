<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Validator;
Use Response;
Use Illuminate\Support\Facades\Input;
use Auth;
use DB;
Use App\Models\Session;
Use App\Models\Semester;
Use App\Models\Level;
Use App\Models\Course;
Use App\Models\Lecturer;
Use App\Models\excelforresult;
Use Excel;

class LecturerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lecturerGuard');
    }

    protected function dashboard()
    {
        $assigned_levels=DB::table('assigned_levels')->where(['lecturer_id'=>Auth::user()->username])->get()->count();
        $assigned_courses=DB::table('assigned_courses')->where(['lecturer_id'=>Auth::user()->username])->get()->count();
        $results=DB::table('results')->where(['uploaded_by'=>Auth::user()->username])->get()->count();

         return view('lecturer.dashboard',compact('assigned_levels','assigned_courses','results'));
    }

    protected function lecturer_courses(Request $request)
    {   if($request->isMethod('GET')){
            $assigned_courses = DB::table('assigned_courses')->where('lecturer_id',Auth::User()->username)->get();
            return view('lecturer.courses', compact('assigned_courses'));
        }
        elseif($request->isMethod('POST')){
             $other_lecturers = DB::table('assigned_courses')->where(['course_code'=>$request->course,'session'=>$request->session,'level'=>$request->level,'semester'=>$request->semester])->get();
             return Response::json($other_lecturers);

        }
    }

    protected function course_students(Request $request)
    {
        if($request->isMethod('GET')){

            //get my first course in the table
            $my_course = DB::table('assigned_courses')->where('lecturer_id',Auth::User()->username)->latest()->first();

             if($my_course ==null){
                return back()->with('error','you have no course assigned to you');
            }
            //get all the courses toenable him choose
            $courses = DB::table('assigned_courses')->where('lecturer_id',Auth::User()->username)->get();
           //get all the sessions
            $sessions = Session::all();

            $students = DB::table('registered_courses')->where(['course_code'=>$my_course->course_code,'session'=>$my_course->session])->get();
            //dd($students);
            return view('lecturer.course_students',compact('students','my_course','courses','sessions'));
        }
        elseif ($request->isMethod('POST')) {

            //fetch the courses based on selection
            $students = DB::table('registered_courses')->where(['course_code'=>$request->course_code,'session'=>$request->session])->get();
            //get my first course in the table
            $my_course = DB::table('registered_courses')->where(['course_code'=>$request->course_code,'session'=>$request->session])->first();


            //get all the courses to enable him choose
            $courses = DB::table('assigned_courses')->where('lecturer_id',Auth::User()->username)->get();
           //get all the sessions
            $sessions = Session::all();
            return view('lecturer.course_students',compact('students','my_course','courses','sessions'));
        }
        else{

            return back()->with('error','We don\'t know what you are talking about');
        }

    }

    protected function lecturer_students(Request $request)
    {
        if($request->isMethod('GET')){
            $assigned_levels = DB::table('assigned_levels')->where('lecturer_id',Auth::User()->username)->get();

            return view('lecturer.students',compact('assigned_levels'));
        }
        elseif($request->isMethod('POST')){

           $assigned_students = DB::table('students')->where(['current_level'=>$request->level])->get();
           return view('lecturer.mystudents_list',compact('assigned_students'));


        }
    }

    protected function unapproved_student_course(Request $request)
    {
        if($request->isMethod('GET')){
            $assigned_level = DB::table('assigned_levels')->where('lecturer_id',Auth::User()->username)->latest()->first();

            if($assigned_level ==null){
                return back()->with('error','you have no course assigned to you');
            }
            //get the courses the students registered, that are not yet approved
            $courses = DB::table('registered_courses')->where(['session'=>$assigned_level->session,'level'=>$assigned_level->level,'approved'=>0])->groupBy('username')->get();

            return view('lecturer.unapproved', compact('courses'));
        }
        elseif($request->isMethod('POST')){

            //show the details of the registered courses
            if($request->action == 'details'){

                $courses = DB::table('registered_courses')->where(['username'=>$request->username,'semester'=>$request->semester,'session'=>$request->session,'level'=>$request->level,'approved'=>0])->get();

                return Response::json($courses);

            }
            //reject his course registration
            else if($request->action == 'reject'){

                 //reject his courses by assigning approved to 2
                  $courses = DB::table('registered_courses')->where(['username'=>$request->username,'level' =>$request->level, 'session' =>$request->session,'semester'=>$request->semester])->delete();


                return Response::json(array('success'=>'Course Registration Successfully Declined'));

            }
            else if($request->action == 'approve'){
                //loop through the students selected
                foreach($request->student_selected as $student){

                    $courses = DB::table('registered_courses')->where(['username'=>$student])->update(['approved'=>1]);

                }
                return back()->with('success', 'You sucessfully approved the selected registered courses');


            }
        }

    }

    protected function approved_student_course(Request $request)
    {
        if($request->isMethod('GET')){

            $assigned_level = DB::table('assigned_levels')->where('lecturer_id',Auth::User()->username)->latest()->first();

            if($assigned_level ==null){
                return back()->with('error','you have no level assigned to you');
            }
            //get the courses the students registered, that are approved
            $students = DB::table('registered_courses')->where(['session'=>$assigned_level->session,'level'=>$assigned_level->level,'approved'=>1])->groupBy('username')->get();

            //get the whole session and levels to allow him choose
            $sessions = Session::all();
            $levels = DB::table('assigned_levels')->where('lecturer_id',Auth::User()->username)->get();

            return view('lecturer.approved', compact('students','sessions','levels'));
        }
        elseif($request->isMethod('POST')){

            //show the details of the registered courses
            if($request->action == 'details'){

                $courses = DB::table('registered_courses')->where(['username'=>$request->username,'semester'=>$request->semester,'session'=>$request->session,'level'=>$request->level,'approved'=>1])->get();

                return Response::json($courses);

            }
            elseif($request->action == 'others'){


                 //get the courses the students registered, that are approved
                $students = DB::table('registered_courses')->where(['session'=>$request->session,'level'=>$request->level,'approved'=>1])->groupBy('username')->get();

                //get the whole session and levels to allow him choose
                $sessions = Session::all();
                $levels = DB::table('assigned_levels')->where('lecturer_id',Auth::User()->username)->get();

               return view('lecturer.approved', compact('students','sessions','levels'));

            }
        }
    }

    protected function course_results(Request $request)
    {
         if($request->isMethod('GET')){

            $sessions = Session::all();
            $courses = DB::table('assigned_courses')->where(['lecturer_id'=>Auth::User()->username])->get();
            $first_course = DB::table('assigned_courses')->where(['lecturer_id'=>Auth::User()->username])->latest()->first();

            if($first_course ==null){
                return back()->with('error','you have no courses assigned to you');
            }

            $results = DB::table('results')->where(['course_code'=>$first_course->course_code,'session'=>$first_course->session])->get();

            return view('lecturer.mycourse_results',compact('sessions','courses','results'));

         }
         elseif($request->isMethod('POST')){

            if($request->action == 'reject'){

                //reject his courses by assigning approved to 2
                $courses = DB::table('results')->where(['username'=>$request->username,'level' =>$request->level, 'session' =>$request->session,'semester'=>$request->semester])->delete();


                return Response::json(array('success'=>'Result Successfully Deleted'));

            }
            else if($request->action == 'others'){

                $sessions = Session::all();
                $courses = DB::table('assigned_courses')->where(['lecturer_id'=>Auth::User()->username])->get();


                $results = DB::table('results')->where(['course_code'=>$request->course_code,'session'=>$request->session])->get();

                return view('lecturer.mycourse_results',compact('sessions','courses','results'));
            }
         }
    }
    protected function students_results(Request $request)
    {
         if($request->isMethod('GET')){

            $sessions = Session::all();
            $levels = DB::table('assigned_levels')->where(['lecturer_id'=>Auth::User()->username])->get();

            $first_level = DB::table('assigned_levels')->where(['lecturer_id'=>Auth::User()->username])->latest()->first();

            if($first_level ==null){
                return back()->with('error','you are not an academic advicer');
            }

            $results = DB::table('results')->where(['level'=>$first_level->level,'session'=>$first_level->session])->groupBy('username')->get();
            //get the courses the students registered, that are not yet approved
            //$courses = DB::table('registered_courses')->where(['session'=>$assigned_level->session,'level'=>$assigned_level->level,'approved'=>0])->groupBy('username')->get();


            return view('lecturer.mystudents_results',compact('sessions','levels','results'));

         }
         elseif($request->isMethod('POST')){
            if($request->action == 'others'){

                $sessions = Session::all();
                $levels = DB::table('assigned_levels')->where(['lecturer_id'=>Auth::User()->username])->get();


                $results = DB::table('results')->where(['level'=>$request->level,'session'=>$request->session])->groupBy('username')->get();
                //get the courses the students registered, that are not yet approved
                //$courses = DB::table('registered_courses')->where(['session'=>$assigned_level->session,'level'=>$assigned_level->level,'approved'=>0])->groupBy('username')->get();


                return view('lecturer.mystudents_results',compact('sessions','levels','results'));
            }
            elseif($request->action == 'details'){

                 $results = DB::table('results')->where(['semester'=>$request->semester,'level'=>$request->level,'username'=>$request->username,'session'=>$request->session])->groupBy('username')->get();
                return Response::json($results);
            }
         }

    }
    protected function upload_results(Request $request)
    {
        if($request->isMethod('GET')){

         $sessions = Session::all();
         $semesters = Semester::all();
         $courses = DB::table('assigned_courses')->where(['lecturer_id'=>Auth::User()->username,'coordinator'=>1])->get();
         return view('lecturer.upload_results',compact('sessions','semesters','courses'));
        }

    }

    protected function classlist(Request $request)
    {
        if($request->isMethod('GET')){

            $sessions = Session::all();
            $levels = Level::all();
            return view('lecturer.classlist',compact('sessions','levels'));

        }
         elseif($request->isMethod('POST')){

           $level=$request->level;
           $session=$request->session;
           $students = DB::table('students')->where(['current_level'=>$request->level])->get();
           return view('lecturer.printclasslist',compact('students','session','level'));


        }
    }

    protected function lecturer_profile(Request $request)
    {
        if($request->isMethod('GET')){

            $lecturer = Lecturer::find(Auth::user()->username);

           // dd($lecturer);
            $current_session = DB::table('sessions')->where(['current_session'=>1])->first();
            $current_semester = DB::table('semesters')->where(['current_semester'=>1])->first();

            return view('lecturer.profile',compact('lecturer','current_session','current_semester'));
        }
    }

    protected function edit_profile(Request $request){
        if($request->isMethod('GET')){

            $lecturer = Lecturer::find(Auth::user()->username);

            return view('lecturer.edit_profile',compact('lecturer'));
        }
        elseif($request->isMethod('POST')){

            $lecturer = Lecturer::find(Auth::user()->username);

            $lecturer->name = $request->name;
            $lecturer->phone = $request->phone;
            $lecturer->lga = $request->lga;
            $lecturer->state_of_origin = $request->state;
            $lecturer->country = $request->country;
            $lecturer->about = $request->about;
            $lecturer->update();

            return back()->with('success','Profile Successfully Updated');
        }


    }

    // to change the lecturer change his profile Picture
    protected function edit_profile_pic(Request $request){
        if($request->isMethod('GET')){

            $lecturer = Lecturer::find(Auth::user()->username);

            return view('lecturer.edit_profile',compact('lecturer'));
        }
        elseif($request->isMethod('POST')){

          // 'profile_pic'->'image|nullable|max:1999';
          if ($request->hasFile('profile_pic')){
            //get the filename with the extension
            $filenamewithExt=$request->file('profile_pic')->getClientOriginalName();
            //get just the $filename
            $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
            $extension=$request->file('profile_pic')->getClientOriginalExtension();
            //the file to store
            $filenameTostore=$filename.'_'.time().$extension;
            //upload the image
            $path=$request->file('profile_pic')->STOREAS('public/profile_images',$filenameTostore);
          }
          else{
            $filenameTostore='user1-128x128.jpg';
          }
            $lecturer = Lecturer::find(Auth::user()->username);

            $lecturer->profile_pic=$filenameTostore;
            $lecturer->update();

            return back()->with('success','Profile Picture Successfully Updated');
        }


    }


    //I registered students using excel
    public function get_result_excel(Request $request, $type)
    {
        $data=DB::table('excelforresults')->get()->toArray();
        $data = excelforresult::get()->toArray();
        return Excel::create('sample_result_sheet', function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
            {
            $sheet->fromArray($data);
            });
        })->download($type);

    }

    //I read the data here
    public function upload_result_excel(Request $request)
    {
        //first check if he is the course coordinator
        $courses = DB::table('assigned_courses')->where(['lecturer_id'=>Auth::User()->username,
        'session'=>$request->session, 'semester'=>$request->semester, 'course_code'=>$request->course,'coordinator'=>1])->count();

        if($courses < 1){
             return back()->with('error','Only Coordinators are allowed to upload Course Results.');
        }
        else{

             if($request->hasFile('student_results')){

                $path = $request->file('student_results')->getRealPath();
                $data = Excel::load($path)->get();
                //to ensure he didnt upload an empty stuff
                if($data->count()){

                  //check what this guy is uploading for me
                    $checkss[] = $data->getHeading();
                    if(!in_array('username',$checkss[0]) || !in_array('name',$checkss[0]) || !in_array('course_code',$checkss[0]) || !in_array('semester',$checkss[0]) || !in_array('session',$checkss[0]) || !in_array('level',$checkss[0]) || !in_array('ca_score',$checkss[0]) || !in_array('exam_score',$checkss[0])){
                      return back()->with('error','Please use the sample templete, to upload your values');

                    }

                    //evaluate his data, to make sure it corresponds with what he selected
                    foreach ($data as $key => $result)
                    {

                        if($result->session != $request->session || $result->semester != $request->semester || $result->course_code != $request->course){
                             return back()->with('error', $result->name.',   result details has conflicting fields with your selections .');
                            //dd($request);
                         }

                    }

                    //check the score to ensure none is above 100 or below 0
                    foreach ($data as $key => $result)
                    {

                        if($result->ca_score > 30 || $result->exam_score > 70 || ($result->ca_score + $result->exam_score) > 100){
                             return back()->with('error', $result->name.',   result grades are out of range');
                        }

                    }

                    //check the whole result ensure all registered for the course,and have duplicate result
                    foreach ($data as $key => $result)
                    {
                        $registered_courses = DB::table('registered_courses')->where(['username'=>$result->username,
                        'session'=>$result->session, 'semester'=>$result->semester, 'course_code'=>$result->course_code,'approved'=>1])->count();

                        $results_table = DB::table('results')->where(['username'=>$result->username,
                        'session'=>$result->session, 'semester'=>$result->semester, 'course_code'=>$result->course_code])->count();


                        if($registered_courses < 1){
                             return back()->with('error', $result->name.',   did not register for the course '.$result->course_code.', thus cannot have a result');
                        }

                        if($results_table  > 0){
                             return back()->with('error', $result->name.',   already has a result on this course '.$result->course_code.'');
                        }

                    }

                    //check for double records in the sheet about to be uploaded
                    $student=array( );
                    foreach ($data as $key => $result)
                    {
                      array_push($student,$result->username);
                    }
                    if(count(array_unique($student)) < count($student))
                    {
                         return back()->with('error','Please Check Your File, There is a duplicate Student Username(Reg No).');
                    }


                    //now save in this array lets get ready for upload
                    foreach ($data as $key => $result)
                    {
                        //check the student admission year
                        $student = DB::table('students')->where(['username'=>$result->username])->first();
                        //dd($student);
                        $admission_year = explode("/", $student->session_admitted);

                        $total_score = $result->exam_score + $result->ca_score;

                        if($total_score >= 70){
                            $grade = "A";
                             $point = 5;
                        }
                        elseif($total_score <= 69 && $total_score >= 60){
                            $grade = "B";
                            $point = 4;
                        }
                        elseif($total_score <= 59 && $total_score >= 50){
                            $grade = "C";
                             $point = 3;

                        }
                        elseif($total_score <= 49 && $total_score >= 45){
                            $grade = "D";
                             $point = 2;
                        }
                        elseif($total_score <= 45 && $total_score >= 40 && $admission_year[0] < 2013){
                            $grade = "E";
                            $point = 1;
                        }
                        else{
                            $grade = "F";
                            $point = 0;
                        }

                        //get the course details
                        $course = DB::table('courses')->where(['course_code'=>$result->course_code])->first();

                        //calculate the point
                        $point_sum = $course->unit * $point;


                        $student_result[] = ['name' => $result->name, 'username' => $result->username ,'course_code' => $result->course_code,
                                        'session' => $result->session,'semester' => $result->semester, 'level' => $result->level,'ca_score' => $result->ca_score,
                                        'exam_score' => $result->exam_score, 'total_score' => $total_score,'uploaded_by' =>Auth::User()->username,
                                        'coordinator'=>Auth::User()->name,'course_title' => $course->course_title,'unit_load' => $course->unit,
                                        'point' => $point_sum,'grade'=>$grade,'approved'=>0];
                    }
                    //dd($student_result);
                    // 'name','username','gender','class','level','session','term'
                    if(!empty($student_result)){
                        DB::table('results')->insert($student_result);

                        return back()->with('success','Students result successfully uploaded, the admin will have to approve it, before students can view it.');
                     }
                    // else{
                    //     return back()->with('info','Please Check Your File, File seems to be empty.');

                    // }
                }
            }
            else
            {
                return back()->with('error','Please Check Your File, Ensure You Use Our Sample Templete.');
            }

        }



    }
}
