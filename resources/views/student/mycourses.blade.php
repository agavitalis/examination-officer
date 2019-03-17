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
         
          <div class="col col-md-6">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Your {{$level}} Level(1st Semester) Courses</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-responsive table-striped">
                  <thead>
                  <tr>
                      <th>Course Title</th>
                      <th>Course Code</th>
                      <th>Unit Load</th>
                      <th>Status</th>               
                  </tr>
                  </thead>
                  <tbody id="list-lect">
                     @foreach($courses_1 as $course)
                      <tr>
                          <td>{{$course->course_title}}</td>
                          <td>{{$course->course_code}}</td>
                          <td>{{$course->unit}}</td>
                          <td>{{$course->status}}</td>
                                             
                      </tr>                
                    @endforeach                   
                            
                  </tbody>
                </table>             
                                
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

           <div class="col col-md-6">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Your {{$level}} Level(2nd Semester) Courses</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                    <table id="example2" class="table table-bordered table-responsive table-striped">
                    <thead>
                    <tr>
                      <th>Course Title</th>
                      <th>Course Code</th>
                      <th>Unit Load</th>
                      <th>Status</th>                
                    </tr>
                    </thead>
                    <tbody id="list-lect">
                    @foreach($courses_2 as $course)
                      <tr>
                          <td>{{$course->course_title}}</td>
                          <td>{{$course->course_code}}</td>
                          <td>{{$course->unit}}</td>
                          <td>{{$course->status}}</td>
                                             
                      </tr>                
                    @endforeach          
                    </tbody>
                  </table>             
                 
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        
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
      $("#example2").DataTable();

    });
    </script>
    
  @endsection