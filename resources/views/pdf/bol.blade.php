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
                    style="width: 55%;vertical-align: top;text-align:left;padding-right:5px">
                    <p>{{ $data->Shipper }}</p>
                </th>
                <th style="width: 45%; text-align:center">{{ $data->BL_NO }}</th>
            </tr>
            <tr>
                <th height="30" style="widht:45%; text-align:left;vertical-align: top;">
                    {{ $data->Export_References }}</th>
            </tr>
        </table>
    </div>
    <div class="table-consignee">
        <table style="table-layout: fixed">
            <tr>
                <th height="50" rowspan="2"
                    style="width:55%; vertical-align: top; text-align:left;padding-right:10px">
                    {{ $data->Consignee }}</th>
                <th height="45" style="width:45%; vertical-align: top; text-align:left">
                    {{ $data->Forwarding_Agent }}
                </th>
            </tr>
            <tr>
                <th style="width:45%; text-align:center">{{ $data->Point_Country_Origin }}</th>
            </tr>
        </table>
    </div>
    <div class="table-notify">
        <table style="table-layout: fixed">
            <tr>
                <th height="60"
                    style="width:55%; vertical-align: top; text-align:left;padding-bottom:5px;padding-right:10px">
                    {{ $data->Notify_Party }}
                </th>
                <th rowspan="3" style="width:45%; vertical-align: top; text-align:left">{{ $data->Obtain_Delivery }}
                </th>
            </tr>
            <tr>
                <table>
                    <tr>
                        <th style="width: 50%;text-align:center">{{ $data->Pre_Carriage }}</th>
                        <th style="width: 50%;text-align:center">{{ $data->Place_Receipt }}</th>
                    </tr>
                </table>
            </tr>
            <tr>
                <table>
                    <tr>
                        <th style="width: 50%;text-align:center">{{ $data->Exporting_Carrier }}</th>
                        <th style="width: 50%;text-align:center">{{ $data->Port_Loading }}</th>
                    </tr>
                </table>
            </tr>
        </table>
    </div>
    <div class="table-discharge">
        <table style="table-layout: fixed">
            <tr>
                <th style="width: 25%;text-align:center">{{ $data->Port_Discharge }}</th>
                <th style="width: 25%;text-align:center">{{ $data->Port_Delivery }}</th>
                <th style="width: 25%;text-align:center">{{ $data->Transshipment_to }}</th>
                <th style="width: 25%;text-align:center">{{ $data->Final_destination }}</th>
            </tr>
        </table>
    </div>
    <div class="table-marks">
        <table class="marks" style="table-layout: fixed">
            <tr>
                <th style="width: 25%;text-align:left"></th>
                <th style="width: 10%;text-align:left"></th>
                <th style="width: 40%;text-align:left"></th>
                <th style="width: 15%;text-align:left"></th>
                <th style="width: 10%;text-align:left"></th>
            </tr>
            <tr>
                <td class="marks-td" height="180">{{ $data->Marks_Number }}</td>
                <td height="180" style="text-align: left">{{ $data->No_Cont_Pkgs }}</td>
                <td class="marks-td" height="180">{{ $data->Description_Packages_Goods }}</td>
                <td class="marks-td" height="180">{{ $data->Gross_Weight }}</td>
                <td height="180">{{ $data->Measurement }}</td>
            </tr>
        </table>
    </div>
    <div class="table-freight">
        <table class="Freight">
            <tr>
                <th style="widht: 20%;"></th>
                <th style="width: 10%;"></th>
                <th style="width: 10%;"></th>
                <th style="width: 60%;"></th>
            </tr>
            <tr>
                <td height="75" style="text-align:left">{{ $data->Freight_Charges }}</td>
                <td height="75" style="text-align:left">{{ $data->Prepaid }}</td>
                <td height="75" style="text-align:left">{{ $data->Collect }}</td>
                <td height="75"></td>
            </tr>
            <tr>
                <td style="text-align:center;padding-bottom:10px" colspan="3">{{ $data->Total_Charges }}</td>
                <td style="text-align: right">{{ $data->BY }}</td>
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
