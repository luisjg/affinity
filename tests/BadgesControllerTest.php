<?php
use App\Http\Controllers\BadgesController;

class BadgesControllerTest extends TestCase
{
    public function testCheckIfBadgeNameExists_returns_true(){
        $badgesController = new BadgesController;
        $data = $badgesController->checkIfBadgeNameExists('Teaching Conference Grant');
        $this->assertEquals(true, $data);
    }
}