@extends('layouts.layout')

@section('title', 'Login')
@section('content')

    @component('components.form')

        @slot('title', 'Login')
        @slot('action', '/')
        @slot('form_content')
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
                @component('components.input_submit')
                    @slot('value','Login')
                @endcomponent
        @endslot
        @slot('link')<a href="/register">Register</a>@endslot

    @endcomponent

@endsection