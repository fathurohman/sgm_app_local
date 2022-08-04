<div class="dropdown">
    <a class="btn btn-sm btn-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Details
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoS" data-toggle="modal"
            data-target="#sales_selling">Selling </a>
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoB" data-toggle="modal"
            data-target="#sales_buying">Buying </a>
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoDP" data-toggle="modal"
            data-target="#sales_dp">Down Payment </a>
    </div>
</div>
