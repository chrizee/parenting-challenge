<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentingQuiz extends Model
{
    protected $table = 'parenting_quizzes'; //this should be available by default
    public $primaryKey = 'id';  //this should be id by default. You can change it to something like "item_id"
    public $timestamps = true;  // this is to use timestamps columns in the table. this is true by default
}
