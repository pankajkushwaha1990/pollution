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

<link href="{{ asset('/template/main.07a59de7b920cd76b874.css') }}" rel="stylesheet">


</head>

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
                            <div class="app-inner-layout__content" style="padding: 00px 0px 0">
                                <div class="tab-content">
                                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0"
                                         role="tabpanel">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ route('user_add_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body"><h5 class="card-title">Add New User</h5>
                                                           
                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">First Name</label>
                                                                    <input name="first_name" id="first_name" placeholder="Enter First Name" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('first_name'))
                                                        <span class="text text-danger">{{ $errors->first('first_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Last Name</label>
                                                                    <input name="last_name" id="last_name" placeholder="Enter Last Name" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('last_name'))
                                                        <span class="text text-danger">{{ $errors->first('last_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>                                                           
                                                            </div>


                                                             <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Email Address</label>
                                                                    <input name="email" id="first_name" placeholder="Enter email Address" type="email"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('email'))
                                                        <span class="text text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Select Role</label>
                                                                    <select class="form-control" name="role" required="">
                                                                      <option value="">Select Role</option>
                                                                      
                                                                      @foreach ($roles as $key => $value) 
                                                                          <option value="{{ $value->id }}">{{ $value->role_name }}</option>
                                                                      @endforeach
                                                                    </select>
                                                                     @if($errors->has('role'))
                                                        <span class="text text-danger">{{ $errors->first('role') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>                                                           
                                                            </div>


 <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Username</label>
                                                                    <input name="username" id="username" placeholder="Enter username" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('username'))
                                                        <span class="text text-danger">{{ $errors->first('username') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Password</label>
                                                                    <input name="password" id="password" placeholder="Enter Password" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('password'))
                                                        <span class="text text-danger">{{ $errors->first('password') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>                                                           
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-11"></div>
                                                                 <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                     <button class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                               
                                                               
                                                                
                                                                
                                                            
                                                        </div>
                                                    </div>
                                                </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
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

<div class="app-drawer-overlay d-none animated fadeIn"></div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script></body>
<script type="text/javascript">
  
</script>

<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
