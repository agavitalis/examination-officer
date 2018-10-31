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
         
          <div class="col col-md-8 col-md-offset-2">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="lockscreen-wrapper box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Select Level to View Your Courses </h3>
              </div>
              <!-- /.box-header -->
              <div class=" box-body">
                    <form  action="/student/mycourses" method="post" role="form">
                            <!-- text input -->
                            {{ csrf_field() }}
                            <!-- input states -->
                            <div class="form-group input-group-md has-success">
                               
                                
                                <select name ='level' id = 'level' required="" class="form-control form-margin">
                                    <option disabled selected>Select Level</option>
                                    @foreach($levels as $level)
                                    <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                    @endforeach
                                </select>
                               
                                <span class="input-group-btn ">
                                    <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-eye"></i>View My Courses!</button>
                                </span>
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
        
    @endsection   

    @section('myscripts')
    
    @endsection
    
