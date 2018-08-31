@extends('layouts.layout')

@if(Auth::user()->admin)
    @section('title', 'Daftar Kotak')
    @section('page-title', 'Daftar Kotak')
@else
    @section('title', 'Daftar Kotak Pada Departemen Anda')
    @section('page-title', 'Daftar Kotak Pada Departemen Anda')
@endif

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> Kotak
@endsection

@section('content')
<div class="col-md-12">
    @if(Auth::user()->admin)
    <a href="/isi_kotak/update_expired">Update Expired Obat</a>
    @endif
</div>
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
        <td>@if(Auth::user()->department) {{ Auth::user()->department->nama }} @else - @endif</td>
        <td>{{ Auth::user()->kotak->bagian }}</td>
        <td>{{ Auth::user()->kotak->lokasi }}</td>
        <td>{{ Auth::user()->nama }}</td>
        <td><a href="/kotak/{{ Auth::user()->kotak->id }}">Detail</a></td>
    </tr>
    @endslot
@endcomponent

@else
<div class="col-md-12">
    <p>Anda tidak memiliki kotak.</p>
</div>
@endif
@endif

@if($kotaks->whereNotIn('user_id', [Auth::id()])->count() > 0)
@component('components.table')
    @slot('title')
    <h3>
        @if(!Auth::user()->admin)
        Kotak Lain Pada Departemen Anda
        @else
        Daftar Kotak @if(Auth::user()->admin) <a href="/kotak/create"><i class="fa fa-plus-circle"></i></a> @endif
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
    @foreach($kotaks->whereNotIn('user_id', [Auth::id()]) as $kotak)
    @if(Auth::user()->admin || ($kotak->user && $kotak->user->department && $kotak->user->department->id == Auth::user()->department_id))
    <tr>
        <td>{{$loop->index + 1}}</td>
        <td>Kotak {{ $kotak->id }}</td>
        <td>@if($kotak->user && $kotak->user->department) {{ $kotak->user->department->nama }} @else - @endif</td>
        <td>{{ $kotak->bagian }}</td>
        <td>{{ $kotak->lokasi }}</td>
        <td>@if($kotak->user) {{ $kotak->user->nama }} @else - @endif</td>
        <td><a href="/kotak/{{ $kotak->id }}">Detail</a></td>
    </tr>
    @endif
    @endforeach
    @endslot
@endcomponent
<!-- Kotak yang bukan punya kita -->

@else
<div class="col-md-12">
    <p>Belum ada kotak yang terdaftar. @if(Auth::user()->admin) <a href="/kotak/create">Silahkan membuat kotak baru.</a> @endif</p>
</div>
@endif
@endsection