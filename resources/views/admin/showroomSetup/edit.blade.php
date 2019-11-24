@extends('admin.layouts.master')

@section('content')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>

    <div style="padding-bottom: 10px;"></div>

    <form class="form-horizontal" action="{{ route('showroomSetup.update') }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
    	{{ csrf_field() }}

	    <div class="card">
	        <div class="card-header">
	            <div class="row">
	                <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
	                <div class="col-md-6 text-right">
	                	<a class="btn btn-outline-info btn-lg" href="{{ route($goBackLink) }}">
	                		<i class="fa fa-arrow-circle-left"></i> Go Back
	                	</a>
	                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect">Update</button>
	                </div>
	            </div>
	        </div>

	        <div class="card-body">
	            @php
	                $message = Session::get('msg');
	                if (isset($message))
	                {
	                	echo"<div style='display:inline-block; width: auto;' class='alert alert-success'><strong>" .$message."</strong></div>";
	                }

	                Session::forget('msg')                        
	            @endphp

		    	@if( count($errors) > 0 )
		    		<div style="display:inline-block;width: auto;" class="alert alert-danger">{{ $errors->first() }}</div>
		    	@endif

		    	<input type="hidden" name="showroomId" value="{{ $showroom->id }}">

            	<div class="row">
            		<div class="col-md-6">
                    	<div class="form-group {{ $errors->has('prefix') ? ' has-danger' : '' }}">
                    		<label for="prefix">prefix</label>
                			<input type="text" class="form-control" name="prefix" value="{{ $showroom->prefix }}" required>
                			@if ($errors->has('prefix'))
                    			@foreach($errors->get('prefix') as $error)
                    				<div class="form-control-feedback">{{ $error }}</div>
                    			@endforeach
                			@endif
                    	</div>
            		</div>

            		<div class="col-md-6">
                    	<div class="form-group {{ $errors->has('showroomName') ? ' has-danger' : '' }}">
                    		<label for="showroom-name">Showroom Name</label>
                			<input type="text" class="form-control" name="showroomName" value="{{ $showroom->name }}" required>
                			@if ($errors->has('showroomName'))
                    			@foreach($errors->get('showroomName') as $error)
                    				<div class="form-control-feedback">{{ $error }}</div>
                    			@endforeach
                			@endif
                    	</div>
            		</div>
            	</div>

            	<div class="row">
            		<div class="col-md-6">
                    	<div class="form-group {{ $errors->has('tradeLicense') ? ' has-danger' : '' }}">
                    		<label for="trade-license">Trade License</label>
                			<input type="text" class="form-control" name="tradeLicense" value="{{ $showroom->trade_license }}" required>
                			@if ($errors->has('tradeLicense'))
                    			@foreach($errors->get('tradeLicense') as $error)
                    				<div class="form-control-feedback">{{ $error }}</div>
                    			@endforeach
                			@endif
                    	</div>
            		</div>

            		<div class="col-md-6">            			
	            		<div class="row">
	            			<div class="col-md-6">
		                    	<div class="form-group {{ $errors->has('vat') ? ' has-danger' : '' }}">
		                    		<label for="vat">VAT</label>
		                			<input type="text" class="form-control" name="vat" value="{{ $showroom->vat }}" required>
		                			@if ($errors->has('vat'))
		                    			@foreach($errors->get('vat') as $error)
		                    				<div class="form-control-feedback">{{ $error }}</div>
		                    			@endforeach
		                			@endif
		                    	</div>
	            			</div>

		            		<div class="col-md-6">
		                    	<div class="form-group {{ $errors->has('tin') ? ' has-danger' : '' }}">
		                    		<label for="tin">TIN</label>
		                			<input type="text" class="form-control" name="tin" value="{{ $showroom->tin }}" required>
		                			@if ($errors->has('tin'))
		                    			@foreach($errors->get('tin') as $error)
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
            				<div class="col-md-12">
		                    	<div class="form-group {{ $errors->has('contactPerson') ? ' has-danger' : '' }}">
		                    		<label for="contact-person">Contact Person</label>
		                			<input type="text" class="form-control" name="contactPerson" value="{{ $showroom->contact_person }}" required>
		                			@if ($errors->has('contactPerson'))
		                    			@foreach($errors->get('contactPerson') as $error)
		                    				<div class="form-control-feedback">{{ $error }}</div>
		                    			@endforeach
		                			@endif
		                    	</div>
            				</div>
            			</div>

	            		<div class="row">
	            			<div class="col-md-6">
		                    	<div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
		                    		<label for="email">Email</label>
		                			<input type="text" class="form-control" name="email" value="{{ $showroom->email }}" required>
		                			@if ($errors->has('email'))
		                    			@foreach($errors->get('email') as $error)
		                    				<div class="form-control-feedback">{{ $error }}</div>
		                    			@endforeach
		                			@endif
		                    	</div>
	            			</div>

		            		<div class="col-md-6">
		                    	<div class="form-group {{ $errors->has('webSite') ? ' has-danger' : '' }}">
		                    		<label for="web-site">Web Site</label>
		                			<input type="text" class="form-control" name="webSite" value="{{ $showroom->website }}" required>
		                			@if ($errors->has('webSite'))
		                    			@foreach($errors->get('webSite') as $error)
		                    				<div class="form-control-feedback">{{ $error }}</div>
		                    			@endforeach
		                			@endif
		                    	</div>
		            		</div>
	            		</div>
            			       			
	            		<div class="row">
	            			<div class="col-md-6">
		                    	<div class="form-group {{ $errors->has('phoneNumber') ? ' has-danger' : '' }}">
		                    		<label for="phone-no">Phone No.</label>
		                			<input type="text" class="form-control" name="phoneNumber" value="{{ $showroom->phone }}" required>
		                			@if ($errors->has('phoneNumber'))
		                    			@foreach($errors->get('phoneNumber') as $error)
		                    				<div class="form-control-feedback">{{ $error }}</div>
		                    			@endforeach
		                			@endif
		                    	</div>
	            			</div>

		            		<div class="col-md-6">
		                    	<div class="form-group {{ $errors->has('faxNumber') ? ' has-danger' : '' }}">
		                    		<label for="fax-no">Fax No.</label>
		                			<input type="text" class="form-control" name="faxNumber" value="{{ $showroom->fax }}" required>
		                			@if ($errors->has('faxNumber'))
		                    			@foreach($errors->get('faxNumber') as $error)
		                    				<div class="form-control-feedback">{{ $error }}</div>
		                    			@endforeach
		                			@endif
		                    	</div>
		            		</div>
	            		</div>
            		</div>

            		<div class="col-md-6">
                    	<div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
                    		<label for="address">Address</label>
                    		<textarea class="form-control" name="address"rows="9">{{ $showroom->address }}</textarea>
                			@if ($errors->has('address'))
                    			@foreach($errors->get('address') as $error)
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
	                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect">Update</button>
	                </div>
	            </div>	        	
	        </div>
	    </div>
	</form>
@endsection