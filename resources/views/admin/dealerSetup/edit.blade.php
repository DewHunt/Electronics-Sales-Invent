@extends('admin.layouts.masterAddEdit')

@section('card_body')
    <style type="text/css">
        .chosen-single{
            height: 35px !important;
        }
    </style>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="dealerId" value="{{ $dealer->id}}">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="district">District</label>
                            <select class="form-control chosen-select" name="districtId" id="districtId">
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    @php
                                        if ($district->id == $dealer->district_id)
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                        
                                    @endphp
                                    <option value="{{ $district->id }}" {{ $select }}>{{ $district->name }} / {{ $district->bangla_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="upazila">Upazila</label>
                        <div class="form-group" id="upazila-select-menu">
                            <select class="form-control chosen-select" name="upazilaId" id="upazilaId">
                                <option value="">Select Upazila</option>
                                @foreach ($upazilas as $upazila)
                                    @php
                                        if ($upazila->id == $dealer->upazila_id)
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                        
                                    @endphp
                                    <option value="{{ $upazila->id }}" {{ $select }}>{{ $upazila->name }} / {{ $upazila->bangla_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('territoryId') ? ' has-danger' : '' }}">
                            <label for="territory">Territory</label>
                            <select class="form-control" name="territoryId">
                                <option value="">Select Territory</option>
                                @foreach ($territories as $territory)
                                    @php
                                        if ($territory->id == $dealer->territory_id)
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                        
                                    @endphp
                                    <option value="{{ $territory->id }}" {{ $select }}>{{ $territory->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('territoryId'))
                                @foreach($errors->get('territoryId') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div> 
                    <div class="col-md-6">
                        @php
                            $dealerTypes = array('Non-Executive'=>'Non-Executive','Executive'=>'Executive')
                        @endphp
                        <div class="form-group {{ $errors->has('dealerType') ? ' has-danger' : '' }}">
                            <label for="dealer-type">Dealer Type</label>
                            <select class="form-control" name="dealerType">
                                <option value="">Select Dealer Type</option>
                                @foreach ($dealerTypes as $key => $value)
                                    @php
                                        if ($key == $dealer->type)
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                        
                                    @endphp
                                    <option value="{{ $key }}" {{ $select }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('dealerType'))
                                @foreach($errors->get('dealerType') as $error)
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
                <div class="form-group {{ $errors->has('dealerName') ? ' has-danger' : '' }}">
                    <label for="dealer-name">Dealer Name</label>
                    <input type="text" class="form-control" name="dealerName" value="{{ $dealer->name }}" required>
                    @if ($errors->has('dealerName'))
                        @foreach($errors->get('dealerName') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('code') ? ' has-danger' : '' }}">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" value="{{ $dealer->code }}" required>
                            @if ($errors->has('code'))
                                @foreach($errors->get('code') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('creditLimit') ? ' has-danger' : '' }}">
                            <label for="credit-limit">Credit Limit</label>
                            <input type="text" class="form-control" name="creditLimit" value="{{ $dealer->credit_limit }}" required>
                            @if ($errors->has('creditLimit'))
                                @foreach($errors->get('creditLimit') as $error)
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
                            <input type="text" class="form-control" name="contactPerson" value="{{ $dealer->contact_person }}" required>
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
                        <div class="form-group {{ $errors->has('mobile') ? ' has-danger' : '' }}">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" name="mobile" value="{{ $dealer->mobile }}" required>
                            @if ($errors->has('mobile'))
                                @foreach($errors->get('mobile') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $dealer->email }}" required>
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
                    <textarea class="form-control" name="address" rows="5">{{ $dealer->address }}</textarea>
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
    <script type="text/javascript">
        $(document).on('change', '#districtId', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var districtId = $('#districtId').val();

            $.ajax({
                type:'post',
                url:'{{ route('dealerSetup.getAllUpazilaByDistrict') }}',
                data:{districtId:districtId},
                success:function(data){
                    $('#upazila-select-menu').html(data);
                    $(".chosen-select").chosen();
                }
            });
        });

    </script>
@endsection