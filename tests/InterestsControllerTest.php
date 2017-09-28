<?php

use App\Http\Controllers\InterestsController;

class InterestsControllerTest extends TestCase
{
    protected $interestController;

    public function setUp(){
        $this->interestController = new InterestsController;
    }

    public function testGetAllAcademicInterests_return_all_academic_interests(){
        $data = $this->interestController->getAllAcademicInterests();
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],3);
        $this->assertEquals(count($content['interests']),$content['count']);
    }
}