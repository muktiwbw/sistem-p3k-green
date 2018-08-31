@extends('layouts.layout')

@section('title', 'Rekap Order Obat')
@section('page-title', 'Rekap Order Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/order">Order</a>
 <span class="fa-angle-right fa"></span> Rekap
@endsection

@section('content')
@component('components.table')
 @slot('title')
    <h3>
        Obat yang sering diminta
    </h3>
    @endslot

    @slot('head')
     <tr align="center">
        <th>No.</th>
        <th>Nama Obat</th>
        <th>Total Diminta</th>
    </tr>
    @endslot

    @slot('body')
    @foreach($obats as $obat)
    <tr align="center">
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $obat->nama }}</td>
        <td>{{ $obat->total }}</td>
    </tr>
    @endforeach
    @endslot
@endcomponent

@component('components.table')
 @slot('title')
    <h3>
        Departemen Yang Sering Melakukan Permintaan
    </h3>
    @endslot

    @slot('head')
     <tr align="center">
        <th>No.</th>
        <th>Nama Departemen</th>
        <th>Total Permintaan</th>
    </tr>
    @endslot

    @slot('body')
    @foreach($departments as $department)
    <tr align="center">
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $department->nama }}</td>
        <td>{{ $department->total }}</td>
    </tr>
    @endforeach
    @endslot
@endcomponent
@endsection