@extends('layouts.layout')

@section('title', 'Daftar Departemen')
@section('page-title', 'Daftar Departemen')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> Departemen
@endsection

@section('content')

@component('components.table')
    @slot('title')
    <h3>
        Departemen @if(Auth::user()->admin) <a href="/department/create"><i class="fa fa-plus-circle"></i></a> @endif
    </h3>
    @endslot

    @slot('head')
    <tr>
        <th>No.</th>
        <th>Nama Departemen</th>
        <th></th>
    </tr>
    @endslot

    @slot('body')
    @foreach($departments as $department)
    <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $department->nama }}</td>
        <td><a href="/department/{{ $department->id }}">Detail</a></td>
    </tr>
    @endforeach
    @endslot
@endcomponent

@endsection