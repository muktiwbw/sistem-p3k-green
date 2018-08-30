@extends('layouts.layout')

@section('title', 'Edit '.$user->nama)
@section('page-title', $user->nama)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> 
@if(Auth::user()->admin)
<a href="/user">User</a> <span class="fa-angle-right fa"></span> 
<a href="/user/$user->id">{{ $user->nama }}</a> <span class="fa-angle-right fa"></span>
Edit
@else
Setting
@endif
@endsection

@section('content')
@component('components.form')
    @slot('title', 'Edit User')
    @slot('action', '/user/'.$user->id.'/edit')
    @slot('form_content')
        @component('components.input_text')
            @slot('label', 'Nama')
            @slot('type', 'text')
            @slot('name', 'nama')
            @slot('placeholder', 'Nama')
            @slot('value', $user->nama)
        @endcomponent
        @component('components.input_text')
            @slot('label', 'User Name')
            @slot('type', 'text')
            @slot('name', 'username')
            @slot('placeholder', 'User Name')
            @slot('value', $user->username)
        @endcomponent
        @component('components.input_text')
            @slot('label', 'Password')
            @slot('type', 'password')
            @slot('name', 'password')
            @slot('placeholder', 'Password')
            @slot('value', '')
        @endcomponent
        @component('components.input_submit')
            @slot('value', 'Create')
        @endcomponent
    @endslot
    @slot('link')
@endcomponent
@endsection