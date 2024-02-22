@extends('layouts.app')

@section('title', 'Barang')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Barang') }}</span>

                    @if (Auth::user()->role == "admin")
                        <a class="btn btn-primary" href="{{ route('barang.create') }}">
                            Tambah Barang
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
                                    <th style="width: 30%">Kode</th>
                                    <th style="width: 30%; white-space: nowrap;">Nama Barang</th>
                                    <th style="width: 20%">Stok</th>
                                    @if (Auth::user()->role == "admin")
                                        <th style="width: 15%"></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allBarang as $index => $barang)

                                @php
                                    $number = ($allBarang->currentPage() - 1) * $allBarang->perPage() + $index + 1;
                                @endphp

                                <tr style="vertical-align: middle;">
                                    <td>{{ $number }}</td>
                                    <td>{{ $barang->kode }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->stok }}</td>

                                    @if (Auth::user()->role == "admin")
                                        <td>
                                            <div class="d-flex flex-row-reverse">
                                                <a class="btn btn-warning btn-sm mx-1" title="Edit" href='{{ route('barang.edit', $barang->id) }}'><i class="fas fa-pen"></i></a>
                                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm mx-1" title="Delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        @if ($allBarang->lastPage() > 1)
                            <ul class="pagination">
                                <li class="page-item {{ ($allBarang->currentPage() == 1) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $allBarang->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $allBarang->lastPage(); $i++)
                                    <li class="page-item {{ ($allBarang->currentPage() == $i) ? 'active' : '' }}">
                                        <a href="{{ $allBarang->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ ($allBarang->currentPage() == $allBarang->lastPage()) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $allBarang->url($allBarang->currentPage() + 1) }}">Next</a>
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
