<!-- header div -->
<div class="col-sm-12 col-md-11 mx-auto">
    <div class="mb-4 logosection">
       <div class="d-block d-md-inline-block text-center">
          <a href="index.php">
             <img class="d-inline-block mx-1" alt="TamilNadu Logo"  src="{{asset('images/log.png')}}" width="80">
          </a>
       </div>
       <div class="d-block d-md-inline-block text-center text-md-left ml-2 logotext ">
          <span class="d-block">{{ __('header.tnhead') }}</span>
          <span class="d-block"> {{__('header.gvhead')}}</span>
       </div>
       <img class="d-none d-md-inline-block float-right mr-5" alt="Logo"  src="{{asset('images/tncu-logo.png')}}" width="92">
    </div>
    <!-- navbar -->
    <nav class="navbar navbar-expand-xl navbar-light bg-green main-navbar" data-blast="bgColor" >
       <!-- <a class="navbar-brand pb-2 d-block d-md-none" href="javascript:void(0)" style="color: aliceblue;">பட்டி</a> -->
       <a class="navbar-brand pb-2 d-block d-md-none" href="javascript:void(0)" style="color: aliceblue;"></a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
             <li class="nav-item active">
                <a class="nav-link" href="/"> {{__('header.hhome')}} <span class="sr-only">(current)</span></a>
             </li>
             <li class="nav-item dropdown">
                <a class="nav-link" href="/about-us"> {{__('header.abt')}}</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="/doc/ALL%20ICM%20ADDRESS%202023.pdf"> {{__('header.rgl')}}</a>
             </li>
             <li class="nav-item">
                <a class="nav-link" href="/doc/Advertisement.pdf"> {{__('header.wpp')}}</a>
                         </li>
          </ul>
          </li>
          </ul>
       </div>
    </nav>
    <!-- /navbar -->
 </div>
 <!-- /header div -->
