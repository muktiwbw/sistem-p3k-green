@extends('layouts.layout')

@section('title', 'Edit Kotak '.$kotak->id)
@section('page-title', 'Edit Kotak '.$kotak->id)

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/kotak">Kotak</a> 
<span class="fa-angle-right fa"></span> Edit
@endsection

@section('content')
@component('components.form')
    @slot('title', 'Edit Kotak'.$kotak->id)
    @slot('action', '/kotak/'.$kotak->id.'/edit')
    @slot('form_content')

        @component('components.input_text')
            @slot('label', 'Nama Bagian')
            @slot('type', 'text')
            @slot('name', 'bagian')
            @slot('placeholder', 'Nama Bagian')
            @slot('value' , $kotak->bagian)
        @endcomponent

        @component('components.input_text')
            @slot('label', 'Nama Lokasi')
            @slot('type', 'text')
            @slot('name', 'lokasi')
            @slot('placeholder', 'Nama Bagian')
            @slot('value', $kotak->lokasi)
        @endcomponent

        @component('components.input_dropdown')
            @slot('label', 'Department')
            @slot('name','department_id')
            @slot('options')
               @foreach($departments as $department)
             <option value="{{ $department->id }}" 
            @if($department->id == $kotak->user->department_id)
            selected
            @endif
         >{{ $department->nama }}</option>
             @endforeach
            @endslot
            @endcomponent
            
         @component('components.input_dropdown')
            @slot('label', 'Penanggung Jawab')
            @slot('name','user_id' )
            @slot('options')
                  @foreach($users as $user)
                 <option value="{{ $user->id }}" 
                 @if($user->id == $kotak->user_id)
                selected
                @endif
                >{{ $user->nama }}</option>
                @endforeach
            @endslot
            @endcomponent

        @component('components.input_submit')
            @slot('value','Update')
        @endcomponent

    @endslot
    @slot('link')
@endcomponent
@endsection