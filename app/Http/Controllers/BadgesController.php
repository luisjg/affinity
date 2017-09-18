<?php namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\BadgeAwarded;
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
            //return true or false
        } elseif($email = $request->has('email')){
            return $this->getPersonsBadges($email);
        } elseif($request->has('name')){
            //returns individuals with that badge
        }else {
            return $this->getAllBadges($request);
        }
    }

    public function getAllIndividualsByBadge(){

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
