<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 1/19/19
 * Time: 3:11 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Euler;
use GuzzleHttp;
use Laravel\Lumen\Routing\Controller as BaseController;

class CalculatorController extends BaseController
{
    protected $botName = 'Bot';

    function index(Request $request){

        $payload = $request->json();

        if ($payload->get('type') === config('slack.verificationKey')) {
            return $payload->get('challenge');
        }
        else if ($payload->get('type') === config('slack.eventCallback')) {
            $event = $payload->get('event');
            $question = $event['text'];
            $channel =  $event['channel'];
            //TODO : add some validation related to these fields as well.
            /*
             * this subtype check is done to avoid infinite loop as it checks another message and repeats itself.
             * */
            $answer = "Please Enter a number between 0 and 1000";
            if(!isset($event['subtype'])){
                $httpClient = new GuzzleHttp\Client();

                if(is_numeric($question) && $question > 0 && $question < 1000 ){
                    $answer = Euler\Problem1::calculate($question);
                }
                else{
                    $answer = "Please Enter a number between 0 and 1000";
                }
                try{
                    $response = $httpClient->post(config('slack.postMessage'), [
                        'headers' => ['Accept' => 'application/json'],
                        'form_params' => [
                            'token' => env('SLACK_BOT_TOKEN'),
                            'text' =>  $answer,
                            'channel'=> $channel,
                            'as_user'=>false,
                            'username'=> $this->botName
                        ]
                    ]);
                }
                catch (GuzzleHttp\Exception\ClientException $exception){
                    $responseBody = $exception->getResponse()->getBody(true);
                    LOG::debug($responseBody);
                }

            }
            return response()->json(['answer' => $answer]);
        }
    }
}