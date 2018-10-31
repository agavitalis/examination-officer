@extends('layouts.master')

  @section('sidebar')
    @include('partials.student.sidebar')
  @endsection

  @section('breadcrom')
    @include('partials.student.breadcrom')
  @endsection

  @section('content')

        <hr class="box-border">
        <!--Info will be displayed here-->
        @include('partials.admin.alert')

       <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12 text-center course-reg">
          <h2 class="">
            <!-- <i class="fa fa-globe"></i> -->
             Department of Electronc Engineering   
          </h2>
          <small><i>(Center Of Excellence)</i></small>
          <h3>Falculty of Engineering</h3>
          <h4>University of Nigeria, Nsukka</h4>
          <h6>Department Course Registration Form</h6>
        </div>
        
        <!-- /.col -->
      </div>
      <hr>
      <!-- info row -->
      <div class="row invoice-info">
       
       
        <!-- /.colcol-sm-2 col-xs-2 -->
          <address>
            <div class="col-sm-6 col-xs-6  text-right">
          
                  <strong>Name: {{Auth::user()->name}}</strong><br>
                  <strong> Reg No: {{Auth::user()->username}}</strong><br>
                  <strong> Email:{{Auth::user()->email}}</strong><br>
                  <strong> Phone:{{$student->phone}}</strong><br>
                  <strong> Level:{{$student->current_level}}</strong><br>
                  <strong>Session:{{$current_session->session_name}}</strong>
                
            </div>
       
            <div class="col-sm-6 col-xs-6  pull-right">
                  
                <strong>Session Admitted: {{$student->session_admitted}}</strong><br>
                <strong>Level Admitted: {{$student->level_admitted}} Level </strong><br>
                <strong>Entry Mode: {{$student->entry_mode}}</strong><br>
                <strong>State of Origin:{{$student->state_of_origin}}</strong><br>
                <strong>LGA: {{$student->lga}}</strong><br>
                <strong>Nationality: {{$student->country}}</strong>
             </div>
          </address>
       
        <!-- /.col -->
        
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <div class="text-center">
            <i>Course Registration details for
               @if($semester == 1)
                First
               @else
                Second
               @endif  
                semester {{$session}} academic session</i>
          </div>
            <table class="table table-striped table-condensed">
            <thead>
            <tr>
              <th>Course Code</th>
              <th>Course Title</th>
              <th>Unit Load</th>
              <th>Approved</th>
            </tr>
            </thead>
            <tbody>
             @foreach($registerd_courses as $course)

            <tr>
              <td>{{$course->course_code}}</td>
              <td>{{$course->course_title}}</td>
              <td>{{$course->unit}}</td>
              <td><button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button></td>
              
            </tr>
            @endforeach
          
            </tbody>
             <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th>Total:
              @if(isset(total_units)) 
               {{$total_units}}
              @endif
              </th>
              <th></th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        
        <!-- /.col -->
        <div class="col-xs-12">
          <p class="small"><i>SIGN:</i></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Academic Advicer:</th>
                <td></td>
              </tr>
               <tr>
                <th style="width:50%">Head of Department:</th>
                <td></td>
              </tr>
              <tr>
                <th>Faculty Officer:</th>
                <td></td>
              </tr>
             
              <tr>
                <th></th>
                <td></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>
    <!-- /.content -->

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