@extends('layouts.app')

@section('title', 'Detail Pembelian Barang')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>NO FAKTUR: {{ $pembelian->no_faktur }}</span>

                    @if (Auth::user()->role == "pergudangan")
                        <a class="btn btn-primary" href="">
                            Buat Laporan Kerusakan
                        </a>
                    @endif
                    
                </div>                

                <div class="card-body">
                    
                    @include('message')

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 20%; white-space: nowrap;">Nama Barang</th>
                                    <th style="width: 20%">Quantity</th>
                                    @if (Auth::user()->role == "admin")
                                        <th style="width: 20%">Harga Satuan</th>
                                        <th style="width: 20%">Sub Total</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allItemPembelian as $index => $itemPembelian)

                                @php
                                    $number = ($allItemPembelian->currentPage() - 1) * $allItemPembelian->perPage() + $index + 1;
                                @endphp

                                <tr style="vertical-align: middle;">
                                    <td>{{ $number }}</td>
                                    <td>{{ $itemPembelian->barang->nama_barang }}</td>
                                    <td>{{ $itemPembelian->quantity }}</td>
                                    @if (Auth::user()->role == "admin")
                                        <td>Rp {{ number_format($itemPembelian->harga_satuan) }}</td>
                                        <td>Rp {{ number_format($itemPembelian->sub_total) }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($allItemPembelian->lastPage() > 1)
                            <ul class="pagination">
                                <li class="page-item {{ ($allItemPembelian->currentPage() == 1) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $allItemPembelian->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $allItemPembelian->lastPage(); $i++)
                                    <li class="page-item {{ ($allItemPembelian->currentPage() == $i) ? 'active' : '' }}">
                                        <a href="{{ $allItemPembelian->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ ($allItemPembelian->currentPage() == $allItemPembelian->lastPage()) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $allItemPembelian->url($allItemPembelian->currentPage() + 1) }}">Next</a>
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
