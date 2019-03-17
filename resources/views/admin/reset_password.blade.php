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
         
          <div class="col col-md-8 col-md-offset-2">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="lockscreen-wrapper box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Enter Registration on and select type to reset password</h3>
              </div>
              <!-- /.box-header -->
              <div class=" box-body">
                    <form  action="/admin/password_reset" method="post" role="form">
                            <!-- text input -->
                            {{ csrf_field() }}
                            <!-- input states -->
                            <input type="hidden" name="action" value="show">
                            <div class="form-group input-group-md has-success">
                               
                               <input type="text" class="form-control form-margin" name='reg_no' required="" placeholder="User Registration Number">
                        
                                <select name ='usertype' id = 'usertype' required="" class="form-control form-margin">
                                    <option disabled selected>Select UserType</option>
                                   
                                    <option value ='student'>Student</option>
                                    <option value ='lecturer'>Lecturer</option>
                                    
                                </select>
                               
                                <span class="input-group-btn ">
                                    <button type="submit"  class="btn btn-success btn-flat pull-right"><i class="fa fa-pencil"></i>Reset Password!</button>
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
    
