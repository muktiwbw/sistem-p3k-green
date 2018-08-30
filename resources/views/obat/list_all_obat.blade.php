@extends('layouts.layout')

@section('title', 'List Obat')
@section('page-title', 'List Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> Obat
@endsection

@section('content')
@component('components.table')
    @slot('title')
    <h3>
       @if(Auth::user()->admin)
            <a href="/obat/create">Create</a>
        @endif
    </h3>
    @endslot

    @slot('head')
   <tr >
        <th>No.</th>
        <th>Nama Obat</th>
        <th></th>
    </tr>
    @endslot

    @slot('body')
   @foreach($obats as $obat)
    <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $obat->nama }}</td>
        <td><a href="/obat/{{ $obat->id }}">Detail</a></td>
    </tr>
    @endforeach
    @endslot

@endcomponent
@endsection