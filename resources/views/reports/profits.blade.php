<table>
    <tr>
        <th colspan="3">
            <h3>PT Sigma Global Makmur</h3>
        </th>
    </tr>
    <tr>
        <th colspan="3">Profit Report</th>
    </tr>
    <tr>
        <th colspan="3">{{ $bulan }} {{ $tahun }}</th>
    </tr>
    <tr>
        <th colspan="3">Sales as {{ $sales_name }}</th>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th style="background-color:#6DCCEC">Total Sellings :</th>
        </tr>
        @foreach ($data_selling as $x)
            <tr>
                <th>Total Sellings {{ $x->curr }} = {{ number_format($x->sub_total) }}</th>
            </tr>
            <p></p>
        @endforeach
        <tr>
            <th style="background-color:#6DCCEC">Total Buyings :</th>
        </tr>
        @foreach ($data_buying as $x)
            <tr>
                <th>Total buyings {{ $x->curr }} = {{ number_format($x->sub_total) }}</th>
            </tr>
            <p></p>
        @endforeach
        <tr>
            <th style="background-color:#6DCCEC">Total Profits :</th>
        </tr>
        @foreach ($data_profits as $x)
            <tr>
                <th>Total Profits {{ $x->curr }} = {{ number_format($x->sub_total) }}</th>
            </tr>
            <p></p>
        @endforeach
    </thead>
</table>
