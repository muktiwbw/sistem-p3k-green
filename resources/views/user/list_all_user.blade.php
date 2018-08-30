@extends('layouts.layout')

@section('title', 'List User')
@section('page-title', 'List User')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> User
@endsection

@section('content')
@component('components.table')
    @slot('title')
    <h3>
       List User
    </h3>
    @endslot

    @slot('head')
  <tr >
        <th>No.</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Department</th>
        <th>Tanggal Registrasi</th>
        <th></th>
    </tr>
    @endslot

    @slot('body')
   @foreach($users as $user)
    <tr align="center">
        <td>{{ $loop->index + 1}}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->nama }}</td>
        <td>{{ $user->department->nama }}</td>
        <td>{{ $user->created_at }}</td>
        <td><a href="/user/{{ $user->id }}">Detail</a></td>
    </tr>
    @endforeach
    @endslot

@endcomponent
@endsection