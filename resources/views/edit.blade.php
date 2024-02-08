@extends('layouts.app')
@section('nav-main','Main Page')

@section('content')
@include('form',['task'=>$task])
@endsection