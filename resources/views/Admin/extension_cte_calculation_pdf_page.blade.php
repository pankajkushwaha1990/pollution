<table width="100%">
<tbody>
<tr>
<td valign="top"><img alt="" width="150" /></td>
<td style="text-align: center;" align="right">
<p style="text-align: center;">{{ $header['industry_name'] }}</p>
<p style="text-align: center;">Industry Type & Duration:{{ $header['industry_type'] }} ({{ $header['tenure_from'].' to '.$header['tenure_to'] }})</p>
<p style="text-align: center;">Industry Category:{{ $header['industry_category'] }}</p>
<p style="text-align: center;">Duration:{{ $header['duration'] }}</p>
<p style="text-align: center;">Date Of CTE Applied:{{ $header['applied_date'] }}</p>


</td>
</tr>
</tbody>
</table>

<p>&nbsp;</p>
<table width="100%">
<thead style="background-color: lightgray;">
 <tr class="text-white">
    @foreach($table_head as $head)
    <th>{{ $head }}</th>
    @endforeach
</tr>
</thead>
<tbody>
 @foreach($table_rows as $detail)
<tr>
    <td scope="row">{{ $detail['sr_no'] }}</td>
    <td align="right">{{ $detail['from_date'] }}</td>
    <td align="right">{{ $detail['to_date'] }}</td>
    <td align="right">{{ $detail['days'] }}</td>
    <td align="right">{{ $detail['ca_amount'] }}</td>
    <td align="right">{{ $detail['cte_fees'] }}</td>
</tr> 
@endforeach
</tbody>
<tfoot>
<tr>
<td colspan="3">&nbsp;</td>
<td align="right">Total Fee</td>
<td align="right">{{ $footer['total_cte_fee'] }}</td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
<td align="right">Deposited</td>
<td align="right">{{ $footer['deposited_amount'] }}</td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
<td align="right">Total Payable Amount</td>
<td class="gray" align="right">{{ $footer['final_fee'] }}</td>
</tr>
</tfoot>
</table>