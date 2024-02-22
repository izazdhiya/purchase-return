@extends('layouts.app')

@section('title', 'Pembelian Barang')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Pembelian Barang') }}</span>
                    <a class="btn btn-primary" href="{{ route('pembelian.create') }}">
                        Tambah Pembelian
                    </a>
                    
                </div>                

                <div class="card-body">
                    
                    @include('message')

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 20%; white-space: nowrap;">Tanggal Transaksi</th>
                                    <th style="width: 20%; white-space: nowrap;">No Faktur</th>
                                    <th style="width: 20%">Supplier</th>
                                    <th style="width: 20%">Total</th>
                                    <th style="width: 15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allPembelian as $index => $pembelian)

                                @php
                                    $number = ($allPembelian->currentPage() - 1) * $allPembelian->perPage() + $index + 1;
                                @endphp

                                <tr style="vertical-align: middle;">
                                    <td>{{ $number }}</td>
                                    <td>{{ $pembelian->tanggal_transaksi }}</td>
                                    <td>{{ $pembelian->no_faktur }}</td>
                                    <td>{{ $pembelian->supplier->nama_supplier }}</td>
                                    <td>Rp {{ number_format($pembelian->total) }}</td>
                                    <td>
                                        <div class="d-flex flex-row-reverse">
                                            <a class="btn btn-warning btn-sm mx-1" title="Edit" href='{{ route('barang.edit', $pembelian->id) }}'><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('barang.destroy', $pembelian->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm mx-1" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($allPembelian->lastPage() > 1)
                            <ul class="pagination">
                                <li class="page-item {{ ($allPembelian->currentPage() == 1) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $allPembelian->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $allPembelian->lastPage(); $i++)
                                    <li class="page-item {{ ($allPembelian->currentPage() == $i) ? 'active' : '' }}">
                                        <a href="{{ $allPembelian->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ ($allPembelian->currentPage() == $allPembelian->lastPage()) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $allPembelian->url($allPembelian->currentPage() + 1) }}">Next</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
