@extends('layouts.layout')

@section('title', 'Create Order Obat')
@section('page-title', 'Create Order Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/kotak">Kotak</a>
<span class="fa-angle-right fa"></span> <a href="/kotak/{{ $user->kotak->id }}"> Kotak {{ $user->kotak->id }}</a >
<span class="fa-angle-right fa"></span> Order Obat Kotak {{ $user->kotak->id }}
@endsection

@section('content')
<h2>Penanggung Jawab: {{ $user->nama }}</h2>
<p>Nomor Kotak: {{ $user->kotak->id }}</p>
<p>Bagian: {{ $user->kotak->bagian }}</p>
<p>Lokasi: {{ $user->kotak->lokasi }}</p>
<p>Department: {{ $user->department->nama }}</p>
@component('components.form')
    @slot('title', 'Membuat Permintaan Obat')
    @slot('action', '/order/create')
    @slot('form_content')
@component('components.table')
    @slot('title')
    <h3>
         Membuat Permintaan Obat
    </h3>
    @endslot

    @slot('head')
    <tr align="center">
            <th>No.</th>
            <th>Nama Obat</th>
            <th>Ketersediaan</th>
            <th></th>
        </tr>
    @endslot

    @slot('body')
    @foreach($user->kotak->isiKotaks as $isiKotak)
        <tr align="center">
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $isiKotak->obat->nama }}</td>
            <td>@if(!$isiKotak->ada) Kosong @else Ada @endif</td>
            <td><input type="checkbox" name="isi_kotak_id[]" value="{{ $isiKotak->id }}" @if($isiKotak->ada || $isiKotak->obat->stok <= 0) disabled @endif></td>
        </tr>
        @endforeach
    @endslot
@endcomponent
@endslot
@slot('link')
    @component('components.input_submit')
            @slot('value','Kirim Permintaan')
        @endcomponent
    @endslot
    @endcomponent
@endsection