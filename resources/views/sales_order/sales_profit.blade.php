<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <th>Currency</th>
        <th>Total Selling</th>
        <th>Total Buying</th>
        <th>Profit</th>
    </thead>
    <tbody>
        @foreach ($profit_orders as $x)
            <tr>
                <td>{{ $x->currency }}</td>
                <td>{{ number_format($x->total_selling) }}</td>
                <td>{{ number_format($x->total_buying) }}</td>
                <td>{{ number_format($x->profit) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
