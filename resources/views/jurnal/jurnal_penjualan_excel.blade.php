<table>
    <thead>
        <tr>
            <th style="background-color:#6DCCEC">Trans_Date</th>
            <th style="background-color:#6DCCEC">Customer</th>
            <th style="background-color:#6DCCEC">Trans No</th>
            <th style="background-color:#6DCCEC">Description</th>
            <th style="background-color:#6DCCEC">Chart Of Account</th>
            <th style="background-color:#6DCCEC">Debit</th>
            <th style="background-color:#6DCCEC">Credit</th>
            <th style="background-color:#6DCCEC">Ending Balance</th>
            <th style="background-color:#6DCCEC">NOMINAL INV US</th>
            <th style="background-color:#6DCCEC">KURS IDR 1/2(BI)</th>
            <th style="background-color:#6DCCEC">No Faktur</th>
            <th style="background-color:#6DCCEC">Status Bayar</th>
            <th style="background-color:#6DCCEC">Tgl Pay</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_penjualan as $x)
            <tr>
                <td>{{ date('d-F-Y', strtotime($x->trans_date)) }}</td>
                <td>{{ $x->Customer }}</td>
                <td>{{ $x->inv_no }}</td>
                <td>{{ $x->description }}</td>
                <td>{{ $x->coa->kd_aktiva }}</td>
                <td>{{ number_format($x->debit, 2) }}</td>
                <td>{{ number_format($x->credit, 2) }}</td>
                <td>{{ number_format($x->ending_balance, 2) }}</td>
                <td>{{ $x->inv_us }}</td>
                <td>{{ $x->kurs_idr }}</td>
                <td>{{ $x->no_faktur }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
