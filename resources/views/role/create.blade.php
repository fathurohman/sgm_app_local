@extends('layouts.app', ['title' => __('Create role')])

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
                            <h3 class="mb-0">{{ __('Add Roles') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('role.store') }}" autocomplete="off">
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
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('name') }}" required>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('for') ? ' has-danger' : '' }}">
                                        <div class="row">
                                            <label class="form-control-label"
                                                for="input-for">{{ __('Untuk Transaksi:') }}</label>
                                            <div class="col-sm-7">
                                                @foreach ($permissions as $permission)
                                                    @if ($permission->for == 'Transaction')
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="permission[]"
                                                                    type="checkbox" value="{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="form-control-label"
                                                for="input-for">{{ __('Untuk Vendor & Clients:') }}</label>
                                            <div class="col-sm-7">
                                                @foreach ($permissions as $permission)
                                                    @if ($permission->for == 'Vendor & Clients')
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="permission[]"
                                                                    type="checkbox" value="{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="form-control-label"
                                                for="input-for">{{ __('Hak Akses:') }}</label>
                                            <div class="col-sm-7">
                                                @foreach ($permissions as $permission)
                                                    @if ($permission->for == 'Hak-Akses')
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="permission[]"
                                                                    type="checkbox" value="{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="form-control-label"
                                                for="input-for">{{ __('Untuk Lainnya:') }}</label>
                                            <div class="col-sm-7">
                                                @foreach ($permissions as $permission)
                                                    @if ($permission->for == 'Other')
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="permission[]"
                                                                    type="checkbox" value="{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                                <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
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
