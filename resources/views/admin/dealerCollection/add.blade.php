@extends('admin.layouts.masterAddEdit')

@section('card_body')
    @php
        use App\DealerCollection;
        $lastDealerCollectionId = DealerCollection::max('id');
        if(@$lastDealerCollectionId)
        {
            $paymentNo = 100000000 + $lastDealerCollectionId + 1;
        }
        else
        {
            $paymentNo = 100000000 + 1;
        }
    @endphp
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label for="phone">Payment No</label>
                <div class="form-group {{ $errors->has('paymentNo') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control" id="paymentNo" name="paymentNo" value="{{ $paymentNo }}" required readonly/>
                    @if ($errors->has('paymentNo'))
                        @foreach($errors->get('paymentNo') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>                              
            </div>

            <div class="col-md-3">
                <label for="payment-date">Payment Date</label>
                <div class="form-group {{ $errors->has('paymentDate') ? ' has-danger' : '' }}">
                    <input  type="text" class="form-control add_datepicker" id="paymentDate" name="paymentDate" readonly>
                    @if ($errors->has('paymentDate'))
                        @foreach($errors->get('paymentDate') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>                              
            </div>

            <div class="col-md-3">
                <label for="money-receipt-no">Money Receipt No</label>
                <div class="form-group {{ $errors->has('moneyReceiptNo') ? ' has-danger' : '' }}">
                    <input type="text" class="form-control" id="moneyReceiptNo" name="moneyReceiptNo" value="" required/>
                    @if ($errors->has('moneyReceiptNo'))
                        @foreach($errors->get('moneyReceiptNo') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>                              
            </div>

            <div class="col-md-3">
                @php
                    $types = array('Cash'=>'Cash','Bkash'=>'Bkash','Others'=>'Others');
                @endphp
                <label for="money-receipt-type">Money Receipt Type</label>
                <div class="form-group {{ $errors->has('moneyReceiptType') ? ' has-danger' : '' }}">
                    <div class="form-group">
                        <select class="form-control" id="moneyReceiptType" name="moneyReceiptType">
                            <option value="">Select Money Receipt Type</option>
                            @foreach ($types as $key=>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($errors->has('moneyReceiptType'))
                        @foreach($errors->get('moneyReceiptType') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('dealer') ? ' has-danger' : '' }}">
                    <label for="dealer">Dealer</label>
                    <div class="form-group">
                        <select class="form-control chosen-select" id="dealer" name="dealer">
                            <option value="">Select Dealer</option>
                            @foreach ($dealers as $dealer)
                                <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($errors->has('dealer'))
                        @foreach($errors->get('dealer') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-3">
                <label for="due-amount">Due Amount</label>
                <div class="form-group {{ $errors->has('dueAmount') ? ' has-danger' : '' }}">
                    <input type="number" class="form-control" id="dueAmount" name="dueAmount" value="0" required readonly />
                    @if ($errors->has('dueAmount'))
                        @foreach($errors->get('dueAmount') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>                              
            </div>

            <div class="col-md-3">
                <label for="new-paid">New paid</label>
                <div class="form-group {{ $errors->has('newPaid') ? ' has-danger' : '' }}">
                    <input type="number" class="form-control" id="newPaid" name="newPaid" value="0" oninput="findBalance()" required/>
                    @if ($errors->has('newPaid'))
                        @foreach($errors->get('newPaid') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-3">
                <label for="balance">Balance</label>
                <div class="form-group {{ $errors->has('balance') ? ' has-danger' : '' }}">
                    <input type="number" class="form-control" id="balance" name="balance" value="0" required readonly />
                    @if ($errors->has('balance'))
                        @foreach($errors->get('balance') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="remarks">Remarks</label>
                <div class="form-group {{ $errors->has('remarks') ? ' has-danger' : '' }}">
                    <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    @if ($errors->has('remarks'))
                        @foreach ($errors->get('remarks') as $error)
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
        $(document).on('change', '#dealer', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var dealerId = $('#dealer option:selected').val();
            if(dealerId != '')
            {
                $.ajax({
                    type:'post',
                    url:'{{ route('dealerCollection.getDealerInfo') }}',
                    data:{dealerId:dealerId},
                    success:function(data){
                        var productIssueList = data.productIssueList;
                        var dealerCollection = data.dealerCollection;

                        var dueAmount = productIssueList.total_amount - dealerCollection.previousCollection;

                        $('#dueAmount').val(dueAmount); 
                        $('#newPaid').val(0); 
                        $('#balance').val(0); 
                    }
                });
            }
            else
            {
                $('#dueAmount').val(0); 
                $('#newPaid').val(0); 
                $('#balance').val(0); 
            }
        });

        function findBalance()
        {
            var newPaid = $("#newPaid").val();
            var dueAmount = $("#dueAmount").val();

            var balance = dueAmount - newPaid;

            if (balance < 0)
            {
                swal("You Can't Paid More Than Due Amount","","warning");

                $("#newPaid").val(dueAmount);
                $("#balance").val(0);
            }
            else
            {
                $("#balance").val(balance);
            }

        }

        /*end code for product info*/

        $("form").submit(function(e){
            if ($('.currentDue').val() < 0) {
                alert('Collection amount sholuld not be cross invoice amount!');
                e.preventDefault();
            }
        });

    </script>
@endsection
