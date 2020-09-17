@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>WebG Group Dashboard</h1>
        <div class="row">
            @foreach(\App\Models\User::get() as $usr)
                <div class="col-lg-4">
                    <group-animation-component
                        :user-id="{{ $usr->id }}"
                        get-url="{{ route('ajax.get-ajax-data', $usr->id) }}"
                        group-name="{{ $usr->name }}"
                    ></group-animation-component>
                </div>
            @endforeach
        </div>
    </div>
@endsection
