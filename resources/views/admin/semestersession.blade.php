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
          <div class="col col-md-6 ">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Session Settings</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form role="form">
                  <!-- text input -->
                
                  <!-- input states -->
                  <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Current Session is:  @if($current_session != null){{$current_session->session_name}}@endif</label> 
                  </div>

                  {{ csrf_field() }}
                  <div class="input-group input-group-md has-success">

                      <input type="text"name="session-name" class="form-control" placeholder="Session Name Eg 2013/2014">

                      <span class="input-group-btn">
                        <button type="submit" id="add-session" class="btn btn-info btn-flat">Register Session!</button>
                      </span>

                    
                  </div>
                
                  <div class="error-div">
                    <p class="error text-center  alert alert-danger alert-dismissible hidden">
                    </p>
                  </div>
                  
                            

                </form>

                <!--display session data from database --> 
                
                  
                    <table id="session-table" class=" table table-bordered table-responsive">
                      <tr>
                        <th>Name</th>
                        <th>Set as Current</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                      @foreach($data as $item)
                        <tr>
                          <td>{{$item->session_name}}</td>
                          <td>
                            <button class="set-current btn btn-success" data-id="{{$item->id}}"
                              data-name="{{$item->session_name}}">
                              <i class="glyphicon glyphicon-check"></i> Set as Current
                            </button>
                          </td>
                          <td>
                            <button class="edit-modal btn btn-info" data-id="{{$item->id}}"
                              data-name="{{$item->session_name}}">
                              <i class="glyphicon glyphicon-edit"></i>Edit
                            </button>
                          </td>
                          <td>
                              <button class="delete-modal btn btn-danger" data-id="{{$item->id}}"
                                data-name="{{$item->session_name}}">
                                <i class="glyphicon glyphicon-trash"></i>Delete
                            </button>
                          
                          </td>
                        </tr>
                      @endforeach
                    </table>
                     
                  

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

          <div class="col col-md-6">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Semester Settings</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form role="form">
                  <!-- text input -->
                
                  <!-- input states -->
                  <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Current Semester is:  @if($current_semester != null){{$current_semester->semester_name}}@endif</label> 
                  </div>
                  
                  <div class="input-group input-group-md has-success">
                    <select name ='semester' id = 'semester'  class="form-control">
                      <option disabled selected>Set a New Semester</option>
                      @foreach($semesters as $semester)
                       <option value ='{{$semester->semester_value}}'>{{$semester->semester_name}}</option>
                      @endforeach
                    </select>
                      <span class="input-group-btn">
                        <button type="button" id='set-semester' class="btn btn-info btn-flat">Set as Current!</button>
                      </span>
                  </div>

                  <div class="error-div">
                    <p class="semester-error text-center  alert alert-danger alert-dismissible hidden">
                    </p>
                  </div>
                            

                </form>

              
                

              
        


              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        
          <!-- /.col -->
        </div>
        <!-- /.row -->

      

    <!-- interacrive modal here-->
    @include('partials.admin.semestersession_modal')

  @endsection

  @section('myscripts')

    <script src="{{asset('js/myscripts/admin.semsec.js')}}"></script>

  @endsection
