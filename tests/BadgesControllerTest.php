<?php
use App\Http\Controllers\BadgesController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

class BadgesControllerTest extends TestCase
{
    public function testCheckIfBadgeNameExists_returns_true(){
        $badgesController = new BadgesController;
        $data = $badgesController->checkIfBadgeNameExists('Teaching Conference Grant');
        $this->assertEquals(true, $data);
    }

    public function testCheckIfBadgeNameExists_throws_BadRequestHttpException(){
        $badgesController = new BadgesController;
        $this->setExpectedException(NotFoundHttpException::class);
        $badgesController->checkIfBadgeNameExists('A non-existent badge name');
    }

    public function testGetAllBadges_returns_status_code_and_badge_count(){
        $badgesController = new BadgesController;
        $data = $badgesController->getAllBadges(new Request());
        $content = json_decode($data->content(), true);
        $this->assertEquals(200,$content['status']);
        $this->assertEquals(11,$content['count']);

    }
}