@extends('layouts.master')

  @section('sidebar')
    @include('partials.student.sidebar')
  @endsection

  @section('breadcrom')
    @include('partials.student.breadcrom')
  @endsection

  @section('content')

    <!-- =========================================================== -->
    <hr class="box-border">
        <!--Info will be displayed here-->
        @include('partials.admin.alert')
		<div class="row">
            <div class="col col-md-12">
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-border">
                <div class="box-header with-border text-center">
                    <h3 class="box-title">Courses you registered for {{$session}} academic session</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Course Title</th>
                        <th>Course Code</th>
                        <th>Unit Load</th>
                        <th>Semester</th>
                        <th>Action</th>               
                    </tr>
                    </thead>
                    <tbody id="list-lect">
                        @foreach($courses as $course)
                        <tr>
                            <td>{{$course->course_title}}</td>
                            <td>{{$course->course_code}}</td>
                            <td>{{$course->unit}}</td>
                            <td>{{$course->semester}}</td>
                            <td><a href="/student_edit_registered/{{$course->id}}"><button class="btn btn-danger ">Unregister</button></a></td>
                                                
                        </tr>                
                        @endforeach                   
                                
                    </tbody>
                    </table>             
                                    
                </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

          <form action="/student/register_courses" method="post">
              
            
					 
          </form>       
              
            
         
         
                  
    </div>
        <!-- /.row -->

    <!-- =========================================================== -->
 
    <!-- interacrive modal here-->
    @include('partials.admin.lecturerreg_modal')
  @endsection

  @section('myscripts')

    <script src="{{asset('js/myscripts/admin.lecturerreg.js')}}"></script>
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