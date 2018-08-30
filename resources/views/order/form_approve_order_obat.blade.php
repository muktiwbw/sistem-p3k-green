@extends('layouts.layout')

@section('title', 'Approve Order Obat')
@section('page-title', 'Approve Order Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/order">Order</a> 
<span class="fa-angle-right fa"></span> Order Kotak {{ $order->kotak->id }}
@endsection

@section('content')
<form action="/order/{{$order->id}}/approve" method="post">
    <table border="1">
        <tr align="center">
            <th>No.</th>
            <th>Nama Obat</th>
            <th>Jumlah Order</th>
            <th>Stok Gudang</th>
            <th>Tanggal Expired</th>
        </tr>
            @foreach($order->orderItems as $orderItem)
            <tr align="center">
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
    </table>
    @csrf
    <input type="submit" name="submit" value="Approve">
</form>
@endsection