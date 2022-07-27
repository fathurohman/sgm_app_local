@extends('layouts.app', ['activePage' => 'sales_orders'])
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
                                <h3 class="mb-0">Sales Orders</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sales_order.create') }}" class="btn btn-sm btn-primary">Add Sales
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
                                        <th scope="col">Job Order_ID</th>
                                        <th scope="col">Tipe Order</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">More</th>
                                        <th scope="col">Action</th>
                                        {{-- <th scope="col">Delete</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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
    @include('sales_order.modal_sales')
@endsection
@push('js')
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            drawCallback: function(settings) {
                $(".infoS").click(function(e) {
                    $currID = $(this).attr("data-id");
                    $.get("sales_selling_detail/" + $currID, function(data) {
                        $('#sales_selling_data').html(data);
                    });
                });
                $(".infoB").click(function(e) {
                    $currID = $(this).attr("data-id");
                    $.get("sales_buying_detail/" + $currID, function(data) {
                        $('#sales_buying_data').html(data);
                    });
                });
                $(".infoDP").click(function(e) {
                    $currID = $(this).attr("data-id");
                    $.get("sales_dp_detail/" + $currID, function(data) {
                        $('#sales_dp_data').html(data);
                    });
                });
                $(".infoP").click(function(e) {
                    $currID = $(this).attr("data-id");
                    $.get("sales_profit_detail/" + $currID, function(data) {
                        $('#sales_profit_data').html(data);
                    });
                });
            },
            ajax: '{!! route('listsalesshow') !!}',
            columns: [{
                    data: 'job_order_id',
                    name: 'job_order_id'
                },
                {
                    data: 'tipe',
                    name: 'tipe'
                },
                {
                    data: 'notes',
                    name: 'notes'
                },
                {
                    data: 'published',
                    name: 'published'
                },
                {
                    data: 'More',
                    name: 'More',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'Action',
                    name: 'Action',
                    searchable: false,
                    orderable: false
                },
            ]
        });
    </script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(".infoS").click(function(e) {
                $currID = $(this).attr("data-id");
                $.get("sales_selling_detail/" + $currID, function(data) {
                    $('#sales_selling_data').html(data);
                });
            });
            $(".infoB").click(function(e) {
                $currID = $(this).attr("data-id");
                $.get("sales_buying_detail/" + $currID, function(data) {
                    $('#sales_buying_data').html(data);
                });
            });
            $(".infoDP").click(function(e) {
                $currID = $(this).attr("data-id");
                $.get("sales_dp_detail/" + $currID, function(data) {
                    $('#sales_dp_data').html(data);
                });
            });
            $(".infoP").click(function(e) {
                $currID = $(this).attr("data-id");
                $.get("sales_profit_detail/" + $currID, function(data) {
                    $('#sales_profit_data').html(data);
                });
            });
        });
    </script> --}}
@endpush
