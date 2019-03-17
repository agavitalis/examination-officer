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
          <h6>Department Course Result Details</h6>
        </div>
        
        <!-- /.col -->
      </div>
      <hr>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          <address class="text-right">
            <strong>Name: {{Auth::user()->name}}</strong><br>
            <strong>Reg No: {{Auth::user()->username}}</strong><br>
            <strong>Email:{{Auth::user()->email}}</strong><br>
            <strong>Phone:{{Auth::user()->email}}</strong><br>
            <strong>Level:{{Auth::user()->level}}</strong><br>
            <strong>Session:{{Auth::user()->session}}</strong>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          <address class="text-left">
            <strong>Level Admitted: 100Level </strong><br>
            <strong>Session Admitted: 2013/2014</strong><br>
            <strong>Entry Mode: UTME</strong><br>
            <strong>State of Origin:Enugu State</strong><br>
            <strong>LGA: Igboeze South</strong><br>
            <strong>Nationality: Nigerian</strong>
          </address>
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <div class="text-center">
            <i>Results details for
               @if($semester == 1)
                First
               @else
                Second
               @endif  
                semester {{$session}} academic session</i>
          </div>
            <table class="table table-bordered table-responsive table-striped">            
            <thead>
           
            <tr>
              <th>Course Code</th>
              <th>Course Title</th>
              <th>Unit Load</th>
              <th>CA Score</th>
              <th>Exam Score</th>
              <th>Total Score</th>
              <th>Grade</th>
            </tr>
            </thead>
            <tbody>
             @foreach($results as $result)

            <tr>
              <td>{{$result->course_code}}</td>
              <td>{{$result->course_title}}</td>
              <td>{{$result->unit_load}}</td>
              <td>{{$result->ca_score}}</td>
              <td>{{$result->exam_score}}</td>
              <td>{{$result->total_score}}</td>
              <td>{{$result->grade}}</td>             
            </tr>
            @endforeach
          
            </tbody>
             <tfoot>
            <tr class"info">
              <th></th>
              <th></th>
              <th class"info"><u><i>Semester GPA: {{$gp}}</i></u></th>
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
  


  @endsection