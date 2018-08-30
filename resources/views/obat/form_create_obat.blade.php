@extends('layouts.layout')

@section('title', 'Create Obat')
@section('page-title', 'Buat Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/obat">Obat</a> <span class="fa-angle-right fa"></span> Buat
@endsection

@section('content')

@component('components.form')
    @slot('title', 'Buat Obat')
    @slot('action', '/obat/create')
    @slot('form_content')
        @component('components.input_text')
            @slot('label', 'Nama Obat')
            @slot('type', 'text')
            @slot('name', 'nama')
            @slot('placeholder', 'Nama Obat')
            @slot('value', '')
        @endcomponent
        @component('components.input_checkbox')
            @slot('name', 'expirable')
            @slot('text', 'Expirable')
        @endcomponent
        @component('components.input_submit')
            @slot('value', 'Create')
        @endcomponent
    @endslot
    @slot('link')
@endcomponent

@endsection