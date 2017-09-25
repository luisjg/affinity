<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * @var string
     */
    protected $table = 'exploration.people';

    /**
     * @var string
     */
    protected $primaryKey = 'pid';

    /**
     * @var bool
     */
    public $incrementing = false;

}
