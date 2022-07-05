<div class="dropdown">
    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoS" data-toggle="modal"
            data-target="#sales_selling">Selling </a>
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoB" data-toggle="modal"
            data-target="#sales_buying">Buying </a>
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoP" data-toggle="modal"
            data-target="#sales_profit">Profit </a>
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoDP" data-toggle="modal"
            data-target="#sales_dp">Down Payment </a>
    </div>
</div>
