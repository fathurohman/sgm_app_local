@extends('layouts.app', ['activePage' => 'permission'])
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
                                <h3 class="mb-0">Permissions</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('permission.create') }}" class="btn btn-sm btn-primary">Add
                                    Permissions</a>
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
                                @foreach ($permission as $x)
                                    <tr>
                                        <td>
                                            {{ $x->name }}
                                        </td>
                                        <td>{{ $x->for }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"
                                                        href="{{ route('permission.edit', $x->id) }}">Edit</a>
                                                    <form method="post" id="delete-form-{{ $x->id }}"
                                                        action="{{ route('permission.destroy', $x->id) }}"
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
@endsection
