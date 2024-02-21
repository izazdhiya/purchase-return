@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @if (!empty($supplier))
                        <span>{{ __('Edit Supplier') }}</span>
                    @else
                        <span>{{ __('Supplier Baru') }}</span>
                    @endif
                </div>                

                <div class="card-body">
                    <form action="{{ route('supplier.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="supplierId" name="supplierId" value="{{ !empty($supplier) ? $supplier->id : ""}}">
                        <div class="modal-body">
                            <div class="col-md-12 mb-3">
                                <label for="nama_supplier">Nama Supplier</label>
                                <input class="form-control @error('nama_supplier') is-invalid @enderror" id="nama_supplier" name="nama_supplier" type="text" placeholder="Masukkan nama supplier" value="{{ old('nama_supplier', !empty($supplier) ? $supplier->nama_supplier : "") }}">
                                @error('nama_supplier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" type="text" placeholder="Masukkan alamat supplier" rows="3">{{ old('alamat', !empty($supplier) ? $supplier->alamat : "") }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                            
                            <div class="col-md-12 mb-3">
                                <label for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="supplier@example.com" value="{{ old('email', !empty($supplier) ? $supplier->email : "") }}">
                                @error('email')
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