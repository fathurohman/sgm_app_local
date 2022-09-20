<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <th>Customer</th>
            <th>Curr</th>
            <th>Total</th>
            <th>Down Payments</th>
        </thead>
        <tbody>
            <tr>
                <td>{{ $dp_orders->customer }}</td>
                <td>{{ $dp_orders->currency }}</td>
                <td>{{ number_format($dp_orders->total) }}</td>
                <td>{{ number_format($dp_orders->dp) }}</td>
            </tr>
        </tbody>
    </table>
</div>
