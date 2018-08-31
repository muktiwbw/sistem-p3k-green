@extends('layouts.layout')

@section('title', 'Create Departemen')
@section('page-title', 'Tambah Departemen')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/department">Departemen</a> <span class="fa-angle-right fa"></span> Tambah 
@endsection

@section('content')
@component('components.form')
    @slot('title', 'Tambah Departemen ')
    @slot('action', '/department/create')
    @slot('form_content')
        @component('components.input_text')
            @slot('label', 'Nama Departemen')
            @slot('type', 'text')
            @slot('name', 'nama')
            @slot('placeholder', 'Nama Departemen')
            @slot('value', '')
        @endcomponent
        @component('components.input_submit')
            @slot('value', 'Create')
        @endcomponent
    @endslot
    @slot('link')
@endcomponent
@endsection