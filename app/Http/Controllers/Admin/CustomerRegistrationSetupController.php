<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;
use MPDF;
use App\CustomerRegistrationSetup;
use App\CustomerProduct;
use App\CustomerGuarantor;
use App\ShowroomSetup;
use App\Product;
use App\InvoiceSetup;
class CustomerRegistrationSetupController extends Controller
{
    public function index(){
    	$title = "Customer Registration";
    	$customers = CustomerRegistrationSetup::where('status','1')
            ->orderBy('id','asc')
            ->get();
    	return view('admin.customerRegistraionSetup.index')->with(compact('title','customers'));
    }

    public function add()
    {
    	$title = "New Customer Registration";
        $formLink = "customerRegistraionSetup.save";
        $buttonName = "Save";
        $showrooms = ShowroomSetup::orderBy('name','asc')->where('status',1)->get();
        $products = Product::where('status',1)->orderBy('name','ASC')->get();
    	return view('admin.customerRegistraionSetup.add')->with(compact('title','formLink','buttonName','products','showrooms'));
    }

    public function save(Request $request)
    {
        $customerRegistraion = CustomerRegistrationSetup::create( [
            'name' => $request->name,            
            'code' => $request->code,            
            'nick_name' => $request->nickName,            
            'age' => $request->age,            
            'phone_no' => $request->phoneNo,            
            'marital_status' => $request->maritalStatus,            
            'spouse_name' => $request->spouseName,
            'fathers_name' => $request->fathersName,                   
            'mothers_name' => $request->mothersName,                   
            'gender' => $request->gender,                   
            'current_residence' => $request->currentResidence,                   
            'residence_duration' => $request->residenceDuration,                   
            'total_family_member' => $request->totalFamilyMember,                   
            'present_address' => $request->presentAddress,                   
            'permanent_address' => $request->permanentAddress,                   
            'profession_name' => $request->professionName,                   
            'profession_duration' => $request->professionDuration,                   
            'total_earning_member' => $request->totalEarningMember,                   
            'designation' => $request->designation,                   
            'monthly_income' => $request->monthlyIncome,                   
            'work_place_address' => $request->workPlaceAddress                 
        ]);

        if($customerRegistraion){
            $purchaseDate = date('Y-m-d', strtotime($request->purchaseDate));
            if($request->purchaseType == 'Cash'){
                $request->deposite = '';
                $request->installmentPrice = '';
                $request->totalInstallment = '';
                $request->monthlyInstallmentAmount = '';
            }
            $product = CustomerProduct::create( [
                'customer_id' => $customerRegistraion->id,       
                'product_id' => $request->productId,       
                'product_model' => $request->productModel,       
                'cash_price' => $request->cashPrice,
                'showroom_id' => $request->showroomId,       
                'warranty' => $request->warranty,       
                'purchase_date' => $purchaseDate,       
                'purchase_type' => $request->purchaseType,       
                'deposite' => $request->deposite,       
                'installment_price' => $request->installmentPrice,       
                'total_installment' => $request->totalInstallment,       
                'monthly_installment_amount' => $request->monthlyInstallmentAmount,       
                'product_usage_address' => $request->productUsageAddress,         
            ]);
        }

        if(@$product)
        {
            $countCustomerGuarantor = count($request->gurantorName);
            if($request->gurantorName)
            {
                $postData = [];
                for ($i=0; $i <$countCustomerGuarantor ; $i++)
                {
                    if ($request->gurantorName[$i] != "")
                    { 
                        $postData[] = [
                            'customer_id'=> $customerRegistraion->id,
                            'product_id'=> $request->productId,
                            'gurantor_name' => $request->gurantorName[$i],
                            'gurantor_phone_no' => $request->gurantorPhoneNo[$i], 
                            'gurantor_age' => $request->gurantorAge[$i],
                            'guarantor_marital_status' => $request->guarantorMaritalStatus[$i],
                            'guarantor_spouse_name' => @$request->guarantorSpouseName[$i],
                            'guarantor_father_name' => @$request->guarantorFatherName[$i],
                            'guarantor_present_address' => $request->guarantorPresentAddress[$i],
                            'guarantor_permanent_address' => $request->guarantorPermanentAddress[$i],
                            'guarantor_profession_name' => $request->guarantorProfessionName[$i],
                            'guarantor_designation' => $request->guarantorDesignation[$i],
                            'guarantor_workplace_phone_no' => $request->guarantorWorkplacePhoneNo[$i],
                            'guarantor_monthly_income' => $request->guarantorMonthlyIncome[$i],
                            'guarantor_work_place_address' => $request->guarantorWorkPlaceAddress[$i],
                        ];
                    }
                }
                
                CustomerGuarantor::insert($postData);
            }
        }        

        return redirect(route('customerRegistraionSetup.index'))->with('msg','Customer Registration Successfuly  Complete');
    }

    public function viewCustomerDetails($id){
        $title = "Add Product for Existing Customer";
        $formLink = "customerRegistraionSetup.NewProductSave";
        $buttonName = "Save";
        $customer = CustomerRegistrationSetup::orWhere('id',$id)->first();
        $showrooms = ShowroomSetup::orderBy('name','asc')->where('status',1)->get();
        $products = Product::where('status',1)->orderBy('name','ASC')->get();
        $customerProducts = CustomerProduct::where('customer_id',$customer->id)->get();
        $customerGuarantor = CustomerGuarantor::where('customer_id',$customer->id)->get();
        return view('admin.customerRegistraionSetup.view')->with(compact('title','formLink','buttonName','customer','products','showrooms','customerProducts','customerGuarantor'));
    }

    public function newProductSave(Request $request)
    {
        $customerId = $request->customerId;

        if($request->hiddenProduct == '1')
        {
            $purchaseDate = date('Y-m-d', strtotime($request->purchaseDate));
            if($request->purchaseType == 'Cash'){
                $request->deposite = '';
                $request->installmentPrice = '';
                $request->totalInstallment = '';
                $request->monthlyInstallmentAmount = '';
            }
            $product = CustomerProduct::create( [
                'customer_id' => $customerId,       
                'product_id' => $request->productId,       
                'product_model' => $request->productModel,       
                'cash_price' => $request->cashPrice,
                'showroom_id' => $request->showroomId,       
                'warranty' => $request->warranty,       
                'purchase_date' => $purchaseDate,       
                'purchase_type' => $request->purchaseType,       
                'deposite' => $request->deposite,       
                'installment_price' => $request->installmentPrice,       
                'total_installment' => $request->totalInstallment,       
                'monthly_installment_amount' => $request->monthlyInstallmentAmount,       
                'product_usage_address' => $request->productUsageAddress,         
            ]);
        }

        if(@$product)
        {
            $countCustomerGuarantor = count($request->gurantorName);
            if($request->gurantorName)
            {
                $postData = [];
                for ($i=0; $i <$countCustomerGuarantor ; $i++)
                {
                    if ($request->gurantorName[$i] != "")
                    {  
                        $postData[] = [
                            'customer_id'=> $customerId,
                            'product_id'=> $request->productId,
                            'gurantor_name' => $request->gurantorName[$i],
                            'gurantor_phone_no' => $request->gurantorPhoneNo[$i], 
                            'gurantor_age' => $request->gurantorAge[$i],
                            'guarantor_marital_status' => $request->guarantorMaritalStatus[$i],
                            'guarantor_spouse_name' => @$request->guarantorSpouseName[$i],
                            'guarantor_father_name' => @$request->guarantorFatherName[$i],
                            'guarantor_present_address' => $request->guarantorPresentAddress[$i],
                            'guarantor_permanent_address' => $request->guarantorPermanentAddress[$i],
                            'guarantor_profession_name' => $request->guarantorProfessionName[$i],
                            'guarantor_designation' => $request->guarantorDesignation[$i],
                            'guarantor_workplace_phone_no' => $request->guarantorWorkplacePhoneNo[$i],
                            'guarantor_monthly_income' => $request->guarantorMonthlyIncome[$i],
                            'guarantor_work_place_address' => $request->guarantorWorkPlaceAddress[$i],
                        ];
                    }
                }
                
                CustomerGuarantor::insert($postData);
            }
        }
        return redirect(route('customerRegistraionSetup.index'))->with('msg','Customer New Product Successfuly Created');
    }

    public function edit($id)
    {
    	$title = "Edit Customer";
        $formLink = "customerRegistraionSetup.update";
        $buttonName = "Update";
        $customer = CustomerRegistrationSetup::where('id',$id)->first();
        return view('admin.customerRegistraionSetup.edit.editCustomer')->with(compact('title','formLink','buttonName','customer'));
    }

    public function update(Request $request)
    {
    	$customerId = $request->customerId;
    	$customer = CustomerRegistrationSetup::find($customerId);
    	$customerUpdate = $customer->update([
            'name' => $request->name,            
            'code' => $request->code,            
            'nick_name' => $request->nickName,            
            'age' => $request->age,            
            'phone_no' => $request->phoneNo,            
            'marital_status' => $request->maritalStatus,            
            'spouse_name' => $request->spouseName,
            'fathers_name' => $request->fathersName,                   
            'mothers_name' => $request->mothersName,                   
            'gender' => $request->gender,                   
            'current_residence' => $request->currentResidence,                   
            'residence_duration' => $request->residenceDuration,                   
            'total_family_member' => $request->totalFamilyMember,                   
            'present_address' => $request->presentAddress,                   
            'permanent_address' => $request->permanentAddress,                   
            'profession_name' => $request->professionName,                   
            'profession_duration' => $request->professionDuration,                   
            'total_earning_member' => $request->totalEarningMember,                   
            'designation' => $request->designation,                   
            'monthly_income' => $request->monthlyIncome,                   
            'work_place_address' => $request->workPlaceAddress                 
        ]);
        return redirect(route('customerRegistraionSetup.view',['id'=>$customerId]))->with(compact('customer'))->with('msg','Customer Information Successfuly Updated');
    }


    public function editCustomerProduct(Request $request, $customerId=NULL,$customerProductId=NULL)
    {
        if($request->isMethod('post'))
        {
            if(count($request->all()) > 0){
                $customerId = $request->customerId;
                $customerProductId = $request->customerProductId;
                $customerExistProduct = CustomerProduct::where('customer_id',$customerId)->where('id',$customerProductId)->first();

                $guarantor = CustomerGuarantor::where('customer_id',$customerId)->where('product_id',$customerExistProduct->product_id)->first();
                if($guarantor){
                    $guarantor->update( [
                        'product_id' => $request->productId,
                    ]);
                }
                $purchaseDate = date('Y-m-d', strtotime($request->purchaseDate));
                $updateCustomerProduct = $customerExistProduct->update( [
                    'customer_id' => $customerId,       
                    'product_id' => $request->productId,       
                    'product_model' => $request->productModel,       
                    'cash_price' => $request->cashPrice,
                    'showroom_id' => $request->showroomId,       
                    'warranty' => $request->warranty,       
                    'purchase_date' => $purchaseDate,       
                    'purchase_type' => $request->purchaseType,       
                    'deposite' => $request->deposite,       
                    'installment_price' => $request->installmentPrice,       
                    'total_installment' => $request->totalInstallment,       
                    'monthly_installment_amount' => $request->monthlyInstallmentAmount,       
                    'product_usage_address' => $request->productUsageAddress,         
                ]);

                if($updateCustomerProduct){
                    InvoiceSetup::where('customer_product_id',$customerProductId)->delete();
                }

                $customer = CustomerRegistrationSetup::where('id',$customerId)->first();

                return redirect(route('customerRegistraionSetup.view',['id'=>$customerId]))->with(compact('customer'))->with('msg','Customer Product Successfuly Updated');
            }
        }
        else
        {
            $title = "Edit Customer Product";
            $formLink = "customerRegistraionSetup.updateCustomerProduct";
            $buttonName = "Update";
            $showrooms = ShowroomSetup::orderBy('name','asc')->where('status',1)->get();
            $products = Product::where('status',1)->orderBy('name','ASC')->get();
            $customerProduct = CustomerProduct::where('customer_id',$customerId)->where('id',$customerProductId)->first();
            return view('admin.customerRegistraionSetup.edit.editCustomerProduct')->with(compact('title','formLink','buttonName','customerProduct','showrooms','products'));
        }
    }

    public function editGuarantor(Request $request, $customerId=NULL,$guarantorId=NULL)
    {
        if($request->isMethod('post'))
        {
            if(count($request->all()) > 0)
            {
                $customerId = $request->customerId;
                $guarantorId = $request->guarantorId;
                $customerExistGuarantor = CustomerGuarantor::where('customer_id',$customerId)->where('id',$guarantorId)->first();
                $customerExistGuarantor->update( [
                    'gurantor_name' => $request->gurantorName,
                    'gurantor_phone_no' => $request->gurantorPhoneNo, 
                    'gurantor_age' => $request->gurantorAge,
                    'guarantor_marital_status' => $request->guarantorMaritalStatus,
                    'guarantor_spouse_name' => @$request->guarantorSpouseName,
                    'guarantor_father_name' => @$request->guarantorFatherName,
                    'guarantor_present_address' => $request->guarantorPresentAddress,
                    'guarantor_permanent_address' => $request->guarantorPermanentAddress,
                    'guarantor_profession_name' => $request->guarantorProfessionName,
                    'guarantor_designation' => $request->guarantorDesignation,
                    'guarantor_workplace_phone_no' => $request->guarantorWorkplacePhoneNo,
                    'guarantor_monthly_income' => $request->guarantorMonthlyIncome,
                    'guarantor_work_place_address' => $request->guarantorWorkPlaceAddress,         
                ]);

                $customer = CustomerRegistrationSetup::orWhere('id',$customerId)->first();

                return redirect(route('customerRegistraionSetup.view',['id'=>$customerId]))->with(compact('customer'))->with('msg','Customer Guarantor Successfuly Updated');

            }
        }
        else
        {
            $title = "Edit Customer Guarantor";
            $formLink = "customerRegistraionSetup.updateCustomerGuarantor";
            $buttonName = "Update";
            $guarantor = CustomerGuarantor::where('customer_id',$customerId)->where('id',$guarantorId)->first();
            return view('admin.customerRegistraionSetup.edit.editCustomerGuarantor')->with(compact('title','formLink','buttonName','guarantor'));
        }

    }

    public function delete(Request $request)
    {
        // CustomerRegistrationSetup::where('id',$request->customerId)->delete();
        // CustomerProduct::where('customer_id',$request->customerId)->delete();
        // CustomerGuarantor::where('customer_id',$request->customerId)->delete();

        $customerRegistration = CustomerRegistrationSetup::find($request->customerId);

        $customerRegistration->update([
            'status' => '0'
        ]);
    }

    public function print($customerId)
    {
        $title = "Print Customer Details";
        $customer = CustomerRegistrationSetup::orWhere('id',$customerId)->first();
        $showrooms = ShowroomSetup::orderBy('name','asc')->where('status',1)->get();
        $products = Product::where('status',1)->orderBy('name','ASC')->get();
        $customerProducts = CustomerProduct::where('customer_id',$customer->id)->get();
        $customerGuarantor = CustomerGuarantor::where('customer_id',$customer->id)->get();

        $pdf = PDF::loadView('admin.customerRegistraionSetup.print',['title'=>$title,'customer'=>$customer,'showrooms'=>$showrooms,'products'=>$products,'customerProducts'=>$customerProducts,'customerGuarantor'=>$customerGuarantor]);

        return $pdf->stream('customer_details.pdf');
    }


    public function getProductInfo(Request $request)
    {
        $productId = $request->productId;

        $product = Product::where('id',$productId)
            ->first();

        if($request->ajax()){
        return response()
                ->json([
                    'product'=>$product
                ]);
            }
   
    }

    public function getGuarantorInfo(Request $request)
    {
        $guarantorId = $request->guarantorId;

        $gurantor = CustomerGuarantor::where('id',$guarantorId)
            ->first();

        if($request->ajax()){
        return response()
                ->json([
                    'gurantor'=>$gurantor
                ]);
            }
    }

    public function customerListPrint()
    {  
        $title = "Customer List";

        $customerLists = CustomerRegistrationSetup::where('status','1')
            ->orderBy('name','asc')
            ->get();

        $pdf = PDF::loadView('admin.customerRegistraionSetup.customerListPrint',['title'=>$title,'customerLists'=>$customerLists]);

        return $pdf->stream('customer_lists.pdf');
    }
}
