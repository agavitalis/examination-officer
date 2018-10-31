<?php

namespace App\Http\Controllers;

Use Illuminate\Http\Request;
Use Validator;
Use Response;
Use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\User;
Use App\Models\Session;
Use App\Models\Semester;
Use App\Models\Level;
Use App\Models\Course;
Use App\Models\Lecturer;
Use App\Models\Student;
Use App\Models\AssignedCourse;
Use App\Models\AssignedLevel;
Use App\Models\excelforlecturer;
Use App\Models\excelforstudent;
Use App\Models\Admin;
use Auth;
Use Excel;
class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminGuard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    protected function dashboard()
    {
        $students=DB::table('students')->get()->count();
        $lecturers=DB::table('lecturers')->get()->count();
        $courses=DB::table('courses')->get()->count();
        $results=DB::table('results')->get()->count();

         return view('admin.dashboard',compact('students','lecturers','courses','results'));
    }

    protected function semestersession(Request $request)
    {
        if($request->isMethod('GET')){

            //get all in session table
            $data = Session::all();
            $semesters = Semester::all();

            //get the semester and session
            $current_session=DB::table('sessions')->where('current_session',1)->first();
            $current_semester=DB::table('semesters')->where('current_semester',1)->first();
            //return view('admin.updatecourse', compact('course'));

            //dd($current_session);

            return view('admin.semestersession',compact('data', 'current_session','current_semester','semesters'));
        }
        elseif($request->isMethod('POST')){

            if( $request->action == 'create'){

                    $rules = array(
                    'session_name' => 'required|unique:sessions',
                    );

                    $validator = Validator::make(Input::all(), $rules);
                    if ($validator->fails()) {
                        return Response::json(array(

                                'errors' => $validator->getMessageBag()->toArray(),
                        ));
                    } else {
                        $data = new Session();
                        $data->session_name = $request->session_name;
                        $data->current_session = 0;
                        $data->save();

                        return response()->json($data);
                    }

            }elseif($request->action == 'edit'){

                    $data = Session::find($request->id);
                    $data->session_name = $request->session_name;
                    $data->save();

                    return response()->json($data);

            }elseif($request->action == 'delete'){

                    Session::find($request->id)->delete();

                    return response()->json();



            }elseif($request->action == 'current'){
                    //change the old session to 0
                   try{
                    $current_session=DB::table('sessions')->where('current_session',1)->first();
                    // echo($current_session);
                    $current_session_id = Session::find($current_session->id);
                    // // console.log($current_session_id);
                    $current_session_id->current_session = 0;
                    $current_session_id->save();
                   }finally{
                    //update the new one to 1
                    $data = Session::find($request->id);
                    $data->current_session = 1;
                    $data->save();
                    return response()->json($data);
                   }

             }elseif($request->action == 'setsemester'){
                //change the old one
                DB::table('semesters')->where(['current_semester'=>1])->update(['current_semester'=> 0]);
               //set the new one
               DB::table('semesters')->where(['semester_value'=>$request->semester_value])->update(['current_semester'=> 1]);

               return Response::json(array('success' => 'Current Semester Updated Successfully' ));



            }
            else{
                return Response::json(array('error' => 'An error occured, Current Semester Not Set' ));

            }



        }
    }

    protected function levelcourse(Request $request)
    {
        if($request->isMethod('GET')){
            $levels = Level::all();
            $courses = Course::all();
            $semesters = Semester::all();


            return view('admin.levelcourse',compact('levels','courses','semesters'));
        }
        elseif($request->isMethod('POST')){

            if($request->action == 'newlevel'){

                    $rules = array(
                    'level_name' => 'required|unique:levels',
                    );

                    $validator = Validator::make(Input::all(), $rules);
                    if ($validator->fails()) {
                        return Response::json(array(

                                'errors' => $validator->getMessageBag()->toArray(),
                        ));
                    }else{
                        $newlevel = new Level();
                        $newlevel->level_name = $request->level_name;
                        $newlevel->save();

                        return response()->json($newlevel);
                    }


            }
            else if($request->action == 'delete_level'){
                Level::find($request->id)->delete();

                return response()->json($request);

            }
           else if($request->action == 'addcourse'){

                $rules = array(
                'course_code' => 'required|unique:courses',
                );

                $validator = Validator::make(Input::all(), $rules);
                if ($validator->fails()) {
                    return Response::json(array(

                            'errors' => $validator->getMessageBag()->toArray(),
                    ));
                }else{

                    $newcourse = new Course();

                    $newcourse->course_code = $request->course_code;
                    $newcourse->course_title = $request->course_title;
                    $newcourse->level = $request->course_level;
                    $newcourse->semester =$request->course_semester;
                    $newcourse->unit =$request->unit;
                    $newcourse->status =$request->status;


                    $newcourse->save();

                    return response()->json($newcourse);

                }

            }
            else if($request->action == 'course_detail'){

                $rules = array(
                'course_code' => 'required',
                );

                $validator = Validator::make(Input::all(), $rules);
                if ($validator->fails()) {
                    return Response::json(array(

                            'errors' => $validator->getMessageBag()->toArray(),
                    ));
                }else{

                        $course_detail= DB::table('courses')->where('course_code',$request->course_code)->first();
                        return response()->json($course_detail);

                }

            }
            else if($request->action == 'edit_course'){

                $course = Course::find($request->course_code);

               // $course->course_code = $request->course_code;
                $course->course_title = $request->course_title;
                $course->level = $request->course_level;
                $course->semester = $request->course_semester;
                $course->unit = $request->course_unit;
                $course->status = $request->status;

                $course->save();

                return response()->json($course);

            }
            elseif ($request->action == 'delete_course') {

                try{
                     Course::find($request->course_code)->delete();
                }
               finally{
                    return response()->json($request);
               }


            }


        }
    }

    protected function registerlecturer(Request $request)
    {
        if($request->isMethod('GET')){
            $lecturers = Lecturer::all();

            return view('admin.lecturerreg',compact('lecturers'));
        }
        else if($request->isMethod('POST')){

            if($request->action == 'register_lecturer'){

                  $rules = array(
                    'username' => 'required|unique:lecturers',
                    'email' => 'required|unique:lecturers',
                    'username' => 'required|unique:users',
                    'email' => 'required|unique:users',
                    );

                    $validator = Validator::make(Input::all(), $rules);
                    if ($validator->fails()) {
                        return Response::json(array(

                                'errors' => $validator->getMessageBag()->toArray(),
                        ));
                    }
                     else {

                        //register him in the Lecturer table
                        $newlecturer = new Lecturer();
                        $newlecturer->name = $request->name;
                        $newlecturer->username =$request->username;
                        $newlecturer->email = $request->email;

                        $newlecturer->save();

                        //Register him in the User table

                        $newUser = new User();
                        $newUser->name = $request->name;
                        $newUser->username = $request->username;
                        $newUser->email = $request->email;
                        $newUser->password = bcrypt('lecturer101');
                        $newUser->user = "lecturer";

                        $newUser->save();

                    //  dd($newlecturer);

                        return response()->json('$request');
                    }

            }
            elseif($request->action =="lecturer_details"){

                $lecturer_details= DB::table('lecturers')->where('username',$request->username)->first();
                return response()->json($lecturer_details);
            }
            else if($request->action == "edit_lecturer"){

                //edit in the lecturer table
                $lecturer = Lecturer::find($request->username);

                $lecturer->name = $request->name;
                $lecturer->email = $request->email;

                $lecturer->save();


                //edit in the user table
                $user = User::find($request->username);

                $user->name = $request->name;
                $user->email = $request->email;

                $user->save();

                return response()->json($lecturer);

            }
             elseif ($request->action == 'delete_lecturer') {

                try{
                     Lecturer::find($request->username)->delete();
                     User::find($request->username)->delete();
                }
               finally{
                    return response()->json($request);
               }


            }




        }
    }

    //I registered lecturers using excel
    public function get_lecturer_excel(Request $request, $type)
    {
        $data=DB::table('excelforlecturers')->get()->toArray();
        $data = excelforlecturer::get()->toArray();
        return Excel::create('reg_lecturers_format', function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
            {
            $sheet->fromArray($data);
            });
        })->download($type);


    }

    //here I read the excel file
    public function upload_lecturer_excel(Request $request)
    {

        if($request->hasFile('excel_lecturers')){
            $path = $request->file('excel_lecturers')->getRealPath();
            $data = Excel::load($path)->get();
            if($data->count()){

              //check what this guy is uploading for me
                $checkss[] = $data->getHeading();
                if(!in_array('username',$checkss[0]) || !in_array('name',$checkss[0]) || !in_array('email',$checkss[0])){
                  return back()->with('error','Please use the sample templete, to upload your values');

                }
                //check for duplicate username and email
                foreach ($data as $key => $value)
                {
                    $user=DB::table('users')->where(['username'=>$value->username])->get()->count();
                    $lecturer=DB::table('lecturers')->where(['username'=>$value->username])->get()->count();

                   if($user > 0 || $lecturer > 0)
                   {
                       return back()->with('error','Registraion Number:'. $value->username .' already exist in the system (Duplicate registration number not allowed)');
                   }

                   $user_e=DB::table('users')->where(['email'=>$value->email])->get()->count();
                   $lecturer_e=DB::table('lecturers')->where(['email'=>$value->email])->get()->count();

                   if($user_e > 0 || $lecturer_e > 0)
                   {
                       return back()->with('error','Email:'. $value->email .' already exist in the system (Duplicate Email not allowed)');
                   }

                }

               //prepare the data for the database
                foreach ($data as $key => $value)
                {
                    $users[] = ['name' => $value->name, 'username' => $value->username,
                    'email' => $value->email,'password'=> bcrypt("lecturer101"),
                    'user' =>"lecturer"];

                    $lecturers[] = ['name' => $value->name, 'username' => $value->username,
                    'email' => $value->email
                    ];


                }

                // 'name','username','gender','class','level','session','term'
                if(!empty($users)){
                    DB::table('users')->insert($users);
                    DB::table('lecturers')->insert($lecturers);
                    //dd('Insert Record successfully.');
                    return back()->with('success','Lecturers\'s Records successfully recorded.');
                }
                else{
                     return back()->with('info','Please Check Your File, File seems to be empty.');

                }
            }
        }
        else
        {
             return back()->with('error','Please Check Your File, Ensure You Use Our Sample Templete.');
        }

    }


    protected function registerstudent(Request $request)
    {
        if($request->isMethod('GET')){
            $students = Student::all();
            $sessions = Session::all();
            $levels = Level::all();

            return view('admin.studentreg',compact('students','sessions','levels'));
        }
        else if($request->isMethod('POST')){

            if($request->action == 'register_student'){

                  $rules = array(
                    'username' => 'required|unique:students',
                    'email' => 'required|unique:students',
                    'username' => 'required|unique:users',
                    'email' => 'required|unique:users',
                    );

                    $validator = Validator::make(Input::all(), $rules);
                    if ($validator->fails()) {
                        return Response::json(array(

                            'errors' => $validator->getMessageBag()->toArray(),
                        ));
                    }
                     else {

                        $newstudent = new Student();
                        $newstudent->name = $request->name;
                        $newstudent->username =$request->username;
                        $newstudent->email = $request->email;
                        $newstudent->entry_mode = $request->mode;
                        $newstudent->session_admitted = $request->session_admitted;
                        $newstudent->level_admitted = $request->level_admitted;
                        $newstudent->current_level = $request->current_level;

                        $newstudent->save();

                        $newUser = new User();
                        $newUser->name = $request->name;
                        $newUser->username = $request->username;
                        $newUser->email = $request->email;
                        $newUser->password = bcrypt('student101');
                        $newUser->user = "student";

                        $newUser->save();


                    // dd($newlecturer);

                        return Response::json($request);
                    }

            }
            elseif($request->action =="student_details"){

                $student_details= DB::table('students')->where('username',$request->username)->first();
                return response()->json($student_details);
            }
            else if($request->action == "edit_student"){

                //edit the student table
                $student = Student::find($request->username);

                $student->name = $request->name;
                $student->email = $request->email;

                $student->save();

                 //edit in the user table
                $user = User::find($request->username);

                $user->name = $request->name;
                $user->email = $request->email;

                $user->save();

                return response()->json($lecturer);

                return response()->json($student);

            }
             elseif ($request->action == 'delete_student') {

                try{
                     Student::find($request->username)->delete();
                     User::find($request->username)->delete();
                }
               finally{
                    return response()->json($request);
               }


            }




        }
    }

    //I registered students using excel
    public function get_students_excel(Request $request, $type)
    {
        $data=DB::table('excelforstudents')->get()->toArray();
        $data = excelforstudent::get()->toArray();
        return Excel::create('reg_students_format', function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
            {
            $sheet->fromArray($data);
            });
        })->download($type);

    }

    //I read the data here
    public function upload_students_excel(Request $request)
    {

        if($request->hasFile('excel_students')){
            $path = $request->file('excel_students')->getRealPath();
            $data = Excel::load($path)->get();
            if($data->count()){
                //check what this guy is uploading for me
                $checkss[] = $data->getHeading();

                  // if(!in_array('username',$checkss)){
                  //     dd($checkss[0]);
                  // }
                if(!in_array('username',$checkss[0]) || !in_array('name',$checkss[0]) || !in_array('email',$checkss[0]) ||!in_array('current_level',$checkss[0]) || !in_array('level_admitted',$checkss[0]) || !in_array('session_admitted',$checkss[0]) ){
                  return back()->with('error','Please use the sample templete, to upload your values');

                }
                //$data->getHeading()[0]);
                 //check for duplicate username
                foreach ($data as $key => $value)
                {
                    $users=DB::table('users')->where(['username'=>$value->username])->get()->count();
                    $students=DB::table('students')->where(['username'=>$value->username])->get()->count();

                   if($users > 0 || $students > 0)
                   {
                       return back()->with('error','Registraion Number:'. $value->username .' already exist in the system(Duplicate registration number not allowed)');
                   }

                   $users_e=DB::table('users')->where(['email'=>$value->email])->get()->count();
                   $students_e=DB::table('students')->where(['email'=>$value->email])->get()->count();

                  if($users_e > 0 || $students_e > 0)
                  {
                      return back()->with('error','Email:'. $value->email .' already exist in the system(Duplicate Email not allowed)');
                  }

                }

                //prepare for database
                foreach ($data as $key => $value)
                {



                    $userss[] = ['name' => $value->name, 'username' => $value->username,
                    'email' => $value->email,'password'=> bcrypt("student101"),
                    'user' =>"student"];

                    $studentss[] = ['name' => $value->name, 'username' => $value->username,
                    'email' => $value->email,'entry_mode' => $value->mode,'session_admitted'=>$value->session_admitted,
                    'level_admitted'=>$value->level_admitted,'current_level'=>$value->current_level ];


                }

                // 'name','username','gender','class','level','session','term'
                if(!empty($userss)){
                    DB::table('users')->insert($userss);
                    DB::table('students')->insert($studentss);
                    //dd('Insert Record successfully.');
                    return back()->with('success','Students Records successfully recorded.');
                }
                else{
                     return back()->with('info','Please Check Your File, File seems to be empty.');

                }
            }
        }
        else
        {
             return back()->with('error','Please Check Your File, Ensure You Use Our Sample Templete.');
        }

    }

    protected function assigncourses(Request $request){
        if($request->isMethod('GET')){

            //get all in lecturers
            $lecturers = Lecturer::all();
            $courses = Course::all();
            $assigned_courses = AssignedCourse::all();
            $sessions = Session::all();
            $levels = Level::all();
            $semesters = Semester::all();
            return view('admin.assigncourses', compact('lecturers','courses','assigned_courses','sessions','levels','semesters'));

        }
        elseif($request->isMethod('POST') ){

            if($request->action == 'assigncourse'){

                //splits the cocastinated string
                $lecturer = explode("ID:", $request->lecturer);

                //checks for the guy in the db
                $courses_assigned=DB::table('assigned_courses')->where([
                'course_code'=>$request->course,'lecturer_id'=> $lecturer[0],
                'level' =>$request->level, 'session' =>$request->session])->get();

                 //check if the course have already a coordinator
                $courses_cor=DB::table('assigned_courses')->where([
                'course_code'=>$request->course,'coordinator'=>1,
                'level' =>$request->level, 'session' =>$request->session])->get();



                if($courses_assigned->count()){

                    //he has already been assigned the course
                     return Response::json(array('message'=>$lecturer[1].'  already assigned this course, you can make him a coordinator instead'));


                }
                elseif ($request->coordinator == 1 && $courses_cor->count() ) {
                     //THis course already have a coordinator
                     return Response::json(array('message'=>'This course, already have a coordinator, kindly check your assignments'));

                }else {
                        //assign him this course
                        $assign = new AssignedCourse();

                        $assign->lecturer_id = $lecturer[0];
                        $assign->lecturer_name = $lecturer[1];
                        $assign->course_code = $request->course;
                        $assign->semester = $request->semester;
                        $assign->level = $request->level;
                        $assign->session = $request->session;
                        $assign->department = "xxx";
                        $assign->coordinator = $request->coordinator;

                        $assign->save();

                        return response()->json($request);
                }






            }
            elseif($request->action == 'coordinator'){

                $coordinators=DB::table('assigned_courses')->where([
                'course_code'=>$request->course_code,
                'level' =>$request->level, 'session' =>$request->session ,'coordinator'=> 1 ])->get();

                if($coordinators->count()){
                    //exists, so change him first and assingn the new guy coordinator
                     DB::table('assigned_courses')->where([
                     'course_code'=>$request->course_code,
                    'level' =>$request->level, 'session' =>$request->session])->update(['coordinator'=> 0]);

                    //assign the new guy
                     DB::table('assigned_courses')->where([
                    'lecturer_id'=>$request->lecturer_id, 'course_code'=>$request->course_code,
                    'level' =>$request->level, 'session' =>$request->session])->update(['coordinator'=> 1]);


                    return Response::json(array('message' => ' Previous Coordiantor Changed, and '.$request->lecturer_name.'  successfully made coordinator of the course  '.$request->course_code  ));

                }else{
                    //doesnt exist, so go ahead and assign the coordinator
                    DB::table('assigned_courses')->where([
                    'lecturer_id'=>$request->lecturer_id, 'course_code'=>$request->course_code,
                    'level' =>$request->level, 'session' =>$request->session])->update(['coordinator'=> 1]);

                     return Response::json(array('message' => $request->lecturer_name.'  successfully made coordinator of the course  '.$request->course_code ));
                }


            }
              elseif($request->action == 'delete'){
                   //doesnt exist, so go ahead and assign the coordinator
                    DB::table('assigned_courses')->where([
                    'lecturer_id'=>$request->lecturer_id, 'course_code'=>$request->course_code,
                    'level' =>$request->level, 'session' =>$request->session])->delete();

                     return Response::json(array('message' => $request->lecturer_name.'  successfully unassigned the course  '.$request->course_code ));

              }
        }

    }

    protected function assignstudents(Request $request){
       if($request->isMethod('GET')){

            //get all in lecturers
            $lecturers = Lecturer::all();
            $sessions = Session::all();
            $levels = Level::all();
            $advicers = AssignedLevel::all();
            return view('admin.assignstudents', compact('lecturers','sessions','levels','advicers'));

        }
        elseif($request->isMethod('POST') ){

            if($request->action == 'assignstudents'){

                //splits the cocastinated string
                $lecturer = explode("ID:", $request->lecturer);

                //checks for the guy in the db
                $courses_levels=DB::table('assigned_levels')->where([
                'level' =>$request->level, 'session' =>$request->session])->get();




                if($courses_levels->count()){

                    //he has already been assigned the course
                     return Response::json(array('message'=>'The Level selected have an academic advicer already assigned'));


                }
                else {
                        //assign him this course
                        $assign = new AssignedLevel();

                        $assign->lecturer_id = $lecturer[0];
                        $assign->lecturer_name = $lecturer[1];
                        $assign->level = $request->level;
                        $assign->session = $request->session;


                        $assign->save();

                         return Response::json(array('success'=>'Lecturer successfully assigned as '.$request->level.' Level academic advicer'));

                }


            }


            elseif($request->action == 'delete'){
                //doesnt exist, so go ahead and assign the coordinator
                DB::table('assigned_levels')->where([
                'lecturer_id'=>$request->lecturer_id,
                'level' =>$request->level, 'session' =>$request->session])->delete();

                    return Response::json(array('message' => $request->lecturer_name.'  successfully unassigned the academic advicer'));

            }
        }

    }

    protected function approveresults(Request $request){
      if($request->isMethod('GET')){


            $results = DB::table('results')->where(['approved'=>0])->groupBy('uploaded_by')->get();
            //get the courses the students registered, that are not yet approved
            //$courses = DB::table('registered_courses')->where(['session'=>$assigned_level->session,'level'=>$assigned_level->level,'approved'=>0])->groupBy('username')->get();


            return view('admin.approveresults', compact('results'));

        }
        elseif($request->isMethod('POST') ){

            if ($request->action == "reject") {

                DB::table('results')->where(['uploaded_by'=>$request->lecturer,'level' =>$request->level, 'session' =>$request->session,'semester'=>$request->semester, 'course_code'=>$request->course_code,'approved'=>0])->delete();

                return Response::json(array('success' => 'Rejected Results Successfully Deleted' ));
            }
            elseif ($request->action == "approve") {

                DB::table('results')->where(['uploaded_by'=>$request->lecturer,'level' =>$request->level, 'session' =>$request->session,'semester'=>$request->semester, 'course_code'=>$request->course_code,'approved'=>0])->update(['approved'=>1]);

                return Response::json(array('success' => 'Results Successfully approved' ));
            }
            elseif($request->action == "view"){
                $results = DB::table('results')->where(['uploaded_by'=>$request->lecturer,'level' =>$request->level, 'session' =>$request->session,'semester'=>$request->semester, 'course_code'=>$request->course_code,'approved'=>0])->get();
                return Response::json($results);
            }


        }

    }

    protected function viewresults(Request $request){
      if($request->isMethod('GET')){

            $sessions = Session::all();
            $courses = Course::all();
            $first_course = DB::table('courses')->latest()->first();
            $first_session = DB::table('sessions')->latest()->first();

            if($first_session == null || $first_course == null){

                return back()->with('error','Courses and Sessions are not set, how can you then view a result ') ;
            }
            else{

                $results = DB::table('results')->where(['course_code'=>$first_course->course_code,'session'=>$first_session->session_name])->get();

                return view('admin.viewresults',compact('sessions','courses','results'));

            }

         }
         elseif($request->isMethod('POST')){

            if($request->action == 'reject'){

                //unapprove th selected courses
                DB::table('results')->where(['username'=>$request->username,'level' =>$request->level, 'session' =>$request->session,'semester'=>$request->semester])->update(['approved'=> 0]);;

                return Response::json(array('success'=>'You have Successfully Revoked your approval, now lwcturer can edit this result'));

            }
            else if($request->action == 'others'){

                $sessions = Session::all();
                $courses = Course::all();

                $results = DB::table('results')->where(['course_code'=>$request->course_code,'session'=>$request->session])->get();

                return view('admin.viewresults',compact('sessions','courses','results'));
            }
         }
    }


    protected function promote_students(Request $request){
      if($request->isMethod('GET')){

         $levels = DB::table('levels')->get();

         return view('admin.promote_students',compact('levels'));
      }
     if($request->isMethod('POST')){
        if($request->action == 'promote_level'){

            DB::table('students')->where(['current_level'=>$request->from_level])->update(['current_level'=>$request->to_level]);
            return Response::json(array('message' => 'Students successfully promoted'));

        }
        elseif($request->action == 'demote_level'){

            DB::table('students')->where(['current_level'=>$request->from_level])->update(['current_level'=>$request->to_level]);
            return Response::json(array('message' => 'Students successfully deomoted'));

        }
        elseif($request->action == 'promote_per'){

            $count =DB::table('students')->where(['username'=>$request->reg_no])->get()->count();

            if($count< 1){
                return Response::json(array('message' => 'Student with the given Registration Number not found'));

            }

            DB::table('students')->where(['username'=>$request->reg_no])->update(['current_level'=>$request->to_level]);
            return Response::json(array('message' => 'Students successfully promoted'));

        }
        elseif($request->action == 'demote_per'){

            $count =DB::table('students')->where(['username'=>$request->reg_no])->get()->count();

            if($count< 1){
                return Response::json(array('message' => 'Student with the given Registration Number not found'));

            }

            DB::table('students')->where(['username'=>$request->reg_no])->update(['current_level'=>$request->to_level]);
            return Response::json(array('message' => 'Students successfully demoted'));

        }

     }

    }



    protected function password_reset(Request $request){
      if($request->isMethod('GET')){

         return view('admin.reset_password');
      }
     if($request->isMethod('POST')){
        //dd($request);
        if($request->usertype == 'student'){
            $count= DB::table('users')->where(['username'=>$request->reg_no])->get()->count();

            if($count < 1){
                return back()->with('error',' We could not find a user with that username');

            }else{

                DB::table('users')->where(['username'=>$request->reg_no])->update(['password'=> bcrypt('student101')]);
                return back()->with('success',' Student password successfully reseted');

            }

        }
        elseif($request->usertype == 'lecturer'){

            $count= DB::table('users')->where(['username'=>$request->reg_no])->get()->count();

            if($count < 1){
                return back()->with('error',' We could not find a user with that username');

            }else{
            DB::table('users')->where(['username'=>$request->reg_no])->update(['password'=> bcrypt('lecturer101')]);
            return back()->with('success',' Lecturer password successfully reseted');

            }
        }
        else{

            return back()->with('error',' Unknown Command');
        }

     }

    }

    protected function generate_classlist(Request $request){
      if($request->isMethod('GET')){

         $levels = DB::table('levels')->get();
         $sessions = DB::table('sessions')->get();

         return view('admin.generate_classlist_dialog',compact('levels','sessions'));
      }
     if($request->isMethod('POST')){

        if($request->action == 'current')
        {
           $level=$request->level;
           $session=$request->session;
           //dd($request);
           $students = DB::table('students')->where(['current_level'=>$request->level])->get();
           return view('admin.generate_classlist',compact('students','session','level'));
        }
        elseif($request->action == 'year')
        {
           // dd($request);
           $level=$request->level;
           $session=$request->session;
           //dd($request);
           $students = DB::table('students')->where(['level_admitted'=>$request->level,'session_admitted'=>$request->session])->get();
           return view('admin.generate_classlist',compact('students','session','level'));
        }

     }

    }

    protected function admin_profile(Request $request)
    {
        if($request->isMethod('GET')){

            $admin = Admin::find(Auth::user()->username);

           //dd($admin);
            $current_session = DB::table('sessions')->where(['current_session'=>1])->first();
            $current_semester = DB::table('semesters')->where(['current_semester'=>1])->first();

            return view('admin.profile',compact('admin','current_session','current_semester'));
        }
    }



}
