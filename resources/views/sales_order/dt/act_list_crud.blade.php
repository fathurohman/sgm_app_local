<div class="dropdown">
    <a class="btn btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        @if($data['status'] == '1')
        <a href="#" class="dropdown-item">No options available</a> @else
        <form method="post" id="send-form-{{ $data['id'] }}" action="{{ route('sales_order.send', $data['id']) }}" style="display: none">
            {{ csrf_field() }} {{ method_field('put') }}
        </form>
        <a class="dropdown-item" href="" onclick="if(confirm('Are you sure?'))
                    {
                        event.preventDefault();document.getElementById('send-form-{{ $data['id'] }}').submit();
                    }
                    else{
                        event.preventDefault();
                    }">Send To Finance
                </a>
        <a class="dropdown-item" href="{{ route('sales_order.edit', $data['id']) }}">Edit</a>
        <form method="post" id="delete-form-{{ $data['id'] }}" action="{{ route('sales_order.destroy', $data['id']) }}" style="display: none">
            {{ csrf_field() }} {{ method_field('DELETE') }}
        </form>
        <a class="dropdown-item" href="" onclick="if(confirm('Are you sure?'))
                 {
                     event.preventDefault();document.getElementById('delete-form-{{ $data['id'] }}').submit();
                 }
                 else{
                     event.preventDefault();
                 }">Hapus
            </a> @endif
    </div>
</div>