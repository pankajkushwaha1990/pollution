<div class="main-card mb-3 card">
  <div class="card-body">  
    <form method="GET" action="{{ url('admin/renew-cto-calculate') }}" id="four_form_submit">                       
        <div class="form-row">
            <div class="col-md-12">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Industry Name
                       <button type="button" style="padding: 0 0;" class="btn mr-2 mb-2 btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Add New
                                                        </button>
                    </label>
                    <select name="industry_id" id="industry_id" class="form-control industry_id_four" required="">
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
              <a class="btn btn-default btn-sm  currency_format_four" format='num'  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm active currency_format_four" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive currency_format_four" format='cr' data-toggle="fun" data-title="N">CR</a>
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
                    <input id="previous_apply_date" name="previous_apply_date" placeholder="Enter Date" type="text" class="form-control date_picker_here" required="">
                </div>
            </div>

            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Valid Upto</label>
                    <input id="current_applied_date" name="current_applied_date" placeholder="Applied Date" type="text" class="form-control date_picker_here_four" required="">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Deposited  Air Amount</label>
                    <input name="deposited_air_amount" id="deposited_air_amount" placeholder="Enter Amount" type="text" class="form-control" required="" value="0">
                    @if($errors->has('deposited_air_amount'))
                    <span class="text text-danger">{{ $errors->first('deposited_air_amount') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Deposited  Water Amount</label>
                <input name="deposited_water_amount" id="deposited_water_amount" placeholder="Enter Amount" type="text"  class="form-control" required="" value="0">
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
              <a class="btn btn-default btn-sm active varied_calculation_four" format='renewal' style="background-color: #18b3ef;"  data-toggle="varied" data-title="Y">Renewal</a>
              <a class="btn btn-default btn-sm  varied_calculation_four" format='varied'  data-toggle="varied" data-title="X">Varied</a>
            </div>
            <input type="hidden" name="varied" id="varied"></label>
               <input id="applied_on_view" name="applied_on_view" placeholder="Enter Applied Date" type="text" class="form-control date_picker_here_five" required="">
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
                 <button style="width: 100%;" type="button" value="enter_penalty" id="enter_penalty" name="enter_penalty" class="btn btn-success enter_penalty_four">Add CA Certificate</button>
                </div>
            </div>
        </div>

        </form>
                                                               
                                                               
                                                                
                                                                
                                                            
    </div>
</div>
