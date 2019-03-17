@extends('layouts.master')

  @section('mystyles')
    <!-- Datatables -->
    <link href="{{asset('datatables/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('datatables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('datatables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('datatables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
  @endsection

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
                <h3 class="box-title">Results you uploaded to the portal</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Reg No</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>CA</th>
                    <th>Exam</th>
                    <th>Total</th>
                    <th>Grade</th>
                    <th>Approved</th>
                    <th>Revoke</th>                   
                  </tr>
                  </thead>
                  <tbody id="list-lect">
                    @foreach($results as $result)
                    <tr>
                        <td>{{$result->name}}</td>
                        <td>{{$result->username}}</td>
                        <td>{{$result->course_code}}</td>
                        <td>{{$result->course_title}}</td>
                        <td>{{$result->session}}</td>
                        <td>{{$result->semester}}</td>
                        <td>{{$result->ca_score}}</td>
                        <td>{{$result->exam_score}}</td>
                        <td>{{$result->total_score}}</td>
                         <td>{{$result->grade}}</td>
                       

                        <td>@if($result->approved == 1)
                          <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-ok"></i></button>
                          @else
                          <button class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                          @endif
                        </td>
                        <td>@if($result->approved == 1)
                          <button title="Approved results, cannot be revoked" class="btn btn-sm btn-danger disabled"><i class="glyphicon glyphicon-remove"></i></button>
                          @else
                          <button data-name="{{$result->name}}" data-username="{{$result->username}}" data-level="{{$result->level}}" data-session="{{$result->session}}" data-semester="{{$result->semester}}" title="This will delete this result" class="reject btn btn-sm btn-danger"><i class="glyphicon glyphicon-ok"></i></button>
                          @endif
                        </td>
                                    
                    </tr>                
                    @endforeach        
                  </tbody>
                 
                </table> 
                <!-- error and notifications here -->
                <div class="error-div">
                    <p class="error text-center  alert alert-success  hidden">
                    </p>
                </div>

                 <div class="box-body">
                  <div class="box-header with-border text-center">
                    <h3 class="box-title">Select other courses, to view results</h3>
                  </div>
                  <div class="row">
                    <form role="form" method="POST" action="/lecturer/course_results">
                        <!-- text input -->
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="others">
                        <div class="col-md-4 has-success">
                          <select name ='course_code'  required="" class="form-control form-margin">
                              <option disabled selected>Select Course</option>
                              @foreach($courses as $course)
                              <option value ='{{$course->course_code}}'>{{$course->course_code}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="col-md-4 has-success">
                          <select name ='session'  required="" class="form-control form-margin">
                              <option disabled selected>Select Session</option>
                              @foreach($sessions as $session)
                              <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="col-md-4 has-success">
                          <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-eye"></i>View Results!</button>                    
                        </div>
                    </form>
                  </div>
                 </div>
                

                 

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        
        </div>
        <!-- /.row -->

    <!-- =========================================================== -->

   @include('partials.lecturer.approved_modal')
  @endsection

  @section('myscripts')
     <script src="{{asset('js/myscripts/lecturer.mycourse_results.js')}}"></script>
   <!-- Datatables -->
      <script src="{{asset('datatables/datatables.net/js/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
      <script src="{{asset('datatables/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
      <script src="{{asset('datatables/jszip/dist/jszip.min.js')}}"></script>
      <script src="{{asset('datatables/pdfmake/build/pdfmake.min.js')}}"></script>
      <script src="{{asset('datatables/pdfmake/build/vfs_fonts.js')}}"></script>

      <!-- the instantiation code of the datatable goes here -->
      <script src="{{asset('datatables/compile.js')}}"></script>
    

  @endsection