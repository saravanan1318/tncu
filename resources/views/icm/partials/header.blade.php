<!-- Main Sidebar Container -->
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
           <a href="{{url('/icm/dashboard')}}" class="nav-link">
             <i class="nav-icon fas fa-th"></i>
             <p>
               Dashboard
              
             </p>
           </a>
         </li>
         <li class="nav-header">MISCELLANEOUS</li>
         <li class="nav-item">
           <a href="{{url('/icm/applicationlist')}}" class="nav-link">
             <i class="nav-icon fas fa-ellipsis-h"></i>
             <p>Pending Applications
               {{-- <span class="right badge badge-danger">5</span> --}}
             </p>
           </a>
         </li>
         <li class="nav-item">
          <a href="{{url('/icm/selectedapplicationlist')}}" class="nav-link">
            <i class="nav-icon fas fa-ellipsis-h"></i>
            <p>Selected Applications
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