<?php


namespace App\Http\Traits;


use App\Models\SpecialtiesType;
use App\Models\Specialty;

trait Expert
{

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    static function getEducation($id)
    {

        try {
            $edu = Specialty::select('id', 'name')->where('parent_id', $id)
                ->get();

            return response()->json(['edu' => $edu]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
//todo jnjel stugel

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    static function getEducate($id)
    {

        try {
            $edu = Specialty::select('id', 'name')->where('id', $id)->first();
           return response()->json(['edu' => $edu]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * APIs for font page
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    static function getSpecialty($id)
    {
        /**
         * get Specialty by id
         *
         * @response
         * {"spec":[{"id":3,"name":"\u0534\u0535\u0542\u0531\u0533\u053b\u054f\u0531\u053f\u0531\u0546 \u0544\u0531\u054d\u0546\u0531\u0533\u053b\u054f\u0548\u0552\u0539\u0545\u0548\u0552\u0546\u0546\u0535\u0550"},{"id":7,"name":"\u0534\u0535\u0542\u0531\u0533\u053b\u054f\u0531\u053f\u0531\u0546 \u0546\u0535\u0542 \u0544\u0531\u054d\u0546\u0531\u0533\u053b\u054f\u0548\u0552\u0539\u0545\u0548\u0552\u0546\u0546\u0535\u0550"}]}
         */


        try {
//            $spec = [];
            $spec = Specialty::select('id', 'name')->where('type_id', $id)
                ->whereNull('parent_id')
                ->get();

            return response()->json(['spec' => $spec]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    static function getProfession()
    {
        try {
            $prof = SpecialtiesType::select('name', 'id')->get();

            return response()->json(['prof' => $prof]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
}
