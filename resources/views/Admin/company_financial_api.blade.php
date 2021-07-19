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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body"><h5 class="card-title">Get Company Financial From Api</h5>
                                                           
                                                                <div class="form-row">
                                                                    <div class="col-md-10">
                                                                        <div class="position-relative form-group"><label
                                                                                for="exampleEmail11"
                                                                                class="">Stock Symbol</label>
                                                                                <input name="stock_symbol"
                                                                                                             id="exampleEmail11"
                                                                                                             placeholder="Example: WMT,AAPL"
                                                                                                             type="text"
                                                                                                             class="form-control stock_symbol">
                                                                        </div>
                                                                        <span class="symbol_error text text-danger"></span>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="position-relative form-group"><label
                                                                                for="exampleEmail11"
                                                                                class=""></label><br>
                                                                        <button type="button" class="mt-2 btn btn-primary get_company_financial_api">GET</button>
                                                                    </div>
                                                                </div>
                                                                   
                                                                </div>
                                                               
                                                               
                                                                
                                                                
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body">
                                                            <div class="mb-3"><h5 class="card-title">Response</h5></div>

                                                              
                                                                <div class="divider"></div>
                                                                <div class="row">
                                                                    <div class="col-md-5"></div>
                                                                   <div class="col-md-4">  
                                                                            <div class="loader" style="display: none;">
                                                                            <div class="ball-rotate">
                                                                                <div></div>
                                                                            </div>
                                                                        </div>
                                                                   </div>
                                                                </div>

                                                              
                                                                <div>
                                                                    <p class="response"></p>
                                                                </div>
                                                              
                                                              
                                                            
                                                        </div>
                                                    </div>
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
    $(document).ready(function(){
        $('.get_company_financial_api').click(function(){
            var stock_symbol = $('.stock_symbol').val();
            if(stock_symbol==''){
                $('.symbol_error').text('Please enter company financial symbol');
            }else{
                $('.loader').show();
                $('.symbol_error').text('');
                $.ajax({url: "{{ url('admin/company-financial-api-submit') }}/"+stock_symbol, success: function(result){
                     if(result.status=='failure'){
                        $('.response').text(result.message).addClass('text text-danger');
                        $('.loader').hide();
                     }
                }});
            }            
        })
    })
</script>

<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
