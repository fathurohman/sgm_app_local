@extends('layouts.app', ['activePage' => 'client'])

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
                            <h3 class="mb-0">{{ __('Update Clients') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('client.update', $client->id) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
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
                                    <div class="form-group{{ $errors->has('npwp') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-npwp">{{ __('npwp') }}</label>
                                        <input type="text" name="npwp" id="input-npwp"
                                            class="form-control form-control-alternative{{ $errors->has('npwp') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('npwp') }}" value="{{ $client->NPWP }}" required
                                            autofocus>

                                        @if ($errors->has('npwp'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('npwp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('name') }}" value="{{ $client->COMPANY_NAME }}"
                                            required>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-alamat">{{ __('alamat') }}</label>
                                        <textarea name="alamat" class="form-control" id="area1" rows="3" placeholder="Alamat..." required>{{ $client->ADDRESS }}</textarea>
                                        @if ($errors->has('alamat'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('telephone') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-telephone">{{ __('telephone') }}</label>
                                        <input type="number" name="telephone" id="input-telephone"
                                            class="form-control form-control-alternative{{ $errors->has('telephone') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('telephone') }}" value="{{ $client->TELEPHONE }}"
                                            required>

                                        @if ($errors->has('telephone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telephone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-8 col-sm-12">
                                    <label class="form-control-label" for="input-send">{{ __('Active') }}</label>
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input name="active" class="custom-control-input" id="Active" type="checkbox"
                                            value="1" @if ($client->active == 1) {{ 'checked' }} @endif>
                                        <label class="custom-control-label" for="Active">Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="{{ route('client.index') }}" type="button"
                                    class="btn btn-info mt-4">{{ __('Back') }}</a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    </div>
@endsection
