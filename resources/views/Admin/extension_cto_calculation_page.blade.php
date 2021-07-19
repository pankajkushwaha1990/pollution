<style>
tr:nth-child(even) {background-color: #c2c2c2;}
</style>
<div class="page-content container">
    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                            <h4><span class="text-default-d3" >{{ $data['industry_name'] }}</span></h4>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Industry Type & Duration:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $data['industry_type'] }} ({{ $data['tenure_from'].' to '.$data['tenure_to'] }})</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Industry Category:</span>
                            <span class="text-600 text-110 text-blue align-middle" >{{ $data['industry_category'] }}</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Duration:</span>
                            <span class="text-600 text-110 text-blue align-middle" >{{ $data['duration'] }}</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Date Of CTO Renewal Applied:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $data['applied_date'] }}</span>
                        
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
                            <th class="opacity-2">#</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Days</th>
                            <th>CA Certificate Amount</th>
                            @if($data['penalty_changed']=='Y')
                             <th>CA Difference</th>
                             @endif
                             @if($data['industry_noc']=='Y' || $data['arrear_changed']=='Y')
                             <th>NOC Fee</th>
                             @endif
                                @if($data['industry_noc']=='Y' && ($data['concent_type']=='water' || $data['concent_type']=='both')) 
                             <th>Water Regu. Fee</th>
                             @endif

                              @if($data['concent_type']=='water' || $data['concent_type']=='both')
                             <th>CTO-Water Fee</th>
                             @endif


                             
                              @if($data['industry_noc']=='Y' && ($data['concent_type']=='air' || $data['concent_type']=='both')) 
                             <th>Air Regu. Fee</th>
                             @endif
                           
                             @if($data['concent_type']=='air' || $data['concent_type']=='both')
                             <th>CTO-Air Fee</th>
                             @endif
                             
                            
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <?php 
                        $sr_no  = 1;
                        $ca_diff = 0;
                        $water_reg_fee = 0;
                        $air_reg_fee = 0;
                        $total   = 0;
                        $total_noc = 0;
                        $total_arrear = 0;
                        $total_noc_air = 0;
                        $total_noc_water = 0;
                        $total_cto_water = 0;
                        $total_water = 0;

                        $total_air = 0;

                        $total_fee = 0;


                        foreach($data['previous_data'] as $index => $detail){
                                

                             ?>
                                <tr>
                                    <td>{{ $sr_no++ }}</td>
                                    <td>{{ $detail['from_date'] }}</td>
                                    <td>{{ $detail['to_date'] }}</td>
                                    <td class="text-95">{{ $detail['days'] }}</td>
                                    @if($data['ca_changed']=='Y')
                                       <td class="text-secondary-d2">{{ $detail['ca_amount'] }}</td>
                                    @else
                                       <td class="text-secondary-d2">{{ $detail['ca_amount'] }}</td>
                                    @endif
                                     @if($data['penalty_changed']=='Y')
                                     <th>
                                        <?php 
                                        if($sr_no==2){  
                                                                                     
                                            echo 0;
                                        }else{ 
                                            $last_ca = $detail['ca_amount'];
                                                                                  
                                            echo $detail['ca_amount']-$data['previous_data'][$index-1]['ca_amount'];
                                        }
                                        ?></th>

                                       
                                     @endif
                                    <?php 
                                    if($data['industry_noc']=='Y' || $data['arrear_changed']=='Y'){?>
                                     <th>
                                        <?php 
                                        
                                            //$last_ca = $detail['ca_amount'];
                                        $total_noc+=$detail['noc_fee'];
                                                                                  
                                            echo $detail['noc_fee'];
                                       
                                        ?></th>
                                    <?php } ?>

                                     @if($data['industry_noc']=='Y' && ($data['concent_type']=='water' || $data['concent_type']=='both')) 
                             <td class="text-secondary-d2">
                                         <?php 
                                        
                                            //$last_ca = $detail['ca_amount'];
                                             $water_reg_fee+= $detail['water_regu_fee'];                                    
                                            echo $detail['water_regu_fee'];
                                       
                                        ?>
                                      </td>
                             @endif
                               @if($data['concent_type']=='water' || $data['concent_type']=='both') 
                            <td class="text-secondary-d2">
                                       <?php 
                                        
                                            //$last_ca = $detail['ca_amount'];
                                                                             $total_water+=$detail['cto_water_fee'];      
                                            echo $detail['cto_water_fee'];
                                       
                                        ?>
                                      </td>
                             @endif




                           








                             

                               

                              <?php 

                                    if($data['industry_noc']=='Y' && ($data['concent_type']=='air' || $data['concent_type']=='both')){
                                      
                                      ?>
                                      <td class="text-secondary-d2">
                                         <?php 
                                        
                                            //$last_ca = $detail['ca_amount'];
                                           $air_reg_fee+=$detail['air_regu_fee'];                                       
                                            echo $detail['air_regu_fee'];
                                       
                                        ?>
                                      </td>
                                    <?php } ?>


                                     @if($data['concent_type']=='air' || $data['concent_type']=='both')
                             <td class="text-secondary-d2"> <?php 
                                        
                                            //$last_ca = $detail['ca_amount'];
                                           $total_air+=  $detail['cto_air_fee'];                                     
                                            echo $detail['cto_air_fee'];
                                       
                                        ?></td>
                             @endif









                                   


                                    
                                                          
                            

                           




                                     

                                   
                                  
                                
                           <?php
                           // break;
                        }
                        
                       
                        $final_amount = 0;
                        ?>



                       
                        
                        @foreach($data['table_details'] as $index => $detail)
                        <tr>
                            <td>{{ $sr_no++ }}</td>
                            <td>{{ $detail['from_date'] }}</td>
                            <td>{{ $detail['to_date'] }}</td>
                            <td class="text-95">{{ $detail['days'] }}</td>
                            <td class="text-secondary-d2">{{ $detail['ca_amount'] }}</td>
                             @if($data['penalty_changed']=='Y')
                             <th>
                                        <?php 
                                        if($index==0){  
                                                                                     
                                            echo $detail['ca_amount']-$last_ca;
                                        }else{ 
                                                                                  
                                            echo 0;
                                        }
                                        ?></th>
                             @endif
                           
                              <?php 

                                    if($data['industry_noc']=='Y' || $data['arrear_changed']=='Y'){
                                      
                                      ?>
                                      <td class="text-secondary-d2">
                                        <?php 
                                        if($sr_no==2){

                                            
                                            echo $data['new_cte_fee'];
                                            $total_noc+=$data['new_cte_fee'];
                                        }else{
                                           $total_noc+=$detail['new_noc_fee'];
                                            echo $detail['new_noc_fee'];
                                            
                                        }
                                        ?>
                                      </td>
                                    <?php } ?>
 @if($data['industry_noc']=='Y' && ($data['concent_type']=='water' || $data['concent_type']=='both')) 
                            <td class="text-secondary-d2">
                                       <?php 
                                        if($sr_no==2){

                                            
                                            echo $data['new_cte_fee'];
                                            $water_reg_fee+=$data['new_cte_fee'];
                                        }else{
                                           $water_reg_fee+=$detail['new_noc_fee'];
                                            echo $detail['new_noc_fee'];
                                            
                                        }
                                        ?>
                                      </td>
                             @endif

                               @if($data['concent_type']=='water' || $data['concent_type']=='both')
                            <td class="text-secondary-d2"><?php $total_water+=$data['current_tenure_fee'];?> {{ $data['current_tenure_fee'] }}</td>
                             @endif
                             

                                       @if($data['industry_noc']=='Y' && ($data['concent_type']=='air' || $data['concent_type']=='both')) 
                             <td class="text-secondary-d2">
                                        <?php 
                                        if($sr_no==2){

                                            
                                            echo $data['new_cte_fee'];
                                             $air_reg_fee+=$data['new_cte_fee'];
                                        }else{
                                           
                                            echo $detail['new_noc_fee'];
                                             $air_reg_fee+=$detail['new_noc_fee'];
                                            
                                        }
                                        ?>
                                      </td>
                             @endif
                            


                             @if($data['concent_type']=='air' || $data['concent_type']=='both')
                             <td class="text-secondary-d2"><?php $total_air+=$data['current_tenure_fee'];?> {{ $data['current_tenure_fee'] }}</td>
                             @endif

                             
                           
                           
                        </tr> 
                        @endforeach

                          <tr>
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 

                            <td><b>Fee Total</b></td>
                             @if($data['penalty_changed']=='Y')
                             <th>--</th>
                             @endif
                            
                                   
                             <?php 
                                    if($data['industry_noc']=='Y' || $data['arrear_changed']=='Y'){?>
                                      <td class="text-secondary-d2">
                                        <b>{{ $total_noc }}</b></td>
                                      <?php }?>

                                       @if($data['industry_noc']=='Y'  && ($data['concent_type']=='water' || $data['concent_type']=='both')) 
                             <th>{{ $water_reg_fee }}</th>
                             @endif

                               @if($data['concent_type']=='water' || $data['concent_type']=='both')
                             <td><b>{{  $total_water }}</b></td>
                             @endif   
                             

                                       @if($data['industry_noc']=='Y' && ($data['concent_type']=='air' || $data['concent_type']=='both')) 
                             <th>{{ $air_reg_fee }}</th>
                             @endif
                             
                           
                              @if($data['concent_type']=='air' || $data['concent_type']=='both')
                            <td><b>{{  $total_air }}</b></td>  
                             @endif

                             
                           
                        </tr> 
                         <tr>
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 

                            <td><b>Fee already deposited at the time of last grant of CTO (-)</b></td>
                             @if($data['penalty_changed']=='Y')
                             <th>--</th>
                             @endif
                            
                            <?php 
                                    if($data['industry_noc']=='Y' || $data['arrear_changed']=='Y'){?>
                                      <td class="text-secondary-d2">
                                        <b>0</b></td>
                                      <?php }?>

                                      
                              @if($data['industry_noc']=='Y'  && ($data['concent_type']=='water' || $data['concent_type']=='both')) 
                             <th>0</th>
                             @endif

                              @if($data['concent_type']=='water' || $data['concent_type']=='both')
                             <td><b>{{  $data['deposited_water_amount'] }}</b></td>
                             @endif   
                              

                            

                             @if($data['industry_noc']=='Y' && ($data['concent_type']=='air' || $data['concent_type']=='both')) 
                             <th>0</th>
                             @endif


                           
                              @if($data['concent_type']=='air' || $data['concent_type']=='both')
                            <td><b>{{  $data['deposited_air_amount'] }}</b></td>  
                             @endif

                              

                              
                            
                        </tr> 

                         <tr>
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 

                            <td><b>Total</b></td>
                             @if($data['penalty_changed']=='Y')
                             <th>--</th>
                             @endif
                           
                             <?php 
                                    if($data['industry_noc']=='Y' || $data['arrear_changed']=='Y'){?>
                                      <td class="text-secondary-d2">
                                        <b><?php  $final_amount += $total_noc; ?>{{ $total_noc }}</b></td>
                                      <?php }?>

                                      @if($data['industry_noc']=='Y' && ($data['concent_type']=='water' || $data['concent_type']=='both')) 
                             <th><?php  $final_amount += $water_reg_fee; ?>{{ $water_reg_fee }}</th>
                             @endif

                                       @if($data['concent_type']=='water' || $data['concent_type']=='both')
                             <td><b><?php $final_amount +=$total_water-$data['deposited_water_amount'];?>{{  $total_water-$data['deposited_water_amount'] }}</b></td>
                             @endif 
                             


                                       

                             

 @if($data['industry_noc']=='Y' && ($data['concent_type']=='air' || $data['concent_type']=='both')) 
                             <th><?php  $final_amount += $air_reg_fee; ?>{{ $air_reg_fee }}</th>
                             @endif
                                     
                             
                            
                              @if($data['concent_type']=='air' || $data['concent_type']=='both')
                            <td><b><?php $final_amount += $total_air-$data['deposited_air_amount'];?>{{  $total_air-$data['deposited_air_amount'] }}</b></td>  
                             @endif

                              

                           
                              
                        </tr> 
                    </tbody>
                </table>
            </div>
            

                    <div class="row mt-3">
                        <div class="col-12 col-sm-6 text-grey-d2 text-95 mt-2 mt-lg-0">
                            <!-- Extra note such as company or payment information... -->
                        </div>

                        <div class="col-12 col-sm-6 text-grey text-90 order-first order-sm-last">
                            @if($data['penalty_changed_water']>0 && ($data['concent_type']=='water' || $data['concent_type']=='both'))
                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    <b>CTO Water Penalty</b>
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3" ><b><?php $final_amount+=$data['penalty_changed_water'];?> {{ $data['penalty_changed_water'] }}</b></span>
                                </div>
                            </div>
                            @endif
                             @if($data['penalty_changed_air']>0 && ($data['concent_type']=='air' || $data['concent_type']=='both'))
                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    <b>CTO Air Penalty</b>
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3" ><b><?php $final_amount+=$data['penalty_changed_air'];?> {{ $data['penalty_changed_air'] }}</b></span>
                                </div>
                            </div>
                            @endif
                           

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    <b>Total Payable Amount</b>
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3" ><b>{{ $final_amount }}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        <!-- <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

