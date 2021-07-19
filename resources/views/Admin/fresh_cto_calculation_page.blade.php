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
                             <span class="text-sm text-grey-m2 align-middle">Date Of CTE Applied:</span>
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
                             @if($data['arrear_changed']=='Y')
                              <th>Arrear</th>
                            @endif
                            @if($data['industry_noc']=='yes' || $data['arrear_changed']=='Y')
                             <th>NOC Fee</th>
                             @endif
                             @if($data['concent_type']=='air' || $data['concent_type']=='both')
                             <th>CTO-Air Fee</th>
                             @endif
                             @if($data['concent_type']=='water' || $data['concent_type']=='both')
                             <th>CTO-Water Fee</th>
                             @endif
                            
                             
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                         <?php 
                         $total_noc = 0;
                         $total_air = 0;
                         $total_arrear = 0;
                         $total_water = 0;
                         $final_amount = 0;
                         $sr_no = 1;
                         $total_fee  = 0;
                         ?>
                         <?php                       
                        foreach($data['previous_data'] as $previous){
                            $all_data =  json_decode($previous->response_data,true);
                            foreach ($all_data['table_details'] as $key => $detail) {
                             ?>
                                <tr>
                                    <td>{{ $sr_no++ }}</td>
                                    <td>{{ $detail['from_date'] }}</td>
                                    <td>{{ $detail['to_date'] }}</td>
                                    <td class="text-95">{{ $detail['days'] }}</td>

                                    @if($data['ca_changed']=='Y')
                                       <td class="text-secondary-d2">{{ $data['table_details'][0]['ca_amount'] }}</td>
                                    @else
                                       <td class="text-secondary-d2">{{ $detail['ca_amount'] }}</td>
                                    @endif

                                    

                                     <?php 
                                    if($data['arrear_changed']=='Y'){?>
                                      <td class="text-secondary-d2">
                                        <?php 
                                        if($sr_no==2){
                                            echo $data['current_tenure_fee']  ."-". $detail['cte_fees'];
                                            $total_arrear += $data['current_tenure_fee']- $detail['cte_fees'];
                                        }else{
                                            echo $data['current_tenure_fee']/2  ."-". $detail['cte_fees'];
                                            $total_arrear += ($data['current_tenure_fee']/2)- $detail['cte_fees'];
                                        }
                                        ?>
                                    <?php } ?>

                                     <?php 
                                    if($data['industry_noc']=='yes' || $data['arrear_changed']=='Y'){?>
                                      <td class="text-secondary-d2">
                                        <?php 
                                        if($sr_no==2){
                                            
                                            echo $data['current_tenure_fee']- $detail['cte_fees'];
                                            $total_noc+=$data['current_tenure_fee']- $detail['cte_fees'];
                                        }else{
                                           
                                            echo ($data['current_tenure_fee']/2)- $detail['cte_fees'];
                                            $total_noc+=($data['current_tenure_fee']/2)- $detail['cte_fees'];
                                        }
                                        ?>
                                    <?php } ?>

                                     <?php 
                                    if($data['concent_type']=='water' || $data['concent_type']=='both'){?>
                                      <td class="text-secondary-d2">
                                        <?php 
                                        if($sr_no==2){
                                            echo 0;
                                            $total = $data['current_tenure_fee']- $detail['cte_fees'];
                                        }else{
                                            echo 0;
                                            $total = ($data['current_tenure_fee']/2)- $detail['cte_fees'];
                                        }
                                        ?>
                                    <?php } ?>

                                     <?php 
                                    if($data['concent_type']=='air' || $data['concent_type']=='both'){?>
                                      <td class="text-secondary-d2">
                                        <?php 
                                        if($sr_no==2){
                                            echo 0;
                                            $total = $data['current_tenure_fee']- $detail['cte_fees'];
                                        }else{
                                            echo 0;
                                            $total = ($data['current_tenure_fee']/2)- $detail['cte_fees'];
                                        }
                                        ?>
                                    <?php } ?>
                                    
                                    <!-- <td class="text-secondary-d2"><?php $total_arrear //= $total_arrear+$total; //echo $total;?></td> -->
                                </tr> 
                                
                           <?php }
                        }
                        ?>
                       
                        @foreach($data['table_details'] as $detail)
                        <tr>
                            <td>{{ $detail['sr_no'] }}</td>
                            <td>{{ $detail['from_date'] }}</td>
                            <td>{{ $detail['to_date'] }}</td>
                            <td class="text-95">{{ $detail['days'] }}</td>
                            <td class="text-secondary-d2">{{ $detail['ca_amount'] }}</td>
                             @if($data['arrear_changed']=='Y')
                             <td>0</td>
                            @endif
                             @if($data['industry_noc']=='yes')
                             <td class="text-secondary-d2"><?php $total_noc+=$detail['noc_amount'];?> {{ $detail['noc_amount'] }}</td>
                             @elseif($data['industry_noc']=='yes' || $data['arrear_changed']=='Y')
                                <td class="text-secondary-d2">0</td>
                            @endif
                             

                              @if($data['concent_type']=='air' || $data['concent_type']=='both')
                             <td class="text-secondary-d2"><?php $total_air+=$detail['air_amount'];?> {{ $detail['air_amount'] }}</td>
                             @endif
                             @if($data['concent_type']=='water' || $data['concent_type']=='both')
                            <td class="text-secondary-d2"><?php $total_water+=$detail['water_amount'];?> {{ $detail['water_amount'] }}</td>
                             @endif
                           
                            
                           
                        </tr> 
                        @endforeach

                        <tr>
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 

                            <td><b>Fee Total</b></td>
                             @if($data['arrear_changed']=='Y')
                             <td><b>{{ 0 }}</b></td>
                            @endif
                             @if($data['industry_noc']=='yes')
                              <td><b>{{ $total_noc }}</b></td>
                             @elseif($data['industry_noc']=='yes' || $data['arrear_changed']=='Y')
                                <td class="text-secondary-d2"><b>{{ $total_noc }}</b></td>
                            @endif
                              @if($data['concent_type']=='air' || $data['concent_type']=='both')
                            <td><b>{{  $total_air }}</b></td>  
                             @endif
                             @if($data['concent_type']=='water' || $data['concent_type']=='both')
                             <td><b>{{  $total_water }}</b></td>
                             @endif   
                        </tr> 
                         <tr>
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 

                            <td><b>Fee already deposited at the time of last grant of CTO (-)</b></td>
                             @if($data['arrear_changed']=='Y')
                             <td>0</td>
                            @endif
                             @if($data['industry_noc']=='yes')
                              <td><b>0</b></td>
                             @elseif($data['industry_noc']=='yes' || $data['arrear_changed']=='Y')
                                <td class="text-secondary-d2">0</td>
                            @endif
                              @if($data['concent_type']=='air' || $data['concent_type']=='both')
                            <td><b>{{  $data['deposited_air_amount'] }}</b></td>  
                             @endif
                             @if($data['concent_type']=='water' || $data['concent_type']=='both')
                             <td><b>{{  $data['deposited_water_amount'] }}</b></td>
                             @endif   
                        </tr> 

                         <tr>
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 
                            <td></td>                 

                            <td><b>Total</b></td>
                             @if($data['arrear_changed']=='Y')
                             <td><b>{{ 0 }}</b></td>
                            @endif
                             @if($data['industry_noc']=='yes')
                              <td><b><?php $final_amount += $total_noc-0;?>{{ $total_noc-0 }}</b></td>
                             @elseif($data['industry_noc']=='yes' || $data['arrear_changed']=='Y')
                                <td class="text-secondary-d2"><?php $final_amount += $total_noc;?><b>{{ $total_noc }}</b></td>
                            @endif
                              @if($data['concent_type']=='air' || $data['concent_type']=='both')
                            <td><b><?php $final_amount += $total_air-$data['deposited_air_amount'];?>{{  $total_air-$data['deposited_air_amount'] }}</b></td>  
                             @endif
                             @if($data['concent_type']=='water' || $data['concent_type']=='both')
                             <td><b><?php $final_amount +=$total_water-$data['deposited_water_amount'];?>{{  $total_water-$data['deposited_water_amount'] }}</b></td>
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

