<?php

use App\Http\Controllers\InterestsController;

class InterestsControllerTest extends TestCase
{
    protected $interestController;

    public function setUp(){
        $this->interestController = new InterestsController;
        }
    public function testGetAllResearchInterest_returns_all_research_interests(){
        $this->interestController = new InterestsController;
        $data = $this->interestController->getAllResearchInterests();
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],1307);
        $this->assertEquals(count($content['interests']),$content['count']);
    }
}
