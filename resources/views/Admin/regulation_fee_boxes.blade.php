                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ route('confirm_password_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body"><h5 class="card-title"><b><u>Enter CA Amount</u></b></h5>
                                                           
                                                            <div class="form-row">
                                                               @foreach($box_slot as $slot)
                                                               
                                                                 <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class=""><b>{{ $slot }}</b></label>
                                                                    <input name="current_ca[{{ $slot }}]" id="password_confirmation" placeholder="Enter CA Amount" type="text"
                                                                                                         class="form-control" required="">
                                                        
                                                                    </div>
                                                                </div> 
                                                                @endforeach
                                                                @foreach($box_slot_filled as $year => $slot)
                                                               
                                                                 <div class="col-md-4">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class=""><b>{{ $year }}</b></label>
                                                                    <input name="current_ca[{{ $year }}]" value="{{ $slot }}" id="password_confirmation" placeholder="Enter CA Amount" type="text"
                                                                                                         class="form-control" required="">
                                                        
                                                                    </div>
                                                                </div> 
                                                                @endforeach
                                                            </div>
                                                           
                                                               
                                                               
                                                                
                                                                
                                                            
                                                        </div>
                                                    </div>
                                                </form>
                                                    
                                                </div>
                                            </div>

<?php 
if(isset($calculation['header'])){
    ?>

                                            <style>
tr:nth-child(even) {background-color: #c2c2c2;}
</style>
<div class="page-content container" >
    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12" id="printarea">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <?php 
                            $header = @$calculation['header'];
                            // dd($header);
                            ?>
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
                             <span class="text-sm text-grey-m2 align-middle">Duration:</span>
                            <span class="text-600 text-110 text-blue align-middle" >{{ $header['duration'] }}</span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Date Of CTE Applied:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $header['applied_date'] }}</span>
                        
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
                             <?php 
                            $table_head = @$calculation['table_head'];
                            if(isset($table_head)){

                           
                            // dd($header);
                            ?>
                            @foreach($table_head as $head)
                            <th>{{ $head }}</th>
                            @endforeach

                        <?php } ?>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr> 
                         <?php 
                            $table_rows = @$calculation['table_rows'];
                            if(isset($table_rows)){

                           
                            // dd($header);
                            ?>                       
                        @foreach($table_rows as $detail)
                        <tr>
                            <td>{{ $detail['sr_no'] }}</td>
                            <td>{{ $detail['from_date'] }}</td>
                            <td>{{ $detail['to_date'] }}</td>
                            <td class="text-95">{{ $detail['days'] }}</td>
                            <td class="text-secondary-d2">{{ money_format_change($detail['ca_certificate_amt']) }}</td>
                            <td class="text-secondary-d2">{{ money_format_change($detail['ca_diff']) }}</td>
                            <td class="text-secondary-d2">{{ money_format_change($detail['noc_fees']) }}</td>
                            <td class="text-secondary-d2">{{ money_format_change($detail['water_regu']) }}</td>
                            <td class="text-secondary-d2">{{ money_format_change($detail['cto_water_fee']) }}</td>
                            <td class="text-secondary-d2">{{ money_format_change($detail['water_penalty']) }}</td>

                            <td class="text-secondary-d2">{{ money_format_change($detail['air_regu']) }}</td>
                            <td class="text-secondary-d2">{{ money_format_change($detail['cto_air_fee']) }}</td>
                            <td class="text-secondary-d2">{{ money_format_change($detail['air_penalty']) }}</td>

                        </tr> 
                        @endforeach

                    <?php } ?>
                    </tbody>
                </table>
            </div>
            

                    <div class="row mt-3">
                        <div class="col-12 col-sm-0 text-grey-d2 text-95 mt-2 mt-lg-0">
                            <!-- Extra note such as company or payment information... -->
                        </div>

                        <?php 
                            $footer = @$calculation['footer'];
                            // dd($header);
                            ?> 

                        <div class="col-12 col-sm-12 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-5 text-right">
                                    <b>Fee Total   </b>
                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['noc_fees_total']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_water_regu']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_cto_water_fee']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_water_penalty']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_air_regu']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_cto_air_fee']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_air_penalty']) }}</b></span>
                                </div>
                            </div>

                             <div class="row my-2">
                                <div class="col-5 text-right">
                                    <b>Fee already deposited at the time of last grant of CTO (-)    </b>
                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>0</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>0</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>0</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>0</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>0</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>0</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>0</b></span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-5 text-right">
                                    <b>Total    </b>
                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['noc_fees_total']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_water_regu']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_cto_water_fee']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_water_penalty']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_air_regu']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_cto_air_fee']) }}</b></span>
                                </div>
                                 <div class="col-1" style="text-align: right;">
                                    <span class="text-120 text-secondary-d1" ><b>{{ money_format_change($footer['total_air_penalty']) }}</b></span>
                                </div>
                            </div>


                         

                          

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    <b>Payable Amount                 </b>
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3" ><b>{{ money_format_change($footer['payable_amount']) }}</b></span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr />

                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        <!-- <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0"></a> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-md-8"></div>
                <!-- <div class="col-md-2"></div> -->
                 <div class="col-md-1">
                   <!--  <button id="save_cte_data" class="btn btn-success">Save</button> -->
                <button type="button" id="print_button" class="btn btn-success">Print</button>
            </div>
            
                <div class="col-md-1">
                   <!--  <button id="save_cte_data" class="btn btn-success">Save</button>
                <button type="button" id="print_button" class="btn btn-success">Print</button> -->
            </div>
        </div>
    </div>
</div>
<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
<script type="text/javascript">
     $("#print_button").click(function () {
         $("#printarea").print();
     });
    // $('#save_cte_data').click(function(e){
    //     e.preventDefault(); // prevent native submit
    //      $('#myForm').ajaxSubmit({
    //           success: function(response) {
    //             $('#calculation_result_here').html(response);
    //          },
    //          data: { action: 'save'}
    //       })
    // })
</script>

<?php } ?>


                                        