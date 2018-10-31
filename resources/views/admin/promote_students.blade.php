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
                    <li class="active"><a href="#current" data-toggle="tab">Promote Student In Levels</a></li>
                    <li><a href="#borrow" data-toggle="tab">Promote a Single Student</a></li>
                  </ul>
				    <div class="tab-content">
                        <div class="active tab-pane" id="current">
                            <div class="box box-border">
                            
                                <div class="box-body">

                                    <!-- general form elements disabled -->
                                    <div class="lockscreen-wrapper box box-border">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Promote Students(Promote the higher level sudents first)</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class=" box-body">
                                            <form  action="/admin/generate_classlist" method="post" role="form">
                                                <!-- text input -->
                                                {{ csrf_field() }}
                                                <!-- input states -->
                                                <input type="hidden" name="action" value="level">
                                                <div class="form-group input-group-md has-success">
                                                
                                                    <select name ='from_level' id = 'from_level' required="" class="form-control form-margin">
                                                        <option disabled selected>Promote/Demote from</option>
                                                        @foreach($levels as $level)
                                                        <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                                        @endforeach
                                                    </select>

                                                    <select name ='to_level' id = 'to_level' required="" class="form-control form-margin">
                                                        <option disabled selected>To level</option>
                                                        @foreach($levels as $level)
                                                        <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                                        @endforeach
                                                    </select>
                                    
                                                    <div class="message hidden"><p class="message-p alert alert-success"></p></div>
                                                    <span class="input-group-btn ">
                                                        <button type="button"  class="promote-lev btn btn-success btn-flat pull-right"><i class="fa fa-upload"></i> Promote Students</button>
                                                        <button type="button"  class="demote-lev btn btn-danger btn-flat "><i class="fa fa-download"></i>  Demote Students</button>
                                                 
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
                                            <h3 class="box-title">Promote a Single Student</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class=" box-body">
                                            <form  action="/admin/generate_classlist" method="post" role="form">
                                                <!-- text input -->
                                                {{ csrf_field() }}
                                                <!-- input states -->
                                                
                                                <div class="form-group input-group-md has-success">
                                                
                                                    <input type="text" id = 'reg_no' name="reg_no" placeholder="Students Registration Number" class="form-control form-margin" >

                                                    <select name ='level' id = 'level' required="" class="form-control form-margin">
                                                        <option disabled selected>Select level promote/demote</option>
                                                        @foreach($levels as $level)
                                                        <option value ='{{$level->level_name}}'>{{$level->level_name}}</option>
                                                        @endforeach
                                                    </select>
                                    
                                                     <div class="messag hidden"><p class="messag-p alert alert-success"></p></div>
                                              
                                                    <span class="input-group-btn ">
                                                        <button type="button"  class="promote-ind btn btn-success btn-flat "><i class="fa fa-upload"></i>   Promote!</button>
                                                        <button type="button"  class="demote-ind btn btn-danger btn-flat pull-right"><i class="fa fa-download"></i>  Demote!</button>
                                                
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

    <script src="{{asset('js/myscripts/admin.promote_students.js')}}"></script>
   
    

  @endsection