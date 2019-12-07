<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\account;

class accountController extends Controller
{
	public function create(Request $request)
	{
		

		$data = $request->input();

		if (!empty($data))
		{
           

			try
			{
			    $newaccount = new account();
				$newaccount->AccountNo = $data['AccountNo'];
				$newaccount->holder_name = $data['holder_name'];
				$newaccount->bank_name = $data['bank_name'];
				$newaccount->branch = $data['branch'];
				$newaccount->save();
        notify()->success('Account added successfully!');


			}
			catch(\Exception $exp)
			{
				$request->session()->flash('alert-danger', $exp->getmessage());
             return redirect()->back();
    }
      catch(QueryException $ex)
            {
              connectify('error', 'SQL error', 'complete all fileds');
              $request->session()->flash('alert-danger','Fill all fields');
              return redirect()->back();
            }
    $request->session()->flash('alert-success', 'account Added successfully!');
    return redirect()->back();

			}
				else
				{
					echo "eror";
					?><script>       
					alert("field is empty");          
					</script><?php  
				}

			} 
    public function show()
    {

       $accounts = account::get()->toArray();

       return view('create_account', ['accounts'=>$accounts]);
        //
    }
    public function balance_chart()
    {
        $accounts = account::get()->toArray();

        return $accounts;
      
    }
    public function showall()
    {

        $accounts = account::get()->toArray();

       return $accounts;
        //
    }
     public function showall_admin()
    {

       $account = account::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

       return view('list_accounts', ['accounts'=>$account]);
        //
    }
    public function all_balance()
    {
      $account = account::get()->toArray();
      $total_balance=0;

      foreach ($account as $acc ) {
        $total_balance=$total_balance+$acc['balance'];
      }

      return $total_balance;

    }
     public function view($id)
    {

        $accounts = account::where('aid',$id)->first()->toArray();

       return view('view_accounts', ['accounts'=>$accounts]);
        
    }
       public function update_form($id)
   {

  
   $account = account::where('aid',$id)->first();
  $accounts = account::get()->toArray();

   return view('update_account')->with('account', $account)->with('accounts', $accounts);

   }
     public function return_account($id)
    {

       $account = account::where('aid',$id)->first()->toArray();

       return $account;
        
    }
    public function edit($id)
    {
        $accounts = account::where('aid',$id)->first()->toArray();
      // echo "<pre>";
      // print_r($userdata);

      // echo $id;
      // die();
      return view('edit_accounts', ['accounts'=>$accounts]);
      
    }
    public function update(Request $request)
    {
    	$data=$request->input();
    	try {
    		account::where('aid',$data['aid'])->Update(['AccountNo' => $data['AccountNo'],  'holder_name'=>$data['holder_name'],'bank_name'=>$data['bank_name'],  'branch'=>$data['branch'],'balance'=>$data['balance']]);


    	} catch (Exception $e) 
    	{
    		?><script>       
    			alert("<?php $exp->getmessage() ?>");          
    			</script><?php  
    			return redirect()->back();
    	}
    		?><script>       
    			alert("account updated successfully");          
    			</script><?php  


    			$accounts = account::get()->toArray();
    			return view('create_account', ['accounts'=>$accounts]);
    }
      public function withdraw(Request $request)
    {
        $data=$request->input();
    	$account = account::where('aid',$data['aid'])->first();
    	$amount=$account['balance']-$data['Amount'];
    	try {
    		account::where('aid',$data['aid'])->Update(['balance' => $amount]);


    	} catch (Exception $e) 
    	{
    		?><script>       
    			alert("<?php $exp->getmessage() ?>");          
    			</script><?php  
    			return redirect()->back();
    	}
    		?><script>       
    			alert("account updated successfully");          
    			</script><?php  
    			return redirect()->back();

    }
      public function deposit(Request $request)
    {
    	 $data=$request->input();
    	$account = account::where('aid',$data['aid'])->first();
    	$amount=$account['balance']+$data['Amount'];
    	try {
    		account::where('aid',$data['aid'])->Update(['balance' => $amount]);


    	} catch (\Exception $e) 
    	{
    		?><script>       
    			alert("<?php $exp->getmessage() ?>");          
    			</script><?php  
    			return redirect()->back();
    	}
    		?><script>       
    			alert("account updated successfully");          
    			</script><?php 
    			return redirect()->back(); 


    		
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        account::where('bid',$id)->delete();
         $account = account::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

       return view('list_accounts', ['accounts'=>$account]);
    }
}
