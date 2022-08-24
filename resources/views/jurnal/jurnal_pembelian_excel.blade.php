<table>
    <thead>
        <tr>
            <th style="background-color:#6DCCEC">Trans_Date</th>
            <th style="background-color:#6DCCEC">Trans No</th>
            <th style="background-color:#6DCCEC">Description</th>
            <th style="background-color:#6DCCEC">Chart Of Account</th>
            <th style="background-color:#6DCCEC">Debit</th>
            <th style="background-color:#6DCCEC">Credit</th>
            <th style="background-color:#6DCCEC">Ending Balance</th>
            <th style="background-color:#6DCCEC">NOMINAL INV US</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_pembelian as $x)
            <tr>
                <td>{{ date('d-F-Y', strtotime($x->trans_date)) }}</td>
                <td>{{ $x->inv_no }}</td>
                <td>{{ $x->description }}</td>
                <td>{{ $x->coa_id }}</td>
                <td>{{ number_format($x->debit, 2) }}</td>
                <td>{{ number_format($x->credit, 2) }}</td>
                <td>{{ number_format($x->ending_balance, 2) }}</td>
                <td>{{ $x->inv_usd }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
