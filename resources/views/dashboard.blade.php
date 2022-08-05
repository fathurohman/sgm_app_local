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
                            <h6 class="text-uppercase ls-1 mb-1">Total Sellings {{ $data['name'] }}</h6>
                            <h2 class="text-black mb-0">This Month</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col">
                            <div class="card mb-3">
                                @foreach ($data['data_selling'] as $x)
                                    <p>Total Sellings {{ $x->curr }} = {{ number_format($x->sub_total) }}</p>
                                @endforeach
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
                                <h6 class="text-uppercase ls-1 mb-1">Total Buying {{ $data['name'] }}</h6>
                                <h2 class="text-black mb-0">This Month</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col">
                            <div class="card mb-3">
                                @foreach ($data['data_buying'] as $x)
                                    <p>Total Buyings {{ $x->curr }} = {{ number_format($x->sub_total) }}</p>
                                @endforeach
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
                                <h6 class="text-uppercase ls-1 mb-1">Total Profit {{ $data['name'] }}</h6>
                                <h2 class="text-black mb-0">This Month</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col">
                            <div class="card mb-3">
                                @foreach ($data['data_profits'] as $x)
                                    <p>Total Profits {{ $x->curr }} = {{ number_format($x->sub_total) }}</p>
                                @endforeach
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
