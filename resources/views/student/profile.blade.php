
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
          <h6>Departmental Profile Form</h6>
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
                  <strong> Phone: {{$student->phone}}</strong> <br>
                  <strong> Current Level: {{$student->current_level}}</strong> <br>
                  @if(isset($current_session->session_name))
                  <strong> Session: {{$current_session->session_name}}</strong>
                  @endif
            </div>

            <div class="col-sm-6 col-xs-6  pull-right">
              <strong> Session Admitted: {{$student->session_admitted}}</strong> <br>
              <strong> Level Admitted: {{$student->level_admitted}}</strong> <br>
              <strong> Entry Mode: {{$student->entry_mode}}</strong> <br>
              <strong> state Of Origin: {{$student->state_of_origin}}</strong> <br>
              <strong> LGA: {{$student->lga}}</strong> <br>
              <strong> National: {{$student->country}}</strong> <br>
             </div>
          </address>

        <!-- /.col -->

      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 ">
          <div class="text-center">
            <i>Profile  details</i>
          </div>

          <!-- Automatic element centering -->
            <div class="lockscreen-wrapper">

              <!-- START LOCK SCREEN ITEM -->
              <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                  @if(isset($student->profile_pic))
                  <img src="/storage/profile_images/{{$student->profile_pic}}" alt="{{$student->profile_pic}}">
                  @else
                  <img src="../../dist/img/user1-128x128.jpg">
                  @endif
                </div>
                <!-- /.lockscreen-image -->

                <!-- lockscreen credentials (contains the form) -->
                <form class="lockscreen-credentials">
                  <div class="input-group">
                    <input type="password" disabled=true class="form-control" placeholder="Auth: Student">

                    <div class="input-group-btn">
                      <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                    </div>
                  </div>
                </form>
                <!-- /.lockscreen credentials -->

              </div>
              <!-- /.lockscreen-item -->
              <div class="help-block text-center">
                About:
              </div>
              <div class="text-center">

              </div>

            </div>
          <!-- /.center -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <hr>
      <div class="row">


      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="/student_edit_profile" class="btn btn-info"><i class="fa fa-pencil"></i> Edit Profile</a>
          <a href="#" target="_blank" class=" btn btn-default"><i class="fa fa-print"></i> Print</a>

        </div>

      </div>
    </section>
    <!-- /.content -->

    <!-- =========================================================== -->


    <!-- interacrive modal here-->
    @include('partials.admin.studentreg_modal')
  @endsection

  @section('myscripts')

    <script src="{{asset('js/myscripts/admin.studentreg.js')}}"></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script>
    $(function () {
      $("#example1").DataTable();

    });
    </script>



  @endsection
