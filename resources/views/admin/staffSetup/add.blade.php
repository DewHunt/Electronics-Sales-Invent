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
                <div class="form-group {{ $errors->has('code') ? ' has-danger' : '' }}">
                    <label for="code-prefix">Code / Prefix</label>
                    <input type="text" class="form-control" name="code" value="{{ old('code') }}" required>
                    @if ($errors->has('code'))
                        @foreach($errors->get('code') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
    		</div>

    		<div class="col-md-6">
                <div class="form-group {{ $errors->has('staffName') ? ' has-danger' : '' }}">
                    <label for="staff-name">Staff Name</label>
                    <input type="text" class="form-control" name="staffName" value="{{ old('staffName') }}">
                    @if ($errors->has('staffName'))
                        @foreach($errors->get('staffName') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
    		</div>
    	</div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('nationalId') ? ' has-danger' : '' }}">
                    <label for="national-id">National Id</label>
                    <input type="text" class="form-control" name="nationalId" value="{{ old('nationalId') }}" required>
                    @if ($errors->has('nationalId'))
                        @foreach($errors->get('nationalId') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {{ $errors->has('joiningDate') ? ' has-danger' : '' }}">
                    <label for="joining-date">Joining Date</label>
                    <input  type="text" class="form-control datepicker" id="joiningDate" name="joiningDate" placeholder="Select Joining Date" value="{{ old('joiningDate') }}">
                    @if ($errors->has('joiningDate'))
                        @foreach($errors->get('joiningDate') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('contact') ? ' has-danger' : '' }}">
                            <label for="contact-number">Contact Number</label>
                            <input type="text" class="form-control" name="contact" value="{{ old('contact') }}" required>
                            @if ($errors->has('contact'))
                                @foreach($errors->get('contact') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                @foreach($errors->get('email') as $error)
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