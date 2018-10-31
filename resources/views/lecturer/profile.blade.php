
@extends('layouts.master')

  @section('sidebar')
    @include('partials.lecturer.sidebar')
  @endsection

  @section('breadcrom')
    @include('partials.lecturer.breadcrom')
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
                  <strong> Phone: {{$lecturer->phone}}</strong>

            </div>

            <div class="col-sm-6 col-xs-6  pull-right">
              <strong> Session Registered: {{$lecturer->session_admitted}}</strong> <br>
              <strong> State Of Origin: {{$lecturer->state_of_origin}}</strong> <br>
              <strong> LGA: {{$lecturer->lga}}</strong> <br>
              <strong> Nationality: {{$lecturer->country}}</strong> <br>
             </div>
          </address>

        <!-- /.col -->

      </div>
      <!-- /.row -->

      <!-- Table row -->

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
                        @if($lecturer->profile_pic != null)
                        <img src="/storage/profile_images/{{$lecturer->profile_pic}}" alt="{{$lecturer->profile_pic}}">
                        @else
                        <img src="../../dist/img/user1-128x128.jpg">
                        @endif
                      </div>
                      <!-- /.lockscreen-image -->

                      <!-- lockscreen credentials (contains the form) -->
                      <form class="lockscreen-credentials">
                        <div class="input-group">
                          <input type="password" disabled=true class="form-control" placeholder="Auth: Lecturer">

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
          <a href="/lecturer_edit_profile" class="btn btn-info"><i class="fa fa-pencil"></i> Edit Profile</a>
          <a href="#" target="_blank" class=" btn btn-default"><i class="fa fa-print"></i> Print</a>

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



  @endsection
