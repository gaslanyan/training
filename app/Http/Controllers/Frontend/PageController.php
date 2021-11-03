<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Account;
use App\Models\AccountCourse;
use App\Models\Courses;
use App\Models\Page;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{

    public function index()
    {

        return view('app');
    }


    private function render($path)
    {

    }

    public function about(Request $request)
    {
        $about = Page::all();
        $document = DB::table('documents')->where('documents.page_id', '=', 1)->get();
        return response()->json(['data' => $about, 'document' => $document]);
    }

    public function coursestitle(Request $request)
    {
        $coursestitle = Courses::all();
        // $coursestitle = DB::table('courses')->get();

        return response()->json(['data' => $coursestitle]);
    }

    public function applicantcount(Request $request)
    {
        $accounts = Account::where('role', '=', 'user')->get();
        $accountscount = $accounts->count();

        return response()->json(['data' => $accountscount]);
    }

    public function coursescount(Request $request)
    {
        $courses = Courses::all();
        $coursescount = $courses->count();

        return response()->json(['data' => $coursescount]);
    }



    public function savecomment(Request $request)
    {
 $course_id = $request->course_id;
        $user_id = $request->account_id;
        $comment = $request->comment;
        $result = DB::table('accounts_courses')->where('account_id', '=', $user_id)->where('course_id','=',$course_id)->get();


        try {
            if(count($result) < 1) {
                $accountcourses = new AccountCourse();
                $accountcourses->course_id = $course_id;
                $accountcourses->account_id = $user_id;
                $accountcourses->comment = $comment;
                $accountcourses->panding = "unread";
                $accountcourses->save();
            }
            else{
                $accountcourses = AccountCourse::query()->find($result[0]->id);
                $accountcourses->comment = $comment;
                $accountcourses->panding = "unread";
                $accountcourses->save();
            }

        } catch (\Exception $exception) {
           //dd($exception);
            logger()->error($exception);
            // return redirect('backend/courses')->with('error', Lang::get('messages.wrong'));
        }

        return true;




    }
    public function rating(Request $request)
    {
        $course_id = $request->course_id;
        $user_id = $request->account_id;
        $rating= $request->rating;

        //$result = DB::table('accounts_courses')->where('account_id', '=', $user_id)->where('course_id','=',$course_id)->get();
                       $result = DB::table('accounts_courses')->where('account_id', '=', $user_id)->where('course_id','=',$course_id)->get();

          try {
              if(count($result) < 1) {
                  $accountcourses = new AccountCourse();
                  $accountcourses->course_id = $course_id;
                  $accountcourses->account_id = $user_id;
                  $accountcourses->raiting = $rating;
                  $accountcourses->save();
              }
              else{
                  $accountcourses = AccountCourse::query()->find($result[0]->id);
                  $accountcourses->raiting = $rating;
                  $accountcourses->save();
              }

        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            // return redirect('backend/courses')->with('error', Lang::get('messages.wrong'));
        }

        return true;


    }

    public function get(Request $request)
    {

        $ssr = $this->render($request->path());
        return view('app', ['ssr' => $ssr]);
    }

    public function sendMail(ContactRequest $contactRequest){
        try {
        $data = array('name'=>\request('name'),
            'subject'=>\request('subject'),
            'email'=>\request('email'),
            'body'=>\request('message'));
        Mail::send('mails/contact', $data, function($message) {
            $message->to('info@training.gtech.am', \request('subject'))->subject
            (\request('message'));
            $message->from(\request('email'),request('subject'));
        });
             return response()->json([
                 'success' => true
             ]);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }
}
