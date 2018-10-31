@extends('layouts.master')

  @section('mystyles')
    <!-- Datatables -->
    <link href="{{asset('datatables/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('datatables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('datatables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('datatables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
  @endsection

  @section('sidebar')
    @include('partials.admin.sidebar')
  @endsection

  @section('breadcrom')
    @include('partials.admin.breadcrom')
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
                <h3 class="box-title">Results uploaded by Lecturers, awaiting your approval</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                  <thead>
                  <tr>
                    <th>Lecturer Name</th>
                    <th>Lecturer ID</th>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>View Details</th>
                    <th>Approve</th>
                    <th>Reject</th>                   
                  </tr>
                  </thead>
                  <tbody id="list-lect">
                    @foreach($results as $result)
                    <tr>
                        <td>{{$result->coordinator}}</td>
                        <td>{{$result->uploaded_by}}</td>
                        <td>{{$result->course_code}}</td>
                        <td>{{$result->course_title}}</td>
                        <td>{{$result->session}}</td>
                        <td>{{$result->semester}}</td>
                        <td>
                          <button  data-course="{{$result->course_code}}" data-lecturer="{{$result->uploaded_by}}" data-level="{{$result->level}}" data-session="{{$result->session}}" data-semester="{{$result->semester}}" title="View Contents of this result" class="view btn btn-flat btn-sm btn-info "><i class="fa fa-eye"></i></button>
                        </td>
                         <td>
                          <button  data-course="{{$result->course_code}}" data-lecturer="{{$result->uploaded_by}}" data-level="{{$result->level}}" data-session="{{$result->session}}" data-semester="{{$result->semester}}" title="Approve this result" class="approve btn btn-flat btn-sm btn-success "><i class="glyphicon glyphicon-ok"></i></button>
                        </td>
                         <td>
                          <button  data-course="{{$result->course_code}}"  data-lecturer="{{$result->uploaded_by}}" data-level="{{$result->level}}" data-session="{{$result->session}}" data-semester="{{$result->semester}}" title="Reject this result(Note: This will delete these result)" class="reject btn btn-flat btn-sm btn-danger "><i class="glyphicon glyphicon-remove"></i></button>
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

                
                

                 

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        
        </div>
        <!-- /.row -->

    <!-- =========================================================== -->
     @include('partials.admin.approve_results_modal')
  @endsection

  @section('myscripts')
     <script src="{{asset('js/myscripts/admin.approve_results.js')}}"></script>
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