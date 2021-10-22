<script type="text/javascript" src="{{ asset('/template/assets/scripts/main.07a59de7b920cd76b874.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/ajax_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('/template/assets/scripts/print.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
   $(document).ajaxStart(function() {
        $('#calculation_result_here_first').empty();
        $('.loader').show();
    });
   $( document ).ajaxComplete(function() {
        $('.loader').hide();
        $('.date_picker_here').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });
        $('.date_picker_here_four').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });
        $('.date_picker_here_five').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });
        $('.date_picker_here_seven').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });

        // $('.industry_select_first').selectpicker('show');;
        // $('.industry_select_second').selectpicker('show');;
        // $('.industry_id_third').selectpicker('show');;
        // $('.industry_id_four').selectpicker('show');
        // $('.industry_id_five').selectpicker('show');;
        // $('.industry_id_six').selectpicker('show');;
        // $('.industry_id_seven').selectpicker('show');
        // $('.industry_id_eight').selectpicker('show');

    });

   $(document).ready(function(){
    // $('#first_form_submit').validate();
    var fresh_cte = $('.cte_type_default:checked');
    if(fresh_cte.length>0){       
        $.ajax({url: "{{ url('admin/fresh-cte-add-page') }}", success: function(result){
            $('#calculation_result_here_first').html('');
            $('#ajax_cte_add_page_here_first').html(result);
        }});
    }

    $('body').on('change','.industry_select_first',function(){
            $('#save').hide();
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                if(result.status=='success'){
                    $('#industry_category_name').val(result.data.category_name);
                    $('#industry_category_id').val(result.data.id);
                }
            }});
    });

    var format = $('.currency_format_first.active').attr('format');
    $('body').on('click','.currency_format_first',function(){
      $('.currency_format_first').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    });

    $('body').on('submit','#first_form_submit',function(e){
      e.preventDefault();
      var format = $('.currency_format.active').attr('format');
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'calculate','format':format}
      })
    });

    $('body').on('click','#print_button_first',function(e){
        $("#printarea_first").print();
    });

    $('body').on('click','#save_cte_first',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format.active').attr('format');
      $('#first_form_submit').ajaxSubmit({
        success: function(response) {
           $('#calculation_result_here_first').html(response);
      },
      data: { action: 'save','format':format}
      })
    });

    $('.cte_type').click(function(){
        var cte_type = $(".cte_type:checked").val();
        if(cte_type=='extension'){
            $.ajax({url: "{{ url('admin/extension-cte-add-page') }}", success: function(result){
                $('#calculation_result_here_first').html('');
                $('#ajax_cte_add_page_here_first').html(result);
            }});
        }else{
            $.ajax({url: "{{ url('admin/fresh-cte-add-page') }}", success: function(result){
                $('#calculation_result_here_first').html('');
                $('#ajax_cte_add_page_here_first').html(result);
            }});
        }  
    })
    // first end


    $('body').on('change','.industry_select_second',function(){
        $('#save_2').hide();
        var industry_id = $('#industry_id').val();
        var format = $('.currency_format_second.active').attr('format');
        $('#previous_category_name,#previous_category_id,#new_category_id').val('');
        $('#previous_ca,#new_ca,#previous_apply_date,#current_apply_date').val('');
        $.ajax({
            url: "{{ url('admin/industry-id-to-category-cte-extension') }}",
            data:{'industry_id':industry_id,'format':format}, 
            success: function(result){
                if(result.status=='success'){
                    $('#previous_category_name').val(result.data.category_name);
                    $('#previous_category_id').val(result.data.id);
                    $('#new_category_id').val(result.data.id);
                    $('#previous_ca').val(result.report.current_ca);
                    $('#new_ca').val(result.report.current_ca);
                    $('#previous_apply_date').val(result.report.applied_on.split("-").reverse().join("/"));
                    $('#current_apply_date').val(result.report.valid_upto.split("-").reverse().join("/"));
                }
            }
        });
    });

    var format = $('.currency_format_second.active').attr('format');
    $('body').on('click','.currency_format_second',function(){
      $('.currency_format_second').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    });

    $('body').on('submit','#second_form_submit',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_second.active').attr('format');
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'calculate','format':format}

      })
    });

    $('body').on('click','#save_cte_second',function(e){
        e.preventDefault(); // prevent native submit
        var format = $('.currency_format_second.active').attr('format');
         $('#second_form_submit').ajaxSubmit({
              success: function(response) {
                $('#calculation_result_here_first').html(response);
        },
        data: { action: 'save','format':format}
        })
    })

    // second end
    var cto_type = $('.cto_type:checked');
    if(cto_type.length>0){
        $.ajax({url: "{{ url('admin/fresh-cto-add-page') }}", success: function(result){
            $('#ajax_cte_add_page_here_second').html(result);
        }});
    }

    $('body').on('change','.industry_id_third',function(){
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        if(result.report.length==0){
                             $('#industry_category_id').val(result.data.id);
                             $('#previous_industry_category_id').val(result.data.id);
                             $('.previous_industry_category').text('');
                             $('.previous_valid_upto').text('');
                              $('.previous_current_ca').text('');
                             $('#industry_noc').attr('readonly',false);
                             $('#industry_noc').css('pointer-events','all');
                        }else{
                             $('#industry_category_id').val(result.report.industry_category_id);
                              $('#previous_industry_category_id').val(result.report.industry_category_id);
                             $('.previous_industry_category').text("("+result.report.industry_type+")");
                             $('.previous_valid_upto').text("(CTE Valid Upto "+result.report.valid_upto.split("-").reverse().join("/")+")");
                             $('.previous_current_ca').text("("+result.report.current_ca+")");
                             $('#industry_noc').attr('readonly',true);
                             $('#industry_noc').css('pointer-events','none');
                        }                   
                        
                        //$('.previous_current_ca_value').text("("+result.report.new_ca+")");
                     }
                }});
            // $('#report_view').hide();
    });

    $('body').on('change','.industry_noc_third',function(){
            if($(this).val()=='yes'){
        if(confirm("Do you want Add NOC?")){
        }else{
          $(this).val('no');
        }
            }
    })
        
    var format = $('.currency_format_third.active').attr('format');
    $('body').on('click','.currency_format_third',function(){
      $('.currency_format_third').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    $('body').on('submit','#third_form_submit',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_third.active').attr('format');
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'calculate','format':format}

      })
    });    

    $('body').on('click','#save_cte_third',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_third.active').attr('format');
        $('#third_form_submit').ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'save','format':format}

      })
    });

    //third end 
    $('body').on('click','.cto_type',function(){
            var cto_type = $(".cto_type:checked").val();
            if(cto_type=='renew'){
               $.ajax({url: "{{ url('admin/extension-cto-add-page') }}", success: function(result){
                     $('#ajax_cte_add_page_here_second').html(result);
                }});
            }else{
                $.ajax({url: "{{ url('admin/fresh-cto-add-page') }}", success: function(result){
                     $('#ajax_cte_add_page_here_second').html(result);
                }});
            }  
    });

    $('body').on('change','.industry_id_four',function(e){
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category-cto') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        $('#industry_category_old').val(result.data.category_name);
                        $('#industry_category_id_new').val(result.data.id);
                        $('#industry_category_id_old').val(result.data.id);
                        if(result.report!=null){
                            $('#previous_ca').val(result.report.current_ca);
                            $('#new_ca').val(result.report.current_ca);
                            $('#previous_apply_date').val(result.report.applied_on.split("-").reverse().join("/"));
                            $('#current_applied_date').val(result.report.valid_upto.split("-").reverse().join("/"));
                        }else{
                             $('#previous_ca').val('');
                            $('#new_ca').val('');
                            $('#previous_apply_date').val('');
                            $('#current_applied_date').val('');
                        }
                       
                     }
                }});
    });

    var format = $('.currency_format_four.active').attr('format');
    $('body').on('click','.currency_format_four',function(e){    
      $('.currency_format_four').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    var format = $('.varied_calculation_four.active').attr('format');
    $('body').on('click','.varied_calculation_four',function(e){
      $('.varied_calculation_four').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    $('body').on('click','.enter_penalty_four',function(e){
        var previous_apply_date  = $('#previous_apply_date').val().split("/");
        var box_from             = previous_apply_date[2];
        var financial            = previous_apply_date[1]+''+previous_apply_date[0];
        if(financial<=331){
          var box_from             = previous_apply_date[2]-1;
        }
        var current_applied_date = $('#applied_on_view').val().split("/");
        var box_to               = current_applied_date[2];
        var box = '';
        for (var i = box_from; i<= box_to; i++) {
            box+='<div class="col-md-4"><div class="position-relative form-group"><label for="exampleEmail11" class="">CA Certificate '+i+'</label><input id="ca" name="penalty_ca['+i+']" placeholder="Enter CA '+i+'" type="text" class="form-control" required=""></div></div>';
        }
        $('.show_penalty_box').html(box).show();
    })

    $('body').on('submit','#four_form_submit',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_four.active').attr('format');
      var varied = $('.varied_calculation_four.active').attr('format');
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'calculate','format':format,'varied':varied}

      })
    });

    $('body').on('click','#save_cte_four',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_four.active').attr('format');
      var varied = $('.varied_calculation_four.active').attr('format');

        $('#four_form_submit').ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'save','format':format,'varied':varied}

      })
    });

    $('body').on('change','.industry_id_five',function(e){
            $('#save_2').hide();
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        
                        $('#industry_category_id').val(result.data.id);
                       
                     }
            }});
    });

    var format = $('.currency_format_five.active').attr('format');
    $('body').on('click','.currency_format_five',function(e){
      $('.currency_format_five').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    $('body').on('submit','#five_form_submit',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_five.active').attr('format');
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'calculate','format':format}

      })
    });

    $('body').on('click','#add_ca_certificate_five',function(e){       
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

    $('body').on('click','#save_cte_five',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_five.active').attr('format');
        $('#five_form_submit').ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'save','format':format}

      })
    });

    var cto_type = $('.cto_type_six:checked');
    if(cto_type.length>0){
        $.ajax({url: "{{ url('admin/reverse_calculation_add_page') }}", success: function(result){
            $('#ajax_cte_add_page_here_first').html(result);
        }});
    }

    $('body').on('change','.industry_id_six',function(e){
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        if(result.report.length==0){
                             $('#industry_category_id').val(result.data.id);
                             $('#previous_industry_category_id').val(result.data.id);
                             $('.previous_industry_category').text('');
                             $('.previous_valid_upto').text('');
                              $('.previous_current_ca').text('');
                             $('#industry_noc').attr('readonly',false);
                             $('#industry_noc').css('pointer-events','all');
                        }else{
                             $('#industry_category_id').val(result.report.industry_category_id);
                              $('#previous_industry_category_id').val(result.report.industry_category_id);
                             $('.previous_industry_category').text("("+result.report.industry_type+")");
                             $('.previous_valid_upto').text("(CTE Valid Upto "+result.report.valid_upto.split("-").reverse().join("/")+")");
                             $('.previous_current_ca').text("("+result.report.current_ca+")");
                             $('#industry_noc').attr('readonly',true);
                             $('#industry_noc').css('pointer-events','none');
                        }                   
                        
                        //$('.previous_current_ca_value').text("("+result.report.new_ca+")");
                     }
                }});
    });

    var format = $('.currency_format_six.active').attr('format');
    $('body').on('click','.currency_format_six',function(e){
      $('.currency_format_six').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    var format = $('.mode_type_six.active').attr('format');
    $('body').on('click','.mode_type_six',function(e){     
      $('.mode_type_six').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
       var mode_type =  $('.mode_type_six.active').attr('format');
      if(mode_type=='amount'){
        $('#duration').attr('placeholder','Enter Amount').val('');
        $('.mode_div').show();
        $('#duration').removeClass('date_picker_here_five');
        $('#duration').datepicker("destroy");
        $('#duration').addClass("form-control");
        // .attr('data-guid','');


      }else{
        $('#duration').attr('placeholder','Enter Last Date').val('');
        $('.mode_div').hide();
        $('#duration').addClass('date_picker_here_five');
        $('.date_picker_here_five').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });
        
      }
    })

    var format = $('.mode_format_six.active').attr('format');
    $('body').on('click','.mode_format_six',function(e){
      $('.mode_format_six').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    $('body').on('submit','#six_form_submit',function(e){
      e.preventDefault(); // prevent native submit
      var format         = $('.currency_format_six.active').attr('format');
      var reverse_format = $('.mode_type_six.active').attr('format');
      var mode_format = $('.mode_format_six.active').attr('format');      
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'calculate','format':format,'reverse_format':reverse_format,'mode_format':mode_format}

      })
    });

    $('body').on('click','#save_cte_six',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_six.active').attr('format');
       var reverse_format = $('.mode_type_six.active').attr('format');
      var mode_format = $('.mode_format_six.active').attr('format');
        $('#six_form_submit').ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'save','format':format,'reverse_format':reverse_format,'mode_format':mode_format}

      })
    });

    $('body').on('change','.industry_noc_six',function(e){
     if($(this).val()=='yes'){
        if(confirm("Do you want Add NOC?")){

        }else{
          $(this).val('no');
        }
     }  
    })

    $('body').on('click','.cto_type_six',function(e){
            var cto_type = $(".cto_type_six:checked").val();
            if(cto_type=='renew'){
               $.ajax({url: "{{ url('admin/reverse_renew_calculation_add_page') }}", success: function(result){
                     $('#ajax_cte_add_page_here_first').html(result);
                }});
            }else if(cto_type=='regulation'){
               $.ajax({url: "{{ url('admin/reverse_regulation_calculation_add_page') }}", success: function(result){
                     $('#ajax_cte_add_page_here_first').html(result);
                }});
            }else{
                $.ajax({url: "{{ url('admin/reverse_calculation_add_page') }}", success: function(result){
                     $('#ajax_cte_add_page_here_first').html(result);
                }});
            }  
    })

    $('body').on('change','.industry_id_seven',function(e){
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category-cto') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        $('#industry_category_old').val(result.data.category_name);
                        $('#industry_category_id_new').val(result.data.id);
                        $('#industry_category_id_old').val(result.data.id);
                        if(result.report!=null){
                            $('#previous_ca').val(result.report.current_ca);
                            $('#new_ca').val(result.report.current_ca);
                            $('#previous_apply_date').val(result.report.applied_on.split("-").reverse().join("/"));
                            $('#current_applied_date').val(result.report.valid_upto.split("-").reverse().join("/"));
                        }else{
                             $('#previous_ca').val('');
                            $('#new_ca').val('');
                            $('#previous_apply_date').val('');
                            $('#current_applied_date').val('');
                        }
                       
                     }
                }});
    });

    var format = $('.currency_format_seven.active').attr('format');
    $('body').on('click','.currency_format_seven',function(e){
      $('.currency_format_seven').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    var format = $('.mode_type_seven.active').attr('format');
    $('body').on('click','.mode_type_seven',function(e){
     
      $('.mode_type_seven').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
       var mode_type =  $('.mode_type_seven.active').attr('format');
      if(mode_type=='amount'){
        $('#duration').attr('placeholder','Enter Amount').val('');
        $('.mode_div').show();
        other_field_readonly_true();
        $('#duration').removeClass('date_picker_here_five');
        $('#duration').datepicker("destroy");
        $('#duration').addClass("form-control");
      }else{
        $('#duration').attr('placeholder','Enter Last Date').val('');
        $('.mode_div').hide();
        other_field_readonly_false();
        $('#duration').addClass('date_picker_here_five');
        $('.date_picker_here_five').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });
      }
    })
    
    // other_field_readonly_true();

    function other_field_readonly_true(){
        $('#deposited_air_amount').prop('readonly',true).val(0);
        $('#deposited_water_amount').prop('readonly',true).val(0);

        $('#penalty_air_amount').prop('readonly',true).val(0);
        $('#penalty_water_amount').prop('readonly',true).val(0);
    }

   function other_field_readonly_false(){
        $('#deposited_air_amount').prop('readonly',false);
        $('#deposited_water_amount').prop('readonly',false);

        $('#penalty_air_amount').prop('readonly',false);
        $('#penalty_water_amount').prop('readonly',false);
   }

    var format = $('.mode_format_seven.active').attr('format');
    $('body').on('click','.mode_format_seven',function(e){
      $('.mode_format_seven').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    var format = $('.varied_calculation_seven.active').attr('format');
    $('body').on('click','.varied_calculation_seven',function(e){
      $('.varied_calculation_seven').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    $('body').on('submit','#seven_form_submit',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_seven.active').attr('format');
      var varied = $('.varied_calculation_seven.active').attr('format');
      var reverse_format = $('.mode_type_seven.active').attr('format');
      var mode_format = $('.mode_format_seven.active').attr('format');
      $(this).ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'calculate','format':format,'varied':varied,'reverse_format':reverse_format,'mode_format':mode_format}

      })
    });

    $('body').on('click','#enter_penalty_seven',function(e){    
        var previous_apply_date  = $('#previous_apply_date').val().split("/");
        var box_from             = previous_apply_date[2];
        var financial            = previous_apply_date[1]+''+previous_apply_date[0];
        if(financial<=331){
          var box_from             = previous_apply_date[2]-1;
        }
        var current_applied_date = $('#applied_on_view').val().split("/");
        var box_to               = current_applied_date[2];
        var box = '';
        for (var i = box_from; i<= box_to; i++) {
            box+='<div class="col-md-4"><div class="position-relative form-group"><label for="exampleEmail11" class="">CA Certificate '+i+'</label><input id="ca" name="penalty_ca['+i+']" placeholder="Enter CA '+i+'" type="text" class="form-control" required=""></div></div>';
        }
        $('.show_penalty_box').html(box).show();
    })

    $('body').on('click','#save_cte_seven',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_seven.active').attr('format');
      var varied = $('.varied_calculation_seven.active').attr('format');

      var reverse_format = $('.mode_type_seven.active').attr('format');
      var mode_format = $('.mode_format_seven.active').attr('format');


        $('#seven_form_submit').ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'save','format':format,'varied':varied,'reverse_format':reverse_format,'mode_format':mode_format}

      })
    });

    $('body').on('change','.industry_id_eight',function(e){
            var industry_id = $('#industry_id').val();
            $.ajax({url: "{{ url('admin/industry-id-to-category') }}/"+industry_id, success: function(result){
                     if(result.status=='success'){
                        
                        $('#industry_category_id').val(result.data.id);
                       
                     }
                }});
    });

    var format = $('.mode_type_eight.active').attr('format');
    $('body').on('click','.mode_type_eight',function(e){
     
      $('.mode_type_eight').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
       var mode_type =  $('.mode_type_eight.active').attr('format');
      if(mode_type=='amount'){
        $('#duration').attr('placeholder','Enter Amount').val('');
        $('.mode_div').show();
         $('#duration').removeClass('date_picker_here_five');
        $('#duration').datepicker("destroy");
        $('#duration').addClass("form-control");


      }else{
        $('#duration').attr('placeholder','Enter Last Date').val('');
        $('.mode_div').hide();
       $('#duration').addClass('date_picker_here_five');
        $('.date_picker_here_five').datepicker({
            uiLibrary: 'bootstrap',
            format: 'dd/mm/yyyy'
        });
      }
    })

    var format = $('.mode_format_eight.active').attr('format');
    $('body').on('click','.mode_format_eight',function(e){
      $('.mode_format_eight').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    var format = $('.currency_format_eight.active').attr('format');
    $('body').on('click','.currency_format_eight',function(e){
      $('.currency_format_eight').css('background-color','').removeClass('active');
      $(this).css('background-color','#18b3ef').addClass('active');
    })

    $('body').on('click','#add_ca_certificate_eight',function(e){      
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

    $('body').on('submit','#eight_form_submit',function(e){
        e.preventDefault(); // prevent native submit
        var format = $('.currency_format_eight.active').attr('format');
         var reverse_format = $('.mode_type_eight.active').attr('format');
          var mode_format = $('.mode_format_eight.active').attr('format');

          $(this).ajaxSubmit({
              success: function(response) {
                $('#calculation_result_here_first').html(response);
             },
             data: { action: 'calculate','format':format,'reverse_format':reverse_format,'mode_format':mode_format}

          })
    });

    $('body').on('click','#save_cte_eight',function(e){
      e.preventDefault(); // prevent native submit
      var format = $('.currency_format_eight.active').attr('format');
      var reverse_format = $('.mode_type_eight.active').attr('format');
          var mode_format = $('.mode_format_eight.active').attr('format');
        $('#eight_form_submit').ajaxSubmit({
          success: function(response) {
            $('#calculation_result_here_first').html(response);
         },
         data: { action: 'save','format':format,'reverse_format':reverse_format,'mode_format':mode_format}

      })
    });

    $('body').on('submit','#add_industry_ajax',function(e){
        e.preventDefault(); // prevent native submit
          $(this).ajaxSubmit({
              success: function(response) {
                var ids = response.data;
                var industry = response.report;
                var new_industry = '<option selected value="'+ids+'" >'+industry+'</option>';
                $('.industry_select_first').append(new_industry).trigger('change');
                $('.industry_select_second').append(new_industry).trigger('change');
                $('.industry_id_third').append(new_industry).trigger('change');
                $('.industry_id_four').append(new_industry).trigger('change');
                $('.industry_id_five').append(new_industry).trigger('change');
                $('.industry_id_six').append(new_industry).trigger('change');
                $('.industry_id_seven').append(new_industry).trigger('change');
                $('.industry_id_eight').append(new_industry).trigger('change');

                
                // $('.industry_select_').append(new_industry);
                $('.btn-secondary').trigger('click');

                // $('#calculation_result_here_first').html(response);
             },
             // data: { action: 'calculate','format':format,'reverse_format':reverse_format,'mode_format':mode_format}

          })
    });

    $('body').on('keyup','#industry_type',function(e){
        var current_code = $(this).val().substring(0, 1);
        if(current_code=='1'){
            $('#industry_category').val(1);
        }else if(current_code=='2'){
            $('#industry_category').val(3);

        }else if(current_code=='3'){
            $('#industry_category').val(4);

        }else{
            $('#industry_category').val('');
        }
    })

    

    



   


   })
</script>