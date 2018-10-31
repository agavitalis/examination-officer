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
          <form action="/student/register_courses" method="post">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#current" data-toggle="tab">Current Courses</a></li>
                    <li><a href="#borrow" data-toggle="tab">Borrow Courses</a></li>
                  </ul>
				    	  <div class="tab-content">
                  <div class="active tab-pane" id="current">
                      <div class="box box-border">
                        <div class="box-header with-border text-center">
                          <h3 class="box-title">These Courses Where Recommended by your advicer so register them accordingly</h3>
                        </div>

                      
                          <input type="hidden" name="action" value="register">
                          <input type="hidden" name="session" value="{{$session}}">
                          <input type="hidden" name="semester" value="{{$semester}}">
                          {{ csrf_field() }}
                          <div class="box-body">
                            <table id="example1" class="table table-bordered table-responsive table-striped">
                              <thead>
                              <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Unit Load</th>
                                <th>Course Status</th>
                                <th>Select</th>
                              
                              </tr>
                              </thead>
                              <tbody id="list-lect">
                              @foreach($courses as $course)
                              <tr>
                                <td>{{$course->course_code}}</td>
                                <td>{{$course->course_title}}</td>
                                <td>{{$course->unit}}</td>
                                <th>{{$course->status}}</th>
                                <td><div class="checkbox icheck">
                                    <label>
                                      <input type="checkbox"  name="course_chosen[]" value="{{$course->course_code}}" >
                                    </label>
                                  </div>           
                                </td>
                                
                              </tr>                
                              @endforeach                           
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><button type="submit" class=" btn btn-success btn-flat"><i class="fa fa-edit"></i>  Register!</button></td>
                              
                              </tr>
                              </tfoot>
                            </table>
                          </div>                
                        <!-- </form> -->
                      </div>

                  </div> 

                      <div class="tab-pane" id="borrow">
                        <div class="box box-border">
                            <div class="box-header with-border text-center">
                              <h3 class="box-title">Here is a list of the recommended courses you can borrow from</h3>
                            </div>

                          <!-- <form action="/student/register_courses" method="post"> -->
                          <!-- <input type="hidden" name="action" value="register">
                          <input type="hidden" name="session" value="{{$session}}">
                          <input type="hidden" name="semester" value="{{$semester}}"> -->
                        
                          <div class="box-body">
                            <table id="example1" class="table table-bordered table-responsive table-striped">
                              <thead>
                              <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Unit Load</th>
                                <th>Course Status</th>
                                <th>Select</th>
                              
                              </tr>
                              </thead>
                              <tbody id="list-lect">
                              @foreach($courses as $course)
                              <tr>
                                <td>{{$course->course_code}}</td>
                                <td>{{$course->course_title}}</td>
                                <td>{{$course->unit}}</td>
                                <th>{{$course->status}}</th>
                                <td><div class="checkbox icheck">
                                    <label>
                                      <input type="checkbox"  name="course_chosen[]" value="{{$course->course_code}}" >
                                    </label>
                                  </div>           
                                </td>
                                
                              </tr>                
                              @endforeach                           
                              </tbody>
                              <tfoot>
                              <!-- <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><button type="submit" class=" btn btn-success btn-flat"><i class="fa fa-edit"></i>  Register!</button></td>
                              
                              </tr> -->
                              </tfoot>
                            </table>
                          </div>                
                        <!-- </form> -->

                        </div>
                        

                      </div>   

                </div>  

              </div>
            </div>    
            
					 
          </form>       
              
            
         
         
                  
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