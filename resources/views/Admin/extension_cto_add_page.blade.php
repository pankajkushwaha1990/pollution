<div class="main-card mb-3 card">
  <div class="card-body">  
                           
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
                </div>
            </div>                                                     
        </div>
        <div class="form-row">
           <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Industry Category</label>
                <input readonly="" type="text" id="industry_category_2" class="form-control" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Revised Category</label>
                    <select name="industry_category" id="revised_category_2" class="form-control" required="">
                    <option value="">Select Category</option>
                       @foreach($industry_category as $category)
                        <option  value="{{ $category->id }}">{{ $category->category_name }} </option>
                       @endforeach
                    </select>
                </div>
            </div>
        </div>



        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Previous CA</label>
                    <input  readonly="" id="current_ca_2" placeholder="Enter Current CA" type="number"   class="form-control" required="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Revised CA</label>
                <input  id="revised_ca_2" placeholder="Enter Current CA" type="number" class="form-control" required="">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Previous Applied Date</label>
                    <input readonly="" id="p_applied_date_2" placeholder="Enter Applied Date" type="text" class="form-control" required="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Valid Upto</label>
                    <input id="current_date_date_2" placeholder="Enter Applied Date" type="text" readonly="" class="form-control" required="">
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
            <div class="col-md-4">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Duration</label>
                <input id="duration_2" placeholder="Enter Duration" type="number" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-4">
               <div class="position-relative form-group">
               <label for="exampleEmail11" class="">Apply On</label>
               <input id="valid_upto1" placeholder="Enter Applied Date" type="text" class="form-control" required="">
               </div>
            </div>

                                                                 <div class="col-md-4">
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

                                                           
        </div>
<hr>
         <div class="form-row show_penalty_box" style="display: none;">
           
        </div>

                                                            

                                                          

        <div class="form-row">
            <div class="col-md-10"></div>

            <div class="col-md-1">
                <div class="position-relative form-group">
                 <button style="width: -webkit-fill-available;" type="button" id="save_2" style="display: none;" value="save" class="btn btn-success">Save</button>
                </div>
            </div>

             <div class="col-md-1">
                <div class="position-relative form-group">
                 <button type="button" value="calculate" id="calculate_2" class="btn btn-success">Calculate</button>
                </div>
            </div>
        </div>
                                                               
                                                               
                                                                
                                                                
                                                            
    </div>
</div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>

<script type="text/javascript">
    $('#calculate_2').click(function(){
        var current_cas      = $('#revised_ca_2').val();
        var industry_id      = $('#industry_name').val();
        var apply_date       = $('#valid_upto1').val();
        var boxes            = '';


        $.ajax({
                url: "{{ url('admin/ajax-extension-cto-penalty-check') }}",
                data: {
                    'current_cas':current_cas,'industry_id':industry_id,
                    'apply_date':apply_date
                     },
                success: function(result){
                    if(result.status=='success'){
                        var datas  = result.data;
                        for (var i = 0; i < datas.length; i++) {
                            boxes += ' <div class="col-md-2"><div class="position-relative form-group"><label for="exampleEmail11" class="">CA Certificate-'+datas[i].from+'</label><input type="number" class="form-control penalty_box" year='+datas[i].from+'></div></div>' 
                        }
                        $('.show_penalty_box').show();
                        $('.show_penalty_box').html(boxes);

                    }
                }});
    })
</script>

<script type="text/javascript">
    $('#industry_name').change(function(){
            $('#save_2').hide();
            var industry_id = $('#industry_name').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category-cto') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        $('#industry_category_2').val(result.data.category_name);
                        $('#revised_category_2').val(result.data.id);
                        $('#current_ca_2').val(result.report.current_ca);
                        $('#revised_ca_2').val(result.report.current_ca);
                        $('#p_applied_date_2').val(result.report.applied_on.split("-").reverse().join("/"));
                        $('#current_date_date_2').val(result.report.valid_upto.split("-").reverse().join("/"));
                     }
                }});
    });
</script>
<script type="text/javascript">
    $(document).on('click',"#calculate_2,#save_2", function () {
            $('#report_view').hide();
            $('.loader').show();
            var penalty_box_value         = [];
            var penalty_box_year         = [];
            var industry_id               = $('#industry_name').val();
            var prevoius_category         = $('#industry_category_2').val();
            var new_category_id           = $('#revised_category_2').val();
            var previous_ca               = $('#current_ca_2').val();
            var new_ca                    = $('#revised_ca_2').val();
            var previous_apply_date       = $('#p_applied_date_2').val();
            var current_applied_date      = $('#current_date_date_2').val();
            var deposited_air_amount       = $('#deposited_air_amount').val();
            var deposited_water_amount    = $('#deposited_water_amount').val();
            var duration                  = $('#duration_2').val();
            var apply_date                = $('#valid_upto1').val();
            var concent_type              = $('#concent_type').val();

            var penalty_box              = $('.penalty_box');
            penalty_box.each(function(){
                 penalty_box_value.push($(this).val());
                 penalty_box_year.push($(this).attr('year'));
                 // $(this).val($(this).val());
            });

            var action                    = $(this).val();

            $.ajax({
                url: "{{ url('admin/extension-cto-fee-calculate') }}",
                data: {
                    'industry_id':industry_id,'prevoius_category':prevoius_category,
                    'new_category_id':new_category_id,'previous_ca':previous_ca,'new_ca':new_ca,'previous_apply_date':previous_apply_date,'current_applied_date':current_applied_date,'deposited_air_amount':deposited_air_amount,
                    'deposited_water_amount':deposited_water_amount,'duration':duration,'apply_date':apply_date,
                    'action':action,'concent_type':concent_type,'penalty_box_value':penalty_box_value,'penalty_box_year':penalty_box_year
                     },
                success: function(result){
                     $('.loader').hide();
                     $('#calculation_result_here').html(result);
                     $('#save_2').show();
                      //$('.show_penalty_box').show();
                }});
        }) 
</script>
<script type="text/javascript">
   $('#current_date_date_2').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
   });

    $('#deposited_date_2').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
         });
    $('#current_date_date_2').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
         });
    $('#valid_upto1').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
         });
</script>