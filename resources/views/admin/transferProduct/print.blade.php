@extends('admin.layouts.masterPrint')

@section('custome-css')
    <style type="text/css">
        #lifting-return-info{
            font-family: Times, "Times New Roman", serif;
            width: 100%;
            border-collapse: collapse;
            border-style: dotted;
        }

        #lifting-return-info td{
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
    </style>
@endsection

@section('content')
    <table id="report-header">
        <tr>
            <td>Transfer Challan</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table id="lifting-return-info">
        <tbody>
            <tr>
                <td width="90px"><b>Issue No.</b></td>
                <td width="5px">:</td>
                <td>{{ $transfer->transfer_no }}</td>
                <td width="60px"><b>From</b></td>
                <td width="5px">:</td>
                <td>{{ $host->hostName }}</td>
            </tr>

            <tr>
                <td width="90px"><b>Issue Date</b></td>
                <td width="15px">:</td>
                <td>{{ $transfer->date }}</td>
                <td width="60px"><b>To</b></td>
                <td width="15px">:</td>
                <td>{{ $destination->destinationName }}</td>
            </tr>
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <thead class="thead-light">
            <tr>
                <th width="20px">Sl</th>
                <th>Product Name & Code</th>
                <th width="80px">Model</th>
                <th width="70px">Color</th>
                <th width="80px">Serial No</th>
                <th width="30px">Quanty</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
                $totalQty = 0;
            @endphp
            @foreach ($transferProducts as $transferProduct)
                @php
                    $totalQty = $totalQty + $transferProduct->qty;                                       
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $transferProduct->name }} ( {{ $transferProduct->productCode }} )</td>
                    <td>{{ $transferProduct->model_no }}</td>
                    <td>{{ $transferProduct->color }}</td>
                    <td>{{ $transferProduct->serial_no }}</td>
                    <td style="text-align: right;">{{ $transferProduct->qty }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="5">Total Quantity</th>
                <td style="text-align: right;"><b>{{ $totalQty }}</b></td>
            </tr>
        </tfoot>
    </table>
@endsection
