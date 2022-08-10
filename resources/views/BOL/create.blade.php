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
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-ETD">{{ __('ETD') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
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
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
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
                                        <label class="form-control-label" for="input-pol_pod">{{ __('pol_pod') }}</label>
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
                                        <label class="form-control-label" for="input-gwt_meas">{{ __('gwt_meas') }}</label>
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
                                        <label class="form-control-label" for="input-vessel1">{{ __('vessel1') }}</label>
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
                                        <label class="form-control-label" for="input-vessel2">{{ __('vessel2') }}</label>
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
    @include('layouts.footers.auth')
@endsection
