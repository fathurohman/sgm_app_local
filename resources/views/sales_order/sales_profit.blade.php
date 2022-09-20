<div class="table-responsive">
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
                    <td>{{ number_format((float) $x->total_selling, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->total_buying, 2, '.', ',') }}</td>
                    <td>{{ number_format((float) $x->profit, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
