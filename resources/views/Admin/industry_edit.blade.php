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
            @include('Admin.left_sidebar')
            <div class="app-sidebar-overlay d-none animated fadeIn"></div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                  @include('Admin.header')
                    <div class="app-inner-layout app-inner-layout-page">
                       
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__content" style="padding: 00px 0px 0">
                                <div class="tab-content">
                                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0"
                                         role="tabpanel">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ route('industry_edit_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <input type="hidden" name="industry_id" value="{{ $user->id }}" />
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body"><h5 class="card-title">Edit Industry</h5>
                                                           
                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Name</label>
                                                                    <input name="industry_name" id="industry_name" placeholder="Enter Industry Name" type="text" value="{{ $user->industry_name }}" 
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('industry_name'))
                                                        <span class="text text-danger">{{ $errors->first('industry_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Category</label>
                                                                    <select name="industry_category" id="industry_category" class="form-control" required="">
                                                                        <option value="">Select Category</option>
                                                                        @foreach($industry_category as $category)
                                                                        <option 
                                                                        <?php 
                                                                        if($category->id==$user->industry_category){
                                                                            echo 'selected';
                                                                        }
                                                                        ?>


                                                                         value="{{ $category->id }}">{{ $category->category_name }} </option>

                                                                        @endforeach
                                                                        
                                                                    </select>
                                                         @if($errors->has('industry_category'))
                                                        <span class="text text-danger">{{ $errors->first('industry_category') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                                                                         
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Email</label>
                                                                    <input name="industry_email" id="industry_email" placeholder="Enter Industry Email" type="email" value="{{ $user->email }}"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('industry_email'))
                                                        <span class="text text-danger">{{ $errors->first('industry_email') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Mobile</label>
                                                                    <input name="industry_mobile" id="industry_mobile" placeholder="Enter Industry Mobile" type="number" value="{{ $user->mobile }}"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('industry_mobile'))
                                                        <span class="text text-danger">{{ $errors->first('industry_mobile') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                                                                         
                                                            </div>

                                                             <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Code Type</label>
                                                                    <input name="industry_type" id="industry_type" placeholder="Enter Industry Code Type" type="text" value="{{ $user->industry_type }}"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('industry_type'))
                                                        <span class="text text-danger">{{ $errors->first('industry_type') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Scale</label>
                                                                    <select name="industry_scale" id="industry_scale" class="form-control" required="">
                                                                        <option value="">Select Category</option>
                                                                        @foreach(config('app.industry_scale') as $key => $scale)
                                                                        <option
                                                                        <?php 
                                                                        if($key==$user->industry_scale){
                                                                            echo 'selected';
                                                                        }
                                                                        ?> value="{{ $key }}">{{ $scale }} </option>

                                                                        @endforeach
                                                                        
                                                                    </select>
                                                         @if($errors->has('industry_scale'))
                                                        <span class="text text-danger">{{ $errors->first('industry_scale') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                                                                         
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Latitude</label>
                                                                    <input name="industry_latitude" id="industry_latitude" placeholder="Enter Industry Latitude" value="{{ $user->latitude }}" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('industry_latitude'))
                                                        <span class="text text-danger">{{ $errors->first('industry_latitude') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Longitude</label>
                                                                    <input name="industry_longitude" id="industry_longitude" placeholder="Enter Industry Longitude" type="text" value="{{ $user->longitude }}"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('industry_longitude'))
                                                        <span class="text text-danger">{{ $errors->first('industry_longitude') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                                                                         
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Address</label>
                                                                    <textarea name="industry_address" id="industry_address" placeholder="Enter Industry Address" type="text"
                                                                                                         class="form-control" required="">{{ $user->address }}</textarea> 
                                                         @if($errors->has('industry_address'))
                                                        <span class="text text-danger">{{ $errors->first('industry_address') }}</span>
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
                @include('Admin.footer')

            </div>
        </div>
</div>

<div class="app-drawer-overlay d-none animated fadeIn"></div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script></body>
<script type="text/javascript">
  
</script>

<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
