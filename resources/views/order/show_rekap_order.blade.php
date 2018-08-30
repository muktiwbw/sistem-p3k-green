@extends('layouts.layout')

@section('title', 'Rekap Order Obat')
@section('page-title', 'Rekap Order Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/order">Order</a>
 <span class="fa-angle-right fa"></span> Rekap
@endsection

@section('content')
<h2>Obat yang sering diminta</h2>
<table border="1">
    <tr align="center">
        <th>No.</th>
        <th>Nama Obat</th>
        <th>Total Diminta</th>
    </tr>
    @foreach($obats as $obat)
    <tr align="center">
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $obat->nama }}</td>
        <td>{{ $obat->total }}</td>
    </tr>
    @endforeach
</table>

<h2>Department yang sering meminta obat</h2>
<table border="1">
    <tr align="center">
        <th>No.</th>
        <th>Nama Department</th>
        <th>Total Permintaan</th>
    </tr>
    @foreach($departments as $department)
    <tr align="center">
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $department->nama }}</td>
        <td>{{ $department->total }}</td>
    </tr>
    @endforeach
</table>
@endsection