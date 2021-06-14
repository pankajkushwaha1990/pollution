<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Industry;
use App\Models\Tenure;
use App\Models\Fee;
use App\Models\Category;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class AdminController extends Controller{
   public function login(){
   	 return view('Admin.login');
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
        return view('Admin.fresh_cte_add',['industry_list'=>$industry_list]);
    }

    public function industry_id_to_category($industry_id){
        if(empty($industry_id)){
          $response = ['status'=>'failure','message'=>'please select industry'];
        }else{
          $industry_result = Industry::find($industry_id);
          $result = Category::find($industry_result->industry_category);
          $response = ['status'=>'success','message'=>'category fetched successfully','data'=>$result->category_name];
        }       
      return response()->json($response);
   }

   public function fee_calculate(Request $request){
      $industry_id       = $request->industry_id;
      $current_ca_amount = $request->current_ca_amount;
      $applied_date      = $request->applied_date;
      $duration          = $request->duration;
      $deposited_amount  = $request->deposited_amount;
      $deposited_date    = $request->deposited_date;
      if(empty($industry_id)){
         $response = ['status'=>'failure','message'=>'Please select industry'];
      }elseif(empty($current_ca_amount)){
         $response = ['status'=>'failure','message'=>'Please enter current CA amount'];
      }elseif(empty($applied_date)){
         $response = ['status'=>'failure','message'=>'Please select applied date'];
      }elseif(empty($duration)){
         $response = ['status'=>'failure','message'=>'Please enter duration'];
      }else{
         $sr             = 1;
         $industry       = Industry::find($industry_id);
         $applied_date_a = explode('/',$applied_date);//d/m/Y
         $applied_date   = $applied_date_a[2]."-".$applied_date_a[1]."-".$applied_date_a[0]; //Y-m-d
         $category       = Category::find($industry->industry_category);
         $tenure         = Tenure::all()->last();
         $fee            = DB::table('fees')->where('end_amount', '<=',$current_ca_amount)->first();
         $column_name    = $category->fee_column;
         $table_details  = [];
         $total_fee      = 0;
         for ($i=0;$i<$duration;$i++){ 
            $from_date       = $applied_date_a[2]+$i."-".$applied_date_a[1]."-".$applied_date_a[0];
            $to_date         = date('Y-m-d', strtotime($from_date. ' + 364 days'));
            if(date('L', strtotime($to_date))){
              $to_date         = date('Y-m-d', strtotime($to_date. ' + 1 days'));
            }
            $to_date1        = date('Y-m-d', strtotime($from_date. ' + 365 days'));
            $days            = floor((strtotime($to_date1) - strtotime($from_date)) / 86400);
            $final_fee       = $fee->$column_name;
            if($sr!=1){
                  $final_fee = $fee->$column_name/2;
            }
            $total_fee = $total_fee+$final_fee;
             $table_details[] = [
                                  'sr_no'=>$sr++,'from_date'=>date('d/m/Y',strtotime($from_date)),
                                  'to_date'=>date('d/m/Y',strtotime($to_date)),'days'=>$days,
                                  'ca_amount'=>$request->current_ca_amount,'cte_fees'=>$final_fee
                                ];
         }
         $details  = [
                      'industry_name'=>$industry->industry_name,'industry_type'=>$category->category_name,
                      'tenure_from'=>date('d/F',strtotime("2021-".$category->tenure_from)),'tenure_to'=>date('d/F',strtotime("2021-".$category->tenure_to)),'duration'=>$request->duration,'industry_category'=>ucfirst(strtok($category->fee_column, '_')),
                      'applied_date'=>$request->applied_date,'table_details'=>$table_details,
                      'deposited_date'=>$deposited_date,'deposited_amount'=>$deposited_amount,'total_fee'=>$total_fee,
                      'final_fee'=>$total_fee-$deposited_amount
                  ];
         $response = ['status'=>'success','message'=>'check details','data'=>$details];
      }          
      return response()->json($response);
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
