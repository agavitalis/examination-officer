@extends('layouts.master')
    
    @section('sidebar')
         @include('partials.admin.sidebar')
    @endsection

    @section('breadcrom')
         @include('partials.admin.breadcrom')
    @endsection

    @section('content')
        
        <hr class="box-border">
        <!--Info will be displayed here-->
        @include('partials.admin.alert')

        <div class="row">

            <div class="col col-md-4">
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-border">
                    <div class="box-header with-border">
                        <h3 class="box-title">Assign Courses to Lecturers</h3>
                    </div>
                        <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form">
                            <!-- text input -->
                            {{ csrf_field() }}
                            <!-- input states -->
                            <div class="form-group input-group-md has-success">
                                <select name ='lecturer' id = 'lecturer' required="" class="form-control form-margin">
                                    <option disabled selected>Select Lecturer</option>
                                    @foreach($lecturers as $lecturer)
                                    <option value ="{{$lecturer->username.'ID:'.$lecturer->name}}">{{$lecturer->name.'    ID: '.$lecturer->username }}</option>
                                    @endforeach
                                </select>
                                <select name ='course' id = 'course' required="" class="form-control form-margin">
                                    <option disabled selected>Select Course</option>
                                    @foreach($courses as $course)
                                    <option value ='{{$course->course_code}}'>{{$course->course_code}}</option>
                                    @endforeach
                                </select> 
                                 <select name ='session' id = 'session' required="" class="form-control form-margin">
                                    <option disabled selected>Select Session</option>
                                    @foreach($sessions as $session)
                                    <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                                    @endforeach
                                </select> 
                                <select name ='level' id = 'level' required="" class="form-control form-margin">
                                    <option disabled selected>Select Level</option>
                                    @foreach($levels as $level)
                                    <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                    @endforeach
                                </select>
                                <select name ='semester' id = 'semester' required="" class="form-control form-margin">
                                    <option disabled selected>Select Semester</option>
                                    @foreach($semesters as $semester)
                                    <option value ='{{$semester->semester_value}}'>{{$semester->semester_name}}</option>
                                    @endforeach
                                </select>                     
                                <div class="checkbox icheck">
                                    <label>Make Course Co-ordinator:
                                    NO: <input type="radio"  name="coordinator" value="0" id="coordinator">
                                    YES: <input type="radio"  name="coordinator" value="1" id="coordinator">
                                    </label>
                                </div>
                                <span class="input-group-btn ">
                                    <button type="button" id="assign-course" class="btn btn-success btn-flat pull-right"><i class="fa fa-edit"></i>Assign Course!</button>
                                </span>
                            </div>
                        
                            <div class="error hidden error-div alert alert-danger ">                                    
                                    <p id="error"></p>
                            </div>
                       
                        </form>
                                 <!-- <form action="/admin/assigncourses" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="action" value="register_lecturer">
                                    <input type="text" class="form-control form-margin" name='lecturer_name' required=""  placeholder="Lecturer Full Name">
                                    
                                    
                                    <input type="submit" value="ddd">
                                </form> -->
                    </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col col-md-8">
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-border">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manage Courses Assigned to Lecturers</h3>
                    </div>
                        <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Course Code</th>
                                    <th>Session</th>
                                    <th>Level</th>
                                    <th>Semester</th>                 
                                    <th>Is Co-ordinator</th>
                                    <th>Unassign</th>
                                
                                </tr>
                            </thead>
                            <tbody id="list-lect">            
                                @foreach($assigned_courses as $assign)
                                    <tr>
                                        <th title="{{$assign->lecturer_id}}">{{$assign->lecturer_name}}</th>
                                        <td>{{$assign->course_code}}</td>
                                        <td>{{$assign->session}}</td>
                                        <td>{{$assign->level}}</td>
                                        <td>{{$assign->semester}}</td>
                                        @if($assign->coordinator == 1)
                                        <td><button disabled=""  class=" btn btn-success btn-flat"><i class="fa fa-user"></i>   Co-ordinator</button></td>
                                        
                                        @else
                                        <td><button data-id="{{$assign->lecturer_id}}" data-name="{{$assign->lecturer_name}}" data-code="{{$assign->course_code}}" data-session="{{$assign->session}}" data-level="{{$assign->level}}" class="make-coordinator btn btn-info btn-flat"><i class="fa fa-edit"></i>Make Co-ordinator</button></td>
                                        
                                        @endif
                                        <td><button  data-id="{{$assign->lecturer_id}}" data-name="{{$assign->lecturer_name}}" data-code="{{$assign->course_code}}" data-session="{{$assign->session}}" data-level="{{$assign->level}}" class="unassign btn btn-danger btn-flat"><i class="fa fa-trash"></i>Unassign</button></td>
                                    </tr>
                                @endforeach                
                                                     
                            </tbody>
                            
                        </table>             
   
                        <div class="error-div">
                            <p class="assign-message text-center  alert alert-danger hidden"></p>
                        </div>  
                    </div>
                        <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>
         @include('partials.admin.assigncourses_modal')
    @endsection

    @section('myscripts')

        <script src="{{asset('js/myscripts/admin.assigncourses.js')}}"></script>
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
        <script>
        $(function () {
            $("#example1").DataTable();
        });
        </script>
        <!-- iCheck -->
        <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
        <script>
        $(function () {
            $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
            });
        });
        </script>

    @endsection