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
                <th style="width: 20%; text-align:left">Debit No</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">{{ $data['inv'] }}</th>
                <th style="width: 20%; text-align:left">Date</th>
                <th style="width: 5%">:</th>
                <th style="width: 20%; text-align:left">{{ $data['tanggal'] }}</th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">POL/POD</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">{{ $data['sales_job']['pol_pod'] }}</th>
                <th style="width: 20%; text-align:left">JOB ORDER</th>
                <th style="width: 5%">:</th>
                <th style="width: 20%; text-align:left">{{ $data['sales_job']['order_id'] }}</th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">VESSEL/ VOY</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">{{ $data['sales_job']['vessel1'] }}</th>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">ETD</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">{{ $data['ETD'] }}</th>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">ETA</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">{{ $data['ETA'] }}</th>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">PARTY</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">{{ $data['sales_job']['party'] }}</th>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">HBL / MBL</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">
                    {{ $data['sales_job']['HBL'] }} {{ $data['sales_job']['MBL'] }}
                </th>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
            </tr>
            <tr>
                <th style="width: 20%; text-align:left">GWT / MEAS</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">{{ $data['sales_job']['GWT_MEAS'] }}</th>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 20%; text-align:left"></th>
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
                <th style="width: 75%; text-align:left">{{ $data['customer']['ADDRESS'] }}</th>
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
            <th style="width: 19%; text-align:center">Value</th>
        </tr>
        <tr>
            <td style="text-decoration: underline;font-weight:bold" class="selling-value">Reimbursment :</td>
            <td class="selling-value"></td>
            <td class="selling-value"></td>
            <td></td>
        </tr>
        @foreach ($data['selling'] as $x)
            <tr>
                <td class="selling-value" style="text-align:left;font-weight:bold">{{ $x->description }}</td>
                <td class="selling-value" style="text-align:center;font-weight:bold">{{ $x->qty }}</td>
                <td class="selling-value" style="padding-left:2px;text-align:left;font-weight:bold">
                    {{ number_format($x->price) }}
                </td>
                <td style="padding-left:2px;text-align:left;font-weight:bold">{{ $x->curr }}
                    {{ number_format($x->sub_total) }}</td>
            </tr>
        @endforeach
        <tr>
            <td class="empty-td empty-value"></td>
            <td class="empty-value"></td>
            <td class="empty-value"></td>
            <td class="last-empty-value"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:left;font-weight:bold">
                @if ($data['curr'] == 'IDR')
                    Terbilang :
                @else
                    IN WORDS :
                @endif
                {{ $data['terbilang_dn'] }}
            </td>
            <td style="text-align:center;font-weight:bold">Total Charges:</td>
            <td class="last-terbilang-value" style="text-align:center;font-weight:bold">{{ $data['curr'] }}
                {{ number_format($data['sum']) }}
            </td>
        </tr>
        {{-- <tr>
                    <td colspan="2" style="text-align:left">Terbilang : {{ $data['terbilang'] }}</td>
                    <td style="text-align:left">Total :</td>
                    <td style="text-align:left">{{ $data['curr'] }} {{ number_format($data['sum']) }}</td>
                </tr> --}}
    </table>
    {{-- <div class="table-terbilang">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 18%;text-align:left">Terbilang :</th>
                <th style="width: 41%;text-align:left">{{ $data['terbilang'] }}</th>
                <th style="width: 22%;text-align:center">Total Charges:</th>
                <th class="last-terbilang-value" style="width: 19%;text-align:center">{{ $data['curr'] }}
                    {{ number_format($data['sum']) }}
                </th>
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
