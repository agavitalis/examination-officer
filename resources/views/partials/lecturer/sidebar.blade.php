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
          <a href="/lecturer/dashboard">
            <i class="active fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-certificate"></i>
            <span>My Courses</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">+</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/lecturer/l_courses"><i class="fa fa-circle-o"></i>View Assigned Courses</a></li>
            <li title="These students registered for your courses"><a href="/lecturer/course_students"><i class="fa fa-circle-o"></i>View Your Students</a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-certificate"></i>
            <span title="You are assigned to assist these students academically">My Students</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">+</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/lecturer/l_students"><i class="fa fa-circle-o"></i>View List</a></li>
            <li><a href="/lecturer/unapproved_courses"><i class="fa fa-circle-o"></i>Approve their Courses</a></li>
            <li><a href="/lecturer/approved_courses"><i class="fa fa-circle-o"></i>Courses I approved</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Results</span>
            <span class="pull-right-container">
              <span class="label bg-green pull-right">+</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/lecturer/course_results"><i class="fa fa-circle-o"></i>View My Course Results</a></li>
            <li><a href="/lecturer/students_results"><i class="fa fa-circle-o"></i>View My Student Results</a></li>
            <li><a href="/lecturer/upload_results"><i class="fa fa-circle-o"></i>Upload My Results</a></li>
          </ul>
        </li>
        <li title="Print Class List of Choice">
          <a href="/lecturer/l_classlist">
            <i class="fa fa-user"></i> <span>Print Class List</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">-</small>
            </span>
          </a>
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
            <li><a href="/lecturer/l_profile"><i class="fa fa-circle-o"></i>View My Profile</a></li>
            <li><a href="/lecturer_edit_profile"><i class="fa fa-circle-o"></i>Edit My Profile</a></li>
          </ul>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
