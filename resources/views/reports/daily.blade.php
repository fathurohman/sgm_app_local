@extends('layouts.app', ['activePage' => 'reports']) @push('css')
    {{-- <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet"> --}}
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
                                <h3 class="mb-0">Reports Invoice</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                    </div>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <form method="post" action="{{ route('export') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="ml-3 col-lg-6 col-md-6 col-sm-6">
                                        <label for="inputState">Bulan</label>
                                        <select id="month_id" name="month" class="form-control" required>
                                            <option selected disabled value="">Pilih Bulan...</option>
                                            @foreach ($month as $key => $m)
                                                <option value="{{ $key }}">{{ $m }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="ml-3 mt-2 col-lg-6 col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-primary">{{ __('Export Excel') }}</button>
                                    </div>
                                </div>
                            </form>
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
