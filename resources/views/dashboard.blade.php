@extends('layouts.app', ['activePage' => 'home'])

@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-6 col-md-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <label for="inputState">Bulan</label>
                        <select id="month_id" name="month" class="form-control" required>
                            <option selected disabled value="">Pilih Bulan...</option>
                            @foreach ($data['month_list'] as $key => $m)
                                <option value="{{ $key }}">{{ $m }}</option>
                            @endforeach
                        </select>
                        <input type="text" value="{{ auth()->user()->id }}" id="sales_id" hidden>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12 col-md-12">
                <div id="table-prof"></div>
            </div>
        </div>
        <div class="row mt-3 this-prof">
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
                                    <p>Total Sellings {{ $x->curr }} =
                                        {{ number_format((float) $x->sub_total, 2, '.', ',') }}</p>
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
                                    <p>Total Buyings {{ $x->curr }} =
                                        {{ number_format((float) $x->sub_total, 2, '.', ',') }}</p>
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
                                    <p>Total Profits {{ $x->curr }} =
                                        {{ number_format((float) $x->sub_total, 2, '.', ',') }}</p>
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
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-black ls-1 mb-1">Total</h6>
                                    <h2 class="text-black mb-0">Profit Sales</h2>
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
    <script type="text/javascript">
        function narik(bulan, sales_id, token) {
            $.ajax({
                url: "{{ route('getprofit') }}",
                method: "GET",
                dataType: "json",
                data: {
                    bulan: bulan,
                    sales_id: sales_id,
                    _token: token
                },
                success: function(data) {
                    $('#table-prof').html(data.html);
                    // console.log(data);
                }
            });
        }
        $("#month_id").change(function() {
            var bulan = $('#month_id option:selected').val();
            var sales_id = $('#sales_id').val();
            var _token = $('input[name="_token"]').val();
            $(".this-prof").remove();
            narik(bulan, sales_id, _token);
        });
    </script>
@endpush
