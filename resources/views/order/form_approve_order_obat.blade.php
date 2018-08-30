@extends('layouts.layout')

@section('title', 'Approve Order Obat')
@section('page-title', 'Approve Order Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/order">Order</a> 
<span class="fa-angle-right fa"></span> Order Kotak {{ $order->kotak->id }}
@endsection

@section('content')
@component('components.form')
    @slot('title', 'menyetujui')
    @slot('action', '/order/'.$order->id.'/approve')
    @slot('form_content')
    @component('components.table')
    @slot('title')
    <h3>
        Menyetujui Permintaan Obat 
    </h3>
    @endslot

    @slot('head')
     <tr >
            <th>No.</th>
            <th>Nama Obat</th>
            <th>Jumlah Order</th>
            <th>Stok Gudang</th>
            <th>Tanggal Expired</th>
        </tr>
    @endslot

    @slot('body')
     @foreach($order->orderItems as $orderItem)
            <tr >
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $orderItem->isiKotak->obat->nama }}</td>
                <td>1</td>
                <td>{{ $orderItem->isiKotak->obat->stok }}</td>
                <td>
                    @if($orderItem->isiKotak->obat->expirable)
                    <input type="date" name="tgl_expired[]">
                    @else
                    <input type="hidden" name="tgl_expired[]" value="0"> -
                    @endif
                    <input type="hidden" name="order_item_id[]" value="{{ $orderItem->id }}">
                </td>
            </tr>
            @endforeach
    @endslot
@endcomponent
@endslot
@slot('link')
    @component('components.input_submit')
            @slot('value','setuju')
        @endcomponent
    @endslot
@endcomponent
@endsection