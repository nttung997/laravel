<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\CurlHelper;
use Illuminate\Support\Facades\Storage;

class TtsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return asset('storage/'.$path);
        // return view('tts',['audio'=>$path]);
    }
    function decodeBase64($audio){
		$name ='audio'.time().'.wav';
        $path = Storage::disk('public')->put($name, base64_decode($audio));
        return $name;
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
    public function destroy($id)
    {
        //
    }
}
