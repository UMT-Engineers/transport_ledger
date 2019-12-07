<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Voucher;
use App\account;
use App\invoice;
use App\broker;
use App\employee;
use App\voucherserial;
use App\Http\Controllers\ledgerController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\brokerController;
use Illuminate\Database\QueryException;
use PDF;




class voucherController extends Controller
{
	public function create(Request $request)
	{

		$data = $request->input();

		if (!empty($data))
		{


			try
			{
				$newvoucher = new voucher();
				$newvoucher->vid = $data['vid'];
				$newvoucher->Amount = $data['Amount'];
				$newvoucher->AmountInWords = $data['AmountInWord'];
				$newvoucher->aid = $data['aid'];
				$newvoucher->cheque_no= $data['cheque_no'];
				$newvoucher->cheque_date= $data['cheque_date'];
				$newvoucher->cheque_bank_name= $data['cheque_bank_name'];
				
				$newvoucher->type = $data['type'];
				$type = $data['type'];
				$newvoucher->payee= $data['payee'];
				$newvoucher->Description = $data['Description'];
				if ($type=='cpv'){
					if (!empty($data['eid'])) {
						$newvoucher->eid = $data['eid'];
						$newvoucher->employee_operation= $data['e_operation'];

					}
					if (!empty($data['bid'])){
						$newvoucher->bid = $data['bid'];

					}


				}
				else if ($type=='crv') {
					if (!empty($data['eid'])) {
						$newvoucher->eid = $data['eid'];
						$newvoucher->employee_operation= $data['e_operation'];
					}
					if (!empty($data['iid'])) {
						$newvoucher->iid = $data['iid'];

					}
				}
				else if ($type=='pcv') {
            	# code...
				}
				else
				{

				}
				$newvoucher->save();
				notify()->success('voucher added successfully!');
				$voucher = voucher::where('vid',$data['vid'])->first();

				// echo "<pre>";
				// print_r($voucher['id']);

				if ($type=='cpv'){
					if (!empty($data['eid'])) {
						if ($data['e_operation']=='salary') {
							$account = new accountController();
							$result=$account->withdraw($request); 
							$ledger = new ledgerController();
						    $result =$ledger->create('Salary given to employee',$voucher['id'],$data['Amount'],0.0);
						}
						else
						{
							$account = new accountController();
							$result=$account->withdraw($request); 
							$ledger = new ledgerController();
						    $result =$ledger->create('other expense given to employee',$voucher['id'],$data['Amount'],0.0);
						}
					}
					if (!empty($data['bid'])){
						$account = new accountController();
						$result=$account->withdraw($request); 
                        $broker = new brokerController();
						$result=$broker->payment_received($data['bid'],$data['Amount']);
						$ledger = new ledgerController();
					    $result =$ledger->create('payment paid To Broker',$voucher['id'],$data['Amount'],0.0);
					}


				}
				else if ($type=='crv') {
					if (!empty($data['eid'])) {

					}
					if (!empty($data['iid'])) {

						$payment = new invoiceController();
						$invoice=$payment->received($request);
						$account = new accountController();
						$result=$account->deposit($request);  
						$ledger = new ledgerController();
						$result =$ledger->create('payment received form company',$voucher['id'],0.0,$data['Amount']);  
					}
				}
				else if ($type=='pcv') {
            		$account = new accountController();
						$result=$account->withdraw($request);  
						$ledger = new ledgerController();
						$result =$ledger->create('petty cash ',$voucher['id'],$data['Amount'],0.0);  
				}
				else
				{

				}

			}
			catch(\Exception $exp)
			{
				$request->session()->flash('alert-danger', $exp->getmessage());
             return redirect()->back();
            }
            catch(QueryException $ex)
            {
            	connectify('error', 'SQL error', $ex->getmessage());
            	//$request->session()->flash('alert-danger','Fill all fields');
            	return redirect()->back();
            }
            notify()->success('voucher added successfully!');
               $request->session()->flash('alert-success', 'voucher Added successfully!');
               $result=voucherserial::where('sid',1)->Update([$data['type']=> $data['vid']]);

   

					$vouchers = Voucher::where('type',$type)->get();
					return view('list_voucher')->with('type', $type)->with('Vouchers', $vouchers);


				}
				else
				{
					return redirect()->back();
				}

			} 
			public function show($id)
			{

				$vouchers = Voucher::where('type',$id)->get();
				return view('list_voucher')->with('type', $id)->with('Vouchers', $vouchers);

				
			}
			public function show_form($id)
			{

				$accounts = account::get()->toArray();
				$brokers = broker::get()->toArray();
				$invoices = invoice::get()->toArray();
				$employees = employee::get()->toArray();

				$serial = voucherserial::get()->toArray();

				
				$vserial=$serial[0][$id];

				try {
					$updatedvserial=++$vserial;

                //$results = DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = '$someVariable'") );

					return view('create_voucher')->with('type', $id)->with('brokers', $brokers)->with('invoices', $invoices)->with('accounts', $accounts)->with('employees', $employees)->with('serial', $vserial);
				} catch (Exception $exp) {
					?><script>       
						alert("<?php echo $exp->getmessage() ?>");          
						</script><?php  
						return redirect()->back();
					}




				}
				public function showall()
				{

					$vouchers = voucher::get()->toArray();

					return $vouchers;
        //
				}
				public function showall_admin()
				{

					$voucher = voucher::get()->toArray();

                    //   echo "<pre>";
                    // print_r($food);

					return view('list_vouchers', ['vouchers'=>$voucher]);
				}
				public function view($id)
				{

                    $voucher =DB::table('vouchers')
                    ->join('accounts', 'accounts.aid', '=', 'vouchers.aid')
                    ->where('vouchers.id',$id)
                    ->select('vouchers.id','vouchers.vid','vouchers.created_at','vouchers.bid','vouchers.eid','vouchers.iid','vouchers.employee_operation','vouchers.cheque_no','vouchers.cheque_date','vouchers.cheque_bank_name','vouchers.type','vouchers.payee','vouchers.Description','vouchers.vid','vouchers.Amount','vouchers.AmountInWords','accounts.holder_name','accounts.AccountNo','accounts.balance','accounts.bank_name','vouchers.updated_at')
                    ->get();
                            
                      $voucher=json_decode(json_encode($voucher), true);
               

					// $voucher = voucher::where('id',$id)->first();
					//  $account = account::where('aid',$voucher['aid'])->first();
					 return view('voucher1')->with('voucher', $voucher[0]);

				}
				public function print_voucher($id)
                {
                     $voucher =DB::table('vouchers')
                    ->join('accounts', 'accounts.aid', '=', 'vouchers.aid')
                    ->where('vouchers.id',$id)
                    ->select('vouchers.id','vouchers.vid','vouchers.created_at','vouchers.bid','vouchers.eid','vouchers.iid','vouchers.employee_operation','vouchers.cheque_no','vouchers.cheque_date','vouchers.cheque_bank_name','vouchers.type','vouchers.payee','vouchers.Description','vouchers.vid','vouchers.Amount','vouchers.AmountInWords','accounts.holder_name','accounts.AccountNo','accounts.balance','accounts.bank_name','vouchers.updated_at')
                    ->get();
                            
                      $voucher=json_decode(json_encode($voucher), true);

             view()->share('voucher',$voucher[0]);

             $pdf = PDF::loadView('voucher1')->setPaper('a4', 'landscape');
             return $pdf->download('voucher.pdf');

               }
				public function update_form($id)
				{

					$id;
					$voucher = voucher::where('bid',$id)->first();

					return view('update_voucher', ['voucher'=>$voucher]);

				}
				public function return_voucher($id)
				{

					$voucher = voucher::where('id',$id)->first();

					return $voucher;

				}
				public function edit($id)
				{
					$vouchers = voucher::where('bid',$id)->first();
                  // echo "<pre>";
                  // print_r($userdata);
                   // echo $id;
                   // die();
					return view('edit_vouchers', ['vouchers'=>$vouchers]);

				}

				public function update(Request $request)
				{
					$data=$request->input();
					try {
						voucher::where('bid',$data['bid'])->Update(['name' => $data['name'],  'phone'=>$data['phone'],'address'=>$data['address'],  'PTN'=>$data['PTN'],'NTN'=>$data['NTN']]);
                              notify()->success('voucher update successfully!');

					} 
					catch(\Exception $exp)
                    {
           connectify('error', 'Exception', $exp->getmessage());
             $request->session()->flash('alert-danger', $exp->getmessage());
             return redirect()->back();
             }
            catch(QueryException $ex)
            {
              connectify('error', 'SQL error', 'complete all fileds');
              $request->session()->flash('alert-danger','Fill all fields');
              return redirect()->back();
            }
						?><script>       
							alert("voucher updated successfully");          
							</script><?php  


							$vouchers = voucher::get()->toArray();
							return view('list_vouchers', ['vouchers'=>$vouchers]);

        // echo "<pre>";
        // print_r($postdata);
        // die();
						}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
    	voucher::where('bid',$id)->delete();
    	$voucher = voucher::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

    	return view('list_vouchers', ['vouchers'=>$voucher]);
    }
}
