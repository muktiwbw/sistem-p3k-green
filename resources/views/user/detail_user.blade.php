@extends('layouts.layout')

@section('title', $user->nama)
@section('page-title', $user->nama)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/user">User</a>
 <span class="fa-angle-right fa"></span> {{ $user->nama }}
 @endsection
 
@section('content')
<p>Nama: {{ $user->nama }}</p>
<p>Username: {{ $user->username }}</p>
<p>Role: @if($user->role == 0) User @else Admin @endif</p>
<p>Department: {{ $user->department->nama }}</p>
<p>Tanggung Jawab Kotak: @if($user->kotak != null) <a href="/kotak/{{ $user->kotak->id }}">Kotak {{ $user->kotak->id }}</a> @else - @endif</p>
@if(Auth::user()->admin)
<p><a href="/user/{{ $user->id }}/edit">Edit</a> / <a href="/user/{{ $user->id }}/delete">Delete</a></p>
@endif
@endsection