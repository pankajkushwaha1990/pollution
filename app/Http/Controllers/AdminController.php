<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Industry;
use App\Models\Tenure;
use App\Models\Fee;
use App\Models\Category;
use App\Exports\CteExport;
use App\Exports\CteExtensionExport;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Carbon\Carbon;
use PDF;
use Excel;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class AdminController extends Controller{
  public function login(){
   	 return view('Admin.login');
  }


 
  private function regulation_ca_exist_air_old_calculation($request){
   $applied_date          = $this->date_y_m_d($request->oprational_date);
   $current_applied_date  = $this->date_y_m_d($request->apply_date_view);
   $end_date              = $this->date_d_m_y($current_applied_date);
   $tenure_to             = $this->tenure_by_category_id($request->industry_category_id);
   $end_date              = $this->date_y($end_date)."-".$tenure_to;
   $to_date               = $this->tenure_to_date($applied_date,$tenure_to);
   //$request->previous_ca = $this->change_currency($request->previous_ca,$request->format);
   //$fees          = $this->find_fee_category_applied_ca($request->industry_category_id_old,$applied_date,$request->previous_ca);
   //$penalty_days          = $this->number_of_days($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id);
   $penalty_ca_old    = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           = $air_regu_fee =   $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$ca_diff);
      if($i==0){
        $noc_fee      = $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$penalty_ca);
        $air_regu_fee = 0;
      }
      if(strtotime($current_applied_date)<strtotime($to_date)){
             $to_date            = $end_date;
      }else{
        $run++;
      }
      $days              =   $this->number_of_days($from_date,$to_date);
      $fees             = $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$penalty_ca);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'air_regu_fee'=>$air_regu_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);       
    }      
   }
   return $table_rows;
  }

  private function regulation_ca_exist_water_old_calculation($request){
   $applied_date          = $this->date_y_m_d($request->oprational_date);
   $current_applied_date  = $this->date_y_m_d($request->apply_date_view);
   $end_date              = $this->date_d_m_y($current_applied_date);
   $tenure_to             = $this->tenure_by_category_id($request->industry_category_id);
   $end_date              = $this->date_y($end_date)."-".$tenure_to;
   $to_date               = $this->tenure_to_date($applied_date,$tenure_to);
   //$request->previous_ca = $this->change_currency($request->previous_ca,$request->format);
   //$fees          = $this->find_fee_category_applied_ca($request->industry_category_id_old,$applied_date,$request->previous_ca);
   //$penalty_days          = $this->number_of_days($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id);
   $penalty_ca_old    = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           = $air_regu_fee =   $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$ca_diff);
      if($i==0){
        $noc_fee      = $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$penalty_ca);
        $air_regu_fee = 0;
      }
      if(strtotime($current_applied_date)<strtotime($to_date)){
             $to_date            = $end_date;
      }else{
        $run++;
      }
      $days              =   $this->number_of_days($from_date,$to_date);
      $fees             = $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$penalty_ca);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$air_regu_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);       
    }      
   }
   return $table_rows;
  }

public function regulation_fee_with_air($request){
    $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $air_regu_fee      = 0;
   
        $penalty_old_data = $this->regulation_ca_exist_air_old_calculation($request);
        if(!empty($penalty_old_data)){
         foreach ($penalty_old_data as $key => $old_data) {
            $table_rows[]      =   [
                                        'sr_no'=>$old_data['sr_no'],
                                        'from_date'=>$old_data['from_date'],
                                        'to_date'=>$old_data['to_date'],
                                        'days'=>$old_data['days'],
                                        'ca_certificate_amount'=>$old_data['ca_certificate_amount'],
                                        'ca_diffrence'=>$old_data['ca_diffrence'],
                                        'noc_fee'=>$old_data['noc_fee'],
                                        'air_regu_fee'=>$old_data['air_regu_fee'],
                                        'cto_air_fee'=>$old_data['cto_air_fee'],
                                 ];
            $total_cto_air_fee   += $old_data['cto_air_fee'];
            $total_noc_fee       += $old_data['noc_fee'];
            $air_regu_fee        += $old_data['air_regu_fee'];
            $last_apply_date     =  $old_data['to_date'];      
         }
        }

        $applied_date          = $this->add_1_day_y_m_d($last_apply_date);
        $current_applied_date  = $this->date_y_m_d($last_apply_date);
        $end_date              = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
        $tenure_to             = $this->tenure_by_category_id($request->industry_category_id);
        $end_date              = $this->date_y($end_date)."-".$tenure_to;
        $to_date               = $this->tenure_to_date($applied_date,$tenure_to);
        $last_ca               = $this->change_currency($request->penalty_ca[2021],$request->format);
       $fees        = $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$last_ca);
        $penalty_days          = $this->number_of_days($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
       $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
        echo $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
        $total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
        //$total_air_penalty        = 0;
        // $penalty_days = 0;
         // $penalty_slab = 0;
        $category      = Category::find($request->industry_category_id);
        $run               = 1;
   
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $days              =   $this->number_of_days($from_date,$to_date);
      $fees              =   $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$penalty_ca);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>count($penalty_old_data)+$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $air_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_air_fee+$total_air_penalty+$total_noc_fee+$air_regu_fee-$request->penalty_air_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->oprational_date,
              'current_apply_date'=>$request->oprational_date,'view_apply_on'=>$request->apply_date_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->oprational_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_air_penalty'=>$total_air_penalty
            ];
        
        $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,
            'total_cto_air_fee'=>$total_cto_air_fee,'ca_diffrence'=>'exist','noc_fee'=>'exist','air_regu_fee'=>$air_regu_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_days'=>'exist','total_air_penalty'=>$total_air_penalty,'penalty_air_amount'=>$request->penalty_air_amount
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Air FEE(Regu)','CTO Air Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
}

public function regulation_fee_with_water($request){
    $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $air_regu_fee      = 0;
   $water_regu_fee     = 0;
   
        $penalty_old_data = $this->regulation_ca_exist_water_old_calculation($request);
        if(!empty($penalty_old_data)){
         foreach ($penalty_old_data as $key => $old_data) {
            $table_rows[]      =   [
                                        'sr_no'=>$old_data['sr_no'],
                                        'from_date'=>$old_data['from_date'],
                                        'to_date'=>$old_data['to_date'],
                                        'days'=>$old_data['days'],
                                        'ca_certificate_amount'=>$old_data['ca_certificate_amount'],
                                        'ca_diffrence'=>$old_data['ca_diffrence'],
                                        'noc_fee'=>$old_data['noc_fee'],
                                        'water_regu_fee'=>$old_data['water_regu_fee'],
                                        'cto_water_fee'=>$old_data['cto_water_fee'],
                                 ];
            $total_cto_water_fee   += $old_data['cto_water_fee'];
            $total_noc_fee       += $old_data['noc_fee'];
            $water_regu_fee        += $old_data['water_regu_fee'];
            $last_apply_date =     $old_data['to_date'];   
         }
        }

        $applied_date          = $this->add_1_day_y_m_d($last_apply_date);
        $current_applied_date  = $this->date_y_m_d($last_apply_date);
        $end_date              = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
        $tenure_to             = $this->tenure_by_category_id($request->industry_category_id);
        $end_date              = $this->date_y($end_date)."-".$tenure_to;
        $to_date               = $this->tenure_to_date($applied_date,$tenure_to);
        $last_ca               = $this->change_currency($request->penalty_ca[2021],$request->format);
       $fees        = $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$last_ca);
        $penalty_days          = $this->number_of_days($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
       $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
        $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
        $total_water_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
        //$total_air_penalty        = 0;
        // $penalty_days = 0;
         // $penalty_slab = 0;
        $category      = Category::find($request->industry_category_id);
        $run               = 1;
   
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $days              =   $this->number_of_days($from_date,$to_date);
      $fees              =   $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$penalty_ca);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>count($penalty_old_data)+$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $water_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_water_fee   = $total_cto_water_fee-$request->deposited_water_amount;
   $payable_amount      = $final_cto_water_fee+$total_water_penalty+$total_noc_fee+$water_regu_fee-$request->penalty_water_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_water_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->oprational_date,
              'current_apply_date'=>$request->oprational_date,'view_apply_on'=>$request->apply_date_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->oprational_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_water_penalty'=>$total_water_penalty
            ];
        
        $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'total_cto_water_fee'=>$total_cto_water_fee,'ca_diffrence'=>'exist','noc_fee'=>'exist','water_regu_fee'=>$water_regu_fee,
            'final_cto_water_fee'=>$final_cto_water_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_days'=>'exist','total_water_penalty'=>$total_water_penalty,'penalty_water_amount'=>$request->penalty_water_amount
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
}

  private function regulation_ca_exist_both_old_calculation($request){
   $applied_date          = $this->date_y_m_d($request->oprational_date);
   $current_applied_date  = $this->date_y_m_d($request->apply_date_view);
   $end_date              = $this->date_d_m_y($current_applied_date);
   $tenure_to             = $this->tenure_by_category_id($request->industry_category_id);
   $end_date              = $this->date_y($end_date)."-".$tenure_to;
   $to_date               = $this->tenure_to_date($applied_date,$tenure_to);
   //$request->previous_ca = $this->change_currency($request->previous_ca,$request->format);
   //$fees          = $this->find_fee_category_applied_ca($request->industry_category_id_old,$applied_date,$request->previous_ca);
   //$penalty_days          = $this->number_of_days($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
   //$total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id);
   $penalty_ca_old    = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
     $noc_fee           = $air_regu_fee =   $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$ca_diff);
      if($i==0){
        $noc_fee      = $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$penalty_ca);
        $air_regu_fee = 0;
      }
      if(strtotime($current_applied_date)<strtotime($to_date)){
             $to_date            = $end_date;
      }else{
        $run++;
      }
      $days              =   $this->number_of_days($from_date,$to_date);
      $fees             = $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$penalty_ca);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$air_regu_fee,
                                    'air_regu_fee'=>$air_regu_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);       
    }      
   }
   return $table_rows;
  }

public function regulation_fee_with_both($request){
    $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $air_regu_fee      = 0;
   $water_regu_fee     = 0;
   
        $penalty_old_data = $this->regulation_ca_exist_both_old_calculation($request);
        if(!empty($penalty_old_data)){
         foreach ($penalty_old_data as $key => $old_data) {
            $table_rows[]      =   [
                                        'sr_no'=>$old_data['sr_no'],
                                        'from_date'=>$old_data['from_date'],
                                        'to_date'=>$old_data['to_date'],
                                        'days'=>$old_data['days'],
                                        'ca_certificate_amount'=>$old_data['ca_certificate_amount'],
                                        'ca_diffrence'=>$old_data['ca_diffrence'],
                                        'noc_fee'=>$old_data['noc_fee'],
                                        'water_regu_fee'=>$old_data['water_regu_fee'],
                                        'air_regu_fee'=>$old_data['air_regu_fee'],
                                        'cto_water_fee'=>$old_data['cto_water_fee'],
                                        'cto_air_fee'=>$old_data['cto_air_fee'],
                                 ];
            $total_cto_water_fee   += $old_data['cto_water_fee'];
            $total_cto_air_fee   += $old_data['cto_air_fee'];
            $total_noc_fee       += $old_data['noc_fee'];
            $water_regu_fee        += $old_data['water_regu_fee'];       
            $air_regu_fee        += $old_data['air_regu_fee'];
            $last_apply_date = $old_data['to_date'];       
         }
        }

        $applied_date          = $this->add_1_day_y_m_d($last_apply_date);
        $current_applied_date  = $this->date_y_m_d($last_apply_date);
        $end_date              = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
        $tenure_to             = $this->tenure_by_category_id($request->industry_category_id);
        $end_date              = $this->date_y($end_date)."-".$tenure_to;
        $to_date               = $this->tenure_to_date($applied_date,$tenure_to);
        $last_ca               = $this->change_currency($request->penalty_ca[2021],$request->format);
       $fees        = $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$last_ca);
        $penalty_days          = $this->number_of_days($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
       $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
        $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->oprational_date),$this->date_y_m_d($request->apply_date_view));
        $total_water_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
        $total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
        //$total_air_penalty        = 0;
        // $penalty_days = 0;
         // $penalty_slab = 0;
        $category      = Category::find($request->industry_category_id);
        $run               = 1;
   
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $days              =   $this->number_of_days($from_date,$to_date);
      $fees              =   $this->find_fee_category_applied_ca($request->industry_category_id,$applied_date,$penalty_ca);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>count($penalty_old_data)+$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee   += $this->fee_by_days($fees,$days);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $water_regu_fee       += $noc_fee;
      $air_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_water_fee   = $total_cto_water_fee-$request->deposited_water_amount;
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_water_fee+$total_water_penalty+$final_cto_air_fee+$total_air_penalty+$total_noc_fee+$water_regu_fee-$request->penalty_water_amount+$air_regu_fee-$request->penalty_air_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_water_fee'=>$request->deposited_water_amount,'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->oprational_date,
              'current_apply_date'=>$request->oprational_date,'view_apply_on'=>$request->apply_date_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->oprational_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_water_penalty'=>$total_water_penalty,'total_air_penalty'=>$total_air_penalty
            ];
        
        $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,
            'deposited_air_amount'=>$request->deposited_air_amount,
            'final_fee'=>0,
            'total_cto_water_fee'=>$total_cto_water_fee,
            'total_cto_air_fee'=>$total_cto_air_fee,
            'ca_diffrence'=>'exist','noc_fee'=>'exist',
            'water_regu_fee'=>$water_regu_fee,
            'air_regu_fee'=>$air_regu_fee,
            'final_cto_water_fee'=>$final_cto_water_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,
            'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_days'=>'exist',
            'total_water_penalty'=>$total_water_penalty,
            'total_air_penalty'=>$total_air_penalty,
            'penalty_water_amount'=>$request->penalty_water_amount,
            'penalty_air_amount'=>$request->penalty_air_amount
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee','CTO-Air FEE(Regu)','CTO Air Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
}

      private function ca_y($from_date=null){
          $year = (int) $this->date_y($this->date_d_m_y($from_date));
          return $year;
   }

   public function regulation_fee_calculate(Request $request){
      $industry_id              = $request->industry_id;
      $industry_category_id     = $request->industry_category_id;
      $oprational_date          = $request->oprational_date;
      $duration                 = $request->duration;
      $apply_date_view          = $request->apply_date_view;
      $action                   = $request->action;
      $penalty_ca               = $request->penalty_ca;
      $format                   = $request->format;
      $concent_type             = $request->concent_type;
      if(empty($industry_id)){
         $response = ['status'=>'failure','message'=>'Please select industry'];
      }elseif(empty($industry_category_id)){
         $response = ['status'=>'failure','message'=>'Please select industry category'];
      }elseif(empty($oprational_date)){
         $response = ['status'=>'failure','message'=>'Please select oprational date'];
      }elseif(empty($apply_date_view)){
         $response = ['status'=>'failure','message'=>'Please apply date'];
      }elseif(empty($action)){
         $response = ['status'=>'failure','message'=>'action not found'];
      }elseif(empty($penalty_ca)){
         $response = ['status'=>'failure','message'=>'please enter CA Certificate Amount'];
      }elseif(empty($concent_type)){
         $response = ['status'=>'failure','message'=>'please select concent type'];
      }else{
         if($concent_type=='air'){
             echo "a";
             $response = $this->regulation_fee_with_air($request);
         }elseif($concent_type=='water'){
             echo "b";
             $response = $this->regulation_fee_with_water($request);
         }elseif($concent_type=='both'){
             echo "c";
             $response = $this->regulation_fee_with_both($request);
         }
      }

      if($response['status']=='failure'){
        return "<span class='text text-danger'>".$response['message']."</span>";
      }else{
        if(isset($response['calculation'])){
          return view('Admin.regulation_fee_boxes',$response);
        }else{
           return view('Admin.regulation_fee_boxes',$response);
        }
      } 
   }


  public function regulation_add(){
        $industry_list = Industry::all();
        $industry_category = Category::all();
        return view('Admin.regulation_add_page',['industry_list'=>$industry_list,'industry_category'=>$industry_category]);
   }

   public function regulation_fee_boxes($request){
          $box_slot = [];
          $year_start = $this->date_y($request->oprational_date);
          $year_end   = $this->date_y($request->apply_date_view);
          for ($i=$year_start; $i <=$year_end; $i++) { 
             $box_slot[] = $i;
          }
          return $response = ['status'=>'success','message'=>'category fetched successfully','calculation'=>[],'box_slot'=>$box_slot,'box_slot_filled'=>[]];
   }

  public function login_submit(Request $request){
	    $validator = Validator::make(request()->all(), [
	         'email'    => 'required|email|exists:admins,email',
	         'password' => 'string|min:3'
	    ]);
	    if ($validator->fails()){
	    	return back()->withErrors($validator);
	    }else{
	    	$credentials  = ['email'=>$request->email,'password'=>$request->password];
	    	$admin        = Admin::where($credentials)->first();
	    	if($admin){
	    		$session = ['admin_id'=>$admin->id,'email'=>$admin->email,'role'=>$admin->role,'first_name'=>$admin->first_name];
	    		$request->session()->put($session);
	    		return redirect('/admin/dashboard');
	    	}else{
	    		return back()->with(['error_message'=>'Please enter valid email and password']);
	    	}
	    }
  }

  public function dashboard(){
   	 return view('Admin.dashboard');
  }

  public function change_password(){
        return view('Admin.change_password');
  }

  public function confirm_password_submit(Request $request){
         $validator = Validator::make(request()->all(), [
           'current_password'    => 'required',
           'new_password' => 'required',
           'password_confirmation' => 'required',
            ]);
            if ($validator->fails()){
              return back()->withErrors($validator);
            }else{
              $credentials  = ['email'=>$request->session()->get('email'),'password'=>$request->current_password];
              $admin        = Admin::where($credentials)->first();
              if($admin){
                $update = ['password'=>$request->new_password];
                Admin::where('id',$request->session()->get('admin_id'))->update($update);
                return redirect('/')->with(['error_message'=>'Password Changed successfully']);;
              }else{
                return back()->with(['error_message'=>'Please enter valid current password']);
              }
          }
  }

  public function industries_list(){
        $roles = DB::table('industries')
                  ->join('categories', 'industries.industry_category', '=', 'categories.id')
                  ->select('categories.*','industries.*','industries.id as id')
                  ->get();
        return view('Admin.industries_list',['roles'=>$roles]);
  }

  public function industry_add(){
        $industry_category = Category::all();
        return view('Admin.industry_add',['industry_category'=>$industry_category]);
  }

  public function tenure_list(){
        $roles = Tenure::all();
        return view('Admin.tenure_list',['roles'=>$roles]);
  }

  public function industry_add_submit(Request $request){
        $validator = Validator::make(request()->all(), [
             'industry_name'         => 'required',
             'industry_category'     => 'required',
             'industry_email'        => 'required',
             'industry_mobile'       => 'required',
             'industry_type'         => 'required',
             'industry_scale'        => 'required',
             'industry_latitude'     => 'required',
             'industry_longitude'    => 'required',
             'industry_address'      => 'required',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $roles  = [
              'industry_name'=>$request->industry_name,'industry_category'=>$request->industry_category,
              'email'=>$request->industry_email,'mobile'=>$request->industry_mobile,
              'industry_type'=>$request->industry_type,'industry_scale'=>$request->industry_scale,
              'latitude'=>$request->industry_latitude,'longitude'=>$request->industry_longitude,
              'address'=>$request->industry_address,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),
            ];
            DB::table('industries')->insert($roles);
            return redirect('/admin/industries-list')->with(['error_message'=>'Industry created successfully']);
        }
  }

  public function industry_edit($user_id){
      $user = Industry::find($user_id);
      $industry_category = Category::all();
      return view('Admin.industry_edit',['user'=>$user,'industry_category'=>$industry_category]);
  }

  public function industry_edit_submit(Request $request){
        $validator = Validator::make(request()->all(), [
             'industry_name'         => 'required',
             'industry_category'     => 'required',
             'industry_email'        => 'required',
             'industry_mobile'       => 'required',
             'industry_type'         => 'required',
             'industry_scale'        => 'required',
             'industry_latitude'     => 'required',
             'industry_longitude'    => 'required',
             'industry_address'      => 'required',
             'industry_id'      => 'required',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $roles  = [
              'industry_name'=>$request->industry_name,'industry_category'=>$request->industry_category,
              'email'=>$request->industry_email,'mobile'=>$request->industry_mobile,
              'industry_type'=>$request->industry_type,'industry_scale'=>$request->industry_scale,
              'latitude'=>$request->industry_latitude,'longitude'=>$request->industry_longitude,
              'address'=>$request->industry_address,'status'=>1,'created_at'=>date('Y-m-d H:i:s'),
            ];
            DB::table('industries')->where('id',$request->industry_id)->update($roles);
            return redirect('/admin/industries-list')->with(['error_message'=>'Industry updated successfully']);
        }
  }

  public function tenure_fee_details($tenure_id){
      $tenure = Tenure::find($tenure_id);
      $fees = Fee::where('tenure_id',$tenure_id)->get();
      return view('Admin.tenure_fee_details',['tenure'=>$tenure,'fees'=>$fees]);
  }

  public function tenure_fee_details_submit(Request $request){
        $validator = Validator::make(request()->all(), [
             'tenure_id'          => 'required',
             'start_amount'         => 'required|array|min:1',
             'end_amount'         => 'required|array|min:1',
             'red_amount'         => 'required|array|min:1',
             'orange_amount'         => 'required|array|min:1',
             'green_amount'         => 'required|array|min:1',
            
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            foreach ($request->start_amount as $key => $start) {
                if($start!=null && $request->start_amount[$key]!=null){
                  $insert[]  = [
                  'tenure_id'=>$request->tenure_id,'start_amount'=>$request->start_amount[$key],'end_amount'=>$request->end_amount[$key],
                  'red_amount'=>$request->red_amount[$key],'orange_amount'=>$request->orange_amount[$key],'green_amount'=>$request->green_amount[$key],
                ];
              }
            }
            DB::table('fees')->where('tenure_id',$request->tenure_id)->delete();
            DB::table('fees')->insert($insert);
            return redirect('/admin/tenure-list')->with(['error_message'=>'Fees created/updated successfully']);
        }
  }

  public function fresh_cte_add(){
        $industry_list = Industry::all();
        $industry_category = Category::all();
        return view('Admin.fresh_cte_add',['industry_list'=>$industry_list,'industry_category'=>$industry_category]);
  }

  public function industry_id_to_category($industry_id){
       if(empty($industry_id)){
          $response = ['status'=>'failure','message'=>'please select industry'];
       }else{
          $industry_result = Industry::find($industry_id);
          $result          = Category::find($industry_result->industry_category);
          $fresh_report     = DB::table('reports')->where('industry_id',$industry_id)->orderBy('id', 'desc')->first();
          $extension_report     = DB::table('reports_extension')->where('industry_id',$industry_id)->orderBy('id', 'desc')->first();
          if(empty($extension_report)){
            $last_report = $fresh_report;
          }else{
            $last_report = $extension_report;
          }

          $response = ['status'=>'success','message'=>'category fetched successfully','data'=>$result,'report'=>$last_report];
       }       
      
       return response()->json($response);
  }

  public function industry_id_to_category_cto($industry_id){
       if(empty($industry_id)){
          $response = ['status'=>'failure','message'=>'please select industry'];
       }else{
          $industry_result = Industry::find($industry_id);
          $result          = Category::find($industry_result->industry_category);
          $last_report     = DB::table('report_cto')->where('industry_id',$industry_id)->orderBy('id', 'desc')->first();
          $response = ['status'=>'success','message'=>'category fetched successfully','data'=>$result,'report'=>$last_report];
       }       
      
       return response()->json($response);
  }

  public function fresh_cte_add_page(){
      $industry_list     = Industry::all();
      $industry_category = Category::all();
      return view('Admin.fresh_cte_add_page',['industry_list'=>$industry_list,'industry_category'=>$industry_category]);
  }

  private function date_y_m_d($date_d_m_y=null){ //d/m/y
         $date_array = explode('/',$date_d_m_y);
         return $date_array[2]."-".$date_array[1]."-".$date_array[0]; //Y-m-d
  }

  private function date_d_m_y($date_y_m_d=null){

        return date('d/m/Y',strtotime($date_y_m_d));
  }

  private function date_y($date_d_m_y=null){
         $date_array = explode('/',$date_d_m_y);
         return (int) $date_array[2];
  }

  private function date_m($date_d_m_y=null){
         $date_array = explode('/',$date_d_m_y);
         return $date_array[1];
  }

  private function date_d($date_d_m_y=null){
         $date_array = explode('/',$date_d_m_y);
         return $date_array[0];
  }

  private function add_1_day_d_m_y($date_y_m_d=null){
      $date =  date('d/m/Y', strtotime($this->date_y_m_d($date_y_m_d). ' + 1 days'));
      return $date;
  }

  private function add_1_day_y_m_d($date_y_m_d=null){
      $date =  date('Y-m-d', strtotime($this->date_y_m_d($date_y_m_d). ' + 1 days'));
      return $date;
  }

  private function add_365_day_y_m_d($date_y_m_d=null){
     $end_array   =  explode('-',$date_y_m_d);
     $year        =  $end_array[0]+1;
     $month       = $end_array[1];
     $day         = $end_array[2]-1;
     $to_date     = $year."-".$month."-".$day;


      // $date =  date('Y-m-d', strtotime($date_y_m_d. ' + 364 days'));
      // if(date('L', strtotime($date))){
      //   $date =  date('Y-m-d', strtotime($date. ' + 1 days'));
      // }
      // if(date('L', strtotime($date)) && $this->number_of_days($date_y_m_d,$date)==365){
      //    $date =  date('Y-m-d', strtotime($date. ' - 1 days'));
      // }
      // echo $this->number_of_days($date_y_m_d,$date);
      return $to_date;
  }

  private function number_of_days($from_date=null,$to_date=null){
      $days = floor((strtotime($to_date) - strtotime($from_date)) / 86400);
      if($days==364){
         $days = 365;
      }
      return $days;
  }

  private function industry_name_by_id($industry_id=null){

            return Industry::where('id',$industry_id)->select('industry_name')->first()->industry_name;
  }

  private function date_d_monthname($date_y_m_d=null){

      return date('d/F',strtotime($date_y_m_d));
  }

  private function change_currency($amount,$format){
    if(!intval($amount)){
        if($format=='lac'){
        return (float) ($amount*100000);
        }elseif($format=='cr'){
          return (float) ($amount*10000000);
        }elseif($format=='num'){
          return  (float) ($amount*1);
        }
    }else{
        if($format=='lac'){
        return (int) ($amount*100000);
        }elseif($format=='cr'){
          return (int) ($amount*10000000);
        }elseif($format=='num'){
          return  (int) ($amount*1);
        }
    }
    
  }

  public function fresh_cte_fee_calculate(Request $request){
      $industry_id                = $request->industry_id;
      $industry_category_name     = $request->industry_category_name;
      $industry_category_id       = $request->industry_category_id;
      $current_ca                 = $this->change_currency($request->current_ca,$request->format);
      $origional_ca               = $request->current_ca;
      $applied_date               = $request->applied_date;
      $deposited_amount           = $request->deposited_amount;
      $deposited_date             = $request->deposited_date;
      $duration                   = $request->duration;
      $action                     = $request->action;
      $format                     = $request->format;
      $table_head                 = [];
      $table_rows                 = [];
      $header                     = [];
      $footer                     = [];
      $total_cte_fee             = 0;
      if(empty($industry_id)){
         $response = ['status'=>'failure','message'=>'Please select industry'];
      }elseif(empty($industry_category_name)){
         $response = ['status'=>'failure','message'=>'industry category not found'];
      }elseif(empty($current_ca)){
         $response = ['status'=>'failure','message'=>'Please enter current CA amount'];
      }elseif(empty($applied_date)){
         $response = ['status'=>'failure','message'=>'Please select applied date'];
      }elseif(empty($duration)){
         $response = ['status'=>'failure','message'=>'Please enter duration'];
      }elseif(empty($action)){
         $response = ['status'=>'failure','message'=>'action not found'];
      }else{
         $previous_fresh_data  =  DB::table('reports')->where(['industry_id'=>$industry_id,'fee_type'=>'fresh'])->first();
         if(!empty($previous_fresh_data)){
           $response = ['status'=>'failure','message'=>'Fresh cte already created'];
         }else{
            $applied_date_ymd   = $this->date_y_m_d($applied_date); //Y-m-d
            $category           = Category::find($industry_category_id);
            if(empty($category)){
              $response = ['status'=>'failure','message'=>'category not found'];
            }else{
               $tenure             = Tenure::where('to','>=',$applied_date_ymd)->orderBy('from','asc')->first();
               if(empty($tenure)){
                $response = ['status'=>'failure','message'=>'tenure not found'];
               }else{
                  $fees               = DB::table('fees')->where('tenure_id',$tenure->id)
                                  ->where('start_amount','<',(int) $current_ca)->orderBy('start_amount','desc')->first();
                  if(empty($fees)){
                    $response = ['status'=>'failure','message'=>'fees not found'];
                  }else{
                    $column_name        = $category->fee_column; 
                    // dd($fees);
                      for($i=0;$i<$duration;$i++){
                        $from_date       = $this->date_y($applied_date)+$i."-".$this->date_m($applied_date)."-".$this->date_d($applied_date);
                        $to_date         = $this->add_365_day_y_m_d($from_date);
                        $days            = $this->number_of_days($from_date,$to_date);
                        $cte_fee         = ($i==0)?$fees->$column_name:$fees->$column_name/2;
                        $total_cte_fee   = $total_cte_fee+$cte_fee;

                        $table_rows[]    = [
                                            'sr_no'=>$i+1,'from_date'=>$this->date_d_m_y($from_date),'to_date'=>$this->date_d_m_y($to_date),
                                            'days'=>$days,'ca_amount'=>$current_ca,'cte_fees'=>$cte_fee
                                           ];
                      }
                      $final_fee = $total_cte_fee-$deposited_amount;
                      $header = [
                        'industry_id'=>$industry_id,'industry_category_id'=>$industry_category_id,'industry_name'=>$this->industry_name_by_id($industry_id),
                        'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),'origional_ca'=>$origional_ca,
                        'format'=>$format,
                        'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'fresh','valid_upto'=>$to_date,'deposited_fee'=>$deposited_amount,
                        'deposited_date'=>$deposited_date,'duration'=>$duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),'applied_date'=>$applied_date,
                        'total_cte_fee'=>$total_cte_fee,'ca_amount'=>$current_ca,'final_fee'=>$final_fee
                      ];
                      $table_head = ['#','From Date','To Date','Days','CA Amount','CTE Amout'];
                      $footer    = ['deposited_date'=>$deposited_date,'deposited_amount'=>$deposited_amount,'total_cte_fee'=>$total_cte_fee,'final_fee'=>$final_fee];
                      $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
                  }
               }
            }          
         }
      }
      if($response['status']=='success' && $action=='calculate'){
        return view('Admin.fresh_cte_calculation_page',$response);
      }if($response['status']=='success' && $action=='save'){
        $this->save_fresh_cte_data($response);
      }else{
        return "<span class='text text-danger'>".$response['message']."</span>";
      }
  }

  private function save_fresh_cte_data($response){
      $report = $response['header'];
      $insert = [
        'industry_id'=>$report['industry_id'],'industry_category_id'=>$report['industry_category_id'],'industry_type'=>$report['industry_type'],
        'fee_type'=>'fresh','duration'=>$report['duration'],'applied_on'=>$this->date_y_m_d($report['applied_date']),'valid_upto'=>$report['valid_upto'],'header'=>json_encode($response['header']),'origional_ca'=>$report['origional_ca'],'format'=>$report['format'],
        'deposited_fee'=>$report['deposited_fee'],'deposited_date'=>$this->date_y_m_d($report['deposited_date']),'total_cte_fee'=>$report['total_cte_fee'],
        'current_ca'=>$report['ca_amount'],'industry_name'=>$report['industry_name'],'tenure_from'=>$report['tenure_from'],'tenure_to'=>$report['tenure_to'],
        'final_fee'=>$report['final_fee'],
        'table_head'=>json_encode($response['table_head']),'table_rows'=>json_encode($response['table_rows']),'footer'=>json_encode($response['footer'])
      ];
      DB::table('reports')->insert($insert);
      echo  "<span class='text text-success'>Data Saved successfully</span>";
  }

  private function save_extension_cte_data($response){
      $report = $response['header'];
      $insert = [
        'industry_id'=>$report['industry_id'],'industry_category_id'=>$report['industry_category_id'],'industry_type'=>$report['industry_type'],
        'fee_type'=>'extension','duration'=>$report['duration'],'applied_on'=>$report['applied_date'],'valid_upto'=>$report['valid_upto'],
        'header'=>json_encode($response['header']),'deposited_fee'=>$report['deposited_fee'],'deposited_date'=>$this->date_y_m_d($report['deposited_date']),
        'total_cte_fee'=>$report['total_cte_fee'],'current_ca'=>$report['ca_amount'],'industry_name'=>$report['industry_name'],
        'tenure_from'=>$report['tenure_from'],'tenure_to'=>$report['tenure_to'],'final_fee'=>$report['final_fee'],'valid_upto'=>$report['valid_upto'],
        'table_head'=>json_encode($response['table_head']),'table_rows'=>json_encode($response['table_rows']),'footer'=>json_encode($response['footer']),
        'previous_category_name'=>$report['previous_category_name'],'previous_category_id'=>$report['previous_category_id'],
        'new_category_id'=>$report['new_category_id'],'previous_ca'=>$report['previous_ca'],'new_ca'=>$report['new_ca'],
        'previous_apply_date'=>$report['previous_apply_date'],'current_apply_date'=>$report['current_apply_date'],'view_apply_on'=>$report['view_apply_on'],
        'industry_category'=>$report['industry_category'],'applied_date'=>$report['applied_date']
      ];
      DB::table('reports_extension')->insert($insert);
      echo  "<span class='text text-success'>Data Saved successfully</span>";
  }

  public function fresh_cte_pdf($fresh_cte_id,$pdf=null){
          $response = DB::table('reports')->where('id',$fresh_cte_id)->first();
          $response  = [
            'header'=>json_decode($response->header,true),'table_head'=>json_decode($response->table_head,true),
           'table_rows'=>json_decode($response->table_rows,true),'footer'=>json_decode($response->footer,true),'id'=>$fresh_cte_id
         ];
         if($pdf){
           set_time_limit(300);
           view()->share($response);
           $pdf = PDF::loadView('Admin.fresh_cte_calculation_pdf_page', $response);
           $pdf->getDomPDF()->setHttpContext(
                stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );
           return $pdf->download($response['header']['industry_name'].'_Fresh_CTE.pdf');
         }      
         return view('Admin.fresh_cte_calculation_pdf_page_view',$response);
  }

  public function renew_cto_pdf($fresh_cte_id,$pdf=null){
          $response = DB::table('report_cto')->where('id',$fresh_cte_id)->first();
          $response  = [
            'header'=>json_decode($response->header,true),'table_head'=>json_decode($response->table_head,true),
           'table_rows'=>json_decode($response->table_rows,true),'footer'=>json_decode($response->footer,true),'id'=>$fresh_cte_id
         ];
         if($pdf){
           set_time_limit(300);
           view()->share($response);
           $pdf = PDF::loadView('Admin.renew_cto_calculation_pdf_page', $response);
           $pdf->getDomPDF()->setHttpContext(
                stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );
           return $pdf->download($response['header']['industry_name'].'_Fresh_CTE.pdf');
         }      
         return view('Admin.renew_cto_calculation_pdf_page_view',$response);
  }

  public function fresh_extension_pdf($fresh_cte_id,$pdf=null){
          $response = DB::table('reports_extension')->where('id',$fresh_cte_id)->first();
          $response  = [
            'header'=>json_decode($response->header,true),'table_head'=>json_decode($response->table_head,true),
           'table_rows'=>json_decode($response->table_rows,true),'footer'=>json_decode($response->footer,true),'id'=>$fresh_cte_id
         ];
         if($pdf){
           set_time_limit(300);
           view()->share($response);
           $pdf = PDF::loadView('Admin.fresh_extension_calculation_pdf_page', $response);
           $pdf->getDomPDF()->setHttpContext(
                stream_context_create([
                    'ssl' => [
                        'allow_self_signed'=> TRUE,
                        'verify_peer' => FALSE,
                        'verify_peer_name' => FALSE,
                    ]
                ])
            );
           return $pdf->download($response['header']['industry_name'].'_Fresh_Extension.pdf');
         }      
         return view('Admin.fresh_extension_calculation_pdf_page_view',$response);
  }

  public function export_fresh_cte($cte_id){
    $response  = DB::table('reports')->where('id',$cte_id)->first();
    $response  = [
            'header'=>json_decode($response->header,true),'table_head'=>json_decode($response->table_head,true),
           'table_rows'=>json_decode($response->table_rows,true),'footer'=>json_decode($response->footer,true)
    ]; 
    return Excel::download(new CteExport($response), $response['header']['industry_name'].'.xlsx');
  }

  public function export_fresh_extension($cte_id){
    $response  = DB::table('reports_extension')->where('id',$cte_id)->first();
    $response  = [
            'header'=>json_decode($response->header,true),'table_head'=>json_decode($response->table_head,true),
           'table_rows'=>json_decode($response->table_rows,true),'footer'=>json_decode($response->footer,true)
    ]; 
    return Excel::download(new CteExtensionExport($response), $response['header']['industry_name'].'.xlsx');
  }

  public function extension_cte_pdf($extension_cte_id,$pdf=null){
          $response = DB::table('reports_extension')->where('id',$extension_cte_id)->first();
          $response  = [
            'header'=>json_decode($response->header,true),'table_head'=>json_decode($response->table_head,true),
           'table_rows'=>json_decode($response->table_rows,true),'footer'=>json_decode($response->footer,true),'id'=>$extension_cte_id
         ];
         if($pdf){
           view()->share($response);
           $pdf = PDF::loadView('Admin.extension_cte_calculation_pdf_page', $response);
           return $pdf->download('pdf_file.pdf');
         }      

          return view('Admin.extension_cte_calculation_pdf_page_view',$response);
  }

  public function extension_cte_add_page(){
      $industry_list     = Industry::all();
      $industry_category = Category::all();
      return view('Admin.extension_cte_add_page',['industry_list'=>$industry_list,'industry_category'=>$industry_category]);
  }

  private function extension_cte_no_change($request){
     $total_cte_fee       = 0;
     $applied_date    = $this->date_y_m_d($request->current_apply_date);
     $tenure          = Tenure::where('to','>=',$applied_date)->orderBy('from','asc')->first();
     if(empty($tenure)){
      $response = ['status'=>'failure','message'=>'Tenure details not found'];
     }else{
       $category             = Category::find($request->new_category_id);
       if(empty($category)){
         $response = ['status'=>'failure','message'=>'Category details not found'];
       }else{
         $column_name          = $category->fee_column;
         $fee                  = DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$request->new_ca)
                                 ->orderBy('start_amount','desc')->first();
         if(empty($fee)){
            $response = ['status'=>'failure','message'=>'Fees details not found'];
         }else{
            for ($i=0;$i<$request->duration;$i++){
               $from_date       = $this->date_y($request->current_apply_date)+$i."-".$this->date_m($request->current_apply_date)."-".$this->date_d($request->current_apply_date);
               $to_date         =  $this->add_365_day_y_m_d($from_date);
               $days            = $this->number_of_days($from_date,$to_date);
               $cte_fee         = ($fee->$column_name)/2;
               $total_cte_fee   = $total_cte_fee+$cte_fee;
               $table_rows[]     = [
                                    'sr_no'=>$i+1,'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),'days'=>$days,
                                    'ca_amount'=>$request->new_ca,'cte_fees'=>$cte_fee
                                  ];
            }
            $final_fee = $total_cte_fee-$request->deposited_amount;
            $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->new_category_id,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'extension','valid_upto'=>$to_date,
              'deposited_fee'=>$request->deposited_amount,'previous_category_name'=>$request->previous_category_name,
              'previous_category_id'=>$request->previous_category_id,'new_category_id'=>$request->new_category_id,'previous_ca'=>$request->previous_ca,
              'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,'current_apply_date'=>$request->current_apply_date,
              'view_apply_on'=>$request->view_apply_on,
              'deposited_date'=>$request->deposited_date,'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_apply_date),'total_cte_fee'=>$total_cte_fee,'ca_amount'=>$request->new_ca,'final_fee'=>$final_fee
            ];
            $table_head = ['#','From Date','To Date','Days','CA Amount','CTE Amout'];
            $footer    = ['deposited_date'=>$request->deposited_date,'deposited_amount'=>$request->deposited_amount,'total_cte_fee'=>$total_cte_fee,'final_fee'=>$final_fee];
            $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
         }
       }
     }
     return $response;
  }

  private function find_fee_category_applied_ca($category_id,$applied_date,$ca_amount){
      $category             = Category::find($category_id);
      $column_name          = $category->fee_column;
      $tenure               = Tenure::where('to','>=',$applied_date)->orderBy('from','asc')->first();
      $fee                  = DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$ca_amount)
                                 ->orderBy('start_amount','desc')->first();
      if($fee){
        return $first_fee            = $fee->$column_name;
      }else{
        return 0;
      }
      
  }

  private function extension_cte_category_change_old_data($industry_id,$ca_amount,$new_category_id,$current_applied_date){
      $table_rows   = [];
      $total_cte_fee        = 0;
      $report  = DB::table('reports')->where('industry_id',$industry_id)
                ->select('table_rows','industry_category_id','applied_on','current_ca')->orderBy('id','desc')->first();
      $first_fee_new            = $this->find_fee_category_applied_ca($new_category_id,$current_applied_date,$ca_amount);
      $after_first_new          = $first_fee_new/2;

      $first_fee_old            = $this->find_fee_category_applied_ca($report->industry_category_id,$report->applied_on,$report->current_ca);
      $after_first_old          = $first_fee_old/2;

      if(!empty($report)){
        $table_array = json_decode($report->table_rows,true);
        foreach ($table_array as $key => $table) {
          if($key==0){
            $arrear = money_format_change($first_fee_new)."-".money_format_change($first_fee_old);
            $cte_fee = $first_fee_new-$first_fee_old;
          }else{
            $arrear = money_format_change($after_first_new)."-".money_format_change($after_first_old);
            $cte_fee = $after_first_new-$after_first_old;

          }
          $total_cte_fee += $cte_fee;
          
          $table_rows[] = [
            'sr_no'=>$table['sr_no'],'from_date'=>$table['from_date'],'to_date'=>$table['to_date'],'days'=>$table['days'],'ca_amount'=>$table['ca_amount'],
            'arrear'=>$arrear,'cte_fees'=>$cte_fee
          ];
        }
      }

      $reports_extension  = DB::table('reports_extension')->where('industry_id',$industry_id)
                ->select('table_rows','industry_category_id','applied_on','current_ca')->orderBy('id','desc')->first();

      if(!empty($reports_extension)){
        $table_array = json_decode($reports_extension->table_rows,true);
        foreach ($table_array as $key => $table) {
         
            $arrear = money_format_change($after_first_new)."-".money_format_change($after_first_old);
            $cte_fee = $after_first_new-$after_first_old;


          $total_cte_fee += $cte_fee;
          
          $table_rows[] = [
            'sr_no'=>$table['sr_no'],'from_date'=>$table['from_date'],'to_date'=>$table['to_date'],'days'=>$table['days'],'ca_amount'=>$table['ca_amount'],
            'arrear'=>$arrear,'cte_fees'=>$cte_fee
          ];
        }
      }



      return ['table_rows'=>$table_rows,'old_total_cte_fee'=>$total_cte_fee];
  }

  private function extension_cte_ca_change_old_data($industry_id,$ca_amount,$new_category_id,$current_applied_date){
      $table_rows   = [];
      $total_cte_fee        = 0;
      $report  = DB::table('reports')->where('industry_id',$industry_id)
                ->select('table_rows','industry_category_id','applied_on','current_ca')->orderBy('id','desc')->first();
      $first_fee_new            = $this->find_fee_category_applied_ca($new_category_id,$current_applied_date,$ca_amount);
      $after_first_new          = $first_fee_new/2;

      $first_fee_old            = $this->find_fee_category_applied_ca($report->industry_category_id,$report->applied_on,$report->current_ca);
      $after_first_old          = $first_fee_old/2;

      if(!empty($report)){
        $table_array = json_decode($report->table_rows,true);
        foreach ($table_array as $key => $table) {
          if($key==0){
            $arrear = money_format_change($first_fee_new)."-".money_format_change($first_fee_old);
            $cte_fee = $first_fee_new-$first_fee_old;
          }else{
            $arrear = money_format_change($after_first_new)."-".money_format_change($after_first_old);
            $cte_fee = $after_first_new-$after_first_old;

          }
          $total_cte_fee += $cte_fee;
          
          $table_rows[] = [
            'sr_no'=>$table['sr_no'],'from_date'=>$table['from_date'],'to_date'=>$table['to_date'],'days'=>$table['days'],'ca_amount'=>$table['ca_amount'],
            'arrear'=>$arrear,'cte_fees'=>$cte_fee
          ];
        }
      }
      $reports_extension  = DB::table('reports_extension')->where('industry_id',$industry_id)
                ->select('table_rows','industry_category_id','applied_on','current_ca')->orderBy('id','desc')->first();

      if(!empty($reports_extension)){
        $table_array = json_decode($reports_extension->table_rows,true);
        foreach ($table_array as $key => $table) {
         
            $arrear = money_format_change($after_first_new)."-".money_format_change($after_first_old);
            $cte_fee = $after_first_new-$after_first_old;


          $total_cte_fee += $cte_fee;
          
          $table_rows[] = [
            'sr_no'=>$table['sr_no'],'from_date'=>$table['from_date'],'to_date'=>$table['to_date'],'days'=>$table['days'],'ca_amount'=>$table['ca_amount'],
            'arrear'=>$arrear,'cte_fees'=>$cte_fee
          ];
        }
      }
      return ['table_rows'=>$table_rows,'old_total_cte_fee'=>$total_cte_fee];
  }

  private function extension_cte_category_change($request){
     $total_cte_fee       = 0;
     $applied_date    = $this->date_y_m_d($request->current_apply_date);
     $tenure          = Tenure::where('to','>=',$applied_date)->orderBy('from','asc')->first();
     if(empty($tenure)){
      $response = ['status'=>'failure','message'=>'Tenure details not found'];
     }else{
       $category             = Category::find($request->new_category_id);
       if(empty($category)){
         $response = ['status'=>'failure','message'=>'Category details not found'];
       }else{
         $column_name          = $category->fee_column;
         $fee                  = DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$request->new_ca)
                                 ->orderBy('start_amount','desc')->first();
         if(empty($fee)){
            $response = ['status'=>'failure','message'=>'Fees details not found'];
         }else{
            $old_data = $this->extension_cte_category_change_old_data($request->industry_id,$request->new_ca,$request->new_category_id,$applied_date);
            $table_rows = $old_data['table_rows'];
            $total_cte_fee       += $old_data['old_total_cte_fee'];
            for ($i=0;$i<$request->duration;$i++){
               $from_date       = $this->date_y($request->current_apply_date)+$i."-".$this->date_m($request->current_apply_date)."-".$this->date_d($request->current_apply_date);
               $to_date         =  $this->add_365_day_y_m_d($from_date);
               $days            = $this->number_of_days($from_date,$to_date);
               $cte_fee         = ($fee->$column_name)/2;
               $total_cte_fee   = $total_cte_fee+$cte_fee;
               $table_rows[]     = [
                                    'sr_no'=>count($table_rows)+1,'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),'days'=>$days,
                                    'ca_amount'=>$request->new_ca,'cte_fees'=>$cte_fee,'arrear'=>'0'
                                  ];
            }
            $final_fee = $total_cte_fee-$request->deposited_amount;
            $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->new_category_id,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'extension','valid_upto'=>$to_date,
              'deposited_fee'=>$request->deposited_amount,'previous_category_name'=>$request->previous_category_name,
              'previous_category_id'=>$request->previous_category_id,'new_category_id'=>$request->new_category_id,'previous_ca'=>$request->previous_ca,
              'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,'current_apply_date'=>$request->current_apply_date,
              'view_apply_on'=>$request->view_apply_on,
              'deposited_date'=>$request->deposited_date,'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_apply_date),'total_cte_fee'=>$total_cte_fee,'ca_amount'=>$request->new_ca,'final_fee'=>$final_fee
            ];
            $table_head = ['#','From Date','To Date','Days','CA Amount','Arrear','CTE Amout'];
            $footer    = ['deposited_date'=>$request->deposited_date,'deposited_amount'=>$request->deposited_amount,'total_cte_fee'=>$total_cte_fee,'final_fee'=>$final_fee,'Arrear'=>'Arrear'];
            $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
         }
       }
     }
     if($request->action=='save'){
        Industry::where('id',$request->industry_id)->update(['industry_category'=>$request->new_category_id]);
     }
     return $response;
  }

  private function extension_cte_category_ca_change($request){
     $total_cte_fee       = 0;
     $applied_date    = $this->date_y_m_d($request->current_apply_date);
     $tenure          = Tenure::where('to','>=',$applied_date)->orderBy('from','asc')->first();
     if(empty($tenure)){
      $response = ['status'=>'failure','message'=>'Tenure details not found'];
     }else{
       $category             = Category::find($request->new_category_id);
       if(empty($category)){
         $response = ['status'=>'failure','message'=>'Category details not found'];
       }else{
         $column_name          = $category->fee_column;
         $fee                  = DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$request->new_ca)
                                 ->orderBy('start_amount','desc')->first();
         if(empty($fee)){
            $response = ['status'=>'failure','message'=>'Fees details not found'];
         }else{
            $old_data = $this->extension_cte_category_change_old_data($request->industry_id,$request->new_ca,$request->new_category_id,$applied_date);
            $table_rows = $old_data['table_rows'];
            $total_cte_fee       += $old_data['old_total_cte_fee'];
            for ($i=0;$i<$request->duration;$i++){
               $from_date       = $this->date_y($request->current_apply_date)+$i."-".$this->date_m($request->current_apply_date)."-".$this->date_d($request->current_apply_date);
               $to_date         =  $this->add_365_day_y_m_d($from_date);
               $days            = $this->number_of_days($from_date,$to_date);
               $cte_fee         = ($fee->$column_name)/2;
               $total_cte_fee   = $total_cte_fee+$cte_fee;
               $table_rows[]     = [
                                    'sr_no'=>count($table_rows)+1,'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),'days'=>$days,
                                    'ca_amount'=>$request->new_ca,'cte_fees'=>$cte_fee,'arrear'=>'0'
                                  ];
            }
            $final_fee = $total_cte_fee-$request->deposited_amount;
            $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->new_category_id,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'extension','valid_upto'=>$to_date,
              'deposited_fee'=>$request->deposited_amount,'previous_category_name'=>$request->previous_category_name,
              'previous_category_id'=>$request->previous_category_id,'new_category_id'=>$request->new_category_id,'previous_ca'=>$request->previous_ca,
              'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,'current_apply_date'=>$request->current_apply_date,
              'view_apply_on'=>$request->view_apply_on,
              'deposited_date'=>$request->deposited_date,'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_apply_date),'total_cte_fee'=>$total_cte_fee,'ca_amount'=>$request->new_ca,'final_fee'=>$final_fee
            ];
            $table_head = ['#','From Date','To Date','Days','CA Amount','Arrear','CTE Amout'];
            $footer    = ['deposited_date'=>$request->deposited_date,'deposited_amount'=>$request->deposited_amount,'total_cte_fee'=>$total_cte_fee,'final_fee'=>$final_fee,'Arrear'=>'Arrear'];
            $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
         }
       }
     }
     if($request->action=='save'){
        Industry::where('id',$request->industry_id)->update(['industry_category'=>$request->new_category_id]);
     }
     return $response;
  }

  private function extension_cte_ca_change($request){
     $total_cte_fee       = 0;
     $applied_date    = $this->date_y_m_d($request->current_apply_date);
     $tenure          = Tenure::where('to','>=',$applied_date)->orderBy('from','asc')->first();
     if(empty($tenure)){
      $response = ['status'=>'failure','message'=>'Tenure details not found'];
     }else{
       $category             = Category::find($request->new_category_id);
       if(empty($category)){
         $response = ['status'=>'failure','message'=>'Category details not found'];
       }else{
         $column_name          = $category->fee_column;
         $fee                  = DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$request->new_ca)
                                 ->orderBy('start_amount','desc')->first();
         if(empty($fee)){
            $response = ['status'=>'failure','message'=>'Fees details not found'];
         }else{
            $old_data = $this->extension_cte_ca_change_old_data($request->industry_id,$request->new_ca,$request->new_category_id,$applied_date);
            $table_rows = $old_data['table_rows'];
            $total_cte_fee       += $old_data['old_total_cte_fee'];
            for ($i=0;$i<$request->duration;$i++){
               $from_date       = $this->date_y($request->current_apply_date)+$i."-".$this->date_m($request->current_apply_date)."-".$this->date_d($request->current_apply_date);
               $to_date         =  $this->add_365_day_y_m_d($from_date);
               $days            = $this->number_of_days($from_date,$to_date);
               $cte_fee         = ($fee->$column_name)/2;
               $total_cte_fee   = $total_cte_fee+$cte_fee;
               $table_rows[]     = [
                                    'sr_no'=>count($table_rows)+1,'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),'days'=>$days,
                                    'ca_amount'=>$request->new_ca,'cte_fees'=>$cte_fee,'arrear'=>'0'
                                  ];
            }
            $final_fee = $total_cte_fee-$request->deposited_amount;
            $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->new_category_id,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'extension','valid_upto'=>$to_date,
              'deposited_fee'=>$request->deposited_amount,'previous_category_name'=>$request->previous_category_name,
              'previous_category_id'=>$request->previous_category_id,'new_category_id'=>$request->new_category_id,'previous_ca'=>$request->previous_ca,
              'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,'current_apply_date'=>$request->current_apply_date,
              'view_apply_on'=>$request->view_apply_on,
              'deposited_date'=>$request->deposited_date,'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_apply_date),'total_cte_fee'=>$total_cte_fee,'ca_amount'=>$request->new_ca,'final_fee'=>$final_fee
            ];
            $table_head = ['#','From Date','To Date','Days','CA Amount','Arrear','CTE Amout'];
            $footer    = ['deposited_date'=>$request->deposited_date,'deposited_amount'=>$request->deposited_amount,'total_cte_fee'=>$total_cte_fee,'final_fee'=>$final_fee,'Arrear'=>'Arrear'];
            $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
         }
       }
     }
     // if($request->action=='save'){
     //    Industry::where('id',$request->industry_id)->update(['industry_category'=>$request->new_category_id]);
     // }
     return $response;
  }

  public function extension_cte_fee_calculate(Request $request){
      $industry_id                  = $request->industry_id;
      $previous_category_name       = $request->previous_category_name;
      $previous_category_id         = $request->previous_category_id;
      $new_category_id              = $request->new_category_id;
      $previous_ca                  = $request->previous_ca;
      $previous_apply_date          = $request->previous_apply_date;
      $current_apply_date           = $request->current_apply_date;
      $deposited_amount             = $request->deposited_amount;
      $deposited_date               = $request->deposited_date;
      $duration                     = $request->duration;
      $view_apply_on                = $request->view_apply_on;
      $action                       = $request->action;
      $format                       = $request->format;
      $new_ca                       = $request->new_ca =  $this->change_currency($request->new_ca,$format);
      $current_apply_date           = $request->current_apply_date = $this->add_1_day_d_m_y($request->current_apply_date);
      

      if(empty($industry_id)){
         $response = ['status'=>'failure','message'=>'Please select industry'];
      }elseif(empty($previous_category_name)){
         $response = ['status'=>'failure','message'=>'Previous category not found'];
      }elseif(empty($previous_category_id)){
         $response = ['status'=>'failure','message'=>'previous category id not found'];
      }elseif(empty($new_category_id)){
         $response = ['status'=>'failure','message'=>'Please select new category'];
      }elseif(empty($previous_ca)){
         $response = ['status'=>'failure','message'=>'Previous CA not found'];
      }elseif(empty($previous_apply_date)){
         $response = ['status'=>'failure','message'=>'Previous apply date not found'];
      }elseif(empty($current_apply_date)){
         $response = ['status'=>'failure','message'=>'Valid upto not found'];
      }elseif(empty($view_apply_on)){
         $response = ['status'=>'failure','message'=>'View apply date not found'];
      }elseif(empty($duration)){
         $response = ['status'=>'failure','message'=>'Please enter duration'];
      }elseif(empty($action)){
         $response = ['status'=>'failure','message'=>'Action not found'];
      }elseif(empty($new_ca)){
         $response = ['status'=>'failure','message'=>'New CA not found'];
      }elseif(empty($format)){
         $response = ['status'=>'failure','message'=>'Currency format not found'];
      }else{
        $industry             =  Industry::find($industry_id);
        if(empty($industry)){
          $response = ['status'=>'failure','message'=>'Industry details not found'];
        }else{
          $previous_fresh_data  =  DB::table('reports')->where(['industry_id'=>$industry_id,'fee_type'=>'fresh'])->first();
          if(empty($previous_fresh_data)){
            $response = ['status'=>'failure','message'=>'Please create fresh cte first'];
          }else{
            if($previous_fresh_data->current_ca==$new_ca && $industry->industry_category==$new_category_id){
              $response = $this->extension_cte_no_change($request);
            }

            if($previous_fresh_data->current_ca==$new_ca && $industry->industry_category!=$new_category_id){
              $response = $this->extension_cte_category_change($request);
            }
            if($previous_fresh_data->current_ca!=$new_ca && $industry->industry_category==$new_category_id){
              $response = $this->extension_cte_ca_change($request);
            }
            if($previous_fresh_data->current_ca!=$new_ca && $industry->industry_category!=$new_category_id){
              $response = $this->extension_cte_category_ca_change($request);
            }        
          }
        }
      }

      if($response['status']=='success' && $action=='calculate'){
        return view('Admin.extension_cte_calculation_page',$response);
      }if($response['status']=='success' && $action=='save'){
        $this->save_extension_cte_data($response);
      }else{
        return "<span class='text text-danger'>".$response['message']."</span>";
      }
         // $sr                   =  1;
         
         
        
        
      //       $fresh_category_id = $previous_fresh_data->industry_category_id;
      //       $fresh_ca          = $previous_fresh_data->current_ca;
      //       if($previous_fresh_data->current_ca!=$new_ca){
      //         $ca_changed                   = 'Y';
      //         $category_changed       = 'Y';
      //         $previous_all_data      =  DB::table('reports')->where('industry_id',$industry_id)->orderBy('id', 'asc')->get();
      //       }
      //       if($industry->industry_category!=$new_category_id){
      //         $previous_all_data      =  DB::table('reports')->where('industry_id',$industry_id)->orderBy('id', 'asc')->get();
      //         $category_changed       = 'Y';
      //       }
         
      //    $applyed_on     = $current_applied_date;
      //    $applied_date_a = explode('-',date('Y-m-d', strtotime($current_applied_date. ' + 0 days')));//d/m/Y
      //    $tenure         = Tenure::where('to','>=',$applied_date_a)->orderBy('from','asc')->first();
      //    // dd($applied_date_a);
      //    $category             = Category::find($new_category_id);
      //    $column_name          = $category->fee_column;
      //    $fee                  = DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$new_ca)
      //                      ->orderBy('start_amount','desc')->first();
      //    $final_fee           = $new_cte_fee = $fee->$column_name;

      //    $category       = Category::find($industry->industry_category);
         
         
        

         
      //    $table_details  = [];
      //    $total_fee      = 0;
      //    for ($i=0;$i<$duration;$i++){ 
      //       $from_date       = $applied_date_a[0]+$i."-".$applied_date_a[1]."-".$applied_date_a[2];
      //       $to_date         = date('Y-m-d', strtotime($from_date. ' + 364 days'));
      //       if(date('L', strtotime($to_date))){
      //         $to_date         = date('Y-m-d', strtotime($to_date. ' + 1 days'));
      //       }
      //       $to_date1        = date('Y-m-d', strtotime($from_date. ' + 365 days'));
      //       $days            = floor((strtotime($to_date1) - strtotime($from_date)) / 86400);
      //       $final_fee       = $fee->$column_name;
      //       $final_fee       = $final_fee/2;
      //       $total_fee       = $total_fee+$final_fee;
      //       $table_details[] = [
      //                             'sr_no'=>$sr++,'from_date'=>date('d/m/Y',strtotime($from_date)),
      //                             'to_date'=>date('d/m/Y',strtotime($to_date)),'days'=>$days,
      //                             'ca_amount'=>$new_ca,'cte_fees'=>$final_fee
      //                           ];
      //    }
      //    $details  = [
      //                 'industry_name'=>$industry->industry_name,'industry_type'=>$category->category_name,
      //                 'tenure_from'=>date('d/F',strtotime("2021-".$category->tenure_from)),'tenure_to'=>date('d/F',strtotime("2021-".$category->tenure_to)),'duration'=>$duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
      //                 'applied_on'=>$current_applied_date,'table_details'=>$table_details,'applied_date'=>$apply_date,
      //                 'deposited_date'=>$deposited_date,'deposited_amount'=>$deposited_amount,'total_fee'=>$total_fee,
      //                 'final_fee'=>$total_fee-$deposited_amount,'previous_data'=>$previous_all_data,'current_tenure_fee'=>$fee->$column_name,'category_changed'=>$category_changed,'new_cte_fee'=>$new_cte_fee,'ca_changed'=>$ca_changed
      //             ];
      //    $response = ['status'=>'success','message'=>'check details','data'=>$details];
      //    if($request->action=='save'){
      //     $insert = [
      //                'industry_id'=>$industry_id,'industry_category_id'=>$new_category_id,'industry_type'=>$category->category_name,
      //                'fee_type'=>'extension','duration'=>$duration,'applied_on'=>$current_applied_date,'valid_upto'=>$to_date,
      //                'total_fee'=>$total_fee,'deposited_fee'=>$deposited_amount,'deposited_date'=>$deposited_date,'final_fee'=>$total_fee-$deposited_amount,'current_ca'=>$new_ca,'response_data'=>json_encode($details),'created_at'=>date('Y-m-d H:i:s'),'applied_date_view'=>$apply_date,'current_tenure_fee'=>$fee->$column_name
      //              ];
      //       if($category_changed=='Y'){
      //         Industry::where('id',$industry_id)->update(['industry_category'=>$new_category_id]);
      //       }
      //       DB::table('reports')->insert($insert);
      //       $response = ['status'=>'failure','message'=>'Data Saved successfully','data'=>$details];
      //    }
      // }          
      // if($response['status']=='failure'){
      //   return "<span class='text text-danger'>".$response['message']."</span>";
      // }else{
      //   // dd($response);
      //   return view('Admin.extension_cte_calculation_page',$response);
      // }    
  }

  public function generated_cte_list(){
        $reports = DB::table('reports')->join('industries','industries.id','=','reports.industry_id')->select('reports.*','industries.industry_name as industry_name')->get();

        $extension = DB::table('reports_extension')->join('industries','industries.id','=','reports_extension.industry_id')->select('reports_extension.*','industries.industry_name as industry_name')->get();
        return view('Admin.generated_cte_list',['reports'=>$reports,'extension'=>$extension]);
  }

  public function generated_cto_list(){
      $reports = DB::table('report_cto')->join('industries','industries.id','=','report_cto.industry_id')
                ->select('report_cto.*','industries.industry_name as industry_name')->get();

         $extension = []; //DB::table('reports_extension')->join('industries','industries.id','=','reports_extension.industry_id')->select('reports_extension.*','industries.industry_name as industry_name')->get();
        return view('Admin.generated_cto_list',['reports'=>$reports,'extension'=>$extension]);
  }

  public function generated_extension_cte_list(){
        $reports = DB::table('reports_extension')->join('industries','industries.id','=','reports_extension.industry_id')->select('reports_extension.*','industries.industry_name as industry_name')->get();
        return view('Admin.generated_extension_cte_list',['reports'=>$reports]);
  }

  private function add_year($date_y_m_d,$year){

   return date('Y-m-d',strtotime($date_y_m_d. ' + '.$year.' years'));
  }

  private function tenure_by_category_id($category_id){
       $category  = Category::find($category_id);
       return     $category->tenure_to;
  }

  private function tenure_to_date($from_y_m_d,$tenure_to){
     $from_time = strtotime($from_y_m_d);
     $to_time   = strtotime(date('Y',$from_time)."-".$tenure_to);
     if($from_time<=$to_time){
      return date('Y',$from_time)."-".$tenure_to;
     }else{
      $year = date('Y',$from_time);
      return 1+$year."-".$tenure_to;
     }
  }

  private function tenure_end_date($from_y_m_d,$tenure_to){
    $from_time          =   strtotime($from_y_m_d);
    $from_y             =   date('Y',$from_time);
    $tenures            =   Tenure::where('to','like',"%$from_y%")->orderBy('from','asc')->first();
    if(empty($tenures) || session()->get('year')==$tenures->to){
      session()->put('year','');
      return $this->tenure_to_date($from_y_m_d,$tenure_to);
    }elseif(session()->get('year')!=$tenures->to){
       // echo ;
       session()->put('year',$tenures->to);
       $to_time            =   strtotime($from_y."-".date('m-d',strtotime($tenures->to)));
        if($from_time<=$to_time){
          return date('Y',$from_time)."-".date('m-d',strtotime($tenures->to));
        }else{
          $year = date('Y',$from_time);
          return 1+$year."-".date('m-d',strtotime($tenures->to));
        }
    }
   
  }

  private function fee_by_days($fee,$days){
    $per_day = $fee/365;
    return round($per_day*$days,0);
  }

  private function renew_cto_no_change_air_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->current_applied_date);
   if($request->varied=='varied'){
    $applied_date  = $this->date_y_m_d($request->applied_on_view);
   } 
   
   $end_date      = $this->date_d_m_y($this->add_year($applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_air_fee   = 0;
   $run                 = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$request->new_ca,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days)
                             ];
      $applied_date        = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date             = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);  
      $run++;
    }      
   }
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_air_fee;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->current_applied_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_applied_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
    $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,
            'total_cto_air_fee'=>$total_cto_air_fee,'final_cto_air_fee'=>$final_cto_air_fee,
            'payable_amount'=>$payable_amount
        ];
    $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CTO Air Fee'];
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function renew_cto_no_change_water_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->current_applied_date);
   if($request->varied=='varied'){
    $applied_date  = $this->date_y_m_d($request->applied_on_view);
   } 
   $end_date      = $this->date_d_m_y($this->add_year($applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee   = 0;
   $run                 = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$request->new_ca,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee += $this->fee_by_days($fees,$days);
      $run++;
    }      
   }
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;   
   $payable_amount      = $final_cto_water_fee;
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->current_applied_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_applied_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
   $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'final_cto_water_fee'=>$final_cto_water_fee,'total_cto_water_fee'=>$total_cto_water_fee,
            'payable_amount'=>$payable_amount
          ];
   $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CTO Water Fee'];
   $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function renew_cto_no_change_both_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->current_applied_date);
   if($request->varied=='varied'){
    $applied_date  = $this->date_y_m_d($request->applied_on_view);
   } 
   $end_date      = $this->date_d_m_y($this->add_year($applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee   = 0;
   $run                 = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$request->new_ca,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days)
                             ];
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee += $this->fee_by_days($fees,$days);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $run++;
      }     
    }      
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_water_fee+$final_cto_air_fee;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->current_applied_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_applied_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
   $footer    = [
              'deposited_air_amount'=>$request->deposited_air_amount,'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
              'total_cto_water_fee'=>$total_cto_water_fee,'total_cto_air_fee'=>$total_cto_air_fee,'final_cto_water_fee'=>$final_cto_water_fee,
              'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount
            ];
    $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CTO Water Fee','CTO Air Fee'];  
    
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function penalty_ca_by_year($date_y_m_d,$penalty_box_ca,$format){
          $financial = strtotime($date_y_m_d);
          $year      = $this->date_y($this->date_d_m_y($date_y_m_d))."-03-31";
          if($financial<strtotime($year)){
            $year      = bcsub($this->date_y($this->date_d_m_y($date_y_m_d)),1);
          }else{
             $year      = $this->date_y($this->date_d_m_y($date_y_m_d));
          }
          
          $last_ca = end($penalty_box_ca);
          $penalty_ca = isset($penalty_box_ca[$year])?$penalty_box_ca[$year]:$last_ca;
          return      $this->change_currency($penalty_ca,$format);
  }

  private function renew_cto_penalty_exist_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->previous_apply_date);
   $end_date      = $this->date_d_m_y($this->add_year($applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $run           = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                                    'ca_diffrence'=>0
                             ];
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $run++;
      if($request->concent_type=='air'){
        $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      }elseif($request->concent_type=='water'){
        $total_cto_water_fee += $this->fee_by_days($fees,$days);
      }else{
         $total_cto_water_fee += $this->fee_by_days($fees,$days);
         $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      }     
    }      
   }
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
    if($request->concent_type=='air'){
        $payable_amount      = $final_cto_air_fee;
        $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,
            'total_cto_air_fee'=>$total_cto_air_fee,'ca_diffrence'=>'exist',
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount
        ];
          $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','CTO Air Fee'];
      }elseif($request->concent_type=='water'){
        $payable_amount      = $final_cto_water_fee;
        $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'final_cto_water_fee'=>$final_cto_water_fee,'total_cto_water_fee'=>$total_cto_water_fee,
            'payable_amount'=>$payable_amount,'ca_diffrence'=>'exist'
          ];
          $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','CTO Water Fee'];
      }else{
         $payable_amount      = $final_cto_water_fee+$final_cto_air_fee;
         $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'total_cto_water_fee'=>$total_cto_water_fee,'total_cto_air_fee'=>$total_cto_air_fee,'final_cto_water_fee'=>$final_cto_water_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'ca_diffrence'=>'exist'
          ];
          $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','CTO Water Fee','CTO Air Fee'];
      }   

   
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function renew_cto_penalty_exist_air_calculation($request){
   $applied_date         = $this->date_y_m_d($request->previous_apply_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $air_regu_fee      = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $air_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_air_fee+$total_noc_fee+$air_regu_fee;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
        
        $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,
            'total_cto_air_fee'=>$total_cto_air_fee,'ca_diffrence'=>'exist','noc_fee'=>'exist','air_regu_fee'=>$air_regu_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Air FEE(Regu)','CTO Air Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
  }

  private function renew_cto_penalty_exist_water_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->previous_apply_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);

   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_noc_fee     = 0;
   $total_cto_air_fee = 0;
   $water_regu_fee      = 0;
   $run           = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $water_regu_fee       += $noc_fee;
      $run++;  
    }      
   }
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;
   $payable_amount      = $final_cto_water_fee+$total_noc_fee+$water_regu_fee;
  

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
  
        
        $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'final_cto_water_fee'=>$final_cto_water_fee,'total_cto_water_fee'=>$total_cto_water_fee,
            'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'ca_diffrence'=>'exist','noc_fee'=>'exist','water_regu_fee'=>$water_regu_fee,
          ];
          $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee'];
    

   
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function renew_cto_penalty_exist_both_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->previous_apply_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee = 0;
   $air_regu_fee = 0;
   $water_regu_fee = 0;
   $run           = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $run++;
      $total_cto_water_fee += $this->fee_by_days($fees,$days);
     $total_cto_air_fee   += $this->fee_by_days($fees,$days); 
     $total_noc_fee   += $noc_fee; 
     $water_regu_fee   += $noc_fee; 
     $air_regu_fee   += $noc_fee; 
    }      
   }
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_water_fee+$final_cto_air_fee+$total_noc_fee+$water_regu_fee+$air_regu_fee;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
         
         $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'total_cto_water_fee'=>$total_cto_water_fee,'total_cto_air_fee'=>$total_cto_air_fee,'final_cto_water_fee'=>$final_cto_water_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'ca_diffrence'=>'exist','noc_fee'=>'exist',
            'water_regu_fee'=>$water_regu_fee,'air_regu_fee'=>$air_regu_fee,'total_noc_fee'=>$total_noc_fee
          ];
          $table_head = [
            '#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee',
            'CTO-Air FEE(Regu)','CTO Air Fee'];

   
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function penalty_slab_view($start_date,$end_date){
    $start         = strtotime($start_date);
    $end           = strtotime($end_date);
    if(date('d', $end)>date('d', $start)){
      $add_extra_month = 1;
    }else{
      $add_extra_month = 0;
    }
    $months        = abs((date('Y', $end) - date('Y', $start))*12 + (date('m', $end) - date('m', $start)))+$add_extra_month;
    $penalty_slab  = DB::table('penalty')->where('start_amount','<=',$months)->orderBy('start_amount','desc')->first();
    if($penalty_slab && $months<=12){
      return "within ".$penalty_slab->start_amount." Months to ".$penalty_slab->end_amount." Months From The Date Of Expiry";
    }elseif($penalty_slab && $months>12){
      $year               = round($months/12);
      $next_year          = round($months/12)+1;
      return "within ".$year." Year to ".$next_year." Year From The Date Of Expiry";
    }else{
      return null;
    }
  }

  private function penalty_slab_percentage($start_date,$end_date){
    $start         = strtotime($start_date);
    $end           = strtotime($end_date);
    if(date('d', $end)>date('d', $start)){
      $add_extra_month = 1;
    }else{
      $add_extra_month = 0;
    }
    $months        = abs((date('Y', $end) - date('Y', $start))*12 + (date('m', $end) - date('m', $start)))+$add_extra_month;
    $penalty_slab  = DB::table('penalty')->where('start_amount','<=',$months)->orderBy('start_amount','desc')->first();
    if($penalty_slab && $months<=12){
      return (int) $penalty_slab->percentage;
    }elseif($penalty_slab && $months>12){
       $year               = round($months/12);
       $next_year          = round($months/12)+1;
       return $next_year*100;
    }else{
      return 0;
    }
  }

  private function penalty_percentage_ca($penalty_slab_percentage,$fees){

          return ($penalty_slab_percentage*$fees)/100;
  }


  private function renew_cto_no_change_air_expired_calculation($request){
   $applied_date          = $this->add_1_day_y_m_d($request->current_applied_date);
   $end_date              = $this->date_d_m_y($this->add_year($applied_date,$request->duration));
   $tenure_to             = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date              = $this->date_y($end_date)."-".$tenure_to;
   $to_date               = $this->tenure_to_date($applied_date,$tenure_to);
   $fees                  = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $category                = Category::find($request->industry_category_id_new);
   $total_air_penalty      = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
   $total_cto_air_fee   = 0;
   $run                 = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$request->new_ca,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days)
                             ];
      $applied_date        = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date             = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);  
      $run++;
    }      
   }
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_air_fee+$total_air_penalty-$request->penalty_air_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->current_applied_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_applied_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_air_penalty'=>$total_air_penalty
            ];
    $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,
            'total_cto_air_fee'=>$total_cto_air_fee,'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,
            'penalty_days'=>'exist','total_air_penalty'=>$total_air_penalty,'penalty_air_amount'=>$request->penalty_air_amount
        ];
    $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CTO Air Fee'];
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer];
    return $response;
  }

  private function renew_cto_no_change_water_expired_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $category      = Category::find($request->industry_category_id_new);
   $total_water_penalty      = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
   $total_cto_water_fee = 0;
   $total_cto_air_fee   = 0;
   $run                 = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$request->new_ca,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee += $this->fee_by_days($fees,$days);
      $run++;
    }      
   }
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;   
   $payable_amount      = $final_cto_water_fee+$total_water_penalty-$request->penalty_water_amount;
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->current_applied_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_applied_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_water_penalty'=>$total_water_penalty
            ];
   $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'final_cto_water_fee'=>$final_cto_water_fee,'total_cto_water_fee'=>$total_cto_water_fee,
            'payable_amount'=>$payable_amount,'penalty_days'=>'exist','total_water_penalty'=>$total_water_penalty,
            'penalty_water_amount'=>$request->penalty_water_amount
          ];
   $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CTO Water Fee'];
   $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function renew_cto_no_change_both_expired_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $total_water_penalty      = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
   $total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);



   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee   = 0;
   $run                 = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$request->new_ca,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days)
                             ];
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee += $this->fee_by_days($fees,$days);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $run++;
      }     
    }      
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_water_fee+$final_cto_air_fee+$total_water_penalty+$total_air_penalty-($request->penalty_air_amount+$request->penalty_water_amount);

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->current_applied_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->current_applied_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_water_penalty'=>$total_water_penalty,'total_air_penalty'=>$total_air_penalty
            ];
   $footer    = [
              'deposited_air_amount'=>$request->deposited_air_amount,'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
              'total_cto_water_fee'=>$total_cto_water_fee,'total_cto_air_fee'=>$total_cto_air_fee,'final_cto_water_fee'=>$final_cto_water_fee,
              'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,
              'penalty_days'=>'exist','total_water_penalty'=>$total_water_penalty,'total_air_penalty'=>$total_air_penalty,
              'penalty_air_amount'=>$request->penalty_air_amount,'penalty_water_amount'=>$request->penalty_water_amount
            ];
    $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CTO Water Fee','CTO Air Fee'];  
    
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function renew_cto_penalty_exist_air_expired_calculation($request){
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $air_regu_fee      = 0;
   $penalty_old_data = $this->renew_cto_penalty_exist_old_expired_calculation($request);
   if(!empty($penalty_old_data)){
     foreach ($penalty_old_data as $key => $old_data) {
        $table_rows[]      =   [
                                    'sr_no'=>$old_data['sr_no'],
                                    'from_date'=>$old_data['from_date'],
                                    'to_date'=>$old_data['to_date'],
                                    'days'=>$old_data['days'],
                                    'ca_certificate_amount'=>$old_data['ca_certificate_amount'],
                                    'ca_diffrence'=>$old_data['ca_diffrence'],
                                    'noc_fee'=>$old_data['noc_fee'],
                                    'air_regu_fee'=>$old_data['air_regu_fee'],
                                    'cto_air_fee'=>$old_data['cto_air_fee'],
                             ];
        $total_cto_air_fee   += $old_data['cto_air_fee'];
        $total_noc_fee       += $old_data['noc_fee'];
        $air_regu_fee        += $old_data['air_regu_fee'];       
     }
   }

   $applied_date         = $this->add_1_day_y_m_d($request->current_applied_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id_new);
  
   $run               = 1;
   
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>count($penalty_old_data)+$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $air_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_air_fee+$total_air_penalty+$total_noc_fee+$air_regu_fee-$request->penalty_air_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_air_penalty'=>$total_air_penalty
            ];
        
        $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,
            'total_cto_air_fee'=>$total_cto_air_fee,'ca_diffrence'=>'exist','noc_fee'=>'exist','air_regu_fee'=>$air_regu_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_days'=>'exist','total_air_penalty'=>$total_air_penalty,'penalty_air_amount'=>$request->penalty_air_amount
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Air FEE(Regu)','CTO Air Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
  }

  private function renew_cto_penalty_exist_old_expired_calculation($request){
   $applied_date          = $this->date_y_m_d($request->previous_apply_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date              = $this->date_d_m_y($current_applied_date);
   $tenure_to             = $this->tenure_by_category_id($request->industry_category_id_old);
   $end_date              = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $request->previous_ca = $this->change_currency($request->previous_ca,$request->format);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_old,$applied_date,$request->previous_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->previous_apply_date),$this->date_y_m_d($request->current_applied_date));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->previous_apply_date),$this->date_y_m_d($request->current_applied_date));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->previous_apply_date),$this->date_y_m_d($request->current_applied_date));
   $total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id_old);
   $penalty_ca_old    = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_old,$from_date,$ca_diff);
      if(strtotime($current_applied_date)<strtotime($to_date)){
             $to_date            = $current_applied_date;
      }else{
        $run++;
      }
      $days              =   $this->number_of_days($from_date,$to_date);
      $fees             = $this->find_fee_category_applied_ca($request->industry_category_id_old,$applied_date,$penalty_ca);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);       
    }      
   }
   return $table_rows;
  }

  private function renew_cto_penalty_exist_water_expired_calculation($request){
   $applied_date         = $this->date_y_m_d($request->previous_apply_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $total_water_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $water_regu_fee    = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $water_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_water_fee   = $total_cto_water_fee-$request->deposited_water_amount;
   $payable_amount      = $final_cto_water_fee+$total_water_penalty+$total_noc_fee+$water_regu_fee-$request->penalty_water_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_water_penalty'=>$total_water_penalty
            ];
        
        $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'total_cto_water_fee'=>$total_cto_water_fee,'ca_diffrence'=>'exist','noc_fee'=>'exist','water_regu_fee'=>$water_regu_fee,
            'final_cto_water_fee'=>$final_cto_water_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_water_amount'=>$request->penalty_water_amount,
            'penalty_days'=>'exist','total_water_penalty'=>$total_water_penalty
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
  }

  private function renew_cto_penalty_exist_both_expired_calculation($request){
   $applied_date         = $this->date_y_m_d($request->previous_apply_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $total_water_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
   $total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $water_regu_fee    = 0;
   $air_regu_fee    = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->penalty_ca_by_year($from_date,$request->penalty_ca,$request->format);
      $ca_diff           =   ($i==0)?0:$penalty_ca-$penalty_ca_old;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $total_cto_water_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $water_regu_fee       += $noc_fee;
      $air_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_air_fee     = $total_cto_air_fee-$request->deposited_air_amount;
   $final_cto_water_fee   = $total_cto_water_fee-$request->deposited_water_amount;
   $payable_amount        = $final_cto_air_fee+$final_cto_water_fee+$total_water_penalty+$total_air_penalty+$total_noc_fee+$water_regu_fee+$air_regu_fee-($request->penalty_air_amount+$request->penalty_water_amount);

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_water_penalty'=>$total_water_penalty,
              'total_air_penalty'=>$total_air_penalty
            ];
        
        $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,'deposited_water_amount'=>$request->deposited_water_amount,
            'total_cto_air_fee'=>$total_cto_air_fee,'ca_diffrence'=>'exist','noc_fee'=>$total_noc_fee,'air_regu_fee'=>$air_regu_fee,'water_regu_fee'=>$water_regu_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_days'=>'exist','total_water_penalty'=>$total_water_penalty,'total_air_penalty'=>$total_air_penalty,
            'total_cto_water_fee'=>$total_cto_water_fee,'final_cto_water_fee'=>$final_cto_water_fee,
            'penalty_air_amount'=>$request->penalty_air_amount,'penalty_water_amount'=>$request->penalty_water_amount
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee',
        'CTO-Air FEE(Regu)','CTO Air Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
  }

  private function save_renew_cto_data($response,$request){
      $report = $response['header'];
      $insert = [
        'industry_id'=>$request['industry_id'],
        'industry_name'=>$report['industry_name'],
        'industry_category_id_old'=>$request['industry_category_id_old'],
        'industry_category_old'=>$request['industry_category_old'],
        'industry_category_id_new'=>$request['industry_category_id_new'],
        'previous_ca_origional'=>$request['previous_ca'],
        'previous_ca_convert'=>$this->change_currency($request['previous_ca'],$request['format']),
        'format'=>$request['format'],
        'new_ca_origional'=>$request['new_ca'],
        'new_ca_convert'=>$this->change_currency($request['new_ca'],$request['format']),
        'previous_apply_date'=>$request['previous_apply_date'],
        'previous_apply_date_ymd'=>$this->date_y_m_d($request['previous_apply_date']),
        'current_applied_date'=>$request['current_applied_date'],
        'current_applied_date_ymd'=>$this->date_y_m_d($request['current_applied_date']),
        'deposited_air_amount'=>$request['deposited_air_amount'],
        'deposited_water_amount'=>$request['deposited_water_amount'],
        'penalty_air_amount'=>$request['penalty_air_amount'],
        'penalty_water_amount'=>$request['penalty_water_amount'],
        'duration'=>$request['duration'],
        'applied_on_view'=>$request['applied_on_view'],
        'applied_on_view_ymd'=>$this->date_y_m_d($request['applied_on_view']),
        'concent_type'=>$request['concent_type'],
        'industry_type'=>$report['industry_type'],
        'tenure_from'=>$report['tenure_from'],
        'tenure_to'=>$report['tenure_to'],
        'fee_type'=>'renew',
        'ca_amount_origional'=>$report['ca_amount'],
        'ca_amount_convert'=>$report['ca_amount'],
        'final_cto_air_fee'=>$response['footer']['final_cto_air_fee'],
        'payable_amount'=>$response['footer']['payable_amount'],
        'total_cto_air_fee'=>$response['footer']['total_cto_air_fee'],
        'table_head'=>json_encode($response['table_head']),
        'table_rows'=>json_encode($response['table_rows']),
        'footer'=>json_encode($response['footer']),
        'header'=>json_encode($response['header']),
      ];
      DB::table('report_cto')->insert($insert);
      echo  "<span class='text text-success'>Data Saved successfully</span>";
  }

  private function ca_change_penalty($from_date,$old_ca,$new_ca,$format){
      return $new_ca;
  }

  private function renew_cto_ca_change_air_calculation($request){
   $applied_date         = $this->date_y_m_d($request->current_applied_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $air_regu_fee      = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->ca_change_penalty($from_date,$request->previous_ca,$request->new_ca,$request->format);
      $ca_diff           =   ($i==0)?$penalty_ca-$request->previous_ca:0;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $air_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_air_fee+$total_noc_fee+$air_regu_fee;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
        
        $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,
            'total_cto_air_fee'=>$total_cto_air_fee,'ca_diffrence'=>'exist','noc_fee'=>'exist','air_regu_fee'=>$air_regu_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Air FEE(Regu)','CTO Air Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
  }

  private function renew_cto_ca_change_water_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->current_applied_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);

   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_noc_fee     = 0;
   $total_cto_air_fee = 0;
   $water_regu_fee      = 0;
   $run           = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->ca_change_penalty($from_date,$request->previous_ca,$request->new_ca,$request->format);
      $ca_diff           =   ($i==0)?$penalty_ca-$request->previous_ca:0;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $water_regu_fee       += $noc_fee;
      $run++;  
    }      
   }
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;
   $payable_amount      = $final_cto_water_fee+$total_noc_fee+$water_regu_fee;
  

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
  
        
        $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'final_cto_water_fee'=>$final_cto_water_fee,'total_cto_water_fee'=>$total_cto_water_fee,
            'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'ca_diffrence'=>'exist','noc_fee'=>'exist','water_regu_fee'=>$water_regu_fee,
          ];
          $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee'];
    

   
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function renew_cto_ca_change_both_calculation($request){
   $applied_date  = $this->add_1_day_y_m_d($request->current_applied_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee = 0;
   $air_regu_fee = 0;
   $water_regu_fee = 0;
   $run           = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->ca_change_penalty($from_date,$request->previous_ca,$request->new_ca,$request->format);
      $ca_diff           =   ($i==0)?$penalty_ca-$request->previous_ca:0;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $run++;
      $total_cto_water_fee += $this->fee_by_days($fees,$days);
     $total_cto_air_fee   += $this->fee_by_days($fees,$days); 
     $total_noc_fee   += $noc_fee; 
     $water_regu_fee   += $noc_fee; 
     $air_regu_fee   += $noc_fee; 
    }      
   }
   $final_cto_water_fee = $total_cto_water_fee-$request->deposited_water_amount;
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_water_fee+$final_cto_air_fee+$total_noc_fee+$water_regu_fee+$air_regu_fee;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0
            ];
         
         $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'total_cto_water_fee'=>$total_cto_water_fee,'total_cto_air_fee'=>$total_cto_air_fee,'final_cto_water_fee'=>$final_cto_water_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'ca_diffrence'=>'exist','noc_fee'=>'exist',
            'water_regu_fee'=>$water_regu_fee,'air_regu_fee'=>$air_regu_fee,'total_noc_fee'=>$total_noc_fee
          ];
          $table_head = [
            '#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee',
            'CTO-Air FEE(Regu)','CTO Air Fee'];

   
    $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
    return $response;
  }

  private function renew_cto_ca_change_air_expired_calculation($request){
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $air_regu_fee      = 0;
   $applied_date         = $this->add_1_day_y_m_d($request->current_applied_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id_new);
  
   $run               = 1;
   
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->ca_change_penalty($from_date,$request->previous_ca,$request->new_ca,$request->format);
      $ca_diff           =   ($i==0)?$penalty_ca-$request->previous_ca:0;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $air_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_air_fee   = $total_cto_air_fee-$request->deposited_air_amount;
   $payable_amount      = $final_cto_air_fee+$total_air_penalty+$total_noc_fee+$air_regu_fee-$request->penalty_air_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_air_penalty'=>$total_air_penalty
            ];
        
        $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,
            'total_cto_air_fee'=>$total_cto_air_fee,'ca_diffrence'=>'exist','noc_fee'=>'exist','air_regu_fee'=>$air_regu_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_days'=>'exist','total_air_penalty'=>$total_air_penalty,'penalty_air_amount'=>$request->penalty_air_amount
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Air FEE(Regu)','CTO Air Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
  }

  private function renew_cto_ca_change_water_expired_calculation($request){
   $applied_date         = $this->add_1_day_y_m_d($request->current_applied_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $total_water_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $water_regu_fee    = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->ca_change_penalty($from_date,$request->previous_ca,$request->new_ca,$request->format);
      $ca_diff           =   ($i==0)?$penalty_ca-$request->previous_ca:0;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_water_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $water_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_water_fee   = $total_cto_water_fee-$request->deposited_water_amount;
   $payable_amount      = $final_cto_water_fee+$total_water_penalty+$total_noc_fee+$water_regu_fee-$request->penalty_water_amount;

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_water_penalty'=>$total_water_penalty
            ];
        
        $footer    = [
            'deposited_water_amount'=>$request->deposited_water_amount,'final_fee'=>0,
            'total_cto_water_fee'=>$total_cto_water_fee,'ca_diffrence'=>'exist','noc_fee'=>'exist','water_regu_fee'=>$water_regu_fee,
            'final_cto_water_fee'=>$final_cto_water_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_water_amount'=>$request->penalty_water_amount,
            'penalty_days'=>'exist','total_water_penalty'=>$total_water_penalty
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
  }

  private function renew_cto_ca_change_both_expired_calculation($request){
   $applied_date         = $this->add_1_day_y_m_d($request->current_applied_date);
   $current_applied_date  = $this->date_y_m_d($request->current_applied_date);
   $end_date      = $this->date_d_m_y($this->add_year($current_applied_date,$request->duration));
   $tenure_to     = $this->tenure_by_category_id($request->industry_category_id_new);
   $end_date      = $this->date_y($end_date)."-".$tenure_to;
   $to_date       = $this->tenure_to_date($applied_date,$tenure_to);
   $fees          = $this->find_fee_category_applied_ca($request->industry_category_id_new,$applied_date,$request->new_ca);
   $penalty_days          = $this->number_of_days($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab          = $this->penalty_slab_view($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $penalty_slab_percentage  = $this->penalty_slab_percentage($this->date_y_m_d($request->current_applied_date),$this->date_y_m_d($request->applied_on_view));
   $total_water_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);
   $total_air_penalty        = $this->penalty_percentage_ca($penalty_slab_percentage,$fees);

   $category      = Category::find($request->industry_category_id_new);
   $total_cto_water_fee = 0;
   $total_cto_air_fee = 0;
   $total_noc_fee     = 0;
   $penalty_ca_old    = 0;
   $water_regu_fee    = 0;
   $air_regu_fee    = 0;
   $run               = 1;
   for ($i=0; $i < $run; $i++) {
    if(strtotime($to_date)<=strtotime($end_date)){
      $from_date         =   $applied_date;
      $days              =   $this->number_of_days($from_date,$to_date);
      $penalty_ca        =   $this->ca_change_penalty($from_date,$request->previous_ca,$request->new_ca,$request->format);
      $ca_diff           =   ($i==0)?$penalty_ca-$request->previous_ca:0;
      if($ca_diff<=0){ $ca_diff = 0; }
      $noc_fee           =   $this->find_fee_category_applied_ca($request->industry_category_id_new,$from_date,$ca_diff);
      $table_rows[]      =   [
                                    'sr_no'=>$i+1,
                                    'from_date'=>$this->date_d_m_y($from_date),
                                    'to_date'=>$this->date_d_m_y($to_date),
                                    'days'=>$days,
                                    'ca_certificate_amount'=>$penalty_ca,
                                    'ca_diffrence'=>$ca_diff,
                                    'noc_fee'=>$noc_fee,
                                    'water_regu_fee'=>$noc_fee,
                                    'cto_water_fee'=>$this->fee_by_days($fees,$days),
                                    'air_regu_fee'=>$noc_fee,
                                    'cto_air_fee'=>$this->fee_by_days($fees,$days),
                             ];
      $penalty_ca_old     = $penalty_ca;
      $applied_date       = $this->add_1_day_y_m_d($this->date_d_m_y($to_date));
      $to_date            = $this->tenure_end_date($applied_date,$tenure_to);
      $total_cto_air_fee   += $this->fee_by_days($fees,$days);
      $total_cto_water_fee   += $this->fee_by_days($fees,$days);
      $total_noc_fee       += $noc_fee;
      $water_regu_fee       += $noc_fee;
      $air_regu_fee       += $noc_fee;
      $run++; 
    }      
   }
   $final_cto_air_fee     = $total_cto_air_fee-$request->deposited_air_amount;
   $final_cto_water_fee   = $total_cto_water_fee-$request->deposited_water_amount;
   $payable_amount        = $final_cto_air_fee+$final_cto_water_fee+$total_water_penalty+$total_air_penalty+$total_noc_fee+$water_regu_fee+$air_regu_fee-($request->penalty_air_amount+$request->penalty_water_amount);

   
   $header = [
              'industry_id'=>$request->industry_id,'industry_category_id'=>$request->industry_category_id_new,
              'industry_name'=>$this->industry_name_by_id($request->industry_id),
              'industry_type'=>$category->category_name,'tenure_from'=>$this->date_d_monthname("2021-".$category->tenure_from),
              'tenure_to'=>$this->date_d_monthname("2021-".$category->tenure_to),'fee_type'=>'renew','valid_upto'=>$end_date,
              'deposited_air_fee'=>$request->deposited_air_amount,'previous_category_name'=>$request->industry_category_old,
              'previous_category_id'=>$request->industry_category_id_new,'new_category_id'=>$request->industry_category_id_new,
              'previous_ca'=>$request->previous_ca,'new_ca'=>$request->new_ca,'previous_apply_date'=>$request->previous_apply_date,
              'current_apply_date'=>$request->previous_apply_date,'view_apply_on'=>$request->applied_on_view,'concent_type'=>$request->concent_type,
              'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
              'applied_date'=>$this->date_y_m_d($request->previous_apply_date),'total_cte_fee'=>0,'ca_amount'=>$request->new_ca,'final_fee'=>0,
              'penalty_days'=>$penalty_days,'penalty_slab'=>$penalty_slab,'total_water_penalty'=>$total_water_penalty,
              'total_air_penalty'=>$total_air_penalty
            ];
        
        $footer    = [
            'deposited_air_amount'=>$request->deposited_air_amount,'final_fee'=>0,'deposited_water_amount'=>$request->deposited_water_amount,
            'total_cto_air_fee'=>$total_cto_air_fee,'ca_diffrence'=>'exist','noc_fee'=>$total_noc_fee,'air_regu_fee'=>$air_regu_fee,'water_regu_fee'=>$water_regu_fee,
            'final_cto_air_fee'=>$final_cto_air_fee,'payable_amount'=>$payable_amount,'total_noc_fee'=>$total_noc_fee,
            'penalty_days'=>'exist','total_water_penalty'=>$total_water_penalty,'total_air_penalty'=>$total_air_penalty,
            'total_cto_water_fee'=>$total_cto_water_fee,'final_cto_water_fee'=>$final_cto_water_fee,
            'penalty_air_amount'=>$request->penalty_air_amount,'penalty_water_amount'=>$request->penalty_water_amount
        ];
        $table_head = ['#','From Date','To Date','Days','CA Certificate Amount','CA Diffrence','Regu / NOC FEE','CTO-Water FEE(Regu)','CTO Water Fee',
        'CTO-Air FEE(Regu)','CTO Air Fee'];
        $response  = ['status'=>'success','message'=>'check details','header'=>$header,'table_head'=>$table_head,'table_rows'=>$table_rows,'footer'=>$footer]; 
        return $response;
  }

 


  public function renew_cto_fee_calculate(Request $request){
      $industry_id                    = $request->industry_id;
      $industry_category_old          = $request->industry_category_old;
      $industry_category_id_new       = $request->industry_category_id_new;
      $previous_ca                    =  $request->previous_ca;
      $previous_apply_date            = $request->previous_apply_date;
      $current_applied_date           =  $request->current_applied_date;
      $deposited_air_amount           = $request->deposited_air_amount;
      $deposited_water_amount         = $request->deposited_water_amount;
      $duration                       = $request->duration;
      $applied_on_view                = $request->applied_on_view;
      $concent_type                   = $request->concent_type;
      $action                         = $request->action;
      $format                         = $request->format;
      $penalty_ca                     = $request->penalty_ca;
      $varied                         = $request->varied;
      $new_ca                         = $request->new_ca  =  $this->change_currency($request->new_ca,$format);
      $previous_ca                    = $request->previous_ca =  $this->change_currency($request->previous_ca,$format);
      if(empty($industry_id)){
         $response = ['status'=>'failure','message'=>'Please select industry'];
      }elseif(empty($industry_category_old)){
         $response = ['status'=>'failure','message'=>'Old category not found'];
      }elseif(empty($industry_category_id_new)){
         $response = ['status'=>'failure','message'=>'Please select revised category'];
      }elseif(empty($previous_ca)){
         $response = ['status'=>'failure','message'=>'Please enter previous ca'];
      }elseif(empty($new_ca)){
         $response = ['status'=>'failure','message'=>'Please enter new ca'];
      }elseif(empty($previous_apply_date)){
         $response = ['status'=>'failure','message'=>'Please enter previous applied date'];
      }elseif(empty($current_applied_date)){
         $response = ['status'=>'failure','message'=>'Please enter current applied date'];
      }elseif(empty($duration)){
         $response = ['status'=>'failure','message'=>'Please enter duration'];
      }elseif(empty($applied_on_view)){
         $response = ['status'=>'failure','message'=>'Please enter applied view date'];
      }elseif(empty($concent_type)){
         $response = ['status'=>'failure','message'=>'Please enter consent type'];
      }elseif(empty($format)){
         $response = ['status'=>'failure','message'=>'Please select currency format'];
      }elseif(empty($varied)){
         $response = ['status'=>'failure','message'=>'Please select renewal format'];
      }else{
        $start_date = strtotime($this->date_y_m_d($current_applied_date));
        $end_date   = strtotime($this->date_y_m_d($applied_on_view));
        $ca_changed = FALSE;
        if($new_ca>$previous_ca){
          $ca_changed = TRUE;
        }

        $expired    = FALSE;
        if($start_date<$end_date){
          $expired  = TRUE;
        }
        if(empty($penalty_ca) && $concent_type=='air' && $expired==FALSE && $ca_changed==TRUE){  
        echo "0a";        
          $response = $this->renew_cto_ca_change_air_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='water' && $expired==FALSE && $ca_changed==TRUE){
          echo "0b"; 
          $response = $this->renew_cto_ca_change_water_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='both' && $expired==FALSE && $ca_changed==TRUE){
          echo "0c"; 
          $response = $this->renew_cto_ca_change_both_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='air' && $expired==TRUE && $ca_changed==TRUE){
          echo "0j"; 
          $response = $this->renew_cto_ca_change_air_expired_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='water' && $expired==TRUE && $ca_changed==TRUE){
          echo "0k"; 
          $response = $this->renew_cto_ca_change_water_expired_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='both' && $expired==TRUE && $ca_changed==TRUE){
          echo "0l"; 
          $response = $this->renew_cto_ca_change_both_expired_calculation($request);
        }elseif(!empty($penalty_ca) && $concent_type=='air' && $expired==FALSE && $ca_changed==FALSE){  
        echo "a";        
          $response = $this->renew_cto_penalty_exist_air_calculation($request);
        }elseif(!empty($penalty_ca) && $concent_type=='water' && $expired==FALSE && $ca_changed==FALSE){
          echo "b"; 
          $response = $this->renew_cto_penalty_exist_water_calculation($request);
        }elseif(!empty($penalty_ca) && $concent_type=='both' && $expired==FALSE && $ca_changed==FALSE){
          echo "c"; 
          $response = $this->renew_cto_penalty_exist_both_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='air' && $expired==FALSE && $ca_changed==FALSE){
          echo "d"; 
          $response = $this->renew_cto_no_change_air_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='water' && $expired==FALSE && $ca_changed==FALSE){
          echo "e"; 
          $response = $this->renew_cto_no_change_water_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='both' && $expired==FALSE && $ca_changed==FALSE){
          echo "f"; 
          $response = $this->renew_cto_no_change_both_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='air' && $expired==TRUE && $ca_changed==FALSE){
          echo "g"; 
          $response = $this->renew_cto_no_change_air_expired_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='water' && $expired==TRUE && $ca_changed==FALSE){
          echo "h"; 
          $response = $this->renew_cto_no_change_water_expired_calculation($request);
        }elseif(empty($penalty_ca) && $concent_type=='both' && $expired==TRUE && $ca_changed==FALSE){
          echo "i"; 
          $response = $this->renew_cto_no_change_both_expired_calculation($request);
        }elseif(!empty($penalty_ca) && $concent_type=='air' && $expired==TRUE && $ca_changed==FALSE){
          echo "j"; 
          $response = $this->renew_cto_penalty_exist_air_expired_calculation($request);
        }elseif(!empty($penalty_ca) && $concent_type=='water' && $expired==TRUE && $ca_changed==FALSE){
          echo "k"; 
          $response = $this->renew_cto_penalty_exist_water_expired_calculation($request);
        }elseif(!empty($penalty_ca) && $concent_type=='both' && $expired==TRUE && $ca_changed==FALSE){
          echo "l"; 
          $response = $this->renew_cto_penalty_exist_both_expired_calculation($request);
        }
      }
      if($response['status']=='success' && $action=='calculate'){
        return view('Admin.extension_cto_calculation_page',$response);
      }if($response['status']=='success' && $action=='save'){
        $this->save_renew_cto_data($response,$request);
      }else{
        return "<span class='text text-danger'>".$response['message']."</span>";
      }
  }


    public function fresh_cto_add(){
        $industry_list = Industry::all();
        $industry_category = Category::all();
        return view('Admin.fresh_cto_add',['industry_list'=>$industry_list,'industry_category'=>$industry_category]);
    }

    public function fresh_cto_add_page(){
      $industry_list     = Industry::all();
      $industry_category = Category::all();
      return view('Admin.fresh_cto_add_page',['industry_list'=>$industry_list,'industry_category'=>$industry_category]);
    }

    public function fresh_cto_fee_calculate(Request $request){
      $industry_id                = $request->industry_id;
      $industry_category          = $request->industry_category;
      $current_ca_amount          = $request->current_ca;
      $applied_date               =  $request->applied_date;
      $deposited_air_amount       = $request->deposited_air_amount;
      $deposited_water_amount     = $request->deposited_water_amount;
      $duration          = $durations =  $request->duration;
      $concent_type               = $request->concent_type;
      $industry_noc               = $request->industry_noc;
      $previous_all_data            = [];
      $category_changed             = 'N';
      $ca_changed                   = 'N';
      $arrear_changed                       = 'N';

      if(empty($industry_id)){
         $response = ['status'=>'failure','message'=>'Please select industry'];
      }elseif(empty($current_ca_amount)){
         $response = ['status'=>'failure','message'=>'Please enter current CA amount'];
      }elseif(empty($applied_date)){
         $response = ['status'=>'failure','message'=>'Please select applied date'];
      }elseif(empty($duration)){
         $response = ['status'=>'failure','message'=>'Please enter duration'];
      }elseif(empty($concent_type)){
         $response = ['status'=>'failure','message'=>'Please select consent type'];
      }else{
         $sr             = 1;
         $industry       = Industry::find($industry_id);
         $applied_date_a = explode('/',$applied_date);//d/m/Y
         $applied_date   = $applied_date_a[2]."-".$applied_date_a[1]."-".$applied_date_a[0]; //Y-m-d
         $last_year      = date('Y',strtotime($applied_date. ' + '.$durations.' years'));
         $category       = Category::find($industry->industry_category);
         $last_days      = $last_year."-".$category->tenure_to;

         $previous_fresh_data  =  DB::table('reports')->where('industry_id',$industry_id)->orderBy('id', 'desc')->first();
         if($previous_fresh_data!=null && $previous_fresh_data->current_ca!=$current_ca_amount){
            $ca_changed                   = 'Y';
            
            $arrear_changed               = 'Y';
            $previous_all_data      =  DB::table('reports')->where('industry_id',$industry_id)->orderBy('id', 'asc')->get();
         }
         if($previous_fresh_data!=null && $previous_fresh_data->industry_category_id!=$industry_category){
            $category       = Category::find($industry_category);
            $last_days      = $last_year."-".$category->tenure_to;
            $category_changed             = 'Y';
         }
         // dd( $last_days);

        

        $tenure         = Tenure::where('to','>=',$applied_date)->orderBy('from','asc')->first();
         $fee           = DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$current_ca_amount)
                           ->orderBy('start_amount','desc')->first();


         $column_name    = $category->fee_column;
         $db_from        = (int) str_replace('-','',$category->tenure_from);
         $db_to          = (int) str_replace('-','',$category->tenure_to);


         $table_details  =  [];
         $total_fee      =  0;
         $total_loop      = 1;
         $rem_days        = 0;
         $selected_year  = $applied_date_a[2];
         $from_date      = $from_dates = $applied_date_a[2]."-".$applied_date_a[1]."-".$applied_date_a[0];
         $last_date      = date('Y-m-d',strtotime($from_dates. ' + '.$durations.' years'));
         for ($i=0;$i<$duration+1;$i++){
            if($i==0){
              $selected_year     = $selected_year;
              $to_date            = $selected_year."-".$category->tenure_to;
              if(strtotime($from_date)>strtotime($to_date)){
                $selected_year     = $selected_year+1;
                $to_date            = $selected_year."-".$category->tenure_to;
                $i=$i+1;
              }
            }else{
              if($duration==$i+1){
               $selected_year     = $selected_year+1;
                $to_date            = $selected_year."-".$category->tenure_to;
              }else{
                $selected_year     = $selected_year+1;
                $to_date            = $selected_year."-".$category->tenure_to;
              }
              
            }
           
        

          $days            = floor((strtotime($to_date) - strtotime($from_date)) / 86000);
          if($days==366){
            $days = 365;
          }
          $final_fee       = $fee->$column_name;
          $final_fee_air   = $final_fee;
          $final_fee_water = $final_fee;
            
          if($industry_noc=='yes' && $i==0 ){
              $noc_amount = $final_fee;
          }else{
              $noc_amount = 0;
          }
          $one_day_fee = number_format((float)$final_fee/365, 2, '.', '');
          $final_fee1 = number_format((float)$one_day_fee*$days, 2, '.', '');
          if($days==365){
            $final_fee1 = $final_fee;
          }
          $total_fee = $total_fee+$final_fee1;
          $table_details[] = [
                                  'sr_no'=>$sr++,'from_date'=>date('d/m/Y',strtotime($from_date)),
                                  'to_date'=>date('d/m/Y',strtotime($to_date)),'days'=>$days,
                                  'ca_amount'=>$current_ca_amount,'cte_fees'=>$final_fee1,'noc_amount'=>$noc_amount,
                                  'air_amount'=>$final_fee1,'water_amount'=>$final_fee1
                                ];
          $from_date         = date('Y-m-d', strtotime($to_date. ' + 1 days'));
         }
         // dd();
         $details  = [
                      'industry_name'=>$industry->industry_name,'industry_type'=>$category->category_name,
                      'tenure_from'=>date('d/F',strtotime("2021-".$category->tenure_from)),'tenure_to'=>date('d/F',strtotime("2021-".$category->tenure_to)),'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
                      'applied_date'=>$request->applied_date,'table_details'=>$table_details,'previous_data'=>$previous_all_data,
                      'total_fee'=>$total_fee,'ca_amount'=>$current_ca_amount,'concent_type'=>$concent_type,'new_cte_fee'=>$current_ca_amount,'current_tenure_fee'=>$fee->$column_name,'arrear_changed'=>$arrear_changed,
                      'final_fee'=>$total_fee,'deposited_air_amount'=>$deposited_air_amount,'category_changed'=>$category_changed,
                      'deposited_water_amount'=>$deposited_water_amount,'total_water_fee'=>$total_fee-$request->deposited_water_amount,'total_air_fee'=>$total_fee-$request->deposited_air_amount,'industry_noc'=>$industry_noc,'ca_changed'=>$ca_changed
                  ];
         $response = ['status'=>'success','message'=>'check details','data'=>$details];
         if($request->action=='save'){

          if($category_changed=='Y'){
              Industry::where('id',$industry_id)->update(['industry_category'=>$industry_category]);
            }

          $insert = [
                     'industry_id'=>$industry_id,'industry_category'=>$industry_category,'current_ca'=>$current_ca_amount,
                     'applied_on'=>$applied_date,'deposited_air_amount'=>$deposited_air_amount,
                     'deposited_water_amount'=>$deposited_water_amount,'duration'=>$duration,'concent_type'=>$concent_type,
                     'industry_noc'=>$industry_noc,'total_fee'=>$total_fee,'fee_type'=>'fresh','final_fee'=>$total_fee,
                     'response_data'=>json_encode($details),'created_at'=>date('Y-m-d H:i:s'),'valid_upto'=>$to_date
                   ];
            DB::table('report_cto')->insert($insert);
            $response = ['status'=>'failure','message'=>'Data Saved successfully','data'=>$details];
         }
      }          
      if($response['status']=='failure'){
        return "<span class='text text-danger'>".$response['message']."</span>";
      }else{
        return view('Admin.fresh_cto_calculation_page',$response);
      }   
    }

    public function extension_cto_add_page(){
      $industry_list     = Industry::all();
      $industry_category = Category::all();
      return view('Admin.extension_cto_add_page',['industry_list'=>$industry_list,'industry_category'=>$industry_category]);
    }

    public function ajax_extension_cto_penalty_check(Request $request){
      $current_cas                  = $request->current_cas;
      $industry_id                  = $request->industry_id;
      $apply_date                   = $request->apply_date;
      $penalty_box                  = [];
      $fresh_cto_data               =   DB::table('report_cto')->where('industry_id',$industry_id)->where('fee_type','fresh')->first();
      $previous_ca                  = $fresh_cto_data->current_ca;
      $previous_ca_penalty          =  $previous_ca+(($previous_ca*20)/100);
      $response = ['status'=>'failure','message'=>'boxes not available','data'=>[]];
      if($previous_ca_penalty<$current_cas){
          $view_apply_date      =   explode('/',$apply_date);//d/m/Y
          $view_app_date        =   $view_apply_date[2]."-".$view_apply_date[1]."-".$view_apply_date[0]; //Y-m-d
          $fresh_apply_date     = (int) date('Y',strtotime($fresh_cto_data->applied_on));
          $end_apply_date       = (int) date('Y',strtotime($view_app_date));
          $increment            = 0;
          for($i=$fresh_apply_date;$i<=$end_apply_date;$i++){
            $penalty_box[] = ['from'=>$i];
          }
          $response = ['status'=>'success','message'=>'populate boxes','data'=>$penalty_box];
      }
      return response()->json($response);
    }

   public function extension_cto_fee_calculate(Request $request){
      date_default_timezone_set("Asia/Calcutta");
      $industry_id                  = $request->industry_id;
      $prevoius_category_name       = $request->prevoius_category;
      $new_category_id              = $request->new_category_id;
      $previous_ca                  = $request->previous_ca;
      $current_ca_amount             = $request->new_ca;
      $previous_apply_date          = $request->previous_apply_date;
      $current_applied_date         = $request->current_applied_date;
      $deposited_air_amount         = $request->deposited_air_amount;
      $deposited_water_amount         = $request->deposited_water_amount;
      $duration                     = $durations = $request->duration;
      $apply_date                   = $request->apply_date;
      $concent_type                   = $request->concent_type;
      $penalty_box_value                   = $request->penalty_box_value;
      $penalty_box_year                   = $request->penalty_box_year;

      $previous_all_data            = [];
      $category_changed             = 'N';
      $ca_changed                   = 'N';
      $industry_noc                 = 'N';
      $arrear_changed               = 'N';
      $penalty_changed               = 'N';
      $penalty_changed               = 'N';
      $new_cte_fee                  =  0;
      $penalty_changed_water         = 0;
      $penalty_changed_air         = 0;

      if(empty($industry_id)){
         $response = ['status'=>'failure','message'=>'Please select industry'];
      }elseif(empty($new_category_id)){
         $response = ['status'=>'failure','message'=>'Please select category'];
      }elseif(empty($current_ca_amount)){
         $response = ['status'=>'failure','message'=>'Please enter current CA amount'];
      }elseif(empty($current_applied_date)){
         $response = ['status'=>'failure','message'=>'Please select valid upto'];
      }elseif(empty($duration)){
         $response = ['status'=>'failure','message'=>'Please enter duration'];
      }elseif(empty($concent_type)){
         $response = ['status'=>'failure','message'=>'Please select consent type'];
      }else{
         $sr                     = 1;
         $industry               = Industry::find($industry_id);
         $applied_date_a         = explode('/',$current_applied_date);//d/m/Y
         $current_applied_date   = $applied_date_a[2]."-".$applied_date_a[1]."-".$applied_date_a[0]; //Y-m-d
         $current_applied_date   = date('d/m/Y',strtotime($current_applied_date. ' + 1 days'));

          $applied_date_a        = explode('/',$current_applied_date);//d/m/Y
         $current_applied_date   = $applied_date_a[2]."-".$applied_date_a[1]."-".$applied_date_a[0]; //Y-m-d

         $last_year      = date('Y',strtotime($current_applied_date. ' + '.$durations.' years'));
         $category       = Category::find($industry->industry_category);
         $last_days      = $last_year."-".$category->tenure_to;


         $tenure         = Tenure::where('to','>=',$current_applied_date)->orderBy('from','asc')->first();
         $fee           = $fees =  DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$current_ca_amount)
                           ->orderBy('start_amount','desc')->first();



         $previous_fresh_data  =  DB::table('report_cto')->where('industry_id',$industry_id)->orderBy('id', 'desc')->first();
         $caa                  = array_combine($penalty_box_year, $penalty_box_value);
         
         // dd($penalty_box_year);
         

         

         if($previous_fresh_data!=null && $previous_fresh_data->current_ca!=$current_ca_amount){

            $ca_changed                   = 'Y';
            $category_changed             = 'Y';
            
            //$previous_all_data      =  DB::table('report_cto')->where('industry_id',$industry_id)->orderBy('id', 'asc')->get();
            $diff_ca                =  $current_ca_amount-$previous_fresh_data->current_ca;

            $previous_ca_penalty    =  $previous_fresh_data->current_ca+(($previous_fresh_data->current_ca*20)/100);
            if($previous_ca_penalty<$current_ca_amount){
              $penalty_changed               = 'Y';
              $previous_all_datas      =  DB::table('report_cto')->where('industry_id',$industry_id)->orderBy('id', 'asc')->get();
              foreach ($previous_all_datas as $key => $previous) {
                $start    = strtotime($previous_fresh_data->applied_on);//26/10/2015
                $end      = strtotime($previous->valid_upto);//31/12/2020
                $category = Category::find($new_category_id);
                $to_date            = date('Y',$start)."-".$category->tenure_to;//31/12/2015


                $k        = 1;
                
                for ($i=0; $i < $k; $i++) {

                if(strtotime($to_date)<$end){
                  $k++;
                }else{
                  break;
                } 
                  $froms_date         =   date('Y-m-d',$start); //1994-10-10             
                  $tenures            =   Tenure::where('to','>=',$froms_date)->orderBy('from','asc')->first();
                  $tenure_to          =   $tenures->to;//2004-09-30
                  if($i==0){
                      if(strtotime($froms_date)>strtotime($to_date)){
                        $selected_year     = date('Y',$start)+1;
                        $to_date            = $selected_year."-".$category->tenure_to;
                      }
                  }

                  

                  if($i>=1){
                      $to_date        =   date('Y',strtotime($froms_date))."-".$category->tenure_to; //2016-12-31
                      if($to_date>$tenure_to){
                         $to_date        = $tenure_to;
                      }else{                         
                         $selected_year     = date('Y',$start);
                         $to_date         = $selected_year."-".$category->tenure_to;
                         if($to_date>$tenure_to){
                             $to_date        = $tenure_to;
                          }
                      }
                  }
                 
                  $start         = strtotime($to_date. ' + 1 days');

                   $days            = floor((strtotime($to_date) - strtotime($froms_date)) / 86000);
                  if($days==366){
                    $days = 365;
                  }

                  $to_year = date('Y',strtotime($froms_date));
                  $new_cal_p = $caa[$to_year];

                  
                  

                  // echo $to_year."==".$new_cal_p."<br>";

                  // $new_cal_p = $new_cal_p* $days;


                  $previous_all_data_temp[] = [
                                  'sr_no'=>$sr++,'from_date'=>$froms_date,
                                  'to_date'=>$to_date,'days'=>$days,
                                  'ca_amount'=>$new_cal_p,'air_amount'=>100,'water_amount'=>200,
                                  
                                ];

                }

                foreach ($previous_all_data_temp as $key => $value) {
                  if($key==0){
                    $ca_diff = 0;
                    $noc_fees = 0;
                  }else{
                     $ca_diff = $value['ca_amount']-$previous_all_data_temp[$key-1]['ca_amount'];
                     $fro_date = $value['from_date'];
                      $tenuress         =  Tenure::where('to','>=',$fro_date)->orderBy('from','asc')->first();
                      $feess                =  DB::table('fees')->where('tenure_id',$tenuress->id)->where('start_amount','<',$ca_diff)
                                         ->orderBy('start_amount','desc')->first();
                      if($feess!==null){
                        $categoryss       = Category::find($new_category_id);
                        $column_namess    = $categoryss->fee_column;
                     
                        $noc_fees       =            $feess->$column_namess;

                      }else{
                        $noc_fees         =          $value['ca_amount'];
                      }
                      if($ca_diff==0){
                        $noc_fees         =          0;
                      }

                      $last_ca = $value['ca_amount'];


                       
                      

                  }

                  $tenuresss         =  Tenure::where('to','>=',$value['from_date'])->orderBy('from','asc')->first();
                      $feesss                =  DB::table('fees')->where('tenure_id',$tenuresss->id)->where('start_amount','<',$value['ca_amount'])
                                         ->orderBy('start_amount','desc')->first();
                      $categorysss       = Category::find($new_category_id);
                        $column_namesss    = $categorysss->fee_column;
                     
                        $cto_water_fee       =            round(($feesss->$column_namesss/365)*$value['days'],2);
                  


                    $previous_all_data[] = [
                                  'sr_no'=>$value['sr_no'],'from_date'=>date('d/m/Y',strtotime($value['from_date'])),
                                  'to_date'=>date('d/m/Y',strtotime($value['to_date'])),'days'=>$value['days'],
                                  'ca_amount'=>$value['ca_amount'],'air_amount'=>100,'water_amount'=>200,
                                  'ca_diff'=>$ca_diff,'noc_fee'=>$noc_fees,'water_regu_fee'=>$noc_fees,'air_regu_fee'=>$noc_fees,'cto_water_fee'=>$cto_water_fee,'cto_air_fee'=>$cto_water_fee
                                  
                                ];
                }

                

                




              }
              // dd($previous_all_data);
              $previous_all_data = $previous_all_data;
              $view_apply_date      =   explode('/',$apply_date);//d/m/Y
              $current_ca_amount =  $caa[$view_apply_date[2]];

            }
            $fee           = DB::table('fees')->where('tenure_id',$tenure->id)->where('start_amount','<',$diff_ca)
                           ->orderBy('start_amount','desc')->first();
            $industry_noc                 = 'Y';
            $arrear_changed               = 'Y';
         }

          $view_apply_date      =   explode('/',$apply_date);//d/m/Y
          $view_app_date        =   $view_apply_date[2]."-".$view_apply_date[1]."-".$view_apply_date[0]." ".date('H:i:s'); //Y-m-d
          $fresh_cto_data       =   DB::table('report_cto')->where('industry_id',$industry_id)->where('fee_type','fresh')->first();

          $fresh_cto_date       =  $fresh_cto_data->valid_upto." 23:59:59";
          $fresh_cto_date       = strtotime($fresh_cto_date);          
          $view_app_date        = strtotime($view_app_date);
          if($fresh_cto_date<$view_app_date){
            $dtToronto   = Carbon::create($applied_date_a[2], $applied_date_a[1], $applied_date_a[0], 0, 0, 1);
            $dtVancouver = Carbon::create($view_apply_date[2], $view_apply_date[1], $view_apply_date[0], 23, 59, 59);
            $seconds     = $dtVancouver->diffInSeconds($dtToronto); // 3
            $abc         = DB::select( DB::raw("SELECT * FROM `penalty` where start_amount*(30*24*60*61.10)<'$seconds' order by start_amount desc limit 1"));

            $categorys       = Category::find($new_category_id);
            $column_names    = $categorys->fee_column;

            $tenuresss         =  Tenure::where('to','>=',date('Y-m-d',$view_app_date))->orderBy('from','asc')->first();

            $feesss                =  DB::table('fees')->where('tenure_id',$tenuresss->id)->where('start_amount','<',$caa[$view_apply_date[2]])
                                         ->orderBy('start_amount','desc')->first();


            $penalty_amount  = ($feesss->$column_names*$abc[0]->percentage)/100;

            $penalty_changed_water         = $penalty_amount;
            $penalty_changed_air           = $penalty_amount;            
          }         
         
            



            


            
           
                
                
               

               
              

               

               

                
               //dd($abc);

         if($previous_fresh_data!=null && $previous_fresh_data->industry_category!=$new_category_id){
            $category       = Category::find($new_category_id);
            $last_days      = $last_year."-".$category->tenure_to;
            $arrear_changed               = 'Y';
            // dd($previous_fresh_data);
         }
         $column_name    = $category->fee_column;
         $current_tenure_fee  =  $fees-> $column_name;



         // dd( $last_days);

        

        

         $column_name    = $category->fee_column;
         $db_from        = (int) str_replace('-','',$category->tenure_from);
         $db_to          = (int) str_replace('-','',$category->tenure_to);


         $table_details  =  [];
         $total_fee      =  0;
         $total_loop      = 1;
         $rem_days        = 0;
         $selected_year  = $applied_date_a[2];
         $from_date      = $from_dates = $applied_date_a[2]."-".$applied_date_a[1]."-".$applied_date_a[0];
         $last_date      = date('Y-m-d',strtotime($from_dates. ' + '.$durations.' years'));
         for ($i=0;$i<$duration+1;$i++){
            if($i==0){
              $to_date            = $selected_year."-".$category->tenure_to;
               if(strtotime($from_date)>strtotime($to_date)){
                $selected_year     = $selected_year+1;
                $to_date            = $selected_year."-".$category->tenure_to;
                $i=$i+1;
              }
            }else{
              if($duration==$i+1){
               $selected_year     = $selected_year+1;
                $to_date            = $selected_year."-".$category->tenure_to;
              }else{
                $selected_year     = $selected_year+1;
                $to_date            = $selected_year."-".$category->tenure_to;
              }
              
            }
           
        

          $days            = floor((strtotime($to_date) - strtotime($from_date)) / 86000);
          if($days==366){
            $days = 365;
          }
         
          $final_fee       = $fee->$column_name;
          $final_fee_air   = $final_fee;
          $final_fee_water = $final_fee;
          $new_noc_fee   = 0;
          if($i==0 && isset($caa)){
            $new_noc_fee = $caa[$applied_date_a[2]]-$last_ca;
             $tenuress         =  Tenure::where('to','>=',$from_dates)->orderBy('from','asc')->first();
             $feess                =  DB::table('fees')->where('tenure_id',$tenuress->id)->where('start_amount','<',$new_noc_fee)
                                         ->orderBy('start_amount','desc')->first();
                        $categoryss       = Category::find($new_category_id);
                        $column_namess    = $categoryss->fee_column;
                     
                        $new_noc_fee       =            $feess->$column_namess;

          }
            
         
          $one_day_fee = number_format((float)$final_fee/365, 2, '.', '');
          $final_fee1 = number_format((float)$one_day_fee*$days, 2, '.', '');
          if($days==365){
            $final_fee1 = $final_fee;
          }
          $total_fee = $total_fee+$final_fee1;
          $table_details[] = [
                                  'sr_no'=>$sr++,'from_date'=>date('d/m/Y',strtotime($from_date)),
                                  'to_date'=>date('d/m/Y',strtotime($to_date)),'days'=>$days,
                                  'ca_amount'=>$current_ca_amount,'cte_fees'=>$final_fee1,
                                  'air_amount'=>$final_fee1,'water_amount'=>$final_fee1,'new_noc_fee'=>$new_noc_fee
                                ];
          $from_date         = date('Y-m-d', strtotime($to_date. ' + 1 days'));
         }
        
         $details  = [
                      'industry_name'=>$industry->industry_name,'industry_type'=>$category->category_name,
                      'tenure_from'=>date('d/F',strtotime("2021-".$category->tenure_from)),'tenure_to'=>date('d/F',strtotime("2021-".$category->tenure_to)),'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),'ca_changed'=>$ca_changed,'new_cte_fee'=>$final_fee,'current_tenure_fee'=>$current_tenure_fee,
                      'applied_date'=>$apply_date,'table_details'=>$table_details,'arrear_changed'=>$arrear_changed,
                      'total_fee'=>$total_fee,'ca_amount'=>$current_ca_amount,'concent_type'=>$concent_type,
                      'final_fee'=>$total_fee,'deposited_air_amount'=>$deposited_air_amount,'category_changed'=>$category_changed,'industry_noc'=>$industry_noc,'penalty_changed'=>$penalty_changed,
                      'deposited_water_amount'=>$deposited_water_amount,'total_water_fee'=>$total_fee,'total_air_fee'=>$total_fee,'previous_data'=>$previous_all_data,'deposited_amount'=>0,'penalty_changed_air'=>$penalty_changed_air,'penalty_changed_water'=>$penalty_changed_water
                  ];
         $response = ['status'=>'success','message'=>'check details','data'=>$details];
         if($request->action=='save'){
          $insert = [
                     'industry_id'=>$industry_id,'industry_category'=>$industry_category,'current_ca'=>$current_ca_amount,
                     'applied_on'=>$current_applied_date,'deposited_air_amount'=>$deposited_air_amount,
                     'deposited_water_amount'=>$deposited_water_amount,'duration'=>$duration,'concent_type'=>$concent_type,
                     'industry_noc'=>$industry_noc,'total_fee'=>$total_fee,'fee_type'=>'fresh','final_fee'=>$total_fee,
                     'response_data'=>json_encode($details),'created_at'=>date('Y-m-d H:i:s'),'valid_upto'=>$to_date
                   ];
            DB::table('report_cto')->insert($insert);
            $response = ['status'=>'failure','message'=>'Data Saved successfully','data'=>$details];
         }
      }          
      if($response['status']=='failure'){
        return "<span class='text text-danger'>".$response['message']."</span>";
      }else{
        // dd($response);
        return view('Admin.extension_cto_calculation_page',$response);
      }    
   }
























   public function company_financial_api(){
   	return view('Admin.company_financial_api');
   } 

   public function company_financial_data(){

   	 return view('Admin.company_financial_data');
   }

   public function company_financial_api_submit($symbol){
   	    if(empty($symbol)){
   			$return = ['status'=>'failure','message'=>'please enter company financial symbol'];
   	    }else{
   		    $response = Http::get("https://api.gurufocus.com/public/user/64759ed1ea6363472b67ec8f7e507b0a:7ba02ed2a4a0012d6cebe190ff038850/stock/$symbol/financials");
   		    $response = $response->json();
   		 //    if($response['error']){
	   		// 	$return = ['status'=>'failure','message'=>$response['error']];
	   		// }
   	    }   		
   		return response()->json($response);
   }

   public function profile_edit(){
   	 echo "123";
   }

   public function user_list(){
        $users = DB::table('admins')
                  ->join('roles', 'admins.role', '=', 'roles.id')
                  ->select('admins.*','roles.role_name as role_name')
                  ->get();
        return view('Admin.user_list',['users'=>$users]);
   }

   public function user_add(){
      $roles = Role::all();
      return view('Admin.user_add',['roles'=>$roles]);
   }

   public function user_add_submit(Request $request){
        $validator = Validator::make(request()->all(), [
             'first_name'         => 'required',
             'last_name'          => 'required',
             'email'              => 'required|unique:admins,email',
             'role'               => 'required|exists:roles,id',
             'username'           => 'required|unique:admins,username',
             'password'           => 'required',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $roles  = ['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'role'=>$request->role,'username'=>$request->username,'password'=>$request->password];
            DB::table('admins')->insert($roles);
            return redirect('/admin/user-list')->with(['error_message'=>'User created successfully']);
        }
   }

   public function user_edit($user_id){
      $roles = Role::all();
      $user = Admin::find($user_id);
      return view('Admin.user_edit',['roles'=>$roles,'user'=>$user]);
   }

   public function user_edit_submit(Request $request){
        $validator = Validator::make(request()->all(), [
             'first_name'         => 'required',
             'last_name'          => 'required',
             'email'              => 'required|exists:admins,email',
             'role'               => 'required|exists:roles,id',
             'username'           => 'required|exists:admins,username',
             'password'           => 'required',
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $roles  = ['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'role'=>$request->role,'username'=>$request->username,'password'=>$request->password];
            DB::table('admins')->where('id', $request->user_id)->update($roles);
            return redirect('/admin/user-list')->with(['error_message'=>'User updated successfully']);
        }
   }

   public function user_delete($user_id){
            DB::table('admins')->where('id', $user_id)->delete();
            return redirect('/admin/user-list')->with(['error_message'=>'User removed successfully']);
   }
}
