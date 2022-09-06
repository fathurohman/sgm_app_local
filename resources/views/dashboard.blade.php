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
                            <div class="card mb-3 border-0">
                                @foreach ($data['data_selling'] as $x)
                                    <p>Total Sellings {{ $x->curr }} = {{ number_format($x->sub_total) }}</p>
                                @endforeach
                                @foreach ($data['curr_s'] as $x)
                                    <p>Total Sellings {{ $x }} = 0</p>
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
                            <div class="card mb-3 border-0">
                                @foreach ($data['data_buying'] as $x)
                                    <p>Total Buyings {{ $x->curr }} = {{ number_format($x->sub_total) }}</p>
                                @endforeach
                                @foreach ($data['curr_b'] as $x)
                                    <p>Total Buyings {{ $x }} = 0</p>
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
                            <div class="card mb-3 border-0">
                                @foreach ($data['data_profits'] as $x)
                                    <p>Total Profits {{ $x->curr }} = {{ number_format($x->sub_total) }}</p>
                                @endforeach
                                @foreach ($data['curr_p'] as $x)
                                    <p>Total Profits {{ $x }} = 0</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->user()->department == 'super-admin')
            <div class="row mt-5">
                <div class="col-xl-4 col-md-4">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase ls-1 mb-1">Rank Of Sales</h6>
                                    <h2 class="text-black mb-0">This Month</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col">
                                <div class="card mb-3 border-0">
                                    @foreach ($data['rankings'] as $x)
                                        <p>
                                            @foreach (\App\User::where('id', $x->user_id)->get() as $users)
                                                @if (empty($users->foto))
                                                    <img style="border-radius: 50%;" height="auto" width="60px"
                                                        alt="Image placeholder"
                                                        src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                                                @else
                                                    <img style="border-radius: 50%;" height="52px" width="60px"
                                                        alt="Image placeholder"
                                                        src="{{ url('storage/foto/' . $users->foto) }}">
                                                @endif
                                                Sales Name = {{ $users->name }}
                                            @endforeach
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-8">
                    <div class="card bg-gradient-default shadow">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-light ls-1 mb-1">Total</h6>
                                    <h2 class="text-white mb-0">Profit Sales</h2>
                                </div>
                                <div class="col">
                                    <ul class="nav nav-pills justify-content-end">
                                        <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales">
                                            <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                                <label for="inputState">Currency</label>
                                                <select id="curr" name="curr" class="form-control" required>
                                                    <option selected value="ALL">Pilih Currency: </option>
                                                    <option value="IDR">IDR</option>
                                                    <option value="USD">USD</option>
                                                </select>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart -->
                            <div class="chart">
                                <!-- Chart wrapper -->
                                <canvas id="chart-sales" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/profitChart.js"></script>
@endpush
