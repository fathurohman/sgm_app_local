@extends('layouts.app', ['activePage' => 'sales_orders']) @push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/css/dt.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', ['class' => 'col-lg-7'])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Add Sales Orders') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sales_order.store') }}" autocomplete="off" id="form-order">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Fill this form') }}</h6>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-order_id">{{ __('order_id') }}</label>
                                    <div class="input-group">
                                        <input id="order_id-field" type="text" class="form-control"
                                            placeholder="order_id" name="order_id" aria-label="order_id"
                                            value="{{ $job_data->order_id }}" required readonly> {{-- <div class="input-group-append">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#orderList">
                                                Find
                                            </button>
                                    </div> --}}
                                    </div>
                                    <input id="order-id-hide" value="{{ $job_data->id }}" name="job_order_id" type="text"
                                        class="form-control" hidden>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <label class="form-control-label" for="input-tipe_order">{{ __('IDN/INV') }}</label>
                                    <input type="text" id="tipe_order" class="form-control form-control-alternative"
                                        required name="tipe_order_text" value="{{ $job_data->tipe_order }}" required
                                        readonly>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <label class="form-control-label" for="input-no_inv">{{ __('No. INV') }}</label>
                                    <input name="no_inv" type="text" id="no_inv" value="-"
                                        class="form-control form-control-alternative" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-Tanggal">{{ __('Tanggal') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input id="Tanggal" name="Tanggal" value="{{ $tanggal }}"
                                                class="form-control" placeholder="Select date" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-ETD">{{ __('ETD') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input id="ETD" name="ETD" class="form-control"
                                                placeholder="Select date" type="text" value="{{ $job_data->ETD }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-ETA">{{ __('ETA') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input id="ETA" name="ETA" value="{{ $job_data->ETA }}"
                                                class="form-control" placeholder="Select date" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('sales') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-sales">{{ __('sales') }}</label>
                                        <input name="sales_id" type="text" id="sales_id" value="{{ $sales }}"
                                            class="form-control form-control-alternative" required name="tipe_order_text"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('vessel1') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-vessel1">{{ __('vessel1') }}</label>
                                        <input type="text" name="vessel1" id="input-vessel1"
                                            class="form-control form-control-alternative{{ $errors->has('vessel1') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('vessel1') }}" value="{{ $job_data->vessel1 }}" required
                                            readonly>
                                        @if ($errors->has('vessel1'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('vessel1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('gwt_meas') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-gwt_meas">{{ __('gwt_meas') }}</label>
                                        <input type="text" name="gwt_meas" id="input-gwt_meas"
                                            class="form-control form-control-alternative{{ $errors->has('gwt_meas') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('gwt_meas') }}" value="{{ $job_data->GWT_MEAS }}"
                                            required readonly>
                                        @if ($errors->has('gwt_meas'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gwt_meas') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('customer') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-customer">{{ __('shipper') }}</label>
                                        <input type="text" name="customer" id="input-customer"
                                            class="form-control form-control-alternative{{ $errors->has('customer') ? ' is-invalid' : '' }}"
                                            value="{{ $shipper }}" required readonly>
                                        @if ($errors->has('customer'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('customer') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('vessel2') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-vessel2">{{ __('vessel2') }}</label>
                                        <input type="text" name="vessel2" id="input-vessel2"
                                            class="form-control form-control-alternative{{ $errors->has('vessel2') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('vessel2') }}" value="{{ $job_data->vessel2 }}" required
                                            readonly>
                                        @if ($errors->has('vessel2'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('vessel2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('hbl') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-hbl">{{ __('hbl') }}</label>
                                        <input type="text" name="hbl" id="input-hbl"
                                            class="form-control form-control-alternative{{ $errors->has('hbl') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('hbl') }}" value="{{ $job_data->HBL }}" required
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('pol_pod') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-pol_pod">{{ __('pol_pod') }}</label>
                                        <input type="text" name="pol_pod" id="input-pol_pod"
                                            class="form-control form-control-alternative{{ $errors->has('pol_pod') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('pol_pod') }}" value="{{ $job_data->pol_pod }}" required
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('party') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-party">{{ __('party') }}</label>
                                        <input type="text" name="party" id="input-party"
                                            class="form-control form-control-alternative{{ $errors->has('party') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('party') }}" value="{{ $job_data->party }}" required
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('mbl') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-mbl">{{ __('mbl') }}</label>
                                        <input type="text" name="mbl" id="input-mbl"
                                            class="form-control form-control-alternative{{ $errors->has('mbl') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('mbl') }}" value="{{ $job_data->MBL }}" required
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#history_sales">
                                        Pilih History
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-control-label" for="input-Selling">{{ __('Selling') }}</label>
                                    <div>
                                        <table id="selling" class="table-selling align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Curr</th>
                                                <th>Price</th>
                                                <th>Sub Total</th>
                                                <th>Name</th>
                                                <th>Remark</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody class="selling">
                                                <tr class="row-selling">
                                                    <td><input class="form-control autosuggest ui-widget" type="text"
                                                            id="description_s" name="description_s[]">
                                                    </td>
                                                    <td><input class="form-control qty" step="any" type="number"
                                                            id="qty_s" name="qty_s[]"></td>
                                                    <td><select id="curr_s" name="curr_s[]"
                                                            class="form-control form-select curr_s"
                                                            aria-label="Default select example">
                                                            <option selected>Open</option>
                                                            <option>IDR</option>
                                                            <option>SGD</option>
                                                            <option>USD</option>
                                                            <option>EUR</option>
                                                        </select></td>
                                                    <td><input class="form-control price" type="text" id="price_s">
                                                        <input class="form-control price_real" type="text"
                                                            id="price_s_r" name="price_s[]" hidden>
                                                    </td>
                                                    <td><input class="form-control sub_total_s" id="sub_total_s" readonly>
                                                        <input class="form-control sub_total_s_real" type="text"
                                                            id="sub_total_s_r" name="sub_total_s[]" hidden>
                                                    </td>
                                                    <td><input type="text" id="name_s"
                                                            class="form-control name_s ui-widget" name="name_s[]"></td>
                                                    <td><input type="text" id="remark_s"
                                                            class="form-control remark_s" name="remark_s[]"></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm"
                                                            id="addkolom_s"><i class="fa fa-plus"></i></a>
                                                        <a href="#" id="refreshkolom"
                                                            class="btn btn-warning btn-sm refresh"><i
                                                                class="fa fa-spinner"></i></a>
                                                        <a href="#" id="removekolom_s"
                                                            class="btn btn-danger btn-sm remove_s"><i
                                                                class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-control-label" for="input-Buying">{{ __('Buying') }}</label>
                                    <div class="table-responsive">
                                        <table id="buying" class="table-buying align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Curr</th>
                                                <th>Price</th>
                                                <th>Sub Total</th>
                                                <th>Name</th>
                                                <th>Remark</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody class="buying">
                                                <tr class="row-buying">
                                                    <td><input type="text" class="form-control autosuggest ui-widget"
                                                            id="description_b" name="description_b[]">
                                                    </td>
                                                    <td><input step="any" class="form-control qty" type="text"
                                                            id="qty_b" name="qty_b[]"></td>
                                                    {{-- <td><input type="text" id="curr_b" name="curr_b[]"></td> --}}
                                                    <td><select id="curr_b" name="curr_b[]"
                                                            class="form-control form-select curr_b"
                                                            aria-label="Default select example">
                                                            <option selected>Open</option>
                                                            <option>IDR</option>
                                                            <option>SGD</option>
                                                            <option>USD</option>
                                                            <option>EUR</option>
                                                        </select></td>
                                                    <td><input type="text" class="form-control price" id="price_b">
                                                        <input type="text" class="form-control price_real"
                                                            id="price_b_r" name="price_b[]" hidden>
                                                    </td>
                                                    <td><input type="text" class="form-control sub_total_b"
                                                            id="sub_total_b" readonly>
                                                        <input type="text" class="form-control sub_total_b_real"
                                                            id="sub_total_b_real" name="sub_total_b[]" hidden>
                                                    </td>
                                                    <td><input type="text" class="form-control name_b ui-widget"
                                                            id="name_b" name="name_b[]"></td>
                                                    <td><input type="text" class="form-control remark_b"
                                                            id="remark_b" name="remark_b[]"></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm"
                                                            id="addkolom_b"><i class="fa fa-plus"></i></a>
                                                        <a href="#" id="refreshkolom"
                                                            class="btn btn-warning btn-sm refresh"><i
                                                                class="fa fa-spinner"></i></a>
                                                        <a href="#" id="removekolom_b"
                                                            class="btn btn-danger btn-sm remove_b"><i
                                                                class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-Profit">{{ __('Down Payment') }}</label>
                                    <div>
                                        <table id="dp" class="table-dp align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Customer</th>
                                                <th>Curr</th>
                                                <th>Total</th>
                                                <th>DP</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input class="form-control" type="text" id="customer_dp"
                                                            name="customer_dp" readonly required></td>
                                                    <td><input class="form-control" type="text" id="currency_dp"
                                                            name="currency_dp" readonly required></td>
                                                    <td><input class="form-control" id="total_dp" name="total_dp"
                                                            readonly required></td>
                                                    <td><input class="form-control" id="d_payment" name="dp"
                                                            required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-Profit">{{ __('Profit') }}</label>
                                    <div class="table-responsive">
                                        <table id="profit" class="table-profit align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Curr</th>
                                                <th>Total Selling</th>
                                                <th>Total Buying</th>
                                                <th>Profit</th>
                                            </thead>
                                            <tbody class="profit_tb">
                                                {{-- <tr>
                                                <td><input type="text" class="curr_prof" id="currency_prof" name="currency[]"
                                                        readonly></td>
                                                <td><input type="text" id="total_selling" name="total_selling[]" readonly>
                                                </td>
                                                <td><input type="text" id="total_buying" name="total_buying[]" readonly>
                                                </td>
                                                <td><input type="text" id="profit_buy" name="profit[]" readonly>
                                                </td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <label class="form-control-label" for="input-Notes">{{ __('Notes') }}</label>
                                    <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="Catatan tambahan..."></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label class="form-control-label" for="input-Hitung">{{ __('Hitung') }}</label>
                                    <br>
                                    <a href="#" id="calculate" class="btn btn-sm btn-primary">Hitung</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="{{ route('sales_order.index') }}" type="button"
                                    class="btn btn-info mt-4">{{ __('Back') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sales_order.history.history_modal') {{-- @include('job_order.customerlist') --}}
    @include('layouts.footers.auth')
@endsection

@push('js')
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('argon/js/sales_order.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var appendidr = true;
            var appendusd = true;
            var appendsgd = true;
            var appendeur = true;

            function append_tb_prof(curr_beli) {
                var tb = '<tr>' +
                    '<td><input class="form-control" type="text" id="currency_prof' +
                    curr_beli +
                    '" name="currency_prof[]" readonly></td>' +
                    '<td><input class="form-control" type="text" id="total_selling' +
                    curr_beli + '" readonly>' +
                    '<input class="form-control" type="text" id="total_selling_real' +
                    curr_beli +
                    '" name="total_selling_prof[]" hidden>' +
                    '</td>' +
                    '<td><input class="form-control" type="text" id="total_buying' +
                    curr_beli + '" readonly>' +
                    '<input class="form-control" type="text" id="total_buying_real' +
                    curr_beli +
                    '" name="total_buying_prof[]" hidden>' +
                    '</td>' +
                    '<td><input class="form-control" type="text" id="profit_buy' +
                    curr_beli + '" readonly>' +
                    '<input class="form-control" type="text" id="profit_buy_real' +
                    curr_beli + '" name="profit[]" hidden>' +
                    '</td>' +
                    '</tr>';
                $('.profit_tb').append(tb);
            }

            function calculate() {
                var rowCount = $('tbody.buying tr').length;
                // console.log(rowCount);
                var sum_idr = 0;
                var sum_usd = 0;
                var sum_sgd = 0;
                var sum_eur = 0;
                var sum_idr_s = 0;
                var sum_usd_s = 0;
                var sum_sgd_s = 0;
                var sum_eur_s = 0;
                var curr_id_prof = '';
                $('.row-buying').each(function() {
                    var item = $(this);
                    var curr_beli = item.find('.curr_b').val();
                    var jumlah = item.find('.sub_total_b_real')
                        .val();
                    // console.log(jumlah);
                    if (curr_beli == 'IDR') {
                        sum_idr += +jumlah;
                    } else if (curr_beli == 'USD') {
                        sum_usd += +jumlah;
                    } else if (curr_beli == 'SGD') {
                        sum_sgd += +jumlah;
                    } else if (curr_beli == 'EUR') {
                        sum_eur += +jumlah;
                    }
                });
                $('.row-selling').each(function() {
                    var item = $(this);
                    var curr_beli = item.find('.curr_s').val();
                    var jumlah = item.find('.sub_total_s_real')
                        .val();
                    // console.log(jumlah);
                    if (curr_beli == 'IDR') {
                        sum_idr_s += +jumlah;
                    } else if (curr_beli == 'USD') {
                        sum_usd_s += +jumlah;
                    } else if (curr_beli == 'SGD') {
                        sum_sgd_s += +jumlah;
                    } else if (curr_beli == 'EUR') {
                        sum_eur_s += +jumlah;
                    }
                });
                // console.log(sum_idr);
                // console.log(sum_usd);
                // console.log(sum_sgd);
                // console.log(sum_eur);
                if (sum_idr > 0 || sum_idr_s > 0) {
                    var curr_beli = 'IDR';
                    var profit = sum_idr_s - sum_idr;
                    // console.log(profit);
                    //append function
                    if (appendidr) {
                        append_tb_prof(curr_beli);
                        appendidr = false;
                    }
                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                    $('#total_selling_real' + curr_beli + '').val(sum_idr_s);
                    $('#total_selling' + curr_beli + '').val(sum_idr_s.toLocaleString('id-ID'));
                    $('#total_buying' + curr_beli + '').val(sum_idr.toLocaleString('id-ID'));
                    $('#total_buying_real' + curr_beli + '').val(sum_idr);
                    $('#profit_buy' + curr_beli + '').val(profit.toLocaleString('id-ID'));
                    $('#profit_buy_real' + curr_beli + '').val(profit);
                }
                if (sum_usd > 0 || sum_usd_s > 0) {
                    var curr_beli = 'USD';
                    var profit = sum_usd_s - sum_usd;
                    if (appendusd) {
                        append_tb_prof(curr_beli);
                        appendusd = false;
                    }
                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                    $('#total_selling' + curr_beli + '').val(sum_usd_s.toLocaleString('id-ID'));
                    $('#total_buying' + curr_beli + '').val(sum_usd.toLocaleString('id-ID'));
                    $('#profit_buy' + curr_beli + '').val(profit.toLocaleString('id-ID'));
                    $('#total_selling_real' + curr_beli + '').val(sum_usd_s);
                    $('#total_buying_real' + curr_beli + '').val(sum_usd);
                    $('#profit_buy_real' + curr_beli + '').val(profit);
                }
                if (sum_sgd > 0 || sum_sgd_s > 0) {
                    var curr_beli = 'SGD';
                    var profit = sum_sgd_s - sum_sgd;
                    if (appendsgd) {
                        append_tb_prof(curr_beli);
                        appendsgd = false;
                    }
                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                    $('#total_selling' + curr_beli + '').val(sum_sgd_s.toLocaleString('id-ID'));
                    $('#total_buying' + curr_beli + '').val(sum_sgd.toLocaleString('id-ID'));
                    $('#profit_buy' + curr_beli + '').val(profit.toLocaleString('id-ID'));
                    $('#total_selling_real' + curr_beli + '').val(sum_sgd_s);
                    $('#total_buying_real' + curr_beli + '').val(sum_sgd);
                    $('#profit_buy_real' + curr_beli + '').val(profit);
                }
                if (sum_eur > 0 || sum_eur_s > 0) {
                    var curr_beli = 'EUR';
                    var profit = sum_eur_s - sum_eur;
                    if (appendeur) {
                        append_tb_prof(curr_beli);
                        appendeur = false;
                    }
                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                    $('#total_selling' + curr_beli + '').val(sum_eur_s.toLocaleString('id-ID'));
                    $('#total_buying' + curr_beli + '').val(sum_eur.toLocaleString('id-ID'));
                    $('#profit_buy' + curr_beli + '').val(profit.toLocaleString('id-ID'));
                    $('#total_selling_real' + curr_beli + '').val(sum_eur_s);
                    $('#total_buying_real' + curr_beli + '').val(sum_eur);
                    $('#profit_buy_real' + curr_beli + '').val(profit);
                }
            }
            $(function() {
                $('tbody').on('focus', ".autosuggest", function() {
                    var tr = $(this).parent().parent();
                    // console.log(tipeatk);
                    $(this).autocomplete({
                        source: "{{ URL('search/autocomplete') }}",
                        // source: "{{ URL('search/autocompletenama') }}",
                        minLength: 1,
                        select: function(event, ui) {
                            // tr.find('.qty').val("");
                            // $('#selectnip').val(ui.item.value);
                            tr.find('.autosuggest').val(ui.item.value);
                        }
                    })
                })
                $('tbody.buying').on('focus', ".name_b", function() {
                    var tr = $(this).parent().parent();
                    // console.log(tipeatk);
                    $(this).autocomplete({
                        source: "{{ URL('search/autocomplete_remark') }}",
                        // source: "{{ URL('search/autocompletenama') }}",
                        minLength: 1,
                        select: function(event, ui) {
                            tr.find('.name_b').val(ui.item.value);
                            tr.find('.remark_b').val(ui.item.nick);
                            calculate();
                        }
                    })
                })
                $('tbody.buying').on('blur', ".name_b", function() {
                    calculate();
                });
                $('tbody.selling').on('focus', ".name_s", function() {
                    var tr = $(this).parent().parent();
                    // console.log(tipeatk);
                    $(this).autocomplete({
                        source: "{{ URL('search/autocomplete_client') }}",
                        // source: "{{ URL('search/autocompletenama') }}",
                        minLength: 1,
                        select: function(event, ui) {
                            tr.find('.name_s').val(ui.item.value);
                            tr.find('.remark_s').val(ui.item.nick);
                            $('#total_dp').val('');
                            $('#d_payment').val('');
                            $('#total_selling').val('');
                            $('#total_buying').val('');
                            $('#profit_buy').val('');
                            var remark = tr.find('.remark_s').val();
                            var name = tr.find('.name_s').val();
                            var curr_sell = tr.find('.curr_s').val();
                            // var sub_total = $('.sub_total_s').val();
                            // var curr_buy = $('.curr_b').val();
                            var sub_total_buy = $('.sub_total_b_real').val();
                            var sum_s = 0;
                            $('.sub_total_s_real').each(function() {
                                sum_s += +$(this).val();
                            });

                            //ambil buying per mata uang
                            calculate();
                            //end
                            // var total = parseInt(sum_s, 10);
                            // var description = tr.find('.autosuggest').val();
                            $('#customer_dp').val(name);
                            $('#currency_dp').val(curr_sell);
                            $('#total_dp').val(sum_s);
                            $('#d_payment').val('0');
                        }
                    })
                })
                $('tbody.selling').on('blur', ".name_s", function() {
                    var tr = $(this).parent().parent();
                    $('#total_dp').val('');
                    $('#d_payment').val('');
                    $('#total_selling').val('');
                    $('#total_buying').val('');
                    $('#profit_buy').val('');
                    var remark = tr.find('.remark_s').val();
                    var name = tr.find('.name_s').val();
                    var curr_sell = tr.find('.curr_s').val();
                    // var sub_total = $('.sub_total_s').val();
                    // var curr_buy = $('.curr_b').val();
                    var sub_total_buy = $('.sub_total_b_real').val();
                    var sum_s = 0;
                    $('.sub_total_s_real').each(function() {
                        sum_s += +$(this).val();
                    });

                    //ambil buying per mata uang
                    calculate();
                    //end
                    // var total = parseInt(sum_s, 10);
                    // var description = tr.find('.autosuggest').val();
                    $('#customer_dp').val(name);
                    $('#currency_dp').val(curr_sell);
                    $('#total_dp').val(sum_s);
                    $('#d_payment').val('0');
                })
                $(document).on('click', '#calculate', function(e) {
                    e.preventDefault();
                    calculate();
                    // console.log(curr);
                });
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#history_sales_tb').DataTable({
                processing: true,
                serverSide: true,
                drawCallback: function(settings) {
                    $(".infoHS").click(function(e) {
                        $currID = $(this).attr("data-id");
                        $.get('/history_modal?pid=' + $currID, function(data) {
                            console.log(data);
                            // For debugging purposes you can add : console.log(data); to see the output of your request
                        });
                        $('#history_sales').modal('toggle');
                    });
                },
                ajax: '{!! route('historyinvoicemodal') !!}',
                columns: [{
                        data: 'nomor_invoice',
                        name: 'nomor_invoice',
                    }, {
                        data: 'job_order_id',
                        name: 'job_order_id',
                    },
                    {
                        data: 'tipe',
                        name: 'tipe',
                    },
                    {
                        data: 'pol_pod',
                        name: 'pol_pod',
                    },
                    {
                        data: 'GWT_MEAS',
                        name: 'GWT_MEAS',
                    },
                    {
                        data: 'Pickup',
                        name: 'Pickup',
                        searchable: false,
                        orderable: false
                    },
                ]
            });
        });
    </script>
@endpush
