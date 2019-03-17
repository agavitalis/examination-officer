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
          <div class="col col-md-5">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Register a new Lecturer</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form role="form">
                  <!-- text input -->
                  {{ csrf_field() }}
                  <!-- input states -->
                  <div class="form-group input-group-md has-success">
                        <input type="text" class="form-control form-margin" name='lecturer_name' required=""  placeholder="Lecturer Full Name">
                        <input type="text" class="form-control form-margin" name='lecturer_regno' required="" placeholder="Lecturer Reg No">
                        <input type="email" class="form-control form-margin" name='lecturer_email' required="" placeholder="Lecturer Email">
                      
                      
                      <span class="input-group-btn ">
                        <button type="button" id="register-lecturer" class="btn btn-success btn-flat pull-right">Register!</button>
                      </span>
                  </div>
                  </form>
                  <div class="error-div">
                    <p class="error text-center  alert alert-danger alert-dismissible hidden">
                    </p>
                  </div>
                  <div class="form-group has-success">
                    <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Upload list as excel</label> 
                  </div>   
                  <div class="form-group">
                      <span class="input-group-btn ">
                         <a href="{{ url('get_lecturer_excel/xlsx') }}"><button class="btn btn-info ">Download Sample(XLSX)</button></a> 
                      </span>
                       <span class="input-group-btn ">
                         <a href="{{ url('get_lecturer_excel/csv') }}"><button class="btn btn-info ">Download Sample(CSV)</button></a> 
                      </span>
                  </div>  
                  <hr  class="box-border">
                  <form   action="{{ URL::to('upload_lecturer_excel') }}"  method="post" enctype="multipart/form-data">
                    <div class="form-group"> 

                        {{ csrf_field() }}

                        <span class="input-group-btn ">
                          <input type="file" name="excel_lecturers" required="" class="btn btn-info btn-sm">
                        </span>

                        <span class="input-group-btn ">
                          <button type="submit" id="register-excel" class="btn btn-success btn-flat pull-right">Upload!</button>
                        </span>  
                      
                      <!-- <p class="help-block">Example block-level help text here.</p> -->
                    </div>   
                  </form>
               
                              

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>

          <div class="col col-md-7">
              <!-- /.box -->
            <!-- general form elements disabled -->
            <div class="box box-border">
              <div class="box-header with-border">
                <h3 class="box-title">Registered Lecturers</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="example1" class="table table-bordered table-responsive table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Reg No</th>
                    <th>Select</th>
                  
                  </tr>
                  </thead>
                  <tbody id="list-lect">
                  @foreach($lecturers as $lecturer)
                  <tr>
                    <td>{{$lecturer->name}}</td>
                    <td>{{$lecturer->username}}</td>
                    <td><div class="checkbox icheck">
                        <label>
                          <input type="radio"  name="lecturer_chosen" value="{{$lecturer->username}}" id="{{$lecturer->username}}">
                        </label>
                      </div>           
                    </td>
                    
                  </tr>                
                  @endforeach                           
                  </tbody>
                  <tfoot>
                  <tr>
                        <td>
                          <button class="lecturer-details btn btn-success btn-flat"><i class="fa fa-eye"></i> Details</button>
                        </td>
                        <td>
                          <button class="lecturer-edit btn btn-info btn-flat"><i class="fa fa-edit"></i>  Edit</button>
                        </td>
                        <td><button class="lecturer-delete btn btn-danger btn-flat"><i class="fa fa-trash"></i>  Delete</button></td>
                  
                  </tr>
                  </tfoot>
                </table>             
                  
                  
                    <div class="error-div">
                    <p class="detail-error text-center  alert alert-danger hidden">
                    </p>
                  </div>

                    <!-- <form action="/admin/registerlect" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="register_lecturer">
                    <input type="text" class="form-control form-margin" name='lecturer_name' required=""  placeholder="Lecturer Full Name">
                      <input type="text" class="form-control form-margin" name='lecturer_regno' required="" placeholder="Lecturer Reg No">
                      <input type="text" class="form-control form-margin" name='lecturer_email' required="" placeholder="Lecturer Email">
                      
                      
                    <input type="submit" value="ddd">
                    </form> -->
                  
                  <!-- /table-ends -->
                

              
        


              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        
          <!-- /.col -->
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