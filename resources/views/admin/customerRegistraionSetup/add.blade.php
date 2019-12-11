@extends('admin.layouts.masterAddEdit')

@section('card_body')

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

   @include('admin/customerRegistraionSetup/element/add/personal_information')
   @include('admin/customerRegistraionSetup/element/add/professional_information')
   @include('admin/customerRegistraionSetup/element/add/product_details')
   @include('admin/customerRegistraionSetup/element/add/first_guarantor_information')
   @include('admin/customerRegistraionSetup/element/add/second_guarantor_information')
 
@endsection

@section('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {
        /*code for spouce info*/
            $(".spouceName").prop('disabled', true);
            $('.maritalStatus').click(function(event) {
                var maritalStatus = $('.maritalStatus').val();
                if(maritalStatus == "Married"){
                    $(".spouceName").prop('disabled', false);
                }else{
                     $(".spouceName").prop('disabled', true);
                }
            })
        /*end code for spouce info*/
            
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
        /*code for guarantor info*/
        $(".firstGuarantorSpouce").prop('disabled', true);
        $(".secondGuarantorSpouce").prop('disabled', true);
            $('.firstGuarantorMaritalStatus').click(function(event) {
                var firstGuarantorMaritalStatus = $('.firstGuarantorMaritalStatus').val();
                if(firstGuarantorMaritalStatus == "Married"){
                     $(".firstGuarantorSpouce").prop('disabled', false);
                }else{
                     $(".firstGuarantorSpouce").prop('disabled', true);
                    $(".firstGuarantorSpouce").val('');
                }
            })

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

        /*code for purchase type*/

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

        /*end code for purchase type*/

            
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
                        $('.productModel').val(product.model_no);
                        $('.cashPrice').val(product.price);
                        $('.warranty').val(product.warranty);
                    }
                });
            }else{
               $('.productModel').val('');
               $('.cashPrice').val(''); 
               $('.warranty').val(''); 
            }
        });

    /*end code for product info*/

    </script>

    <script type="text/javascript">
    /*code for applicants code*/
        function ApplicantCode() {
            var applicantsId = document.getElementById("applicants_id").value;
            var applicantsPhoneNo = document.getElementById("applicants_phone_no").value;
             lastThreeDigitofPhoneNo = applicantsPhoneNo % 1000;
            document.getElementById("apllicantsCode").value = "mnh-" +applicantsId+"-"+lastThreeDigitofPhoneNo;
        }
    /*end code for applicants code*/
    </script>
@endsection