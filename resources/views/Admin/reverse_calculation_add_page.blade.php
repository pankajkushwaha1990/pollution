 <div class="main-card mb-3 card">
    <div class="card-body">
     <form method="GET" action="{{ url('admin/reverse_calculation_cto_fee') }}" id="myForm">
        <div class="form-row">
            <div class="col-md-12">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Industry Name</label>
                    <select name="industry_id" id="industry_id" class="form-control" required="">
                        <option value="">Select Industry</option>
                        @foreach($industry_list as $industry)
                        <option value="{{ $industry->id }}">{{ $industry->industry_name }} </option>
                        @endforeach
                    </select>
                    @if($errors->has('industry_id'))
                    <span class="text text-danger">{{ $errors->first('industry_id') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Industry Category <span class="previous_industry_category"></span></label>
                    <input type="hidden" name="previous_industry_category_id" id="previous_industry_category_id" class="form-control" required="">
                    <select name="industry_category_id" id="industry_category_id" class="form-control" required="">
                    <option value="">Select Category</option>
                       @foreach($industry_category as $category)
                        <option  value="{{ $category->id }}">{{ $category->category_name }} </option>
                       @endforeach
                    </select>
                     @if($errors->has('industry_category_id'))
                    <span class="text text-danger">{{ $errors->first('industry_category_id') }}</span>
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
                                                                      <input type="hidden" name="previous_ca" id="previous_ca" class="form-control" required="">
                                                                    <label for="exampleEmail11" class="">Current CA <span class="previous_current_ca"></span> &nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-default btn-sm  currency_format" format='num'  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm active currency_format" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive currency_format" format='cr' data-toggle="fun" data-title="N">CR</a>
            </div>
            <input type="hidden" name="fun" id="fun"></label>
                                                                    <input name="current_ca" id="current_ca" placeholder="Enter Current CA" type="text"
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
                                                                    <label for="exampleEmail11" class="">Mode<span class=""></span> &nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-default btn-sm active  mode_type" format='amount'  style="background-color: #18b3ef;"  data-toggle="fun" data-title="Y">Amount</a>
              <a class="btn btn-default btn-sm  mode_type" format='date' data-toggle="fun" data-title="X">Date</a>
            </div> |

            &nbsp; &nbsp;  &nbsp;&nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group mode_div">
              <a class="btn btn-default btn-sm active  mode_format" format='num' style="background-color: #18b3ef;"  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm  mode_format" format='lac'  data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive mode_format" format='cr' data-toggle="fun" data-title="N">CR</a>
            </div>


          </label>
                                                                    <input name="duration" id="duration" placeholder="Enter Duration" type="text"
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
                                                             <!--    <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                     <button style="width: -webkit-fill-available;" style="display: none;" type="button" id="save" value="save" class="btn btn-success">Save</button>
                                                                    </div>
                                                                </div> -->

                                                                
                                                                    <div class="col-md-2">
                
                 <button style="width: 100%;" type="submit" value="calculate" name="action" id="calculate" class="btn btn-success">Calculate</button>
               
            </div>
                                                                   
                                                            </div>
                                                               
                                                               
                                                                
                                                                
                                                            
                                                        </div>
                                                    </div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>



<script type="text/javascript">
  var format = $('.currency_format.active').attr('format');
  $('.currency_format').click(function(){
      $('.currency_format').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
  })
</script>

<script type="text/javascript">
  var format = $('.mode_type.active').attr('format');
  $('.mode_type').click(function(){
     
      $('.mode_type').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
       var mode_type =  $('.mode_type.active').attr('format');
      if(mode_type=='amount'){
        $('#duration').attr('placeholder','Enter Amount').val('');
        $('.mode_div').show();


      }else{
        $('#duration').attr('placeholder','Enter Last Date').val('');
        $('.mode_div').hide();
        $('#duration').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });
      }
  })
</script>


<script type="text/javascript">
  var format = $('.mode_format.active').attr('format');
  $('.mode_format').click(function(){
      $('.mode_format').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
  })
</script>


<script type="text/javascript">
  $('#myForm').on('submit', function(e) {
      e.preventDefault(); // prevent native submit
      var format         = $('.currency_format.active').attr('format');
      var reverse_format = $('.mode_type.active').attr('format');
      var mode_format = $('.mode_format.active').attr('format');

      
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here').html(response);
         },
         data: { action: 'calculate','format':format,'reverse_format':reverse_format,'mode_format':mode_format}

      })
  });
</script>



<script type="text/javascript">
    $('#industry_id').change(function(){
            $('#save').hide();
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        if(result.report.length==0){
                             $('#industry_category_id').val(result.data.id);
                             $('#previous_industry_category_id').val(result.data.id);
                             $('.previous_industry_category').text('');
                             $('.previous_valid_upto').text('');
                              $('.previous_current_ca').text('');
                             $('#industry_noc').attr('readonly',false);
                             $('#industry_noc').css('pointer-events','all');
                        }else{
                             $('#industry_category_id').val(result.report.industry_category_id);
                              $('#previous_industry_category_id').val(result.report.industry_category_id);
                             $('.previous_industry_category').text("("+result.report.industry_type+")");
                             $('.previous_valid_upto').text("(CTE Valid Upto "+result.report.valid_upto.split("-").reverse().join("/")+")");
                             $('.previous_current_ca').text("("+result.report.current_ca+")");
                             $('#industry_noc').attr('readonly',true);
                             $('#industry_noc').css('pointer-events','none');
                        }                   
                        
                        //$('.previous_current_ca_value').text("("+result.report.new_ca+")");
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
  $('#industry_noc').change(function(){
    if($(this).val()=='yes'){
        if(confirm("Do you want Add NOC?")){

        }else{
          $(this).val('no');
        }
    }
     
  })
</script>