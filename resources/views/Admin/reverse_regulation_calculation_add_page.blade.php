<form method="GET" action="{{ url('admin/reverse-regulation-fee-calculate') }}" id="eight_form_submit">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="main-card mb-3 card">
  <div class="card-body">  
                           
        <div class="form-row">
            <div class="col-md-12">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Industry Name
                       <button type="button" style="padding: 0 0;" class="btn mr-2 mb-2 btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Add New
                                                        </button>
                    </label>
                    <select name="industry_id" id="industry_id" class="form-control industry_id_eight" required="">
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
                <input id="oprational_date" name="oprational_date" placeholder="Enter Oprational Date" type="text"  class="form-control date_picker_here" required="">
                </div>
            </div>   

        </div>

      



      

       

                                                           


       

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Mode<span class=""></span> &nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-default btn-sm active  mode_type_eight" format='amount'  style="background-color: #18b3ef;"  data-toggle="fun" data-title="Y">Amount</a>
              <a class="btn btn-default btn-sm  mode_type_eight" format='date' data-toggle="fun" data-title="X">Date</a>
            </div> |

            &nbsp; &nbsp;  &nbsp;&nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group mode_div">
              <a class="btn btn-default btn-sm active  mode_format_eight" format='num' style="background-color: #18b3ef;"  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm  mode_format_eight" format='lac'  data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive mode_format_eight" format='cr' data-toggle="fun" data-title="N">CR</a>
            </div>
</label>
                <input id="duration" placeholder="Enter Amount" name="duration" type="text" class="form-control" required="">
                </div>
            </div>
            <div class="col-md-6">
               <div class="position-relative form-group">
               <label for="exampleEmail11" class="">Apply On</label>
               <input id="apply_date_view" name="apply_date_view" placeholder="Enter Applied Date" type="text" class="form-control date_picker_here_four" required="">
               </div>
            </div>
        </div>

            <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">CA Currency Format<br> &nbsp; &nbsp;  &nbsp; 
            <div id="radioBtn" class="btn-group">
              <a class="btn btn-default btn-sm  currency_format_eight" format='num'  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm active currency_format_eight" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive currency_format_eight" format='cr' data-toggle="fun" data-title="N">CR</a>
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
                    <input name="deposited_air_amount" id="deposited_air_amount" placeholder="Enter Amount" type="text" class="form-control" required="" value="0">
                                    </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Deposited  Water Amount</label>
                <input name="deposited_water_amount" id="deposited_water_amount" placeholder="Enter Amount" type="text" class="form-control" required="" value="0">
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
                 <button type="submit" style="width: 100%;" value="calculate" id="calculate_2" class="btn btn-success">Calculate</button>
                </div>
            </div>
  <div class="col-md-2">
                <div class="position-relative form-group">
                 <button type="button" style="width: 100%;" value="add_ca_certificate" id="add_ca_certificate_eight" class="btn btn-success">Add CA Certificate</button>
                </div>
            </div>
        </div>
                                                               
                                                               
                                                                
                                                                
                                                            
    </div>
</div>
</form>

