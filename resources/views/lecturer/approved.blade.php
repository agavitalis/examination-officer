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
                <h3 class="box-title">You approved the courses, registered by these students</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Reg No</th>
                    <th>Level</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>Approved</th>
                     <th>View Details</th>                 
                  </tr>
                  </thead>
                  <tbody id="list-lect">
                    @foreach($students as $student)
                    <tr>
                        <td>{{$student->student_name}}</td>
                        <td>{{$student->username}}</td>
                        <td>{{$student->level}}</td>
                        <td>{{$student->session}}</td>
                        <td>{{$student->semester}}</td>
                        <td>@if($student->approved == 1)
                          <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-ok"></i></button>
                          @else
                          <button class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                          @endif
                        </td>
                        <td>
                          <button class="view btn btn-info btn-flat" data-name="{{$student->student_name}}" data-username="{{$student->username}}" data-level="{{$student->level}}" data-session="{{$student->session}}" data-semester="{{$student->semester}}"><i class="fa fa-eye"></i>  View</button>
                        </td>                   
                    </tr>                
                    @endforeach        
                  </tbody>
                 
                </table> 

                 <div class="box-body">
                  <div class="box-header with-border text-center">
                    <h3 class="box-title">Select other students, to see the courses you approved</h3>
                  </div>
                  <div class="row">
                    <form role="form" method="POST" action="/lecturer/approved_courses">
                        <!-- text input -->
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="others">
                        <div class="col-md-4 has-success">
                          <select name ='session'  = 'session' required="" class="form-control form-margin">
                              <option disabled selected>Select Session</option>
                              @foreach($sessions as $session)
                              <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="col-md-4 has-success">
                          <select name ='level' id = 'session' required="" class="form-control form-margin">
                              <option disabled selected>Select Level</option>
                              @foreach($levels as $level)
                              <option value ='{{$level->level}}'>{{$level->level}} Level</option>
                              @endforeach
                          </select>
                        </div>
                        <div class="col-md-4 has-success">
                          <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-eye"></i>View Students!</button>                    
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
     <script src="{{asset('js/myscripts/lecturer.approved.js')}}"></script>
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