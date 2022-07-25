@extends('layouts.app', ['activePage' => 'sales_orders']) @push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', ['class' => 'col-lg-7'])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit Sales Orders') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sales_order.update', $sales_order->id) }}" autocomplete="off"
                            id="form-order">
                            @csrf @method('PUT')
                            <h6 class="heading-small text-muted mb-4">{{ __('Fill this form') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-order_id">{{ __('Order ID') }}</label>
                                    <input type="text" id="order_id" class="form-control form-control-alternative"
                                        required name="order_id_text" value="{{ $data_job->order_id }}" readonly>
                                    <input id="order-id-hide" name="order_id" type="text" class="form-control"
                                        value="{{ $data_job->id }}" hidden>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <label class="form-control-label" for="input-tipe_order">{{ __('IDN/INV') }}</label>
                                    <input type="text" id="tipe_order" class="form-control form-control-alternative"
                                        required name="tipe_order_text" value="{{ $data_job->tipe_order }}" readonly>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <label class="form-control-label" for="input-no_inv">{{ __('No. INV') }}</label>
                                    <input name="no_inv" type="text" id="no_inv"
                                        value="{{ $sales_order->nomor_invoice }}"
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
                                            <input id="Tanggal" name="Tanggal" value="{{ $data['tanggal'] }}"
                                                class="form-control" type="text" readonly>
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
                                            <input id="ETD" name="ETD" value="{{ $data_job->ETD }}"
                                                class="form-control" type="text" readonly>
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
                                            <input id="ETA" name="ETA" value="{{ $data_job->ETA }}"
                                                class="form-control" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('sales') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-sales">{{ __('sales') }}</label>
                                        <input name="sales_id" type="text" id="sales_id" value="{{ $data['sales'] }}"
                                            class="form-control form-control-alternative" required name="tipe_order_text"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('vessel1') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-vessel1">{{ __('vessel1') }}</label>
                                        <input type="text" name="vessel1" id="input-vessel1"
                                            class="form-control form-control-alternative{{ $errors->has('vessel1') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('vessel1') }}" value="{{ $data_job->vessel1 }}" required
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
                                            value="{{ $data_job->GWT_MEAS }}" required readonly>
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
                                            value="{{ $data['shipper'] }}" required readonly>
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
                                            value="{{ $data_job->vessel2 }}" required readonly>
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
                                            value="{{ $data_job->HBL }}" required readonly>
                                        @if ($errors->has('hbl'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('hbl') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('pol_pod') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-pol_pod">{{ __('pol_pod') }}</label>
                                        <input type="text" name="pol_pod" id="input-pol_pod"
                                            class="form-control form-control-alternative{{ $errors->has('pol_pod') ? ' is-invalid' : '' }}"
                                            value="{{ $data_job->pol_pod }}" required readonly>
                                        @if ($errors->has('pol_pod'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pol_pod') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('party') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-party">{{ __('party') }}</label>
                                        <input type="text" name="party" id="input-party"
                                            class="form-control form-control-alternative{{ $errors->has('party') ? ' is-invalid' : '' }}"
                                            value="{{ $data_job->party }}" required readonly>
                                        @if ($errors->has('party'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('party') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('mbl') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-mbl">{{ __('mbl') }}</label>
                                        <input type="text" name="mbl" id="input-mbl"
                                            class="form-control form-control-alternative{{ $errors->has('mbl') ? ' is-invalid' : '' }}"
                                            value="{{ $data_job->MBL }}" required readonly>
                                        @if ($errors->has('mbl'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mbl') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-control-label" for="input-Selling">{{ __('Selling') }}</label>
                                    <div class="table-responsive">
                                        <table id="selling" class="table-selling align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Curr</th>
                                                <th>Price</th>
                                                <th>Sub Total</th>
                                                <th>Name</th>
                                                <th>Remark</th>
                                                <th><a style="color: white" href="#" id="addkolom_s"><i
                                                            class="fa fa-plus"></i>Add Column</a>
                                                </th>
                                            </thead>
                                            <tbody class="selling">
                                                @foreach ($selling as $x)
                                                    <tr class="row-selling">
                                                        <td><input class="form-control autosuggest ui-widget"
                                                                type="text" id="description_s"
                                                                value="{{ $x->description }}" name="description_s[]">
                                                            <input type="text" name="id_selling[]"
                                                                value="{{ $x->id }}" hidden>
                                                        </td>
                                                        <td><input class="form-control qty" type="number" id="qty_s"
                                                                name="qty_s[]" value="{{ $x->qty }}"></td>
                                                        <td><select id="curr_s" name="curr_s[]"
                                                                class="form-control form-select curr_s"
                                                                aria-label="Default select example">
                                                                <option selected>{{ $x->curr }}</option>
                                                                <option>IDR</option>
                                                                <option>SGD</option>
                                                                <option>USD</option>
                                                                <option>EUR</option>
                                                            </select></td>
                                                        <td><input value="{{ $x->price }}" class="form-control price"
                                                                type="number" id="price_s">
                                                            <input value="{{ $x->price }}"
                                                                class="form-control price_real" type="text"
                                                                id="price_s_r" name="price_s[]" hidden>
                                                        </td>
                                                        <td><input value="{{ $x->sub_total }}"
                                                                class="form-control sub_total_s" id="sub_total_s"
                                                                name="sub_total_s[]" readonly>
                                                        </td>
                                                        <td><input value="{{ $x->name }}" type="text"
                                                                id="name_s" class="form-control name_s ui-widget"
                                                                name="name_s[]">
                                                        </td>
                                                        <td><input value="{{ $x->remark }}" type="text"
                                                                id="remark_s" class="form-control remark_s"
                                                                name="remark_s[]"></td>
                                                        <td></td>
                                                        {{-- <td><a href="#" id="removekolom_s" class="btn btn-danger remove_s"><i
                                                                    class="fa fa-times"></i></a>
                                                </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-control-label" for="input-Buying">{{ __('Buying') }}</label>
                                    <div>
                                        <table id="buying" class="table-buying align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Curr</th>
                                                <th>Price</th>
                                                <th>Sub Total</th>
                                                <th>Name</th>
                                                <th>Remark</th>
                                                <th><a style="color:white" href="#" id="addkolom_b"><i
                                                            class="fa fa-plus"></i>Add Column</a>
                                                </th>
                                            </thead>
                                            <tbody class="buying">
                                                @foreach ($buying as $x)
                                                    <tr class="row-buying">
                                                        <td><input type="text"
                                                                class="form-control autosuggest ui-widget"
                                                                id="description_b" name="description_b[]"
                                                                value="{{ $x->description }}">
                                                            <input type="text" name="id_buying[]"
                                                                value="{{ $x->id }}" hidden>
                                                        </td>
                                                        <td><input class="form-control qty" type="text" id="qty_b"
                                                                name="qty_b[]" value="{{ $x->qty }}"></td>
                                                        {{-- <td><input type="text" id="curr_b" name="curr_b[]"></td> --}}
                                                        <td><select id="curr_b" name="curr_b[]"
                                                                class="form-control form-select curr_b"
                                                                aria-label="Default select example">
                                                                <option selected>{{ $x->curr }}</option>
                                                                <option>IDR</option>
                                                                <option>SGD</option>
                                                                <option>USD</option>
                                                                <option>EUR</option>
                                                            </select></td>
                                                        <td><input type="text" class="form-control price"
                                                                id="price_b" value="{{ $x->price }}">
                                                            <input type="text" class="form-control price_real"
                                                                id="price_b_r" name="price_b[]"
                                                                value="{{ $x->price }}" hidden>
                                                        </td>
                                                        <td><input type="text" class="form-control sub_total_b"
                                                                id="sub_total_b" name="sub_total_b[]"
                                                                value="{{ $x->sub_total }}" readonly></td>
                                                        <td><input type="text" value="{{ $x->name }}"
                                                                class="form-control name_b ui-widget" id="name_b"
                                                                name="name_b[]">
                                                        </td>
                                                        <td><input type="text" class="form-control remark_b"
                                                                value="{{ $x->remark }}" id="remark_b"
                                                                name="remark_b[]"></td>
                                                        <td></td>
                                                        {{-- <td><a href="#" id="removekolom_b" class="btn btn-danger remove_b"><i
                                                                    class="fa fa-times"></i></a>
                                                </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-Profit">{{ __('Down Payment') }}</label>
                                    <div class="table-responsive">
                                        <table id="dp" class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Customer</th>
                                                <th>Currency</th>
                                                <th>Total</th>
                                                <th>DP</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input value="{{ $down_payment->customer }}" type="text"
                                                            id="customer_dp" name="customer_dp" readonly required>
                                                        <input type="text" value="{{ $down_payment->id }}"
                                                            name="dp_id" hidden>
                                                    </td>
                                                    <td><input value="{{ $down_payment->currency }}" type="text"
                                                            id="currency_dp" name="currency_dp" readonly></td>
                                                    <td><input value="{{ $down_payment->total }}" id="total_dp"
                                                            name="total_dp" readonly required></td>
                                                    <td><input value="{{ $down_payment->dp }}" id="d_payment"
                                                            name="dp" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-Profit">{{ __('Profit') }}</label>
                                    <div class="table-responsive">
                                        <table id="profit" class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Currency</th>
                                                <th>Total Selling</th>
                                                <th>Total Buying</th>
                                                <th>Profit</th>
                                            </thead>
                                            <tbody class="profit_tb">
                                                @foreach ($profit as $x)
                                                    <tr class="profit_tr">
                                                        <td><input value="{{ $x->currency }}" type="text"
                                                                class="curr_prof" id="currency_prof"
                                                                name="currency_prof[]" readonly>
                                                            <input value="{{ $x->id }}" type="text"
                                                                class="id_prof" id="id_prof" name="id_prof[]" hidden>
                                                        </td>
                                                        <td><input value="{{ $x->total_selling }}" type="text"
                                                                id="total_selling_prof" name="total_selling_prof[]"
                                                                readonly>
                                                        </td>
                                                        <td><input value="{{ $x->total_buying }}" type="text"
                                                                id="total_buying_prof" name="total_buying_prof[]"
                                                                readonly>
                                                        </td>
                                                        <td><input value="{{ $x->profit }}" type="text"
                                                                id="profit_buy" name="profit[]" readonly>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <label class="form-control-label" for="input-Notes">{{ __('Notes') }}</label>
                                    <textarea name="notes" class="form-control" id="notes" rows="3"
                                        placeholder="Write a large text here ...">{{ $sales_order->notes }}</textarea>
                                </div>
                                {{-- <div class="col-lg-4 col-md-8 col-sm-12">
                                <label class="form-control-label" for="input-send">{{ __('send') }}</label>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input name="published" class="custom-control-input" id="send" type="checkbox" value="1" @if ($sales_order->published == 1) {{ 'checked' }} @endif>
                                    <label class="custom-control-label" for="send">Send</label>
                                </div>
                            </div> --}}
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
    {{-- @include('job_order.customerlist') --}}
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
                    var jumlah = item.find('.sub_total_b')
                        .val();
                    // console.log(jumlah);
                    if (curr_beli == 'IDR') {
                        sum_idr += +jumlah;
                    } else if (curr_beli == 'USD') {
                        sum_usd += +jumlah;
                    } else if (curr_beli == 'SGD') {
                        sum_sgd += +jumlah;
                    } else {
                        sum_eur += +jumlah;
                    }
                });
                $('.row-selling').each(function() {
                    var item = $(this);
                    var curr_beli = item.find('.curr_s').val();
                    var jumlah = item.find('.sub_total_s')
                        .val();
                    // console.log(jumlah);
                    if (curr_beli == 'IDR') {
                        sum_idr_s += +jumlah;
                    } else if (curr_beli == 'USD') {
                        sum_usd_s += +jumlah;
                    } else if (curr_beli == 'SGD') {
                        sum_sgd_s += +jumlah;
                    } else {
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
                    var tb = '<tr>' +
                        '<td><input type="text" id="currency_prof' +
                        curr_beli +
                        '" name="currency_prof[]" readonly>' +
                        '<input type="text"' +
                        'class="id_prof" id="id_prof" name="id_prof[]" hidden>' +
                        '</td>' +
                        '<td><input type="text" id="total_selling' +
                        curr_beli +
                        '" name="total_selling_prof[]" readonly></td>' +
                        '<td><input type="text" id="total_buying' +
                        curr_beli +
                        '" name="total_buying_prof[]" readonly></td>' +
                        '<td><input type="text" id="profit_buy' +
                        curr_beli +
                        '" name="profit[]" readonly></td>' +
                        '</tr>';
                    if (appendidr) {
                        $('.profit_tb').append(tb);
                        appendidr = false;
                    }
                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                    $('#total_selling' + curr_beli + '').val(sum_idr_s);
                    $('#total_buying' + curr_beli + '').val(sum_idr);
                    $('#profit_buy' + curr_beli + '').val(profit);
                }
                if (sum_usd > 0 || sum_usd_s > 0) {
                    var curr_beli = 'USD';
                    var profit = sum_usd_s - sum_usd;
                    var tb = '<tr>' +
                        '<td><input type="text" id="currency_prof' +
                        curr_beli +
                        '" name="currency_prof[]" readonly>' +
                        '<input type="text"' +
                        'class="id_prof" id="id_prof" name="id_prof[]" hidden>' +
                        '</td>' +
                        '<td><input type="text" id="total_selling' +
                        curr_beli +
                        '" name="total_selling_prof[]" readonly></td>' +
                        '<td><input type="text" id="total_buying' +
                        curr_beli +
                        '" name="total_buying_prof[]" readonly></td>' +
                        '<td><input type="text" id="profit_buy' +
                        curr_beli +
                        '" name="profit[]" readonly></td>' +
                        '</tr>';
                    if (appendusd) {
                        $('.profit_tb').append(tb);
                        appendusd = false;
                    }
                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                    $('#total_selling' + curr_beli + '').val(sum_usd_s);
                    $('#total_buying' + curr_beli + '').val(sum_usd);
                    $('#profit_buy' + curr_beli + '').val(profit);
                }
                if (sum_sgd > 0 || sum_sgd_s > 0) {
                    var curr_beli = 'SGD';
                    var profit = sum_sgd_s - sum_sgd;
                    var tb = '<tr>' +
                        '<td><input type="text" id="currency_prof' +
                        curr_beli +
                        '" name="currency_prof[]" readonly>' +
                        '<input type="text"' +
                        'class="id_prof" id="id_prof" name="id_prof[]" hidden>' +
                        '</td>' +
                        '<td><input type="text" id="total_selling' +
                        curr_beli +
                        '" name="total_selling_prof[]" readonly></td>' +
                        '<td><input type="text" id="total_buying' +
                        curr_beli +
                        '" name="total_buying_prof[]" readonly></td>' +
                        '<td><input type="text" id="profit_buy' +
                        curr_beli +
                        '" name="profit[]" readonly></td>' +
                        '</tr>';
                    if (appendsgd) {
                        $('.profit_tb').append(tb);
                        appendsgd = false;
                    }
                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                    $('#total_selling' + curr_beli + '').val(sum_sgd_s);
                    $('#total_buying' + curr_beli + '').val(sum_sgd);
                    $('#profit_buy' + curr_beli + '').val(profit);
                }
                if (sum_eur > 0 || sum_eur_s > 0) {
                    var curr_beli = 'EUR';
                    var profit = sum_eur_s - sum_eur;
                    var tb = '<tr>' +
                        '<td><input type="text" id="currency_prof' +
                        curr_beli +
                        '" name="currency_prof[]" readonly>' +
                        '<input type="text"' +
                        'class="id_prof" id="id_prof" name="id_prof[]" hidden>' +
                        '</td>' +
                        '<td><input type="text" id="total_selling' +
                        curr_beli +
                        '" name="total_selling_prof[]" readonly></td>' +
                        '<td><input type="text" id="total_buying' +
                        curr_beli +
                        '" name="total_buying_prof[]" readonly></td>' +
                        '<td><input type="text" id="profit_buy' +
                        curr_beli +
                        '" name="profit[]" readonly></td>' +
                        '</tr>';
                    if (appendeur) {
                        $('.profit_tb').append(tb);
                        appendeur = false;
                    }
                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                    $('#total_selling' + curr_beli + '').val(sum_eur_s);
                    $('#total_buying' + curr_beli + '').val(sum_eur);
                    $('#profit_buy' + curr_beli + '').val(profit);
                }
            }
            $(function() {
                var removetbprof = true;
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
                    if (removetbprof) {
                        $('.profit_tr').remove();
                        removetbprof = false;
                    }
                    var tr = $(this).parent().parent();
                    // console.log(tipeatk);
                    $(this).autocomplete({
                        source: "{{ URL('search/autocomplete_remark') }}",
                        // source: "{{ URL('search/autocompletenama') }}",
                        minLength: 1,
                        select: function(event, ui) {
                            tr.find('.name_b').val(ui.item.value);
                            tr.find('.remark_b').val(ui.item.nick);
                            var remark = tr.find('.remark_b').val();
                            var name = tr.find('.name_b').val();
                            calculate();
                        }
                    })
                })
                $('tbody.selling').on('focus', ".name_s", function() {
                    if (removetbprof) {
                        $('.profit_tr').remove();
                        removetbprof = false;
                    }
                    var tr = $(this).parent().parent();
                    // console.log(tipeatk);
                    $(this).autocomplete({
                        source: "{{ URL('search/autocomplete_client') }}",
                        // source: "{{ URL('search/autocompletenama') }}",
                        minLength: 1,
                        select: function(event, ui) {
                            $('#total_dp').val('');
                            $('#d_payment').val('');
                            $('#total_selling').val('');
                            $('#total_buying').val('');
                            $('#profit_buy').val('');
                            tr.find('.name_s').val(ui.item.value);
                            tr.find('.remark_s').val(ui.item.nick);
                            var remark = tr.find('.remark_s').val();
                            var name = tr.find('.name_s').val();
                            var curr_sell = tr.find('.curr_s').val();
                            // var sub_total = $('.sub_total_s').val();
                            // var curr_buy = $('.curr_b').val();
                            var sub_total_buy = $('.sub_total_b').val();
                            var sum_s = 0;
                            var sum_b = 0;
                            $('.sub_total_s').each(function() {
                                sum_s += +$(this).val();
                            });

                            // $('.sub_total_b').each(function() {
                            //     sum_b += +$(this).val();
                            // });
                            // var profit = sum_s - sum_b;
                            //dari sini
                            //ambil buying per mata uang
                            calculate();
                            //end
                            $('#customer_dp').val(name);
                            $('#currency_dp').val(curr_sell);
                            $('#total_dp').val(sum_s);
                            $('#d_payment').val('0');
                        }
                    })
                })
            })
        });
    </script>
@endpush
