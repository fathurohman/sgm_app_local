<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        @page {
            margin-top: 100px;
            margin-left: 80px;
            margin-right: 80px;
            font-size: 11pt;
            font-family: 'Courier New', Courier, monospace;
        }

        .table-request table {
            width: 100%;
            /* text-decoration: underline; */
            border-collapse: collapse;
            /* border: 1px solid #000; */
            /* margin-left: auto; */
            /* margin-right: auto; */
            /* text-align: center; */
            /* margin-top: 80px; */
        }

        .table-customer table {
            width: 100%;
            /* text-decoration: underline; */
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table-selling table,
        .table-selling th {
            border: 1px solid;
            width: 100%;
            height: 20px;
            /* text-decoration: underline; */
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table-terbilang table {
            width: 100%;
            /* text-decoration: underline; */
            /* border-collapse: collapse; */
        }

        .table-signature table {
            width: 100%;
            margin-top: 40px;
            /* text-decoration: underline; */
            border-collapse: collapse;
        }

        .table-name_signature table {
            width: 100%;
            margin-top: 80px;
            /* text-decoration: underline; */
            border-collapse: collapse;
        }

        .table-dept_signature table {
            width: 100%;
            /* text-decoration: underline; */
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div class="table-request">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left">Debit No</th>
                <th style="width: 5%">:</th>
                <th style="width: 30%; text-align:left">{{ $data['sales_order']['nomor_invoice'] }}</th>
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
    <div class="table-selling">
        <table style="table-layout:fixed;">
            <thead>
                <tr>
                    <th style="width: 48%; text-align:center">Description</th>
                    <th style="width: 11%">Volume</th>
                    <th style="width: 21%; text-align:center">Price / Unit</th>
                    <th style="width: 19%; text-align:center">Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['selling'] as $x)
                    <tr>
                        <td style="text-align:left">{{ $x->description }}</td>
                        <td style="text-align:center">{{ $x->qty }}</td>
                        <td style="text-align:center">{{ number_format($x->price) }}</td>
                        <td style="text-align:center">{{ $x->curr }} {{ number_format($x->sub_total) }}</td>
                        <td></td>
                    </tr>
                @endforeach
                {{-- <tr>
                    <td colspan="2" style="text-align:left">Terbilang : {{ $data['terbilang'] }}</td>
                    <td style="text-align:left">Total :</td>
                    <td style="text-align:left">{{ $data['curr'] }} {{ number_format($data['sum']) }}</td>
                </tr> --}}
            </tbody>
        </table>
    </div>
    <div class="table-terbilang">
        <table style="table-layout:fixed;">
            <tr>
                <th rowspan="3" style="width: 18%;text-align:left">Terbilang :</th>
                <th rowspan="3" style="width: 43%;text-align:left">{{ $data['terbilang'] }}</th>
                <th style="width: 21%;text-align:left">Total :</th>
                <th style="width: 18%;text-align:left">{{ $data['curr'] }} {{ number_format($data['sum']) }}</th>
            </tr>
            <tr>
                <th style="width: 21%;text-align:left">VAT {{ $data['nilai_pajak'] }} % :</th>
                <th style="width: 18%;text-align:left">{{ $data['curr'] }}
                    {{ number_format($data['total_pajak']) }}</th>
            </tr>
            <tr>
                <th style="width: 22%;text-align:left">Total Charges :</th>
                <th style="width: 17%;text-align:left">{{ $data['curr'] }}
                    {{ number_format($data['total_charge']) }}</th>
            </tr>
            {{-- <tr>
                <th style="width: 15%; text-align:left">Terbilang</th>
                <th style="width: 5%">:</th>
                <th style="width: 40%; text-align:left">{{ $data['terbilang'] }}</th>
                <th style="width: 15%; text-align:left">Total</th>
                <th style="width: 5%">:</th>
                <th style="width: 20%; text-align:left">{{ $data['curr'] }} {{ number_format($data['sum']) }}</th>
            </tr>
            <tr>
                <th style="width: 15%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 40%; text-align:left"></th>
                <th style="width: 15%; text-align:left">VAT {{ $data['nilai_pajak'] }} %</th>
                <th style="width: 5%">:</th>
                <th style="width: 20%; text-align:left">
                    {{ $data['curr'] }}
                    {{ number_format($data['total_pajak']) }}</th>
            </tr>
            <tr>
                <th style="width: 15%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 40%; text-align:left"></th>
                <th style="width: 15%; text-align:left">Total Charges</th>
                <th style="width: 5%">:</th>
                <th style="width: 20%; text-align:left">
                    {{ $data['curr'] }}
                    {{ number_format($data['total_charge']) }}</th>
            </tr> --}}
        </table>
    </div>
    <div class="table-signature">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 30%; text-align:left"></th>
                <th style="width: 35%; text-align:left">PT SIGMA GLOBAL MAKMUR</th>
                <th style="width: 10%; text-align:left"></th>
            </tr>
        </table>
    </div>
    <div class="table-name_signature">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 30%; text-align:left"></th>
                <th style="width: 35%; text-align:center">Rika Apriyanti</th>
                <th style="width: 10%; text-align:left"></th>
            </tr>
        </table>
    </div>
    <div class="table-dept_signature">
        <table style="table-layout:fixed;">
            <tr>
                <th style="width: 20%; text-align:left"></th>
                <th style="width: 5%"></th>
                <th style="width: 30%; text-align:left"></th>
                <th style="width: 35%; text-align:center">Finance</th>
                <th style="width: 10%; text-align:left"></th>
            </tr>
        </table>
    </div>
</body>

</html>
