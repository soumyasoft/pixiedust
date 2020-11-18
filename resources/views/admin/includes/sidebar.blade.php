<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/home') }}" class="brand-link"> <img src="{{ asset('public/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> <span class="brand-text font-weight-light">Pixie Dust</span> </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image"> <img src="{{ asset('public/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> </div>
            <div class="info"> <a href="#" class="d-block"> {{ Auth::user()->name }}</a> </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview {{ Request::is('admin/my-account') ? 'menu-open' : Request::is('admin/change-password') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/my-account') ? 'active' : Request::is('admin/change-password') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-cog"></i>
                        <p> Account Settings <i class="fa fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/my-account') }}" class="nav-link {{ Request::is('admin/my-account') ? 'active' : '' }}"> 
                                <i class="fa fa-user nav-icon"></i>
                                <p>My Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/change-password') }}" class="nav-link {{ Request::is('admin/change-password') ? 'active' : '' }}"> 
                                <i class="fa fa-key nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pages.index') }}" class="nav-link {{ Request::is('admin/pages') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>Manage CMS Pages</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('banners.index') }}" class="nav-link {{ Request::is('admin/banners') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-image"></i>
                        <p>Manage Banner</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/newsletter') }}" class="nav-link {{ Request::is('admin/newsletter') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>Manage News Letter</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ Request::is('admin/product-categories') ? 'menu-open' : Request::is('admin/product-subcategories') ? 'menu-open' : Request::is('admin/products') ? 'menu-open':''  }}">
                    <a href="#" class="nav-link {{ Request::is('admin/product-categories') ? 'active' : Request::is('admin/product-subcategories') ? 'active' : Request::is('admin/products') ? 'active':'' }}"> <i class="nav-icon fa fa-product-hunt"></i>
                        <p>Products<i class="fa fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product-categories.index') }}" class="nav-link {{ Request::is('admin/product-categories') ? 'active' : '' }}"> 
                                <i class="nav-icon fa fa-list-ul"></i>
                                <p>Manage Product Category</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product-subcategories.index') }}" class="nav-link {{ Request::is('admin/product-subcategories') ? 'active' : '' }}"> 
                                <i class="nav-icon fa fa-list-ul"></i>
                                <p>Manage Product Sub Category</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link {{ Request::is('admin/products') ? 'active' : '' }}"> 
                                <i class="nav-icon fa fa-product-hunt"></i>
                                <p>Manage Products</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/coupon-code') }}" class="nav-link {{ Request::is('admin/coupon-code') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-tags"></i>
                        <p>Manage Coupon Code</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ Request::is('admin/manage-customers') ? 'menu-open' : Request::is('admin/manage-orders') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/manage-customers') ? 'active' : Request::is('admin/manage-orders') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-users"></i>
                        <p> Customer Management <i class="fa fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/manage-customers') }}" class="nav-link {{ Request::is('admin/manage-customers') ? 'active' : '' }}">
                                <i class="fa fa-user nav-icon"></i>
                                <p>Manage Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/manage-orders') }}" class="nav-link {{ Request::is('admin/manage-orders') ? 'active' : '' }}"> 
                                <i class="fa fa-shopping-cart nav-icon"></i>
                                <p>Manage Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ Request::is('admin/payment-setting') ? 'menu-open' : Request::is('admin/seo-setting') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/payment-setting') ? 'active' : Request::is('admin/seo-setting') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-cog"></i>
                        <p> Other Settings <i class="fa fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/admin/payment-setting') }}" class="nav-link {{ Request::is('admin/payment-setting') ? 'active' : '' }}">
                                <i class="fa fa-money nav-icon"></i>
                                <p>Payment Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/seo-setting') }}" class="nav-link {{ Request::is('admin/seo-setting') ? 'active' : '' }}"> 
                                <i class="fa fa-search nav-icon"></i>
                                <p>SEO Setting</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ Request::is('admin/intutive-readers') ? 'menu-open' : Request::is('admin/intutive-price-setting') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/intutive-readers') ? 'active' : Request::is('admin/intutive-price-setting') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-cog"></i>
                        <p> Manage Intuitive Readers <i class="fa fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/intutive-readers') }}" class="nav-link {{ Request::is('admin/intutive-readers') ? 'active' : '' }}"> 
                                <i class="nav-icon fa fa-hand-lizard-o"></i>
                                <p>Intuitive Readers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/intutive-price-setting') }}" class="nav-link {{ Request::is('admin/intutive-price-setting') ? 'active' : '' }}"> 
                                <i class="fa fa-dollar nav-icon"></i>
                                <p>Price Setting</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview {{ Request::is('admin/massage-therapists') ? 'menu-open' : Request::is('admin/massage-therapists-price-setting') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/massage-therapists') ? 'active' : Request::is('admin/massage-therapists-price-setting') ? 'active' : '' }}"> 
                        <i class="nav-icon fa fa-cog"></i>
                        <p>Manage Massage Therapists<i class="fa fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/massage-therapists') }}" class="nav-link {{ Request::is('admin/massage-therapists') ? 'active' : '' }}"> 
                                <i class="nav-icon fa fa-plus"></i>
                                <p>Massage Therapists</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/massage-therapists-price-setting') }}" class="nav-link {{ Request::is('admin/massage-therapists-price-setting') ? 'active' : '' }}"> 
                                <i class="fa fa-dollar nav-icon"></i>
                                <p>Price Setting</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="nav-icon fa fa-sign-out"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>