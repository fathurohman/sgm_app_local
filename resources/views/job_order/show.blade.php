@extends('layouts.app', ['activePage' => 'job_orders'])
@push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Job Orders</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('job_order.create') }}" class="btn btn-sm btn-primary">Add Job
                                    Orders</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>
                    <div class="mx-3">
                        <div class="table-responsive">
                            <table id="myTable" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Order_ID</th>
                                        <th scope="col">Tipe Order</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Sales</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Via</th>
                                        <th scope="col">Pol_Pod</th>
                                        <th scope="col">ETD</th>
                                        <th scope="col">ETA</th>
                                        <th scope="col">Action</th>
                                        {{-- <th scope="col">Delete</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="job_order" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Detail job</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="job_data">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    {{-- <script type="text/javascript">
        $(".infoU").click(function(e) {
            $currID = $(this).attr("data-id");
            $.get("job_detail/" + $currID, function(data) {
                $('#job_data').html(data);
                // console.log(data);
                // For debugging purposes you can add : console.log(data); to see the output of your request
            });
        });
        $('#myTable').DataTable();
    </script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                drawCallback: function(settings) {
                    $(".infoU").click(function(e) {
                        $currID = $(this).attr("data-id");
                        $.get("job_detail/" + $currID, function(data) {
                            $('#job_data').html(data);
                            // console.log(data);
                            // For debugging purposes you can add : console.log(data); to see the output of your request
                        });
                    });
                },
                ajax: '{!! route('listordershow') !!}',
                columns: [{
                        data: 'order_id',
                        name: 'order_id',
                    },
                    {
                        data: 'tipe_order',
                        name: 'tipe_order',
                    },
                    {
                        data: 'client_id',
                        name: 'client_id',
                    },
                    {
                        data: 'sales_id',
                        name: 'sales_id',
                    },
                    {
                        data: 'service_id',
                        name: 'service_id',
                    },
                    {
                        data: 'via_id',
                        name: 'via_id',
                    },
                    {
                        data: 'pol_pod',
                        name: 'pol_pod',
                    },
                    {
                        data: 'ETD',
                        name: 'ETD',
                    },
                    {
                        data: 'ETA',
                        name: 'ETA',
                    },
                    {
                        data: 'Action',
                        name: 'Action',
                        searchable: false,
                        orderable: false
                    },
                ]
            });
        });
    </script>
@endpush
