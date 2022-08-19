<div class="row">
    <div class="col-xl-4 col-md-4">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase ls-1 mb-1">Total Selling {{ $data['sales_name'] }}</h6>
                        <h2 class="text-black mb-0">This Month</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="col">
                    <div class="card mb-3 border-0">
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
                        <h6 class="text-uppercase ls-1 mb-1">Total Buying {{ $data['sales_name'] }}</h6>
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
                        <h6 class="text-uppercase ls-1 mb-1">Total Profit {{ $data['sales_name'] }}</h6>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
