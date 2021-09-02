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
    font-size: 32px !important;
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
			<td style="text-align: center;" class="text-default-d3">{{ $header['industry_name'] }}</td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3">RENEWAL OF CTO<</td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Industry Type & Duration:<b>{{ $header['industry_type'] }} ({{ $header['tenure_from'].' to '.$header['tenure_to'] }})</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Industry Category:<b>{{ $header['industry_category'] }}</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Previous CTO Expired On:<b>{{ $header['current_apply_date'] }}</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">CTO Duration For Renewal:<b>{{ $header['duration'] }}</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">CTO Type:<b>{{ $header['concent_type'] }}</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Date Of CTO Renewal Applied:<b>{{ $header['view_apply_on'] }}</b></td>
		</tr>
		@if(isset($header['penalty_days']))
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Penalty (Days):<b>{{ $header['penalty_days'] }} ({{ $header['penalty_slab'] }})</b></td>
		</tr>
        @endif

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
          <td>{{ money_format_change($detail['ca_certificate_amount']) }}</td>
	     @if(isset($footer['ca_diffrence']))
        <td >{{ money_format_change($detail['ca_diffrence']) }}</td>
        @endif
        @if(isset($footer['noc_fee']))
        <td >{{ money_format_change($detail['noc_fee']) }}</td>
        @endif
         @if(isset($footer['water_regu_fee']))
        <td >{{ money_format_change($detail['water_regu_fee']) }}</td>
        @endif
         @if(isset($footer['total_cto_water_fee']))
        <td >{{ money_format_change($detail['cto_water_fee']) }}</td>
        @endif
        @if(isset($footer['air_regu_fee']))
        <td >{{ money_format_change($detail['air_regu_fee']) }}</td>
        @endif    
       
        @if(isset($footer['total_cto_air_fee']))
        <td >{{ money_format_change($detail['cto_air_fee']) }}</td>
        @endif
	</tr> 
	@endforeach
	 <tr >
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td  ></td>
                           
                            <td align="right"><b style="font-size: 18px;">Fee Total</b></td>
                             @if(isset($footer['ca_diffrence']))
                            <td align="right"></td>
                            @endif
                            
                             @if(isset($footer['noc_fee']))
                            <td align="right"><b>{{ money_format_change($footer['total_noc_fee']) }}</b></td>
                            @endif

                            @if(isset($footer['total_cto_water_fee']))
                            <td align="right"><b style="font-size: 18px;">{{ money_format_change($footer['total_cto_water_fee']) }}</b></td>
                            @endif
                            @if(isset($footer['total_cto_air_fee']))
                            <td align="right"><b style="font-size: 18px;">{{ money_format_change($footer['total_cto_air_fee']) }}</b></td>
                            @endif

                            
                        </tr> 
                        <tr >
                            <!-- <td></td> -->
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td  ></td>
                            
                            <td align="right"><b style="font-size: 18px;">Fee already deposited at the time of last grant of CTO (-)</b></td>
                            @if(isset($footer['ca_diffrence']))
                            <td class="text-secondary-d2" style="text-align: center;"></td>
                            @endif
                            
                             @if(isset($footer['noc_fee']))
                            <td align="right" style="text-align: center;"><b>0</b></td>
                            @endif
                           

                            @if(isset($footer['deposited_water_amount']))
                            <td align="right" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['deposited_water_amount']) }}</b></td>
                            @endif
                            @if(isset($footer['deposited_air_amount']))
                             <td align="right" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['deposited_air_amount']) }}</b></td>
                             @endif
                        </tr> 

                        


                        <tr >
                            <td></td>
                            <td></td>
                            <td></td>
                            <td ></td>
                            <td align="right" style="text-align: center;" ><b style="font-size: 18px;">Total</b></td>
                            @if(isset($footer['ca_diffrence']))
                            <td align="right" style="text-align: center;"></td>
                            @endif
                           
                             @if(isset($footer['noc_fee']))
                            <td align="right" style="text-align: center;"><b>{{ money_format_change($footer['total_noc_fee']) }}</b></td>
                            @endif
                           
                            @if(isset($footer['final_cto_water_fee']))
                            <td align="right" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['final_cto_water_fee']) }}</b></td>
                            @endif
                            @if(isset($footer['final_cto_air_fee']))
                            <td align="right" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['final_cto_air_fee']) }}</b></td>
                            @endif
                        </tr> 
                        @if(isset($footer['total_water_penalty']))
                        <tr >
                            <td></td>
                            <td></td>
                            <td></td>
                            <td ></td>
                            <td align="right" style="text-align: center;" ><b style="font-size: 18px;">CTO Penalty</b></td>
                            @if(isset($footer['ca_diffrence']))
                            <td align="right" style="text-align: center;"></td>
                            @endif
                           
                             @if(isset($footer['noc_fee']))
                            <td align="right" style="text-align: center;"><b></b></td>
                            @endif
                           
                           
                            @if(isset($footer['total_water_penalty']))
                            <td align="right" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_water_penalty']) }}</b></td>
                            @endif

                             @if(isset($footer['total_air_penalty']))
                            <td align="right" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['total_air_penalty']) }}</b></td>
                            @endif
                        </tr> 
                        @endif

                       
                         <tr >
                            <td></td>
                            <td></td>
                            <td></td>
                            <td ></td>
                            <td align="right" style="text-align: center;" ><b style="font-size: 18px;">Total Payable Amount</b></td>
                            @if(isset($footer['ca_diffrence']))
                            <td align="right" style="text-align: center;"></td>
                            @endif
                           
                             @if(isset($footer['noc_fee']))
                            <td align="right" style="text-align: center;"></td>
                            @endif
                           
                            <td align="right" style="text-align: center;"><b style="font-size: 18px;">{{ money_format_change($footer['payable_amount']) }}</b></td>
                        </tr> 
	
</tbody>
</table>