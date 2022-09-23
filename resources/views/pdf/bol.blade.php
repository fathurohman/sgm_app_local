<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" href="{{ public_path('argon') }}/css/bol.css" rel="stylesheet">
</head>

<body>
    <div class="table-page">
        <table style="table-layout:fixed;">
            <tr>
                <th height="30" rowspan="2"
                    style="width: 57%;vertical-align: top;text-align:left;padding-right:5px;">
                    <p>{{ $data->Shipper }}</p>
                </th>
                <th style="width: 43%; text-align:center">{{ $data->BL_NO }}</th>
            </tr>
            <tr>
                <th height="30" style="widht:43%; text-align:left;vertical-align: top;">
                    {{ $data->Export_References }}</th>
            </tr>
        </table>
    </div>
    <div class="table-consignee">
        <table style="table-layout: fixed">
            <tr>
                <th height="50" rowspan="2"
                    style="width:57%; vertical-align: top; text-align:left;padding-right:10px">
                    <p>{{ $data->Consignee }}</p>
                </th>
                <th height="45" style="width:43%; vertical-align: top; text-align:left">
                    <p>{{ $data->Forwarding_Agent }}</p>
                </th>
            </tr>
            <tr>
                <th style="width:43%; text-align:center">{{ $data->Point_Country_Origin }}</th>
            </tr>
        </table>
    </div>
    <div class="table-notify">
        <table style="table-layout: fixed">
            <tr>
                <th height="60"
                    style="width:57%; vertical-align: top; text-align:left;padding-bottom:5px;padding-right:10px">
                    {{ $data->Notify_Party }}
                </th>
                <th rowspan="3" style="width:43%; vertical-align: top; text-align:left">
                    <p>{{ $data->Obtain_Delivery }}</p>
                </th>
            </tr>
            <tr>
                <table>
                    <tr>
                        <th style="width: 50%;text-align:left">{{ $data->Pre_Carriage }}</th>
                        <th style="width: 50%;text-align:left">{{ $data->Place_Receipt }}</th>
                    </tr>
                </table>
            </tr>
            <tr>
                <table>
                    <tr>
                        <th style="width: 50%;text-align:left">{{ $data->Exporting_Carrier }}</th>
                        <th style="width: 50%;text-align:left">{{ $data->Port_Loading }}</th>
                    </tr>
                </table>
            </tr>
        </table>
    </div>
    <div class="table-discharge">
        <table style="table-layout: fixed">
            <tr>
                <th style="width: 27,5%;text-align:left">{{ $data->Port_Discharge }}</th>
                <th style="width: 27,5%;text-align:left">{{ $data->Port_Delivery }}</th>
                <th style="width: 20%;text-align:left">{{ $data->Transshipment_to }}</th>
                <th style="width: 25%;text-align:left">{{ $data->Final_destination }}</th>
            </tr>
        </table>
    </div>
    <div class="table-marks">
        <table class="marks" style="table-layout: fixed">
            <tr>
                <th style="width: 20%;text-align:left"></th>
                <th style="width: 15%;text-align:left"></th>
                <th style="width: 40%;text-align:left"></th>
                <th style="width: 15%;text-align:left"></th>
                <th style="width: 10%;text-align:left"></th>
            </tr>
            <tr>
                <td class="marks-td" height="180">
                    <p>{{ $data->Marks_Number }}</p>
                </td>
                <td height="180" style="text-align: center">
                    <p>{{ $data->No_Cont_Pkgs }}</p>
                </td>
                <td class="marks-td" height="180">
                    <p>{{ $data->Description_Packages_Goods }}</p>
                </td>
                <td class="gross-td" height="180">
                    <p>{{ $data->Gross_Weight }}</p>
                </td>
                <td height="180">
                    <p>{{ $data->Measurement }}</p>
                </td>
            </tr>
        </table>
    </div>
    <div @if ($lines <= '20') class="table-freight-50"
    @else
    class="table-freight-30" @endif ">
        <table class="Freight">
            <tr>
                <th style="widht: 20%;"></th>
                <th style="width: 10%;"></th>
                <th style="width: 10%;"></th>
                <th style="width: 60%;"></th>
            </tr>
            <tr>
                <td height="80" style="text-align:left">{{ $data->Freight_Charges }}</td>
                <td height="80" style="text-align:left">{{ $data->Prepaid }}</td>
                <td height="80" style="text-align:left">{{ $data->Collect }}</td>
                <td height="80"></td>
            </tr>
            <tr>
                <td style="text-align:center;padding-bottom:10px" colspan="3">{{ $data->Total_Charges }}</td>
                <td style="text-align: right;padding-right:50px">{{ $data->BY }}</td>
            </tr>
            <tr>
                <td style="text-align:center" colspan="3">{{ $data->Freight_Payable }}</td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="table-original">
        <table>
            <th style="width: 37,5%; text-align:center">{{ $data->No_Original }}</th>
            <th style="width: 37,5%; text-align:center">{{ $data->Place_Date_Issue }}</th>
            <th style="width: 25%; text-align:center">{{ $data->ON_Board_Date }}</th>
        </table>
    </div>
</body>

</html>
