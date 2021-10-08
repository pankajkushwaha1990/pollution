<div class="main-card mb-3 card">
  <div class="card-body">  
    <form method="GET" action="{{ url('admin/renew-cto-calculate') }}" id="myForm">                       
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
                <input readonly="" type="text" name="industry_category_old" id="industry_category_old" class="form-control" >
                <input readonly="" type="hidden" name="industry_category_id_old" id="industry_category_id_old" class="form-control" >
                </div>
           </div>
           <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Revised Category</label>
                    <select name="industry_category_id_new" id="industry_category_id_new" class="form-control" required="">
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
                    <input id="previous_ca" name="previous_ca" placeholder="Enter Last CA" type="text"   class="form-control" required="">
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
                <input  id="new_ca" name="new_ca" placeholder="Enter Current CA" type="text" class="form-control" required="">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Previous Applied Date</label>
                    <input id="previous_apply_date" name="previous_apply_date" placeholder="Enter Date" type="text" class="form-control" required="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Valid Upto</label>
                    <input id="current_applied_date" name="current_applied_date" placeholder="Applied Date" type="text" class="form-control" required="">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Deposited  Air Amount</label>
                    <input name="deposited_air_amount" id="deposited_air_amount" placeholder="Enter Amount" type="text" class="form-control" required="">
                    @if($errors->has('deposited_air_amount'))
                    <span class="text text-danger">{{ $errors->first('deposited_air_amount') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Deposited  Water Amount</label>
                <input name="deposited_water_amount" id="deposited_water_amount" placeholder="Enter Amount" type="text"  class="form-control" required="">
                @if($errors->has('deposited_water_amount'))
                <span class="text text-danger">{{ $errors->first('deposited_water_amount') }}</span>
                @endif
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class=""><b>Penalty  Air Amount</b></label>
                    <input name="penalty_air_amount" id="penalty_air_amount" value="0" placeholder="Enter Amount" type="text" class="form-control" required="">
                    @if($errors->has('penalty_air_amount'))
                    <span class="text text-danger">{{ $errors->first('penalty_air_amount') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class=""><b>Penalty  Water Amount</b></label>
                <input name="penalty_water_amount" value="0" id="penalty_water_amount" placeholder="Enter Amount" type="text"  class="form-control" required="">
                @if($errors->has('penalty_water_amount'))
                <span class="text text-danger">{{ $errors->first('penalty_water_amount') }}</span>
                @endif
                </div>
            </div>
        </div>
                                                          

        <div class="form-row">
            <div class="col-md-4">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Duration</label>
                <input id="duration" name="duration" placeholder="Enter Duration" type="text" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-4">
               <div class="position-relative form-group">
               <label for="exampleEmail11" class="">Renewal Apply On&nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-default btn-sm active varied_calculation" format='renewal' style="background-color: #18b3ef;"  data-toggle="varied" data-title="Y">Renewal</a>
              <a class="btn btn-default btn-sm  varied_calculation" format='varied'  data-toggle="varied" data-title="X">Varied</a>
            </div>
            <input type="hidden" name="varied" id="varied"></label>
               <input id="applied_on_view" name="applied_on_view" placeholder="Enter Applied Date" type="text" class="form-control" required="">
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
         <div class="form-row show_penalty_box" style="display: none;"></div>             
                                                          

        <div class="form-row">
            <div class="col-md-8"></div>

             <div class="col-md-2">
                <div class="position-relative form-group">
                 <button style="width: 100%;" type="submit" value="calculate" id="calculate" class="btn btn-success">Calculate</button>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative form-group">
                 <button style="width: 100%;" type="button" value="enter_penalty" id="enter_penalty" name="enter_penalty" class="btn btn-success">Add CA Certificate</button>
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
  var format = $('.currency_format.active').attr('format');
  $('.currency_format').click(function(){
      $('.currency_format').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
  })
</script>

<script type="text/javascript">
  var format = $('.varied_calculation.active').attr('format');
  $('.varied_calculation').click(function(){
      $('.varied_calculation').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
  })
</script>

<script type="text/javascript">
  $('#myForm').on('submit', function(e) {
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format.active').attr('format');
      var varied = $('.varied_calculation.active').attr('format');
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here').html(response);
         },
         data: { action: 'calculate','format':format,'varied':varied}

      })
  });
</script>

<script type="text/javascript">
    $('#enter_penalty').click(function(e){
        
        var previous_apply_date  = $('#previous_apply_date').val().split("/");
        var box_from             = previous_apply_date[2];
        var financial            = previous_apply_date[1]+''+previous_apply_date[0];
        if(financial<=331){
          var box_from             = previous_apply_date[2]-1;
        }
        var current_applied_date = $('#applied_on_view').val().split("/");
        var box_to               = current_applied_date[2];
        var box = '';
        for (var i = box_from; i<= box_to; i++) {
            box+='<div class="col-md-4"><div class="position-relative form-group"><label for="exampleEmail11" class="">CA Certificate '+i+'</label><input id="ca" name="penalty_ca['+i+']" placeholder="Enter CA '+i+'" type="text" class="form-control" required=""></div></div>';
        }
        $('.show_penalty_box').html(box).show();
    })
</script>

<script type="text/javascript">
    $('#industry_id').change(function(){
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category-cto') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        $('#industry_category_old').val(result.data.category_name);
                        $('#industry_category_id_new').val(result.data.id);
                        $('#industry_category_id_old').val(result.data.id);
                        if(result.report!=null){
                            $('#previous_ca').val(result.report.current_ca);
                            $('#new_ca').val(result.report.current_ca);
                            $('#previous_apply_date').val(result.report.applied_on.split("-").reverse().join("/"));
                            $('#current_applied_date').val(result.report.valid_upto.split("-").reverse().join("/"));
                        }else{
                             $('#previous_ca').val('');
                            $('#new_ca').val('');
                            $('#previous_apply_date').val('');
                            $('#current_applied_date').val('');
                        }
                       
                     }
                }});
    });
</script>
<script type="text/javascript">
  
</script>
<script type="text/javascript">
   $('#current_applied_date').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
   });

    $('#previous_apply_date').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
         });
    $('#applied_on_view').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
         });
</script>