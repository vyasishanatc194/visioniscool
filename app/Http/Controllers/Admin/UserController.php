<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

use DataTables;
class UserController extends Controller
{
   
    public function datatableData()
    {
        $record = User::all();
        
        return Datatables::of($record)->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = array(
            'first_name' => 'required|min:2|max:150',
            'last_name' => 'required|min:2|max:150',
            'email' => 'required|email|unique:users|min:2|max:150', 
            'password' => 'required|min:6|max:25',
            'con-password' => 'required|min:6|max:25',
            "phone" => "required",
            "business_name" => "required",
            "location" => "required",
            "company_domain" => "required"
        );
		
        $this->validate($request,$rules,[],trans('common.user'));
        $alldata = $request->all();
        $data = $request->except(['password','con-password']);
        $data['password'] = bcrypt($request->password);
        $data['verification_code'] = randomNumber();
        $user = User::create($data);
        $userData = [
            "code" => $user->verification_code,
        ];
        // $this->mail('email.sendCode',$userData,$user->email, $user->full_name,\config('constant.mail.confirmationMail'));
        $this->templateMail(\config('constant.mailTemplateSendGrid.accountactivation'),$userData,$user->email, $user->full_name,\config('constant.mailSubject.confirmationMail'));
        $user->assignRole('userManager');
        \Session::flash('flash_success',trans('common.responce_msg.record_created_succes'));
        return redirect('admin/users');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where("id",$id)->first();

        if(!$user){
            Session::flash('flash_error',trans('common.responce_msg.data_not_found'));
            return redirect()->back();
        }
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where("id",$id)->first();
		
        if(!$user){
            Session::flash('flash_error',trans('common.responce_msg.data_not_found'));
            return redirect()->back();
        }
		
		return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $rules = array(
            'first_name' => 'required|min:2|max:150',
            'last_name' => 'required|min:2|max:150',
            'email' => 'required|email|min:2|max:150|unique:users,email,'.$id, 
            "phone" => "required",
            "business_name" => "required",
            "location" => "required",
            "company_domain" => "required"
        );
		
        $this->validate($request,$rules,[],trans('common.user'));
        $user = User::where("id",$id)->where("id","!=",1)->first();
        if(!$user){
            Session::flash('flash_error',trans('common.responce_msg.data_not_found'));
            return redirect()->back();
        }
        if ($user) {
            $data = $request->except('password','con-password');
            if($request->password !== ''){
                $data['password'] = bcrypt($request->password);
            }
            $user->update($data);
        }
        \Session::flash('flash_success', trans('common.responce_msg.record_updated_succes'));

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        $result = array();
        $ob = User::where("id",$id)->where("id","!=",\Auth::user()->id)->where("id","!=",1)->first();
        
        if($ob){
            $ob->delete();
            
			$result['message'] = \Lang::get('common.responce_msg.record_deleted_succes');;
            $result['code'] = 200;
        }else{
            $result['message'] = \Lang::get('common.responce_msg.you_have_no_permision_to_delete_record');;
            $result['code'] = 400;
        }


        if($request->ajax()){
            return response()->json($result, $result['code']);
        }else{
            Session::flash('flash_message',$result['message']);
            return redirect('admin/users');
        }
    }
}
