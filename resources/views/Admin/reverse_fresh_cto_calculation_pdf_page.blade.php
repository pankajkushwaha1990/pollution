<style type="text/css">
   .table tr:nth-last-child(n+5) td {
    border: 1px solid black !important;
    color: black !important;
    text-align: center !important;
   

   }
   .table tr {
    border: 1px solid black !important;
    color: black !important;
    text-align: center !important;

   


   }
   .table {
    width: 100%;
     border-collapse: collapse !important;
border-spacing: 0px;
   }
   .text-default-d3,.align-middle,.text-blue {
    color: black !important;
   }
   .text-default-d3 {
    font-size: 16px !important;
   }
   .text-default-d3-24 {
    font-size: 18px !important;
   }
   .text-default-d3.company_text {
    font-weight: 600;
   }
   .print_show{
    display: block;
   }
   


</style>
<table width="100%">
	<tbody>
		<tr>
			<td style="text-align: center;"><img style="vertical-align: middle;margin-top: 28px;" src="https://ppcb.punjab.gov.in/sites/default/files/logo_0.png">&nbsp;&nbsp;<span class="text-default-d3 company_text">Punjab Pollution Control Board</span></td>
		</tr>
		<tr>
			<td style="text-align: center;font-size: 25px !important;" >{{ $header['industry_name'] }}</td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3">FRESH CTO</td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Industry Type & Duration:<b>{{ $header['industry_type'] }} ({{ $header['tenure_from'].' to '.$header['tenure_to'] }})</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Industry Category:<b>{{ $header['industry_category'] }}</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">CTO Amount/Duration:<b>{{ $header['duration'] }}</b></td>
		</tr>
				<tr>
			<td style="text-align: center;" class="text-default-d3-24">CTO Type:<b>{{ ucfirst($header['concent_type']) }}</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Date Of CTO Applied:<b>{{ $header['view_apply_on'] }}</b></td>
		</tr>
    </tbody>
</table>
<br>
<table width="100%" class="table" >
<tbody>
	<tr >
	    @foreach($table_head as $head)
	    <td><b>{{ $head }}</b></td>
	    @endforeach
	 </tr>
 	@foreach($table_rows as $detail)
	<tr>
	    <td >{{ $detail['sr_no'] }}</td>
	    <td >{{ $detail['from_date'] }}</td>
	    <td >{{ $detail['to_date'] }}</td>
	    <td >{{ $detail['days'] }}</td>
	    <td >{{ money_format_change($detail['ca_certificate_amount']) }}</td>   
	    @if(isset($footer['total_noc_fee']))
            <td >{{ $detail['noc_fee'] }}</td>
        @endif
        @if(isset($footer['arrear']))
            <td >{{ $detail['arrear'] }}</td>
        @endif
         @if(isset($footer['final_cto_water_fee']))
            <td >{{ $detail['cto_water_fee'] }}</td>
        @endif
         @if(isset($footer['total_cto_air_fee']))
            <td >{{ $detail['cto_air_fee'] }}</td>
        @endif
	</tr> 
	@endforeach
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>Fee Total</b></td>
		@if(isset($footer['total_noc_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['total_noc_fee']) }}</b></td>
        @endif
        @if(isset($footer['arrear']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['total_cto_water_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['total_cto_water_fee']) }}</b></td>
        @endif
        @if(isset($footer['total_cto_air_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['total_cto_air_fee']) }}</b></td>
        @endif
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>{{ $footer['dynamic_label']}}</b></td>
		@if(isset($footer['total_noc_fee']))
        <td style="text-align: center;"></td>
        @endif
        @if(isset($footer['arrear']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['total_cto_water_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['deposited_water_amount']) }}</b></td>
        @endif
        @if(isset($footer['total_cto_air_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['deposited_air_amount']) }}</b></td>
        @endif
	</tr>
	
	@if(isset($footer['total_water_penalty']))
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>CTO Water Penalty</b></td>
		@if(isset($footer['total_noc_fee']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['arrear']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['final_cto_water_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['final_cto_water_fee']) }}</b></td>
        @endif
        @if(isset($footer['total_cto_air_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['total_cto_air_fee']) }}</b></td>
        @endif
	</tr>
	@endif
	@if(isset($footer['penalty_water_amount']))
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>Fee already deposited CTO water penalty (-)</b></td>
		@if(isset($footer['total_noc_fee']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['arrear']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['final_cto_water_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['final_cto_water_fee']) }}</b></td>
        @endif
        @if(isset($footer['total_cto_air_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['total_cto_air_fee']) }}</b></td>
        @endif
	</tr>
	@endif
	@if(isset($footer['total_air_penalty']))
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>CTO Air Penalty</b></td>
		@if(isset($footer['total_noc_fee']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['arrear']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['final_cto_water_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['final_cto_water_fee']) }}</b></td>
        @endif
        @if(isset($footer['total_cto_air_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['total_cto_air_fee']) }}</b></td>
        @endif
	</tr>
	@endif
	@if(isset($footer['penalty_air_amount']))
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>Fee already deposited CTO air penalty (-)</b></td>
		@if(isset($footer['total_noc_fee']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['arrear']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['final_cto_water_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['final_cto_water_fee']) }}</b></td>
        @endif
        @if(isset($footer['total_cto_air_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['total_cto_air_fee']) }}</b></td>
        @endif
	</tr>
	@endif
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>Total Payable Amount</b></td>
		@if(isset($footer['total_noc_fee']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['arrear']))
        <td style="text-align: center;"><b></b></td>
        @endif
        @if(isset($footer['total_cto_water_fee']))
        <td style="text-align: center;"><b>
        	@if(!isset($footer['total_cto_air_fee']))
                {{ money_format_change($footer['payable_amount']) }}
            @endif
        </b></td>
        @endif
        @if(isset($footer['total_cto_air_fee']))
        <td style="text-align: center;"><b>{{ money_format_change($footer['payable_amount']) }}</b></td>
        @endif
	</tr>
</tbody>
</table>