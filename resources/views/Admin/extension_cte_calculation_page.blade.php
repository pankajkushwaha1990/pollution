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
                            @foreach($table_head as $head)
                            <th>{{ $head }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>                        
                        @foreach($table_rows as $detail)
                        <tr>
                            <td>{{ $detail['sr_no'] }}</td>
                            <td>{{ $detail['from_date'] }}</td>
                            <td>{{ $detail['to_date'] }}</td>
                            <td class="text-95">{{ $detail['days'] }}</td>
                            <td class="text-secondary-d2">{{ $detail['ca_amount'] }}</td>
                            <td class="text-secondary-d2">{{ $detail['cte_fees'] }}</td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            

                    <div class="row mt-3">
                        <div class="col-12 col-sm-6 text-grey-d2 text-95 mt-2 mt-lg-0">
                            <!-- Extra note such as company or payment information... -->
                        </div>

                        <div class="col-12 col-sm-6 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    <b>Total Fee</b>
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1" ><b>{{ $footer['total_cte_fee'] }}</b></span>
                                </div>
                            </div>

                         

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    <b>Deposited</b>
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1" ><b>{{ $footer['deposited_amount'] }}</b></span>
                                </div>
                            </div>

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    <b>Total Payable Amount</b>
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3" ><b>{{ $footer['final_fee'] }}</b></span>
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
                <div class="col-md-10"></div>
                <!-- <div class="col-md-2"></div> -->
                <div class="col-md-2"><button id="save_cte_data" class="btn btn-success">Save</button>&nbsp;&nbsp;<button id="print_button" class="btn btn-success">Print</button></div>
        </div>
    </div>
</div>
<script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
<script type="text/javascript">
    $("#print_button").click(function () {
        $("#printarea").print();
    });
    $('#save_cte_data').click(function(e){
        e.preventDefault(); // prevent native submit
         $('#myForm').ajaxSubmit({
              success: function(response) {
                $('#calculation_result_here').html(response);
             },
             data: { action: 'save'}
          })
    })
</script>

