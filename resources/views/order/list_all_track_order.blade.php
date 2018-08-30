@extends('layouts.layout')

@section('title', 'Riwayat Order Obat')
@section('page-title', 'Riwayat Order Obat Pada Kotak'.$kotak->id)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/kotak">Kotak</a>
<span class="fa-angle-right fa"></span> <a href="/kotak/{{ $kotak->id }}">Kotak {{ $kotak->id }}</a>
<span class="fa-angle-right fa"></span> Riwayat Order Obat Kotak {{ $kotak->id }}
@endsection

@section('content')
<p>Nomor Kotak: {{ $kotak->id }}</p>
<p>Bagian: {{ $kotak->bagian }}</p>
<p>Lokasi: {{ $kotak->lokasi }}</p>
<p>Department: {{ $kotak->user->department->nama }}</p>
<p>Penanggung Jawab: {{ $kotak->user->nama }}</p>
@if($kotak->orders->count() == 0)
<p>Tidak ada riwayat order untuk kotak ini.</p>
@else
@component('components.table')
    @slot('title')
    <h3>
        Riwayat Permintaan 
    </h3>
    
    @endslot

    @slot('head')
     <tr align="center">
        <th>No.</th>
        <th>Daftar Obat</th>
        <th>Status</th>
        <th>Tanggal Status</th>
        <th>Tanggal Permintaan</th>
    </tr>
    @endslot

    @slot('body')
    @foreach($kotak->orders->sortByDesc('created_at') as $order)
        @foreach($order->orderItems as $order_item)
        <tr align="center">
            @if($loop->index == 0)
                <td rowspan="{{ $order->orderItems->count() }}">{{ $loop->parent->index + 1 }}</td>
            @endif
            <td>{{ $order_item->isiKotak->obat->nama }}</td>
            @if($loop->index == 0)
                <td rowspan="{{ $order->orderItems->count() }}">
                @switch($order->status)
                    @case(0)
                        Pending
                        @break
                    @case(1)
                        Approved
                        @break
                    @case(2)
                        Rejected
                        @break
                @endswitch
                </td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ date('d F Y', strtotime($order->tgl_status)) }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ date('d F Y', strtotime($order->created_at)) }}</td>
            @endif
        </tr>
        @endforeach
    @endforeach
    @endslot
@endcomponent
@endif
@endsection