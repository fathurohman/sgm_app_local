@extends('layouts.app', ['activePage' => 'home'])

@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                            <h2 class="text-white mb-0">Sales value</h2>
                        </div>
                        <div class="col">
                            <div class="card mb-3">
                                <img src="{{ asset('argon') }}/img/brand/fw-1.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">About</h5>
                                    <p class="card-text">This is a web application for PT Sigma Global Makmur to support
                                        invoicing with sales orders, job orders,
                                        manage data such as customer,vendor and items and monthly report.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="card mb-3">
                                    <img src="{{ asset('argon') }}/img/brand/fw-2.jpg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">More</h5>
                                        <p class="card-text">Hopefully this application will make the business and
                                            transaction easier than before.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
