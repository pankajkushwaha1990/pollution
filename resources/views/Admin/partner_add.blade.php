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
                                                    <form action="{{ route('partner_add_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body"><h5 class="card-title">Add New Partner</h5>
                                                           <div class="divider"></div>
                                                           <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <b>Partner Details</b>
                                                                </div>
                                                            </div>
                                                           <div class="divider"></div>

                                                            <div class="form-row">
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Company Name</label>
                                                                    <input name="company_name" id="company_name" placeholder="Enter Company Name" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('company_name'))
                                                        <span class="text text-danger">{{ $errors->first('company_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Partner Country</label>
                                                                        <select class="form-control" name="partner_country" required="" >
                                                                      <option value="">Select Country</option>
                                                                      
                                                                      @foreach ( config('app.module_country') as $key => $value) 
                                                                          <option value="{{ $value }}">{{ $value }}</option>
                                                                      @endforeach
                                                                    </select>
                                                                     @if($errors->has('partner_country'))
                                                        <span class="text text-danger">{{ $errors->first('partner_country') }}</span>
                                                        @endif

                                                                    </div>
                                                                </div>  

                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Email 1</label>
                                                                    <input name="partner_email_1" id="partner_email_1" placeholder="Enter First Email" type="email"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_email_1'))
                                                        <span class="text text-danger">{{ $errors->first('partner_email_1') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>





                                                            <div class="form-row">
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Email 2</label>
                                                                    <input name="partner_email_2" id="partner_email_2" placeholder="Enter Second Email" type="email"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_email_2'))
                                                        <span class="text text-danger">{{ $errors->first('partner_email_2') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Email 3</label>
                                                                    <input name="partner_email_3" id="partner_email_3" placeholder="Enter Third Email" type="email"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_email_3'))
                                                        <span class="text text-danger">{{ $errors->first('partner_email_3') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>   

                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Phone 1</label>
                                                                    <input name="partner_phone_1" id="partner_phone_1" placeholder="Enter First Phone" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_phone_1'))
                                                        <span class="text text-danger">{{ $errors->first('partner_phone_1') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>   

                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Phone 2</label>
                                                                    <input name="partner_phone_2" id="partner_phone_2" placeholder="Enter Second Phone" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_phone_2'))
                                                        <span class="text text-danger">{{ $errors->first('partner_phone_2') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Phone 3</label>
                                                                    <input name="partner_phone_3" id="partner_phone_3" placeholder="Enter Third Phone" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_phone_3'))
                                                        <span class="text text-danger">{{ $errors->first('partner_phone_3') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>   

                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Website URL</label>
                                                                    <input name="partner_url" id="partner_url" placeholder="Enter Website URL" type="url"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_url'))
                                                        <span class="text text-danger">{{ $errors->first('partner_url') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>   

                                                            </div>
<br>
                                                             <div class="divider"></div>
                                                           <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <b>Add Contact Details</b>
                                                                </div>
                                                            </div>
                                                           <div class="divider"></div>

                                                           <div class="form-row">
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">First Name</label>
                                                                    <input name="first_name" id="first_name" placeholder="Enter First Name" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('first_name'))
                                                        <span class="text text-danger">{{ $errors->first('first_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Last Name</label>
                                                                    <input name="last_name" id="last_name" placeholder="Enter Last Name" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('last_name'))
                                                        <span class="text text-danger">{{ $errors->first('last_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Email 1</label>
                                                                    <input name="contact_email_1" id="contact_email_1" placeholder="Enter First Email" type="email"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('contact_email_1'))
                                                        <span class="text text-danger">{{ $errors->first('contact_email_1') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Email 2</label>
                                                                    <input name="contact_email_2" id="contact_email_2" placeholder="Enter Second Email" type="email"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('contact_email_2'))
                                                        <span class="text text-danger">{{ $errors->first('contact_email_2') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Phone Number 1 </label>
                                                                    <input name="contact_phone_1" id="contact_phone_1" placeholder="Enter First Phone" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('contact_phone_1'))
                                                        <span class="text text-danger">{{ $errors->first('contact_phone_1') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Phone Number 2</label>
                                                                    <input name="contact_phone_2" id="contact_phone_2" placeholder="Enter Second Phone" type="nuberm"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('contact_phone_2'))
                                                        <span class="text text-danger">{{ $errors->first('contact_phone_2') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>

                                                             <div class="form-row">
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Job Title</label>
                                                                    <input name="contact_job_title" id="contact_job_title" placeholder="Enter Job Title" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('contact_job_title'))
                                                        <span class="text text-danger">{{ $errors->first('contact_job_title') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Department </label>
                                                                    <input name="contact_department" id="contact_department" placeholder="Enter Department" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('contact_department'))
                                                        <span class="text text-danger">{{ $errors->first('contact_department') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Skype ID</label>
                                                                    <input name="contact_skype_id" id="contact_skype_id" placeholder="Enter Skype Id" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('contact_skype_id'))
                                                        <span class="text text-danger">{{ $errors->first('contact_skype_id') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <br>
                                                             <div class="divider"></div>
                                                           <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <b>Partner Details</b>
                                                                </div>
                                                            </div>
                                                           <div class="divider"></div>

                                                            <div class="form-row">
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Partner Type</label>
                                                                    <select class="form-control" name="partner_type" required="" >
                                                                      <option value="">Select Partner Type</option>
                                                                      
                                                                      @foreach ( config('app.module_partner') as $key => $value) 
                                                                          <option value="{{ $value }}">{{ $value }}</option>
                                                                      @endforeach
                                                                    </select>
                                                         @if($errors->has('partner_type'))
                                                        <span class="text text-danger">{{ $errors->first('partner_type') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Billing Name</label>
                                                                    <input name="billing_name" id="billing_name" placeholder="Enter Billing Name" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('billing_name'))
                                                        <span class="text text-danger">{{ $errors->first('billing_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                 <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Address 1</label>
                                                                    <input name="partner_address_1" id="partner_address_1" placeholder="Enter Address 1" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_address_1'))
                                                        <span class="text text-danger">{{ $errors->first('partner_address_1') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                 


                                                            </div>

                                                             <div class="form-row">
                                                             
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Address 2</label>
                                                                    <input name="partner_address_2" id="partner_address_2" placeholder="Enter Secondry Address" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_address_2'))
                                                        <span class="text text-danger">{{ $errors->first('partner_address_2') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">State</label>
                                                                    <input name="partner_state" id="partner_state" placeholder="Enter State" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_state'))
                                                        <span class="text text-danger">{{ $errors->first('partner_state') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Postal/Zip Code</label>
                                                                    <input name="partner_zipcode" id="partner_zipcode" placeholder="Enter Postal/Zip Code" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partner_zipcode'))
                                                        <span class="text text-danger">{{ $errors->first('partner_zipcode') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                              

                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Country</label>
                                                                    <input name="partners_country" id="partners_country" placeholder="Enter Country" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('partners_country'))
                                                        <span class="text text-danger">{{ $errors->first('partners_country') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Tax ID Number</label>
                                                                    <input name="tax_id_number" id="tax_id_number" placeholder="Enter Tax ID" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('tax_id_number'))
                                                        <span class="text text-danger">{{ $errors->first('tax_id_number') }}</span>
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
