<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Courses extends Model
{

    use Notifiable;

    protected $fillable = [
        'id', 'name', 'specialty_ids', 'status', 'start_date', 'duration_date', 'credit', 'videos', 'cost', 'content',
    ];

    /**
     * @return array
     */
    public static function getCreditType()
    {
        return [
            'theoretical' => __('messages.theoretical'),
            'practical' => __('messages.practical'),
            'unknown' => __('messages.unknown')
        ];
    }

    /**
     * @return array
     */
    public static function getStatus()
    {
        return [
            'active' => __('messages.course_status_active'),
            'delete' => __('messages.course_status_delete'),
            'archive' => __('messages.course_status_archive')
        ];
    }
}
