<?php

use App\Http\Controllers\InterestsController;

class InterestsControllerTest extends TestCase
{
    protected $interestController;

    public function setUp(){
        $this->interestController = new InterestsController;
    }

    public function testGetAllPersonalInterests_return_all_personal_interests(){
        $this->interestController = new InterestsController;
        $data = $this->interestController->getAllPersonalInterests();
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],511);
        $this->assertEquals(count($content['interests']),$content['count']);
    }
}
