
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
        <div class="row">
          <div class="col col-md-7">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Your Profile</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form action="/student_edit_profile" method="post"  role="form">
                  <!-- text input -->
                  {{ csrf_field() }}
                  <!-- input states -->
                  <div class="form-group input-group-md has-success">
                      <input type="text" value="{{$student->name}}" class="form-control form-margin" name='name' required=""  placeholder="Full Name">
                      <input type="text"  value="{{$student->username}}" class="form-control form-margin"  disabled placeholder="Reg No">
                      <input type="email"  value="{{$student->email}}" class="form-control form-margin"  disabled placeholder="Email">
                      <input type="phone"  value="{{$student->phone}}" class="form-control form-margin" name='phone' required="" placeholder="Phone Number">
                      <input type="text"  value="{{$student->lga}}" class="form-control form-margin" name='lga' required="" placeholder="Local Government of Origin">
                      <input type="text"   value="{{$student->state_of_origin}}" class="form-control form-margin" name='state' required="" placeholder="State of Origin">

                      <input type="text"  value="{{$student->country}}" class="form-control form-margin" name='country' required="" placeholder="Country">
                      <textarea  value="{{$student->about}}" class="form-control form-margin" name="about" id="about" cols="30" rows="3" placeholder="Tell us a little about yourself">{{$student->about}}</textarea>

                    <span class="input-group-btn ">
                      <button type="submit"  class="btn btn-success btn-flat pull-right">Update Profile!</button>
                    </span>
                  </div>
                  </form>
                  <div class="error-div">
                    <p class="error text-center  alert alert-danger alert-dismissible hidden">
                    </p>
                  </div>

                  <hr  class="box-border">


              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

          <div class="col col-md-5">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Update Profile Picture</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <div class="box box-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">{{Auth::user()->username}}</h3>
                    <h5 class="widget-user-desc">Auth:Student</h5>
                  </div>
                  <div class="widget-user-image">
                    @if(isset($student->profile_pic))
                    <img src="/storage/profile_images/{{$student->profile_pic}}" alt="{{$student->profile_pic}}" class="img-circle">
                    @else
                    <img src="../../dist/img/user1-128x128.jpg" class="img-circle">
                    @endif
                  </div>

                </div>




                <hr  class="box-border">
                <form   action="/student_edit_profile_pic"  method="post" enctype="multipart/form-data">
                <div class="form-group">

                    {{ csrf_field() }}

                    <span class="input-group-btn ">
                        <input type="file" name="profile_pic" required="" class="btn btn-info btn-sm">
                    </span>

                    <span class="input-group-btn ">
                        <button type="submit" id="" class="btn btn-success btn-flat pull-right">Change  Picture!</button>
                    </span>

                    <!-- <p class="help-block">Example block-level help text here.</p> -->
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

    <!-- /.content -->


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
