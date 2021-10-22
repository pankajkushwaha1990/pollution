<div class="main-card mb-3 card">
<div class="card-body">
<form method="GET" action="{{ url('admin/fresh-cto-fee-calculate') }}" id="third_form_submit">
<div class="form-row">
<div class="col-md-12">
<div class="position-relative form-group">
<label for="exampleEmail11" class="">Industry Name
   <button type="button" style="padding: 0 0;" class="btn mr-2 mb-2 btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Add New
                                                        </button>
</label>
<select name="industry_id" id="industry_id" class="form-control industry_id_third" required="">
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


<select name="industry_noc" id="industry_noc" class="form-control industry_noc_third" required="">


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
<a class="btn btn-default btn-sm  currency_format_third" format='num'  data-toggle="fun" data-title="Y">Num</a>
<a class="btn btn-default btn-sm active currency_format_third" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
<a class="btn btn-default btn-sm notActive currency_format_third" format='cr' data-toggle="fun" data-title="N">CR</a>
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
                                                         class="form-control date_picker_here" required="">
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
                    <input name="deposited_air_amount" id="deposited_air_amount" placeholder="Enter Deposited Amount" type="number" value="0" 
                                                         class="form-control" required="">
         @if($errors->has('deposited_air_amount'))
        <span class="text text-danger">{{ $errors->first('deposited_air_amount') }}</span>
        @endif
                    </div>
                </div>


        <div class="col-md-6">
                    <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Deposited  Water Amount</label>
                    <input name="deposited_water_amount" id="deposited_water_amount" placeholder="Enter Deposited Amount" type="number" value="0" 
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
