<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <link rel="icon" href="favicon.ico">
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{ asset('/template/main.07a59de7b920cd76b874.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style type="text/css">
        .glyphicon-chevron-left:before {
            content: " < ";
            font-size: 20px;
        }
        .glyphicon-chevron-right:before {
            content: " > ";
            font-size: 20px;
        }
        #printarea_first .text_blue{
            color: blue;
            font-size: 18px !important;
        }
        #printarea_first .bgc-default-tp1{
                background-color: rgba(121,169,197,.92)!important;
        }
        #printarea_first .table-striped tr:nth-child(even){
            background-color: #c2c2c2;
        }

        #printarea_first .company_text {
                color: black !important;
                font-size: 32px !important;
        }
        #printarea_first .industry_name {
                color: black !important;
                font-size: 26px !important;
        }

        #printarea_first .text_bold {
                color: black !important;
                font-size: 18px !important;
        }

        #printarea_first .text_bold_600 {
                color: black !important;
                font-size: 20px !important;
                font-weight: 500;
        }

        #printarea_first td {
                color: black !important;
                /*font-size: 20px !important;
                font-weight: 500;*/
        }

        .bg-asteroid {
     background-image: linear-gradient(to right, #1f3963, #1f3963, #1f3963) !important; 
    background-color: #1f3963 !important;
}

       /*#calculation_result_here_first .text-default-d3,#calculation_result_here_first .align-middle,#calculation_result_here_first .text-blue {
            color: black !important;
        }*/
        @media print{
            #printarea_first .text_blue{
                color: black !important;
                font-size: 18px !important;
                font-weight: 500 !important;

            }
            #printarea_first td,#printarea_first th {
                border: 1px solid black !important;
                color: black !important;
                text-align: center !important;
            }

            #printarea_first table {
                width: 100%;
            }

            #printarea_first .border_none td {
                border: none !important;
                text-align: left !important;
            }

            #printarea_first .text_align_left {
                /*border: none !important;*/
                text-align: left !important;
            }

            #printarea_first .text_align_center {
                /*border: none !important;*/
                text-align: center !important;
            }

            body{
                /*transform:scale(.9);*/
                overflow: hidden;
            }

           /* #calculation_result_here_first .table-striped tr:nth-last-child(n+4) td {
                border: 1px solid black !important;
                color: black !important;
                text-align: center;
           }
            #calculation_result_here_first th {
                border: 1px solid black !important;
                color: black !important;
                text-align: center;
           }
            #calculation_result_here_first   table {
                width: 100%;
           }
            #calculation_result_here_first   .text-default-d3,#calculation_result_here_first .align-middle,#calculation_result_here_first .text-blue {
                color: black !important;
           }
            #calculation_result_here_first    .text-default-d3 {
                font-size: 32px !important;
            }
            #calculation_result_here_first   .text-default-d3.company_text {
                font-weight: 600;
           }
           */ #calculation_result_here_first    .print_show{
                display: block;
           }
        }

        .modal-backdrop, .blockOverlay {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
}

.modal-backdrop.show, .show.blockOverlay {
    opacity: -0.5 !important;
    display: none !important; 
}


</style>
</head>
