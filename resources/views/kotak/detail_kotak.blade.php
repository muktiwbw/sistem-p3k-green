@extends('layouts.layout')

@section('title', 'Kotak '.$kotak->id)
@section('page-title', 'Kotak '.$kotak->id)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/kotak">Kotak</a> 
<span class="fa-angle-right fa"></span> Kotak {{ $kotak->id }}
@endsection

@section('content')
<p>Nomor Kotak: {{ $kotak->id }}</p>
<p>Bagian: {{ $kotak->bagian }}</p>
<p>Lokasi: {{ $kotak->lokasi }}</p>
<p>Departemen: {{ $kotak->user->department->nama }}</p>
<p>Penanggung Jawab: {{ $kotak->user->nama }}</p>
@if(Auth::user()->admin)
<p><a href="/kotak/{{ $kotak->id }}/edit">Edit</a> / <a href="/kotak/{{ $kotak->id }}/delete">Delete</a></p>
@endif
@component('components.table')
    @slot('title')
    <h3>
        Daftar Obat 
    </h3>
    <h4>
        @if($kotak->user->id == Auth::id())
        <a href="/isi_kotak/{{ $kotak->id }}/edit"><i class="fa fa-pencil"></i> Edit Daftar Obat</a> | 
        @if($kotak->orders->where('status', 0)->count() > 0)
        Order sedang menunggu persetujuan admin
        @else
        <a href="/order/create"><i class="fa fa-share-square"></i> Order Obat</a>
        @endif
        | 
        @endif
        <a href="/order/{{ $kotak->id }}/track"><i class="fa fa-history"></i> Riwayat Order</a> | <a href="/isi_kotak/update_expired"><i class="fa fa-retweet"></i> Update Expired Obat</a>
    </h4>
    @endslot

    @slot('head')
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Tanggal Expired</th>
        <th>Status Expired</th>
        <th>Ketersediaan</th>
    </tr>
    @endslot

    @slot('body')
    @foreach($kotak->isiKotaks as $isiKotak)
    <tr @if(!$isiKotak->ada || $isiKotak->expired) bgcolor="ffcece" @endif>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $isiKotak->obat->nama }}</td>
        <td>@if($isiKotak->tgl_expired == null) - @else {{ date('d F Y', strtotime($isiKotak->tgl_expired)) }} @endif</td>
        <td>@if($isiKotak->expired) Expired @else - @endif</td>
        <td>@if(!$isiKotak->ada) Kosong @else Ada @endif</td>
    </tr>
    @endforeach
    @endslot
@endcomponent

@endsection