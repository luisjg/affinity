<?php namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\BadgeAwarded;

class BadgesController extends Controller
{

    /**
     * Return all the badges.
     * @return array JSON Response
     */
    public function getAllBadges()
    {
        $response = buildResponseArray('badges');
        $badges = Badge::Active()->get();
        $response['count'] = "{$badges->count()}";
        $response['badges'] = $badges;
        return $this->sendJsonResponse($response);
    }

    /**
     * Returns all the badges with their members
     * @return array JSON Response
     */
    public function getBadgesWithMembers()
    {
        $response = buildResponseArray('badges');
        $users = Badge::with('members')->get();
        $response['count'] = "{$users->count()}";
        $response['badges'] = $users;
        return $this->sendJsonResponse($response);
    }


    /**
     * Handles the badge look-up for a specific person
     * @param String $email the user's email address
     * @return array JSON Response
     */
    public function getPersonsBadges($email)
    {
        $response = buildResponseArray('badges');
        $user = BadgeAwarded::Email($email)->get();
        $response['count'] = "{$user->count()}";
        $response['badges'] = $user;
        return $this->sendJsonResponse($response);
    }

    /**
     * Returns a specific badge by its badge id
     * @param string $id  The id of the badge to return
     * @return array JSON Response
     */
    public function getBadge($id)
    {
        $response = buildResponseArray('badges');
        $badge = Badge::Active()->findOrFail('badges:'.$id);
        $response['count'] = "{$badge->count()}";
        $response['badges'] = $badge;
        return $this->sendJsonResponse($response);
    }

}
