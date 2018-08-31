@extends('layouts.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
@component('components.info_panel')
    @slot('title', 'Selamat datang, '.Auth::user()->nama.'!')
    @slot('body')
    @endslot
@endcomponent
@endsection