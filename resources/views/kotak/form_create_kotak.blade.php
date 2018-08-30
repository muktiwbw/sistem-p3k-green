@extends('layouts.layout')

@section('title', 'Create Kotak')
@section('page-title', 'Buat Kotak')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/kotak">Kotak</a> 
<span class="fa-angle-right fa"></span> Create
@endsection

@section('content')

@if($users->count() == 0)
Tidak ada penanggung jawab yang tersedia saat ini.
@else
@component('components.form')
    @slot('title', 'Tambah Kotak')
    @slot('action', '/kotak/create')
    @slot('form_content')

        @component('components.input_text')
            @slot('label', 'Nama Bagian')
            @slot('type', 'text')
            @slot('name', 'bagian')
            @slot('placeholder', 'Bagian')
            @slot('value' , '')
        @endcomponent

        @component('components.input_text')
            @slot('label', 'Nama Lokasi')
            @slot('type', 'text')
            @slot('name', 'lokasi')
            @slot('placeholder', 'Lokasi')
            @slot('value', '')
        @endcomponent

        @component('components.input_dropdown')
	        @slot('label', 'Penanggung Jawab')
	        @slot('name','user_id' )
	        @slot('options')
				@foreach($users as $user)
		        <option value="{{ $user->id }}">{{ $user->nama }}</option>
		        @endforeach
	        @endslot
	     @endcomponent

        @component('components.input_submit')
            @slot('value', 'Create')
        @endcomponent

    @endslot
    @slot('link')

@endcomponent
@endif
@endsection