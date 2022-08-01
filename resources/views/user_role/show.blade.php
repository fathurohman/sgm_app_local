@extends('layouts.app', ['activePage' => 'userrole'])
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
                                <h3 class="mb-0">User Roles</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('roleuser.create') }}" class="btn btn-sm btn-primary">Give Roles</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive">
                        <table id="myTable" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">For</th>
                                    <th scope="col">Action</th>
                                    {{-- <th scope="col">Delete</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ru as $x)
                                    <tr>
                                        <td>
                                            {{ $x->users->name }}
                                        </td>
                                        <td>{{ $x->roles->name }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-primary" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="#">Edit</a>
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
@endsection
