<div class="dropdown">
    <a class="btn btn-sm btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Action
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <form method="post" id="Return-form-{{ $data['id'] }}" action="{{ route('finance.return', $data['id']) }}"
            style="display: none">
            {{ csrf_field() }} {{ method_field('put') }}
        </form>
        <a class="dropdown-item" href=""
            onclick="if(confirm('Are you sure?'))
                    {
                        event.preventDefault();document.getElementById('Return-form-{{ $data['id'] }}').submit();
                    }
                    else{
                        event.preventDefault();
                    }">
            Return to sales
        </a>
        <form method="post" id="buku-form-{{ $data['id'] }}" action="{{ route('finance.pembukuan', $data['id']) }}"
            style="display: none">
            {{ csrf_field() }} {{ method_field('put') }}
        </form>
        <a class="dropdown-item" href=""
            onclick="if(confirm('Are you sure?'))
                    {
                        event.preventDefault();document.getElementById('buku-form-{{ $data['id'] }}').submit();
                    }
                    else{
                        event.preventDefault();
                    }">
            Pembukuan
        </a>
        <a href="#" data-id="{{ $data['id'] }}" data-tipe="{{ $data['tipe'] }}" class="dropdown-item infoct"
            data-toggle="modal" data-target="#cetak">Invoice </a>
    </div>
</div>
