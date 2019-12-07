<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\broker;
class brokerController extends Controller
{
        public function create(Request $request)
    {

        $data = $request->input();

        if (!empty($data))
        {


           try
           {
            $newbroker = new broker();
            $newbroker->name = $data['name'];
            $newbroker->phone = $data['phone'];
            $newbroker->address = $data['address'];
            $newbroker->PTN = $data['PTN'];
            $newbroker->NTN = $data['NTN'];
            
           
            $newbroker->save();
            notify()->success('broker added successfully!');

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
           $request->session()->flash('alert-success', 'broker Added successfully!');
           return redirect()->back();
           
        }
        else
        {
            return redirect()->back();
        }
        
    } 
    public function show()
    {

       $brokers = broker::get()->toArray();

       return view('list_brokers', ['brokers'=>$brokers]);
        //
    }
    public function showall()
    {

        $brokers = broker::get()->toArray();

       return $brokers;
        //
    }
     public function showall_admin()
    {

       $broker = broker::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

       return view('list_brokers', ['brokers'=>$broker]);
        //
    }
    public function total_payable()
  {
    $brokers = broker::get()->toArray();
    $total_payable=0;
   foreach ($brokers as $broker ) {
       $total_payable=$total_payable+($broker['total_cost']-$broker['received_cost']);
   }

   return $total_payable;
    
  }
  public function payment_received($bid,$payment)
  {
    $brokers = broker::where('bid',$bid)->first();
    $received=$payment;
    $received=$received+$brokers['received_cost'];
    $result=broker::where('bid',$bid)->Update(['received_cost' => $received ]);
 return $result;
  }
    public function view($id)
    {

        $brokers = broker::where('bid',$id)->first()->toArray();

       return view('view_brokers', ['brokers'=>$brokers]);
        
    }
       public function update_form($id)
   {

  
   $broker = broker::where('bid',$id)->first();

    return view('update_broker', ['broker'=>$broker]);

   }
     public function return_broker($id)
    {

       $broker = broker::where('bid',$id)->first()->toArray();

       return $broker;
        
    }
    public function edit($id)
    {
        $brokers = broker::where('bid',$id)->first()->toArray();
      // echo "<pre>";
      // print_r($userdata);

      // echo $id;
      // die();
      return view('edit_brokers', ['brokers'=>$brokers]);
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          $data=$request->input();
try {
          broker::where('bid',$data['bid'])->Update(['name' => $data['name'],  'phone'=>$data['phone'],'address'=>$data['address'],  'PTN'=>$data['PTN'],'NTN'=>$data['NTN']]);
          

} catch(\Exception $exp)
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
          alert("broker updated successfully");          
          </script><?php  

        
  $brokers = broker::get()->toArray();
       return view('list_brokers', ['brokers'=>$brokers]);

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
        broker::where('bid',$id)->delete();
         $broker = broker::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

       return view('list_brokers', ['brokers'=>$broker]);
    }
}
