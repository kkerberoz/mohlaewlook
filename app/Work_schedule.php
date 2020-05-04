<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_schedule extends Model
{
    protected $primary = 'work_id';
    protected $table = 'work_schedules';
    public $timestamps = false;
}
