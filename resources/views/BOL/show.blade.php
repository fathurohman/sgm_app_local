@extends('layouts.app', ['activePage' => 'BOL']) @push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', ['class' => 'col-lg-7'])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Bill Of Lading</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('bol.create') }}" class="btn btn-sm btn-primary">Add BOL</a>
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
                                        <th scope="col">BL No</th>
                                        <th scope="col">Place Date Issue</th>
                                        <th scope="col">On Board Date</th>
                                        <th scope="col">Total Charges</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">More</th>
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
@endsection
@push('js')
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('getdatabol') !!}',
            columns: [{
                    data: 'BL_NO',
                    name: 'BL_NO'
                },
                {
                    data: 'Place_Date_Issue',
                    name: 'Place_Date_Issue'
                },
                {
                    data: 'ON_Board_Date',
                    name: 'ON_Board_Date'
                },
                {
                    data: 'Total_Charges',
                    name: 'Total_Charges'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    searchable: false,
                    orderable: false

                },
                {
                    data: 'More',
                    name: 'More',
                    searchable: false,
                    orderable: false
                }
            ]
        });
    </script>
@endpush
