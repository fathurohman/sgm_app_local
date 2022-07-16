<div class="dropdown">
    <a class="btn btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Invoice
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        {{-- <a class="dropdown-item" href="cetak_invoice/{{ $data['id'] }}/{{ $data['tipe'] }}" target="_blank">Cetak
            Invoice</a> --}}
        <a href="#" data-id="{{ $data['id'] }}" data-tipe="{{ $data['tipe'] }}" class="dropdown-item infoct" data-toggle="modal"
            data-target="#cetak">Invoice </a>
    </div>
</div>