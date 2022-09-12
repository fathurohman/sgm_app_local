<div class="dropdown">
    <a class="btn btn-primary btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Action
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoU" data-toggle="modal"
            data-target="#job_order">
            Detail </a>
        <a class="dropdown-item" href="{{ route('job_pickup', $data['id']) }}">Pilih Job</a>
    </div>
</div>
