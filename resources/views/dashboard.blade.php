@extends('layouts.app', ['activePage' => 'home'])

@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-4 col-md-4 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Total Sellings</h6>
                            <h2 class="text-black mb-0">This Month</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col">
                            <div class="card mb-3">
                                <p>Total Sellings IDR = {{ number_format($data['selling_idr']) }}</p>
                                <p>Total Sellings USD = {{ number_format($data['selling_usd']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Total Buying</h6>
                                <h2 class="text-black mb-0">This Month</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col">
                            <div class="card mb-3">
                                <p>Total Buyings IDR = {{ number_format($data['buying_idr']) }}</p>
                                <p>Total Buyings USD = {{ number_format($data['buying_usd']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Total Profit</h6>
                                <h2 class="text-black mb-0">This Month</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col">
                            <div class="card mb-3">
                                <p>Total Profits IDR = {{ number_format($data['profits_idr']) }}</p>
                                <p>Total Profits USD = {{ number_format($data['profits_usd']) }}</p>
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
