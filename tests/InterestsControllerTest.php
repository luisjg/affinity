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
    public function testGetPersonsPersonalInterests_returns_all_persons_personal_interests(){
        $data = $this->interestController->getPersonsPersonalInterests('nr_jeffrey.wiegley@csun.edu');
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals($content['count'],8);
        $this->assertEquals(count($content['interests']),$content['count']);
    }
    public function testGetPersonsPersonalInterests_throws_NotFoundHttpException(){
        $this->setExpectedException(NotFoundHttpException::class);
        $this->interestController->getPersonsPersonalInterests($this->invalidEmail);
    }
}