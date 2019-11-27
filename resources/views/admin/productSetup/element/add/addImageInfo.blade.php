<form class="form-horizontal" action="{{ route($tab3Link) }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
	{{ csrf_field() }}

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6"><h4 class="card-title">Add {{ $tab3 }}</h4></div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-outline-info btn-lg" href="{{ route($goBackLink) }}">
                		<i class="fa fa-arrow-circle-left"></i> Go Back
                	</a>
                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect">{{ $buttonName }}</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <input type="hidden" name="productId" value="{{ $productId }}">

            <div class="row">
                <div class="col-md-12">
                    <label for="product-image">Product Image</label> 
                    <span style="color: red;">( Standard Image Size: 700px * 700px )</span>
                    <div class="form-group {{ $errors->has('productImage') ? ' has-danger' : '' }}">
                        <input type="file" class="form-control" id="productImage" aria-describedby="fileHelp" name="productImage">
                        @if ($errors->has('productImage'))
                            @foreach($errors->get('productImage') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <p class="uploadImage">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect">{{ $buttonName }}</button>
                </div>
            </div>	        	
        </div>
    </div>
</form>