@extends('layouts.layout')

@section('title', 'List Order')
@section('page-title', 'List Order Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> Order
@endsection

@section('content')
<p><a href="/order/rekap">Lihat Rekap</a></p>
<h2>Order Masuk</h2>
@if($orders->where('status', 0)->count() > 0)
<table border="1">
    <tr align="center">
        <th>No.</th>
        <th>Nomor Kotak</th>
        <th>Department</th>
        <th>Bagian</th>
        <th>Lokasi</th>
        <th>Penanggung Jawab</th>
        <th>Daftar Obat</th>
        <th>Status</th>
        <th>Tanggal Status</th>
        <th>Tanggal Order</th>
        <th></th>
    </tr>
    @foreach($orders->where('status', 0)->sortByDesc('created_at') as $order)
        @foreach($order->orderItems as $order_item)
        <tr align="center">
            @if($loop->index == 0)
                <td rowspan="{{ $order->orderItems->count() }}">{{ $loop->parent->index + 1 }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->id }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->user->department->nama }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->bagian }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->lokasi }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->user->nama }}</td>
            @endif
            <td>{{ $order_item->isiKotak->obat->nama }}</td>
            @if($loop->index == 0)
                <td rowspan="{{ $order->orderItems->count() }}">Pending</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ date('d F Y', strtotime($order->tgl_status)) }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ date('d F Y', strtotime($order->created_at)) }}</td>
                <td rowspan="{{ $order->orderItems->count() }}"><a href="/order/{{ $order->id }}/approve">Approve</a> / <a href="/order/{{ $order->id }}/reject">Reject</a></td>
            @endif
        </tr>
        @endforeach
    @endforeach
</table>
@else
Tidak ada order masuk.
@endif

<h2>Riwayat Order</h2>
@if($orders->whereIn('status', [1, 2])->count() > 0)
<table border="1">
    <tr align="center">
        <th>No.</th>
        <th>Nomor Kotak</th>
        <th>Department</th>
        <th>Bagian</th>
        <th>Lokasi</th>
        <th>Penanggung Jawab</th>
        <th>Daftar Obat</th>
        <th>Status</th>
        <th>Tanggal Status</th>
        <th>Tanggal Order</th>
    </tr>
    @foreach($orders->whereIn('status', [1, 2])->sortByDesc('created_at') as $order)
        @foreach($order->orderItems as $order_item)
        <tr align="center">
            @if($loop->index == 0)
                <td rowspan="{{ $order->orderItems->count() }}">{{ $loop->parent->index + 1 }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->id }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->user->department->nama }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->bagian }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->lokasi }}</td>
                <td rowspan="{{ $order->orderItems->count() }}">{{ $order_item->isiKotak->kotak->user->nama }}</td>
            @endif
            <td>{{ $order_item->isiKotak->obat->nama }}</td>
            @if($loop->index == 0)
                <td rowspan="{{ $order->orderItems->count() }}">
                @switch($order->status)
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
</table>
@else
Riwayat order kosong.
@endif
@endsection