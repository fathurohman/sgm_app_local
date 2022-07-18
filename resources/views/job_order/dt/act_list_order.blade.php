<div class="dropdown">
    <a class="btn btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Action
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a href="#" data-id="{{ $data['id'] }}" class="dropdown-item infoU" data-toggle="modal"
            data-target="#job_order">
            Detail </a>
        <a class="dropdown-item" href="{{ route('job_order.edit', $data['id']) }}">Edit</a>
        <form method="post" id="delete-form-{{ $data['id'] }}"
            action="{{ route('job_order.destroy', $data['id']) }}" style="display: none">
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
