<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(isset($student->profile_pic) && ($student->profile_pic != null))
          <img src="/storage/profile_images/{{$student->profile_pic}}" alt="{{$student->profile_pic}}" class="img-circle">
          @else
          <img src="../../dist/img/user1-128x128.jpg" class="img-circle">
          @endif
          <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
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
          <a href="/student/dashboard">
            <i class="active fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="/admin/registerlect">
            <i class="fa fa-certificate"></i>
            <span>My Courses</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">+</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/student/mycourses"><i class="fa fa-circle-o"></i>View My Courses</a></li>
            <li><a href="/student/registered_courses"><i class="fa fa-circle-o"></i>View Registered Courses</a></li>
            <li><a href="/student/register_courses"><i class="fa fa-circle-o"></i>Register New Courses</a></li>
            <li><a href="/student_edit_registered"><i class="fa fa-circle-o"></i>Edit Registered Courses</a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="/admin/registerlect">
            <i class="fa fa-certificate"></i>
            <span>My Results</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">+</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/student/results"><i class="fa fa-circle-o"></i>View My Results</a></li>
            <li><a href="/student/result_statement"><i class="fa fa-circle-o"></i>My Statement of Result</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>My Profile</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">+</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/student_profile"><i class="fa fa-circle-o"></i>View My Profile</a></li>
            <li><a href="/student_edit_profile"><i class="fa fa-circle-o"></i>Edit My Profile</a></li>
          </ul>
        </li>



      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
