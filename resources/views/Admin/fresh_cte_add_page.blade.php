<div class="main-card mb-3 card">
    <div class="card-body">
      <form method="GET" action="{{ url('admin/fresh-cte-fee-calculate') }}" id="myForm">
       <div class="form-row">
            <div class="col-md-6">
             <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Industry Name</label>
                <select name="industry_id" id="industry_id"  class="form-control" required="">
                    <option value="">Select Industry</option>
                    @foreach($industry_list as $industry)
                        <option value="{{ $industry->id }}">{{ $industry->industry_name }} </option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="position-relative form-group">
                  <label for="exampleEmail11" class="">Industry Category</label>
                  <input required="" readonly="" name="industry_category_name" type="text" id="industry_category_name" class="form-control" >
                  <input type="hidden" id="industry_category_id" name="industry_category_id" value="" class="form-control" >
              </div>
            </div>
        </div>

        <div class="form-row">
           <div class="col-md-6">
                <div class="position-relative form-group">
                 <label for="exampleEmail11" class="">Current CA &nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-default btn-sm  currency_format" format='num'  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm active currency_format" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive currency_format" format='cr' data-toggle="fun" data-title="N">CR</a>
            </div>
            <input type="hidden" name="fun" id="fun">
          </label>
                 <input name="current_ca" id="current_ca" placeholder="Enter Current CA" type="text" class="form-control convert_fields" required="">
                </div>
           </div>
           <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Applied Date</label>
                    <input name="applied_date" id="applied_date" placeholder="Enter Applied Date" type="text" class="form-control" required="">
                </div>
           </div>
        </div>

        <div class="form-row">
          <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Deposited Amount</label>
                    <input required="" value="0"  name="deposited_amount" placeholder="Enter Deposited Amount" type="number" class="form-control convert_fields" required="">
                </div>
          </div>
          <div class="col-md-6">
               <div class="position-relative form-group">
                 <label for="exampleEmail11" class="">Deposited Date</label>
                 <input required="" name="deposited_date" id="deposited_date" placeholder="Enter Deposited Date" type="text" class="form-control" required="">
               </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-6">
            <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Duration</label>
                <input name="duration" id="duration" placeholder="Enter Duration" type="number" class="form-control" required="">
            </div>
          </div>

          

        </div>

        <div class="form-row">
            <div class="col-md-10"></div>
           <!--  <div class="col-md-1">
                <div class="position-relative form-group">
                 <button style="width: -webkit-fill-available;" type="submit" id="save" name="action" value="save" class="btn btn-success">Save</button>
                </div>
            </div> -->

             <div class="col-md-2">
                
                 <button style="width: 100%;" type="submit" value="calculate" name="action" id="calculate" class="btn btn-success">Calculate</button>
               
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
            $('#save').hide();
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        $('#industry_category_name').val(result.data.category_name);
                        $('#industry_category_id').val(result.data.id);
                     }
                }});
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