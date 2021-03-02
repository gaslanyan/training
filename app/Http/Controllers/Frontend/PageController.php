<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountCourse;
use App\Models\Courses;
use App\Models\Page;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        try {
            $accountcourses = new AccountCourse();
            $accountcourses->course_id = $course_id;
            $accountcourses->account_id = $user_id;
            $accountcourses->comment = $comment;
            $accountcourses->panding = "unread";
            $accountcourses->save();

        } catch (\Exception $exception) {
           //dd($exception);
            logger()->error($exception);
            // return redirect('backend/courses')->with('error', Lang::get('messages.wrong'));
        }

        return true;


    }

    /**
     * Send and update rating
     *
     * Send and update rating  by account id
     *
     * @queryParam course_id The course id Example: "2"
     * @queryParam user_id The sign in account id Example: "2"
     * @queryParam rating The selected rating value Example: "4"
     *
     *
     * @response
     *{
     * "success": "true",
     * "user": "2"
     * }
     */

    public function rating(Request $request)
    {
        $course_id = $request->course_id;
        $user_id = $request->account_id;
        $rating= $request->rating;

        //$result = DB::table('accounts_courses')->where('account_id', '=', $user_id)->where('course_id','=',$course_id)->get();
        $result = DB::table('accounts_courses')->where('raiting', '>', 0)->get();

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

        return response()->json(['success' => true, 'user' => $user_id, 200]);


    }
       public function certificate(Request $request)
    {

        $account_name = Account::where('id', '=', $request->user_id)->first();

        $course = Courses::where('id','=',$request->id)->first();
        $certificate  =  $course->certificate;
        $start  = $course->start_date;
        $end = $course->duration_date;
      /* $coordx = \GuzzleHttp\json_decode($course->coordinatex);
        $coordy = \GuzzleHttp\json_decode($course->coordinatey);*/

       // $coordinates = $course->coordinates;
        $coordinates = \GuzzleHttp\json_decode('{
                    "name": {
                        "x": "182",
                        "y": "218"
                    },
                    "end_date": {
                        "x": "244",
                        "y": "267"
                    },
                    "start_date": {
                        "x": "136",
                        "y": "273"
                    }
}');


       // $img =   imagecreatefrompng(public_path()."/css/frontend/img/".$certificate);
        $img = public_path(Config::get('constants.UPLOADS') . '/diplomas/plakat.png');
      
        $color = imagecolorallocate($img, 000, 000, 000);
        $font = public_path()."/css/frontend/fonts/GHEAMariamRIt.otf";
        $text = strtoupper($account_name->name ." ". $account_name->surname);

        dd($img);
        imagettftext($img, 12, 0, $coordinates->name->x, $coordinates->name->y, $color, $font, $text);
        imagettftext($img, 12, 0, $coordinates->start_date->x, $coordinates->start_date->y, $color, $font, $start);
        imagettftext($img, 12, 0, $coordinates->end_date->x, $coordinates->end_date->y, $color, $font, $end);
        header('Content-type:image/png');
        imagepng($img, public_path().'/css/frontend/img/'.$text.'.png', 5);
        echo '<img id="finishimg" src ='.public_path()."/css/frontend/img/".$text.'.png">';
        /*return response()->json(['data' => $coursestitle]);*/
    }


    public function get(Request $request)
    {

        $ssr = $this->render($request->path());
        return view('app', ['ssr' => $ssr]);
    }
}
