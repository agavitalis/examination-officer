@extends('layouts.master')

  @section('sidebar')
    @include('partials.admin.sidebar')
  @endsection

  @section('breadcrom')
    @include('partials.admin.breadcrom')
  @endsection


  @section('content')

    <!-- =========================================================== -->

        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No of Students</span>
                <span class="info-box-number">{{$students}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      Number of registered students
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-graduation-cap"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">No of lecturers</span>
                <span class="info-box-number">{{$lecturers}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      Number of registered lecturers
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Courses</span>
                <span class="info-box-number">{{$courses}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      Number of courses offered
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-files-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Results</span>
                <span class="info-box-number">{{$results}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                    <span class="progress-description">
                      Number of Students Uploaded
                    </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->



        <!-- Automatic element centering -->
        <div class="lockscreen-wrapper">
          <div class="lockscreen-logo">
            <a href="/"><b>Welcome to the Department</b><br> Result Portal</a>
          </div>
          <!-- User name -->
          <div class=" d-name lockscreen-name">{{Auth::user()->name}}</div>

          <!-- START LOCK SCREEN ITEM -->
          <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Image">
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form class="lockscreen-credentials">
              <div class="input-group">
                <input type="password" disabled=true class="form-control" placeholder="Auth: Admin">

                <div class="input-group-btn">
                  <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
              </div>
            </form>
            <!-- /.lockscreen credentials -->

          </div>
          <!-- /.lockscreen-item -->
          <div class="help-block text-center">
            We are glad to have you back, How have you been  
          </div>
          <div class="text-center">
            <a href="#">Center of Excellence</a>
          </div>
          <div class="lockscreen-footer text-center">
            Department of <i class="fa fa-love"></i><a href="#">Electronic Engineering, UNN </a>
          </div>
        </div>
        <!-- /.center -->
  @endsection
