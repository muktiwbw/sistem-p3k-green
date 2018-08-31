@extends('layouts.layout')

@section('title', 'Create Order Obat')
@section('page-title', 'Create Order Obat')

@section('breadcrumb')
<a href="/dashboard">Dashboard</a> <span class="fa-angle-right fa"></span> <a href="/kotak">Kotak</a>
@if(!Auth::user()->admin)
<span class="fa-angle-right fa"></span> <a href="/kotak/{{ Auth::user()->kotak->id }}"> Kotak {{ Auth::user()->kotak->id }}</a >
@endif
<span class="fa-angle-right fa"></span> Order Obat Kotak @if(!Auth::user()->admin) {{ Auth::user()->kotak->id }} @endif

@endsection

@section('content')
@if(Auth::user()->admin && $kotaks->count() == 0)
    <div class="col-md-12">
        <p>Tidak ada kotak yang tersedia untuk membuat pesanan dikarenakan Admin belum merespon <a  href="/order">pesanan yang tertunda.</a></p>
    </div>
@else
    @if(Auth::user()->admin)
    <div class="col-md-12">
        <select id="user-dropdown" name="kotak_id">
            @foreach($kotaks as $kotak)
            <option value="{{ $kotak->id }}"
            @if($loop->index == 0) selected @endif
            >Kotak {{ $kotak->id }} - @if($kotak->user && $kotak->user->department) {{ $kotak->user->department->nama }} - {{ $kotak->user->nama }} @else Kotak belum terdaftar pada departemen manapun @endif</option>
            @endforeach
        </select>
    </div>
    @endif

    @component('components.info_panel')
        @slot('title', 'Info Kotak')
        @slot('body')
            <p>Penanggung Jawab: 
                @if(!Auth::user()->admin)
                    {{ Auth::user()->nama }}
                @else
                    <span id="d_u_nama"></span>
                @endif
            </p>
            <p>Nomor Kotak: 
                @if(!Auth::user()->admin)
                    {{ Auth::user()->kotak->id }}
                @else
                    <span id="d_k_id"></span>
                @endif
            </p>
            <p>Bagian: 
                @if(!Auth::user()->admin)
                    {{ Auth::user()->kotak->bagian }}
                @else
                    <span id="d_k_bagian"></span>
                @endif
            </p>
            <p>Lokasi: 
                @if(!Auth::user()->admin)
                    {{ Auth::user()->kotak->lokasi }}
                @else
                    <span id="d_k_lokasi"></span>
                @endif
            </p>
            <p>Department: 
                @if(!Auth::user()->admin && Auth::user()->department)
                    {{ Auth::user()->department->nama }}
                @else
                    <span id="d_k_department"></span>
                @endif
            </p>
        @endslot
    @endcomponent
    
    <form action="/order/create" method="post">
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
                    <th>Permintaan</th>
                    <th>Jumlah</th>
                </tr>
            @endslot

            @slot('body')

            @php
                if(!Auth::user()->admin){
                    $user_id = Auth::user()->id;
                }
            @endphp

            @foreach($obats as $obat)
                @php
                    if(!Auth::user()->admin){
                        $isiKotak = $obat->isiKotaks()->where('obat_id', $obat->id)->whereHas('kotak', function($query) use($user_id){
                            $query->where('user_id', $user_id);
                        })->first();
                    }
                @endphp
                <tr align="center">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $obat->nama }}</td>
                    <td>
                    @if(!Auth::user()->admin)
                        @if($isiKotak->ada) Ada @else Kosong @endif
                    @else
                        <span data-ketersediaan="{{ $loop->index + 1 }}"></span>
                    @endif
                    </td>
                    <td><input data-checkbox="{{ $loop->index + 1 }}" type="checkbox" name="isi_kotak_id[]" value="
                    @if(!Auth::user()->admin)
                        {{ $isiKotak->id }}
                    @endif
                    "
                    @if(!Auth::user()->admin)
                        @if($isiKotak->ada) disabled @endif
                    @endif
                    ></td>
                    <td><input data-number="{{ $loop->index + 1 }}" type="number" name="number[]" disabled></td>
                </tr>
                @endforeach

            @endslot<!-- End of table's body -->

        @endcomponent <!-- End of table -->

        @if(Auth::user()->admin)
            <input id="hidden-kotak-id" type="hidden" name="hidden_kotak_id" value="">
        @endif
        @csrf
        @component('components.input_submit')
            @slot('value','Kirim Permintaan')
        @endcomponent
    </form>

    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script>
        $(function(){

            if($('#user-dropdown')) get_data_from_admin_order($('#user-dropdown option:selected').val())
            
            $('input[type=checkbox]').change(function(){
                let data_checkbox = $(this).attr('data-checkbox')
                let checked = $(this).prop('checked')
                let number = $('input[data-number='+data_checkbox+']')
                
                number.prop('disabled', !checked)
            })

            $('select#user-dropdown').change(function(){
                let kotak_id = $(this).val()
                
                get_data_from_admin_order(kotak_id)
            })

            function get_data_from_admin_order(kotak_id){
                $.get('/order/json/create/'+kotak_id)
                .done(function(response){
                    let data = JSON.parse(response)
                    
                    $('#d_u_nama').html(data.penanggungjawab)
                    $('#d_k_id').html(data.nomor_kotak)
                    $('#d_k_bagian').html(data.bagian)
                    $('#d_k_lokasi').html(data.lokasi)
                    $('#d_k_department').html(data.department)

                    $('input[type=checkbox]').prop('checked', false)
                    $('input[type=checkbox]').prop('disabled', false)
                    $('input[type=number]').prop('disabled', true)

                    for(let i = 0; i < data.isi_kotaks.length; i++){
                        let ketersediaan = (data.isi_kotaks[i].ada) ? 'Ada' : 'Kosong'
                        $('span[data-ketersediaan='+(i+1)+']').html(ketersediaan)

                        $('input[data-checkbox='+(i+1)+']').val(data.isi_kotaks[i].id)

                        if(data.isi_kotaks[i].ada) $('input[data-checkbox='+(i+1)+']').prop('disabled', true)
                    }
                })

                $('input#hidden-kotak-id').val(kotak_id)
            }

        })
    </script>
@endif
        
@endsection