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
<form action="/order/create" method="post">
    <table border="1">
        <tr align="center">
            <th>No.</th>
            <th>Nama Obat</th>
            <th>Ketersediaan</th>
            <th>Permintaan</th>
            <th>Jumlah</th>
            <th></th>
        </tr>
        @foreach($user->kotak->isiKotaks as $isiKotak)
        <tr align="center">
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $isiKotak->obat->nama }}</td>
            <td>@if(!$isiKotak->ada) Kosong @else Ada @endif</td>
            <td><input data-checkbox="{{ $loop->index + 1 }}" type="checkbox" name="isi_kotak_id[]" value="{{ $isiKotak->id }}" @if($isiKotak->ada) disabled @endif></td>
            <td><input data-number="{{ $loop->index + 1 }}" type="number" name="number[]" disabled></td>
        </tr>
        @endforeach
    </table>
    <input type="submit" name="submit" value="Kirim Order">
    @csrf
</form>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script>
    $(function(){
        
        $('input[type=checkbox]').change(function(){
            let data_checkbox = $(this).attr('data-checkbox')
            let checked = $(this).prop('checked')
            let number = $('input[data-number='+data_checkbox+']')
            
            number.prop('disabled', !checked)
        })

    })
</script>
@endsection