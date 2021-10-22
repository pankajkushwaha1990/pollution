<div class="main-card mb-3 card">
    <div class="card-body">
      <form method="GET" action="{{ url('admin/fresh-cte-fee-calculate') }}" id="first_form_submit">
       <div class="form-row">
            <div class="col-md-6">
             <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Industry Name 
                    <!-- <span style="cursor:pointer;" class="text text-success" id="add_company_id"> (Add New)</span> -->
                    <button type="button" style="padding: 0 0;" class="btn mr-2 mb-2 btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Add New
                                                        </button>

                </label>
                <select name="industry_id" id="industry_id"  class="form-control industry_select_first" required="">
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
              <a class="btn btn-default btn-sm  currency_format currency_format_first" format='num'  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm active currency_format currency_format_first" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive currency_format currency_format_first" format='cr' data-toggle="fun" data-title="N">CR</a>
            </div>
            <input type="hidden" name="fun" id="fun">
          </label>
                 <input name="current_ca" id="current_ca" placeholder="Enter Current CA" type="text" class="form-control convert_fields" required="">
                </div>
           </div>
           <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Applied Date</label>
                    <input name="applied_date" id="applied_date" placeholder="Enter Applied Date" type="text" class="form-control date_picker_here" required="">
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
          <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Deposited Amount</label>
                    <input required="" value="0"  name="deposited_amount" placeholder="Enter Deposited Amount" type="number" class="form-control convert_fields" required="">
                </div>
          </div>
        </div>


        <div class="form-row">
            <div class="col-md-10"></div>
 
             <div class="col-md-2">
                
                 <button style="width: 100%;" type="submit" value="calculate" name="action" id="calculate" class="btn btn-success">Calculate</button>
               
            </div>
        </div>
      </form>
    </div>
</div>
