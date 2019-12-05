@extends('admin.layouts.masterReport')

@section('search_card_body')
    <div class="row">
        <div class="col-md-6">
            <label for="product-category">Category</label>
            <div class="form-group">
                <select class="form-control chosen-select" id="productCategory" name="productCategory[]" multiple>
                    @foreach ($categories as $category)
                        @php
                            $select = "";
                            if ($productCategory)
                            {
                                if (in_array($category->id, $productCategory))
                                {
                                    $select = "selected";
                                }
                                else
                                {
                                    $select = "";
                                }
                            }
                        @endphp
                        <option value="{{ $category->id }}" {{ $select }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>  
        </div>

        <div class="col-md-6">
            <label for="product">Product</label>
            <div class="form-group">
                <select class="form-control chosen-select" id="product" name="product[]" multiple>
                    @foreach ($products as $productInfo)
                        @php
                            $select = "";
                            if ($product)
                            {
                                if (in_array($productInfo->id, $product))
                                {
                                    $select = "selected";
                                }
                                else
                                {
                                    $select = "";
                                }
                            }
                        @endphp
                        <option value="{{ $productInfo->id }}" {{ $select }}>{{ $productInfo->name }}</option>
                    @endforeach
                </select>
            </div>  
        </div>
    </div>	
@endsection

@section('print_card_header')
    @if ($productCategory)
        @foreach ($productCategory as $productCategoryInfo)
            <input type="hidden" name="productCategory[]" value="{{ $productCategoryInfo }}">
        @endforeach
    @endif

    @if ($product)
        @foreach ($product as $productInfo)
            <input type="hidden" name="product[]" value="{{ $productInfo }}">
        @endforeach
    @endif
@endsection

@section('print_card_body')
	<table class="table table-bordered table-sm">
		<thead class="thead-light">
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
	{{-- {{ $productLists->render() }} --}}
@endsection

@section('custom-js')

    <!-- This is data table -->
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var updateThis ;

            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            var table = $('#bankTable').DataTable( {
                "order": [[0, "asc"]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@endsection