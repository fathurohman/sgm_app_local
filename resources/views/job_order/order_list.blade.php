<div class="modal fade" id="orderList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">order List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="order" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <th>Job Order</th>
                            <th>DNI</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Party</th>
                            <th>Pol_Pod</th>
                            <th>Action</th>
                        </thead>
                        {{-- <tbody>
                            @foreach ($data['job_order'] as $x)
                                <tr>
                                    <td>{{ $x->order_id }}</td>
                                    <td>{{ $x->tipe_order }}</td>
                                    <td>{{ $x->created_at }}</td>
                                    <td>{{ $x->client_id }}</td>
                                    <td>{{ $x->party }}</td>
                                    <td>{{ $x->pol_pod }}</td>
                                    <td><button type="button"
                                            data-id="{{ $x->id }}"class="btn btn-primary btn-round infoO btn-sm">Pilih</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
