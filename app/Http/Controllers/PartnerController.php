<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function partner_list(){
        $roles =  DB::table('partners')
                  ->join('admins', 'partners.created_by', '=', 'admins.id')
                  ->select('partners.*','admins.first_name as admin_first_name')
                  ->get();
        return view('Admin.partner_list',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function partner_add(){
        return view('Admin.partner_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function partner_add_submit(Request $request){
        $validator = Validator::make(request()->all(), [
             'company_name'         => 'required',
             'partner_country'      => 'required',
             'partner_email_1'      => 'required',
             'partner_phone_1'      => 'required',
             'first_name'      => 'required',
             'last_name'      => 'required',
             'contact_email_1'      => 'required',
             'contact_phone_1'      => 'required',
             'contact_job_title'      => 'required',
             'contact_department'      => 'required',
             'partner_type'      => 'required',
             'partner_address_1'      => 'required',
             'partner_state'      => 'required',
             'partner_zipcode'      => 'required',
             'billing_name'      => 'required',
             'partners_country'      => 'required'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $roles  = [
                'company_name'=>$request->company_name,'partner_country'=>$request->partner_country,
                'partner_email_1'=>$request->partner_email_1,'partner_email_2'=>$request->partner_email_2,
                'partner_email_3'=>$request->partner_email_3,'partner_phone_1'=>$request->partner_phone_1,
                'partner_phone_2'=>$request->partner_phone_2,'partner_phone_3'=>$request->partner_phone_3,
                'partner_url'=>$request->partner_url,'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,'contact_email_1'=>$request->contact_email_1,
                'contact_email_2'=>$request->contact_email_2,'contact_phone_1'=>$request->contact_phone_1,
                'contact_phone_2'=>$request->contact_phone_2,'contact_job_title'=>$request->contact_job_title,
                'contact_department'=>$request->contact_department,'contact_skype_id'=>$request->contact_skype_id,
                'partner_type'=>$request->partner_type,'partner_address_1'=>$request->partner_address_1,
                'partner_address_2'=>$request->partner_address_2,'partner_state'=>$request->partner_state,
                'partner_zipcode'=>$request->partner_zipcode,'partners_country'=>$request->partners_country,
                'tax_id_number'=>$request->tax_id_number,'status'=>0,'created_at'=>date('Y-m-d H:i:s'),
                'created_by'=>$request->session()->get('admin_id'),'billing_name'=>$request->billing_name,
            ];
            DB::table('partners')->insert($roles);
            return redirect('/admin/partner-list')->with(['error_message'=>'Partner created successfully']);
        }
    }

    public function partner_change_status($id,$status){
        DB::table('partners')->where('id',$id)->update(['status'=>$status]);
        return redirect('/admin/partner-list')->with(['error_message'=>'Partner status changed successfully']);
    }

    public function partner_edit($partner_id){
        $partner = Partner::find($partner_id);
        return view('Admin.partner_edit',['partner'=>$partner]);
    }

    public function partner_edit_submit(Request $request){
        $validator = Validator::make(request()->all(), [
            'company_name'         => 'required',
             'partner_country'      => 'required',
             'partner_email_1'      => 'required',
             'partner_phone_1'      => 'required',
             'first_name'      => 'required',
             'last_name'      => 'required',
             'contact_email_1'      => 'required',
             'contact_phone_1'      => 'required',
             'contact_job_title'      => 'required',
             'contact_department'      => 'required',
             'partner_type'      => 'required',
             'partner_address_1'      => 'required',
             'partner_state'      => 'required',
             'partner_zipcode'      => 'required',
             'billing_name'      => 'required',
             'partners_country'      => 'required'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }else{
            $roles  = [
                'company_name'=>$request->company_name,'partner_country'=>$request->partner_country,
                'partner_email_1'=>$request->partner_email_1,'partner_email_2'=>$request->partner_email_2,
                'partner_email_3'=>$request->partner_email_3,'partner_phone_1'=>$request->partner_phone_1,
                'partner_phone_2'=>$request->partner_phone_2,'partner_phone_3'=>$request->partner_phone_3,
                'partner_url'=>$request->partner_url,'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,'contact_email_1'=>$request->contact_email_1,
                'contact_email_2'=>$request->contact_email_2,'contact_phone_1'=>$request->contact_phone_1,
                'contact_phone_2'=>$request->contact_phone_2,'contact_job_title'=>$request->contact_job_title,
                'contact_department'=>$request->contact_department,'contact_skype_id'=>$request->contact_skype_id,
                'partner_type'=>$request->partner_type,'partner_address_1'=>$request->partner_address_1,
                'partner_address_2'=>$request->partner_address_2,'partner_state'=>$request->partner_state,
                'partner_zipcode'=>$request->partner_zipcode,'partners_country'=>$request->partners_country,
                'tax_id_number'=>$request->tax_id_number,
                'created_by'=>$request->session()->get('admin_id'),'billing_name'=>$request->billing_name,
            ];
            DB::table('partners')->where('id', $request->partner_id)->update($roles);
            return redirect('/admin/partner-list')->with(['error_message'=>'Partner updated successfully']);
        }
   }

   public function partner_delete($user_id){
            DB::table('partners')->where('id', $user_id)->delete();
            return redirect('/admin/partner-list')->with(['error_message'=>'Partner removed successfully']);
   }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        //
    }
}
