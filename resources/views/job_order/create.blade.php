@extends('layouts.app', ['activePage' => 'job_orders'])
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
                        <form method="post" action="{{ route('job_order.store') }}" autocomplete="off" id="form-order">
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
                                            placeholder="order_id" aria-label="order_id" name="order_id">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary neword">
                                                New
                                            </button>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#orderList">
                                                Find
                                            </button>
                                        </div>
                                    </div>
                                    <input id="order-id-hide" type="text" class="form-control"
                                        value="{{ $data['order_id'] }}" hidden>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-3">
                                    <label class="form-control-label" for="input-for"></label>
                                    <input type="text" id="tipe_order" class="form-control form-control-alternative"
                                        required name="tipe_order_text">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-9">
                                    <label class="form-control-label" for="input-for">{{ __('Untuk Transaksi:') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe_order"
                                                id="tipe_order1" value="I">
                                            <label class="form-check-label">I</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe_order"
                                                id="tipe_order2" value="DN">
                                            <label class="form-check-label">DN</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe_order"
                                                id="tipe_order3" value="INV">
                                            <label class="form-check-label">INV</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-Customer">{{ __('Customer') }}</label>
                                    <div class="input-group">
                                        <input id="customer-field" type="text" class="form-control"
                                            placeholder="Customer" aria-label="Customer" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#CustomerList">
                                                Find
                                            </button>
                                        </div>
                                    </div>
                                    <input id="customer-field-id" type="text" class="form-control" placeholder="Customer"
                                        name="client_id" hidden>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('sales') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-sales">{{ __('sales') }}</label>
                                        <select name="sales_id" id="sales_id"
                                            class="form-control form-control-alternative{{ $errors->has('sales') ? ' is-invalid' : '' }}"
                                            aria-label="sales:">
                                            <option selected>Open this select menu</option>
                                            @foreach ($data['sales'] as $x)
                                                <option value="{{ $x->id }}">{{ $x->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('Service') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-Service">{{ __('Service') }}</label>
                                        <select name="service_id" id="service_id"
                                            class="form-control form-control-alternative{{ $errors->has('Service') ? ' is-invalid' : '' }}"
                                            aria-label="Service:">
                                            <option selected>Open this select menu</option>
                                            @foreach ($data['service'] as $x)
                                                <option value="{{ $x->id }}">{{ $x->service_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('via') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-via">{{ __('via') }}</label>
                                        <select name="via_id" id="via_id"
                                            class="form-control form-control-alternative{{ $errors->has('via') ? ' is-invalid' : '' }}"
                                            aria-label="via:">
                                            <option selected>Open this select menu</option>
                                            @foreach ($data['via'] as $x)
                                                <option value="{{ $x->id }}">{{ $x->via_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-ETD">{{ __('ETD') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input id="ETD" name="ETD" class="form-control datepicker"
                                                placeholder="Select date" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-ETA">{{ __('ETA') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input id="ETA" name="ETA" class="form-control datepicker"
                                                placeholder="Select date" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('pol_pod') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-pol_pod">{{ __('pol_pod') }}</label>
                                        <input type="text" name="pol_pod" id="input-pol_pod"
                                            class="form-control form-control-alternative{{ $errors->has('pol_pod') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('pol_pod') }}" required>
                                        @if ($errors->has('pol_pod'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('pol_pod') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('party') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-party">{{ __('party') }}</label>
                                        <input type="text" name="party" id="input-party"
                                            class="form-control form-control-alternative{{ $errors->has('party') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('party') }}" required>
                                        @if ($errors->has('party'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('party') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('hbl') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-hbl">{{ __('hbl') }}</label>
                                        <input type="text" name="hbl" id="input-hbl"
                                            class="form-control form-control-alternative{{ $errors->has('hbl') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('hbl') }}" required>
                                        @if ($errors->has('hbl'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('hbl') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('gwt_meas') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-gwt_meas">{{ __('gwt_meas') }}</label>
                                        <input type="text" name="gwt_meas" id="input-gwt_meas"
                                            class="form-control form-control-alternative{{ $errors->has('gwt_meas') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('gwt_meas') }}" required>
                                        @if ($errors->has('gwt_meas'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gwt_meas') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('mbl') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-mbl">{{ __('mbl') }}</label>
                                        <input type="text" name="mbl" id="input-mbl"
                                            class="form-control form-control-alternative{{ $errors->has('mbl') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('mbl') }}" required>
                                        @if ($errors->has('mbl'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mbl') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('vessel1') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-vessel1">{{ __('vessel1') }}</label>
                                        <input type="text" name="vessel1" id="input-vessel1"
                                            class="form-control form-control-alternative{{ $errors->has('vessel1') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('vessel1') }}" required>
                                        @if ($errors->has('vessel1'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('vessel1') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('consignee') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-consignee">{{ __('consignee') }}</label>
                                        <input type="text" name="consignee" id="input-consignee"
                                            class="form-control form-control-alternative{{ $errors->has('consignee') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('consignee') }}" required>
                                        @if ($errors->has('consignee'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('consignee') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('vessel2') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-vessel2">{{ __('vessel2') }}</label>
                                        <input type="text" name="vessel2" id="input-vessel2"
                                            class="form-control form-control-alternative{{ $errors->has('vessel2') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('vessel2') }}" required>
                                        @if ($errors->has('vessel2'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('vessel2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('agent_overseas') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-agent_overseas">{{ __('agent_overseas') }}</label>
                                        <input type="text" name="agent_overseas" id="input-agent_overseas"
                                            class="form-control form-control-alternative{{ $errors->has('agent_overseas') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('agent_overseas') }}" required>
                                        @if ($errors->has('agent_overseas'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('agent_overseas') }}</strong>
                                            </span>
                                        @endif
                                    </div>
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
    @include('job_order.customerlist')
    @include('layouts.footers.auth')
@endsection
@push('js')
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // $('#customer').DataTable();
        // $('#order').DataTable();
        //list orders
        $('.infoO').click(function() {
            $currID = $(this).attr("data-id");
            $('#order_id-field').val('');
            // alert($currID);
            $.get('/job_data?pid=' + $currID, function(data) {
                $('#order_id-field').val(data['jobs'].order_id);
                $('#tipe_order').val(data['jobs'].tipe_order);
                $('#customer-field').val(data['name_client']);
                $('#customer-field-id').val(data['jobs'].client_id);
                $('#sales_id').val(data['jobs'].sales_id);
                $('#service_id').val(data['jobs'].service_id);
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
        $('.neword').click(function() {
            $('#order_id-field').val('');
            $('#tipe_order').val('');
            $('#customer-field').val('');
            $('#customer-field-id').val('');
            $('#sales_id').val('');
            $('#service_id').val('');
            $('#via_id').val('');
            $('#ETD').val('');
            $('#ETA').val('');
            $('#input-pol_pod').val('');
            $('#input-party').val('');
            $('#input-hbl').val('');
            $('#input-gwt_meas').val('');
            $('#input-mbl').val('');
            $('#input-vessel1').val('');
            $('#input-vessel2').val('');
            $('#input-consignee').val('');
            $('#input-agent_overseas').val('');
            $('input[name="tipe_order"]').prop('checked', false);
            var order_num = $('#order-id-hide').val();
            $('#order_id-field').val(order_num);
        });

        $('#form-order input').on('change', function() {
            $('#tipe_order').val('');
            var nama_tipe = '';
            var order_id = $('#order_id-field').val();
            var tipe = ($('input[name=tipe_order]:checked', '#form-order').val());
            // $.get('/set_tipe?pid=' + order_id + "/tipe=" + tipe, function(data) {
            //     // $('#ticket_data').html(data);
            //     console.log(data);
            //     // For debugging purposes you can add : console.log(data); to see the output of your request
            // });
            $.ajax({
                type: "GET",
                url: "/set_tipe",
                data: {
                    pid: order_id,
                    tipe: tipe
                },
                datatype: "html",
                success: function(result) {
                    $('#tipe_order').val(result.tipe + '-' + result.row)
                }
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#order').DataTable({
                processing: true,
                serverSide: true,
                drawCallback: function(settings) {
                    $('.infoO').click(function() {
                        $currID = $(this).attr("data-id");
                        $('#order_id-field').val('');
                        // alert($currID);
                        $.get('/job_data?pid=' + $currID, function(data) {
                            $('#order_id-field').val(data['jobs'].order_id);
                            $('#tipe_order').val(data['jobs'].tipe_order);
                            $('#customer-field').val(data['name_client']);
                            $('#customer-field-id').val(data['jobs'].client_id);
                            $('#sales_id').val(data['jobs'].sales_id);
                            $('#service_id').val(data['jobs'].service_id);
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
                ajax: '{!! route('listorder') !!}',
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#customer').DataTable({
                processing: true,
                serverSide: true,
                drawCallback: function(settings) {
                    $('.infoU').click(function() {
                        $currID = $(this).attr("data-id");
                        $('#customer-field').val('');
                        $('#customer-field-id').val('');
                        // alert($currID);
                        $.get('/customer_data?pid=' + $currID, function(data) {
                            $('#customer-field').val(data.COMPANY_NAME);
                            $('#customer-field-id').val(data.id);
                            // console.log(data);
                            // For debugging purposes you can add : console.log(data); to see the output of your request
                        });
                        $('#CustomerList').modal('toggle');
                        // $('#customer-field').val($currID);
                    });
                },
                ajax: '{!! route('listcustomer') !!}',
                columns: [{
                        data: 'COMPANY_NAME',
                        name: 'COMPANY_NAME'
                    },
                    {
                        data: 'NPWP',
                        name: 'NPWP'
                    },
                    {
                        data: 'Address',
                        name: 'Address'
                    },
                    {
                        data: 'Action',
                        name: 'Action'
                    },
                ]
            });
        });
    </script>
@endpush
