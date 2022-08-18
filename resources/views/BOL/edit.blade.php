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
                        <form method="post" action="{{ route('bol.update', $bol->id) }}" autocomplete="off" id="form-order">
                            @csrf
                            @method('PUT')
                            <h6 class="heading-small text-muted mb-4">{{ __('Fill this form') }}</h6>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-shipper">{{ __('SHIPPER/EXPORTER') }}</label>
                                    <textarea name="shipper" class="form-control" id="shipper" rows="6">{{ $bol->Shipper }}</textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm12">
                                        <label class="form-control-label" for="input-BL_NO">{{ __('BL_NO') }}</label>
                                        <input type="text" name="bl_no" id="input-BL_NO"
                                            class="form-control form-control-alternative" value="{{ $bol->BL_NO }}"
                                            required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-control-label"
                                            for="input-Export References">{{ __('Export References') }}</label>
                                        <textarea name="export_ref" class="form-control" id="export_ref" rows="2">{{ $bol->Export_References }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-consignee">{{ __('Consignee') }}</label>
                                    <textarea name="consignee" class="form-control" id="consignee" rows="6">{{ $bol->Consignee }}</textarea>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-control-label"
                                            for="input-Forwarding Agent">{{ __('Forwarding Agent') }}</label>
                                        <textarea name="forwarding_agent" class="form-control" id="export_ref" rows="2">{{ $bol->Forwarding_Agent }}</textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm12">
                                        <label class="form-control-label"
                                            for="input-point_country_origin">{{ __('Point Country Origin') }}</label>
                                        <input type="text" name="point_country_origin" id="input-point_country_origin"
                                            class="form-control form-control-alternative"
                                            value="{{ $bol->Point_Country_Origin }}">
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
                                            <textarea name="notify_party" class="form-control" id="Notify Party" rows="4">{{ $bol->Notify_Party }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-pre_carriage">{{ __('PRE-CARRIAGE BY') }}</label>
                                            <input type="text" name="pre_carriage" id="input-pre_carriage"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Pre_Carriage }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-place_receipt">{{ __('PLACE OF RECEIPT') }}</label>
                                            <input type="text" name="place_receipt" id="input-place_receipt"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Place_Receipt }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-exporting_carrier">{{ __('Exporting Carrier') }}</label>
                                            <input type="text" name="exporting_carrier" id="input-exporting_carrier"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Exporting_Carrier }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-port_loading">{{ __('PORT OF LOADING') }}</label>
                                            <input type="text" name="port_loading" id="input-port_loading"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Port_Loading }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-port_discharge">{{ __('PORT OF DISCHARGE') }}</label>
                                            <input type="text" name="port_discharge" id="input-port_discharge"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Port_Discharge }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-port_delivery">{{ __('PORT OF DELIVERY') }}</label>
                                            <input type="text" name="port_delivery" id="input-port_delivery"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Port_Delivery }}"">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-delivery_contact">{{ __('TO OBTAIN DELIVERY CONTACT') }}</label>
                                            <textarea name="delivery_contact" class="form-control" id="delivery_contact" rows="11">{{ $bol->Obtain_Delivery }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-transshipment">{{ __('FOR TRANSHIPMENT TO') }}</label>
                                            <input type="text" name="transshipment" id="input-transshipment"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Transshipment_to }}">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-port_loading">{{ __('FINAL DESTINATION') }}</label>
                                            <input type="text" name="final_destination" id="input-port_loading"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Final_destination }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-marks_number">{{ __('MARKS AND NUMBER') }}</label>
                                    <textarea name="marks_number" class="form-control" id="marks_number" rows="11">{{ $bol->Marks_Number }}</textarea>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-no_of_cont">{{ __('NO OF CONT') }}</label>
                                    <textarea name="no_of_cont" class="form-control" id="no_of_cont" rows="11">{{ $bol->No_Cont_Pkgs }}</textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-description_packages">{{ __('DESCRIPTION OF PACKAGES AND GOODS') }}</label>
                                    <textarea name="description_packages" class="form-control" id="description_packages" rows="11">{{ $bol->Description_Packages_Goods }}</textarea>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-gross_weight">{{ __('GROSS WEIGHT') }}</label>
                                    <textarea name="gross_weight" class="form-control" id="gross_weight" rows="11">{{ $bol->Gross_Weight }}</textarea>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="form-control-label"
                                        for="input-measurement">{{ __('MEASUREMENT') }}</label>
                                    <textarea name="measurement" class="form-control" id="measurement" rows="11">{{ $bol->Measurement }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-freight_charges">{{ __('FREIGHT AND CHARGES') }}</label>
                                            <textarea name="freight_charges" class="form-control" id="freight_charges" rows="4">{{ $bol->Freight_Charges }}</textarea>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-prepaid">{{ __('PREPAID') }}</label>
                                            <textarea name="prepaid" class="form-control" id="prepaid" rows="4">{{ $bol->Prepaid }}</textarea>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-collect">{{ __('COLLECT') }}</label>
                                            <textarea name="collect" class="form-control" id="collect" rows="4">{{ $bol->Collect }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-total_charges">{{ __('TOTAL CHARGES') }}</label>
                                            <input type="text" name="total_charges" id="input-total_charges"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Total_Charges }}">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-freight_payable">{{ __('FREIGHT PAYABLE') }}</label>
                                            <input type="text" name="freight_payable" id="input-freight_payable"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->Freight_Payable }}">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="form-control-label"
                                                for="input-no_original_bl">{{ __('NO ORIGINAL B/L') }}</label>
                                            <input type="text" name="no_original_bl" id="input-colect"
                                                class="form-control form-control-alternative"
                                                value="{{ $bol->No_Original }}">
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
                                                        placeholder="BY" type="text" value="{{ $bol->BY }}">
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
                                                value="{{ $bol->Place_Date_Issue }}">
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
                                                        class="form-control datepicker" type="text"
                                                        value="{{ $bol->ON_Board_Date }}">
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
