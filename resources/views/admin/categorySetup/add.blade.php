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
            	<div class="form-group {{ $errors->has('showroomName') ? ' has-danger' : '' }}">
            		<label for="showroom-name">Showroom Name</label>
        			<input type="text" class="form-control" name="showroomName" value="{{ old('showroomName') }}" required>
        			@if ($errors->has('showroomName'))
            			@foreach($errors->get('showroomName') as $error)
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