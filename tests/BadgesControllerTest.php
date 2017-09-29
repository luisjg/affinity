<?php
use App\Http\Controllers\BadgesController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

class BadgesControllerTest extends TestCase
{
    protected $badgesController;
    protected $validEmail = 'nr_alexandra.monchick@csun.edu';
    protected $validBadgeName = 'Teaching Conference Grant';
    protected $invalidEmail = "Imaginary.User@csun.edu";
    protected $invalidBadgeName = 'Not Real Badge Name';

    public function setUp(){
        $this->badgesController = new BadgesController;
    }

    public function testCheckIfBadgeNameExists_returns_true(){
        $data = $this->badgesController->checkIfBadgeNameExists($this->validBadgeName);
        $this->assertEquals(true, $data);
    }

    public function testCheckIfBadgeNameExists_throws_BadRequestHttpException(){
        $this->setExpectedException(NotFoundHttpException::class);
        $this->badgesController->checkIfBadgeNameExists($this->invalidBadgeName);
    }

    public function testGetAllBadges_returns_status_code_and_badge_count(){
        $data = $this->badgesController->getAllBadges(new Request());
        $content = json_decode($data->content(), true);
        $this->assertEquals('badges', $content['collection']);
        $this->makeAssertionsForStatusAndCount(200, 11, $content,'badges');
    }

    public function testCheckIfUserExists_returns_true(){
        $data = $this->badgesController->checkIfUserExists($this->validEmail);
        $this->assertEquals(true,$data);
    }

    public function testCheckIfUserExists_throws_NotFoundHttpException(){
        $this->setExpectedException(NotFoundHttpException::class);
        $this->badgesController->checkIfUserExists($this->invalidEmail);
    }

    public function testCheckPersonsBadge_returns_true(){
        $this->makeAssertionsForCheckPersonsBadge($this->validEmail, $this->validBadgeName, 200, true);
    }

    public function testCheckPersonsBadge_returns_false(){
        $badgeName = 'Learning-Centered Beck Grant';
        $this->makeAssertionsForCheckPersonsBadge($this->validEmail, $badgeName, 200, false);
    }

    public function makeAssertionsForCheckPersonsBadge($email, $badgeName, $statusCode, $testBool){
        $data = $this->badgesController->checkPersonsBadge($email, $badgeName);
        $content = json_decode($data->content(), true);
        $this->assertEquals($statusCode, $content['status']);
        $this->assertEquals($testBool, $content['BadgeHolder']);
    }

    public function testGetPersonsBadges_returns_status_code_and_badge_count(){
        $data = $this->badgesController->getPersonsBadges($this->validEmail);
        $content = json_decode($data->content(), true);
        $this->assertEquals('badges', $content['collection']);
        $this->makeAssertionsForStatusAndCount(200, 2, $content, 'badges');
    }

    public function makeAssertionsForStatusAndCount($statusCode, $count, $content, $key){
        $this->assertEquals($statusCode, $content['status']);
        $this->assertEquals($count,$content['count']);
        $this->assertEquals(count($content[$key]), $content['count']);
    }

    public function testGetAllIndividualsByBadge_returns_status_count_and_individuals(){
        $data = $this->badgesController->getAllIndividualsByBadge($this->validBadgeName);
        $content = json_decode($data->content(), true);
        $this->assertEquals('badges', $content['collection']);
        $this->makeAssertionsForStatusAndCount(200, 42, $content, 'individuals');
    }

}