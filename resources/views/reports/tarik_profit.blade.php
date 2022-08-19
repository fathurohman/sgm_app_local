@extends('layouts.app', ['activePage' => 'tarik_prof']) @push('css')
    {{-- <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet"> --}}
@endpush
@section('content')
    @include('users.partials.header', ['class' => 'col-lg-7'])
    <div class="container-fluid mt--7">
        <form method="post" action="{{ route('export_profit') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5">
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <label for="inputState">Bulan</label>
                            <select id="month_id" name="month" class="form-control" required>
                                <option selected disabled value="">Pilih Bulan...</option>
                                @foreach ($month as $key => $m)
                                    <option value="{{ $key }}">{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <label for="inputState">Sales Name</label>
                            <select id="sales_id" name="sales" class="form-control" required>
                                <option selected value="All">ALL</option>
                                @foreach ($sales_name as $x)
                                    <option value="{{ $x->id }}">{{ $x->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12 col-md-12">
                    <div id="table-prof"></div>
                </div>
            </div>
            <div class="row">
                <div class="ml-3 mt-2 col-lg-6 col-md-6 col-sm-6">
                    <button type="submit" class="btn btn-primary">{{ __('Export Excel') }}</button>
                </div>
            </div>
        </form>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">

            </nav>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        function narik(bulan, sales_id, token) {
            $.ajax({
                url: "{{ route('getprofit') }}",
                method: "GET",
                dataType: "json",
                data: {
                    bulan: bulan,
                    sales_id: sales_id,
                    _token: token
                },
                success: function(data) {
                    $('#table-prof').html(data.html);
                    console.log(data);
                }
            });
        }
        $("#month_id").change(function() {
            var bulan = $('#month_id option:selected').val();
            var sales_id = $('#sales_id option:selected').val();
            var _token = $('input[name="_token"]').val();
            narik(bulan, sales_id, _token);
        });
        $("#sales_id").change(function() {
            var bulan = $('#month_id option:selected').val();
            var sales_id = $('#sales_id option:selected').val();
            var _token = $('input[name="_token"]').val();
            narik(bulan, sales_id, _token);
        });
    </script>
@endpush
