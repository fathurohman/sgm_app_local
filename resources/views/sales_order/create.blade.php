@extends('layouts.app', ['title' => __('Create Job Order')])
@push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Add Job Orders') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sales_order.store') }}" autocomplete="off" id="form-order">
                            @csrf
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
                                    <label class="form-control-label" for="input-order_id">{{ __('order_id') }}</label>
                                    <div class="input-group">
                                        <input id="order_id-field" type="text" class="form-control"
                                            placeholder="order_id" aria-label="order_id" readonly>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#orderList">
                                                Find
                                            </button>
                                        </div>
                                    </div>
                                    <input id="order-id-hide" name="order_id" type="text" class="form-control" hidden>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <label class="form-control-label" for="input-tipe_order">{{ __('IDN/INV') }}</label>
                                    <input type="text" id="tipe_order" class="form-control form-control-alternative"
                                        required name="tipe_order_text" readonly>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <label class="form-control-label" for="input-no_inv">{{ __('No. INV') }}</label>
                                    <input name="no_inv" type="text" id="no_inv"
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
                                            <input id="Tanggal" name="Tanggal" class="form-control"
                                                placeholder="Select date" type="text" readonly>
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
                                                placeholder="Select date" type="text" readonly>
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
                                            <input id="ETA" name="ETA" class="form-control"
                                                placeholder="Select date" type="text" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('sales') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-sales">{{ __('sales') }}</label>
                                        <input name="sales_id" type="text" id="sales_id"
                                            class="form-control form-control-alternative" required name="tipe_order_text"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('vessel1') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-vessel1">{{ __('vessel1') }}</label>
                                        <input type="text" name="vessel1" id="input-vessel1"
                                            class="form-control form-control-alternative{{ $errors->has('vessel1') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('vessel1') }}" required readonly>
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
                                            placeholder="{{ __('gwt_meas') }}" required readonly>
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
                                            placeholder="{{ __('customer') }}" required readonly>
                                        @if ($errors->has('customer'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('customer') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('vessel2') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-vessel2">{{ __('vessel2') }}</label>
                                        <input type="text" name="vessel2" id="input-vessel2"
                                            class="form-control form-control-alternative{{ $errors->has('vessel2') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('vessel2') }}" required readonly>
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
                                            placeholder="{{ __('hbl') }}" required readonly>
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
                                        <label class="form-control-label"
                                            for="input-pol_pod">{{ __('pol_pod') }}</label>
                                        <input type="text" name="pol_pod" id="input-pol_pod"
                                            class="form-control form-control-alternative{{ $errors->has('pol_pod') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('pol_pod') }}" required readonly>
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
                                            placeholder="{{ __('party') }}" required readonly>
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
                                            placeholder="{{ __('mbl') }}" required readonly>
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
                                    <label class="form-control-label" for="input-Buying">{{ __('Buying') }}</label>
                                    <div class="table-responsive">
                                        <table id="buying" class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Curr</th>
                                                <th>Price</th>
                                                <th>Sub Total</th>
                                                <th>Name</th>
                                                <th>Remark</th>
                                                <th>Add</th>
                                                <th>Remove</th>
                                            </thead>
                                            <tbody class="buying">
                                                <tr class="row-buying">
                                                    <td><input type="text" class="autosuggest ui-widget"
                                                            id="description_b" name="description_b[]">
                                                    </td>
                                                    <td><input class="qty" type="text" id="qty_b"
                                                            name="qty_b[]"></td>
                                                    {{-- <td><input type="text" id="curr_b" name="curr_b[]"></td> --}}
                                                    <td><select id="curr_b" name="curr_b[]" class="form-select curr_b"
                                                            aria-label="Default select example">
                                                            <option selected>Open this select menu</option>
                                                            <option>IDR</option>
                                                            <option>SGD</option>
                                                            <option>USD</option>
                                                            <option>EUR</option>
                                                        </select></td>
                                                    <td><input type="text" class="price" id="price_b"
                                                            name="price_b[]"></td>
                                                    <td><input type="text" class="sub_total_b" id="sub_total_b"
                                                            name="sub_total_b[]"></td>
                                                    <td><input type="text" class="name_b ui-widget" id="name_b"
                                                            name="name_b[]"></td>
                                                    <td><input type="text" class="remark_b" id="remark_b"
                                                            name="remark_b[]"></td>
                                                    <td><a href="#" id="addkolom_b"><i class="fa fa-plus"></i></a>
                                                    </td>
                                                    <td><a href="#" id="removekolom_b"
                                                            class="btn btn-danger remove_b"><i
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
                                    <label class="form-control-label" for="input-Selling">{{ __('Selling') }}</label>
                                    <div class="table-responsive">
                                        <table id="selling" class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                                <th>Description</th>
                                                <th>Qty</th>
                                                <th>Curr</th>
                                                <th>Price</th>
                                                <th>Sub Total</th>
                                                <th>Name</th>
                                                <th>Remark</th>
                                                <th>Add</th>
                                                <th>Remove</th>
                                            </thead>
                                            <tbody class="selling">
                                                <tr>
                                                    <td><input class="autosuggest ui-widget" type="text"
                                                            id="description_s" name="description_s[]">
                                                    </td>
                                                    <td><input class="qty" type="number" id="qty_s"
                                                            name="qty_s[]"></td>
                                                    <td><select id="curr_s" name="curr_s[]" class="form-select curr_s"
                                                            aria-label="Default select example">
                                                            <option selected>Open this select menu</option>
                                                            <option>IDR</option>
                                                            <option>SGD</option>
                                                            <option>USD</option>
                                                            <option>EUR</option>
                                                        </select></td>
                                                    <td><input class="price" type="number" id="price_s"
                                                            name="price_s[]"></td>
                                                    <td><input class="sub_total_s" id="sub_total_s" name="sub_total_s[]">
                                                    </td>
                                                    <td><input type="text" id="name_s" class="name_s ui-widget"
                                                            name="name_s[]"></td>
                                                    <td><input type="text" id="remark_s" class="remark_s"
                                                            name="remark_s[]"></td>
                                                    <td><a href="#" id="addkolom_s"><i class="fa fa-plus"></i></a>
                                                    </td>
                                                    <td><a href="#" id="removekolom_s"
                                                            class="btn btn-danger remove_s"><i
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
                                    <label class="form-control-label"
                                        for="input-Profit">{{ __('Down Payment') }}</label>
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
                                                    <td><input type="text" id="customer_dp" name="customer[]"
                                                            readonly></td>
                                                    <td><input type="text" id="currency_dp" name="currency[]"
                                                            readonly></td>
                                                    <td><input id="total_dp" name="total[]" readonly></td>
                                                    <td><input id="d_payment" name="dp[]"></td>
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
                                                {{-- <tr>
                                                    <td><input type="text" class="curr_prof" id="currency_prof"
                                                            name="currency[]" readonly></td>
                                                    <td><input type="text" id="total_selling" name="total_selling[]"
                                                            readonly>
                                                    </td>
                                                    <td><input type="text" id="total_buying" name="total_buying[]"
                                                            readonly>
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
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-control-label" for="input-Notes">{{ __('Notes') }}</label>
                                    <textarea name="notes" class="form-control" id="notes" rows="3"
                                        placeholder="Write a large text here ..."></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="{{ route('permission.index') }}" type="button"
                                    class="btn btn-info mt-4">{{ __('Back') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('job_order.order_list')
    {{-- @include('job_order.customerlist') --}}
    @include('layouts.footers.auth')
@endsection
@push('js')
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // var data = {
        //     currency: @json($curr)
        // };
        $(document).ready(function() {
            $('#order').DataTable({
                processing: true,
                serverSide: true,
                drawCallback: function(settings) {
                    $('.infoO').click(function() {
                        $currID = $(this).attr("data-id");
                        $('#order_id-field').val('');
                        // alert($currID);
                        $.get('/job_data_sales?pid=' + $currID, function(data) {
                            //    console.log(data['jobs'].order_id);
                            $('#order_id-field').val(data['jobs'].order_id);
                            $('#order-id-hide').val(data['jobs'].id);
                            $('#tipe_order').val(data['jobs'].tipe_order);
                            $('#Tanggal').val(data['tanggal']);
                            $('#no_inv').val(data['inv']);
                            $('#input-customer').val(data['name_client']);
                            // $('#customer-field-id').val(data['jobs'].client_id);
                            $('#sales_id').val(data['sales_name']);
                            // $('#service_id').val(data['jobs'].sales_id);
                            $('#via_id').val(data['jobs'].via_id);
                            $('#ETD').val(data['jobs'].ETD);
                            $('#ETA').val(data['jobs'].ETA);
                            $('#input-pol_pod').val(data['jobs'].pol_pod);
                            $('#input-party').val(data['jobs'].party);
                            $('#input-hbl').val(data['jobs'].HBL);
                            $('#input-gwt_meas').val(data['jobs'].GWT_MEAS);
                            $('#input-mbl').val(data['jobs'].MBL);
                            $('#input-vessel1').val(data['jobs'].vessel1);
                            $('#input-vessel2').val(data['jobs'].vessel2);
                            $('#input-consignee').val(data['jobs'].consignee);
                            $('#input-agent_overseas').val(data['jobs'].agent_overseas);
                            // console.log(data);
                        });
                        $('#orderList').modal('toggle');
                        // $('#customer-field').val($currID);
                    });
                },
                ajax: '{!! route('listordersales') !!}',
                columns: [{
                        data: 'job_order',
                        name: 'job_order'
                    },
                    {
                        data: 'DNI',
                        name: 'DNI'
                    },
                    {
                        data: 'Date',
                        name: 'Date'
                    },
                    {
                        data: 'Client',
                        name: 'Client'
                    },
                    {
                        data: 'Party',
                        name: 'Party'
                    },
                    {
                        data: 'Pol_Pod',
                        name: 'Pol_Pod'
                    },
                    {
                        data: 'Action',
                        name: 'Action'
                    },
                ]
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('argon/js/sales_order.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
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
                $('tbody').on('keyup', ".price", function() {
                    var tr = $(this).parent().parent();
                    var qty = tr.find('.qty').val();
                    var price = tr.find('.price').val();
                    var total = qty * price;
                    // tr.find('.sub_total').val(total.toLocaleString('id-ID'));
                    tr.find('.sub_total_s').val(total);
                    tr.find('.sub_total_b').val(total);
                    // parseInt(tr.find('.sub_total_s').val(total), 10);
                    // parseInt($("#replies").text(),10);
                })
                $('tbody').on('change', ".qty", function() {
                    var $this = $(this);
                    $this.val(parseFloat($this.val()).toFixed(3));
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
                            var remark = tr.find('.remark_b').val();
                            var name = tr.find('.name_b').val();
                            // var curr_beli = tr.find('.curr_b').val();
                            // var tb = '<tr>' +
                            //     '<td><input type="text" id="currency_prof' + curr_beli +
                            //     '" name="currency[]" readonly></td>' +
                            //     '<td><input type="text" id="total_selling' + curr_beli +
                            //     '" name="total_selling[]" readonly></td>' +
                            //     '<td><input type="text" id="total_buying' + curr_beli +
                            //     '" name="total_buying[]" readonly></td>' +
                            //     '<td><input type="text" id="profit_buy' + curr_beli +
                            //     '" name="profit[]" readonly></td>' +
                            //     '</tr>';
                            // $('.profit_tb').append(tb);
                        }
                    })
                })
                $('tbody.selling').on('focus', ".name_s", function() {
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

                            $('.sub_total_b').each(function() {
                                sum_b += +$(this).val();
                            });
                            var profit = sum_s - sum_b;
                            //ambil buying per mata uang
                            var rowCount = $('tbody.buying tr').length;
                            // console.log(rowCount);
                            if (rowCount > 1) {
                                var sum_idr = 0;
                                var sum_usd = 0;
                                var sum_sgd = 0;
                                var sum_eur = 0;
                                var curr_id_prof = '';
                                $('.row-buying').each(function() {
                                    var item = $(this);
                                    var curr_beli = item.find('.curr_b').val();
                                    var jumlah = item.find('.sub_total_b')
                                        .val();
                                    // console.log(jumlah);
                                    if (curr_beli == 'IDR') {
                                        sum_idr += +jumlah;
                                        // profit = sum_s - sum_idr;
                                    } else if (curr_beli == 'USD') {
                                        sum_usd += +jumlah;
                                        // profit = sum_s - sum_usd;
                                    } else if (curr_beli == 'SGD') {
                                        sum_sgd += +jumlah;
                                        // profit = sum_s - sum_sgd;
                                    } else {
                                        sum_eur += +jumlah;
                                        // var profit = sum_s - sum_eur;
                                    }
                                });
                                // console.log(sum_idr);
                                // console.log(sum_usd);
                                // console.log(sum_sgd);
                                // console.log(sum_eur);
                                // console.log(profit);
                                if (sum_idr > 0) {
                                    var curr_beli = 'IDR';
                                    var tb = '<tr>' +
                                        '<td><input type="text" id="currency_prof' +
                                        curr_beli +
                                        '" name="currency[]" readonly></td>' +
                                        '<td><input type="text" id="total_selling' +
                                        curr_beli +
                                        '" name="total_selling[]" readonly></td>' +
                                        '<td><input type="text" id="total_buying' +
                                        curr_beli +
                                        '" name="total_buying[]" readonly></td>' +
                                        '<td><input type="text" id="profit_buy' +
                                        curr_beli +
                                        '" name="profit[]" readonly></td>' +
                                        '</tr>';
                                    $('.profit_tb').append(tb);
                                    $('#currency_prof' + curr_beli + '').val(curr_beli);
                                    $('#total_selling' + curr_beli + '').val(sum_s);
                                    $('#total_buying' + curr_beli + '').val(sum_idr);
                                    // $('#profit_buy').val(profit);
                                }
                                if (sum_usd > 0) {
                                    var curr_beli = 'USD';
                                    var tb = '<tr>' +
                                        '<td><input type="text" id="currency_prof' +
                                        curr_beli +
                                        '" name="currency[]" readonly></td>' +
                                        '<td><input type="text" id="total_selling' +
                                        curr_beli +
                                        '" name="total_selling[]" readonly></td>' +
                                        '<td><input type="text" id="total_buying' +
                                        curr_beli +
                                        '" name="total_buying[]" readonly></td>' +
                                        '<td><input type="text" id="profit_buy' +
                                        curr_beli +
                                        '" name="profit[]" readonly></td>' +
                                        '</tr>';
                                    $('.profit_tb').append(tb);
                                }
                                if (sum_sgd > 0) {
                                    var curr_beli = 'SGD';
                                    var tb = '<tr>' +
                                        '<td><input type="text" id="currency_prof' +
                                        curr_beli +
                                        '" name="currency[]" readonly></td>' +
                                        '<td><input type="text" id="total_selling' +
                                        curr_beli +
                                        '" name="total_selling[]" readonly></td>' +
                                        '<td><input type="text" id="total_buying' +
                                        curr_beli +
                                        '" name="total_buying[]" readonly></td>' +
                                        '<td><input type="text" id="profit_buy' +
                                        curr_beli +
                                        '" name="profit[]" readonly></td>' +
                                        '</tr>';
                                    $('.profit_tb').append(tb);
                                }
                                if (sum_eur > 0) {
                                    var curr_beli = 'EUR';
                                    var tb = '<tr>' +
                                        '<td><input type="text" id="currency_prof' +
                                        curr_beli +
                                        '" name="currency[]" readonly></td>' +
                                        '<td><input type="text" id="total_selling' +
                                        curr_beli +
                                        '" name="total_selling[]" readonly></td>' +
                                        '<td><input type="text" id="total_buying' +
                                        curr_beli +
                                        '" name="total_buying[]" readonly></td>' +
                                        '<td><input type="text" id="profit_buy' +
                                        curr_beli +
                                        '" name="profit[]" readonly></td>' +
                                        '</tr>';
                                    $('.profit_tb').append(tb);
                                }
                            }
                            // var total = parseInt(sum_s, 10);
                            // var description = tr.find('.autosuggest').val();
                            $('#customer_dp').val(name);
                            $('#currency_dp').val(curr_sell);
                            $('#total_dp').val(sum_s);
                            $('#d_payment').val(sum_s);
                            //profit
                            // $('#currency_prof').val(curr_buy);
                            // $('#total_selling').val(sum_s);
                            // $('#total_buying').val(sum_b);
                            // $('#profit_buy').val(profit);
                        }
                    })
                })
            })
        });
    </script>
@endpush
