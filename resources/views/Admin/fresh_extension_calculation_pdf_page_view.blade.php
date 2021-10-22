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
            <div class="col-12 col-lg-12" id="printarea_first">
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
                        <div class="text-center text-150">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                            <h4><span class="text-default-d3 industry_name" >{{ $header['industry_name'] }}</span></h4>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                        <span class="text-sm text-grey-m2 align-middle text_bold">Industry Type & Duration:</span>
                        <span class="text-600 text-110 text-blue align-middle text_bold_600">{{ $header['industry_type'] }} ({{ $header['tenure_from'].' to '.$header['tenure_to'] }})</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle text_bold">Industry Category:</span>
                            <span class="text-600 text-110 text-blue align-middle text_bold_600" >{{ $header['industry_category'] }}</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle text_bold">Duration:</span>
                            <span class="text-600 text-110 text-blue align-middle text_bold_600" >{{ $header['duration'] }}</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle text_bold">Date Of CTE Extension Applied:</span>
                            <span class="text-600 text-110 text-blue align-middle text_bold_600">{{ $header['view_apply_on'] }}</span>
                        
                        </div>
                    </div>

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
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['ca_amount']) }}</td>
                             @if(isset($footer['Arrear']))
                              <td style="text-align: center;">{{ $detail['arrear'] }}</td>
                            @endif
                            <td class="text-secondary-d2" style="text-align: center;">{{ money_format_change($detail['cte_fees']) }}</td>
                        </tr> 
                        @endforeach
                        <tr style="background-color: #c2c2c200;">
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td class="text-95" ></td>
                            <td class="text-secondary-d2"  style="text-align: center;"><b style="font-size: 18px;">Total Fee</b></td>
                             @if(isset($footer['Arrear']))
                              <td style="text-align: center;"></td>
                            @endif
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_cte_fee']) }}</b></td>
                        </tr> 
                        <tr style="background-color: #c2c2c200;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-95"></td>
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">Deposited</b></td>
                             @if(isset($footer['Arrear']))
                              <td style="text-align: center;"></td>
                            @endif
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['deposited_amount']) }}</b></td>
                        </tr> 
                         <tr style="background-color: #c2c2c200;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-95"></td>
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">Total Payable Amount</b></td>
                             @if(isset($footer['Arrear']))
                              <td style="text-align: center;"></td>
                            @endif
                            <td class="text-secondary-d2" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['final_fee']) }}</b></td>
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
                <div class="col-md-2"><button style="width: 100%;" id="print_button_first" class="btn btn-success">Print</button></div>
                <div class="col-md-2"><a href="{{ route('export_fresh_extension',['id'=>$id]) }}"><button style="width: 100%;" id="save_cte" class="btn btn-success">Excel</button></a></div>
                <div class="col-md-2"><a href="{{ route('fresh_extension_pdf',['id'=>$id,'pdf'=>'true']) }}"><button style="width: 100%;" id="save_cte" class="btn btn-warning">PDF</button></a></div>
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
@include('Admin.all_js')

</html>
