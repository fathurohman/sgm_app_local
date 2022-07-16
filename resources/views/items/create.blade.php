@extends('layouts.app', ['activePage' => 'items']) 
@section('content')
    @include('users.partials.header', [ 'class' => 'col-lg-7',
])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Add items') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('items.store') }}" autocomplete="off">
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
                                <div class="form-group{{ $errors->has('ITEM') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ITEM">{{ __('ITEM') }}</label>
                                    <input type="text" name="ITEM" id="input-ITEM" class="form-control form-control-alternative{{ $errors->has('ITEM') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('ITEM') }}" required> @if ($errors->has('ITEM'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ITEM') }}</strong>
                                            </span> @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            <a href="{{ route('items.index') }}" type="button" class="btn btn-info mt-4">{{ __('Back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('layouts.footers.auth')
@endsection