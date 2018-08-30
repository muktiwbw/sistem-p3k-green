@extends('layouts.layout')

@section('title', 'Daftar Kotak')
@section('page-title', 'Daftar Kotak')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> Kotak
@endsection

@section('content')
@if(Auth::user()->admin)
<a href="/kotak/create">Create</a> / <a href="/isi_kotak/update_expired">Update Expired Obat</a>
@endif
@if(!Auth::user()->admin)
@if(Auth::user()->kotak != null)
@component('components.table')
    @slot('title')
    <h3>
        Kotak Anda
    </h3>
    @endslot

    @slot('head')
    <tr >
        <th>Nomor Kotak</th>
        <th>Departemen</th>
        <th>Bagian</th>
        <th>Lokasi</th>
        <th>Penanggung Jawab</th>
        <th></th>
    </tr>
    @endslot

    @slot('body')
   <tr align="center">
        <td>Kotak {{ Auth::user()->kotak->id }}</td>
        <td>{{ Auth::user()->department->nama }}</td>
        <td>{{ Auth::user()->kotak->bagian }}</td>
        <td>{{ Auth::user()->kotak->lokasi }}</td>
        <td>{{ Auth::user()->nama }}</td>
        <td><a href="/kotak/{{ Auth::user()->kotak->id }}">Detail</a></td>
    </tr>
    @endslot
@endcomponent

@else
<p>Anda tidak memiliki kotak.</p>
@endif
@endif

@if($kotaks->whereNotIn('user_id', [Auth::id()])->count() > 0)
@component('components.table')
    @slot('title')
    <h3>
        @if(!Auth::user()->admin)
        Kotak Lain
        @else
        Daftar Kotak
        @endif
    </h3>
    @endslot

    @slot('head')

       <tr >
            <th>No.</th>
            <th>Nomor Kotak</th>
            <th>Departemen</th>
            <th>Bagian</th>
            <th>Lokasi</th>
            <th>Penanggung Jawab</th>
            <th></th>
       </tr>
    @endslot

    @slot('body')
   <tr ">
     @foreach($kotaks->whereNotIn('user_id', [Auth::id()]) as $kotak)
        <td>{{$loop->index + 1}}</td>
        <td>Kotak {{ $kotak->id }}</td>
        <td>{{ $kotak->user->department->nama }}</td>
        <td>{{ $kotak->bagian }}</td>
        <td>{{ $kotak->lokasi }}</td>
        <td>{{ $kotak->user->nama }}</td>
        <td><a href="/kotak/{{ $kotak->id }}">Detail</a></td>
    </tr>
    @endforeach
    @endslot
@endcomponent
<!-- Kotak yang bukan punya kita -->

@else
<p>Belum ada kotak yang terdaftar.</p>
@endif
@endsection