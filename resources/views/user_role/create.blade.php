@extends('layouts.app', ['activePage' => 'userrole'])

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
                            <h3 class="mb-0">{{ __('Give Access') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('roleuser.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Fill this form') }}</h6>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('name') }}</label>
                                        <input type="text" id="input-name" class="form-control autosuggest ui-widget"
                                            placeholder="{{ __('name') }}" required>
                                        <input type="text" id="name_id" name="name" hidden>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('for') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-for">{{ __('for') }}</label>
                                        <select name="for" class="form-control form-control-alternative"
                                            aria-label="Permission For:">
                                            <option selected>Open this select menu</option>
                                            @foreach ($roles as $x)
                                                <option value="{{ $x->id }}">{{ $x->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="#" type="button" class="btn btn-info mt-4">{{ __('Back') }}</a>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.autosuggest').on('focus', function() {
                // console.log(tipeatk);
                $(this).autocomplete({
                    source: "{{ URL('search/autocomplete_username') }}",
                    // source: "{{ URL('search/autocompletenama') }}",
                    minLength: 1,
                    select: function(event, ui) {
                        $('#input-name').val(ui.item.value);
                        $('#name_id').val(ui.item.id);
                    }
                })
            })
        });
    </script>
@endpush
