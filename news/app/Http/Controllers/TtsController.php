<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\CurlHelper;

class TtsController extends Controller
{
    function decodeBase64($audio){
        $time = time();
        Storage::disk('local')->put('audio'.$time.'.wav', base64_decode($audio));
        return 'audio'.$time.'.wav';
    }

    function callApi(Request $request){
        $key = 'AIzaSyAa8yy0GdcGPHdtD083HiGGx_S0vMPScDM';
		$data = [
		   	"input" => [
				"text" => 'một ông sao sáng'
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

        // $response = CurlHelper::post($url, json_encode($data), $headers);

		// $result = json_decode($response->getBody()->getContents(), true);
        $result['audioContent'] = Storage::disk('local')->get('audio.txt');
        $fileName = $this->decodeBase64($result['audioContent']);
        $audio_url = Storage::url($fileName);
        return view('audio',['audio'=>$audio_url]);
    }
}
