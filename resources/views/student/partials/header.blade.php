<!-- Main Sidebar Container -->
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="#" class="brand-link">
     <span class="brand-text font-weight-light">ICM Panel</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="{{asset('images/tncu-logo.png')}}" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">{{ Auth::user()->name }}</a>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="{{url('/student/studentdashboard')}}" class="nav-link">
             <i class="nav-icon fas fa-th"></i>
             <p>
               Dashboard

             </p>
           </a>
         </li>

        <li class="nav-header">User Management</li>
        <li class="nav-item">
          <a href="{{url('/icm/passwordChange')}}" class="nav-link">
            <i class="nav-icon fas fa-ellipsis-h"></i>
            <p>Change Password
              {{-- <span class="right badge badge-danger">5</span> --}}
            </p>
          </a>
        </li>
        <li class="nav-item">
           <a href="{{url('logout')}}" class="nav-link">
             <i class="nav-icon fas fa-file"></i>
             <p>Logout</p>
           </a>
         </li>
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>