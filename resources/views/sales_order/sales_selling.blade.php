<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <th>Description</th>
        <th>Qty</th>
        <th>Curr</th>
        <th>Price</th>
        <th>Sub Total</th>
        <th>Remark</th>
        <th>Name</th>
    </thead>
    <tbody>
        @foreach ($selling_orders as $x)
            <tr>
                <td>{{ $x->description }}</td>
                <td>{{ $x->qty }}</td>
                <td>{{ $x->curr }}</td>
                <td>{{ number_format($x->price) }}</td>
                <td>{{ number_format($x->sub_total) }}</td>
                <td>{{ $x->remark }}</td>
                <td>{{ $x->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
