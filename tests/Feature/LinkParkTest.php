<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkParkTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    //this tests the user linking to a park post request
    public function test_UserLinkPark()
    {
        $response = $this->post('/user/1/associate', ['type' => 'Park', 'id' => '1']);
        $responsedata = $response->getContent();
        $response->assertSee(200);
    }

    //this tests the user linking to a breed post request
    public function test_UserLinkBreed()
    {
        $response = $this->post('/user/1/associate', ['type' => 'Breed', 'id' => '8']);
        $responsedata = $response->getContent();
        $response->assertSee(200);
    }

     //this tests the user linking to a breed post request
     public function test_ParkLinkBreed()
     {
         $response = $this->post('/park/1/associate', ['type' => 'Breed', 'id' => '10']);
         $responsedata = $response->getContent();
         $response->assertSee(200);
     }
}
