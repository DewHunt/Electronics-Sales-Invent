@extends('admin.layouts.masterAddEdit')

@section('card_body')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>

    <div class="card-body">
    	<input type="hidden" name="areaId" value="{{ $area->id }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('code') ? ' has-danger' : '' }}">
                    <label for="prefix">Prefix</label>
                    <input type="text" class="form-control" name="code" value="{{ $area->code }}" required>
                    @if ($errors->has('code'))
                        @foreach($errors->get('code') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('inchargeName') ? ' has-danger' : '' }}">
                    <label for="incharge-name">Incharge Name</label>
                    <input type="text" class="form-control" name="inchargeName" value="{{ $area->incharge_name }}" required>
                    @if ($errors->has('inchargeName'))
                        @foreach($errors->get('inchargeName') as $error)
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
                        <div class="form-group {{ $errors->has('areaName') ? ' has-danger' : '' }}">
                            <label for="area-name">Area Name</label>
                            <input type="text" class="form-control" name="areaName" value="{{ $area->name }}" required>
                            @if ($errors->has('areaName'))
                                @foreach($errors->get('areaName') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('contact') ? ' has-danger' : '' }}">
                            <label for="contact-number">Contact Number</label>
                            <input type="text" class="form-control" name="contact" value="{{ $area->contact }}" required>
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
                            <input type="email" class="form-control" name="email" value="{{ $area->email }}" required>
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
                    <textarea class="form-control" name="address" rows="9">{{ $area->address }}</textarea>
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