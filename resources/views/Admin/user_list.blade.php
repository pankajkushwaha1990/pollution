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
            @include('admin.left_sidebar')
            <div class="app-sidebar-overlay d-none animated fadeIn"></div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                  @include('admin.header')
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
                            <div class="app-inner-layout__content" style="padding: 0px 15px 0;">
                                <div class="tab-content">
                                    <div class="container-fluid">
                                         @if (\Session::has('error_message'))
                                                <!-- <div class="alert alert-warning"> -->
                                        <div class="card mb-3">
                                            <div class="card-header-tab card-header">
                                                    <ul>
                                                        <li class="text text-danger">{!! \Session::get('error_message') !!}</li>
                                                    </ul>
                                        </div>
                                                <!-- </div> -->
                                            @endif

                                        <div class="card mb-3">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                                    <i class="header-icon lnr-laptop-phone mr-3 text-muted opacity-6"> </i>User List
                                                </div>

                                                <div class="btn-actions-pane-right actions-icon-btn">

                                                    <div class="btn-group dropdown">
                                                        <button type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"
                                                                class="btn-icon btn-icon-only btn btn-link"><i
                                                                class="pe-7s-menu btn-icon-wrapper"></i></button>
                                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                                             class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                                            <h6 tabindex="-1" class="dropdown-header">
                                                                Action</h6>
                                                            <button type="button" tabindex="0" class="dropdown-item">
                                                                <i class="dropdown-icon lnr-inbox"> </i><span><a href="{{ route('user_add') }}">Add New</a></span>
                                                            </button>
                                                          <!--   <button type="button" tabindex="0" class="dropdown-item"><i
                                                                    class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                                                            </button>
                                                            <button type="button" tabindex="0" class="dropdown-item"><i
                                                                    class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                                            </button> -->
                                                            <div tabindex="-1" class="dropdown-divider"></div>
                                                          <!--   <div class="p-3 text-right">
                                                                <button class="mr-2 btn-shadow btn-sm btn btn-link">View
                                                                    Details
                                                                </button>
                                                                <button class="mr-2 btn-shadow btn-sm btn btn-primary">
                                                                    Action
                                                                </button>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table style="width: 100%;" id="example"
                                                       class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Role</th>
                                                        <th>Email</th>
                                                        <th>Username</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                      @forelse ($users as $user)
                                                        <tr>
                                                           <td>{{ ucfirst($user->first_name) }}</td>
                                                           <td>{{ ucfirst($user->last_name) }}</td>
                                                           <td>{{ ucfirst($user->role_name) }}</td>
                                                           <td>{{ ucfirst($user->email) }}</td>
                                                           <td>{{ ucfirst($user->username) }}</td>
                                                           <td>
                                                              <a href="{{ route('user_edit',['id'=>$user->id]) }}"><i class="header-icon lnr lnr-pencil mr-3 text-success"> </i></a>
                                                              
                                                        <a data-toggle="modal" class="delete_user" data-target="#exampleModal" href="{{ route('user_delete',['id'=>$user->id]) }}"><i class="header-icon lnr lnr-trash mr-3 text-danger"> </i></a>
                                                          </td>
                                                         </tr>
                                                    @empty
                                                       
                                                    @endforelse
                                                  
                                                  
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                         <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Role</th>
                                                        <th>Email</th>
                                                        <th>Username</th>
                                                        <th>Action</th>

                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        
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
                @include('admin.footer')

            </div>
        </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are your sure, want to remove this user ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
               <!--  <p>Reason for delete</p>
                
               <textarea class="form-control"></textarea> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="" class="remove_user"><button type="button" class="btn btn-primary">Yes</button></a>
            </div>
        </div>
    </div>
</div>

<div class="app-drawer-overlay d-none animated fadeIn"></div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
<script type="text/javascript">
    $(function(){
        $('.delete_user').click(function(){
            var link = $(this).attr('href');
            $('.remove_user').attr('href',link);
        })
    })
</script>

<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
