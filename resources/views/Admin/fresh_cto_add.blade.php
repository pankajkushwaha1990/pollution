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
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<style type="text/css">
    .text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}
</style>
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
            <form action="{{ route('industry_add_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                   <h5 class="card-title">CTO Calculation</h5>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-inline form-group">
                                      <div class="custom-radio custom-control">
                                       <input type="radio" id="exampleCustomRadio" name="cto_type" value="fresh" checked class="custom-control-input cto_type">
                                       <label class="custom-control-label" for="exampleCustomRadio">Fresh CTO</label></div>
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-inline form-group">
                                      <div class="custom-radio custom-control">
                                       <input type="radio" id="exampleCustomRadio1" name="cto_type" value="renew"  class="custom-control-input cto_type">
                                     <label class="custom-control-label" for="exampleCustomRadio1">Renew CTO</label></div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ajax_cte_add_page_here"></div>
            </form>

            <div class="main-card mb-3 card">
                    <div class="card-body">
                    <div class="mb-3"><h5 class="card-title">Report</h5></div>
                        <div class="mb-3"><span class="symbol_error text text-danger"></span></div>                     
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

                          
                            <div id="calculation_result_here">
 
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
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
</body>
<script type="text/javascript">
    $(document).ready(function(){
      $('.cto_type').click(function(){
            var cto_type = $(".cto_type:checked").val();
            if(cto_type=='renew'){
               $.ajax({url: "{{ url('admin/extension-cto-add-page') }}", success: function(result){
                     $('#calculation_result_here').html('');
                     $('#ajax_cte_add_page_here').html(result);
                }});
            }else{
                $.ajax({url: "{{ url('admin/fresh-cto-add-page') }}", success: function(result){
                     $('#calculation_result_here').html('');
                     $('#ajax_cte_add_page_here').html(result);
                }});
            }  
      })
   })  
</script>



<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
