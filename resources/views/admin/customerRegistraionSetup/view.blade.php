@extends('admin.layouts.master')

@section('content')
    @php
        $maritalStatus = array('Unmarried' => 'Unmarried', 'Married' => 'Married');
    @endphp
    <style type="text/css">
        .blockTitle{
            color: #333;
            font-family: tahoma;
            border-bottom: 1px solid #a2a2a2;
            display: inline-block;
            padding-bottom: 6px;
        }
    </style>

    <div style="padding-bottom: 10px;"></div>

    @php
        $message = Session::get('msg');
    @endphp

    @if (isset($message))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> {{ $message }}
        </div>
    @endif

    @php
        Session::forget('msg');
    @endphp

    <form class="form-horizontal" action="{{ route($formLink) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
                    <div class="col-md-6 text-right">
                        <a target="_blank" href="{{ route('customerRegistraionSetup.print',$customer->id) }}" class="btn btn-outline-success btn-lg"><i class="fa fa-print"></i> PRINT</a>  
                        <a class="btn btn-outline-info btn-lg" href="{{ route('customerRegistraionSetup.index') }}">
                            <i class="fa fa-arrow-circle-left"></i> Go Back
                        </a>
                    </div>
                </div>
            </div>

            <input type="hidden" name="customerId" value="{{ $customer->id }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @include('admin/customerRegistraionSetup/element/view_customer_detais/personal_information')
                    </div>

                    <div class="col-md-6">
                         @include('admin/customerRegistraionSetup/element/view_customer_detais/professional_information')
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        @include('admin/customerRegistraionSetup/element/view_customer_detais/product_details')
                    </div>
                </div>

                @include('admin/customerRegistraionSetup/element/view_customer_detais/first_guarantor_information')
                @include('admin/customerRegistraionSetup/element/view_customer_detais/second_guarantor_information')

            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {
        /*code for new product block show*/
            $(".newProductBlock").hide();
            $(".removeBlockButton").hide();
            $('.newProductLinkButton').click(function(event) {
                $(".newProductBlock").show();
                $(".removeBlockButton").show();
                $(".newProductLinkButton").hide();
                $(".hiddenProduct").val('1');
            })

             $('.removeBlockButton').click(function(event) {
                $(".newProductBlock").hide();
                $(".removeBlockButton").hide();
                $(".newProductLinkButton").show();
                $(".hiddenProduct").val('');
            })
        /*end code for new product block show*/

        /*code for purchase type cash or installment*/
        $('.installmentRow').hide();
        $('.purchaseType').click(function(event) {
                var purchaseType =  $("input[name='purchaseType']:checked").val();   
                if(purchaseType == "Installment"){
                     $('.installmentRow').show();
                     $("input[name='deposite']").prop('required',true);
                     $("input[name='installmentPrice']").prop('required',true);
                     $("input[name='totalInstallment']").prop('required',true);
                     $("input[name='monthlyInstallmentAmount']").prop('required',true);
                }else{
                    $('.installmentRow').hide();
                    $("input[name='deposite']").prop('required',false);
                    $("input[name='installmentPrice']").prop('required',false);
                    $("input[name='totalInstallment']").prop('required',false);
                    $("input[name='monthlyInstallmentAmount']").prop('required',false);
                }
            })
        /*end code for purchase type cash or installment*/
            
        });
    </script>

    <script type="text/javascript">
    /*code for product info*/
        $(document).on('change', '.product', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var productId = $('.product option:selected').val();
            if(productId != ''){
                $.ajax({
                    type:'post',
                    url:'{{ route('customerRegistration.getProductInfo') }}',
                    data:{productId:productId},
                    success:function(data){
                        var product = data.product;
                        var purchaseType =  $("input[name='purchaseType']:checked").val();
                        $('.productModel').val(product.model_no);
                        $('.cashPrice').val(product.price);
                        $('.mrpPrice').val(product.mrp_price);
                        $('.warranty').val(product.warranty);
                        if (purchaseType == 'Installment')
                        {
                            $('.installmentPrice').val(product.haire_price);
                        }
                        else
                        {
                            $('.installmentPrice').val('');                             
                        }
                        monthlyInstallment();
                    }
                });
            }else{
               $('.productModel').val('');
               $('.cashPrice').val('');
               $('.mrpPrice').val(''); 
               $('.warranty').val(''); 
               $('.installmentPrice').val(''); 
            }
        });

        function monthlyInstallment()
        {
            var deposite = parseFloat($('.deposite').val());
            var installmentPrice = parseFloat($('.installmentPrice').val());
            var totalInstallment = parseFloat($('.totalInstallment').val());

            if (totalInstallment == 0 || $('.totalInstallment').val() == "")
            {
                var monthlyInstallmentPrice = (installmentPrice - deposite);
            }
            else
            {
                var monthlyInstallmentPrice = (installmentPrice - deposite)/totalInstallment;                
            }

            $('.monthlyInstallmentAmount').val(Math.round(monthlyInstallmentPrice));
        }

    /*end code for product info*/

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            /*code for guarantor info*/
            
            if($('.firstGuarantorMaritalStatus').val() == "Married"){
                 $(".firstGuarantorSpouce").prop('disabled', false);
            }else{
                $(".firstGuarantorSpouce").prop('disabled', true);
            }

            $('.firstGuarantorMaritalStatus').click(function(event) {
                var firstGuarantorMaritalStatus = $('.firstGuarantorMaritalStatus').val();
                if(firstGuarantorMaritalStatus == "Married"){
                     $(".firstGuarantorSpouce").prop('disabled', false);
                }else{
                     $(".firstGuarantorSpouce").prop('disabled', true);
                    $(".firstGuarantorSpouce").val('');
                }
            })

            if($('.secondGuarantorMaritalStatus').val() == "Married"){
                 $(".secondGuarantorSpouce").prop('disabled', false);
            }else{
                $(".secondGuarantorSpouce").prop('disabled', true);
            }

            $('.secondGuarantorMaritalStatus').click(function(event) {
                var secondGuarantorMaritalStatus = $('.secondGuarantorMaritalStatus').val();
                if(secondGuarantorMaritalStatus == "Married"){
                     $(".secondGuarantorSpouce").prop('disabled', false);
                }else{
                     $(".secondGuarantorSpouce").prop('disabled', true);
                    $(".secondGuarantorSpouce").val('');
                }
            })

            /*end code for guarantor info*/
        });
    </script>

   <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

{{-- code for first gurantor data change --}}
    <script type="text/javascript">
        function FirstGurantor(guarantorId){
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'post',
                    url:'{{ route('customerRegistration.getGuarantorInfo') }}',
                    data:{guarantorId:guarantorId},
                    success:function(data){
                        var gurantor = data.gurantor;
                       $('#gurantorName1').val(gurantor.gurantor_name);
                       $('#gurantorPhoneNo1').val(gurantor.gurantor_phone_no);
                       $('#gurantorAge1').val(gurantor.gurantor_age);
                       $('#guarantorMaritalStatus1').val(gurantor.guarantor_marital_status);
                       $('#guarantorSpouseName1').val(gurantor.guarantor_spouse_name);
                       $('#guarantorFatherName1').val(gurantor.guarantor_father_name);
                       $('#guarantorPresentAddress1').val(gurantor.guarantor_present_address);
                       $('#guarantorPermanentAddress1').val(gurantor.guarantor_permanent_address);
                       $('#guarantorProfessionName1').val(gurantor.guarantor_profession_name);
                       $('#guarantorDesignation1').val(gurantor.guarantor_designation);
                       $('#guarantorWorkplacePhoneNo1').val(gurantor.guarantor_workplace_phone_no);
                       $('#guarantorMonthlyIncome1').val(gurantor.guarantor_monthly_income);
                       $('#guarantorWorkPlaceAddress1').val(gurantor.guarantor_work_place_address);

                       if($('.firstGuarantorMaritalStatus').val() == "Married"){
                             $(".firstGuarantorSpouce").prop('disabled', false);
                        }else{
                            $(".firstGuarantorSpouce").prop('disabled', true);
                        }
                    }
                });
            })
        }
    </script>

{{-- code for second gurantor data change --}}
    <script type="text/javascript">
        function SecondGurantor(guarantorId){
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'post',
                    url:'{{ route('customerRegistration.getGuarantorInfo') }}',
                    data:{guarantorId:guarantorId},
                    success:function(data){
                        var gurantor = data.gurantor;
                       $('#gurantorName2').val(gurantor.gurantor_name);
                       $('#gurantorPhoneNo2').val(gurantor.gurantor_phone_no);
                       $('#gurantorAge2').val(gurantor.gurantor_age);
                       $('#guarantorMaritalStatus2').val(gurantor.guarantor_marital_status);
                       $('#guarantorSpouseName2').val(gurantor.guarantor_spouse_name);
                       $('#guarantorFatherName2').val(gurantor.guarantor_father_name);
                       $('#guarantorPresentAddress2').val(gurantor.guarantor_present_address);
                       $('#guarantorPermanentAddress2').val(gurantor.guarantor_permanent_address);
                       $('#guarantorProfessionName2').val(gurantor.guarantor_profession_name);
                       $('#guarantorDesignation2').val(gurantor.guarantor_designation);
                       $('#guarantorWorkplacePhoneNo2').val(gurantor.guarantor_workplace_phone_no);
                       $('#guarantorMonthlyIncome2').val(gurantor.guarantor_monthly_income);
                       $('#guarantorWorkPlaceAddress2').val(gurantor.guarantor_work_place_address);

                       if($('.secondGuarantorMaritalStatus').val() == "Married"){
                             $(".secondGuarantorSpouce").prop('disabled', false);
                        }else{
                            $(".secondGuarantorSpouce").prop('disabled', true);
                        }
                    }
                });
            })
        }
    </script>

@endsection