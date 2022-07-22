<table>
    <tr>
        <th colspan="3">
            <h3>PT Sigma Global Makmur</h3>
        </th>
    </tr>
    <tr>
        <th colspan="3">Sales Report</th>
    </tr>
    <tr>
        <th colspan="3">{{ $bulan }} {{ $tahun }}</th>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th style="background-color:#6DCCEC">No</th>
            <th style="background-color:#6DCCEC">No.Invoice</th>
            <th style="background-color:#6DCCEC">Invoice Date</th>
            <th style="background-color:#6DCCEC">No. Seri faktur pajak</th>
            <th style="background-color:#6DCCEC">Customer Name</th>
            <th style="background-color:#6DCCEC">Nilai Invoice</th>
            <th style="background-color:#6DCCEC">PPN</th>
            <th style="background-color:#6DCCEC">Grand Total</th>
            <th style="background-color:#6DCCEC">VAT</th>
            <th style="background-color:#6DCCEC">Project</th>
            <th style="background-color:#6DCCEC">Sales Name</th>
            <th style="background-color:#6DCCEC">Date Of Payment</th>
            <th style="background-color:#6DCCEC">PPH</th>
            <th style="background-color:#6DCCEC">Amount</th>
            <th style="background-color:#6DCCEC">Payment</th>
            <th style="background-color:#6DCCEC">AR</th>
            <th></th>
            <th style="background-color:#6DCCEC">SALES USD</th>
            <th style="background-color:#6DCCEC">KURS 1/2 BI</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reports as $x)
            <tr>
                <td>{{ $x->id }}</td>
                <td>{{ $x->no_inv }}</td>
                <td>{{ $x->inv_date }}</td>
                <td>{{ $x->seri_faktur }}</td>
                <td>{{ $x->cust_name }}</td>
                <td>{{ number_format($x->nilai_inv, 2) }}</td>
                <td>{{ number_format($x->ppn, 2) }}</td>
                <td>{{ number_format($x->grand_total, 2) }}</td>
                <td>{{ number_format($x->vat, 2) }}</td>
                <td>{{ $x->job_no }}</td>
                <td>{{ $x->sales_name }}</td>
                <td>{{ $x->dop }}</td>
                <td>{{ number_format($x->pph, 2) }}</td>
                <td>{{ number_format($x->amount, 2) }}</td>
                <td>{{ $x->payment }}</td>
                <td>{{ number_format($x->AR, 2) }}</td>
                <td></td>
                <td>{{ $x->sales_usd }}</td>
                <td>{{ $x->kurs_bi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
