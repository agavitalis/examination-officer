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
         
          <div class="col col-md-12">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border text-center">
                <h3 class="box-title">These Students registered for courses awaiting your approval </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <form role="form" method="POST" action="/lecturer/unapproved_courses">
                  <table id="example1" class="table table-bordered table-responsive table-striped">
                  <thead>
                 
                  <tr>
                    <th>Name</th>
                    <th>Reg No</th>
                    <th>Level</th>
                    <th>Session</th>
                    <th>Semester</th>
                      
                    <th>View Registered Courses</th>
                    <th>Select</th>
                    <th>Disappove</th>                
                  </tr>
                  </thead>
                  <tbody id="list-lect">
                   @foreach($courses as $student)
                    <tr>
                        <td>{{$student->student_name}}</td>
                        <td>{{$student->username}}</td>
                        <td>{{$student->level}} Levels</td>
                        <td>{{$student->session}}</td>
                        <td>{{$student->semester}}</td>
                       
                        <td>
                              <button   class="view btn btn-info btn-flat" data-name="{{$student->student_name}}" data-username="{{$student->username}}" data-level="{{$student->level}}" data-session="{{$student->session}}" data-semester="{{$student->semester}}">
                              <i class="fa fa-eye"></i>                                              
                              View
                              </button>
                           
                        </td>
                        <td>
                            <div class="checkbox icheck">
                              <label>
                                <input type="checkbox"  name="student_selected[]" value="{{$student->username}}" >
                              </label>
                            </div>  
                        </td>
                    

                        <td><button title="This will delete the student courses, make sure you know what you are doing" class="btn btn-danger btn-flat reject" data-name="{{$student->student_name}}" data-username="{{$student->username}}" data-level="{{$student->level}}" data-session="{{$student->session}}" data-semester="{{$student->semester}}" ><i class="fa fa-trash"></i>Reject</button></td>                   
                             
                    </tr>                
                   @endforeach         
                  </tbody>
                </table>             
                  <div class="error-div">
                    <p class="error text-center  alert alert-success  hidden">
                    </p>
                  </div>
                   <div class="box-body">
                 
                      <div class="row">
                       
                            <!-- text input -->
                            {{ csrf_field() }}
                            <input type="hidden" name="action" value="approve">
                            <div class="col-md-12 has-success">
                              <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-success"></i>Approve Selected Students!</button>                    
                            </div>
                       
                      </div>
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
     <!-- interacrive modal here-->
    @include('partials.lecturer.unapproved_modal')
  @endsection

  @section('myscripts')

    <script src="{{asset('js/myscripts/lecturer.unapproved.js')}}"></script>
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