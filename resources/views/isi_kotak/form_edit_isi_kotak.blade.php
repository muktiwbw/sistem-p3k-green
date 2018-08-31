@extends('layouts.layout')

@section('title', 'Edit Isi Kotak '.$kotak_id)
@section('page-title', 'Edit Isi Kotak '.$kotak_id)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/kotak">Kotak</a> <span class="fa-angle-right fa"></span> <a href="/kotak/{{ $kotak_id }}">Kotak {{ $kotak_id }}</a> <span class="fa-angle-right fa"></span> Edit Isi Kotak {{ $kotak_id }}
@endsection
@section('content')

<form action="/isi_kotak/{{ $kotak_id }}/edit" method="post">
    @component('components.table')
        @slot('title')
            <h3>Edit Isi Kotak {{ $kotak_id }}</h3>
        @endslot
        @slot('head')
            <tr align="center">
                <th>No.</th>
                <th>Nama Obat</th>
                <th>Ketersediaan</th>
                <th>Tanggal Expired</th>
                <th>Terakhir Pesan</th>
                <th></th>
            </tr>
        @endslot
        @slot('body')
            @foreach($isi_kotaks as $isi_kotak)
                <tr align="center">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $isi_kotak->obat->nama }}</td>
                    <td>@if(!$isi_kotak->ada) Kosong @else Ada @endif</td>
                    <td>@if($isi_kotak->tgl_expired == null) - @else {{ date('d F Y', strtotime($isi_kotak->tgl_expired)) }} @endif</td>
                    <td>
                    @if($isi_kotak->orderItems()->whereHas('order', function($query){
                        $query->where('status', 1)->orderBy('tgl_status', 'desc')->orderBy('updated_at', 'desc');
                    })->count() > 0)
                    {{ date('d F Y', strtotime($isi_kotak->orderItems()->whereHas('order', function($query){
                        $query->where('status', 1)->orderBy('tgl_status', 'desc')->orderBy('updated_at', 'desc');
                    })->first()->order->tgl_status)) }}
                    @else
                    -
                    @endif
                    </td>
                    <td><input type="checkbox" name="isi_kotak_id[]" value="{{ $isi_kotak->id }}" @if(!$isi_kotak->ada) disabled @endif></td>
                </tr>
            @endforeach
        @endslot
    @endcomponent <!-- End of table component -->
    @csrf
    @component('components.input_submit')
        @slot('value', 'Tandai Habis')
    @endcomponent
</form>
@endsection