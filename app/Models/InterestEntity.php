<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestEntity extends Model
{
    /**
     * @var string
     */
    protected $table = 'fresco.expertise_entity';

    /**
     * @var string
     */
    protected $primaryKey = 'entities_id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $hidden = [
        'expertise_entity_id',
        'created_at',
        'updated_at'
    ];

    /*
     * In order to retrieve must truncate academic flag set in 
     * interest entity to grab list of research / academic results.
     */
    public static function getAcademicInterest()
    {
        $academic = static::where('expertise_id','LIKE','research:%:%')->get();
        foreach($academic as $interest){
            $interests[] = str_replace(":academic", '', $interest['expertise_id']);
        };
        return $interests = Research::whereIn('attribute_id',$interests)->get();
    }
    public static function getPersonsAcademicInterest($user_id)
    {
        $academic = static::where([
            ['entities_id', '=' , $user_id],
            ['expertise_id','LIKE','research:%:%']
            ]
        )->get();
        if(is_array($academic)){
            foreach($academic as $interest){
                $interests[] = str_replace(":academic", '', $interest['expertise_id']);
            };
            return $interests = Research::whereIn('attribute_id',$interests)->get();
        }else{
            return $interests = collect();
        }
        
    }
}
