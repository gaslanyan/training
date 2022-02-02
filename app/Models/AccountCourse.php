<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AccountCourse extends Model
{

    use Notifiable;
    protected $table = 'accounts_courses';

    protected $fillable = [
        'id', 'course_id', 'random_test', 'account_id', 'count', 'status', 'percent','test', 'rating','comment','paid','payment','reading'
    ];
    public function course()
    {
        return $this->belongsTo('App\Models\Courses');
    }
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }
}
