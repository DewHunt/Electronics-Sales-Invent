@extends('admin.layouts.masterAddEdit')

@section('card_body')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>

    <div class="card-body">
    	<div class="row">
    		<div class="col-md-6">
            	<div class="form-group {{ $errors->has('prefix') ? ' has-danger' : '' }}">
            		<label for="prefix">prefix</label>
        			<input type="text" class="form-control" name="prefix" value="{{ old('prefix') }}" required>
        			@if ($errors->has('prefix'))
            			@foreach($errors->get('prefix') as $error)
            				<div class="form-control-feedback">{{ $error }}</div>
            			@endforeach
        			@endif
            	</div>
    		</div>

    		<div class="col-md-6">
            	<div class="form-group {{ $errors->has('companyName') ? ' has-danger' : '' }}">
            		<label for="company-name">Company Name</label>
        			<input type="text" class="form-control" name="companyName" value="{{ old('companyName') }}" required>
        			@if ($errors->has('companyName'))
            			@foreach($errors->get('companyName') as $error)
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
        			<input type="text" class="form-control" name="tradeLicense" value="{{ old('tradeLicense') }}" required>
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
                			<input type="text" class="form-control" name="vat" value="{{ old('vat') }}" required>
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
                			<input type="text" class="form-control" name="tin" value="{{ old('tin') }}" required>
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
        			<div class="col-md-6">
                    	<div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                    		<label for="email">Email</label>
                			<input type="text" class="form-control" name="email" value="{{ old('email') }}" required>
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
                			<input type="text" class="form-control" name="webSite" value="{{ old('webSite') }}" required>
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
                			<input type="text" class="form-control" name="phoneNumber" value="{{ old('phoneNumber') }}" required>
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
                			<input type="text" class="form-control" name="faxNumber" value="{{ old('faxNumber') }}" required>
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
            		<textarea class="form-control" name="address"rows="5">{{ old('address') }}</textarea>
        			@if ($errors->has('address'))
            			@foreach($errors->get('address') as $error)
            				<div class="form-control-feedback">{{ $error }}</div>
            			@endforeach
        			@endif
            	</div>
    		</div>
    	</div>
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>
@endsection