<?php

namespace App\Exports;

use App\Models\AccountCourse;
use App\Repositories\Repository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CourseAccountExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $model;
    protected $id;

    public function __construct($id)
    {
        // set the model

        $this->id = $id;
        $model = new AccountCourse();
        $this->model = new Repository($model);
    }

    public function collection()
    {
        $data = $this->model->with([
            'account' => function ($query) {
                $query->select(['id', 'name', 'surname','father_name', 'phone', 'workplace_name']);
            },
            'course' => function ($query) {
                $query->select(['id', 'name', 'start_date', 'end_date']);
            },
            'account.user' => function ($query) {
                $query->select(['email', 'account_id']);
            },
            'account.prof.spec' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->select('id', 'account_id', 'course_id')
            ->where('course_id', $this->id)
            ->where('percent', '>=',50)
            ->get();

        foreach ($data as $index => $datum) {
            unset($data[$index]->id);
            unset($data[$index]->account_id);
            unset($data[$index]->course_id);
            $data[$index]['index'] = $index + 1;
            $data[$index]['course_name'] = $datum->course->name;
            $data[$index]['course_date'] = $datum->course->start_date . " - " . $datum->course->end_date;
            $data[$index]['full_name'] = $datum->account['name'] . " " . $datum->account['surname'] . " ".$datum->account['father_name'];
            $data[$index]['phone'] = $datum->account['phone'];
            $data[$index]['email'] = $datum->account['user']['email'];
            $data[$index]['workplace_name'] = $datum->account['workplace_name'];
            $data[$index]['spec'] = $datum->account['prof']['spec']['name'];
            unset($data[$index]['account']);
            unset($data[$index]['course']);
        }
//        dd($data);
        return $data;
    }

    public function headings(): array
    {
        return [
            '#',
            __('messages.course_name_exel'),
            __('messages.course_date'),
            __('messages.full_name'),
            __('messages.phone'),
            __('messages.email'),
            __('messages.workplace_name'),
            __('messages.spec'),
        ];
    }
}
