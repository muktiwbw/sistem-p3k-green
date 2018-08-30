@extends('layouts.layout')

@section('title', $obat->nama)
@section('page-title', $obat->nama)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/obat">Obat</a> 
<span class="fa-angle-right fa"></span> {{ $obat->nama }}
@endsection

@section('content')
@if(Auth::user()->admin)
<p><a href="/obat/{{ $obat->id }}/edit">Edit</a> / <a href="/obat/{{ $obat->id }}/delete">Delete</a></p>
@endif
@if($obat->isiKotaks->count() > 0)
@component('components.table')
    @slot('title')
    <h3>
       Ketersediaan Obat Pada Kotak 
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
        <th>Ketersediaan</th>
        <th>Status</th>
        <th>Tanggal Expired</th>
        <th>Tanggal Permintaan Terakhir</th>
        <th></th>
    </tr>
    @endslot

    @slot('body')
    @foreach($obat->isiKotaks as $isiKotak)
    <tr align="center" @if(time() >= strtotime($isiKotak->tgl_expired) || !$isiKotak->ada) bgcolor="red" @endif>
        <td>{{ $loop->index + 1 }}</td>
        <td>Kotak {{ $isiKotak->kotak_id }}</td>
        <td>{{ $isiKotak->kotak->user->department->nama }}</td>
        <td>{{ $isiKotak->kotak->bagian }}</td>
        <td>{{ $isiKotak->kotak->lokasi }}</td>
        <td>{{ $isiKotak->kotak->user->nama }}</td>
        <td>@if(!$isiKotak->ada) Kosong @else Ada @endif</td>
        <td>@if($isiKotak->expired) Expired @else - @endif</td>
        <td>@if($isiKotak->tgl_expired == null) - @else {{ date('d F Y', strtotime($isiKotak->tgl_expired)) }} @endif</td>
        <td>
        @if($isiKotak->orderItems()->whereHas('order', function($query){
            $query->where('status', 1)->orderBy('tgl_status', 'desc')->orderBy('id', 'desc');
        })->count() > 0)
        {{ date('d F Y', strtotime($isiKotak->orderItems()->whereHas('order', function($query){
            $query->where('status', 1)->orderBy('tgl_status', 'desc')->orderBy('id', 'desc');
        })->first()->order->tgl_status)) }}
        @else
        -
        @endif
        </td>
        <td><a href="/kotak/{{ $isiKotak->kotak_id }}">Detail</a></td>
    </tr>
    @endforeach
    @endslot
@endcomponent
@else
<p>Belum ada kotak yang terdaftar.</p>
@endif
@endsection