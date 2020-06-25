<?php 
function randomNumber(){
    return mt_rand(100000, 999999);
}

function randomString($strlength = 16){
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, $strlength);
}

function uplodeFile($file, $store_path, $refe_table_field_name, $ref_field_id, $type,$filename='')
{
	
		$real_name = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension();
		
		$imgexist = false; //\App\Refefile::where("refe_file_real_name",$real_name)->where("refe_field_id",$ref_field_id)->first();
		if (!$imgexist) {
			$path = $file->getPathName();
			$dir = public_path() . '/'.$store_path;
            $file->move($dir, $real_name);
            $file_url = $store_path;
			$requestData = array();
			$requestData['refe_file_path'] = $file_url;
			$requestData['refe_file_name'] = ($filename != '') ? $filename :$real_name;
			$requestData['refe_file_real_name'] = ($filename != '') ? $filename :$real_name;
			$requestData['refe_field_id'] = $ref_field_id;
			$requestData['refe_table_field_name'] = $refe_table_field_name;
			$requestData['refe_type'] = $type;
			$refe = \App\Refefile::create($requestData);
			return $refe;
		}else{
            return false;
        }
	
}

?>