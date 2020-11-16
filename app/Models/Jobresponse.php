<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobresponse extends Model
{
    //
    protected $table = 'jobresponses';

    protected $fillable = ['jobposts_id', 'users_email', 'users_cv', 'users_firstname','users_telephone', 'status', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'answer_5', 'answer_6', 'reviewed_by', 'reviewed_by_name'];
}
