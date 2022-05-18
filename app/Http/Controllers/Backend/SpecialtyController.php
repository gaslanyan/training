<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Services\SpecialtyService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    // space that we can use the repository from
    private $service;

    public function __construct(SpecialtyService $service)
    {

        $this->service = $service;
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $specs = $this->service->getParentSpecialties();

            return view('backend.specialty.index',
                compact('specs'));
        } catch (ModelNotFoundException $exception) {

            logger()->error($exception);
            return redirect('backend/specialty')->with('error', __('specialtys.wrong'));
        }
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function list(Request $request)
    {
        $data = Specialty::query()->get()->toArray();
        $tmp = [];

        if (!empty($data)) {
            foreach ($data as $datum) {

                if ($datum['parent_id']) {
                    $tmp[$datum['parent_id']]['children'][] = $datum;
                } else {
                    $tmp[$datum['id']] = $datum;
                }
            }
        }

        return json_encode($tmp);
    }
public function SpecialtyController(Request $request)
    {
        $ids =[];
        $sl = $request->get('sl');
        if(!empty($sl)){
            if(count($sl) == 1)
                $ids = ($sl[0] == "senior")?[1,3]:[2,4];
            else
                $ids =[1,2,3,4] ;
        }

        $data = Specialty::query()->whereIn('parent_id',$ids)->get()->toArray();
        $tmp = [];

        if (!empty($data)) {
            foreach ($data as $datum) {

                if (!$datum['parent_id']) {
                    $tmp[$datum['parent_id']]['children'][] = $datum;
                } else {
                    $tmp[$datum['id']] = $datum['id'];
                }
            }
        }

        return json_encode($tmp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            $types = $this->service->getSpecialtiesType();

            return view('backend.specialty.create', compact('types'));
        } catch (ModelNotFoundException  $exception) {

            logger()->error($exception);
            return redirect('backend/specialty')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $this->service->store($request);
            return redirect('backend/specialty')->with('success', __('messages.success'));
        } catch (ModelNotFoundException $exception) {

            logger()->error($exception);
            return redirect('backend/specialty')->with('error', __('messages.wrong'));
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
            $specs = $this->service->getSpecialties($id);

            return view('backend.specialty.list',
                compact('specs'));
        } catch (ModelNotFoundException $exception) {
            //
            logger()->error($exception);
            return redirect('backend/specialty')->with('error', __('messages.wrong'));
        }
    }

//todo route without edit, update


    public function updateSpecialty(Request $request)
    {
        $response = [];
        try {

            if ($request->ajax()) {

                $i_id = $this->service->updateSpecialty($request);
                if ($i_id)
                    $response ['success'] = true;
            } else return redirect('backend/specialty')->with('error', __('messages.wrong'));
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            $response['success'] = false;
            $response['error'] = 'Do not save';

        }
        return response()->json($response);
    }

    public function checkSpecialty(Request $request)
    {
        try {

            if ($request->ajax()) {
                $i_id = $this->service->checkSpecialty($request->id);

                if (is_object($i_id))
                    $response ['success'] = null;
                else
                    $response ['success'] = false;
            } else return redirect('backend/specialty')->with('error', __('messages.wrong'));
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            $response['success'] = false;
            $response['error'] = 'Do not save';

        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return redirect('backend/specialty')->with('success', __('messages.deleted'));
        } catch (\Exception $e) {

            logger()->error($e);
            return redirect()->back()
//                ->withErrors($e->getErrors())
                ->withInput();
        }
    }
}
