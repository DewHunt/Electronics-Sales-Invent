@extends('admin.layouts.master')

@section('custom_css')
    <style type="text/css">
        .table th{
            background: #00c292;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="card">            
        <div class="card-header">
            <div class="row">
                <div class="col-md-4"><h4 class="card-title" id="title">{{ $title }}</h4></div>

                <div class="col-md-8">
                    <button class="btn btn-outline-dark btn-lg" id="pendingButton" style="width: 100%">Click For Pending Requisition</button>
                    <button class="btn btn-outline-dark btn-lg" id="approveButton" style="width: 100%">Click For Approved Requisition</button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div id="pendingSection">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th width="20px">SL</th>
                                    <th width="50px">Date</th>
                                    <th width="50px">Requisition No.</th>
                                    <th width="350px">Dealer Name</th>
                                    <th width="50px">Total Qty</th>
                                    <th width="50px">Total Amount</th>
                                    <th width="20px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @foreach ($dealerRequisitions as $dealerRequisition)
                                    <tr class="row_{{ $dealerRequisition->id }}">
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($dealerRequisition->date)) }}</td>
                                        <td>{{ $dealerRequisition->requisition_no }}</td>
                                        <td>{{ $dealerRequisition->dealerName }}</td>
                                        <td align="right">{{ $dealerRequisition->total_qty }}</td>
                                        <td align="right">{{ $dealerRequisition->total_amount }}</td>
                                        <td align="center"><button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#detailRequisitionModal" onclick="showDetailRequisition({{ $dealerRequisition->id }})">Details</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="approveSection">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Approve Section</h4>
                    </div>
                </div>
            </div>           
        </div>
    </div>

    <form class="form-horizontal" action="{{ route($formLink) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        {{-- The Modal --}}
        <div class="modal fade" id="detailRequisitionModal">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                    {{-- Modal Header --}}
                    <div class="modal-header">
                        <h3 class="modal-title" id="dealerName"></h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    {{-- Modal body --}}
                    <div class="modal-body">
                        <table class="table table-bordered table-sm detailRequisitionProduct">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th width="200px">Model</th>
                                    <th width="100px">Rate</th>
                                    <th width="80px">Qty</th>
                                    <th width="100px">Amount</th>
                                    <th width="100px">Approve Qty</th>
                                    <th width="120px">Approve Amount</th>
                                </tr>
                            </thead>

                            <tbody id="tbody">
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="3" align="right" style="vertical-align: middle;"><h3>Total</h3></td>
                                    <td><input style="text-align: right;" class="form-control" id="totalQty" type="text" name="totalQty" value=""></td>
                                    <td><input style="text-align: right;" class="form-control" id="totalAmount" type="text" name="totalAmount" value=""></td>
                                    <td><input style="text-align: right;" class="form-control" id="totalApproveQty" type="number" name="totalApproveQty" value="0" readonly></td>
                                    <td><input style="text-align: right;" class="form-control" id="totalApproveAmount" type="number" name="totalApproveAmount" value="0" readonly></td>
                                </tr>

                                <tr>
                                    <td colspan="7"><input class="form-control" type="text" name="dealerRequisitionId" id="dealerRequisitionId" value=""></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- Modal footer --}}
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect"><i class="fa fa-save"></i> {{ $buttonName }}</button>
                        <button type="button" class="btn btn-outline-danger btn-lg waves-effect" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </form>	
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            $('#approveSection').hide();
            $('#pendingButton').hide();

            $('#approveButton').click(function(){
                $('#title').html('All Approved Requisitions')
                $('#approveButton').hide();
                $('#pendingButton').show();
                $('#approveSection').show();
                $('#pendingSection').hide();
            });

            $('#pendingButton').click(function(){
                $('#title').html('All Pending Requisitions')
                $('#approveButton').show();
                $('#pendingButton').hide();
                $('#approveSection').hide();
                $('#pendingSection').show();
            });
        });

        function showDetailRequisition(dealerRequisitionId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('dealerRequisitionApproval.dealerRequisitionInfo') }}",
                data:{dealerRequisitionId:dealerRequisitionId},
                success: function(response) {
                    $('.requisitionProductRow').remove();
                    var dealerRequisition = response.dealerRequisition;
                    var dealerRequisitionProducts = response.dealerRequisitionProducts;

                    $('#dealerName').html(dealerRequisition.dealerName);
                    $('#totalQty').val(dealerRequisition.total_qty);
                    $('#totalAmount').val(dealerRequisition.total_amount);
                    $('#dealerRequisitionId').val(dealerRequisition.id);

                    for (var dealerRequisitionProduct of dealerRequisitionProducts)
                    {
                        $(".detailRequisitionProduct tbody").append(
                            '<tr class="requisitionProductRow" id="requisitionProductRow_'+dealerRequisitionProduct.id+'">' +
                                '<td>'+
                                    '<input class="form-control requisitionProductName_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.productName+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input class="form-control requisitionProductModelNo_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.model_no+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control requisitionProductPrice_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.price+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control requisitionProductQty_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.qty+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control requisitionAmount_'+dealerRequisitionProduct.id+'" type="text" value="'+dealerRequisitionProduct.amount+'" readonly>'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control approveQty approveQty_'+dealerRequisitionProduct.id+'" oninput="findTotalApproveAmount('+dealerRequisitionProduct.id+')" type="number" value="0">'+
                                '</td>'+
                                '<td>'+
                                    '<input style="text-align: right;" class="form-control approveAmount approveAmount_'+dealerRequisitionProduct.id+'" type="number" value="0" readonly>'+
                                '</td>'+
                            '</tr>'
                        );
                    }
                },
                error: function(response) {

                }
            });
        }

        function findTotalApproveAmount(i)
        {
            var rate = parseFloat($('.requisitionProductPrice_'+i).val());
            var approveQty = parseFloat($('.approveQty_'+i).val());
            var approveAmount = rate * approveQty;

            $('.approveAmount_'+i).val(Math.round(approveAmount));

            rowSum();
        }

        function rowSum()
        {
            var totalApproveQty = 0;            
            var totalApproveAmount = 0;            
            $(".approveQty").each(function () {
                var approveQty = parseFloat($(this).val());
                totalApproveQty += isNaN(approveQty) ? 0 : approveQty;
            });

            $(".approveAmount").each(function () {
                var approveAmount = parseFloat($(this).val());
                totalApproveAmount += isNaN(approveAmount) ? 0 : approveAmount;
            });

            $('#totalApproveQty').val(totalApproveQty);
            $('#totalApproveAmount').val(Math.round(totalApproveAmount));
        }
    </script>
@endsection