@extends('admin.layouts.masterPrint')

@section('content')
    <table id="report-table">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>MRP Price</th>
                <th>Haire Price</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($productLists as $productList)
                <tr>
                    <td>{{ $productList->categoryName }}</td>
                    <td>{{ $productList->productName }}</td>
                    <td>{{ $productList->price }}</td>
                    <td>{{ $productList->mrpPrice }}</td>
                    <td>{{ $productList->hairePrice }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
