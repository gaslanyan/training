@extends('layouts.pdf')
@section('content')
{{__('messages.payment_title')}} ,

<p>{{__('messages.payment_info')}}</p>
<div>
    {{--<p>{{ $body}}</p>--}}
    <ul>
        <li>{{__('messages.course') . " - ".$name}}</li>
        <li>{{__('messages.full_name') . " - ".$data['ClientName']}}</li>
        <li>{{__('messages.cost') . " - ".$data['Amount'].__('messages.amd')}}</li>
        <li>{{__('messages.date') . " - ".$data['DateTime']}}</li>

    </ul>
</div>

<i>{{ __('messages.thank_you')}}</i>
<br>
@endsection
