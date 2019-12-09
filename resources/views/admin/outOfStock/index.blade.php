@extends('admin.layouts.masterReport')

@section('search_card_body')
    <input type="hidden" name="print" value="print">
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
    
    <input type="hidden" id="print_value" name="print" value="{{ $print }}">
@endsection

@section('print_card_body')
	<table id="dataTable" name="productList" class="table table-bordered table-sm">
		<thead>
			<tr>
                <th width="20px">Sl</th>
				<th width="200px">Category</th>
				<th>Product</th>
				<th width="100px">Model</th>
				<th width="100px">Color</th>
				<th width="110px">Available Qty</th>
			</tr>
		</thead>

		<tbody>
            @php
                $sl = 0;
            @endphp

            @foreach ($stockOutReports as $stockOutReport)
                @php
                    $sl++;
                @endphp
                @if ($stockOutReport->remainingQty <= $stockOutReport->reorderQty)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $stockOutReport->categoryName }}</td>
                        <td>{{ $stockOutReport->productName }}</td>
                        <td>{{ $stockOutReport->modelNo }}</td>
                        <td>{{ $stockOutReport->color }}</td>
                        <td style="text-align: right;">{{ $stockOutReport->remainingQty }}</td>
                    </tr>
                @endif                                  
            @endforeach
		</tbody>
	</table>
@endsection
