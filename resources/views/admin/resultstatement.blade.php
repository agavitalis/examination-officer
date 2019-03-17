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

            <div class="col col-md-12">
                <!-- /.box -->
                <!-- general form elements disabled -->
                <div class="box box-border">
                    <div class="box-header with-border">
                        <h3 class="box-title">Approve Results Uploaded by Lecturers</h3>
                    </div>
                        <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Course Title</th>
                                    <th>Course Code</th>
                                    <th>Lecturer</th>
                                    <th>Level</th>
                                    <th>Session</th>
                                    <th>View Result Details</th>
                                    <th>Approve Results</th>
                                    <th>Reject Results</th>                                
                                </tr>
                            </thead>
                            <tbody id="list-lect">            
                             
                                <tr>
                                    <td>Introduction to Engineering</td>
                                    <td>ECE541</td>
                                    <td title="2013/186878"> Engr MA Ahaneku</td>
                                    <td>200 Level</td>
                                    <td>2013/2014</td>
                                    <td><button class="student-edit btn btn-info btn-flat"><i class="fa fa-eye"></i>View Details</button></td>
                                    
                                    <td><button class="student-edit btn btn-success btn-flat"><i class="fa fa-edit"></i>Approve Result</button></td>
                                    <td><button class="student-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i>Reject Result</button></td>
         
                                </tr>
                                            
                                                     
                            </tbody>
                            
                        </table>             
   
                        <div class="error-div">
                            <p class="detail-error text-center  alert alert-danger hidden"></p>
                        </div>  
                    </div>
                        <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

        </div>

    @endsection

    @section('myscripts')

        <script src="{{asset('js/myscripts/admin.assigncourses.js')}}"></script>
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