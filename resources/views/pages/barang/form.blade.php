@extends('layouts.app')

@section('title', 'Barang')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @if (!empty($barang))
                        <span>{{ __('Edit Barang') }}</span>
                    @else
                        <span>{{ __('Barang Baru') }}</span>
                    @endif
                </div>                

                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="barangId" name="barangId" value="{{ !empty($barang) ? $barang->id : ""}}">
                        <div class="modal-body">
                            <div class="col-md-12 mb-3">
                                <label for="kode">Kode</label>
                                <input class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" type="text" placeholder="Kode" value="{{ old('kode', !empty($barang) ? $barang->kode : "") }}">
                                @error('kode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="nama_barang">Nama Barang</label>
                                <input class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" type="text" placeholder="Masukkan nama barang" value="{{ old('nama_barang', !empty($barang) ? $barang->nama_barang : "") }}">
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>                  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600" onclick="goBack()">Batal</button>
                            <button type="submit" class="btn btn-primary ms-auto" id="btn-submit">Simpan</button>
                        </div>                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>      

@endsection