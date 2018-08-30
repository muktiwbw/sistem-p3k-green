@extends('layouts.layout')

@section('title', 'Register')

@section('content')
    @component('components.form')
        @slot('title', 'Register')
        @slot('action', '/register')
        @slot('form_content')
            @component('components.input_text')
                @slot('label', 'Nama')
                @slot('type', 'text')
                @slot('name', 'nama')
                @slot('placeholder', 'Nama')
                @slot('value', '')
            @endcomponent
            @component('components.input_text')
                @slot('label', 'Username')
                @slot('type', 'text')
                @slot('name', 'username')
                @slot('placeholder', 'Username')
                @slot('value', '')
            @endcomponent
            @component('components.input_text')
                @slot('label', 'Password')
                @slot('type', 'password')
                @slot('name', 'password')
                @slot('placeholder', 'Password')
                @slot('value', '')
            @endcomponent
            @component('components.input_dropdown')
                @slot('label', 'Department')
                @slot('name', 'department_id')
                @slot('options')
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->nama }}</option>
                    @endforeach
                @endslot
            @endcomponent
            <br>
            <br>
            @component('components.input_text')
                @slot('label', 'No. Ext')
                @slot('type', 'text')
                @slot('name', 'no_ext')
                @slot('placeholder', 'No. Ext')
                @slot('value', '')
            @endcomponent
            @component('components.input_text')
                @slot('label', 'Email Bagian')
                @slot('type', 'text')
                @slot('name', 'email_bagian')
                @slot('placeholder', 'Email Bagian')
                @slot('value', '')
            @endcomponent
            @component('components.input_submit')
                @slot('value', 'Register')
            @endcomponent
        @endslot
        @slot('link')<a href="/">Login</a>@endslot
    @endcomponent
@endsection

<?php
// $departments = ['a', 'b', 'c', 'd']
// <!-- foreach ini bisa digunakan untuk array dan object -->
// foreach($departments as $department){
//     echo $department
// }

// $departments = ['a', 'b', 'c', 'd']
// <!-- BIasanya digunakan untuk array -->
// foreach($departments as $key => $value){
//     echo $key, $value
// }
?>