@extends('layouts.app')

@section('title', 'Barang')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Barang') }}</span>
                    <a class="btn btn-primary" href="{{ route('barang.create') }}">
                        Tambah
                    </a>
                    
                </div>                

                <div class="card-body">
                    
                    @include('message')

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 30%">Kode</th>
                                    <th style="width: 30%; white-space: nowrap;">Nama Barang</th>
                                    <th style="width: 20%">Stok</th>
                                    <th style="width: 15%"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
