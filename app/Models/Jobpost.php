<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    //
    protected $table = 'jobposts';

    protected $fillable = ['jobtitle','city', 'intro', 'content', 'type', 'status', 'question_1', 'question_2','question_3', 'question_4','question_5', 'question_6', 'answers_1', 'answers_2','answers_3', 'answers_4','answers_5', 'answers_6', 'meta_title', 'meta_keywords', 'meta_description', 'meta_og_image', 'meta_og_url', 'created_by_name', 'created_by'];
}
