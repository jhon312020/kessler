@extends('errors::minimal')
<link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
@section('title', __('Page Expired'))
@section('code', '419')
@php
$homelink = __('Page Expired');
@endphp
@section('message')
<p>{{ $homelink }} <a href="{{ route('index') }}" class='btn btn-danger'>Home</a></p>
@endsection