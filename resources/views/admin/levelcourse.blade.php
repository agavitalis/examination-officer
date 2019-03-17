@extends('layouts.master')

  @section('sidebar')
    @include('partials.admin.sidebar')
  @endsection

  @section('breadcrom')
    @include('partials.admin.breadcrom')
  @endsection

  @section('content')


        <hr class="box-border">
        <!--Info will be displayed here-->
        @include('partials.admin.alert')

        <div class="row">
          <div class="col col-md-6 ">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Level Settings</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form role="form">
                  
                
                  <div class="input-group input-group-md has-success">
                  {{ csrf_field() }}
                      <input type="text" class="form-control form-margin" id='level' name='level' placeholder="Enter New Level Eg '200' for 200 Level">
                      <span class="input-group-btn">
                        <button type="button" id = 'register-level' class="btn btn-success btn-flat">Register Level!</button>
                      </span>
                  </div>
                  <div class="error-div">
                    <p class="error text-center  alert alert-danger alert-dismissible hidden">
                    </p>
                  </div>
                  <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Registered Levels:</label> 
                  </div>
                            

                </form>

                <!--display data from database --> 
                
                  
                    <table class="table table-bordered table-responsive">
                      <tr>
                        <th>Name</th>
                        <th class="pull-right">Delete</th>
                      </tr>
                      @foreach($levels as $level)
                      <tr id"{{$level->level_name}}">
                        <td>{{$level->level_name}} Level</td>
                        <td><button class=" delete-level btn btn-danger btn-flat pull-right" data-name="{{$level->level_name}}" data-id="{{$level->id}}"><i class="fa fa-trash"></i>Delete</button></td>
                      </tr>
                      @endforeach
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
                <h3 class="box-title">Courses Settings</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form role="form">
                  <!-- text input -->
                
                  <!-- input states -->
                  <div class="form-group input-group-md has-success">
                        <input type="text" class="form-control form-margin" name='course_code' required=""  placeholder="Course Code Eg: ECE423">
                        <input type="text" class="form-control form-margin" name='course_title' required="" placeholder="Course Title Eg: Physical Electronics">
                        <input type="number" class="form-control form-margin" name='course_unit' required="" placeholder="Unit Load Eg: 3">
                        
                        <select name ='course_level' id = 'course_level' required="" class="form-control form-margin">
                          <option disabled selected>Select Level</option>
                          @foreach($levels as $level)
                          <option value ='{{$level->level_name}}'>{{$level->level_name}} Level</option>
                          @endforeach
                        </select>
                        <select name ='course_semester' id = 'semester' required="" class="form-control form-margin">
                          <option disabled selected>Select Semester</option>
                          <option value ='1'>First Semester</option>
                          <option value = '2'>Second Semester</option>
                        </select>
                        <div class="checkbox icheck">
                            <label>Course Status:
                            Compulsory: <input type="radio"  name="status" value="Compulsory" id="status">
                            Elective: <input type="radio"  name="status" value="Elective" id="status">
                            </label>
                        </div>
                      <span class="input-group-btn ">
                        <button type="button" id="register-course" class="btn btn-success btn-flat pull-right">Register Course!</button>
                      </span>
                  </div>
                  <div class="error-div">
                    <p class="error-course text-center  alert alert-danger alert-dismissible hidden">
                    </p>
                  </div>
                  <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Registered Courses</label> 
                  </div>         
                  
                </form>

                <!--display data from database --> 
                
                  
                    <table class="table table-bordered table-responsive">
                      <tr>
                        <th>Name</th>
                        <th>Detail</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                      <tr>
                        <td>
                            <select name ='course-detail' id = 'course-detail'  class="form-control">
                              <option disabled selected>View registered courses</option>
                              @foreach($courses as $course)
                              <option  id="{{$course->course_code}}"  value ="{{$course->course_code}}" >{{$course->course_code}}</option>
                              @endforeach
                              
                            </select>
                        </td>
                        <td>
                          <button class="course-details btn btn-success btn-flat"><i class="fa fa-eye"></i> Details</button>
                        </td>
                        <td>
                          <button class="course-edit btn btn-info btn-flat"><i class="fa fa-edit"></i>  Edit</button>
                        </td>
                        <td><button class="course-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i>  Delete</button></td>
                      </tr>
                    </table>
                    <div class="error-div">
                    <p class="detail-error text-center  alert alert-danger hidden">
                    </p>
                  </div>

                    <!-- <form action="/admin/levcou" method="post">
                    {{ csrf_field() }}
                    <input type="text" name="" id="">
                    <input type="hidden" name="action" value="addcourse" id="">
                    <input type="submit" value="ddd">
                    </form> -->
                  
                  <!-- /table-ends -->
                

              
        


              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        
          <!-- /.col -->
        </div>
        <!-- /.row -->

    <!-- =========================================================== -->



      <!-- Automatic element centering
      <div class="lockscreen-wrapper">
        
      </div>
      center -->
      <!-- interacrive modal here-->
    @include('partials.admin.levelcourse_modal')
  @endsection

  @section('myscripts')

    <script src="{{asset('js/myscripts/admin.levcou.js')}}"></script>
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