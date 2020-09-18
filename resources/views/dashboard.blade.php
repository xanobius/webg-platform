@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>WebE HS-2020 Group Dashboard</h1>
        <div class="row">
            @foreach(\App\Models\User::get() as $usr)
                <div class="col-lg-4">
                    <group-animation-component
                        :user-id="{{ $usr->id }}"
                        get-url="{{ route('ajax.get-ajax-data', $usr->id) }}"
                        ws-url="{{ env('WS_URL') }}"
                        group-name="{{ $usr->name }}"
                        :ping-frequency="{{ config('app.ajax_ping_frequency') }}"
                    ></group-animation-component>
                </div>
            @endforeach
        </div>
    </div>
@endsection
