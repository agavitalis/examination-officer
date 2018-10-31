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

            <div class="col col-md-5">
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-border">
                    <div class="box-header with-border">
                        <h3 class="box-title">Assign Academic Advicers</h3>
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
                                    <option value ='{{$lecturer->username.'ID:'.$lecturer->name}}'>{{$lecturer->name.'  ID:   '.$lecturer->username}}</option>
                                    @endforeach
                                </select>
                                <select name ='level' id = 'level' required="" class="form-control form-margin">
                                    <option disabled selected>Select Level</option>
                                    @foreach($levels as $level)
                                    <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                    @endforeach
                                </select>                  
                                <select name ='session' id = 'session' required="" class="form-control form-margin">
                                    <option disabled selected>Select Session</option>
                                    @foreach($sessions as $session)
                                    <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                                    @endforeach
                                </select> 
                                <span class="input-group-btn ">
                                    <button type="button" id="assign-students" class="btn btn-success btn-flat pull-right"><i class="fa fa-edit"></i>Assign Students!</button>
                                </span>
                            </div>
                             <div class="error">
                                <p class="error-message text-center  alert alert-danger hidden"></p>
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

            <div class="col col-md-7">
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-border">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manage Students Assigned to Lecturers</h3>
                    </div>
                        <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Lecturer</th>
                                    <th>Reg No</th>
                                    <th>Level</th>
                                    <th>Session</th>
                                    <th>Unassign</th>
                                
                                </tr>
                            </thead>
                            <tbody id="list-lect">            
                              @foreach($advicers as $assign)
                                <tr>
                                   
                                    <td>{{$assign->lecturer_name}}</td>
                                    <td>{{$assign->lecturer_id}}</td>
                                    <td>{{$assign->level}}</td>
                                    <td>{{$assign->session}}</td>
                                    <td><button data-id="{{$assign->lecturer_id}}" data-name="{{$assign->lecturer_name}}"  data-session="{{$assign->session}}" data-level="{{$assign->level}}" class="academic btn btn-danger btn-flat"><i class="fa fa-edit"></i>Unassign</button></td>
                                     
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
         @include('partials.admin.assignstudents_modal')
    @endsection

    @section('myscripts')

        <script src="{{asset('js/myscripts/admin.assignstudents.js')}}"></script>
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
        <script>
        $(function () {
            $("#example1").DataTable();
        });
        </script>
        
    @endsection