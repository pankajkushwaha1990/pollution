<div class="main-card mb-3 card">
  <div class="card-body">  
    <form method="GET" action="{{ url('admin/extension-cte-fee-calculate') }}" id="myForm">                       
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
                </div>
            </div>                                                     
        </div>
        <div class="form-row">
           <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Industry Category</label>
                <input readonly="" type="text" name="previous_category_name" id="previous_category_name" class="form-control" >
                <input readonly="" type="hidden" name="previous_category_id" id="previous_category_id" class="form-control" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Revised Category</label>
                    <select name="new_category_id" id="new_category_id" class="form-control" required="">
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
                    <input  readonly="" name="previous_ca" id="previous_ca" placeholder="Enter Current CA" type="number"   class="form-control" required="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Revised CA &nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-default btn-sm  currency_format" format='num'  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm active currency_format" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive currency_format" format='cr' data-toggle="fun" data-title="N">CR</a>
            </div>
            <input type="hidden" name="fun" id="fun"></label>
                <input name="new_ca"  id="new_ca" placeholder="Enter Current CA" type="text" class="form-control" required="">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Previous Applied Date</label>
                    <input readonly="" name="previous_apply_date" id="previous_apply_date" placeholder="Enter Applied Date" type="text" class="form-control" required="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Valid Upto</label>
                    <input name="current_apply_date" id="current_apply_date" placeholder="Enter Applied Date" type="text" readonly="" class="form-control" required="">
                </div>
            </div>
        </div>

                                                           


        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Deposited Amount</label>
                <input id="deposited_amount" name="deposited_amount" value="0" placeholder="Enter Deposited Amount" type="number" class="form-control" required="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Deposited Date</label>
                <input id="deposited_date" name="deposited_date" placeholder="Enter Deposited Date" type="text"  class="form-control" required="">
                </div>
            </div>                                                                  
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Duration</label>
                <input id="duration" name="duration" placeholder="Enter Duration" type="number" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-6">
               <div class="position-relative form-group">
               <label for="exampleEmail11" class="">Apply On</label>
               <input id="view_apply_on" name="view_apply_on" placeholder="Enter Applied Date" type="text" class="form-control" required="">
               </div>
            </div>
        </div>

           <div class="form-row">
            <div class="col-md-10"></div>

           

             <div class="col-md-2">
                <div class="position-relative form-group">
                 <button style="width: 100%;" type="submit" value="calculate" id="calculate_2" class="btn btn-success">Calculate</button>
                </div>
            </div>
        </div>
    </form>



                                                            

                                                          

     
                                                               
                                                               
                                                                
                                                                
                                                            
    </div>
</div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

<script type="text/javascript">
  $('.convert_fields').keyup(function(){
     var current_value = $(this).val();
     $(this).attr('original_value',current_value);
  })
</script>

<script type="text/javascript">
  var format = $('.currency_format.active').attr('format');
  $('.currency_format').click(function(){
      $('.currency_format').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
  })
</script>

<script type="text/javascript">
    $('#industry_id').change(function(){
            $('#save_2').hide();
            var industry_id = $('#industry_id').val();
            var format = $('.currency_format.active').attr('format');
            $('#previous_category_name,#previous_category_id,#new_category_id,#previous_ca,#new_ca,#previous_apply_date,#current_apply_date').val('');
            $.ajax({
              url: "{{ url('admin/industry-id-to-category-cte-extension') }}",
              data:{'industry_id':industry_id,'format':format}, 
              success: function(result){
                     if(result.status=='success'){
                        $('#previous_category_name').val(result.data.category_name);
                        $('#previous_category_id').val(result.data.id);
                        $('#new_category_id').val(result.data.id);
                        $('#previous_ca').val(result.report.current_ca);
                        $('#new_ca').val(result.report.current_ca);
                        $('#previous_apply_date').val(result.report.applied_on.split("-").reverse().join("/"));
                        $('#current_apply_date').val(result.report.valid_upto.split("-").reverse().join("/"));
                     }
                }});
    });
</script>
<script type="text/javascript">
  $('#myForm').on('submit', function(e) {
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format.active').attr('format');
      
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here').html(response);
         },
         data: { action: 'calculate','format':format}

      })
  });
</script>


<script type="text/javascript">
    // $('#calculate_2,#save_2').click(function(){
    //         $('#report_view').hide();
    //         $('.loader').show();
    //         var industry_id               = $('#industry_name').val();
    //         var prevoius_category         = $('#industry_category_2').val();
    //         var new_category_id           = $('#revised_category_2').val();
    //         var previous_ca               = $('#current_ca_2').val();
    //         var new_ca                    = $('#revised_ca_2').val();
    //         var previous_apply_date       = $('#p_applied_date_2').val();
    //         var current_applied_date      = $('#current_date_date_2').val();
    //         var deposited_amount          = $('#deposited_amount_2').val();
    //         var deposited_date            = $('#deposited_date_2').val();
    //         var duration                  = $('#duration_2').val();
    //         var apply_date                = $('#valid_upto1').val();
    //         var action                    = $(this).val();

    //         $.ajax({
    //             url: "{{ url('admin/extension-cte-fee-calculate') }}",
    //             data: {
    //                 'industry_id':industry_id,'prevoius_category':prevoius_category,
    //                 'new_category_id':new_category_id,'previous_ca':previous_ca,'new_ca':new_ca,
    //                 'previous_apply_date':previous_apply_date,'current_applied_date':current_applied_date,'deposited_amount':deposited_amount,'deposited_date':deposited_date,
    //                 'duration':duration,'apply_date':apply_date,'action':action
    //                  },
    //             success: function(result){
    //                  $('.loader').hide();
    //                  $('#calculation_result_here').html(result);
    //                  $('#save_2').show();
    //                  $('.show_penalty_box').show();
    //             }});
    //     }) 
</script>
<script type="text/javascript">
   $('#deposited_date').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
   });

    $('#view_apply_on').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
         });
</script>