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
 <style>
tr:nth-child(even) {background-color: #c2c2c2;}
 @media  print{
   table tr:nth-last-child(n+4) td {
    border: 1px solid black !important;
    color: black !important;
    text-align: center !important;

   }
   table th {
    border: 1px solid black !important;
    color: black !important;
    text-align: center !important;



   }
   table {
    width: 100%;
   }
   .text-default-d3,.align-middle,.text-blue {
    color: black !important;
    text-align: center !important;

   }
   .text-default-d3 {
    font-size: 32px !important;
    text-align: center !important;

   }
   .text-default-d3.company_text {
    font-weight: 600;
    text-align: center !important;

   }
   .print_show{
    display: block;
   }
   
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

<div class="page-content container" >
    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12" id="printarea">
                <div class="row">
                    <div class="col-12 print_show" >
                        <div class="text-center text-150">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                            <h4><img src="{{ asset('/template/assets/images') }}/logo_0.png">&nbsp;&nbsp;<span class="text-default-d3 company_text" >Punjab Pollution Control Board</span></h4>
                        </div>
                    </div>
                     <div class="col-12">
                        <!-- <hr> -->
                    </div>
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                        <!-- <span class="text-sm text-grey-m2 align-middle">Industry Type & Duration:</span> -->
                        <span class="text-600 text-110 text-blue align-middle">Receipt</span>
                        
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center text-150">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                            <h4><span class="text-default-d3" >{{ $header['industry_name'] }}</span></h4>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                        <span class="text-sm text-grey-m2 align-middle">Industry Type & Duration:</span>
                        <span class="text-600 text-110 text-blue align-middle">{{ $header['industry_type'] }} ({{ $header['tenure_from'].' to '.$header['tenure_to'] }})</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Industry Category:</span>
                            <span class="text-600 text-110 text-blue align-middle" >{{ $header['industry_category'] }}</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Industry Oprational Date:</span>
                            <span class="text-600 text-110 text-blue align-middle" >{{ $header['current_apply_date'] }}</span>
                        
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">CTO Renewal Applied On:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $header['view_apply_on'] }}</span>
                        
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Duration For Renewal:</span>
                            <span class="text-600 text-110 text-blue align-middle" >{{ $header['duration'] }}</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Concent Type:</span>
                            <span class="text-600 text-110 text-blue align-middle" >{{ $header['concent_type'] }}</span>
                        
                        </div>
                    </div>
                    @if(isset($header['penalty_days']))
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Penalty (Days):</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $header['penalty_days'] }} ({{ $header['penalty_slab'] }})</span>
                        
                        </div>
                    </div>
                    @endif

                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />
                
               
                <div class="mt-4">
                  

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            @foreach($table_head as $head)
                            <th style="text-align: center;">{{ $head }}</th>
                            @endforeach
                        </tr>
                    </thead>

                                       <tbody class="text-95 text-secondary-d3">
                        <tr></tr>                        
                        @foreach($table_rows as $detail)
                        <tr>
                            <td style="text-align: center;">{{ $detail['sr_no'] }}</td>
                            <td style="text-align: center;">{{ $detail['from_date'] }}</td>
                            <td style="text-align: center;">{{ $detail['to_date'] }}</td>
                            <td class="text-95" style="text-align: center;">{{ $detail['days'] }}</td>
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['ca_certificate_amount']) }}</td>
                            @if(isset($footer['ca_diffrence']))
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['ca_diffrence']) }}</td>
                            @endif
                            @if(isset($footer['noc_fee']))
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['noc_fee']) }}</td>
                            @endif
                             @if(isset($footer['water_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['water_regu_fee']) }}</td>
                            @endif
                             @if(isset($footer['total_cto_water_fee']))
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['cto_water_fee']) }}</td>
                            @endif
                            @if(isset($footer['air_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['air_regu_fee']) }}</td>
                            @endif
                           
                           
                            @if(isset($footer['total_cto_air_fee']))
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['cto_air_fee']) }}</td>
                            @endif
                        </tr> 
                        @endforeach
                        <tr style="background-color: #c2c2c200;">
                            
                           
                            <td colspan="6" class="text-secondary-d2"  style="text-align: right;"><b style="font-size: 18px;">Fee Total</b></td>
                            
                            
                             @if(isset($footer['noc_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_noc_fee']) }}</b></td>
                            @endif
                            
                            @if(isset($footer['water_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['water_regu_fee']) }}</b></td>
                            @endif

                            @if(isset($footer['total_cto_water_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_cto_water_fee']) }}</b></td>
                            @endif
                             @if(isset($footer['air_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['air_regu_fee']) }}</b></td>
                            @endif
                            @if(isset($footer['total_cto_air_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_cto_air_fee']) }}</b></td>
                            @endif

                            
                        </tr> 
                        <tr style="background-color: #c2c2c200;">
                            <!-- <td></td> -->
                            
                            <td colspan="6" class="text-secondary-d2" style="text-align: right;"><b style="font-size: 18px;">Fee already deposited at the time of last grant of CTO (-)</b></td>
                           
                            
                             @if(isset($footer['noc_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">0</b></td>
                            @endif
                           
                            @if(isset($footer['water_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">0</b></td>
                            @endif

                            @if(isset($footer['deposited_water_amount']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['deposited_water_amount']) }}</b></td>
                            @endif
                             @if(isset($footer['air_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">0</b></td>
                            @endif
                            @if(isset($footer['deposited_air_amount']))
                             <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['deposited_air_amount']) }}</b></td>
                             @endif
                        </tr> 

                        


                        <tr style="background-color: #c2c2c200;">
                            <td colspan="6" class="text-secondary-d2" style="text-align: right;" ><b style="font-size: 18px;">Total</b></td>
                           
                           
                             @if(isset($footer['noc_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_noc_fee']) }}</b></td>
                            @endif
                          
                            @if(isset($footer['water_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['water_regu_fee']) }}</b></td>
                            @endif
                            @if(isset($footer['final_cto_water_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['final_cto_water_fee']) }}</b></td>
                            @endif
                              @if(isset($footer['air_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['air_regu_fee']) }}</b></td>
                            @endif
                            @if(isset($footer['final_cto_air_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['final_cto_air_fee']) }}</b></td>
                            @endif
                        </tr> 
                        @if(isset($footer['total_water_penalty']) || isset($footer['total_air_penalty']))
                        <tr style="background-color: #c2c2c200;">
                           
                            <td colspan="6" class="text-secondary-d2" style="text-align: right;" ><b style="font-size: 18px;">CTO Penalty</b></td>
                           
                             @if(isset($footer['noc_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b></b></td>
                            @endif
                          
                            @if(isset($footer['water_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"></td>
                            @endif
                             @if(isset($footer['total_water_penalty']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_water_penalty']) }}</b></td>
                            @endif
                            @if(isset($footer['air_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"></td>
                            @endif
                            @if(isset($footer['total_air_penalty']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_air_penalty']) }}</b></td>
                            @endif
                           
                           
                        </tr> 
                        @endif

                        @if(isset($footer['penalty_water_amount']) || isset($footer['total_air_penalty']))
                        <tr style="background-color: #c2c2c200;">
                            <td colspan="6" class="text-secondary-d2"  style="text-align: right;"><b style="font-size: 18px;">Fee already deposited CTO penalty (-)</b></td>
                           
                             @if(isset($footer['noc_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"><b></b></td>
                            @endif
                             @if(isset($footer['water_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"></td>
                            @endif
                             @if(isset($footer['total_water_penalty']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['penalty_water_amount']) }}</b></td>
                            @endif

                            @if(isset($footer['air_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"></td>
                            @endif
                           
                           
                           <!--  @if(isset($footer['penalty_water_amount']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['penalty_water_amount']) }}</b></td>
                            @endif -->
                            @if(isset($footer['total_air_penalty']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['penalty_air_amount']) }}</b></td>
                            @endif
                        </tr> 
                        @endif

                        

                         <tr style="background-color: #c2c2c200;">
                            
                            <td colspan="6" class="text-secondary-d2" style="text-align: right;" ><b style="font-size: 18px;">Total Payable Amount</b></td>
                           
                           
                             @if(isset($footer['noc_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"></td>
                            @endif
                            
                            @if(isset($footer['water_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"></td>
                            @endif
                             @if(isset($footer['total_water_penalty']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">
                                <?php 
                                if(!isset($footer['total_air_penalty'])){
                                    echo money_format_change($footer['payable_amount']);
                                }
                            ?>
                          </b></td>
                            @endif
                            @if(isset($footer['air_regu_fee']))
                            <td class="text-secondary-d2" style="text-align: center;"></td>
                            @endif
                             @if(isset($footer['total_air_penalty']))
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['payable_amount']) }}</b></td>
                            @endif

                            <!-- <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;"></b></td> -->
                        </tr> 
                    </tbody>
                </table>
            </div>
            

                   

                         

                      
                    <hr />

                    <div>
                        <span class="text-secondary-d1 text-105"></span>
                        <!-- <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0"></a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-2"><button style="width: 100%;" id="print_button" class="btn btn-success">Print</button></div>
                <div class="col-md-2"><a href="{{ route('export_fresh_cte',['id'=>$id]) }}"><button style="width: 100%;" id="save_cte" class="btn btn-success">Excel</button></a></div>
                <div class="col-md-2"><a href="{{ route('fresh_cte_pdf',['id'=>$id,'pdf'=>'true']) }}"><button style="width: 100%;" id="save_cte" class="btn btn-warning">PDF</button></a></div>
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

<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
<script type="text/javascript">
    $("#print_button").click(function () {
        $("#printarea").print();
    });
</script>





<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
