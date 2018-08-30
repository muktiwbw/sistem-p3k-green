@extends('layouts.layout')

@section('title', 'List Department')
@section('page-title', 'List Department')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> Department
@endsection

@section('content')

@component('components.table')
    @slot('title')
    <h3>
        Department @if(Auth::user()->admin) <a href="/department/create"><i class="fa fa-plus-circle"></i></a> @endif
    </h3>
    @endslot

    @slot('head')
    <tr>
        <th>No.</th>
        <th>Nama Department</th>
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