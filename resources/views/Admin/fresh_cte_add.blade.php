@include('Admin.main_header')
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
            <!-- <form action="{{ route('industry_add_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate> -->
                <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                   <h5 class="card-title">CTE Calculation</h5>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-inline form-group">
                                      <div class="custom-radio custom-control">
                                       <input type="radio" id="exampleCustomRadio" name="cte_type" value="fresh" checked class="custom-control-input cte_type cte_type_default">
                                       <label class="custom-control-label" for="exampleCustomRadio">Fresh CTE</label></div>
                                     </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-inline form-group">
                                      <div class="custom-radio custom-control">
                                       <input type="radio" id="exampleCustomRadio1" name="cte_type" value="extension"  class="custom-control-input cte_type">
                                     <label class="custom-control-label" for="exampleCustomRadio1">Extension CTE</label></div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ajax_cte_add_page_here_first">
                        
                    </div>
            <!-- </form> -->

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

                          
                            <div id="calculation_result_here_first">
 
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
@include('Admin.all_js')
</body>
</html>
