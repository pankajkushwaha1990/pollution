<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true" style="margin-left: 10%;padding-right: 17px;">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<!-- <h5 class="modal-title" id="exampleModalLongTitle"></h5> -->
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="col-md-12">
<form action="/admin/add_industry_ajax" method="post" id="add_industry_ajax" autocomplete="off" needs-validation="" novalidate="novalidate">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
<div class="main-card mb-3 card">
<div class="card-body"><h5 class="card-title">Add New Industries</h5>

<div class="form-row">
<div class="col-md-6">
<div class="position-relative form-group">
<label for="exampleEmail11" class="">Industry Name</label>
<input name="industry_name" id="industry_name" placeholder="Enter Industry Name" type="text" class="form-control" required="">
</div>
</div>

<div class="col-md-6">
<div class="position-relative form-group">
<label for="exampleEmail11" class="">Industry Category Code</label>
<input name="industry_type" id="industry_type" placeholder="Enter Industry Category Code" type="text" class="form-control" required="">
</div>
</div>





</div>

<div class="form-row">


<div class="col-md-6">
<div class="position-relative form-group">
<label for="exampleEmail11" class="">Industry Scale</label>
<select name="industry_scale" id="industry_scale" class="form-control" required="">
<option value="">Select Category</option>
<option value="small">Small </option>

<option value="medium">Medium </option>

<option value="large">Large </option>


</select>


</div>
</div>

<div class="col-md-6">
<div class="position-relative form-group">
<label for="exampleEmail11" class="">Industry Category</label>
<select name="industry_category" id="industry_category" class="form-control" required="">
<option value="">Select Category</option>
<option value="1">Red Large &amp; Medium Scale </option>

<option value="3">Orange </option>

<option value="4">Green </option>

<option value="5">Red Small Scale Industry </option>


</select>

</div>
</div>


</div>

<div class="form-row">





</div>

<div class="form-row">




</div>



<div class="form-row">
<div class="col-md-11"></div>
<div class="col-md-1">
<div class="position-relative form-group">
<button class="btn btn-success">Submit</button>
</div>
</div>
</div>





</div>
</div>
</form>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>

<div class="app-wrapper-footer">
<div class="app-footer">
<div class="">
<div class="app-footer__inner">
</div>
</div>
</div>
</div>


