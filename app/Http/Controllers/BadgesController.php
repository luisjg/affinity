<?php namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\BadgeAwarded;
use App\Models\IndividualsAwarded;
use Illuminate\Http\Request;

class BadgesController extends Controller
{

    /**
     * Return all the badges.
     * @param Request $request
     * @return array JSON Response
     */
    public function getAllBadges(Request $request)
    {
            $response = buildResponseArray('badges');
            $badges = Badge::active()->get();
            $response['count'] = "{$badges->count()}";
            $response['badges'] = $badges;
            return $this->sendResponse($response);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function handleBasedOnQuery(Request $request){
        if($request->has('email') && $request->has('name')){
            return $this->checkPersonsBadge($request['email'], $request['name']);
        } elseif($request->has('email')){
            return $this->getPersonsBadges($request['email']);
        } elseif($request->has('name')){
            return $this->getAllIndividualsByBadge($request['name']);
        }else {
            return $this->getAllBadges($request);
        }
    }

    /**
     * @param $email
     * @param $badgeName
     * @return array
     */
    public function checkPersonsBadge($email, $badgeName){
        $isBadgeHolder = false;
        $response = buildResponseArray('badges');
        $badgeHolders = IndividualsAwarded::getIndividualsByBadge($badgeName);
        if($badgeHolders->contains('email', $email)){
            $isBadgeHolder = true;
        }
        $response['BadgeHolder'] = $isBadgeHolder;
        return $this->sendResponse($response);
    }

    /**
     * @param $badgeName
     * @return array
     */
    public function getAllIndividualsByBadge($badgeName){
        $response = buildResponseArray('badges');
        $individualsWithBadge = IndividualsAwarded::getIndividualsByBadge($badgeName);
        $response['count'] = "{$individualsWithBadge->count()}";
        $response['individuals'] = $individualsWithBadge;
        return $this->sendResponse($response);
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
        return $this->sendResponse($response);
    }


    /**
     * Handles the badge look-up for a specific person
     * @param String $email the user's email address
     * @return array JSON Response
     */
    public function getPersonsBadges($email)
    {
        $response = buildResponseArray('badges');
        $user = BadgeAwarded::email($email)->get();
        $response['count'] = "{$user->count()}";
        $response['badges'] = $user;
        return $this->sendResponse($response);
    }

    /**
     * Returns a specific badge by its badge id
     * @param string $id  The id of the badge to return
     * @return array JSON Response
     */
    public function getBadge($id)
    {
        $response = buildResponseArray('badges');
        $badge = Badge::active()->findOrFail('badges:'.$id);
        $response['count'] = "{$badge->count()}";
        $response['badges'] = $badge;
        return $this->sendResponse($response);
    }

}
