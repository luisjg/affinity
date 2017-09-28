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
    public function testGetAllPersonsInterests_returns_all_persons_interests(){

        $data = $this->interestController->getAllPersonsInterests($this->validEmail);
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],7);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    public function testGetAllPersonsInterests_throws_NotFoundHttpException(){
        $this->setExpectedException(NotFoundHttpException::class);
        $this->interestController->getAllPersonsInterests($this->invalidEmail);
    }
}
