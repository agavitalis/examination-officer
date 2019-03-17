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

       <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12 text-center course-reg">
          <h2 class="">
            <!-- <i class="fa fa-globe"></i> -->
             Department of Electronc Engineering   
          </h2>
          <small><i>(Center Of Excellence)</i></small>
          <h3>Falculty of Engineering</h3>
          <h4>University of Nigeria, Nsukka</h4>
          <h6>Department Course Result Details</h6>
        </div>
        
        <!-- /.col -->
      </div>
      <hr>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          <address class="text-right">
            <strong>Name: {{Auth::user()->name}}</strong><br>
            <strong>Reg No: {{Auth::user()->username}}</strong><br>
            <strong>Email:{{Auth::user()->email}}</strong><br>
            <strong>Phone:{{Auth::user()->email}}</strong><br>
            <strong>Level:{{Auth::user()->level}}</strong><br>
            <strong>Session:{{Auth::user()->session}}</strong>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          <address class="text-left">
            <strong>Level Admitted: 100Level </strong><br>
            <strong>Session Admitted: 2013/2014</strong><br>
            <strong>Entry Mode: UTME</strong><br>
            <strong>State of Origin:Enugu State</strong><br>
            <strong>LGA: Igboeze South</strong><br>
            <strong>Nationality: Nigerian</strong>
          </address>
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
     

        <div class="col-xs-12">
          <div class="text-center">
            <i>Results Statement for {{Auth::user()->name}} of Registration Number: {{Auth::user()->username}}
            </i>
          </div>
          <!-- first year results goes here -->
           @if(isset($results11))
              <div class="col-xs-12 table-responsive">
               <div class="text-left cgpa">
                  <u><i>First Year(first semester) Results:</i></u>
                </div>
                  <table class="table table-bordered table-responsive table-condensed table-striped">
                    <thead>
                    <tr>
                      <th>Course Code</th>
                      <th>Course Title</th>
                      <th>Unit Load</th>
                      <th>Grade</th>
                      <th>Grade Point</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results11 as $result)

                    <tr>
                      <td>{{$result->course_code}}</td>
                      <td>{{$result->course_title}}</td>
                      <td>{{$result->unit_load}}</td>
                      <td>{{$result->grade}}</td>
                      <td>{{$result->point}}</td>             
                    </tr>
                    @endforeach
                  
                    </tbody>
                    
                      
                      
                    
                </table>
              </div>  
          

                @if($results12->count())
                  <div class="col-xs-12 table-responsive">
                  <div class="text-left cgpa">
                      <u><i>First Year(second Semester) Results:</i></u>
                    </div>
                      <table class="table table-bordered table-responsive table-condensed table-striped">
                        <thead>
                        <tr>
                          <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Unit Load</th>
                          <th>Grade</th>
                          <th>Grade Point</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results12 as $result)

                        <tr>
                          <td>{{$result->course_code}}</td>
                          <td>{{$result->course_title}}</td>
                          <td>{{$result->unit_load}}</td>
                          <td>{{$result->grade}}</td>
                          <td>{{$result->point}}</td>             
                        </tr>
                        @endforeach
                      
                        </tbody>
                        
                          
                          
                        
                    </table>
                  
                  </div>  
                @endif
            <div class="text-center cgpa">
                  <u><i>First Year GPA: {{$gp1}}</i></u>
            </div>
           @endif

           <!-- second year results goes here -->
            @if(isset($results21))
              <div class="col-xs-12 table-responsive">
               <div class="text-left cgpa">
                  <u><i>Second Year(first semester) Results:</i></u>
                </div>
                  <table class="table table-bordered table-responsive table-condensed table-striped">
                    <thead>
                    <tr>
                      <th>Course Code</th>
                      <th>Course Title</th>
                      <th>Unit Load</th>
                      <th>Grade</th>
                      <th>Grade Point</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results11 as $result)

                    <tr>
                      <td>{{$result->course_code}}</td>
                      <td>{{$result->course_title}}</td>
                      <td>{{$result->unit_load}}</td>
                      <td>{{$result->grade}}</td>
                      <td>{{$result->point}}</td>             
                    </tr>
                    @endforeach
                  
                    </tbody>
                    
                      
                      
                    
                </table>
              </div>  
          

                @if($results22->count())
                  <div class="col-xs-12 table-responsive">
                  <div class="text-left cgpa">
                      <u><i>Second Year(second semester) Results:</i></u>
                    </div>
                      <table class="table table-bordered table-responsive table-condensed table-striped">
                        <thead>
                        <tr>
                          <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Unit Load</th>
                          <th>Grade</th>
                          <th>Grade Point</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results12 as $result)

                        <tr>
                          <td>{{$result->course_code}}</td>
                          <td>{{$result->course_title}}</td>
                          <td>{{$result->unit_load}}</td>
                          <td>{{$result->grade}}</td>
                          <td>{{$result->point}}</td>             
                        </tr>
                        @endforeach
                      
                        </tbody>
                        
                          
                          
                        
                    </table>
                  
                  </div>  
                @endif
            <div class="text-center cgpa">
                  <u><i>Second Year GPA: {{$gp1}}</i></u>
            </div>
           @endif


            <!-- third year results goes here -->
            @if(isset($results31))
              <div class="col-xs-12 table-responsive">
               <div class="text-left cgpa">
                  <u><i>Third Year(first semester) Results:</i></u>
                </div>
                  <table class="table table-bordered table-responsive table-condensed table-striped">
                    <thead>
                    <tr>
                      <th>Course Code</th>
                      <th>Course Title</th>
                      <th>Unit Load</th>
                      <th>Grade</th>
                      <th>Grade Point</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results31 as $result)

                    <tr>
                      <td>{{$result->course_code}}</td>
                      <td>{{$result->course_title}}</td>
                      <td>{{$result->unit_load}}</td>
                      <td>{{$result->grade}}</td>
                      <td>{{$result->point}}</td>             
                    </tr>
                    @endforeach
                  
                    </tbody>
                    
                      
                      
                    
                </table>
              </div>  
          

                @if($results32->count())
                  <div class="col-xs-12 table-responsive">
                  <div class="text-left cgpa">
                      <u><i>Third Year(second semester) Results:</i></u>
                    </div>
                      <table class="table table-bordered table-responsive table-condensed table-striped">
                        <thead>
                        <tr>
                          <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Unit Load</th>
                          <th>Grade</th>
                          <th>Grade Point</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results32 as $result)

                        <tr>
                          <td>{{$result->course_code}}</td>
                          <td>{{$result->course_title}}</td>
                          <td>{{$result->unit_load}}</td>
                          <td>{{$result->grade}}</td>
                          <td>{{$result->point}}</td>             
                        </tr>
                        @endforeach
                      
                        </tbody>
                        
                          
                          
                        
                    </table>
                  
                  </div>  
                @endif
            <div class="text-center cgpa">
                  <u><i>Third Year GPA: {{$gp1}}</i></u>
            </div>
           @endif


            <!-- forth year results goes here -->
            @if(isset($results41))
              <div class="col-xs-12 table-responsive">
               <div class="text-left cgpa">
                  <u><i>Fourth Year(first semester) Results:</i></u>
                </div>
                  <table class="table table-bordered table-responsive table-condensed table-striped">
                    <thead>
                    <tr>
                      <th>Course Code</th>
                      <th>Course Title</th>
                      <th>Unit Load</th>
                      <th>Grade</th>
                      <th>Grade Point</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results41 as $result)

                    <tr>
                      <td>{{$result->course_code}}</td>
                      <td>{{$result->course_title}}</td>
                      <td>{{$result->unit_load}}</td>
                      <td>{{$result->grade}}</td>
                      <td>{{$result->point}}</td>             
                    </tr>
                    @endforeach
                  
                    </tbody>
                    
                      
                      
                    
                </table>
              </div>  
          

                @if($results42->count())
                  <div class="col-xs-12 table-responsive">
                  <div class="text-left cgpa">
                      <u><i>Fourth Year(second semester) Results:</i></u>
                    </div>
                      <table class="table table-bordered table-responsive table-condensed table-striped">
                        <thead>
                        <tr>
                          <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Unit Load</th>
                          <th>Grade</th>
                          <th>Grade Point</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results42 as $result)

                        <tr>
                          <td>{{$result->course_code}}</td>
                          <td>{{$result->course_title}}</td>
                          <td>{{$result->unit_load}}</td>
                          <td>{{$result->grade}}</td>
                          <td>{{$result->point}}</td>             
                        </tr>
                        @endforeach
                      
                        </tbody>
                        
                          
                          
                        
                    </table>
                  
                  </div>  
                @endif
            <div class="text-center cgpa">
                  <u><i>Fourth Year GPA: {{$gp1}}</i></u>
            </div>
           @endif
           

            <!-- final year results goes here -->
            @if(isset($results51))
              <div class="col-xs-12 table-responsive">
               <div class="text-left cgpa">
                  <u><i>Final Year(final semester) Results:</i></u>
                </div>
                  <table class="table table-bordered table-responsive table-condensed table-striped">
                    <thead>
                    <tr>
                      <th>Course Code</th>
                      <th>Course Title</th>
                      <th>Unit Load</th>
                      <th>Grade</th>
                      <th>Grade Point</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results51 as $result)

                    <tr>
                      <td>{{$result->course_code}}</td>
                      <td>{{$result->course_title}}</td>
                      <td>{{$result->unit_load}}</td>
                      <td>{{$result->grade}}</td>
                      <td>{{$result->point}}</td>             
                    </tr>
                    @endforeach
                  
                    </tbody>
                    
                      
                      
                    
                </table>
              </div>  
          

                @if($results52->count())
                  <div class="col-xs-12 table-responsive">
                  <div class="text-left cgpa">
                      <u><i>Final Year(final semester) Results:</i></u>
                    </div>
                      <table class="table table-bordered table-responsive table-condensed table-striped">
                        <thead>
                        <tr>
                          <th>Course Code</th>
                          <th>Course Title</th>
                          <th>Unit Load</th>
                          <th>Grade</th>
                          <th>Grade Point</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results52 as $result)

                        <tr>
                          <td>{{$result->course_code}}</td>
                          <td>{{$result->course_title}}</td>
                          <td>{{$result->unit_load}}</td>
                          <td>{{$result->grade}}</td>
                          <td>{{$result->point}}</td>             
                        </tr>
                        @endforeach
                      
                        </tbody>
                        
                          
                          
                        
                    </table>
                  
                  </div>  
                @endif
            <div class="text-center cgpa">
                  <u><i>Final Year GPA: {{$gp1}}</i></u>
            </div>
           @endif

           <div class="text-left cgpa">
                  <b><i>CUMULATIVE GPA: <span class="badge">{{$total_cgpa}}</span> </i></b>
            </div>
        </div>
       
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        
        <!-- /.col -->
        <div class="col-xs-12">
          <p class="small"><i>SIGN:</i></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Academic Advicer:</th>
                <td></td>
              </tr>
               <tr>
                <th style="width:50%">Head of Department:</th>
                <td></td>
              </tr>
              <tr>
                <th>Faculty Officer:</th>
                <td></td>
              </tr>
             
              <tr>
                <th></th>
                <td></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>
    <!-- /.content -->

    <!-- =========================================================== -->

    <!-- interacrive modal here-->
    @include('partials.admin.lecturerreg_modal')
  @endsection

  @section('myscripts')

    <script src="{{asset('js/myscripts/admin.lecturerreg.js')}}"></script>
  


  @endsection