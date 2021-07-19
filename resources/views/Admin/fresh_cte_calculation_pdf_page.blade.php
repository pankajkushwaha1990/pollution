<style type="text/css">
   .table tr:nth-last-child(n+5) td {
    border: 1px solid black !important;
    color: black !important;
   

   }
   .table tr {
    border: 1px solid black !important;
    color: black !important;
   


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
			<td style="text-align: center;" class="text-default-d3-24">Industry Type & Duration:<b>{{ $header['industry_type'] }} ({{ $header['tenure_from'].' to '.$header['tenure_to'] }})</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Industry Category:<b>{{ $header['industry_category'] }}</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Duration:<b>{{ $header['duration'] }}</b></td>
		</tr>
		<tr>
			<td style="text-align: center;" class="text-default-d3-24">Date Of CTE Applied:<b>{{ $header['applied_date'] }}</b></td>
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
	    <td >{{ $detail['ca_amount'] }}</td>
	    <td >{{ $detail['cte_fees'] }}</td>
	</tr> 
	@endforeach
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"></td>
		<td align="right"></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>Total Fee</b></td>
		<td align="right"><b>{{ $footer['total_cte_fee'] }}</b></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>Deposited</b></td>
		<td align="right"><b>{{ $footer['deposited_amount'] }}</b></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
		<td align="right"><b>Total Payable Amount</b></td>
		<td class="gray" align="right"><b>{{ $footer['final_fee'] }}</b></td>
	</tr>
</tbody>
</table>