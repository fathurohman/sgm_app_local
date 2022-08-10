<form method="post" id="update-form" action="{{ route('cetak_invoice_dua') }}" target="_blank">
    {{ csrf_field() }}
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>Nomor Invoice</th>
            @if ($tipe_cetak == 'I')
                <th>Pajak</th>
            @endif
            <th>Cetak Invoice</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sales_data->nomor_invoice }}</td>
                @if ($tipe_cetak == 'I')
                    <td>
                        <select name="tipe_pajak" id="pajak" class="form-control form-control-alternative pajak"
                            aria-label="Tipe Pajak:" required>
                            <option value="" selected>Pilih Pajak:</option>
                            @foreach ($settings as $x)
                                <option value="{{ $x->value }}">{{ $x->value }}</option>
                            @endforeach
                        </select>
                    </td>
                @endif
                <td>
                    <input type="text" name="id_sales" value="{{ $sales_data->id }}" hidden>
                    <input type="text" name="tipe_cetak" value="{{ $tipe_cetak }}" hidden>
                    <input type="text" name="inv_date" value="{{ $date }}" hidden>
                    <button type="submit" class="btn btn-primary btn-sm btn-rounded">Cetak Invoice</button>
                </td>
            </tr>
        </tbody>
    </table>
</form>
