@extends('layouts.app')

@section('title', 'Pembelian Barang')

@section('content')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    @if (!empty($barang))
                        <span>{{ __('Edit Pembelian Barang') }}</span>
                    @else
                        <span>{{ __('Pembelian Barang Baru') }}</span>
                    @endif
                </div>                

                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="barangId" name="barangId" value="{{ !empty($barang) ? $barang->id : ""}}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                    <input class="form-control @error('tanggal_transaksi') is-invalid @enderror" id="tanggal_transaksi" name="tanggal_transaksi" type="text" placeholder="dd-mm-yyyy" value="{{ old('tanggal_transaksi', !empty($supplier) ? $supplier->tanggal_transaksi : "") }}">
                                    @error('tanggal_transaksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-6 mb-3">
                                    <label for="supplier_id">Supplier</label>
                                    <select class="form-control select @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id">
                                        <option value="">Pilih Supplier...</option>
                                        @foreach ($allSupplier as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->nama_supplier }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>  
                            </div>
                            <row>
                                <div class="col-md-12 mb-3">
                                    <label>Rincian Barang</label>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30%; white-space: nowrap;">Nama Barang</th>
                                                    <th style="width: 10%;">Qty</th>
                                                    <th style="width: 20%">Harga</th>
                                                    <th style="width: 20%; white-space: nowrap;">Sub Total</th>
                                                    <th style="width: 5%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" type="text" placeholder="Nama Barang" value="">
                                                    </td>
                                                    <td>
                                                        <input class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" type="number" placeholder="0" value="">
                                                    </td>
                                                    <td>
                                                        <input class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan" name="harga_satuan" placeholder="Rp" type="text" value="" oninput="formatCurrency(this)">
                                                    </td>
                                                    <td>
                                                        <input class="form-control @error('sub_total') is-invalid @enderror" id="sub_total" name="sub_total" type="text" placeholder="Rp" value="" disabled>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <button type="button" class="btn btn-outline-primary" id="btnTambahItem">Tambah Barang</button>
                                                            <div>
                                                                TOTAL
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <input class="form-control @error('total') is-invalid @enderror" id="total" name="total" type="text" placeholder="Rp" value="" disabled>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </row>                
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function(){
        $('#tanggal_transaksi').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        var tanggalInput = document.getElementById('tanggal_transaksi');

        if (tanggalInput.value === '') {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            today = dd + '-' + mm + '-' + yyyy;

            tanggalInput.value = today;
        }
    });
</script>

<script>
    $(document).ready(function() {
        let counter = 1;

        $('#btnTambahItem').on('click', function() {
            const newRow = `
                <tr>
                    <td>
                        <input class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang_${counter}" name="nama_barang[]" type="text" placeholder="Nama Barang">
                    </td>
                    <td>
                        <input class="form-control @error('quantity') is-invalid @enderror" id="quantity_${counter}" name="quantity[]" type="number" placeholder="0" oninput="updateSubTotal(${counter})">
                    </td>
                    <td>
                        <input class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan_${counter}" name="harga_satuan[]" placeholder="Rp" type="text" oninput="formatAndCalculate(this, ${counter})">
                    </td>
                    <td>
                        <input class="form-control @error('sub_total') is-invalid @enderror" id="sub_total_${counter}" name="sub_total[]" type="text" placeholder="Rp" disabled>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusBaris(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

            $('tbody').append(newRow);
        });

        window.hapusBaris = function(button) {
            $(button).closest('tr').remove();
        };
    });
</script>

<script>
    function formatCurrency(input) {
        var value = input.value.replace(/[^\d]/g, '');
        var numberValue = parseInt(value);
        if (!isNaN(numberValue)) {
            input.value = 'Rp ' + numberValue.toLocaleString('id-ID');
        } else {
            input.value = '';
        }
    }
</script>

<script>
    function formatAndCalculate(input, rowId) {
        formatCurrency(input);
        updateSubTotal(rowId);
    }
</script>

<script>
    function updateSubTotal(rowId) {
        var quantity = document.getElementById('quantity_' + rowId).value;
        var hargaSatuanInput = document.getElementById('harga_satuan_' + rowId);

        var hargaSatuan = parseInt(hargaSatuanInput.value.replace(/[^\d.]/g, ''));
        var subTotalInput = document.getElementById('sub_total_' + rowId);

        var subTotal = parseInt(quantity) * hargaSatuan;

        if (!isNaN(subTotal)) {
            subTotalInput.value = 'Rp ' + subTotal.toLocaleString('id-ID');
        } else {
            subTotalInput.value = '';
        }
    }
</script>



@endsection