<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\State;
use App\City;
use App\Image;
class GallaryController extends Controller
{
    public function datatableData(Request $request)
    {
        $search = $request->search;
        $record = Image::with('getAllRefFile','getCity')->get();
        return Datatables::of($record)->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gallary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('admin.gallary.create',compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->except('image');
        $city = City::where('id', $data['selectedCity'])->first();
        if($city){
            $image = Image::create(['city_id' => $data['selectedCity']]);
            $path = \config('constant.imagebasePath').'/'.$city->getState->state_name. '/'.$city->city_name;
            
            uplodeFile($request->file('image'),$path,'image',$image->id,'desktop_image');
            uplodeFile($request->file('mobile_image'),$path,'image',$image->id,'mobile_image');
            \Session::flash('flash_success',trans('common.responce_msg.record_created_succes'));
            return redirect('admin/gallary');
        }else{
            Session::flash('flash_error',trans('common.responce_msg.city_not_valid'));
           return redirect()->back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $result = array();
        $ob = Image::where("id",$id)->first();
        
        if($ob){
            if($ob->getAllRefFile){
                foreach($ob->getAllRefFile as $refeFile)
                if(file_exists($refeFile->file_path)){
                    unlink($refeFile->file_path);
                }
                $refeFile->delete();
            }
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
            return redirect('admin/gallary');
        }
    }

    public function updateSorting(Request $request){
        $imageId = $request->imageId;
        $oldSort = $request->oldSort;
        $newSort = $request->newSort;
        if($oldSort < $newSort){
            Image::whereBetween('sort', [$oldSort,$newSort])->where('id','!=',$imageId)->decrement('sort', 1);
        }else{
            Image::where('id','!=',$imageId)->whereBetween('sort', [$newSort,$oldSort])->whereOr('sort','=',$newSort)->increment('sort', 1);
        }
        Image::where('id',$imageId)->update(['sort'=> $newSort ]);
        //update(['sort' => 'images']);
        $result['message'] = \Lang::get('common.responce_msg.record_updated_succes');;
        $result['code'] = 200;
        return response()->json($result, $result['code']);
    }
}
