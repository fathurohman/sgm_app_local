@extends('layouts.app')
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
                            <tbody>
                                @foreach ($job_order as $x)
                                    <tr>
                                        <td>{{ $x->order_id }}</td>
                                        <td>{{ $x->tipe_order }}</td>
                                        <td>{{ $x->client_id }}</td>
                                        <td>{{ $x->Sales_id }}</td>
                                        <td>{{ $x->service_id }}</td>
                                        <td>{{ $x->via_id }}</td>
                                        <td>{{ $x->ETD }}</td>
                                        <td>{{ $x->ETA }}</td>
                                        <td>
                                            <button type="button" data-id="{{ $x->id }}"
                                                class="btn btn-round btn-info infoU" data-toggle="modal"
                                                data-target="#alamat">
                                                Detail </button>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"
                                                        href="{{ route('job_order.edit', $x->id) }}">Edit</a>
                                                    <form method="post" id="delete-form-{{ $x->id }}"
                                                        action="{{ route('job_order.destroy', $x->id) }}"
                                                        style="display: none">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                    </form>
                                                    <a class="dropdown-item" href=""
                                                        onclick="if(confirm('Are you sure?'))
                                                        {
                                                            event.preventDefault();document.getElementById('delete-form-{{ $x->id }}').submit();
                                                        }
                                                        else{
                                                            event.preventDefault();
                                                        }">Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="alamat" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Address</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" id="vendor_data">
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
    <script type="text/javascript">
        $(".infoU").click(function(e) {
            $currID = $(this).attr("data-id");
            $.get("vendor_detail/" + $currID, function(data) {
                $('#vendor_data').html(data);
                // console.log(data);
                // For debugging purposes you can add : console.log(data); to see the output of your request
            });
        });
        $('#myTable').DataTable();
    </script>
@endpush
