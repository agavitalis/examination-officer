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
                <h3 class="box-title">These Students where assigned to you for academic mentorship </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form action="">
                   {{ csrf_field() }}
                </form>
                
                     <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Level</th>
                          <th>Session</th>
                          <th>Lecturer Name</th>
                          <th>Lecturer ID</th>
                          <th>View Students</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($assigned_levels as $assigned_level)
                          <tr>
                            <td>{{$assigned_level->level}} Level </td>
                            <td>{{$assigned_level->session}}</td>
                            <td>{{$assigned_level->lecturer_name}}</td>
                            <td>{{$assigned_level->lecturer_id}}</td>
                            <td>
                              <form action="/lecturer/l_students" method="post">
                                {{ csrf_field() }}
                                 
                                  <input type="hidden"  name='level' value="{{$assigned_level->level}}">
                                  <input type="hidden"  name='session' value="{{$assigned_level->session}}">
                                 
                                  
                                  <button type="submit" class="btn btn-flat btn-info "><i class="fa fa-eye "></i>  View</button></td>
                         
                              </form>
                              
                           
                          </tr>
                        @endforeach
              
                      </tbody>
                     </table>             
                  
                  </div>

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
    
