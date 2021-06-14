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
                                             @if (\Session::has('error_message'))
                                                <!-- <div class="alert alert-warning"> -->
                                        <div class="card mb-3">
                                            <div class="card-header-tab card-header">
                                                    <ul>
                                                        <li class="text text-danger">{!! \Session::get('error_message') !!}</li>
                                                    </ul>
                                        </div>
                                                <!-- </div> -->
                                            @endif
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ route('tenure_fee_details_submit') }}" method="post" id="signupForm" autocomplete="off" needs-validation" novalidate>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <input type="hidden" name="tenure_id" value="{{ $tenure->id }}" />
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body"><h5 class="card-title">Consent Fee For Tenure <br><b><?php 
                                                            if($tenure->from!=0){
                                                                echo date('d/m/Y',strtotime($tenure->from));
                                                            }else{
                                                                 echo "Before";
                                                            }  ?> -  {{ 
                                                             date('d/m/Y',strtotime($tenure->to)) }}</b></h5>


                                                             <div class="form-row">
                                                                <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class=""><b>Sr.</b></label>
                                                                   
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-5">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class=""><b>Fixed Capital Investment In Lakh.</b></label>
                                                                   
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="" style="color:red;"><b>Red Category</b></label>
                                                                   
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="" style="color:orange;"><b>Orange Category</b></label>
                                                                   
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                    <label for="exampleEmail11" class="" style="color:green;"><b>Green Category</b></label>
                                                                   
                                                                    </div>
                                                                </div>                                                               
                                                            </div>

                                                        @if(count($fees)==0)   
                                                            <div class="form-row row_count">
                                                                <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                    <div>1</div>
                                                                    </div>
                                                                </div>

                                                                  <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="start_amount[]" id="start_amount" placeholder="Start Amount" type="number" pattern="[0-9]{4}[a-zA-Z]{2}"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>

                                                                 <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="end_amount[]" id="end_amount" placeholder="End Amount" type="number"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                                  <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="red_amount[]" id="red_amount" placeholder="Amount" type="number"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="orange_amount[]" id="orange_amount" placeholder="Amount" type="number"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="green_amount[]" id="green_amount" placeholder="Amount" type="number"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>
                                                                                                                               
                                                            </div>
                                                        @else
                                                           @foreach($fees as $key => $fee)
                                                             <div class="form-row row_count">
                                                                <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                    <div>{{ $key+1 }}</div>
                                                                    </div>
                                                                </div>

                                                                  <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="start_amount[]" id="start_amount" placeholder="Start Amount" type="number" value="{{ $fee->start_amount }}" 
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>

                                                                 <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="end_amount[]" id="end_amount" placeholder="End Amount" type="number" value="{{ $fee->end_amount }}"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                                  <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="red_amount[]" id="red_amount" placeholder="Amount" type="number" value="{{ $fee->red_amount }}"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="orange_amount[]" id="orange_amount" placeholder="Amount" type="number" value="{{ $fee->orange_amount }}"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-2">
                                                                    <div class="position-relative form-group">
                                                                   
                                                                    <input name="green_amount[]" id="green_amount" placeholder="Amount" type="number" value="{{ $fee->green_amount }}"
                                                                                                         class="form-control" required="">
                                                       
                                                                    </div>
                                                                </div>
                                                                                                                               
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                            <div id="add_more_row">
                                                                
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-md-10"></div>
                                                                 <div class="col-md-1">
                                                                    <div class="position-relative form-group">
                                                                     <button type="button" class="btn btn-info add_new_row">New Row</button>
                                                                    </div>
                                                                </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
<script type="text/javascript">
  $(function(){
    $('body').on('click','.add_new_row',function(){
    var count = $('.row_count').length+1;
        var html = '<div class="form-row row_count"><div class="col-md-1"><div class="position-relative form-group"><div>'+count+'</div></div></div><div class="col-md-2"><div class="position-relative form-group"><input name="start_amount[]" id="start_amount" placeholder="Start Amount" type="number" class="form-control" required=""></div></div><div class="col-md-2"><div class="position-relative form-group"><input name="end_amount[]" id="end_amount" placeholder="End Amount" type="number" class="form-control" required=""></div></div><div class="col-md-1"></div><div class="col-md-2"><div class="position-relative form-group"><input name="red_amount[]" id="red_amount" placeholder="Amount" type="number" class="form-control" required=""></div></div><div class="col-md-2"><div class="position-relative form-group"><input name="orange_amount[]" id="orange_amount" placeholder="Amount" type="number" class="form-control" required=""></div></div><div class="col-md-2"><div class="position-relative form-group"><input name="green_amount[]" id="green_amount" placeholder="Amount" type="number" class="form-control" required=""></div></div></div>';
    $('#add_more_row').append(html);
    })
  })
</script>

<!-- Mirrored from demo.dashboardpack.com/kero-html-sidebar-pro/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 May 2021 14:52:38 GMT -->
</html>
