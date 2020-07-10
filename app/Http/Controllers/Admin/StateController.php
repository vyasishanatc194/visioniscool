<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use DataTables;

use App\User;
use App\State;
use App\City;
class StateController extends Controller
{
    public function index(){
         return view('admin.state.index');
    }

    public function datatable(Request $request)
    {
        $state = State::latest()->get();

        return Datatables::of($state)
            ->make(true);
    }

    public function create(Request $request)
    {
        return view('admin.state.create');
    }

    public function store(Request $request)
    {
        
        
         $requestData = $request->except(['_token','state_id']);
        //$requestData['status'] = isset($requestData['status'])?1:0;
     	
        $state = State::create($requestData);
        
         if($state){
            $result['message'] = \Lang::get('common.responce_msg.record_updated_succes');
            $result['code'] = 200;
        }else{
            $result['message'] = \Lang::get('common.responce_msg.something_went_wrong');
            $result['code'] = 400;
        }
         return response()->json($result, $result['code']);
    }

    public function update(Request $request, $id)
    {
       $rules = [
            'state_name'=>['required','max:191','regex:/^[a-z0-9 .\-]+$/i'],
        ];

        $this->validate($request, $rules,[
            'state_name.required' => 'The State field is required'
        ]);

        $requestData = $request->except(['_method','_token','state_id']);
        //$requestData['status'] = isset($requestData['status'])?1:0;
        
        $state = State::where('id',$id)->update($requestData);
        if($state){
            $result['message'] = \Lang::get('common.responce_msg.record_updated_succes');
            $result['code'] = 200;
        }else{
            $result['message'] = \Lang::get('common.responce_msg.something_went_wrong');
            $result['code'] = 400;
        }
         return response()->json($result, $result['code']);
    }

    public function destroy(Request $request,$id)
    {
        $state = State::find($id);

        City::where('state_id',$id)->delete();

        $state->delete();

        if($request->has('from_index')){
            $message = "State Deleted !!";

            return response()->json(['message' => $message],200);
        }else{
            Session::flash('flash_success', 'State deleted!');

            return redirect('admin/state');
        }
    }
}
?>