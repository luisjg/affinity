<?php namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\InterestEntity;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class InterestsController extends Controller
{

    /**
     * Returns all the interests
     * @return array JSON Response
     */
    public function getAllInterests()
    {
        $response = buildResponseArray('interests');
        $interests = Interest::whereNotNull('attribute_id')->get();
        $response['count'] = "{$interests->count()}";
        $response['interests'] = $interests;
        return $this->sendJsonResponse($response);
    }

    /**
     * Returns all of the interests of one given person
     * @param string $email
     * @return array JSON Response
     */
    public function getPersonsInterests($email)
    {
        return $user = User::with('interests')->email($email)->firstOrFail();
        $response = buildResponseArray('interests');
        $interests = InterestEntity::where('entities_id',$user->user_id)->with("interest")->get();
        return $interests;
//        $interests = Interest::whereHas('members', function($q) use($user) {
//            $q->where('members_id', $user->user_Id);
        $response['count'] = $interests->count();
        $response['interests'] = $interests;
        return $this->sendJsonResponse($response);
    }

    /**
     * Handles the retrieval of a person's expertise type
     * @param string $email the user's email
     * @param string $type the research type to look up
     * @return array JSON Response
     */
    public function getSpecificPersonsInterestType($email, $type)
    {
        $user = User::email($email)->firstOrFail();
        // I need to find a person and his type...
        $response = buildResponseArray('interests');
        // load up the user with their specific interest type/
        $interests = InterestEntity::where('entities_id',$user->user_id)->where('expertise_id',"LIKE","$type:%")->with("interest_$type")->get();
        $response['count'] = $interests->count();
        $response['interests'] = $interests;
        return $this->sendJsonResponse($response);
    }

    public function getInterestType(Request $request, $type = NULL){
        try{
            $table = [
                'all'	   => 'App\Models\Interest',
                'research' => 'App\Models\Research',
                'teaching' => 'App\Models\Teaching',
                'personal' => 'App\Models\Personal',
            ];
            if(str_contains($type, ':'))
            {
                $query = $type;
                $type  = strtok($type, ':');
                $data  = $table[$type]::findOrFail($query);
                return $this->sendResponse($data, 'interests');
            }else
            {
                $data = $table[$type]::all();
                return $this->sendResponse($data, 'interests');
            }
        }
        catch(Exception $e)
        {
            abort(404);
        }
    }

    // Project Functions
    public function getInterestWithProjects()
    {
        $interests = Interest::whereNotNull('attribute_id')->with('projects');
        return $this->sendResponse($interests->get(), 'interests');
    }

    public function getInterestTypeProjects(Request $request, $type='all')
    {
        if($request->has('email')){
            return $this->getInterestMember($request['email'],$type);
        }
        else{
            return $this->getInterestMember($type,'projects');
        }
        return $this->sendResponse($interests->get(), 'interests');
    }

    public function getInterestProject($id)
    {
        $interestProject = InterestEntity::where('entities_id',$id)->with('interest_project')->get();
        $data= [];
        foreach($interestProject as $interest){
            $data[] = $interest->interest_project;
        }
        return $this->sendResponse($data, "interests");
    }

    // Member's Function
    public function getInterestWithMembers(Request $request, $type='all')
    {
        if($request->has('email')){
            return $this->getInterestMember($request['email'],$type);
        }
        else{
            $interests = Interest::whereNotNull('attribute_id')->with('members')->get();
        }
        return $this->sendResponse($interests, 'interests');
    }


    public function getInterestMember($email, $type)
    {
        $table = [
            'all'		 =>	'App\Models\Interest',
            'research'   => 'App\Models\Research',
            'teaching'   => 'App\Models\Teaching',
            'personal'   => 'App\Models\Personal',
        ];
        $user = User::email($email)->firstOrFail();
        $userInfo = [
            'email' => $user->email
        ];
        $interest=[];
        if($type=='all'){
            $data = InterestEntity::where('entities_id',$user->user_id)->with("interest")->get();
            foreach ($data as $connection ) {
                $interest[] = $connection["interest"][0];
            }
        }
        else{
            $data = InterestEntity::where('entities_id',$user->user_id)->where('expertise_id',"LIKE","$type:%")->with("interest_$type")->get();
            foreach ($data as $connection ) {
                $interest[] = $connection["interest_$type"][0];
            }
        }
        return $this->sendResponse($interest, "interest", ['email' => $email]);
    }
}
