@extends('layouts.master')
@section('content')
    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br/>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <p>{{ \Session::get('error') }}</p>
            </div>
        @endif
        @if (Session::has('delete'))
            <div class="alert alert-info">
                <p>{{ Session::get('delete') }}</p>
            </div>
        @endif

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-admins-1"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        {{__('messages.users')}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-hover table-checkable" id="kt_table_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('messages.name')." ".__('messages.surname')." ".__('messages.father_name')}}</th>
                        <th>{{__('messages.course_name')}}</th>
                        <th>{{__('messages.payment')}}</th>
                        <th>{{__('messages.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(!$payments->isEmpty())
                        @foreach($payments as $key => $payment)
                            @if(!empty($payment->user))
                                <tr class="text-center">
                                    <td></td>
                                    <td>@if(!empty($payment->name)){{$payment->name}}@endif
                                        @if(!empty($payment->surname)){{$payment->surname}}@endif
                                        @if(!empty($payment->father_name)){{$payment->father_name}}@endif
                                    </td>
                                    <td>
                                        @if(!empty($payment->course)) {{$payment->course->name}}@endif
                                    </td>
                                    <td>
                                        @if(!empty($payment->payment)) {{$payment->payment}}@endif
                                    </td>
                                    <td>
                                        <div class="row justify-content-end">
                                            <a href="{{action('Backend\PaymentController@show', $payment->id)}}"
                                               class="btn btn-info kt-badge kt-badge--lg"
                                               data-toggle="m-tooltip" data-placement="top"
                                               data-original-title="{{__('messages.show')}}">
                                                <i class="la la-eye"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>
@endsection
