<?php

namespace App\Http\Controllers\Backend;

use App\Exports\AccountExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\ProfessionRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Traits\Address;
use App\Http\Traits\Expert;
use App\Http\Traits\Registration;
use App\Models\Account;
use App\Models\Message;
use App\Models\User;
use App\Notifications\ManageUserStatus;
use App\Repositories\Repository;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AccountController extends Controller
{
    use Address;
    use Expert;
    use Registration;

    // space that we can use the repository from
    /**
     * @var Repository
     */
    protected $model;
    /**
     * @var
     */
    protected $role;

    /**
     * AccountController constructor.
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        // set the model
        $this->model = new Repository($account);
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role)
    {
        $this->role = $role;
        Session::put('role', $role);
        try {
            $accounts = $this->model->with([
                'user' => function ($query) {
                    $query->select(['email', 'account_id', 'status']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'specialty_id']);
                },
                'prof.spec.type' => function ($query) {
                    $query->select(['id', 'name']);
                }])->select('id', 'name', 'surname', 'image_name', 'phone')
                ->where('role', $role)->get();
//dd($accounts);
            return view('backend.account.index',
                compact('accounts', 'role'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/' . $role)->with('error', __('messages.wrong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $regions = $this->getRegions();
            $regions = $regions->getData();
            $edu = $this->getEducate();
            $edu = (array)$edu->getData()->edu;
            $prof = $this->getProfession();
            $prof = (array)$prof->getData()->prof;
            return view('backend.account.create', compact('regions', 'edu', 'prof'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }


    /**
     * @param AccountRequest $accountRequest
     * @param ProfessionRequest $professionRequest
     * @param UserEditRequest $userRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AccountRequest $accountRequest,
                          ProfessionRequest $professionRequest,
                          UserEditRequest $userRequest)
    {
        try {
            Registration::register($accountRequest, $professionRequest, $userRequest, 'lecture', 'approved');

            return redirect('backend/account/lecture')->with('success', __('messages.success'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/lecture')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $account = $this->model->with([
                'user' => function ($query) {
                    $query->select(['email', 'account_id', 'status']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'diplomas']);
                }])->where('id', $id)->first();

            if (!empty($account)) {

                $home_address = json_decode($account->home_address, true);
                if (!empty($home_address['h_region']))
                    $account->h_region = getRegionName($home_address['h_region']);
                if (!empty($home_address['h_street']))
                    $account->h_street = $home_address['h_street'];
                if (!empty($home_address['h_territory']))
                    $account->h_territory = getRegionName($home_address['h_territory']);

                $work_address = json_decode($account->work_address, true);
                if (!empty($work_address['w_region']))
                    $account->w_region = getRegionName($work_address['w_region']);
                if (!empty($work_address['w_street']))
                    $account->w_street = $work_address['w_street'];
                if (!empty($work_address['w_territory']))
                    $account->w_territory = getRegionName($work_address['w_territory']);
            }

            $profession = DB::table('professions AS p')
                ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
                ->join('specialties AS sp', 'sp.id', '=', 's.parent_id')
                ->join('specialties_types AS st', 'st.id', '=', 's.type_id')
                ->select('s.icon', 'sp.name as edu_name',
                    's.name AS spec_name', 'st.name AS type_name')
                ->where('p.account_id', '=', $id)
                ->first();

            return view('backend.account.show',
                compact('account', 'profession'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $account = $this->model->with([
                'user' => function ($query) {
                    $query->select(['email', 'account_id', 'status']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'diplomas']);
                }])->where('id', $id)->first();
            if (!empty($account)) {

                $home_address = json_decode($account->home_address, true);
                $account->h_region = getRegionName($home_address['h_region']);
                $account->h_street = $home_address['h_street'];
                $account->h_territory = getRegionName($home_address['h_territory']);

                $work_address = json_decode($account->work_address, true);
                $account->w_region = getRegionName($work_address['w_region']);
                $account->w_street = $work_address['w_street'];
                $account->w_territory = getRegionName($work_address['w_territory']);
            }
            $regions = $this->getRegions();

            $regions = $regions->getData();

            $profession = DB::table('professions AS p')
                ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
                ->join('specialties AS sp', 's.parent_id', '=', 'sp.id')
                ->join('specialties_types AS st', 'st.id', '=', 's.type_id')
                ->select('s.icon', 'sp.name as edu_name', 'p.member_of_palace', 'p.specialty_id', 's.parent_id As education_id',
                    's.name AS spec_name', 'st.name AS type_name')
                ->where('p.account_id', '=', $id)
                ->first();

            $edu = $this->getEducate();
            $edu = (array)$edu->getData()->edu;
            $prof = $this->getProfession();
            $prof = (array)$prof->getData()->prof;

            return view('backend.account.edit',
                compact('account', 'profession', 'regions', 'edu', 'prof'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $message = Message::where('key', 'approved_user')->first();
            $account = Account::select('name', 'surname')->where('id', $id)->first();
            $user = User::where('account_id', $id)->first();
            DB::table('users')
                ->where('account_id', $id)
                ->update(['status' => "approved"]);
            $user->notify(new ManageUserStatus($user, $account, $message, true));
            return redirect('backend/account/user')->with('success', __('messages.updated'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/user')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request, $id)
    {
        try {
            dd($request);
            return redirect('backend/account/user')->with('success', __('messages.updated'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/user')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO check courses unlink diploma files
        try {
            $message = Message::where('key', 'rejected_user')->first();
            $account = Account::select('name', 'surname')->where('id', $id)->first();
            $user = User::where('account_id', $id)->first();
            $this->model->delete($id);
            $user->notify(new ManageUserStatus($user, $account, $message));
            return back()->with('success', __('messages.deleted'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }


//TODO change functions

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function gdPDF($id)
    {

        $account = $this->model->with([
            'user' => function ($query) {
                $query->select(['email', 'account_id', 'status']);
            },
            'prof' => function ($query) {
                $query->select(['account_id', 'specialty_id', 'diplomas']);
            },
            'prof.spec.type' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->where('id', $id)->first();

        if (!empty($account)) {

            $home_address = json_decode($account->home_address, true);
            $account->h_region = getRegionName($home_address['h_region']);
            $account->h_street = $home_address['h_street'];
            $account->h_territory = getRegionName($home_address['h_territory']);

            $work_address = json_decode($account->work_address, true);
            $account->w_region = getRegionName($work_address['w_region']);
            $account->w_street = $work_address['w_street'];
            $account->w_territory = getRegionName($work_address['w_territory']);
        }

        $profession = DB::table('professions AS p')
            ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
            ->join('specialties AS sp', 'sp.id', '=', 's.parent_id')
            ->join('specialties_types AS st', 'st.id', '=', 's.type_id')
            ->select('s.icon', 'sp.name as edu_name',
                's.name AS spec_name', 'st.name As type_name')
            ->where('p.account_id', '=', $id)
            ->first();

        $account->profession = $profession;
//dd($profession);
        $pdf = PDF::loadView('backend.account.gd_pdf', ['data' => $account])->setPaper('a4', 'landscape')->setWarnings(false);

        // If you want to store the generated pdf to the server then you can use the store function
        if (!Storage::exists(Config::get('constants.ACCOUNT_PATH'))) {
            Storage::makeDirectory(Config::get('constants.ACCOUNT_PATH'), 0775, true);

        }

        $pdf->save(storage_path() . Config::get('constants.APP') . Config::get('constants.ACCOUNT_PATH') . 'account-' . $id . '.pdf');

        // Finally, you can download the file using download function
        return response()->download(storage_path(Config::get('constants.APP') . Config::get('constants.ACCOUNT_PATH') . 'account-' . $id . '.pdf'));
//        return $pdf->download($title.'.pdf');
    }
//TODO try block

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTerritory(Request $request)
    {
        return Address::getTerritories($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEducation(Request $request)
    {
        return Expert::getSpecialty($request->id);
    }

    public function getSpecialty(Request $request)
    {
        return Expert::getEducation($request->id);
    }

    public function gdPDFRole()
    {
        $accounts = $this->model->with([
            'user' => function ($query) {
                $query->select(['email', 'account_id', 'status']);
            },
            'prof' => function ($query) {
                $query->select(['account_id', 'diplomas']);
            }, 'prof.spec.type' => function ($query) {
                $query->select(['id', 'name']);
            }])->get();

        if (!empty($accounts)) {
            foreach ($accounts as $index => $account) {

                $home_address = json_decode($account->home_address, true);
                $accounts[$index]->h_region = getRegionName($home_address['h_region']);
                $accounts[$index]->h_street = $home_address['h_street'];
                $accounts[$index]->h_territory = getRegionName($home_address['h_territory']);

                $work_address = json_decode($account->work_address, true);
                $accounts[$index]->w_region = getRegionName($work_address['w_region']);
                $accounts[$index]->w_street = $work_address['w_street'];
                $accounts[$index]->w_territory = getRegionName($work_address['w_territory']);

                $profession = DB::table('professions AS p')
                    ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
                    ->join('specialties AS sp', 'sp.id', '=', 's.parent_id')
                    ->join('specialties_types AS st', 'st.id', '=', 's.type_id')
                    ->select('s.icon', 'sp.name as edu_name',
                        's.name AS spec_name')
                    ->where('p.account_id', '=', $account->id)
                    ->first();
                $accounts[$index]->profession = $profession;
            }
        }


        $pdf = PDF::loadView('backend.account.gd_role_pdf', ['datas' => $accounts])->setPaper('a4', 'landscape')->setWarnings(false);
        // If you want to store the generated pdf to the server then you can use the store function
        if (!Storage::exists(Config::get('constants.ACCOUNT_PATH'))) {
            Storage::makeDirectory(Config::get('constants.ACCOUNT_PATH'), 0775, true);
        }

        $pdf->save(storage_path() . Config::get('constants.APP') . Config::get('constants.ACCOUNT_PATH') . 'accounts.pdf');

        // Finally, you can download the file using download function
        return response()->download(storage_path(Config::get('constants.APP') . Config::get('constants.ACCOUNT_PATH') . 'accounts.pdf'));

    }

    public function gdExcel()
    {
        $role = Session::get('role');
        return Excel::download(new AccountExport($role),
            'accounts.xlsx');
    }

}
