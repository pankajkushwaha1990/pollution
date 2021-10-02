 <form method="GET" action="{{ url('admin/reverse-regulation-fee-calculate') }}" id="myForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="main-card mb-3 card">
  <div class="card-body">  
                           
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
                    <select name="industry_category_id" id="industry_category_id" class="form-control" required="">
                    <option value="">Select Category</option>
                       @foreach($industry_category as $category)
                        <option  value="{{ $category->id }}">{{ $category->category_name }} </option>
                       @endforeach
                    </select>
                </div>
            </div>

             <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Oprational Date</label>
                <input id="oprational_date" name="oprational_date" placeholder="Enter Oprational Date" type="text"  class="form-control" required="">
                </div>
            </div>   

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
                <input id="duration" placeholder="Enter Amount" name="duration" type="text" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-6">
               <div class="position-relative form-group">
               <label for="exampleEmail11" class="">Apply On</label>
               <input id="apply_date_view" name="apply_date_view" placeholder="Enter Applied Date" type="text" class="form-control" required="">
               </div>
            </div>
        </div>

            <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">CA Currency Format<br> &nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-default btn-sm  currency_format" format='num'  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm active currency_format" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive currency_format" format='cr' data-toggle="fun" data-title="N">CR</a>
            </div>
            <input type="hidden" name="fun" id="fun"></label>
               
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
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Deposited  Air Amount</label>
                    <input name="deposited_air_amount" id="deposited_air_amount" placeholder="Enter Amount" type="text" class="form-control" required="">
                                    </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Deposited  Water Amount</label>
                <input name="deposited_water_amount" id="deposited_water_amount" placeholder="Enter Amount" type="text" class="form-control" required="">
                                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class=""><b>Penalty  Air Amount</b></label>
                    <input name="penalty_air_amount" id="penalty_air_amount" value="0" placeholder="Enter Amount" type="text" class="form-control" required="">
                                    </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class=""><b>Penalty  Water Amount</b></label>
                <input name="penalty_water_amount" value="0" id="penalty_water_amount" placeholder="Enter Amount" type="text" class="form-control" required="">
                                </div>
            </div>
        </div>
<hr>
        <div class="form-row" id="show_penalty_box">
            
        </div>



                                                            

                                                          

        <div class="form-row">
            <div class="col-md-8"></div>

        <!--     <div class="col-md-1">
                <div class="position-relative form-group">
                 <button style="width: -webkit-fill-available;" type="button" id="save_2" style="display: none;" value="save" class="btn btn-success">Save</button>
                </div>
            </div>
 -->
  <div class="col-md-2">
                <div class="position-relative form-group">
                 <button type="button" style="width: 100%;" value="add_ca_certificate" id="add_ca_certificate" class="btn btn-success">Add CA Certificate</button>
                </div>
            </div>

             <div class="col-md-2">
                <div class="position-relative form-group">
                 <button type="submit" style="width: 100%;" value="calculate" id="calculate_2" class="btn btn-success">Calculate</button>
                </div>
            </div>
        </div>
                                                               
                                                               
                                                                
                                                                
                                                            
    </div>
</div>
</form>


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

<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

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
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        
                        $('#industry_category_id').val(result.data.id);
                       
                     }
                }});
    });
</script>

<script type="text/javascript">
    $('#add_ca_certificate').click(function(e){        
        var oprational_date  = $('#oprational_date').val().split("/");
        var box_from             = oprational_date[2];
        var financial            = oprational_date[1]+''+oprational_date[0];
        if(financial<=331){
          var box_from             = oprational_date[2]-1;
        }
        var current_applied_date = $('#apply_date_view').val().split("/");
        var box_to               = current_applied_date[2];
        var box = '';
        for (var i = box_from; i<= box_to; i++) {
            box+='<div class="col-md-3"><div class="position-relative form-group"><label for="exampleEmail11" class="">CA Certificate '+i+'</label><input id="ca" name="penalty_ca['+i+']" placeholder="Enter CA '+i+'" type="text" class="form-control" required=""></div></div>';
        }
        $('#show_penalty_box').html(box).show();
    })
</script>


<script type="text/javascript">
  $('#myForm').on('submit', function(e) {
    e.preventDefault(); // prevent native submit
    var format = $('.currency_format.active').attr('format');
    var reverse_format = $('.mode_type.active').attr('format');
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here').html(response);
         },
         data: { action: 'calculate','format':format,'reverse_format':reverse_format}

      })
  });
</script>


<script type="text/javascript">
   $('#oprational_date').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
   });

   
    $('#apply_date_view').datepicker({
             uiLibrary: 'bootstrap',
             format: 'dd/mm/yyyy'
         });
</script>