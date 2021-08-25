<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegulationExport implements FromCollection,WithStyles{
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
        return collect([
            [
                'AA'=>'',
                'Supreme Allied Industry' => $this->response['header']['industry_name'],
            ],
            [
                'name' => 'Industry Type & Duration:'.$this->response['header']['industry_type']." (".$this->response['header']['tenure_from'].' to '.$this->response['header']['tenure_to'].')',
            ],
            [
                'name' => 'Industry Category:'.$this->response['header']['industry_category'],
            ],
            [
                'name' => 'Industry Oprational Date:'.$this->response['header']['current_apply_date'],
            ],
             [
                'name' => 'CTO Renewal Applied On:'.$this->response['header']['view_apply_on'],
            ],
            [
                'name' => 'Duration For Renewal:'. $this->response['header']['duration'],
            ],
             [
                'name' => 'Concent Type:'. $this->response['header']['concent_type'],
            ],
              [
                'name' => 'Penalty (Days):'. $this->response['header']['penalty_days']." (". $this->response['header']['penalty_slab'].")",
            ],
            $this->response['table_head'],
            $this->response['table_rows'],
            [
            	'1'=>'',
            	'2'=>'',
            	'3'=>'',
                '4'=>'',
            	'5'=>'',
            	'Total_Fee'=>'Total Fee',
                'Total_Fee1'=>$this->response['footer']['total_noc_fee'],
                'Total_Fee2'=>isset($this->response['footer']['water_regu_fee'])?$this->response['footer']['water_regu_fee']:'',
                'Total_Fee3'=>isset($this->response['footer']['total_cto_water_fee'])?$this->response['footer']['total_cto_water_fee']:'',
                'Total_Fee4'=>$this->response['footer']['air_regu_fee'],
            	'Total_Fee5'=>$this->response['footer']['total_cto_air_fee'],
            ],
            [
            	'1'=>'',
            	'2'=>'',
            	'3'=>'',
                '4'=>'',
            	'5'=>'',
            	'Deposited'=>'Fee already deposited at the time of last grant of CTO (-)',
                '6'=>'',
                '7'=>'',
                'Deposited1'=>isset($this->response['footer']['deposited_water_amount'])?$this->response['footer']['deposited_water_amount']:'',
                '8'=>'',
            	'Deposited2'=>$this->response['footer']['deposited_air_amount'],

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
