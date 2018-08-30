@extends('layouts.layout')

@section('title', 'Edit Departemen '.$department->nama)
@section('page-title', 'Edit Departemen '.$department->nama)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/department">Department</a> <span class="fa-angle-right fa"></span> <a href="/department/{{ $department->id }}">Departemen {{ $department->nama }}</a> <span class="fa-angle-right fa"></span> Edit
@endsection

@section('content')
@component('components.form')
    @slot('title', 'Edit Departemen '.$department->nama)
    @slot('action', '/department/'.$department->id.'/edit')
    @slot('form_content')
        @component('components.input_text')
            @slot('label', 'Nama Departemen')
            @slot('type', 'text')
            @slot('name', 'nama')
            @slot('placeholder', 'Nama Departemen')
            @slot('value', $department->nama )
        @endcomponent
        @component('components.input_submit')
            @slot('value', 'Update')
        @endcomponent
    @endslot
    @slot('link')
@endcomponent
@endsection