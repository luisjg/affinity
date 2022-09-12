<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\BadgeAwarded;
use App\Models\IndividualsAwarded;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BadgesController extends Controller
{

    /**
     * Return all the badges.
     * @param Request $request
     * @return array JSON Response
     */
    public function getAllBadges()
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
        if(is_null($request->getQueryString())){
            return $this->getAllBadges($request);
        }
        else if($request->has('email') && $request->has('name')){
            $this->checkIfUserExists($request['email']);
            $this->checkIfBadgeNameExists($request['name']);
            return $this->checkPersonsBadge($request['email'], $request['name']);
        }
        else if($request->has('email')){
            $this->checkIfUserExists($request['email']);
            return $this->getPersonsBadges($request['email']);
        }
        else if($request->has('name')){
            $this->checkIfBadgeNameExists($request['name']);
            return $this->getAllIndividualsByBadge($request['name']);
        }
        else {
            throw new NotAcceptableHttpException;
        }
    }

    public function checkIfUserExists($email){
        $user = User::whereEmail($email)->first();
        if($user == null){
            throw new NotFoundHttpException;
        }
        return true;
    }

    public function checkIfBadgeNameExists($name){
        $badge = Badge::where('name', $name);
        if($badge->count() == 0){
            throw new NotFoundHttpException;
        }
        return true;
    }

    /**
     * @param $email
     * @param $badgeName
     * @return array
     */
    public function checkPersonsBadge($email, $badgeName){
        $isBadgeHolder = false;
        $response = buildResponseArray('badges');
        $badgeHolders = IndividualsAwarded::getPublishedBadgeHolders($badgeName);
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
        $individualsWithBadge = IndividualsAwarded::getPublishedBadgeHolders($badgeName);
        $response['count'] = "{$individualsWithBadge->count()}";
        $mappedIndividuals = $this->buildSimpleIndividualsArray($individualsWithBadge);
        $response['individuals'] = $mappedIndividuals;
        return $this->sendResponse($response);
    }

    /**
     * @param $individualsWithBadge
     * @return mixed
     */
    public function buildSimpleIndividualsArray($individualsWithBadge){
        return $individualsWithBadge->map(function ($key) {
            return [
                'name'       => $key->empl_name,
                'email'      => $key->email,
                'badge_name' => $key->badge_name,
                'award_date' => $key->award_date
            ];
        });
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
