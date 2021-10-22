<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Login | {{ config('app.project_name')  }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="Kero HTML Bootstrap 4 Dashboard Template">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

<link href="{{ asset('/template/main.07a59de7b920cd76b874.css') }}"  rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style type="text/css">
.input-error {
    color: #ff5555;
}
.rc-anchor {
    border-radius: 35px !important;
}
</style>

<body>
    <div class="app-container app-theme-white body-tabs-shadow">
            <div class="app-container">
                <div class="h-100 bg-plum-plate bg-animation">
                    <div class="d-flex h-100 justify-content-center align-items-center">
                        <div class="mx-auto app-login-box col-md-8">
                            <div class="mx-auto mb-3"></div>
                            <div class="modal-dialog w-100 mx-auto">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="h5 modal-title text-center">
                                            <h4 class="mt-2">
                                                <div ><img src="{{ asset('/template/assets/images') }}/logo_0.png">&nbsp;&nbsp;<span class="text-default-d3 company_text" >Punjab Pollution Control Board</span></div>
                                                <!-- <span>Please sign in to your account below.</span> -->
                                            </h4>
                                        </div>
                                        <form action="{{ route('login_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="position-relative form-group">
                                                        <input name="email" id="exampleEmail" required="" placeholder="Email here..." type="email" class="form-control">
                                                        @if($errors->has('email'))
                                                        <span class="text text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="position-relative form-group">
                                                        <input name="password" required="" id="examplePassword" placeholder="Password here..." type="password" class="form-control">
                                                         @if($errors->has('password'))
                                                        <span class="text text-danger">{{ $errors->first('password') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                 <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group" style="margin-left: 48px;">
                                                            <div id="example3"></div>

                                                         </div>
                                                    </div>
                                             </div>


                                            </div>
                                           <!--  <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Keep me logged in</label></div> -->
                                        <div class="divider"></div>
                                        <!-- <h5 class="mb-0"> -->
                                            @if (\Session::has('error_message'))
                                                <!-- <div class="alert alert-warning"> -->
                                                    <ul>
                                                        <li class="text text-danger">{!! \Session::get('error_message') !!}</li>
                                                    </ul>
                                                <!-- </div> -->
                                            @endif
                                        <!-- </h5> -->
                                    </div>
                                    <div class="modal-footer clearfix">
                                       <!--  <div class="float-left"><a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a></div> -->
                                        <div class="float-right">
                                            <button  type="submit" class="btn submit_button btn-primary btn-lg">Login to Dashboard</button>
                                        </div>
                                    </div>
                                  </form>
                                </div>
                            </div>
                            <div class="text-center text-white opacity-8 mt-3">Copyright © {{ config('app.project_name')  }} 2021</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script></body>
</html>
