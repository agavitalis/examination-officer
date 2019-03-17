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
         
          <div class="col col-md-8 col-md-offset-2">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="lockscreen-wrapper box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Select Level and Sesstion to Print Class List </h3>
              </div>
              <!-- /.box-header -->
              <div class=" box-body">
                    <form  action="/lecturer/l_classlist" method="post" role="form">
                            <!-- text input -->
                            {{ csrf_field() }}
                            <!-- input states -->
                            <div class="form-group input-group-md has-success">
                               
                                 <select name ='session' id = 'session' required="" class="form-control form-margin">
                                    <option disabled selected>Select Session</option>
                                    @foreach($sessions as $session)
                                    <option value ='{{$session->session_name}}'>{{$session->session_name}}</option>
                                    @endforeach
                                </select> 
                                <select name ='level' id = 'level' required="" class="form-control form-margin">
                                    <option disabled selected>Select Level</option>
                                    @foreach($levels as $level)
                                    <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                    @endforeach
                                </select>
                               
                                <span class="input-group-btn ">
                                    <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-print"></i>View and Print!</button>
                                </span>
                            </div>
                        
                            
                       
                        </form>
                                 <!-- <form action="/admin/assigncourses" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="action" value="register_lecturer">
                                    <input type="text" class="form-control form-margin" name='lecturer_name' required=""  placeholder="Lecturer Full Name">
                                    
                                    
                                    <input type="submit" value="ddd">
                                </form> -->
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
    
    @endsection
    
