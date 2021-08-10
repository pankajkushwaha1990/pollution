<!doctype html>
<html lang="en">


<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:51:32 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <link rel="icon" href="favicon.ico">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

<link href="{{ asset('/template/main.07a59de7b920cd76b874.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<style type="text/css">
    .text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}
</style>
</head>

<body>
<div class="app-container app-theme-gray">
        <div class="app-main">
            @include('Admin.left_sidebar')
            <div class="app-sidebar-overlay d-none animated fadeIn"></div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                  @include('Admin.header')
                    <div class="app-inner-layout app-inner-layout-page">
                       
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__content" style="padding: 00px 0px 0">
                                <div class="tab-content">
                                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0"
                                         role="tabpanel">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
            <form method="GET" action="{{ url('admin/regulation-fee-calculate') }}" id="myForm">
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
                <label for="exampleEmail11" class="">Duration</label>
                <input id="duration" placeholder="Enter Duration" name="duration" type="number" class="form-control" required="">
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

  <div class="main-card mb-3 card">
                    <div class="card-body">
                    <div class="mb-3"><h5 class="card-title">Report</h5></div>
                        <div class="mb-3"><span class="symbol_error text text-danger"></span></div>                     
                            <div class="divider"></div>
                            <div class="row">
                                <div class="col-md-5"></div>
                               <div class="col-md-4">  
                                        <div class="loader" style="display: none;">
                                        <div class="ball-rotate">
                                            <div></div>
                                        </div>
                                    </div>
                               </div>
                            </div>

                          
                            <div id="calculation_result_here">
 
                            </div>
                                                              
                                                              
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
           
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
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
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here').html(response);
         },
         data: { action: 'calculate','format':format}

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