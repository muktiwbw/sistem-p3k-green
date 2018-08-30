@extends('layouts.layout')

@section('title', 'Create Department')
@section('page-title', 'Tambah Department')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/department">Department</a> <span class="fa-angle-right fa"></span> Tambah 
@endsection

@section('content')
@component('components.form')
    @slot('title', 'Tambah Department ')
    @slot('action', '/department/create')
    @slot('form_content')
        @component('components.input_text')
            @slot('label', 'Nama Department')
            @slot('type', 'text')
            @slot('name', 'nama')
            @slot('placeholder', 'Nama Department')
            @slot('value', '')
        @endcomponent
        @component('components.input_submit')
            @slot('value', 'Create')
        @endcomponent
    @endslot
    @slot('link')
@endcomponent
@endsection