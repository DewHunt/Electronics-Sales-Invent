@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-header">
        <tr>
            <td>Lifting Payment Summary For The Month Of {{ date('F', mktime(0, 0, 0,$month, 10)) }} Of {{ $year }}</td>
        </tr>
    </table>

    <div id="pad-bottom"></div>

    <table  id="report-table">
        <caption></caption>
        <thead>
            <tr>
                <th width="20px" rowspan="2">Sl</th>
                <th rowspan="2">Venodr Name</th>
                <th rowspan="2" width="70px">Previous Years</th>
                <th colspan="3" style="text-align: center;">For The Years {{ $year }}</th>
                <th colspan="3" style="text-align: center;">For The Month {{ date('F', mktime(0, 0, 0,$month, 10)) }}</th>
                <th rowspan="2" width="70px">Current Balance</th>
            </tr>
            <tr>
                <th width="60px">Lifting</th>
                <th width="80px">Payments</th>
                <th width="70px">Balance</th>
                <th width="60px">Lifting</th>
                <th width="80px">Payments</th>
                <th width="70px">Balance</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 0;
                $balance = 0;
                $currentId = 0;
            @endphp

            @foreach ($liftingPaymentSummaries as $liftingPaymentSummary)
                @php
                    $sl++;
                    $yearlyLifting = 0;
                    $yearlyPayment = 0;
                    $monthlyLifting = 0;
                    $monthlyPayment = 0;                                    
                @endphp
                @if ($liftingPaymentSummary->vendorId != $currentId)
                    @foreach ($liftingPaymentSummaries as $value)
                        @php
                            if ($liftingPaymentSummary->vendorId == $value->vendorId)
                            {
                                $yearlyLifting = $yearlyLifting + $value->yearlyLifting;
                                $yearlyPayment = $yearlyPayment + $value->yearlyPayment;
                                $monthlyLifting = $monthlyLifting + $value->monthlyLifting;
                                $monthlyPayment = $monthlyPayment + $value->monthlyPayment;
                            }
                            $currentId = $liftingPaymentSummary->vendorId;
                        @endphp
                    @endforeach
                    <tr>
                        <td>{{ $sl }}</td>
                        <td>{{ $liftingPaymentSummary->vendorName }}</td>
                        <td style="text-align: right;">{{ $liftingPaymentSummary->previousPayment - $liftingPaymentSummary->previousLifting }}</td>
                        <td style="text-align: right;">{{ $yearlyLifting }}</td>
                        <td style="text-align: right;">{{ $yearlyPayment }}</td>
                        <td style="text-align: right;">{{ $yearlyPayment - $yearlyLifting }}</td>
                        <td style="text-align: right;">{{ $monthlyLifting }}</td>
                        <td style="text-align: right;">{{ $monthlyPayment }}</td>
                        <td style="text-align: right;">{{ $monthlyPayment - $monthlyLifting }}</td>
                        <td style="text-align: right;">{{ $liftingPaymentSummary->previousPayment - $liftingPaymentSummary->previousLifting + $yearlyPayment - $yearlyLifting }}</td>
                    </tr>
                @endif                                    
            @endforeach
        </tbody>
    </table>
@endsection
