<div class="modal fade" id="history_sales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">History Sales Order List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="history_sales_tb" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No Invoice</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Tipe Order</th>
                                <th scope="col">Pol_Pod</th>
                                <th scope="col">Volume</th>
                                <th scope="col">Pickup</th>
                                {{-- <th scope="col">Delete</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
