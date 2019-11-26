@extends('admin.layouts.master')

@section('content')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>

    <div class="card-pad"></div>

    {{-- <div class="container"> --}}
	    <!-- Nav tabs -->
	    <ul class="nav nav-tabs" role="tablist">
	    	<li class="nav-item">
	    		<a class="nav-link active" data-toggle="tab" href="#basic_info" style="font-weight: bold;">{{ $tab1 }}</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link" data-toggle="tab" href="#advance_info" style="font-weight: bold;">{{ $tab2 }}</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link" data-toggle="tab" href="#image_info" style="font-weight: bold;">{{ $tab3 }}</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link" data-toggle="tab" href="#seo_info" style="font-weight: bold;">{{ $tab4 }}</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link" data-toggle="tab" href="#others_info" style="font-weight: bold;">{{ $tab5 }}</a>
	    	</li>
	    </ul>

	    <!-- Tab panes -->
	    <div class="tab-content">
	    	<div id="basic_info" class="container tab-pane active">
	    		<div class="card-pad"></div>
			    <form class="form-horizontal" action="{{ route($tab1Link) }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
			    	{{ csrf_field() }}

				    <div class="card">
				        <div class="card-header">
				            <div class="row">
				                <div class="col-md-6"><h4 class="card-title">Add {{ $tab1 }}</h4></div>
				                <div class="col-md-6 text-right">
				                	<a class="btn btn-outline-info btn-lg" href="{{ route($goBackLink) }}">
				                		<i class="fa fa-arrow-circle-left"></i> Go Back
				                	</a>
				                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect">{{ $buttonName }}</button>
				                </div>
				            </div>
				        </div>

				        <div class="card-body">
				        	<div class="row">
				        		<div class="col-md-6"> 
			                        <div class="form-group {{ $errors->has('categories') ? ' has-danger' : '' }}">
			                            <label for="category">Category</label>
			                            <select class="form-control chosen-select" id="categories" name="categories[]" multiple>
			                                @foreach($categories as $category)
			                                    <option value="{{$category->id}}">{{$category->name}}</option>
			                                @endforeach
			                            </select>
			                            @if ($errors->has('categories'))
			                                @foreach($errors->get('categories') as $error)
			                                    <div class="form-control-feedback">{{ $error }}</div>
			                                @endforeach
			                            @endif
			                        </div>
				        		</div>
				        		<div class="col-md-6">                 
			                        <div class="form-group {{ $errors->has('productName') ? ' has-danger' : '' }}">
			                            <label for="product-name">Product Name</label>
			                            <input type="text" class="form-control form-control-danger" name="productName" value="{{ old('productName') }}" required>
			                            @if ($errors->has('productName'))
			                                @foreach($errors->get('productNname') as $error)
			                                    <div class="form-control-feedback">{{ $error }}</div>
			                                @endforeach
			                            @endif
			                        </div>
				        		</div>
				        	</div>

				        	<div class="row">
                                <div class="col-md-6">
                                    <label for="product-deal-code">Product Deal Code</label>
                                    <div class="form-group {{ $errors->has('dealCode') ? ' has-danger' : '' }}">
                                        <input type="text" class="form-control form-control-danger" name="dealCode" value="{{ old('dealCode') }}" required>
                                        @if ($errors->has('dealCode'))
                                            @foreach($errors->get('dealCode') as $error)
                                                <div class="form-control-feedback">{{ $error }}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="row">
                                		<div class="col-md-6">
		                                	<label for="product-discount">Product Discount</label>
		                                    <div class="form-group {{ $errors->has('discount') ? ' has-danger' : '' }}">
		                                        <input type="number" class="form-control form-control-danger" placeholder="Product discount" name="discount" value="{{ old('discount') }}">
		                                        @if ($errors->has('discount'))
		                                            @foreach($errors->get('discount') as $error)
		                                                <div class="form-control-feedback">{{ $error }}</div>
		                                            @endforeach
		                                        @endif
		                                    </div>
                                		</div>
                                		<div class="col-md-6">
                                			@php
                                				$uoms = array('Pcs'=>'Pcs','Kg'=>'Kg','Liter'=>'Liter','Box'=>'Box','gm'=>'gm','cm'=>'cm');
                                			@endphp
		                                	<label for="product-discount">UOM</label>
				                            <select class="form-control" id="categories" name="categories">
				                            	<option value="">Select UOM</option>
				                                @foreach($uoms as $key => $value)
				                                    <option value="{{ $key }}">{{ $value }}</option>
				                                @endforeach
				                            </select>
				                            @if ($errors->has('categories'))
				                                @foreach($errors->get('categories') as $error)
				                                    <div class="form-control-feedback">{{ $error }}</div>
				                                @endforeach
				                            @endif
		                                </div>
                                	</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                	<div class="row">
                                		<div class="col-md-6">
		                                    <label for="reorder-level-quantity">Reoder Level Quantity</label>
		                                    <div class="form-group {{ $errors->has('reorderQty') ? ' has-danger' : '' }}">
		                                        <input type="number" class="form-control form-control-danger" name="reorderQty" value="{{ old('reorderQty') }}">
		                                        @if ($errors->has('reorderQty'))
		                                            @foreach($errors->get('reorderQty') as $error)
		                                                <div class="form-control-feedback">{{ $error }}</div>
		                                            @endforeach
		                                        @endif
		                                    </div>
                                		</div>

                                		<div class="col-md-6">
                                            <label for="price">Price</label>
                                            <div class="form-group {{ $errors->has('price') ? ' has-danger' : '' }}">
                                                <input type="text" class="form-control form-control-danger" name="price" value="{{ old('price') }}" required>
                                                @if ($errors->has('price'))
                                                    @foreach($errors->get('price') as $error)
                                                        <div class="form-control-feedback">{{ $error }}</div>
                                                    @endforeach
                                                @endif
                                            </div>
                                		</div>
                                	</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="mrp-sale">MRP Price (8% Of Price)</label>
                                            <div class="form-group {{ $errors->has('mrpPrice') ? ' has-danger' : '' }}">
                                                <input type="text" class="form-control form-control-danger" name="mrpPrice" value="{{ old('mrpPrice') }}" required>
                                                @if ($errors->has('mrpPrice'))
                                                    @foreach($errors->get('mrpPrice') as $error)
                                                        <div class="form-control-feedback">{{ $error }}</div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="haire-sale">Haire Price (12% of MRP Price)</label>
                                            <div class="form-group {{ $errors->has('hairePrice') ? ' has-danger' : '' }}">
                                                <input type="text" class="form-control form-control-danger" name="hairePrice" value="{{ old('hairePrice') }}">
                                                @if ($errors->has('hairePrice'))
                                                    @foreach($errors->get('hairePrice') as $error)
                                                        <div class="form-control-feedback">{{ $error }}</div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                	<div class="row">
                                		<div class="col-md-6">
		                                    <label for="publication-status">Publication status</label>
		                                    <div class="form-group {{ $errors->has('status') ? ' has-danger' : '' }}" style="height: 40px; line-height: 40px;">
		                                        <div class="form-check-inline">
		                                            <label class="form-check-label">
		                                                <input type="radio" value="1" name="status" id="published" required> Published
		                                            </label>
		                                        </div>

		                                        <div class="form-check-inline">
		                                            <label class="form-check-label">
		                                                <input type="radio" value="0" name="status" id="unpublished" checked=""> Unpublished
		                                            </label>
		                                        </div>
		                                    </div>
                                		</div>

                                		<div class="col-md-6">
		                                    <label for="order-by">Order By</label>
		                                    <div class="form-group {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
		                                        <input type="number" class="form-control form-control-danger" name="orderBy" value="{{ old('orderBy') }}" required>
		                                        @if ($errors->has('orderBy'))
		                                            @foreach($errors->get('orderBy') as $error)
		                                                <div class="form-control-feedback">{{ $error }}</div>
		                                            @endforeach
		                                        @endif
		                                    </div>
                                		</div>
                                	</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="youtube-link">Youtube Link</label>
                                    <div class="form-group {{ $errors->has('youtubeLink') ? ' has-danger' : '' }}">
                                        <input type="text" class="form-control form-control-danger" placeholder="write your youtube link" name="youtubeLink" value="{{  old('youtubeLink') }}">
                                        @if ($errors->has('youtubeLink'))
                                            @foreach($errors->get('youtubeLink') as $error)
                                                <div class="form-control-feedback">{{ $error }}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="short-descriotion">Short description</label>
                                    <div class="form-group {{ $errors->has('description1') ? ' has-danger' : '' }}">
                                        <textarea class="summernote form-control form-control-danger" name="description1" value="{{ old('description') }}">{{ old('description1') }}</textarea>
                                        @if ($errors->has('description1'))
                                            @foreach($errors->get('description1') as $error)
                                                <div class="form-control-feedback">{{ $error }}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="long-description">Long description</label>
                                    <div class="form-group {{ $errors->has('description2') ? ' has-danger' : '' }}">
                                        <textarea class="summernote form-control form-control-danger" name="description2" value="{{ old('description2') }}">{{ old('description2') }}</textarea>
                                        @if ($errors->has('description2'))
                                            @foreach($errors->get('description2') as $error)
                                                <div class="form-control-feedback">{{ $error }}</div>
                                            @endforeach
                                        @endif
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
	    	</div>

	    	<div id="advance_info" class="container tab-pane fade">
	    		<div class="card-pad"></div>
			    <form class="form-horizontal" action="{{ route($tab2Link) }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
			    	{{ csrf_field() }}

				    <div class="card">
				        <div class="card-header">
				            <div class="row">
				                <div class="col-md-6"><h4 class="card-title">Add {{ $tab2 }}</h4></div>
				                <div class="col-md-6 text-right">
				                	<a class="btn btn-outline-info btn-lg" href="{{ route($goBackLink) }}">
				                		<i class="fa fa-arrow-circle-left"></i> Go Back
				                	</a>
				                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect">{{ $buttonName }}</button>
				                </div>
				            </div>
				        </div>

				        <div class="card-body">
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
	    	</div>

	    	<div id="image_info" class="container tab-pane fade">
	    		<div class="card-pad"></div>
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
	    	</div>

	    	<div id="seo_info" class="container tab-pane fade">
	    		<div class="card-pad"></div>
			    <form class="form-horizontal" action="{{ route($tab4Link) }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
			    	{{ csrf_field() }}

				    <div class="card">
				        <div class="card-header">
				            <div class="row">
				                <div class="col-md-6"><h4 class="card-title">Add {{ $tab4 }}</h4></div>
				                <div class="col-md-6 text-right">
				                	<a class="btn btn-outline-info btn-lg" href="{{ route($goBackLink) }}">
				                		<i class="fa fa-arrow-circle-left"></i> Go Back
				                	</a>
				                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect">{{ $buttonName }}</button>
				                </div>
				            </div>
				        </div>

				        <div class="card-body">
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
	    	</div>

	    	<div id="others_info" class="container tab-pane fade">
	    		<div class="card-pad"></div>
			    <form class="form-horizontal" action="{{ route($tab5Link) }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
			    	{{ csrf_field() }}

				    <div class="card">
				        <div class="card-header">
				            <div class="row">
				                <div class="col-md-6"><h4 class="card-title">Add {{ $tab5 }}</h4></div>
				                <div class="col-md-6 text-right">
				                	<a class="btn btn-outline-info btn-lg" href="{{ route($goBackLink) }}">
				                		<i class="fa fa-arrow-circle-left"></i> Go Back
				                	</a>
				                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect">{{ $buttonName }}</button>
				                </div>
				            </div>
				        </div>

				        <div class="card-body">
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
	    	</div>
	    </div>    	
    {{-- </div> --}}
@endsection

@section('custom-js')
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>
@endsection