@extends('layouts.app')

@section('content')
    <ajax-client base-url="{{ url('api') }}"></ajax-client>
@endsection
