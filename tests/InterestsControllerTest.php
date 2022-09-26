<?php

namespace Tests;

use App\Http\Controllers\InterestsController;

class InterestsControllerTest extends TestCase
{
    protected $interestController;
    protected $validEmail = 'nr_steven.fitzgerald@csun.edu';
    protected $invalidEmail = 'Invalid@Email.edu';

    public function setUp() :void {
        parent::setUp();
        $this->interestController = new InterestsController;
    }

    public function testGetAllInterests_return_all_interests()
    {
        $data = $this->call('GET', 'api/1.0/interests');
        $content = json_decode($data->content(), true);
        $this->assertEquals($content['count'], count($content['interests']));
        $this->assertEquals($content['status'],200);
    }
    public function testGetAllInterests_return_persons_interests()
    {
        $data = $this->call('GET', 'api/1.0/interests?email='.$this->validEmail);
        $content = json_decode($data->content(), true);
        $this->assertEquals($content['count'], count($content['interests']));
        $this->assertEquals($content['status'],200);
    }
    public function testHandleInterestType_returns_all_research_interests(){
        $this->markTestSkipped('must be revisited.');
        $data = $this->call('GET', 'api/1.0/interests/research');
        $this->assertEquals($this->interestController->getAllResearchInterests(),$data);
    }
    public function testHandleInterestType_returns_all_personal_interests(){
        $this->markTestSkipped('must be revisited.');
        $data = $this->call('GET', 'api/1.0/interests/personal');
        $this->assertEquals($this->interestController->getAllPersonalInterests(),$data);
    }
    public function testHandleInterestType_returns_all_academic_interests(){
        $this->markTestSkipped('must be revisited.');
        $data = $this->call('GET', 'api/1.0/interests/academic');
        $this->assertEquals($this->interestController->getAllAcademicInterests(),$data);
    }
    public function testHandleInterestType_returns_persons_research_interests(){
        $this->markTestSkipped('must be revisited.');
        $data = $this->call('GET', 'api/1.0/interests/research?email='.$this->validEmail);
        $this->assertEquals($this->interestController->getPersonsResearchInterests($this->validEmail),$data);
    }
    public function testHandleInterestType_returns_persons_personal_interests(){
        $this->markTestSkipped('must be revisited.');
        $data = $this->call('GET', 'api/1.0/interests/personal?email='.$this->validEmail);
        $this->assertEquals($this->interestController->getPersonsPersonalInterests($this->validEmail),$data);
    }
    public function testHandleInterestType_returns_persons_academic_interests(){
        $this->markTestSkipped('must be revisited.');
        $data = $this->call('GET', 'api/1.0/interests/academic?email='.$this->validEmail);
        $this->assertEquals($this->interestController->getPersonsAcademicInterests($this->validEmail),$data);
    }
    public function testHandleInterestType_invalid_type_throws_NotAcceptableHttpException(){
        $data=$this->call('GET', 'api/1.0/interests/invalid');
        $this->assertEquals($data->status(),406);
    }
    public function testHandleInterestType_invalid_type_with_email_throws_NotAcceptableHttpException(){
        $data=$this->call('GET', 'api/1.0/interests/invalid?email='.$this->validEmail);
        $this->assertEquals($data->status(),406);
    }
    public function testHandleInterestType_invalid_type_with_bad_query_throws_NotAcceptableHttpException(){
        $data=$this->call('GET', 'api/1.0/interests/research?invalid='.$this->validEmail);
        $this->assertEquals($data->status(),406);
    }
    public function testGetPersonsAcademicInterests_returns_all_persons_academic_interests()
    {
        $data = $this->interestController->getPersonsAcademicInterests($this->validEmail);
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetPersonsAcademicInterests_throws_NotFoundHttpException(){
        $this->interestController->getPersonsAcademicInterests($this->invalidEmail);
    }

    public function testGetPersonsPersonalInterests_returns_all_persons_personal_interests()
    {
        $data = $this->interestController->getPersonsPersonalInterests($this->validEmail);
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetPersonsPersonalInterests_throws_NotFoundHttpException(){
        $this->interestController->getPersonsPersonalInterests($this->invalidEmail);
    }

    public function testGetPersonsResearchInterests_returns_all_persons_research_interests(){
        $data = $this->interestController->getPersonsResearchInterests($this->validEmail);
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    public function testGetAllPersonsInterests_returns_all_persons_interests(){

        $data = $this->interestController->getAllPersonsInterests($this->validEmail);
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetPersonsResearchInterests_throws_NotFoundHttpException(){
       $this->interestController->getPersonsResearchInterests($this->invalidEmail);
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetAllPersonsInterests_throws_NotFoundHttpException(){
        $this->interestController->getAllPersonsInterests($this->invalidEmail);

    }
   public function testGetAllResearchInterest_returns_all_research_interests(){
        $data = $this->interestController->getAllResearchInterests();
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals(count($content['interests']),$content['count']);
    }

    public function testGetAllAcademicInterests_return_all_academic_interests()
    {
        $data = $this->interestController->getAllAcademicInterests();
        $this->assertEquals($data->status(), 200);
        $content = json_decode($data->content(), true);
        $this->assertEquals(count($content['interests']), $content['count']);
    }
  public function testGetAllPersonalInterests_return_all_personal_interests(){
        $data = $this->interestController->getAllPersonalInterests();
        $this->assertEquals($data->status(),200);
        $content = json_decode($data->content(),true);
        $this->assertEquals(count($content['interests']),$content['count']);
    }
}
