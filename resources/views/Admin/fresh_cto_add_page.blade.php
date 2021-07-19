 <div class="main-card mb-3 card">
                                                        <div class="card-body">
                                                           
                                                                <!-- <div class="divider"></div> -->

                                                            

                                                          
                                                           
                                                            <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Name</label>
                                                                   

                                                        <select name="industry_name" id="industry_name" class="form-control" required="">
                                                                        <option value="">Select Industry</option>
                                                                        @foreach($industry_list as $industry)
                                                                        <option value="{{ $industry->id }}">{{ $industry->industry_name }} </option>

                                                                        @endforeach
                                                                        
                                                                    </select>

                                                         @if($errors->has('industry_name'))
                                                        <span class="text text-danger">{{ $errors->first('industry_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                             

                                                                
                                                                                                                         
                                                            </div>



                                                            <div class="form-row">
                                                                 <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Category <span class="previous_industry_category"></span></label>
                                                                   <select name="industry_category" id="revised_category_2" class="form-control" required="">
                    <option value="">Select Category</option>
                       @foreach($industry_category as $category)
                        <option  value="{{ $category->id }}">{{ $category->category_name }} </option>
                       @endforeach
                    </select>
                                                         @if($errors->has('industry_mobile'))
                                                        <span class="text text-danger">{{ $errors->first('industry_mobile') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                 <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Select NOC</label>
                                                                   

                                                        <select name="industry_noc" id="industry_noc" class="form-control" required="">
                                                                       
                                                                       
                                                                        <option value="no" selected="">NO</option>
                                                                        <option value="yes">YES</option>

                                                                        
                                                                        
                                                                    </select>

                                                        
                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Current CA <span class="previous_current_ca"></span></label>
                                                                    <input name="current_ca" id="current_ca" placeholder="Enter Current CA" type="number"
                                                                                                         class="form-control" required="">

                                                                    

                                                         @if($errors->has('current_ca'))
                                                        <span class="text text-danger">{{ $errors->first('current_ca') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Applied Date <span class="previous_valid_upto"></span></label>
                                                                    <input name="applied_date" id="applied_date" placeholder="Enter Applied Date" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('applied_date'))
                                                        <span class="text text-danger">{{ $errors->first('applied_date') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                                                                         
                                                            </div>

                                                             <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Deposited  Air Amount</label>
                                                                    <input name="deposited_air_amount" id="deposited_air_amount" placeholder="Enter Deposited Amount" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('deposited_air_amount'))
                                                        <span class="text text-danger">{{ $errors->first('deposited_air_amount') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>


                                                        <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Deposited  Water Amount</label>
                                                                    <input name="deposited_water_amount" id="deposited_water_amount" placeholder="Enter Deposited Amount" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('deposited_water_amount'))
                                                        <span class="text text-danger">{{ $errors->first('deposited_water_amount') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                            <!--     <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Deposited Date</label>
                                                                    <input name="deposited_date" id="deposited_date" placeholder="Enter Deposited Date" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('deposited_date'))
                                                        <span class="text text-danger">{{ $errors->first('deposited_date') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div> -->


                                                                                                                         
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Duration</label>
                                                                    <input name="duration" id="duration" placeholder="Enter Duration" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('duration'))
                                                        <span class="text text-danger">{{ $errors->first('duration') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Consent Type</label>
                                                                   

                                                        <select name="concent_type" id="concent_type" class="form-control" required="">
                                                                        <option value="">Select Type</option>
                                                                        @foreach(config('app.industry_consent') as $key => $industry)
                                                                        <option value="{{ $key }}">{{ $industry }} </option>

                                                                        @endforeach
                                                                        
                                                                    </select>

                                                         @if($errors->has('concent_type'))
                                                        <span class="text text-danger">{{ $errors->first('concent_type') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                               <!--  <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Deposited Date</label>
                                                                    <input name="deposited_date" id="deposited_date" placeholder="Enter Deposited Date" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('deposited_date'))
                                                        <span class="text text-danger">{{ $errors->first('deposited_date') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div> -->


                                                                                                                         
                                                            </div>

                                                            

                                                          

                                                            <div class="form-row">
                                                                <div class="col-md-10"></div>
                                                                <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                     <button style="width: -webkit-fill-available;" style="display: none;" type="button" id="save" value="save" class="btn btn-success">Save</button>
                                                                    </div>
                                                                </div>

                                                                 <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                     <button type="button" value="calculate" id="calculate" class="btn btn-success">Calculate</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                               
                                                               
                                                                
                                                                
                                                            
                                                        </div>
                                                    </div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
<script type="text/javascript">
    $('#industry_name').change(function(){
            $('#save').hide();
            var industry_id = $('#industry_name').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        if(result.report==null){
                            var category_id = result.data.id;
                            $('#industry_noc').attr('readonly',false);
                             $('#industry_noc').attr('disabled',false);
                        }else{
                             var category_id = result.report.industry_category_id;
                             $('#industry_noc').attr('readonly',true);
                             $('#industry_noc').attr('disabled',true);
                        }
                        $('#revised_category_2').val(category_id);
                        $('.previous_industry_category').text("("+result.report.industry_type+")");
                        $('.previous_industry_type').text("("+result.report.industry_type+")");
                        $('.previous_valid_upto').text("(CTE Valid Upto "+result.report.valid_upto.split("-").reverse().join("/")+")");
                        $('.previous_current_ca').text("("+result.report.current_ca+")");
                        $('.previous_current_ca_value').text("("+result.report.current_ca+")");
                     }
                }});
            $('#report_view').hide();
        });
</script>
<script type="text/javascript">
   $('#applied_date').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });

   $('#deposited_date').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });
</script>
<script type="text/javascript">
    $('#calculate,#save').click(function(){
            $('#report_view').hide();
            $('.loader').show();
            
            var industry_id           = $('#industry_name').val();
            var industry_category     = $('#revised_category_2').val();
            var current_ca            = $('#current_ca').val();
            var applied_date          = $('#applied_date').val();
            var deposited_air_amount  = $('#deposited_air_amount').val();
            var deposited_water_amount   = $('#deposited_water_amount').val();
            var duration               = $('#duration').val();
            var concent_type           = $('#concent_type').val();
            var industry_noc           = $('#industry_noc').val();
            var action                 = $(this).val();


            $.ajax({
                url: "{{ url('admin/fresh-cto-fee-calculate') }}",
                data: {
                        'industry_id':industry_id,'industry_category':industry_category,'current_ca':current_ca,
                        'applied_date':applied_date,'deposited_air_amount':deposited_air_amount,
                        'deposited_water_amount':deposited_water_amount,'duration':duration,
                        'concent_type':concent_type,'action':action,'industry_noc':industry_noc
                     },
                success: function(result){
                    $('.loader').hide();
                     $('#calculation_result_here').html(result);
                     $('#save').show();
                    
                }});
        }) 

</script>
<script type="text/javascript">
  $('#industry_noc').change(function(){
    if($(this).val()=='yes'){
        if(confirm("Do you want Add NOC?")){

        }else{
          $(this).val('no');
        }
    }
     
  })
</script>