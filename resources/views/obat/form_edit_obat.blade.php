@extends('layouts.layout')

@section('title', 'Edit '.$obat->nama)
@section('page-title', $obat->nama)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/obat">Obat</a> 
<span class="fa-angle-right fa"></span> {{ $obat->nama }}
@endsection

@section('content')
@component('components.form')
    @slot('title', 'Edit'.$obat->nama)
    @slot('action', '/obat/'.$obat->id.'/edit')
    @slot('form_content')
        @component('components.input_text')
            @slot('label', 'Nama Obat')
            @slot('type', 'text')
            @slot('name', 'nama')
            @slot('placeholder', 'Nama Obat')
            @slot('value', $obat->nama)
        @endcomponent
        @component('components.input_text')
            @slot('label', 'Stok')
            @slot('type', 'number')
            @slot('name', 'stok')
            @slot('placeholder', 'Stok Gudang')
            @slot('value', $obat->stok)
        @endcomponent
        @component('components.input_submit')
            @slot('value', 'Update')
        @endcomponent
    @endslot
    @slot('link')
@endcomponent
@endsection