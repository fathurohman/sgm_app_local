<div class="modal fade" id="CustomerList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="customer" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <th>Clients Name</th>
                            <th>NPWP</th>
                            <th>Address</th>
                            <th>Action</th>
                        </thead>
                        {{-- <tbody>
                            @foreach ($data['clients'] as $x)
                                <tr>
                                    <td>{{ $x->COMPANY_NAME }}</td>
                                    <td>{{ $x->NPWP }}</td>
                                    <td>{{ substr($x->ADDRESS, 0, 20) }} ...</td>
                                    <td><button type="button" data-id="{{ $x->id }}"
                                            data-dept="{{ $x->dept_id }}"
                                            class="btn btn-primary btn-round infoU btn-sm">
                                            Pilih Client
                                        </button></td>
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
