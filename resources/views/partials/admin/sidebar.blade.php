<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(isset($lecturer->profile_pic) && ($lecturer->profile_pic != null))
          <img src="/storage/profile_images/{{$lecturer->profile_pic}}" alt="{{$lecturer->profile_pic}}" class="img-circle">
          @else
          <img src="../../dist/img/user1-128x128.jpg" class="img-circle">
          @endif
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="/dashboard">
            <i class="active fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li>
          <a href="/admin/semses">
            <i class="fa fa-clone"></i> <span>Session and Semester</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><i class="fa fa-gears"></i></small>
            </span>
          </a>
        </li>
         <li>
          <a href="/admin/levcou">
            <i class="fa fa-files-o"></i> <span>Levels and Courses</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-blue"><i class="fa fa-pencil"></i></small>
            </span>
          </a>
        </li>
        <li>
          <a href="/admin/registerlect">
            <i class="fa fa-certificate"></i> <span>Register Lecturers</span>
            <span class="pull-right-container">
               <span class="label label-primary pull-right">+</span>
            </span>
          </a>
        </li>
         <li>
          <a href="/admin/registerstud">
            <i class="fa fa-users"></i> <span>Register Students</span>
            <span class="pull-right-container">
               <span class="label label-primary pull-right">*</span>
            </span>
          </a>
        </li>

        <li>
          <a href="/admin/assigncourses">
            <i class="fa fa-user"></i> <span>Assign Courses</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">[]</small>
            </span>
          </a>
        </li>

        <li>
          <a href="/admin/assignstudents">
            <i class="fa fa-user"></i> <span>Assign Students</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">[/]</small>
            </span>
          </a>
        </li>
       <li class="treeview">
          <a href="#">
            <i class="fa fa-upload"></i>
            <span>Promote Students</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">+</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/promote_students"><i class="fa fa-circle-o"></i>Promote/Demote Students</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-certificate"></i>
            <span>Results</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">+</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/viewresults"><i class="fa fa-circle-o"></i>View all Results</a></li>
            <li><a href="/admin/approveresults"><i class="fa fa-circle-o"></i>Approve Results</a></li>
          </ul>
        </li>
        <li>
          <a href="/admin/password_reset">
            <i class="fa fa-pencil"></i> <span>Reset Password</span>
            <span class="pull-right-container">
               <span class="label label-primary pull-right">+</span>
            </span>
          </a>
        </li>
        <li>
          <a href="/admin/profile">
            <i class="fa fa-pencil"></i> <span>Profile</span>
            <span class="pull-right-container">
               <span class="label label-primary pull-right">+</span>
            </span>
          </a>
        </li>
        <li>
          <a href="/admin/generate_classlist">
            <i class="fa fa-print"></i> <span>Generate Class List</span>
            <span class="pull-right-container">
               <span class="label label-primary pull-right">+</span>
            </span>
          </a>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
