<?php

use App\Http\Controllers\InterestsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InterestsControllerTest extends TestCase
{
    protected $interestController;
    protected $validEmail = 'nr_steven.fitzgerald@csun.edu';
    protected $invalidEmail = 'Invalid@Email.edu';

    public function setUp(){
        $this->interestController = new InterestsController;
    }

    public function testGetPersonsResearchInterests_returns_all_persons_research_interests(){
        $data = $this->interestController->getPersonsResearchInterests($this->validEmail);
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],7);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    public function testGetPersonsResearchInterests_throws_NotFoundHttpException(){
       $this->setExpectedException(NotFoundHttpException::class);
       $this->interestController->getPersonsResearchInterests($this->invalidEmail);
    }
}
