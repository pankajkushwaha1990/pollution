
<div class="page-content container" id="printarea_first">
    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12" >
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
                             <span class="text-sm text-grey-m2 align-middle text_bold">Industry Oprational Date:</span>
                            <span class="text-600 text-110 text-blue align-middle text_bold_600" >{{ $header['current_apply_date'] }}</span>
                        
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle text_bold">CTO Renewal Applied On:</span>
                            <span class="text-600 text-110 text-blue align-middle text_bold_600">{{ $header['view_apply_on'] }}</span>
                        
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle text_bold">Duration For Renewal:</span>
                            <span class="text-600 text-110 text-blue align-middle text_bold_600" >{{ $header['duration'] }}</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle text_bold">Concent Type:</span>
                            <span class="text-600 text-110 text-blue align-middle text_bold_600" >{{ $header['concent_type'] }}</span>
                        
                        </div>
                    </div>
                    @if(isset($header['penalty_days']))
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle text_bold">Penalty (Days):</span>
                            <span class="text-600 text-110 text-blue align-middle text_bold_600">{{ $header['penalty_days'] }} ({{ $header['penalty_slab'] }})</span>
                        
                        </div>
                    </div>
                    @endif


                    </div>


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
                        <tr style="background-color: #c2c2c200;" class="border_none">
                            
                           
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
                        <tr style="background-color: #c2c2c200;" class="border_none">
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

                        


                        <tr style="background-color: #c2c2c200;" class="border_none">
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
                        <tr style="background-color: #c2c2c200;" class="border_none">
                           
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
                        <tr style="background-color: #c2c2c200;" class="border_none">
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

                        

                         <tr style="background-color: #c2c2c200;" class="border_none">
                            
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
                <div class="col-md-8"></div>
                <div class="col-md-2"><button style="width: 100%;" id="print_button_first" class="btn btn-success">Print</button></div>
                <div class="col-md-2"><button style="width: 100%;" id="save_cte_five" class="btn btn-success">Save</button></div>
        </div>
    </div>
</div>
