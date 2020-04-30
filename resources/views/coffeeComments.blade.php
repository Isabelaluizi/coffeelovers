@extends('layouts.app')

@section('content')

<Coffeecomment :coffee="{{$coffee}}" :comments="{{$comments}}" />

@endsection
