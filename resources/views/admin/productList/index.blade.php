@extends('admin.layouts.masterReport')

@section('search_card_body')
    <div class="card-body">
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
    </div>	
@endsection

@section('print_card_header')
@endsection

@section('print_card_body')
	<div class="card-body">
		<table class="table table-bordered table-sm">
			<thead class="thead-dark">
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
		{{ $productLists->render() }}
	</div>
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

            //ajax delete code
            $('#bankTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                bankId = $(this).parent().data('id');
                var tableRow = this;
                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this information!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                },
                function(isConfirm){   
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url : "{{ route('bankSetup.delete') }}",
                            data : {bankId:bankId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Bank Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(tableRow).parents('tr'))
                                    .remove()
                                    .draw();
                            },
                            error: function(response) {
                                error = "Failed.";
                                swal({
                                    title: "<small class='text-danger'>Error!</small>", 
                                    type: "error",
                                    text: error,
                                    timer: 1000,
                                    html: true,
                                });
                            }
                        });    
                    }
                    else
                    { 
                        swal({
                            title: "Cancelled", 
                            type: "error",
                            text: "Your User is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            });
        });
                
        //ajax status change code
        function statusChange(bankId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('bankSetup.status') }}",
                data: {bankId:bankId},
                success: function(response) {
                    swal({
                        title: "<small class='text-success'>Success!</small>", 
                        type: "success",
                        text: "Status Successfully Updated!",
                        timer: 1000,
                        html: true,
                    });
                },
                error: function(response) {
                    error = "Failed.";
                    swal({
                        title: "<small class='text-danger'>Error!</small>", 
                        type: "error",
                        text: error,
                        timer: 2000,
                        html: true,
                    });
                }
            });
        }
    </script>
@endsection