@extends('layouts.layout')

@section('title', 'Departemen '.$department->nama)
@section('page-title', 'Departemen '.$department->nama)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/department">Departemen</a> <span class="fa-angle-right fa"></span> Departemen {{ $department->nama }}
@endsection

@section('content')
 <h4>
        @if(Auth::user()->admin) 
        <a href="/department/{{ $department->id }}/edit"><i class="fa fa-pencil"></i> Edit</a> | <a href="/department/{{ $department->id }}/delete"><i class="fa fa-trash"></i> Delete</a> 
        @endif
    </h4>
@if($department->users()->has('kotak')->count() > 0)
@component('components.table')
    @slot('title')
    <h3>
        Departemen {{ $department->nama }}
    </h3>
    @endslot

    @slot('head')
    <tr align="center">
        <th>No.</th>
        <th>Nomor Kotak</th>
        <th>Bagian</th>
        <th>Lokasi</th>
        <th>Penanggung Jawab</th>
        <th>Tanggal Registrasi</th>
        <th></th>
    </tr>
    @endslot

    @slot('body')
    @foreach($department->users()->has('kotak')->get() as $user)
    <tr align="center">
        <td>{{ $loop->index + 1 }}</td>
        <td>Kotak {{ $user->kotak->id }}</td>
        <td>{{ $user->kotak->bagian }}</td>
        <td>{{ $user->kotak->lokasi }}</td>
        <td>{{ $user->nama }}</td>
        <td>{{ date('d F Y', strtotime($user->kotak->created_at)) }}</td>
        <td><a href="/kotak/{{ $user->kotak->id }}">Detail</a></td>
    </tr>
    @endforeach
    @endslot
@endcomponent

@else
Tidak ada kotak yang terdaftar pada department ini.
@endif
@endsection