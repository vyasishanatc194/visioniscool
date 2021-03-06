<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $base_dir = 'assets/collections_old/';
        $collection_data = [];
        //$states = array_diff(scandir($base_dir), ['..', '.', '.DS_Store']);
        
        // foreach ($states as $state) {
        //     echo $state.'<br/>';
        //     $stateDb = State::where('state_name',$state)->first();
        //     if(!$stateDb){
        //         $stateDb = new State;
        //         $stateDb->state_name = $state;
        //         $stateDb->save();
        //     }
            
        //      $cities = array_diff(scandir($base_dir . $state), ['..', '.', '.DS_Store']);
            
        //      foreach ($cities as $city) {
        //         echo $city.'<br/>';
        //         $cityDb = City::where('city_name',$city)->first();
        //         if(!$cityDb){
        //             $cityDb = new City;
        //             $cityDb->city_name = $city;
        //             $cityDb->state_id = $stateDb->id;
        //             $cityDb->save();
        //         }
                
        //         $images = array_diff(scandir($base_dir . $state . '/' . $city), ['..', '.', '.DS_Store']);
                
        //         foreach ($images as $image) {
        //             if (substr_count($image, 'mobile__')) {
        //                 $imageCreate = Image::create(['city_id'=>$cityDb->id]);
        //                 $path = \config('constant.imagebasePath').'/'.$state. '/'.$city;
        //                 $path = \config('constant.imagebasePath').$state. '/'.$city;
        //                 $old = umask(0);
        //                 $fullpath = public_path('/').$path.'/';
        //                 \File::exists($fullpath) or mkdir($path, 0777, true);
        //                 umask($old);
        //                 copy (public_path('/').$base_dir . $state . '/' . $city . '/' . $image,$fullpath . $image);
        //                 $requestData = array();
        //                 $requestData['refe_file_path'] = $path;
        //                 $requestData['refe_file_name'] = $image;
        //                 $requestData['refe_file_real_name'] = $image;
        //                 $requestData['refe_field_id'] = $imageCreate->id;
        //                 $requestData['refe_table_field_name'] = 'image';
        //                 $requestData['refe_type'] = 'mobile_image';
        //                 $refe = \App\Refefile::create($requestData);
        //                 $collection_data[$state . '/' . $city]['mobile'][] = $base_dir . $state . '/' . $city . '/' . $image;
        //             } else {
        //                 $imageCreate = Image::create(['city_id'=>$cityDb->id]);
        //                 $path = \config('constant.imagebasePath').$state. '/'.$city;
        //                 $old = umask(0);
        //                 $fullpath = public_path('/').$path.'/';
        //                 \File::exists($fullpath) or mkdir($path, 0777, true);
        //                 umask($old);
        //                 //dd(public_path('/').$base_dir . $state . '/' . $city . '/' . $image);
        //                 copy (public_path('/').$base_dir . $state . '/' . $city . '/' . $image,$fullpath . $image);
        //                 //\File::move( $fullpath, public_path('/').$base_dir . $state . '/' . $city . '/' . $image);
        //                 $requestData = array();
        //                 $requestData['refe_file_path'] = $path;
        //                 $requestData['refe_file_name'] = $image;
        //                 $requestData['refe_file_real_name'] = $image;
        //                 $requestData['refe_field_id'] = $imageCreate->id;
        //                 $requestData['refe_table_field_name'] = 'image';
        //                 $requestData['refe_type'] = 'desktop_image';
        //                 $refe = \App\Refefile::create($requestData);
        //                 $collection_data[$state . '/' . $city]['desktop'][] = $base_dir . $state . '/' . $city . '/' . $image;
        //             }
        //         }
        //     }
        // }
        
        $statesDB = State::all();
        
        
        return view('welcome',compact('statesDB'));
    }

    public function getImage(Request $request)
    {
        $device = $request->device;
        if(Image::where('sort',0)->get()->count() > 0){
            \DB::statement("UPDATE `images` SET `sort` = images.id");
        }
        $images = Image::where('city_id',$request->city)->with(['getRefFile' => function($query) use ($device){
            $query->where('refe_type', $device.'_image');
        }])->orderBy('sort','ASC')->get()->pluck('getRefFile.file_url');
        if($images->count() > 0){
            $i = (array)$images;
            $imageResponse = [];
            foreach($i as $value){
                $imageResponse = $value;
            }
            $result['message'] = 'Image Found';
            $result['code'] = 200;
            $result['data'] = array_filter($imageResponse);
        }else{
            $result['message'] = 'Images not found';
            $result['code'] = 400;
            $result['data'] = [];
        }
        return response()->json($result, $result['code']);
    }

    public function newsLetter(Request $request){
        
        $curl = curl_init();
        $url = "https://api.constantcontact.com/v2/contacts?action_by=ACTION_BY_VISITOR&api_key=".env('CONSTANT_CONTACT_API_KEY', 'j6jb65ggtha5cyjfhck2xxqt');
        $dataArray = [
            "email_addresses" => ["email_address"=>$request->email],
            "status"=> "ACTIVE"
        ];
        $dataArray = array (
            'status' =>'ACTIVE',
            'lists' => array( array( "id"=>'1350487760' ) ),
            'email_addresses' => array( array( 'status' => 'ACTIVE' , 'email_address' => $request->email ) ),
        );
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>json_encode($dataArray),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ". env('CONSTANT_CONTACT_API_TOKEN', 'j6jb65ggtha5cyjfhck2xxqt'),
            "Content-Type: application/json"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function thankyou(Request $request){
        return view('thankyou');
    }

    
}
