@extends('layouts.app', ['activePage' => 'tarik_prof']) @push('css')
    {{-- <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet"> --}}
@endpush
@section('content')
    @include('users.partials.header', ['class' => 'col-lg-7'])
    <div class="container-fluid mt--7">
        <form method="post" action="{{ route('export_jurnal') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5">
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control datepicker" name="start" placeholder="Start From"
                                        type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control datepicker" name="end" placeholder="Until date"
                                        type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ml-3 mt-2 col-lg-6 col-md-6 col-sm-6">
                    <button type="submit" class="btn btn-primary">{{ __('Export Jurnal') }}</button>
                </div>
            </div>
        </form>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">

            </nav>
        </div>
    </div>
@endsection
@push('js')
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            // startView: "months",
            // minViewMode: "months"
        });
    </script>
@endpush
