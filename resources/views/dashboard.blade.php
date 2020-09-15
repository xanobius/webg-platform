@extends('layouts.app')

@section('content')
    Here we go
    @foreach(\App\Models\User::get() as $usr)
        <group-animation-component
            :user-id="{{ $usr->id }}"
            get-url="{{ route('ajax.get-chat-messages', $usr->id) }}"
            group-name="{{ $usr->name }}"
        ></group-animation-component>
    @endforeach


@endsection
