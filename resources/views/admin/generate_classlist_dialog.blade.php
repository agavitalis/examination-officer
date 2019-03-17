@extends('layouts.master')

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
          
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#current" data-toggle="tab">Print Based on Current Level</a></li>
                    <li><a href="#borrow" data-toggle="tab">Print Based on Admission Year</a></li>
                  </ul>
				    <div class="tab-content">
                        <div class="active tab-pane" id="current">
                            <div class="box box-border">
                                
                                <div class="box-body">

                                    <!-- general form elements disabled -->
                                    <div class="lockscreen-wrapper box box-border">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Print Classlist based on current session and level</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class=" box-body">
                                            <form  action="/admin/generate_classlist" method="post" role="form">
                                                <!-- text input -->
                                                {{ csrf_field() }}
                                                <!-- input states -->
                                                <input type="hidden" name="action" value="current">
                                                <div class="form-group input-group-md has-success">
                                                
                                                    <select name ='session' id = 'session' required="" class="form-control form-margin">
                                                        <option disabled selected>Select Session</option>
                                                        @foreach($sessions as $session)
                                                        <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <select name ='level' id = 'level' required="" class="form-control form-margin">
                                                        <option disabled selected>Select level</option>
                                                        @foreach($levels as $level)
                                                        <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                                        @endforeach
                                                    </select>
                                    
                                                
                                                    <span class="input-group-btn ">
                                                        <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-print"></i>View and Print!</button>
                                                    </span>
                                                </div>
                                            
                                            
                                                            
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                    
                                </div>

                                
                            </div>

                        </div> 

                        <div class="tab-pane" id="borrow">
                            <div class="box box-border">
                               
                                <div class="box-body">

                                    <!-- general form elements disabled -->
                                    <div class="lockscreen-wrapper box box-border">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Print Classlist based on year of admission</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class=" box-body">
                                            <form  action="/admin/generate_classlist" method="post" role="form">
                                                <!-- text input -->
                                                {{ csrf_field() }}
                                                <!-- input states -->
                                                <input type="hidden" name="action" value="year">
                                                <div class="form-group input-group-md has-success">
                                                
                                                    <select name ='session' id = 'session' required="" class="form-control form-margin">
                                                        <option disabled selected>Select Session</option>
                                                        @foreach($sessions as $session)
                                                        <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <select name ='level' id = 'level' required="" class="form-control form-margin">
                                                        <option disabled selected>Select level</option>
                                                        @foreach($levels as $level)
                                                        <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                                        @endforeach
                                                    </select>
                                    
                                                
                                                    <span class="input-group-btn ">
                                                        <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-print"></i>View and Print!</button>
                                                    </span>
                                                </div>
                                            
                                            
                                                            
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                    
                                </div>

                                
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