<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" href="{{ public_path('argon') }}/css/invoice.css" rel="stylesheet">
</head>

<body>
    <div class="table-request">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left">Invoice</th>
                <th style="width: 5%">:</th>
                <th style="width: 40%; text-align:left">{{ $data['inv'] }}</th>
                <th style="width: 10%; text-align:left">Date</th>
                <th style="width: 5%">:</th>
                <th style="width: 20%; text-align:left">{{ $data['tanggal'] }}</th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">POL/POD</th>
                <th style="width: 5%">:</th>
                <th style="width: 40%; text-align:left">{{ $data['sales_job']['pol_pod'] }}</th>
                <th style="width: 15%; text-align:left">JOB ORDER</th>
                <th style="width: 5%">:</th>
                <th style="width: 15%; text-align:left">{{ $data['sales_job']['order_id'] }}</th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">VESSEL/ VOY</th>
                <th style="width: 5%">:</th>
                <th style="width: 40%; text-align:left">{{ $data['sales_job']['vessel1'] }}</th>
                <th style="width: 10%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">ETD</th>
                <th style="width: 5%">:</th>
                <th style="width: 40%; text-align:left">{{ $data['ETD'] }}</th>
                <th style="width: 10%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">ETA</th>
                <th style="width: 5%">:</th>
                <th style="width: 40%; text-align:left">{{ $data['ETA'] }}</th>
                <th style="width: 10%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">PARTY</th>
                <th style="width: 5%">:</th>
                <th style="width: 60%; text-align:left">{{ $data['sales_job']['party'] }}</th>
                <th style="width: 5%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">HBL / MBL</th>
                <th style="width: 5%">:</th>
                <th style="width: 60%; text-align:left">
                    {{ $data['sales_job']['HBL'] }} {{ $data['sales_job']['MBL'] }}
                </th>
                <th style="width: 5%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">GWT / MEAS</th>
                <th style="width: 5%">:</th>
                <th style="width: 60%; text-align:left">{{ $data['sales_job']['GWT_MEAS'] }}</th>
                <th style="width: 5%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%; text-align:left"></th>
            </tr>
        </table>
    </div>
    <div class="table-customer">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left">Customer</th>
                <th style="width: 5%">:</th>
                <th style="width: 75%; text-align:left">{{ $data['customer']['COMPANY_NAME'] }}</th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">Address</th>
                <th style="width: 5%">:</th>
                <th rowspan="2" style="width: 75%; text-align:left">{{ $data['customer']['ADDRESS'] }}</th>
            </tr>
            <tr>
                <th style="width: 20%;"></th>
                <th style="width: 5%;"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">Telephone</th>
                <th style="width: 5%">:</th>
                <th style="width: 75%; text-align:left">{{ $data['customer']['TELEPHONE'] }}</th>
            </tr>
        </table>
    </div>
    <table class="selling">
        <tr class="selling-judul">
            <th class="kanan" style="width: 48%; text-align:center">Description</th>
            <th class="kanan" style="width: 11%">Volume</th>
            <th class="kanan" style="width: 22%; text-align:center">Price / Unit</th>
            <th style="width: 5%; text-align:center"></th>
            <th style="width: 14%; text-align:center">Value</th>
        </tr>
        @foreach ($data['selling'] as $x)
            <tr>
                <td class="selling-value" style="padding-left:2px;text-align:left;font-weight:bold">
                    {{ $x->description }}</td>
                <td class="selling-value" style="padding-right:4px;text-align:right;font-weight:bold">
                    {{ $x->qty }}</td>
                <td class="selling-value" style="padding-right:4px;text-align:right;font-weight:bold">
                    {{ number_format($x->price) }}
                </td>
                <td style="padding-left:2px;text-align:left;font-weight:bold">{{ $x->curr }}</td>
                <td style="padding-right:2px;text-align:right;font-weight:bold">
                    {{ number_format($x->sub_total) }}</td>
            </tr>
        @endforeach
        <tr>
            @if ($data['jumlah_penjualan'] <= '5')
                <td class="empty-td-5 empty-value"></td>
            @elseif($data['jumlah_penjualan'] > '5' && $data['jumlah_penjualan'] <= '10')
                <td class="empty-td-10 empty-value"></td>
            @else
                <td class="empty-td-15 empty-value"></td>
            @endif
            <td class="empty-value"></td>
            <td class="empty-value"></td>
            <td class="last-empty-value"></td>
            <td class="last-empty-value"></td>
        </tr>
        <tr>
            <td rowspan="3" colspan="2" style="text-align:left;font-weight:bold">
                @if ($data['curr'] == 'IDR')
                    Terbilang :
                @else
                    IN WORDS :
                @endif {{ $data['terbilang'] }}
            </td>
            <td style="padding-left:2px;font-weight:bold">Total:</td>
            <td class="terbilang-value" style="font-weight:bold">{{ $data['curr'] }}</td>
            <td style="text-align:right;font-weight:bold">
                {{ number_format($data['sum']) }}
            </td>
        </tr>
        <tr>
            <td style="padding-left:2px;font-weight:bold">VAT {{ $data['nilai_pajak'] }} % :</td>
            <td class="terbilang-value" style="font-weight:bold">{{ $data['curr'] }}</td>
            <td style="text-align:right;font-weight:bold">
                {{ number_format($data['total_pajak']) }}
            </td>
        </tr>
        <tr>
            <td style="padding-left:2px;font-weight:bold">Total Charges :</td>
            <td class="last-terbilang-value" style="font-weight:bold">{{ $data['curr'] }}</td>
            <td class="last-empty-value" style="text-align:right;font-weight:bold">
                {{ number_format((float) $data['total_charge'], 2, '.', '') }}
                {{-- {{ number_format($data['total_charge']) }} --}}
            </td>
        </tr>
        {{-- <tr>
            <td colspan="2" style="text-align:left">Terbilang : {{ $data['terbilang'] }}</td>
            <td style="text-align:left">Total :</td>
            <td style="text-align:left">{{ $data['curr'] }} {{ number_format($data['sum']) }}</td>
        </tr> --}}
    </table>
    {{-- <div class="table-terbilang">
        <table>
            <tr>
                <th rowspan="3" style="width: 18%;text-align:left">Terbilang :</th>
                <th rowspan="3" style="width: 41%;text-align:left">{{ $data['terbilang'] }}</th>
                <th class="terbilang-value" style="width: 22%;text-align:left">Total :</th>
                <th style="width: 19%;text-align:left">{{ $data['curr'] }} {{ number_format($data['sum']) }}</th>
            </tr>
            <tr>
                <td class="terbilang-value" style="text-align:left">VAT {{ $data['nilai_pajak'] }} % :</td>
                <td style="text-align:left">{{ $data['curr'] }} {{ number_format($data['total_pajak']) }}</td>
            </tr>
            <tr>
                <td class="last-terbilang-value" style="text-align:left">Total Charges :</td>
                <td class="last-empty-value" style="text-align:left">{{ $data['curr'] }} {{ number_format($data['total_charge']) }}</td>
            </tr>
        </table>
    </div> --}}
    <div class="table-signature">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 40%; text-align:left"></th>
                <th style="width: 30%; text-align:center">PT SIGMA GLOBAL MAKMUR</th>
                <th style="width: 5%; text-align:left"></th>
            </tr>
        </table>
    </div>
    <div class="table-name_signature">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 40%; text-align:left"></th>
                <th style="width: 30%; text-align:center;text-decoration: underline">{{ $data['name'] }}</th>
                <th style="width: 5%; text-align:left"></th>
            </tr>
        </table>
    </div>
    <div class="table-dept_signature">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 40%; text-align:left"></th>
                <th style="width: 30%; text-align:center">Finance</th>
                <th style="width: 5%; text-align:left"></th>
            </tr>
        </table>
    </div>
</body>

</html>
