@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Supplier') }}</span>
                    <a class="btn btn-primary" href="{{ route('supplier.create') }}">
                        Tambah Supplier
                    </a>
                    
                </div>                

                <div class="card-body">
                    
                    @include('message')

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 20%; white-space: nowrap;">Nama Supplier</th>
                                    <th style="width: 45%">Alamat</th>
                                    <th style="width: 20%">Email</th>
                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allSupplier as $index => $supplier)

                                @php
                                    $number = ($allSupplier->currentPage() - 1) * $allSupplier->perPage() + $index + 1;
                                @endphp

                                <tr style="vertical-align: middle;">
                                    <td>{{ $number }}</td>
                                    <td>{{ $supplier->nama_supplier }}</td>
                                    <td>{{ $supplier->alamat }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>
                                        <div class="d-flex flex-row-reverse">
                                            <a class="btn btn-warning btn-sm mx-1" title="Edit" href='{{ route('supplier.edit', $supplier->id) }}'><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">
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
                        @if ($allSupplier->lastPage() > 1)
                            <ul class="pagination">
                                <li class="page-item {{ ($allSupplier->currentPage() == 1) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $allSupplier->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $allSupplier->lastPage(); $i++)
                                    <li class="page-item {{ ($allSupplier->currentPage() == $i) ? 'active' : '' }}">
                                        <a href="{{ $allSupplier->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ ($allSupplier->currentPage() == $allSupplier->lastPage()) ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $allSupplier->url($allSupplier->currentPage() + 1) }}">Next</a>
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
