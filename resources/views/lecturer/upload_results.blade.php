@extends('layouts.master')

  @section('sidebar')
    @include('partials.lecturer.sidebar')
  @endsection

  @section('breadcrom')
    @include('partials.lecturer.breadcrom')
  @endsection

  @section('content')

    <!-- =========================================================== -->
        <hr class="box-border">
        <!--Info will be displayed here-->
        @include('partials.admin.alert')

        <div class="row">
         
          <div class="col col-md-8 col-md-offset-2">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="lockscreen-wrapper box box-border text-center">
              <div class="box-header with-border">
                <h3 class="box-title">Download  Sample Result Sheet and Upload Results</h3>
                <h6 class="box-title"><i>(only coordinators can upload results)</i></h6>
              </div>
              <!-- /.box-header -->
              <div class=" box-body">
                          
                        <div class="form-group">
                            <span class="input-group-btn ">
                              <a href="{{ url('get_result_excel/xlsx') }}"><button class="btn btn-info pull-left ">Download Sample(XLSX)</button></a> 
                            </span>
                            <span class="input-group-btn ">
                              <a href="{{ url('get_result_excel/csv') }}"><button class="btn btn-info pull-right ">Download Sample(CSV)</button></a> 
                            </span>
                        </div>  
                        <hr  class="box-border">

                        <form  action="{{ URL::to('upload_result_excel') }}"  method="post" enctype="multipart/form-data" >
                            <!-- text input -->
                            {{ csrf_field() }}
                            <!-- input states -->
                            <div class="form-group input-group-md has-success">
                               
                                <select name ='session' id = 'session' required="" class="form-control form-margin">
                                    <option disabled selected>Select Session</option>
                                     @foreach($sessions as $session)
                                    <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                                    @endforeach
                                    
                                </select>
                                <select name ='semester' id = 'semester' required="" class="form-control form-margin">
                                    <option disabled selected>Select Semester</option>
                                     @foreach($semesters as $semester)
                                    <option value ='{{$semester->semester_value}}'>{{$semester->semester_name}}</option>
                                    @endforeach
                                    
                                </select>
                                <select name ='course' id = 'course' required="" class="form-control form-margin">
                                    <option disabled selected>Select Course</option>
                                    @foreach($courses as $course)
                                    <option value ='{{$course->course_code}}'>{{$course->course_code}}</option>
                                    @endforeach
                                    
                                </select>
                                <span class="input-group-btn ">
                                  <input type="file" accept=".xlsx, .xls, .csv" name="student_results" required="" class="btn btn-info btn-sm">
                                </span>
                                <span class="input-group-btn ">
                                    <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-print"></i>Upload My Results</button>
                                </span>
                            </div>
                     
                        </form>
                                
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        
         
          <!-- /.col -->
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

$(document).ready( function () {
	$('#example1').DataTable( {
		dom: 'T<"clear">lfrtip'
	} );
} );

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