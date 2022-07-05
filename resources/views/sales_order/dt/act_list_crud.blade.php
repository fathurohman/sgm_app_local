<div class="dropdown">
    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a class="dropdown-item" href="{{ route('sales_order.edit', $data['id']) }}">Edit</a>
        <form method="post" id="delete-form-{{ $data['id'] }}"
            action="{{ route('sales_order.destroy', $data['id']) }}" style="display: none">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
        <a class="dropdown-item" href=""
            onclick="if(confirm('Are you sure?'))
             {
                 event.preventDefault();document.getElementById('delete-form-{{ $data['id'] }}').submit();
             }
             else{
                 event.preventDefault();
             }">Hapus
        </a>
    </div>
</div>
