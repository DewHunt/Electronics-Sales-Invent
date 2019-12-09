@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-table">
    	<caption>Staff Report</caption>
            <thead>
                <tr>
                    <th width="20px">SL</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Joining Date</th>
                    <th>National Id</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody id="">
                @php
                    $sl = 0;
                @endphp
                @foreach ($staffs as $staff)
                    <tr class="row_{{ $staff->id }}">
                        <td>{{ $sl++ }}</td>
                        <td>{{ $staff->code }}</td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->joining_date }}</td>
                        <td>{{ $staff->national_id }}</td>
                        <td>{{ $staff->contact }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ $staff->address }}</td>
                    </tr>
                @endforeach
            </tbody>
    </table>
@endsection
