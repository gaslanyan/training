<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\Expert;

/**
 * @group Front page
 *
 * APIs for front page
 * @package App\Http\Controllers\Frontend
 */
class ExpertController extends Controller
{
    use Expert;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function educate()
    {
        return $this->getEducate();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function education()
    {
        $id =request('id');
        return $this->getEducation($id);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function specialty()
    {
        /**
         * get Specialty by id
         *
         * @response
         * {"spec":[{"id":3,"name":"\u0534\u0535\u0542\u0531\u0533\u053b\u054f\u0531\u053f\u0531\u0546 \u0544\u0531\u054d\u0546\u0531\u0533\u053b\u054f\u0548\u0552\u0539\u0545\u0548\u0552\u0546\u0546\u0535\u0550"},{"id":7,"name":"\u0534\u0535\u0542\u0531\u0533\u053b\u054f\u0531\u053f\u0531\u0546 \u0546\u0535\u0542 \u0544\u0531\u054d\u0546\u0531\u0533\u053b\u054f\u0548\u0552\u0539\u0545\u0548\u0552\u0546\u0546\u0535\u0550"}]}
         */
        $id =request('id');
        return $this->getSpecialty($id);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function profession()
    {
        return $this->getProfession();
    }
}
