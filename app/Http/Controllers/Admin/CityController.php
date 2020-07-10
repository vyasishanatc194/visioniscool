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
class CityController extends Controller
{
    public function index(){
        $state = State::latest()->get();
         return view('admin.city.index',compact('state'));
    }

    public function datatable(Request $request)
    {
        $city = City::leftJoin('states','states.id','cities.state_id')->select('cities.*','states.state_name')->latest()->get();

        return Datatables::of($city)
            ->make(true);
    }

    

    public function store(Request $request)
    {
        
        
         $requestData = $request->except(['_token','city_id']);
        //$requestData['status'] = isset($requestData['status'])?1:0;
     	
        $state = City::create($requestData);
        
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
            'city_name'=>['required','max:191','regex:/^[a-z0-9 .\-]+$/i'],
        ];

        $this->validate($request, $rules,[
            'city_name.required' => 'The City field is required'
        ]);

        $requestData = $request->except(['_method','_token','city_id']);
        //$requestData['status'] = isset($requestData['status'])?1:0;
        
        $state = City::where('id',$id)->update($requestData);
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
        $city = City::find($id);

        $city->delete();

        if($request->has('from_index')){
            $message = "City Deleted !!";

            return response()->json(['message' => $message],200);
        }else{
            Session::flash('flash_success', 'City deleted!');

            return redirect('admin/city');
        }
    }
}
?>