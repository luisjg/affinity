<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    /**
     * @var string
     */
    protected $table = 'nemo.individuals';

    /**
     * @var string
     */
    protected $primaryKey = 'individuals_id';

    /**
     * @var bool
     */
    public $incrementing = false;

}
