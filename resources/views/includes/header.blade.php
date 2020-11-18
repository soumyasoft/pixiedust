<!-- Header
============================================= -->
<div id="header">
    <header class="header-row">
        <div class="container">
            <div class="table-container">
                <!-- Top Bar
                  ============================================= -->
                <nav class="htop col-md-9 pull-right flip inner" id="top"> 
                    <div id="top-links" class="nav pull-right flip">
                        @if(session()->get('user_id') == "")
                        <ul>
                            <li><a href="{{ url('/user-login') }}">Login</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#register">Register</a></li>
                        </ul>     
                        @else
                        <div class="header-menu">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" style="font-weight:bold;">
                                        <i class="fa fa-user my-ac" style="font-size:16px;"></i> My Account <i class="fa fa-angle-down" style="font-weight:bold;"></i>                                  </a> 
                                    <ul>
                                        <li><a href="{{ url('/my-account') }}">my account</a></li>
                                        <li><a href="{{ url('/change-password') }}">Change Password</a></li>                                       
                                        <li><a href="{{ url('/user-logout') }}">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </nav><!-- Top Bar End -->
                <!-- Logo============================================= -->
                <div class="col-table-cel col-md-3 col-sm-4 col-xs-12 inner">
                    <div id="logo"><a href="{{ url('/') }}"><img src="{{ asset('public/images/logo.png') }}" title="Pixie Dust" alt="Pixie Dust" /></a></div>
                </div><!-- Logo End -->

                <!-- Phone and Email
                ============================================= -->
                <div class="col-md-4 col-md-push-5 col-sm-8 col-xs-12 inner">
                    <div class="links_contact pull-right flip">
                        <ul>
                            <li class="mobile"><i class="fa fa-phone"></i>{{ getAdminDetails()->contact_no }}</li>
                            <li class="email"><a href="mailto:support@Pixie Dust.com"><i class="fa fa-envelope"></i>{{ getAdminDetails()->alt_email }}</a></li>
                        </ul>
                    </div>
                </div><!-- Phone and Email End-->
                <div class="clearfix visible-sm-block visible-xs-block"></div>
                <!-- Mini Cart
                ============================================= -->
                <div class="col-md-9 pull-right col-sm-4 col-xs-12 inner">
                    <div id="cart">
                        <a href="{{ url('/cart') }}" data-loading-text="Loading..." class="heading dropdown-toggle">
                            <span class="cart-icon pull-left flip"></span>
                            <span><span id="cart-total">{{ cartDetails()->total_quantity ? cartDetails()->total_quantity : 0 }}</span> item(s)</span> </a>
                    </div>
                </div><!-- Mini Cart End-->
            </div>
        </div>
    </header>

    <!-- Main Menu
    ============================================= -->
    <nav id="menu" class="navbar wide">
        <div class="container">
            <div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <i class="fa fa-align-justify pull-right flip"></i></span></div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('about-us') }}">About Us</a></li>                    
                    <li class="dropdown"><a href="{{ url('/products') }}">Products</a>
                        <div class="dropdown-menu">
                            <ul>
                                @php
                                $getCategories = getAllCategories();                               
                                @endphp
                                @foreach($getCategories as $getCategory)
                                                                
                                <li class="dropdown"><a href="{{ url('/category/'.$getCategory->slug) }}">{{ $getCategory->name }}  @if(getAllSubCategories($getCategory->id)->count() > 0)<i class="fa fa-angle-right"></i> @endif</a>
                                    @if(getSubCategories($getCategory->id))
                                    <div class="dropdown-menu">
                                        <ul>
                                            @foreach(getAllSubCategories($getCategory->id) as $getAllSubCategory)                                          
                                            <li><a href="{{ url('/category/'.$getCategory->slug.'/'.$getAllSubCategory->slug) }}">{{ $getAllSubCategory->name }}</a></li>
                                            @endforeach                                          
                                        </ul>
                                    </div>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                    <li class="active"><a href="#">Events</a></li>
                    <li class="active"><a href="{{ url('/psychic-reading') }}">Psychic Reading</a></li>
                </ul>
            </div>  
        </div>
    </nav><!-- Header End-->
</div>