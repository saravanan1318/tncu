@extends('layouts.master')

@section('content')
<div class="col-sm-12 col-md-11 mx-auto p-3 body-cards bg-white">
    <div class="row">
       <div class="col-sm-12 col-md-3 mb-4">
          <!-- <h6 style="text-align: center; background-color: #c00; padding: 8px; color: white;">
             <i class="fa fa-bell" aria-hidden="false"></i>IMPORTANT NOTIFICATIONS</h6> -->
          <nav class="nav flex-column d-block imponoti mb-2 p-2 ">
             <h6><i class='fa fa-bell'></i>IMPORTANT NOTIFICATIONS</h6>
             <div class="block-hdnews" >
                <div class="list-wrpaaer nav flex-column d-block  mb-2 p-2 " style="height:337px">
                   <ul class="list-aggregate" id="">
                      <li>
                         <a href="#" style="color: darkred;">
                           Diploma Course Online Application 2023 - 2024 is closed
                            <img src="{{asset('images/new.gif')}}" alt="Blink New">
                         </a>
                      </li>
                   </ul>
                </div>
                <!-- list-wrpaaer -->
             </div>
             <h6>
                <a data-toggle="modal" data-target="#whatsnewPopupModal" style="color: whitesmoke;cursor: pointer;"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
                View All Notifications</a>
             </h6>
          </nav>
       </div>
       <div class="col-sm-12 col-md-6 mx-auto">
          <div id="carousel2_indicator" class="carousel slide carousel-fade" data-ride="carousel">
             <div class="carousel-inner">
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
                <div class="carousel-item">
                   <div class="work">
                      <img class="d-block w-100"  src="{{asset('images/tncubanner.jpeg')}}" alt="First slide" height="450">
                      <!--                                 <article class="carousel-caption d-none d-md-block">
                         <h5>First slide label</h5>
                         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                         </article> -->
                   </div>
                </div>
             </div>
             <a class="carousel-control-prev" href="#carousel2_indicator" role="button" data-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="sr-only">Previous</span>
             </a>
             <a class="carousel-control-next" href="#carousel2_indicator" role="button" data-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="sr-only">Next</span>
             </a>
          </div>
          <!-- ==================  2-carousel bootstrap.// ==================  -->
          <br/>
       </div>
       <div class="col-sm-12 col-md-3 ml-auto">
          <div class="d-block">
            <nav class="nav flex-column d-block impo_link  mb-2 p-2">
                <h6>
                   <center style="background-color: #028482; padding: 8px; color: #fff; font-weight: 700;"><i class="fa fa-link" aria-hidden="true"></i>&nbsp;IMPORTANT LINKS</center>
                </h6>
                <a class="nav-link" href="./doc/DCM Prospects 2023-24-NEW.pdf"><i class="fa fa-link" aria-hidden="true"></i> How To Apply</a>
                <a class="nav-link" href="/doc/ALL ICM ADDRESS 2023.pdf"><i class="fa fa-link" aria-hidden="true"></i> Help To Contact</a>
                <a class="nav-link" href="/doc/Advertisement.pdf"><i class="fa fa-link" aria-hidden="true"></i> Advertisement</a>
              <!--  <a class="nav-link" href="#"><i class="fa fa-link" aria-hidden="true"></i>FAQ</a> -->


                 <div class="card-body list-group-design3 p-0">
                     <div class="implinks" id="implink">

                     </div>
                </div>
            </nav>
          </div>
       </div>
    </div>

@endsection
