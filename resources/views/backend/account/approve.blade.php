@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                     data-ktwizard-state="step-first">
                    <div class="kt-grid__item">

                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div><br/>
                        @endif
                        @if (Session::has('delete'))
                            <div class="alert alert-info">
                                <p>{{ Session::get('delete') }}</p>
                            </div>
                        @endif
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label title__head">
                                <h3 class="kt-portlet__head-title ">
                                   <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-user-add"></i>
                                   {{__('messages.approve_payment')}} &nbsp;
                                       </span>
                                </h3>
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-information info">* {{__('messages.*_field_required')}}</i>
                                </span>
                            </div>

                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        &nbsp;
                                        <a href="{{action('Backend\AccountController@index','user')}}"
                                           class="btn btn-warning btn-sm ">
                                            <i class="la la-undo"></i>
                                            {{__('messages.back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                            <!--begin: Form Wizard Form-->
                            <form class="kt-form" id="kt_form" method="post" enctype="multipart/form-data"
                                  action="{{ action('Backend\AccountController@approvePayment')}}">
                                @csrf
                                {{--                            <input name="_method" type="hidden" value="PATCH">--}}
                                <!--begin: Form Wizard Step 1-->
                                <div id="kt-wizard_general" class="kt-wizard-v3__content"
                                     data-ktwizard-type="step-content"
                                     data-ktwizard-state="current">

                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form">
                                            <div class="form-group row validated">
                                                <label for="orderid"
                                                       class="col-lg-3 col-form-label">{{__('OrderID')}}*</label>
                                                <div class="col-lg-9">

                                                    <input id="orderid" type="text" name="orderid"
                                                           class="form-control @if($errors->first('orderid')){{'is-invalid'}} @endif"
                                                           value="{{old('orderid')}}">
                                                    @error('orderid')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row validated">
                                                <label for="paymentid"
                                                       class="col-lg-3 col-form-label">{{__('PaymentID')}}*</label>
                                                <div class="col-lg-9">
                                                    <input id="paymentid" type="text" name="paymentid"
                                                           class="form-control @if($errors->first('paymentid')){{'is-invalid'}} @endif"
                                                           value="{{old('paymentid')}}">
                                                    @error('paymentid')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row validated">
                                                <label for="course"
                                                       class="col-lg-3 col-form-label">{{__('messages.courses')}}*</label>
                                                <div class="col-lg-9">
                                                    <select id="course" type="text" name="course_id"
                                                           class="form-control @if($errors->first('course')){{'is-invalid'}} @endif">
                                                       <option value="">{{__('messages.choose_course')}}</option>
                                                        @if(!empty($courses))
                                                            @foreach($courses as $course)
                                                                <option value="{{$course['id']}}">{{$course['name']}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('course')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" name="account_id" value="{{$id}}">
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1-->

                                <div class="kt-form__actions text-right float-lg-right">
                                    <button type="submit"
                                            class="btn btn-primary">{{__('messages.save')}}</button>
                                </div>

                                <!--end: Form Actions -->
                            </form>

                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>

@endsection
