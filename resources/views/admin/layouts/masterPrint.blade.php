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
                padding: 5px;
            }

            #report-table td {
                font-size: 11px;
            }

            #report-table th {
                text-align: left;
                background-color: #4CAF50;
                color: white;
                font-size: 13px;
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
        </style>

        @yield('custome-css')
    </head>

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