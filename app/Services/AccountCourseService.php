<?php


namespace App\Services;


use App\Models\Account;
use App\Models\AccountCourse;
use App\Models\Courses;
use App\Models\Message;
use App\Models\Profession;
use App\Models\Tests;
use App\Models\User;
use App\Notifications\ManageUserStatus;
use App\Notifications\PaymentNotification;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;


class AccountCourseService
{
    /**
     * @var Repository
     */
    private $model;


    /**
     * AccountCourseService constructor.
     * @param AccountCourse $accountCourse
     */
    public function __construct(AccountCourse $accountCourse)
    {
        $this->model = new Repository($accountCourse);
    }


    public function getTestResult($id, $account_id, $model)
    {

        $answers = Tests::select('answers')->where('courses_id', $id)
            ->get();
        $test_answers = [];
        foreach ($answers as $index => $answer) {
            $ans = json_decode($answer->answers);
            foreach ($ans as $i => $an) {
                if (!empty($an->check))
                    $test_answers[$index + 1][$i + 1] = true;
            }
        }
        $account_answers = [];
        foreach ($model as $index => $item) {
            $i = explode("_", $index);
            $account_answers[$i[0]][$i[1]] = true;
        }
        $deff = [];
        foreach ($test_answers as $i => $ta) {
            if (array_diff_assoc($ta, $account_answers[$i])) {
                $deff[] = $i;
            }
        }
        $percent = ((count($account_answers) - count($deff)) / count($account_answers)) * 100;
        $count = $this->getCountOfTest($id, $account_id);

        $account_course = [];
        $account_course['account_id'] = $account_id;
        $account_course['course_id'] = $id;
        $status = ($percent >= Config::get('constants.PERCENT')) ? 'success' : 'unsuccess';
        $account_course['status'] = $status;
        $account_course['percent'] = $percent;
        $account_course['test'] = json_encode($account_answers);

        if (empty($count->count) && empty($count->random_test)) {
            $c = (int)Config::get('constants.COUNT_OF_TEST') - 1;
            $account_course['count'] = $c;
            if (is_object($count)) {
                $ca = $this->model->update($account_course, $count->id);
            } else {
                $account_course['paid'] = 1;
                $ca = $this->model->create($account_course);
            }

        } elseif ($count->count <= Config::get('constants.COUNT_OF_TEST')) {
            $c = $count->count - 1;
            $account_course['count'] = $c;
            if ($account_course['status'] == "success") {
                $account_course['paid'] = 1;
            }
            $ca = $this->model->update($account_course, $count->id);
            if ($count->count === 1 && $percent < Config::get('constants.PERCENT')) {
                AccountService::updateUserByParam('removed', $account_id, 'status');
                $message = Message::where('key', 'unsuccess_test')->first();
                $account = Account::where('id', $account_id)->first();
                $user = User::select('email')->where('account_id', $account_id)->first();
                $user->notify(new ManageUserStatus($user, $account, $message, 0));
            }
        }

        if (!$ca)
            throw new ModelNotFoundException('Account course not created!');
        return $percent;
    }

    public
    function getTestsResult($id)
    {
        $tests = $this->model->selected(['id', 'account_id', 'course_id', 'percent', 'updated_at'])
            ->with(['course' =>
                function ($query) {
                    $query->select('id', 'name', 'credit', 'image');
                }])
            ->where('account_id', $id)
            ->where('percent', '>=', Config::get('constants.PERCENT'))
            ->get();
        foreach ($tests as $index => $test) {
            $tests[$index]['certificate'] = $this->getCertificate($test->course->id, $id) . '.png';
        }
        if (!$tests)
            throw new ModelNotFoundException('Account course not get!');
        return $tests;
    }

    public function getPaymentById($account_id, $course_id)
    {
        $m_b_p = Profession::select('member_of_palace')
            ->where('account_id', $account_id)->first();
        $data = [];
        if ($m_b_p->member_of_palace) {
            $cu = $this->getField($account_id, $course_id, 'id');

            if (!$cu)
                $this->model->create(['account_id' => $account_id, 'course_id' => $course_id]);
            $paid = 1;

        } else {
            $paid = $this->getField($account_id, $course_id, 'paid');
            $paid = ($paid) ? $paid->paid : 0;
        }
        $book = Courses::select('books')->where('id', $course_id)->fisrt();
        $reading = $this->getField($account_id, $course_id, 'reading');
        if (!$reading)
            $data['reading'] = (is_null($book->books)) ? 1 : 0;
        else
            $data['reading'] = $reading->reading;
        $data['paid'] = $paid;
        return $data;
    }

//
//    public function getPaymentByMobile($account_id, $course_id)
//    {
//        $m_b_p = Profession::select('member_of_palace')->first();
//
//        if ($m_b_p->member_of_palace)
//            $paid = 1;
//        else {
//            $paid = $this->model->selected('paid')
//                ->where('account_id', $account_id)
//                ->where('course_id', $course_id)->first();
//            $paid = ($paid) ? $paid->paid : 0;
//        }
//        return $paid;
//    }

//todo  inchi get
    public
    function getTestById($a_id, $id)
    {
        $test = [];
        $tests = $this->model->with(['course' => function ($query) {
            $query->select('id', 'name', 'credit');
        }, 'account' => function ($query) {
            $query->select('id', 'name', 'surname', 'father_name', 'phone');
        }])->where(['account_id' => $a_id, 'course_id' => $id])
            ->first();
        $random_tests = [];
        $random_test = json_decode($tests->random_test);
        if (!empty($random_test))
            $random_tests = Tests::whereIn('id', $random_test)->get();
        $test['test'] = $tests;
        $test['random_tests'] = $random_tests;

        if (!$tests)
            throw new ModelNotFoundException('Account course not get!');
        return $test;
    }

    public
    function getAccountById($id)
    {
        $account = Account::select('id', 'name', 'surname', 'father_name', 'phone')
            ->with(['user' => function ($query) {
                $query->select('id', 'account_id', 'email');
            }])
            ->where('id', $id)->first();
        if (!$account)
            throw new ModelNotFoundException('Account not get!');
        return $account;
    }

    public
    function getCourseById($id)
    {
        $course = Courses::select('id', 'name', 'cost')
            ->where('id', $id)->first();
        if (!$course)
            throw new ModelNotFoundException('Account not get!');
        return $course;
    }

    public
    function getCountOfTest($id, $account_id)
    {
        return $this->getField($account_id, $id, ['id', 'count', 'percent', 'random_test']);
    }

    public
    function readingBook($req)
    {
        $read = 0;
        $count = $req->count;
        $page = $req->page;
        $data = [];
        $data['page'] = $page;
        if ($page >= $count - 2)
            $read = 1;
        $data['reading'] = $read;

        $ac = $this->model->selected('id')
            ->where('account_id', $req->account_id)
            ->where('course_id', $req->course_id)->first();
        $p = AccountCourse::find($ac->id);
        $p->page = $page;
        $p->reading = $read;
        return $p->save();
//        return $this->model->update($data, $ac->id);
    }

    public
    function getPage($req)
    {
        $page = $this->model->selected('page')
            ->where('account_id', $req->account_id)
            ->where('course_id', $req->course_id)->first();
        if (!$page)
            return null;
        return $page;
    }

    public
    function uploadPayment($id, $account_id, $data)
    {
        $c_a = Courses::select('name')->where('id', $id)->first();
        $ac = $this->model->selected(['id', 'payment'])
            ->where('account_id', $account_id)
            ->where('course_id', $id)->first();
        if (empty($ac->id)) {
            $u_data['course_id'] = $id;
            $u_data['account_id'] = $account_id;

            $u_data['payment'] = json_encode($data);
//            $isPayment = ($data['DepositedAmount'] == $c_a->cost) ? true : false;
//            if($isPayment)
            $u_data['paid'] = 1;
            $this->model->create($u_data);

        } else {

            $u_data['payment'] = \GuzzleHttp\json_encode($data, true);
//            $u_data['DepositedAmount'] += $data['DepositedAmount'];
//            $isPayment = ($u_data['DepositedAmount'] == $c_a->cost) ? true : false;
//            if($isPayment)
            $u_data['paid'] = 1;
            $this->model->update($u_data, $ac->id);
        }
        $message = Message::where('key', 'payment')->first();
        $account = Account::select('id', 'name', 'surname')
            ->where('id', $account_id)->first();
        $user = User::select('email')->where('account_id', $account_id)->first();
        $user->notify(new PaymentNotification($user, $account, $message, $c_a->name, $data));
    }

    function getPayments()
    {
        $payments = $this->model->selected(['id', 'account_id', 'course_id', 'payment', 'created_at'])
            ->with(['course' => function ($query) {
                $query->select('id', 'name', 'cost');
            }, 'account' => function ($query) {
                $query->select('id', 'name', 'surname', 'father_name');
            }])->whereNotNull('payment')->get();
        if (!$payments)
            throw new ModelNotFoundException('Account not get!');
        return $payments;
    }

    function getCertificate($id, $user_id)
    {
        $account_name = Account::where('id', '=', $user_id)->first();
        $course = Courses::where('id', '=', $id)->first();
        $certificate = $course->certificate;
        $start = $course->start_date;
        $end = $course->duration_date;
        if ($course->coordinates != "") {
            $coordinates = \GuzzleHttp\json_decode($course->coordinates);

            $img = public_path() . '/uploads/diplomas/' . $certificate;
            $imgg = imagecreatefrompng($img);
            $color = imagecolorallocate($imgg, 000, 000, 000);
            $font = public_path() . "/css/frontend/fonts/GHEAMariamRIt.otf";
            $text = strtoupper($account_name->name . " " . $account_name->surname);
            $text_send = Config::get('constants.DIPLOMA') . $id . "_" . $user_id;

            imagettftext($imgg, 12, 0, ($coordinates->name->x) - 10, ($coordinates->name->y) + 10, $color, $font, $text);
            imagettftext($imgg, 12, 0, ($coordinates->start_date->x) - 10, ($coordinates->start_date->y) + 10, $color, $font, $start);
            imagettftext($imgg, 12, 0, ($coordinates->end_date->x) - 10, ($coordinates->end_date->y) + 10, $color, $font, $end);
            header('Content-type:image/png');
            imagepng($imgg, public_path() . $text_send . '.png', 5);
            imagedestroy($imgg);
            return $text_send;
        }
    }

    function getField($account_id, $course_id, $f)
    {
        $field = $this->model->selected($f)
            ->where('account_id', $account_id)
            ->where('course_id', $course_id)->first();
        if (!$field)
            $field = null;
        return $field;
    }
}
