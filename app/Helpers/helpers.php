<?php




if(!function_exists('resApi')){

    function responseApi($data=null,$message=null,$custom_status=null,$http_res=200)
    {
        $status = is_array($data) ? sizeof($data)>0 : $data!=null;
        if ($message==null) {
            $message= ($status) ? 'Success.' : 'Server is busy. try again later.';
        }
    
        if ($custom_status != null) {
            $status = $custom_status;
            $response['status'] = $status??'false';
            $response['data'] = $data;
            $response['message'] = $message;
            return response()->json($response);
        }
    
        $response['status']     = $status;
        $response['data']       = $data;
        $response['message']    = $message;
        
        // header('Content-Type: application/json');
        return response()->json($response,$http_res);
        
    }

}

if(!function_exists('deep_array_message')){
    function deep_array_message($array){
        foreach ($array->messages() as $key => $value) {
            $message[]=$value[0];
        }

        return $message??null;
    }
}

if(!function_exists('uploadFiles')){
    function uploadFiles($files, $folder="", $name=null){
        $files_name = [];
        foreach ($files as $key => $file) {
            $extension = '.'.$file->getClientOriginalExtension();
            $file_name = $name!=null ? $name : md5(preg_replace("/[^a-zA-Z0-9\s]/","_",$file->getClientOriginalName()).time()).$extension;
            $dir = $folder != "" ? "/" . $folder : "/" .  $key;
            $file->move(public_path($dir),$file_name);
            $fullpath = $dir .'/'.$file_name;
            $files_name[$key] = $fullpath;
        }
        return $files_name;
    }
}

if(!function_exists('removeFiles')){
    function removeFiles($fileLocation){
        if(file_exists(public_path($fileLocation))){
            unlink(public_path($fileLocation));
        }
    }
}

if(!function_exists('defaultLatLng')){
    function defaultLatLng(){
        // lat lng monas
        $data['lat'] = "-6.175388775718806";
        $data['lng'] = "106.82718486295403";
        return $data;
    }
}
