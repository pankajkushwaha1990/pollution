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
            @include('admin.left_sidebar')
            <div class="app-sidebar-overlay d-none animated fadeIn"></div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                  @include('admin.header')
                    <div class="app-inner-layout app-inner-layout-page">
                       
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__content" style="padding: 00px 0px 0">
                                <div class="tab-content">
                                    <div class="tab-pane tabs-animation fade show active" id="tab-content-0"
                                         role="tabpanel">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ route('industry_add_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Fresh CTE Calculation</h5>
                                                           
                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Name</label>
                                                                   

                                                        <select name="industry_name" id="industry_name" class="form-control" required="">
                                                                        <option value="">Select Industry</option>
                                                                        @foreach($industry_list as $industry)
                                                                        <option value="{{ $industry->id }}">{{ $industry->industry_name }} </option>

                                                                        @endforeach
                                                                        
                                                                    </select>

                                                         @if($errors->has('industry_name'))
                                                        <span class="text text-danger">{{ $errors->first('industry_name') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Industry Category</label>
                                                                    <input readonly="" type="text" id="industry_category"
                                                                                                         class="form-control" >
                                                         @if($errors->has('industry_mobile'))
                                                        <span class="text text-danger">{{ $errors->first('industry_mobile') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                
                                                                                                                         
                                                            </div>

                                                            <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Current CA</label>
                                                                    <input name="current_ca" id="current_ca" placeholder="Enter Current CA" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('current_ca'))
                                                        <span class="text text-danger">{{ $errors->first('current_ca') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Applied Date</label>
                                                                    <input name="applied_date" id="applied_date" placeholder="Enter Applied Date" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('applied_date'))
                                                        <span class="text text-danger">{{ $errors->first('applied_date') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                                                                         
                                                            </div>

                                                             <div class="form-row">
                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Deposited Amount</label>
                                                                    <input name="deposited_amount" id="deposited_amount" placeholder="Enter Deposited Amount" type="number"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('deposited_amount'))
                                                        <span class="text text-danger">{{ $errors->first('deposited_amount') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="">Deposited Date</label>
                                                                    <input name="deposited_date" id="deposited_date" placeholder="Enter Deposited Date" type="text"
                                                                                                         class="form-control" required="">
                                                         @if($errors->has('deposited_date'))
                                                        <span class="text text-danger">{{ $errors->first('deposited_date') }}</span>
                                                        @endif
                                                                    </div>
                                                                </div>


                                                                                                                         
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
                                                                <div class="col-md-11"></div>
                                                                 <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                     <button type="button" id="calculate" class="btn btn-success">Calculate</button>
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

                                                              
                                                                <div>
                                                                    <div class="page-content container">
    <!-- <div class="page-header text-blue-d2"> -->
       <!--  <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #111-222
            </small>
        </h1> -->

       <!--  <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export
                </a>
            </div>
        </div> -->
    <!-- </div> -->

    <div class="container px-0" id="report_view" style="display: none;">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                            <h4><span class="text-default-d3" id="industry_name_view"></span></h4>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Industry Type & Duration:</span>
                            <span class="text-600 text-110 text-blue align-middle" id="industry_type"></span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Industry Category:</span>
                            <span class="text-600 text-110 text-blue align-middle" id="industry_category_view"></span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Duration:</span>
                            <span class="text-600 text-110 text-blue align-middle" id="duration_view"></span>
                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-center text-100">
                            <!-- <i class="text-success-m2 mr-1"></i> -->
                             <span class="text-sm text-grey-m2 align-middle">Date Of CTE Applied:</span>
                            <span class="text-600 text-110 text-blue align-middle" id="applied_date_view"></span>
                        
                        </div>
                    </div>

                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

               
                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-2">From Date</div>
                        <div class="col-9 col-sm-2">To Date</div>
                        <div class="col-9 col-sm-3">Days</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">CA Amount</div>
                        <div class="col-1">CTE Amout</div>
                    </div>

                    <div class="text-95 text-secondary-d3 put_data_here">
                        

                       
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    <!--
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <tr>
                            <td>1</td>
                            <td>Domain registration</td>
                            <td>2</td>
                            <td class="text-95">$10</td>
                            <td class="text-secondary-d2">$20</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            -->

                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            <!-- Extra note such as company or payment information... -->
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Total Fee
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1" id="total_fee"></span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Deposited
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1" id="fee_deposited"></span>
                                </div>
                            </div>

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3" id="final_fee"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for your business</span>
                        <!-- <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a> -->
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
                    </div>
                </div>
                @include('admin.footer')

            </div>
        </div>
</div>

<div class="app-drawer-overlay d-none animated fadeIn"></div>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $('#industry_name').change(function(){
            var industry_id = $('#industry_name').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        $('#industry_category').val(result.data);
                     }
                }});
            $('#report_view').hide();

        });

        

        $('#calculate').click(function(){
            var free_type       =   'fresh_cte';
            var industry_id     = $('#industry_name').val();
            var duration         = $('#duration').val();
            var applied_date    = $('#applied_date').val();
            var current_ca      = $('#current_ca').val();
            var deposited_amount = $('#deposited_amount').val();
            var deposited_date   = $('#deposited_date').val();
            $('#report_view').hide();

            $('.loader').show();
            $.ajax({
                url: "{{ url('admin/fee-calculate') }}",
                data: {
                    'free_type': free_type,'industry_id':industry_id,'duration':duration,
                    'applied_date':applied_date,'current_ca_amount':current_ca,'deposited_amount':deposited_amount,
                    'deposited_date':deposited_date
                     },
                success: function(result){
                    $('.loader').hide();
                     if(result.status=='failure'){
                       $('.symbol_error').text(result.message);
                     }else{
                        $('.symbol_error').text('');
                        $('#industry_name_view').text(result.data.industry_name);
                        $('#industry_type').text(result.data.industry_type+' ('+result.data.tenure_from+' to '+result.data.tenure_from+')');
                        $('#industry_category_view').text(result.data.industry_category);
                        $('#duration_view').text(result.data.duration);
                        $('#applied_date_view').text(result.data.applied_date);
                        $('#total_fee').text(result.data.total_fee);
                        $('#fee_deposited').text(result.data.deposited_amount);
                        $('#final_fee').text(result.data.final_fee);
                        var html = '';

                        for (var i = 0;i< result.data.table_details.length; i++) {
                            var sr_no = result.data.table_details[i].sr_no;
                            var from_date = result.data.table_details[i].from_date;
                            var to_date = result.data.table_details[i].to_date;
                            var days = result.data.table_details[i].days;
                            var ca_amount = result.data.table_details[i].ca_amount;
                            var cte_fees = result.data.table_details[i].cte_fees;
                            html+='<div class="row mb-2 mb-sm-0 py-25"><div class="d-none d-sm-block col-1">'+sr_no+'</div><div class="col-9 col-sm-2">'+from_date+'</div><div class="d-none d-sm-block col-2">'+to_date+'</div><div class="d-none d-sm-block col-3 text-95">'+days+'</div><div class="col-2 text-secondary-d2">'+ca_amount+'</div><div class="col-1 text-secondary-d2">'+cte_fees+'</div></div>';

                        }
                        $('#report_view').show();

                        $('.put_data_here').html(html);
                     }
                }});
        }) 



    })


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

<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
