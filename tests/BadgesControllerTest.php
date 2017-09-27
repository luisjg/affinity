<?php
use App\Http\Controllers\BadgesController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BadgesControllerTest extends TestCase
{
    public function testCheckIfBadgeNameExists_returns_true(){
        $badgesController = new BadgesController;
        $data = $badgesController->checkIfBadgeNameExists('Teaching Conference Grant');
        $this->assertEquals(true, $data);
    }

    public function testCheckIfBadgeNameExists_throws_NotFoundHttpException(){
        $badgesController = new BadgesController;
        $this->setExpectedException(NotFoundHttpException::class);
        $badgesController->checkIfBadgeNameExists('A non-existent badge name');
    }
}