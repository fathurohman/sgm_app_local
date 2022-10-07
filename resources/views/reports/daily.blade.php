@extends('layouts.app', ['activePage' => 'reports']) @push('css')
     {{-- <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet"> --}}
     <Link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', ['class' => 'col-lg-7'])
    <div class="container-fluid mt--7">
        <form method="post" action="{{ route('export') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5">
                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <label for="inputState">Bulan dari</label>
                            <select id="month_id" name="month" class="form-control" required>
                                <option selected disabled value="">Pilih Bulan...</option>
                                @foreach ($month as $key => $m)
                                    <option value="{{ $key }}">{{ $m }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="inputState">Bulan Sampai</label>
                            <select id="month_id2" name="month2" class="form-control" required>
                                <option selected disabled value="ALL">Pilih Bulan...</option>
                                @foreach ($month as $key => $m)
                                    <option value="{{ $key }}">{{ $m }}</option>
                                @endforeach
                            </select>
                            <br>
                            {{-- <label for="inputState">Tahun</label>
                            <input type="text" class="form-control" name="datepicker" id="datepicker" />
                           --}}
                           <label for="inputState">Tahun</label>
                            <select id="years_id" name="years" class="form-control" required>
                                <option selected value="{{$y}}">{{$y}}</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                            </select>
                            <br>
                           
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
                            <br>
                            <label for="inputState">Tipe Order</label>
                            <select id="tipe_id" name="tipe" class="form-control" required>
                                <option selected value="All">ALL</option>
                                <option value="I">Invoice</option>
                                <option value="DN">Debit Note</option>
                            </select>

                        </div>
                    </div>
                </div>
                
              
            </div>
            {{-- <div class="row mt-2">
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

                <div class="col-xl-6 mb-5 mb-xl-0">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <label for="inputState">Tipe Order</label>
                            <select id="tipe_id" name="tipe" class="form-control" required>
                                <option selected value="All">ALL</option>
                                <option value="I">Invoice</option>
                                <option value="DN">Debit Note</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div> --}}
            <div class="row">
                <div class="ml-3 mt-2 col-lg-6 col-md-6 col-sm-6">
                    <button type="submit" class="btn btn-primary">{{ __('Export Excel') }}</button>
                </div>
            </div>
        </form>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
                <div class="table-responsive">
                    <div id="table-remonthly"></div>
                </div>
            </nav>
        </div>
    </div>

       
        
    </div>

@endsection


@push('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
//     $(document).ready( function () {
//     $('#dataTables1').DataTable();
// } );

// $(document).ready(function () {
//     $('#example').DataTable();
// });
</script>

    <script type="text/javascript">
        function narik(tipe, month, month2, years, sales_id, token) {
            $.ajax({
                url: "{{ route('getremonthly') }}",
                method: "GET",
                dataType: "json",
                data: {
                    tipe: tipe,
                    month: month,
                    month2: month2,
                    years: years,
                    sales_id: sales_id,
                    _token: token
                },
                success: function(data) {
                    $('#table-remonthly').html(data.html);
                    console.log(data);

                    $('#dataTables1').DataTable();
                    
                }
            });
        }
        $("#month_id").change(function() {
            var tipe = $('#tipe_id option:selected').val();
            var month = $('#month_id option:selected').val();
            var month2 = $('#month_id2 option:selected').val();
            var years = $('#years_id option:selected').val();
            var sales_id = $('#sales_id option:selected').val();
            var _token = $('input[name="_token"]').val();
            narik(tipe, month, month2, years, sales_id, _token);
        });
        $("#month_id2").change(function() {
            var tipe = $('#tipe_id option:selected').val();
            var month = $('#month_id option:selected').val();
            var month2 = $('#month_id2 option:selected').val();
            var years = $('#years_id option:selected').val();
            var sales_id = $('#sales_id option:selected').val();
            var _token = $('input[name="_token"]').val();
            narik(tipe, month, month2, years, sales_id, _token);
        });
        $("#sales_id").change(function() {
            var tipe = $('#tipe_id option:selected').val();
            var month = $('#month_id option:selected').val();
            var month2 = $('#month_id2 option:selected').val();
            var years = $('#years_id option:selected').val();
            var sales_id = $('#sales_id option:selected').val();
            var _token = $('input[name="_token"]').val();
            narik(tipe, month, month2, years, sales_id, _token);
        });
        $("#tipe_id").change(function() {
            var tipe = $('#tipe_id option:selected').val();
            var month = $('#month_id option:selected').val();
            var month2 = $('#month_id2 option:selected').val();
            var years = $('#years_id option:selected').val();
            var sales_id = $('#sales_id option:selected').val();
            var _token = $('input[name="_token"]').val();
            narik(tipe, month, month2, years, sales_id, _token);
        });

        $("#years_id").change(function() {
            var tipe = $('#tipe_id option:selected').val();
            var month = $('#month_id option:selected').val();
            var month2 = $('#month_id2 option:selected').val();
            var years = $('#years_id option:selected').val();
            var sales_id = $('#sales_id option:selected').val();
            var _token = $('input[name="_token"]').val();
            narik(tipe, month, month2, years, sales_id, _token);
        });
    </script>
@endpush
