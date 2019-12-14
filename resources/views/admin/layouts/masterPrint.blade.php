<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <style>
            #report-table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #report-table td, #report-table th {
                border: 1px solid #ddd;
            }

            #report-table td {
                font-size: 11px;
                padding: 5px;
            }

            #report-table th {
                text-align: center;
                background-color: #4CAF50;
                color: white;
                font-size: 13px;
                vertical-align: middle;
                padding: 3px;
            }

            .align-left{
                text-align: left;
            }

            .align-center{
                text-align: center;
            }

            .align-right{
                text-align: right;
            }

            #report-table tfoot th{
                background-color: #778899;
            }

            #report-table tr:nth-child(even){background-color: #f2f2f2;}

            #report-table tr:hover {background-color: #ddd;}

            caption{
                font-weight: bold; text-decoration: underline; padding-bottom: 5px;
            }

            #header-table {
                font-family: Times, "Times New Roman", serif;
                border-collapse: collapse;
                width: 100%;
            }

            #header-table td, #header-table th {
                text-align: center;
                /*background-color: #a4b7b4;*/
                color: black;
                border: 0px solid #ddd;
                padding: 5px;
            }

            #header-table td {
                font-size: 14px;
            }

            #header-table th {
                font-size: 20px;
            }

            #pad-bottom{
                padding-bottom: 10px;
            }

            .overline {
                border-top: 2px solid currentColor;
            }
        </style>

        @yield('custome-css')
    </head>

    @php
    @endphp

    <body align="center">
    	@php
    		use App\CompanySetup;

    		$company = CompanySetup::first();
    	@endphp

    	<table id="header-table">
    		<thead>
    			<tr>
    				<th>{{ $company->name }}</th>
    			</tr>
    			<tr>
    				<td><b>Address:</b> {{ $company->address }}</td>
    			</tr>
    			<tr>
    				<td><b>Phone:</b> {{ $company->phone }}, <b>Website:</b> {{ $company->website }}, <b>Email: </b>{{ $company->email }}</td>
    			</tr>
    		</thead>
    	</table>

    	<hr>

    	@yield('content')
    </body>
</html>