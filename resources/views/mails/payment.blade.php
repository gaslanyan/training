@extends('layouts.pdf')
@section('content')
{{__('messages.payment_title')}} ,

<p>{{__('messages.payment_info')}}</p>
<div>
    {{--<p>{{ $body}}</p>--}}
    <ul>
        <li>{{__('messages.class') . " - ".$name}}</li>
        <li>{{__('messages.cost') . " - ".$data['Amount']}}</li>
        <li>{{__('messages.date') . " - ".$data['DateTime']}}</li>
        <li>{{__('messages.full_name') . " - ".$data['ClientName']}}</li>
    </ul>
</div>

<i>{{ __('messages.thank').$name}}</i>
<br>
@endsection
