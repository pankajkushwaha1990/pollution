<div class="main-card mb-3 card">
  <div class="card-body">  
    <form method="GET" action="{{ url('admin/extension-cte-fee-calculate') }}" id="second_form_submit">                       
        <div class="form-row">
            <div class="col-md-12">
                <div class="position-relative form-group">
                    <label for="exampleEmail11" class="">Industry Name
                       <button type="button" style="padding: 0 0;" class="btn mr-2 mb-2 btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Add New
                                                        </button>
                    </label>
                    <select name="industry_id" id="industry_id" class="form-control industry_select_second" required="">
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
              <a class="btn btn-default btn-sm  currency_format_second" format='num'  data-toggle="fun" data-title="Y">Num</a>
              <a class="btn btn-default btn-sm active currency_format_second" format='lac' style="background-color: #18b3ef;" data-toggle="fun" data-title="X">Lac</a>
              <a class="btn btn-default btn-sm notActive currency_format_second" format='cr' data-toggle="fun" data-title="N">CR</a>
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
               <label for="exampleEmail11" class="">Apply On</label>
               <input id="view_apply_on" name="view_apply_on" placeholder="Enter Applied Date" type="text" class="form-control date_picker_here" required="">
               </div>
            </div>


          <!--   <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Deposited Date</label>
                <input id="deposited_date" name="deposited_date" placeholder="Enter Deposited Date" type="text"  class="form-control" required="">
                </div>
            </div>      -->                                                             
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="position-relative form-group">
                <label for="exampleEmail11" class="">Duration</label>
                <input id="duration" name="duration" placeholder="Enter Duration" type="number" class="form-control" required="">
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
