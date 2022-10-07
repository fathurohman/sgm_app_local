<table id="dataTables1" class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">Invoice No</th>
            <th scope="col">Invoice Date</th>
            <th scope="col">No. Seri faktur pajak</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Nilai Invoice</th>
            <th scope="col">Nilai Invoice USD</th>
            <th scope="col">PPN</th>
            <th scope="col">Grand Total</th>
            <th scope="col">VAT</th>
            <th scope="col">Project</th>
            <th scope="col">Sales Name</th>
            <th scope="col">PPH</th>
            <th scope="col">Amount</th>
            <th scope="col">Payment</th>
            <th scope="col">AR</th>
            <th scope="col">SALES USD</th>
            <th scope="col">KURS 1/2 BI</th>
            
            {{-- <th scope="col">Delete</th> --}}
        </tr>
    </thead>
    <tbody>
         {{-- @if (is_array($data['sales']) || is_object($data['sales'])) --}}
         @foreach ($data['sales'] as $x)
        @php
            $id = $x->id;
            if (empty($x->vat)) {
                $pajak = 0;
            } else {
                $pajak = $x->vat;
            }
            $no_inv = $x->nomor_invoice;
            $ptng = sprintf('%03d', $no_inv);
            $sub_string = substr($no_inv, strpos($no_inv, "/") + 1);
            $inv_fix = "$ptng/$sub_string";
            $inv_date = $x->inv_date;
            $job_orders = $x->job_orders->order_id;
            if ($x->tipe == 'I') {
                $faktur = '-';
            } else {
                $faktur = 'DEBIT NOTE';
            }
            $sales_name = $x->sales->name;
            $selling = $x->sellings;
            $sum_idr = 0;
            $sum_usd = 0;
            foreach ($selling as $y) {
                $curr = $y->curr;
                $sub_total = $y->sub_total;
                if ($curr == 'IDR') {
                    $sum_usd = 0;
                    $sum_idr += $sub_total;
                } elseif ($curr == 'USD') {
                    $sum_idr = 0;
                    $sum_usd += $sub_total;
                } else {
                    $sum_idr = 0;
                    $sum_usd = 0;
                }
                $customer = $y->name;
            }

            if ($x->tipe == 'I') {
                $pph = $sum_idr * (2 / 100);
                $vat = $pajak / 100;
                $total_pajak = $sum_idr * $vat;
                $total_charge = $sum_idr + $total_pajak;
                $amount_ar = $total_charge - $pph;
            } else {
                $pph = 0;
                $vat = 0;
                $total_pajak = 0;
                $total_charge = $sum_idr;
                $amount_ar = $total_charge;
            }
            $payment = 0;
            $kurs_bi = 0;

        @endphp
        <tr>
            <td>{{ $x['nomor_invoice']}}</td>
            <td>{{ $x->inv_date}}</td>
            <td>{{ $faktur}}</td>
            <td>{{$customer}}</td>
            <td>
                @if ($sum_idr != 0)
                    {{ number_format($sum_idr, 2) }}
                @else
                    0
                @endif
            </td>
            <td>
                @if ($sum_usd != 0)
                    {{ number_format($sum_usd, 2) }}
                @else
                    0
                @endif
            </td>
            <td>{{ number_format($total_pajak, 2) }}</td>
            <td>{{ number_format($total_charge, 2) }}</td>
            <td>{{ number_format($pajak, 2) }} %</td>
            <td>{{ $job_orders }}</td>
            <td>{{ $sales_name}}</td>
            {{-- <td>{{ $x->dop }}</td> --}}
            <td>{{ number_format($pph, 2) }}</td>
            <td>{{ number_format($amount_ar, 2) }}</td>
            <td>{{ $payment }}</td>
            <td>{{ number_format($amount_ar, 2) }}</td>
            <td>
                @if ($sum_usd != 0)
                    {{ $sum_usd }}
                @else
                    0
                @endif
            </td>
            <td>{{ $kurs_bi }}</td>
        </tr>
         @endforeach 
         {{-- @endif  --}}
    </tbody>
</table>


@push('js')

@endpush