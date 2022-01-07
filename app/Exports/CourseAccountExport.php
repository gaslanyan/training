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
        $accounts = $this->model->with([
            'account' => function ($query) {
                $query->select(['id', 'name','surname' ]);
            }])
            ->where('course_id', $this->id)->get();

dd($accounts);
        return $accounts;
    }

    public function headings(): array
    {
        return [
            '#',
            __('messages.name'),
            __('messages.surname'),
            __('messages.father_name'),
            __('messages.bday'),
            __('messages.phone'),
            __('messages.passport'),
            __('messages.date_of_issue'),
            __('messages.date_of_expiry'),
            __('messages.work_address'),
            __('messages.home_address'),
            __('messages.workplace_name'),
            __('messages.education'),
            __('messages.spec'),
            __('messages.email'),
        ];
    }
}
