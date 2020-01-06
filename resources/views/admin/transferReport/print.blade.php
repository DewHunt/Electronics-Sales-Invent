@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Transfer History On {{ $fromDate }} To {{ $toDate }}</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <thead class="thead-light">
            <tr>
                <th width="20px">Sl</th>
                <th>Host</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Product Name</th>
                <th>Model</th>
                <th>Qty</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 1;
                $currentHostId = 0;
                $currentDestinationId = 0;
                $hostRowSpan = 0;
                $destinationRowSpan = 0;
                $totalQty = 0;
            @endphp
            @foreach ($transferReports as $transferReport)
                @php
                    if ($currentHostId == $transferReport->hostId)
                    {
                        $hostRow++;
                    }
                    else
                    {
                        $currentHostId = $transferReport->hostId;
                        $hostRowSpan = DB::table('view_transport_record')
                            ->where('hostType',$transferReport->hostType)
                            ->where('hostId',$transferReport->hostId)
                            ->count('hostId');
                        $hostRow = 1;
                    }

                    if ($currentHostId == $transferReport->hostId AND $currentDestinationId == $transferReport->destinationId)
                    {
                        $destinationRow++;
                    }
                    else
                    {
                        $currentDestinationId = $transferReport->destinationId;
                        $destinationRowSpan = DB::table('view_transport_record')
                            ->where('hostType',$transferReport->hostType)
                            ->where('hostId',$transferReport->hostId)
                            ->where('destinationType',$transferReport->destinationType)
                            ->where('destinationId',$transferReport->destinationId)
                            ->count('destinationId');
                        $destinationRow = 1;
                    }
                    
                    $hostName = DB::table('view_store_and_showroom')
                        ->where('type',$transferReport->hostType)
                        ->where('id',$transferReport->hostId)
                        ->first();

                    $destinationName = DB::table('view_store_and_showroom')
                        ->where('type',$transferReport->destinationType)
                        ->where('id',$transferReport->destinationId)
                        ->first();
                    $totalQty = $totalQty + $transferReport->productQty;
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    @if ($hostRow == 1)
                        <td rowspan="{{ $hostRowSpan }}">{{ @$hostName->name }}</td>
                        <td rowspan="{{ $destinationRowSpan }}">{{ @$destinationName ->name}}</td>
                        <td>{{ $transferReport->date }}</td>
                        <td>{{ $transferReport->productName }}</td>
                        <td>{{ $transferReport->productModelNo }}</td>
                        <td>{{ $transferReport->productQty }}</td>
                    @else
                        @if ($destinationRow != 1)
                            <td>{{ $transferReport->date }}</td>
                            <td>{{ $transferReport->productName }}</td>
                            <td>{{ $transferReport->productModelNo }}</td>
                            <td>{{ $transferReport->productQty }}</td>
                        @else
                            <td rowspan="{{ $destinationRowSpan }}">{{ @$destinationName ->name}}</td>
                            <td>{{ $transferReport->date }}</td>
                            <td>{{ $transferReport->productName }}</td>
                            <td>{{ $transferReport->productModelNo }}</td>
                            <td>{{ $transferReport->productQty }}</td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <tfoot>
            <tr>
                <th style="text-align: right;"><b>Total Qty : </b></th>
                <td style="text-align: right;">{{ $totalQty }}</td>
            </tr>
        </tfoot>
    </table>
@endsection
