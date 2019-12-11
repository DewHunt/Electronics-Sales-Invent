<div class="card-body newProductBlock">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center" style="font-weight: bold;font-family: tahoma">Second Guarantor Information</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('gurantorName') ? ' has-danger' : '' }}">
                <label for="guarantor-name">Guarantor Name</label>
                <input type="text" class="form-control" id="gurantorName2" name="gurantorName[]">
                @if ($errors->has('gurantorName'))
                    @foreach($errors->get('gurantorName') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>

         <div class="col-md-6">
            <div class="form-group {{ $errors->has('gurantorPhoneNo') ? ' has-danger' : '' }}">
                <label for="guarantor-phone-no">Guarantor Phone No</label>
                <input type="text" class="form-control" id="gurantorPhoneNo2" name="gurantorPhoneNo[]">
                @if ($errors->has('gurantorPhoneNo'))
                    @foreach($errors->get('gurantorPhoneNo') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group {{ $errors->has('guarantorFatherName') ? ' has-danger' : '' }}">
                        <label for="guarantor-spouse-name">Father Name</label>
                        <input type="text" class="form-control firstGuarantorFather" id="guarantorFatherName2" name="guarantorFatherName[]">
                        @if ($errors->has('guarantorFatherName'))
                            @foreach($errors->get('guarantorFatherName') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('gurantorAge') ? ' has-danger' : '' }}">
                        <label for="guarantor-age">Guarantor Age</label>
                        <input type="number" class="form-control" id="gurantorAge2" name="gurantorAge[]">
                        @if ($errors->has('gurantorAge'))
                            @foreach($errors->get('gurantorAge') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has('guarantorMaritalStatus') ? ' has-danger' : '' }}">
                        <label for="guarantor-mrital-status">Marital Status</label>
                        <select name="guarantorMaritalStatus[]" class="form-control secondGuarantorMaritalStatus" id="guarantorMaritalStatus2" style="height: 41%">
                            <option value="">Select Marital Status</option>
                            @foreach ($maritalStatus as $key => $value)
                                <option value="{{$value}}" {{@$selected}}>{{$value}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('guarantorMaritalStatus'))
                            @foreach($errors->get('guarantorMaritalStatus') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group {{ $errors->has('guarantorSpouseName') ? ' has-danger' : '' }}">
                        <label for="guarantor-spouse-name">Spouse Name</label>
                        <input type="text" class="form-control secondGuarantorSpouce" id="guarantorSpouseName2" name="guarantorSpouseName[]">
                        @if ($errors->has('guarantorSpouseName'))
                            @foreach($errors->get('guarantorSpouseName') as $error)
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
            <div class="form-group {{ $errors->has('guarantorPresentAddress') ? ' has-danger' : '' }}">
                <label for="guarantor-present-address">Present Address</label>
                <textarea name="guarantorPresentAddress[]" class="form-control" id="guarantorPresentAddress2" style="min-height: 123px;"></textarea>
                @if ($errors->has('guarantorPresentAddress'))
                    @foreach($errors->get('guarantorPresentAddress') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('guarantorPermanentAddress') ? ' has-danger' : '' }}">
                <label for="guarantor-permanent-address">Permanent Address</label>
                <textarea name="guarantorPermanentAddress[]" class="form-control" id="guarantorPermanentAddress2" style="min-height: 123px;"></textarea>
                @if ($errors->has('guarantorPermanentAddress'))
                    @foreach($errors->get('guarantorPermanentAddress') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="blockTitle">Second Guarantor Professional Information</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('guarantorProfessionName') ? ' has-danger' : '' }}">
                <label for="guarantor-profession-name">Profession's Name</label>
                <input type="text" class="form-control" id="guarantorProfessionName2" name="guarantorProfessionName[]">
                @if ($errors->has('guarantorProfessionName'))
                    @foreach($errors->get('guarantorProfessionName') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('guarantorDesignation') ? ' has-danger' : '' }}">
                <label for="guarantor-designation">Designation</label>
                <input type="text" class="form-control" id="guarantorDesignation2" name="guarantorDesignation[]">
                @if ($errors->has('guarantorDesignation'))
                    @foreach($errors->get('guarantorDesignation') as $error)
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
                    <div class="form-group {{ $errors->has('guarantorWorkplacePhoneNo') ? ' has-danger' : '' }}">
                        <label for="guarantor-workplace-phoneNo">Phone No</label>
                        <input type="number" class="form-control" id="guarantorWorkplacePhoneNo2" name="guarantorWorkplacePhoneNo[]">
                        @if ($errors->has('guarantorWorkplacePhoneNo'))
                            @foreach($errors->get('guarantorWorkplacePhoneNo') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group {{ $errors->has('guarantorMonthlyIncome') ? ' has-danger' : '' }}">
                        <label for="guarantor-monthly-income">Monthly Income</label>
                        <input type="number" class="form-control" id="guarantorMonthlyIncome2" name="guarantorMonthlyIncome[]">
                        @if ($errors->has('guarantorMonthlyIncome'))
                            @foreach($errors->get('guarantorMonthlyIncome') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="monthly-income">Work Place address</label>
            <textarea name="guarantorWorkPlaceAddress" class="form-control" id="guarantorWorkPlaceAddress2" style="min-height: 122px;"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-outline-info btn-lg waves-effect"><i class="fa fa-save"></i> {{ $buttonName }}</button>
        </div>
    </div>
</div>
