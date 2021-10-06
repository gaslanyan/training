<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\AccountCourse;
use App\Models\Book;
use App\Models\Courses;
use App\Models\Profession;
use App\Models\Specialties;
use App\Models\Tests;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;


class CourseService
{
    /**
     * @var Repository
     */
    protected $model;


    /**
     * CourseService constructor.
     * @param Courses $course
     */
    public function __construct(Courses $course)
    {
        $this->model = new Repository($course);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getCourses($id)
    {
        $spec = Profession::select('specialty_id')->where('account_id', $id)->first();
        $prof = Specialties::select('parent_id')->where('id', $spec->specialty_id)->first();
        if ($prof->parent_id == 1)
            $courses = $this->getCoursesById($prof->parent_id);
        else
            $courses = Courses::select('id', 'name', 'cost', 'start_date')->
            whereRaw('JSON_CONTAINS(`specialty_ids`,
         \'["' . $spec->specialty_id . '"]\')')
                ->where('status', "=", "active")
                ->where('start_date', ">=", date("Y-m-d"))
                ->with(['account_course' => function ($query) use ($id) {
                    $query->select('course_id', 'paid')
                        ->where('account_id', $id);
                }])->get();

        $result = (!empty($courses)) ? $courses : __('messages.noting');
        if (!$courses)
            throw new ModelNotFoundException('User not found by ID ');
        return $result;
    }

    public function getCoursesById($id)
    {
        $spec = Specialties::select('id')->where('parent_id', $id)->paginate(10);

        $courses = [];
        foreach ($spec as $index => $item) {
            $c = Courses::select('id', 'name', 'cost', 'start_date')->
            whereRaw('JSON_CONTAINS(`specialty_ids`,\'["' . $item->id . '"]\')')
//                ->where('status', "=", "active")
//                ->where('start_date', ">=", date("Y-m-d"))
                ->first();

            if (!empty($c))
//                 dd($c);
                $courses[$c['id']] = $c;
        }
//        dd($courses);

        $result = (!empty($courses)) ? $courses : __('messages.noting');
        if (!$courses)
            throw new ModelNotFoundException('User not found by ID ');
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCoursesInfo($id)
    {
        $spec = Profession::select('specialty_id')->where('account_id', $id)->first();

        $courses = Courses::select('id', 'name', 'credit')->whereRaw('JSON_CONTAINS(`specialty_ids`,  \'["' . $spec->specialty_id . '"]\')')
            ->where('status', "=", "active")->get();

        $result = (!empty($courses)) ? $courses : __('messages.noting');
        if (!$courses)
            throw new ModelNotFoundException('User not found by ID ');
        return $result;
    }

    public function getCourseTitleById($id)
    {
        $title = $this->model->selected('name')->where('id', $id)->first();

        $result = (!empty($title)) ? $title : __('messages.noting');
        if (!$title)
            throw new ModelNotFoundException('User not found by ID ');
        return $result;
    }


    /**
     * @return Repository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $messages = $this->model->selected(['id', 'name', 'cost', 'start_date'])
//            ->whereDate('start_date', "<=", date("Y-m-d"))
            ->get();
        if (!$messages)
            throw new ModelNotFoundException('User not found by ID ');
        return $messages;

    }

    public function getBookById($id)
    {
        $book = Book::select('id', 'title', 'path')
            ->where('id', $id)
            ->first();
        $result = (!empty($book)) ? $book : __('messages.noting');
        if (!$book)
            throw new ModelNotFoundException('User not found by ID ');
        return $result;
    }

    public function getBook($id)
    {
        $path = public_path() . Config::get('constants.UPLOADS') . Config::get('constants.BOOKS') . $id;
        $book = '';
        if (file_exists($path)) {
            $book = count(glob("$path/*.jpg"));;
        } else
            throw new ModelNotFoundException('Book not found by ID ');
        return $book;
    }

    public function getTestsById($id, $a_id)
    {
        $tests = Tests::where('courses_id', $id)
            ->get();
        //->random(5)

        if (!empty($tests)) {
            $random_test = [];

            foreach ($tests as $index => $test) {
                $arr = [];
                $random_test[] = $test->id;
                $contents = json_decode($test['answers']);
//                dd($contents);
                $answers = [];
                foreach ($contents as $str => $item) {
                    preg_match("/<img[^>]+src=\"([^\">]+)\"/", $item->inp, $arr);

                    if (isset($arr[1]))
                        $answers[$str]['img'] = $arr[1];
                    $answers[$str]['answer'] = strip_tags($item->inp);
                    if (isset($item->check))
                        $answers[$str]['check'] = 1;
                }
                $tests[$index]['answers'] = json_encode($answers, true);
            }

            AccountCourse::where(['account_id' => $a_id, 'course_id' => $id])
                ->update(['random_test' => json_encode($random_test, true)]);

        }
        if (!$tests)
            throw new ModelNotFoundException('User not found by ID ');
        return $tests;
    }
}
