@extends('layouts.app')

@section('content')

    <Userprofile :auth="{{Auth::user()}}" />

@endsection
