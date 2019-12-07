@extends('admin.layouts.masterPrint')

@section('custome-css')
	<style type="text/css">
		#lifting-info{
			font-family: Times, "Times New Roman", serif;
			width: 100%;
			border-collapse: collapse;
			border-style: dotted;
		}

		#lifting-info td{
			padding: 5px;
			border-bottom: 1px solid #ddd;
		}
	</style>
@endsection

@section('content')
    <table id="lifting-info">
        <caption style="font-weight: bold; text-decoration: underline; padding-bottom: 5px;">Product Lifting Chalan</caption>
        <tbody>
        	<tr>
        		<td width="110px">Vouchar No.</td>
        		<td width="15px">:</td>
        		<td>{{ $lifting->vaouchar_no }}</td>
        	</tr>

        	<tr>
        		<td width="110px">Vouchar Date</td>
        		<td width="15px">:</td>
        		<td>{{ $lifting->vouchar_date }}</td>
        	</tr>

        	<tr>
        		<td width="110px">Supplier</td>
        		<td width="15px">:</td>
        		<td>{{ $lifting->vendorName }}</td>
        	</tr>

        	<tr>
        		<td width="110px">Purchase By</td>
        		<td width="15px">:</td>
        		<td>{{ $lifting->purchase_by }}</td>
        	</tr>
        </tbody>
    </table>

    <div style="padding-bottom: 10px;"></div>

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
                $sl = 0;
            @endphp
            @foreach ($liftingProducts as $liftingProduct)
                @php
                    $sl++;                                       
                @endphp
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $liftingProduct->productName }} ( {{ $liftingProduct->productCode }} )</td>
                    <td>{{ $liftingProduct->model_no }}</td>
                    <td>{{ $liftingProduct->color }}</td>
                    <td>{{ $liftingProduct->serial_no }}</td>
                    <td>{{ $liftingProduct->qty }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
