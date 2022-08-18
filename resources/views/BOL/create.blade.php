@extends('layouts.app', ['activePage' => 'BOL'])
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
                            <h3 class="mb-0">{{ __('Add Bill Of Landing') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('bol.store') }}" autocomplete="off" id="form-order">
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
                                    <label class="form-control-label"
                                        for="input-shipper">{{ __('SHIPPER/EXPORTER') }}</label>
                                    <textarea name="shipper" class="form-control" id="shipper" rows="6" placeholder="SHIPPER/EXPORTER..."></textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm12">
                                        <label class="form-control-label" for="input-BL_NO">{{ __('BL_NO') }}</label>
                                        <input type="text" name="bl_no" id="input-BL_NO"
                                            class="form-control form-control-alternative" placeholder="{{ __('BL_NO') }}"
                                            required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-control-label"
                                            for="input-Export References">{{ __('Export References') }}</label>
                                        <textarea name="export_ref" class="form-control" id="export_ref" rows="2" placeholder="Export References"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-consignee">{{ __('Consignee') }}</label>
                                    <textarea name="consignee" class="form-control" id="consignee" rows="6" placeholder="Consignee..."></textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-control-label"
                                            for="input-Forwarding Agent">{{ __('Forwarding Agent') }}</label>
                                        <textarea name="forwarding_agent" class="form-control" id="export_ref" rows="2" placeholder="Forwarding Agent"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm12">
                                        <label class="form-control-label"
                                            for="input-point_country_origin">{{ __('Point Country Origin') }}</label>
                                        <input type="text" name="point_country_origin" id="input-point_country_origin"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('Point Country Origin') }}">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-Notify Party">{{ __('Notify Party') }}</label>
                                            <textarea name="notify_party" class="form-control" id="Notify Party" rows="4" placeholder="Notify Party"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-pre_carriage">{{ __('PRE-CARRIAGE BY') }}</label>
                                            <input type="text" name="pre_carriage" id="input-pre_carriage"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('PRE-CARRIAGE BY') }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-place_receipt">{{ __('PLACE OF RECEIPT') }}</label>
                                            <input type="text" name="place_receipt" id="input-place_receipt"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('PLACE OF RECEIPT') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-exporting_carrier">{{ __('Exporting Carrier') }}</label>
                                            <input type="text" name="exporting_carrier" id="input-exporting_carrier"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('Exporting Carrier') }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-port_loading">{{ __('PORT OF LOADING') }}</label>
                                            <input type="text" name="port_loading" id="input-port_loading"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('PORT OF LOADING') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-port_discharge">{{ __('PORT OF DISCHARGE') }}</label>
                                            <input type="text" name="port_discharge" id="input-port_discharge"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('PORT OF DISCHARGE') }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-port_delivery">{{ __('PORT OF DELIVERY') }}</label>
                                            <input type="text" name="port_delivery" id="input-port_delivery"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('PORT OF DELIVERY') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-delivery_contact">{{ __('DELIVERY CONTACT') }}</label>
                                            <textarea name="delivery_contact" class="form-control" id="delivery_contact" rows="11"
                                                placeholder="DELIVERY CONTACT"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-transshipment">{{ __('FOR TRANSHIPMENT TO') }}</label>
                                            <input type="text" name="transshipment" id="input-transshipment"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('FOR TRANSHIPMENT TO') }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-port_loading">{{ __('FINAL DESTINATION') }}</label>
                                            <input type="text" name="final_destination" id="input-port_loading"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('FINAL DESTINATION') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-marks_number">{{ __('MARKS AND NUMBER') }}</label>
                                    <textarea name="marks_number" class="form-control" id="marks_number" rows="11" placeholder="MARKS AND NUMBER"></textarea>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-no_of_cont">{{ __('NO OF CONT') }}</label>
                                    <textarea name="no_of_cont" class="form-control" id="no_of_cont" rows="11"
                                        placeholder="NO OF CONT OR OTHER PKGS"></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-description_packages">{{ __('DESCRIPTION OF PACKAGES AND GOODS') }}</label>
                                    <textarea name="description_packages" class="form-control" id="description_packages" rows="11"
                                        placeholder="DESCRIPTION OF PACKAGES AND GOODS"></textarea>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-gross_weight">{{ __('GROSS WEIGHT') }}</label>
                                    <textarea name="gross_weight" class="form-control" id="gross_weight" rows="11" placeholder="GROSS WEIGHT"></textarea>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-measurement">{{ __('MEASUREMENT') }}</label>
                                    <textarea name="measurement" class="form-control" id="measurement" rows="11" placeholder="MEASUREMENT"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-freight_charges">{{ __('FREIGHT AND CHARGES') }}</label>
                                            <textarea name="freight_charges" class="form-control" id="freight_charges" rows="4"
                                                placeholder="FREIGHT AND CHARGES"></textarea>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-prepaid">{{ __('PREPAID') }}</label>
                                            <textarea name="prepaid" class="form-control" id="prepaid" rows="4" placeholder="PREPAID"></textarea>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-collect">{{ __('COLLECT') }}</label>
                                            <textarea name="collect" class="form-control" id="collect" rows="4" placeholder="COLLECT"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-total_charges">{{ __('TOTAL CHARGES') }}</label>
                                            <input type="text" name="total_charges" id="input-total_charges"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('TOTAL CHARGES') }}">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-freight_payable">{{ __('FREIGHT PAYABLE') }}</label>
                                            <input type="text" name="freight_payable" id="input-freight_payable"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('FREIGHT PAYABLE') }}">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-no_original_bl">{{ __('NO ORIGINAL B/L') }}</label>
                                            <input type="text" name="no_original_bl" id="input-colect"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('NO ORIGINAL B/L') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col md-12 mt-6">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="input-BY">{{ __('BY') }}</label>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                    <input id="BY" name="BY" class="form-control datepicker"
                                                        placeholder="BY" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-6">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-place_and_date">{{ __('PLACE AND DATE') }}</label>
                                            <input type="text" name="place_and_date" id="input-place_and_date"
                                                class="form-control form-control-alternative"
                                                placeholder="{{ __('PLACE AND DATE') }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="input-on_board_date">{{ __('ON BOARD DATE') }}</label>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="ni ni-calendar-grid-58"></i></span>
                                                    </div>
                                                    <input id="on_board_date" name="on_board_date"
                                                        class="form-control datepicker" placeholder="ON BOARD DATE"
                                                        type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="{{ route('bol.index') }}" type="button"
                                    class="btn btn-info mt-4">{{ __('Back') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
@endsection
@push('js')
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
@endpush
