<?php namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\InterestEntity;
use App\Models\Personal;
use App\Models\Research;
use App\Models\Academic;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class InterestsController extends Controller
{


    /**
     * (Unused as of AFFINITY-55)
     * @param $type
     * @return array
     */
    public function returnBlankEmailResponse($type){
        switch($type){
            case'research':
                $response = buildResponseArray('research_interests');
                break;
            case'personal':
                $response = buildResponseArray('personal_interests');
                break;
            case'teaching':
                $response = buildResponseArray('teaching_interests');
                break;
            case'all':
                $response = buildResponseArray('all_interests');
                break;
            default:
                throw new BadRequestHttpException;
        }
        $response['count']='0';
        $response['interests'] = [];
        return $response;
    }

    /**
     * Handles which type of interest to retrieve
     * @param string $type interest type
     * @param Request $request
     * @return array JSON Response
     */
    public function handleInterestType($type, Request $request)
    {

        if(is_null($request->getQueryString())) {

            if($type == 'research')
                return $this->getAllResearchInterests();
            else if($type == 'personal')
                return $this->getAllPersonalInterests();
            else if($type == 'academic')
                return $this->getAllAcademicInterests();
            else
                throw new BadRequestHttpException;
        } else if($request->has('email')){

            if($type == 'research')
                return $this->getPersonsResearchInterests($request['email']);
            else if($type == 'personal')
                return $this->getPersonsPersonalInterests($request['email']);
            else if($type == 'academic')
                return $this->getPersonsAcademicInterests($request['email']);
            else
                throw new BadRequestHttpException;
        }
        else
            throw new BadRequestHttpException;
    }



    /**
     * Retrieves all the interests
     * @param Request $request
     * @return array JSON Response
     */
    public function getAllInterests(Request $request)
    {
        if($request->has('email')) {
            return $this->getAllPersonsInterests($request['email']);
        } else if(is_null($request->getQueryString())) {
            $response = buildResponseArray('interests');
            $interests = Interest::whereNotNull('attribute_id')->get();
            $response['count'] = "{$interests->count()}";
            $response['interests'] = $interests;
            return $this->sendResponse($response);
        }
        else
            throw new BadRequestHttpException;
    }

    /**
     * Retrieves all the research interests
     * @return array JSON Response
     */
    public function getAllResearchInterests()
    {
        $response = buildResponseArray('interests');
        $interests = Research::whereNotNull('attribute_id')->get();
        $response['count'] = "{$interests->count()}";
        $response['interests'] = $interests;
        return $this->sendResponse($response);
    }


    /**
     * Retrieves all interests from a given person
     * @param string $email
     * @return array JSON Response
     */
    public function getAllPersonsInterests($email)
    {
        $user = User::whereEmail($email)->first();
        $response = buildResponseArray('all_interests');
        if($user==null)
        {
            throw new BadRequestHttpException;
        }
// Gets Personal and Research, ignoring academic since all academic interests are included in Research
        $interestEntity = InterestEntity::where('entities_id', $user->user_id)->get();
        if(count($interestEntity)) {
            foreach($interestEntity as $item)
                $interestId[] = $item->expertise_id;
            $personal_interests = Personal::find($interestId);
            $research_interests = Research::find($interestId);
        } else {
            $personal_interests = $interestEntity;
            $research_interests = $interestEntity;
        }

        $merged_collection      =   $personal_interests->merge($research_interests->all());
        $response['count']      =   "{$merged_collection->count()}";
        $response['interests']  =   $merged_collection;
        return $this->sendResponse($response);
    }

    /**
     * Retrieves all the personal interests
     * @return array JSON Response
     */
    public function getAllPersonalInterests()
    {
        $response = buildResponseArray('interests');
        $interests = Personal::all();
        $response['count'] = "{$interests->count()}";
        $response['interests'] = $interests;
        return $this->sendResponse($response);
    }

    /**
     * Retrieves all the academic interests
     * @return array JSON Response
     */
    public function getAllAcademicInterests()
    {
        $response = buildResponseArray('interests');
        $interests = Academic::whereNotNull('attribute_id')->get();
        $response['count'] = "{$interests->count()}";
        $response['interests'] = $interests;
        return $this->sendResponse($response);
    }

    /**
     * Retrieves all of the interests of one given person
     * @param string $email
     * @return array JSON Response
     */
    public function getPersonsResearchInterests($email)
    {

        $user = User::whereEmail($email)->first();
        $response = buildResponseArray('research_interests');
        if($user==null)
        {

            throw new BadRequestHttpException;
        }
        $interestEntity = InterestEntity::where('entities_id', $user->user_id)->get();
        foreach ($interestEntity as $interest) {
            $expertise_id[] = $interest->expertise_id;
        }
        $research_interests = Research::find($expertise_id);
        $response['count'] = "{$research_interests->count()}";
        $response['interests'] = $research_interests;
        return $this->sendResponse($response);
    }
    /**
     * Retrieves all of the interests of one given person
     * @param string $email
     * @return array JSON Response
     */
    public function getPersonsPersonalInterests($email)
    {
        $user = User::whereEmail($email)->first();
        $response = buildResponseArray('personal_interests');
        if($user==null)
        {
            throw new BadRequestHttpException;
        }
        $interestEntity = InterestEntity::where([
            ['entities_id', '=' , $user->user_id],
            ['expertise_id', 'like', 'personal%'],
        ])->get();
        if(count($interestEntity)) {
            foreach($interestEntity as $item)
                $researchId[] = $item->expertise_id;
            $interests = Personal::findOrFail($researchId);
        } else {
            $interests = $interestEntity;
        }
        $response['count'] = "{$interests->count()}";
        $response['interests'] = $interests;
        return $this->sendResponse($response);
    }

    /**
     * Retrieves all of the interests of one given person
     * @param string $email
     * @return array JSON Response
     */
    public function getPersonsAcademicInterests($email)
    {
        $user = User::whereEmail($email)->first();
        $response = buildResponseArray('academic_interests');
        if($user==null)
        {
            throw new BadRequestHttpException;
        }
        $interests = Academic::where('expertise_id', 'LIKE','%academic%')->where('entities_id', $user->user_id)->get();
        $idarray=[];
        foreach($interests as $interest)
        {
            $interest->expertise_id = substr($interest->expertise_id, 0, -9);
            $idarray[$interest->expertise_id]=$interest->expertise_id;
        }
        $interests=Research::whereIn('attribute_id',$idarray)->get();
        $response['count'] = "{$interests->count()}";
        $response['interests'] = $interests;
        return $this->sendResponse($response);
    }
}
