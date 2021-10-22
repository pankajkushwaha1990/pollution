<!doctype html>
<html lang="en">


<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:51:32 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <link rel="icon" href="favicon.ico">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

<link href="{{ asset('/template/main.07a59de7b920cd76b874.css') }}" rel="stylesheet"></head>
<body>
<div class="app-container app-theme-gray">
        <div class="app-main">
            @include('Admin.left_sidebar')
            <div class="app-sidebar-overlay d-none animated fadeIn"></div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                  @include('Admin.header')
                    <div class="app-inner-layout app-inner-layout-page">
                       
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__sidebar">
                                <div class="app-layout__sidebar-inner dropdown-menu-rounded">
                                    <div class="nav flex-column">
                                        <div class="nav-item-header text-primary nav-item">
                                            Dashboards Examples
                                        </div>
                                        <a class="dropdown-item active" href="analytics-dashboard.html">Analytics</a>
                                        <a class="dropdown-item" href="management-dashboard.html">Management</a>
                                        <a class="dropdown-item" href="advertisement-dashboard.html">Advertisement</a>
                                        <a class="dropdown-item" href="index-2.html">Helpdesk</a>
                                        <a class="dropdown-item" href="monitoring-dashboard.html">Monitoring</a>
                                        <a class="dropdown-item" href="crypto-dashboard.html">Cryptocurrency</a>
                                        <a class="dropdown-item" href="pm-dashboard.html">Project Management</a>
                                        <a class="dropdown-item" href="product-dashboard.html">Product</a>
                                        <a class="dropdown-item" href="statistics-dashboard.html">Statistics</a>
                                    </div>                            </div>
                            </div>
                            <div class="app-inner-layout__content">
                                <div class="tab-content">
                                    <div class="container-fluid">
                                        <div class="mb-3 card">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                    <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
                                                    Industries
                                                </div>
                                               <!--  <div class="btn-actions-pane-right text-capitalize">
                                                    <button class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm">
                                                        View All
                                                    </button>
                                                </div> -->
                                            </div>
                                            <div class="no-gutters row">
                                                 <div class="col-sm-6 col-md-4 col-xl-4">
                                                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                                        <div class="icon-wrapper rounded-circle">
                                                            <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                                                            <i class="fa fa-industry text-white"></i></div>
                                                        <div class="widget-chart-content">
                                                            <div class="widget-subheading">Red Industries</div>
                                                            <div class="widget-numbers"><span>{{ $red }}</span></div>
                                                           <!--  <div class="widget-description opacity-8 text-focus">
                                                                Grow Rate:
                                                                <span class="text-info pl-1">
                                                <i class="fa fa-angle-down"></i>
                                                <span class="pl-1">14.1%</span>
                                            </span>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="divider m-0 d-md-none d-sm-block"></div>
                                                </div>

                                                <div class="col-sm-6 col-md-4 col-xl-4">
                                                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                                        <div class="icon-wrapper rounded-circle">
                                                            <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                                                            <i class="fa fa-industry text-dark opacity-8"></i></div>
                                                        <div class="widget-chart-content">
                                                            <div class="widget-subheading">Orange Industries</div>
                                                            <div class="widget-numbers">{{ $orange }}</div>
                                                            <!-- <div class="widget-description opacity-8 text-focus">
                                                                <div class="d-inline text-danger pr-1">
                                                                    <i class="fa fa-angle-down"></i>
                                                                    <span class="pl-1">54.1%</span>
                                                                </div>
                                                                less earnings
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="divider m-0 d-md-none d-sm-block"></div>
                                                </div>
                                               
                                                <div class="col-sm-12 col-md-4 col-xl-4">
                                                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                                        <div class="icon-wrapper rounded-circle">
                                                            <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                                                            <i class="fa fa-industry text-white"></i></div>
                                                        <div class="widget-chart-content">
                                                            <div class="widget-subheading">Green Industries</div>
                                                            <div class="widget-numbers"><span>{{ $green }}</span></div>
                                                            <!-- <div class="widget-description text-focus">
                                                                Increased by
                                                                <span class="text-warning pl-1">
                                                <i class="fa fa-angle-up"></i>
                                                <span class="pl-1">7.35%</span>
                                            </span>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center d-block p-3 card-footer">
                                                <button class="btn-pill btn-wide fsize-1 btn btn-primary">
                                <span class="mr-2 opacity-7">
                                    <i class="icon icon-anim-pulse ion-ios-analytics-outline"></i>
                                </span>
                                                    <span class="mr-1"><a href="{{ route('industries_list') }}" class="text-white">View Industries List</a></span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="mb-3 card">
                                                    <div class="card-header-tab card-header">
                                                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                            Create Fees
                                                        </div>
                                                        <!-- <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                                            <div class="btn-group dropdown">
                                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
                                                                    <i class="lnr-cog btn-icon-wrapper"></i>
                                                                </button>
                                                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                                                    <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                                                    <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                                                    </button>
                                                                    <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                                                    </button>
                                                                    <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                                                    </button>
                                                                    <div tabindex="-1" class="dropdown-divider"></div>
                                                                    <div class="p-1 text-right">
                                                                        <button class="mr-2 btn-shadow btn-sm btn btn-link">
                                                                            View
                                                                            Details
                                                                        </button>
                                                                        <button class="mr-2 btn-shadow btn-sm btn btn-primary">
                                                                            Action
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    
                                                    <div class="p-0 d-block card-footer">
                                                        <div class="grid-menu grid-menu-2col">
                                                            <div class="no-gutters row">
                                                                <div class="p-2 col-sm-6">
                                                                    <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                                        <a href="{{ route('fresh_cte_add') }}"><i class="lnr lnr-pencil text-primary opacity-7 btn-icon-wrapper mb-2"> </i>
                                                                        Fresh CTE</a>
                                                                    </button>
                                                                </div>
                                                                <div class="p-2 col-sm-6">
                                                                    <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                                        <a href="{{ route('fresh_cto_add') }}"><i class="lnr lnr-pencil text-danger opacity-7 btn-icon-wrapper mb-2"> </i>
                                                                        Fresh CTO</a>
                                                                    </button>
                                                                </div>
                                                                <div class="p-2 col-sm-6">
                                                                    <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                                        <a href="{{ route('regulation_add') }}"> <i class="lnr lnr-pencil text-success opacity-7 btn-icon-wrapper mb-2"> </i>
                                                                       Regulation</a>
                                                                    </button>
                                                                </div>
                                                                <div class="p-2 col-sm-6">
                                                                    <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                                        <a href="{{ route('reverse_calculation') }}"> <i class="lnr lnr-pencil text-warning opacity-7 btn-icon-wrapper mb-2"> </i>
                                                                        Reverse </a>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-6">
                                                <div class="card-hover-shadow-2x mb-3 card">
                                                    <div class="card-header-tab card-header">
                                                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                            <i class="header-icon lnr-database icon-gradient bg-malibu-beach"> </i>Tenure
                                                            List
                                                        </div>
                                                       <!--  <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                                            <div class="btn-group dropdown">
                                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-icon btn-icon-only btn btn-link"><i class="pe-7s-menu btn-icon-wrapper"></i></button>
                                                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                                                    <h6 tabindex="-1" class="dropdown-header">
                                                                        Header</h6>
                                                                    <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                                                    </button>
                                                                    <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                                                    </button>
                                                                    <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                                                    </button>
                                                                    <div tabindex="-1" class="dropdown-divider"></div>
                                                                    <div class="p-3 text-right">
                                                                        <button class="mr-2 btn-shadow btn-sm btn btn-link">
                                                                            View Details
                                                                        </button>
                                                                        <button class="mr-2 btn-shadow btn-sm btn btn-primary">
                                                                            Action
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="scroll-area-lg" style="height:300px;">
                                                        <div class="scrollbar-container ps ps--active-y">
                                                            <div class="p-2">
                                                                <ul class="todo-list-wrapper list-group list-group-flush">
                                                                    @forelse ($roles as $role)
                                                                     <li class="list-group-item">
                                                                        <div class="todo-indicator bg-warning"></div>
                                                                        <div class="widget-content p-0">
                                                                            <div class="widget-content-wrapper">
                                                                                <div class="widget-content-left mr-2">
                                                                                    <!-- <div class="custom-checkbox custom-control">
                                                                                        <input type="checkbox" id="exampleCustomCheckbox12" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox12">&nbsp;</label>
                                                                                    </div> -->
                                                                                </div>
                                                                                <div class="widget-content-left">
                                                                                    <div class="widget-heading"><?php 
                                                            if($role->from!=0){
                                                                echo date('d/m/Y',strtotime($role->from));
                                                            }else{
                                                                 echo "Before";
                                                            }  ?> -  {{ 
                                                             date('d/m/Y',strtotime($role->to)) }}
                                                                                        <div class="badge badge-danger ml-2">
                                                                                            <a style="color:white;" href="{{ route('tenure_fee_details',['id'=>$role->id]) }}">Fee</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="widget-subheading"><i>
                                                                                        </i></div>
                                                                                </div>
                                                                                <!-- <div class="widget-content-right widget-content-actions">
                                                                                    <button class="border-0 btn-transition btn btn-outline-success">
                                                                                        <i class="fa fa-check"></i>
                                                                                    </button>
                                                                                    <button class="border-0 btn-transition btn btn-outline-danger">
                                                                                        <i class="fa fa-trash-alt"></i>
                                                                                    </button>
                                                                                </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                       
                                                    @empty
                                                       
                                                    @endforelse
                                                                   
                                                                   
                                                                </ul>
                                                            </div>
                                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 400px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 218px;"></div></div></div>
                                                    </div>
                                                    <!-- <div class="d-block text-right card-footer">
                                                        <button class="mr-2 btn btn-link btn-sm">Cancel</button>
                                                        <button class="btn btn-primary">Add Task</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                               
                                        </div>


                                        </div>
                                        <div class="app-inner-bar">
                           <div class="inner-bar-center">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a role="tab" data-toggle="tab" class="nav-link active" href="#tab-content-0">
                                            <span>Red Large & Medium Scale  <br> 01/April - 31/March</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" data-toggle="tab" class="nav-link active" href="#tab-content-1">
                                            <span>Red Small Scale Industry <br> 01/October - 30/September</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" data-toggle="tab" class="nav-link" href="#tab-content-2" style="color:orange;">
                                            <span>Orange <br> 01/July - 31/June</span>
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                                                                <a role="tab" data-toggle="tab" class="nav-link" href="#tab-content-2" style="color:green;">
                                            <span>Green <br> 01/January - 31/December</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                    </div>

                                    </div>
                                      <!--  <div class="row">
                                            <div class="col-md-6 col-xl-4">
                                                <div class="card mb-3 widget-content bg-night-fade">
                                                    <div class="widget-content-wrapper text-white">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Today Api Count</div>
                                                            <div class="widget-subheading">{{ date('d/m/Y') }}</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-white"><span>1896</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <div class="card mb-3 widget-content bg-arielle-smile">
                                                    <div class="widget-content-wrapper text-white">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Total Api Count</div>
                                                            <div class="widget-subheading"></div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-white"><span>568</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-4">
                                                <div class="card mb-3 widget-content bg-happy-green">
                                                    <div class="widget-content-wrapper text-white">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Followers</div>
                                                            <div class="widget-subheading">People Interested</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-white"><span>46%</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                                                <div class="card mb-3 widget-content bg-premium-dark">
                                                    <div class="widget-content-wrapper text-white">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Products Sold</div>
                                                            <div class="widget-subheading">Revenue streams</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-warning"><span>$14M</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        
                                       <!--  <div class="card no-shadow bg-transparent no-border rm-borders mb-3">
                                            <div class="card">
                                                <div class="no-gutters row">
                                                    <div class="col-md-12 col-lg-4">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="bg-transparent list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-outer">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left">
                                                                                <div class="widget-heading">Total Orders
                                                                                </div>
                                                                                <div class="widget-subheading">Last year
                                                                                    expenses
                                                                                </div>
                                                                            </div>
                                                                            <div class="widget-content-right">
                                                                                <div class="widget-numbers text-success">
                                                                                    1896
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="bg-transparent list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-outer">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left">
                                                                                <div class="widget-heading">Clients</div>
                                                                                <div class="widget-subheading">Total Clients
                                                                                    Profit
                                                                                </div>
                                                                            </div>
                                                                            <div class="widget-content-right">
                                                                                <div class="widget-numbers text-primary">
                                                                                    $12.6k
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12 col-lg-4">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="bg-transparent list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-outer">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left">
                                                                                <div class="widget-heading">Followers</div>
                                                                                <div class="widget-subheading">People
                                                                                    Interested
                                                                                </div>
                                                                            </div>
                                                                            <div class="widget-content-right">
                                                                                <div class="widget-numbers text-danger">
                                                                                    45,9%
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="bg-transparent list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-outer">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left">
                                                                                <div class="widget-heading">Products Sold
                                                                                </div>
                                                                                <div class="widget-subheading">Total revenue
                                                                                    streams
                                                                                </div>
                                                                            </div>
                                                                            <div class="widget-content-right">
                                                                                <div class="widget-numbers text-warning">
                                                                                    $3M
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12 col-lg-4">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="bg-transparent list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-outer">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left">
                                                                                <div class="widget-heading">Total Orders
                                                                                </div>
                                                                                <div class="widget-subheading">Last year
                                                                                    expenses
                                                                                </div>
                                                                            </div>
                                                                            <div class="widget-content-right">
                                                                                <div class="widget-numbers text-success">
                                                                                    1896
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="bg-transparent list-group-item">
                                                                <div class="widget-content p-0">
                                                                    <div class="widget-content-outer">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left">
                                                                                <div class="widget-heading">Clients</div>
                                                                                <div class="widget-subheading">Total Clients
                                                                                    Profit
                                                                                </div>
                                                                            </div>
                                                                            <div class="widget-content-right">
                                                                                <div class="widget-numbers text-primary">
                                                                                    $12.6k
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('Admin.footer')

            </div>
        </div>
</div>

<div class="app-drawer-overlay d-none animated fadeIn"></div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script></body>

<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
