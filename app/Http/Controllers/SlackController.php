<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class SlackController extends BaseController
{
    function login(Request $request){
            return redirect()->to(config('slack.authorize').http_build_query(
                    [
                        'scope'=>'im:history',
                        'client_id'=>env('SLACK_CLIENT_ID'),
                        'redirect_uri'=>env('SLACK_REDIRECT_URI')
                    ]
            ));

    }

    function connect(Request $request){
            $httpClient = \GuzzleHttp\Client();
            $response = $httpClient->post(config('slack.access'), [
                'headers' => ['Accept' => 'application/json'],
                'form_params' => [
                    'client_id' => env('SLACK_KEY'),
                    'client_secret' => env('SLACK_SECRET'),
                    'code' => $_GET['code'],
                    'redirect_uri' => env('SLACK_REDIRECT_URI'),
                ]
            ]);
            $bot_token = json_decode($response->getBody());
            print_r($bot_token);
            // Get KEY access_token to .env SLACK_TOKEN=xoxp-527426979526-526007111762-527277136912-2549eed262f1131313b14c52b16ce462
    }
}
