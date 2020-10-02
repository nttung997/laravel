<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\CurlHelper;

class TtsController extends Controller
{
    function decodeBase64($audio){
		$name ='audio'.time().'.wav';
        $path = Storage::disk('public')->put($name, base64_decode($audio));
        return $name;
    }

    function callApi(Request $request){
        $key = 'AIzaSyAa8yy0GdcGPHdtD083HiGGx_S0vMPScDM';
		$data = [
		   	"input" => [
				"text" => $request->text
			], 
		   	"voice" => [
				"languageCode" => "vi-VN", 
				"name" => "vi-VN-Wavenet-A" 
			], 
		   	"audioConfig" => [
		       "audioEncoding" => "LINEAR16", 
		       "pitch" => 1, 
		       "speakingRate" => 1 
	    	]
	    ];

		$headers = [
			'x-origin'	=>	'https://explorer.apis.google.com',
			'content-type'	=>	'application/json'
		];

		$url = 'https://content-texttospeech.googleapis.com/v1/text:synthesize?&alt=json&key='. $key;

        $response = CurlHelper::post($url, json_encode($data), $headers);

		$result = json_decode($response->getBody()->getContents(), true);
		// $disk = Storage::disk('public');
		// $result['audioContent'] = $disk->get('audio.txt');
		
        $path = $this->decodeBase64($result['audioContent']);
        return view('tts',['audio'=>$path]);
	}
	
	function index(){
		return view('tts');
	}
}
