
@extends('layouts.master')

    @section('sidebar')
    @include('partials.lecturer.sidebar')
    @endsection

    @section('breadcrom')
    @include('partials.lecturer.breadcrom')
    @endsection

    @section('content')  
    <!-- Automatic element centering-->
        <hr class="box-border">
        <div class="row">

            <div class="col col-md-12">
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-border">
                    <div class="box-header with-border">
                        <h3 class="box-title">Courses assigned to you</h3>
                    </div>
                        <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Semester</th>
                                    <th>Level</th>
                                    <th>Session</th>
                                    <th>Coordinator</th>
                                    <th>Lecturers assigned with me</th>
                                    
                                                                   
                                </tr>
                            </thead>
                            <tbody id="list-lect">            
                             @foreach($assigned_courses as $assigned_course)
                                <tr>
                                    <td>{{$assigned_course->course_code}}</td>
                                    <td>{{$assigned_course->semester}}</td>
                                    <td>{{$assigned_course->level}} Level</td>
                                    <td>{{$assigned_course->session}}</td>
                                    <td>
                                        @if($assigned_course->coordinator == 1)
                                            <button class=" btn btn-success btn-flat disabled"><i class="fa fa-tick"></i>YES</button>
                                        @else
                                            <button class=" btn btn-info btn-flat disabled"><i class="fa fa-tick"></i>NO</button>
                                        @endif
                                    </td>
                                   
                                    <td>
                                         <div class="btn-group">
                                            <button type="button"  class=" view btn btn-info dropdown-toggle" data-toggle="dropdown"  data-semester="{{$assigned_course->semester}}" data-level="{{$assigned_course->level}}" data-session="{{$assigned_course->session}}" data-course="{{$assigned_course->course_code}}">
                                            <i class="fa fa-eye"></i>                                              
                                            View
                                            </button>
                                            <ul class="dropdown-menu">
                                           
                                            </ul>
                                        </div>
                                        
                                    </td>

                                </tr>
                             @endforeach               
                                                     
                            </tbody>
                            
                        </table>             
   
                        <div class="error-div">
                            <p class="detail-error text-center  alert alert-danger hidden"></p>
                        </div>  
                    </div>
                        <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>
  

    @endsection  

    @section('myscripts')
        <script src="{{asset('js/myscripts/lecturer.courses.js')}}"></script>
        <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
        <script>
        $(function () {
            $("#example1").DataTable();
        });
        </script>
       

    @endsection