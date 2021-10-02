<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CtoExtensionExport implements FromCollection,WithStyles{
	use Exportable;
	private  $response = [];

	public function __construct($response){
		$this->response = $response;
	}
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $penalty_days = '0';
        if(isset($this->response['header']['penalty_days'])){
            $penalty_days = $this->response['header']['penalty_days']. ' '.$this->response['header']['penalty_slab'];
        }
        return collect([
            [
                'AA'=>'',
                'Supreme Allied Industry' => $this->response['header']['industry_name'],
            ],
            [
                'name' => 'RENEWAL OF CTO',
            ],
            [
                'name' => 'Industry Type & Duration:'.$this->response['header']['industry_type']." (".$this->response['header']['tenure_from'].' to '.$this->response['header']['tenure_to'].')',
            ],
            [
                'name' => 'Industry Category:'.$this->response['header']['industry_category'],
            ],
            [
                'name' => 'Previous CTO Applied On:'.$this->response['header']['current_apply_date'],
            ],
            [
                'name' => 'CTO Duration For Renewal:'. $this->response['header']['duration'],
            ],
             [
                'name' => 'CTO Type:'. ucfirst($this->response['header']['concent_type']),
            ],
            [
                'name' => 'Date Of CTO Renewal Applied:'. $this->response['header']['view_apply_on'],
            ],
              [
                'name' => 'Penalty (Days):'. $penalty_days,
            ],
           
            $this->response['table_head'],
            $this->response['table_rows'],
            [
            	'1'=>'',
            	'2'=>'',
            	'3'=>'',
            	'4'=>'',
            	'Total_Fee'=>'Total Fee',
            	'Total_Fee1'=>$this->response['footer']['total_cto_air_fee'],
            ],
            [
            	'1'=>'',
            	'2'=>'',
            	'3'=>'',
            	'4'=>'',
            	'Deposited'=>'Deposited',
            	'Deposited1'=>$this->response['footer']['deposited_air_amount'],
            ],
            [
            	'1'=>'',
            	'2'=>'',
            	'3'=>'',
            	'4'=>'',
            	'Deposited'=>'Total Payable Amount',
            	'Deposited1'=>$this->response['footer']['payable_amount'],
            ]

        ]);
    }

    public function styles(Worksheet $sheet){
        return [
            // Style the first row as bold text.
            'A1:N1'    => ['font' => ['bold' => true,'size'=>24],['align'=>'center']],

            // Styling a specific cell by coordinate.
            'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'A'  => ['width' => 100],
        ];
    }
}
