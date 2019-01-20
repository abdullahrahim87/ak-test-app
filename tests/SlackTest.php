<?php
/**
 * Created by PhpStorm.
 * User: abdullah
 * Date: 1/20/19
 * Time: 3:59 AM
 */

class SlackTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }


    public function testCheckChallenge(){
        $response = $this->json('POST', '/calculate', ['token' => 'Jhj5dZrVaK7ZwHHjRyZWjbDl', 'challenge'=>'sdf']);
        $response->assertResponseStatus(200);
    }


    /*
     *
     * This is to test whether Slack verification is done or not
     * see https://api.slack.com/events/url_verification for more information.
     * */

    public function testCheckChallengeOutput(){
        $response = $this->json('POST','/calculate', ['token' => 'Jhj5dZrVaK7ZwHHjRyZWjbDl', 'challenge'=>'sdf',"type"=> "url_verification"]);

        $this->assertEquals('sdf',$response->response->getContent());
    }

    /*
     * Testing the calculation
     * */
    public function testCalculation(){

        $answer = App\Euler\Problem1::calculate(10);
        $this->assertEquals((3+5+6+9), $answer);
    }

    public function testCalculatedResults(){
        $response = $this->json('POST','/calculate', ['token' => 'Jhj5dZrVaK7ZwHHjRyZWjbDl', 'event'=>["text"=>"10", "channel"=>"ADSFA"],"type"=> "event_callback"]);
        $response->seeJson(['answer'=>(3+5+6+9)]);
    }


    //Validation check for message if a non number or number greater than 1000 is sent it will prompt user to enter a number.

    public function testValidateResults(){
        $response = $this->json('POST','/calculate', ['token' => 'Jhj5dZrVaK7ZwHHjRyZWjbDl', 'event'=>["text"=>"aksdfjk", "channel"=>"ADSFA"],"type"=> "event_callback"]);
        $response->seeJson(['answer'=>"Please Enter a number between 0 and 1000"]);
    }
}