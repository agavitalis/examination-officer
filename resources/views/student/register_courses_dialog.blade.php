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

          <div class="col col-md-8 col-md-offset-2">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="lockscreen-wrapper box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Select Session and Semester to  Register Courses </h3>
              </div>
              <!-- /.box-header -->
              <div class=" box-body">
                    <form  action="/student/register_courses" method="post" role="form">
                            <!-- text input -->
                            {{ csrf_field() }}
                            <!-- input states -->
                            <input type="hidden" name="action" value="show">
                            <div class="form-group input-group-md has-success">

                                <select name ='session' id = 'session' required="" class="form-control form-margin">
                                    <option disabled selected>Select Session</option>
                                    @if(isset($session->session_name))
                                    <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                                    @endif
                                </select>
                                <select name ='semester' id = 'semester' required="" class="form-control form-margin">
                                    <option disabled selected>Select Semester</option>
                                    @foreach($semesters as $semester)
                                    <option value ='{{$semester->semester_value}}'>{{$semester->semester_name}}</option>
                                    @endforeach
                                </select>

                                <span class="input-group-btn ">
                                    <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-print"></i>Register and Print!</button>
                                </span>
                            </div>



                        </form>

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

        </div>
        <!-- /.row -->

    <!-- =========================================================== -->

    @endsection

    @section('myscripts')

    @endsection
