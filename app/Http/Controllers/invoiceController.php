<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\invoice;
use App\company;
use App\bilty;
use App\Http\Controllers\biltyController;
use App\Http\Controllers\ledgerController;
use Illuminate\Database\QueryException;
use PDF;

class invoiceController extends Controller
{
  public function create($quantity , $totalcost , $cname , $tax )
  {

    {


     try
     {
      $newinvoice = new invoice();
      $newinvoice->b_quantity = $quantity;
      $newinvoice->total_cost = $totalcost;
      $newinvoice->c_name = $cname;
      $newinvoice->sales_tax = $tax;
      $tax_value = ($totalcost/100)*$tax;
      $tax_value=round($tax_value);
      $cost_inc_tax_value=$tax_value+$totalcost;
      $newinvoice->salex_tax_value = $tax_value;
      $newinvoice->cost_inc_tax = $cost_inc_tax_value;
      $newinvoice->save();
      notify()->success('invoice added successfully!');
 ?><script language="javascript">       
            alert("invoice created");          
            </script>

    <?php
      $invoice_id=DB::select("select iid from invoices where b_quantity = '$quantity' and total_cost = '$totalcost' and c_name = '$cname' and sales_tax = '$tax'");

    }
    catch(\Exception $exp)
    {
             // $tbldata = DB::table('cars')->get();

       ?><script language="javascript">       
            alert("invoice error");          
            </script>

    <?php
    connectify('error', 'SQL error', $ex->getmessage());

      //$request->session()->flash('alert-danger', $exp->getmessage());
             return redirect()->back();
    }
    catch(QueryException $ex)
            {
              connectify('error', 'SQL error', $ex->getmessage());
              $request->session()->flash('alert-danger','Fill all fields');
              return redirect()->back();
            }
   // $request->session()->flash('alert-success', 'invoice Added successfully!');
      return $invoice_id[0]->iid;

    }

  } 
  public function show()
  {

   $brokers = new brokerController;
   $allbroker=$brokers->showall();
   $companies = new companyController;
   $allcompany=$companies->showall();

   $invoices = invoice::orderBy('created_at')->get()->toArray();

   return view('list_invoices')->with('companies', $allcompany)->with('brokers', $allbroker)->with('invoices', $invoices)->with('allinvoices', $invoices);
        //
 }
 public function show_received()
 {
  $brokers = new brokerController;
  $allbroker=$brokers->showall();
  $companies = new companyController;
  $allcompany=$companies->showall();

  $allinvoices = invoice::get()->toArray();

  $invoices=DB::select("select * from invoices where payment_received = cost_inc_tax ");
       // conver stdclass object to arrat
  $invoices=json_decode(json_encode($invoices), true);


  return view('list_invoices_received')->with('companies', $allcompany)->with('brokers', $allbroker)->with('invoices', $invoices)->with('allinvoices', $allinvoices);
        //
}
public function show_pending()
{
  $brokers = new brokerController;
  $allbroker=$brokers->showall();
  $companies = new companyController;
  $allcompany=$companies->showall();

  $allinvoices = invoice::get()->toArray();

  $invoices=DB::select("select * from invoices where payment_received != cost_inc_tax  ");
       // conver stdclass object to arrat
  $invoices=json_decode(json_encode($invoices), true);


  return view('list_invoices_pending')->with('companies', $allcompany)->with('brokers', $allbroker)->with('invoices', $invoices)->with('allinvoices', $allinvoices);
        //
}
public function pending_payments()
{

  $allinvoices = invoice::get()->toArray();

  $invoices=DB::select("select * from invoices where payment_received != cost_inc_tax");
       // conver stdclass object to arrat
  $invoices=json_decode(json_encode($invoices), true);
  $total=0;
  foreach ($invoices as $invoice) {
    $total++;
  }
  return $total;
}
public function showall()
{

  $invoices = invoice::get()->toArray();

  return $invoices;
        //
}
public function showall_admin()
{

 $invoice = invoice::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

 return view('list_invoices', ['invoices'=>$invoice]);
        //
}
public function view($id)
{

  $invoices = invoice::where('iid',$id)->first();
  $company = company::where('name',$invoices['c_name'])->first();

  $data = array('invoices' => $invoices,'company' => $company );


      //   echo "<pre>";
      // print_r($company);

 return view('view_invoice')->with('data', $data);

}
 public function print($id)
{
  $invoices = invoice::where('iid',$id)->first();
  $company = company::where('name',$invoices['c_name'])->first();

  $data = array('invoices' => $invoices,'company' => $company );

  view()->share('data',$data);

  $pdf = PDF::loadView('view_invoice')->setPaper('a3', 'potrait');
 return $pdf->download($id.'invoice.pdf');


}
public function edit($id)
{
  $invoices = invoice::where('bid',$id)->first()->toArray();
      // echo "<pre>";
      // print_r($userdata);

      // echo $id;
      // die();
  return view('edit_invoices', ['invoices'=>$invoices]);

}
public function search(Request $request)
{


  $data = $request->input();
  $page =$data['page'];
  $c_name=$data['c_name'];
  $month=$data['month'];
  $iid=$data['iid'];
  $brokers = new brokerController;
  $allbroker=$brokers->showall();
  $companies = new companyController;
  $allcompany=$companies->showall();

  $allinvoices = invoice::get()->toArray();



  // $invoices=DB::select("select * from bilties where c_name = '$id'");
  //      // conver stdclass object to array
  // $invoices=json_decode(json_encode($invoices), true);


  if ($page == 'list_invoices') 
  { 
    if ($c_name == '0' ) 
    {

      if ($month == 0) 
      {
        if ($iid == 0) 
        {
         $invoices = invoice::get()->toArray(); 
       }
       else
       {
         $invoices = invoice::where('iid',$iid)->get();
       }
     }
     else
     {
       if ($iid == 0) 
       {
         $invoices = invoice::whereMonth('created_at', $month)->get();
       }
       else
       {
        $invoices = invoice::whereMonth('created_at', $month)->where('iid',$iid)->get();
      }
    }

  }
  else
  {

    if ($month == 0) 
    {
      if ($iid == 0) 
      {
       $invoices = invoice::where('c_name',$c_name)->get();
     }
     else
     {
       $invoices = invoice::where('c_name', $c_name)->where('iid',$iid)->get();
     }
   }
   else
   {
     if ($iid == 0) 
     {
       $invoices = invoice::whereMonth('created_at', $month)->where('c_name', $c_name)->get();
     }
     else
     {
      $invoices = invoice::whereMonth('created_at', $month)->where('iid',$iid)->where('c_name', $c_name)->get();
    }
  }

}
return view('list_invoices')->with('companies', $allcompany)->with('brokers', $allbroker)->with('invoices', $invoices)->with('allinvoices', $allinvoices);
}
else  //this else
{
  if ($c_name == 0 ) 
  {

    if ($month == 0) 
    {
      if ($iid == 0) 
      {
       $invoices = invoice::where('payment_received','!=',0)->get(); 
     }
     else
     {
       $invoices = invoice::where('iid',$iid)->where('payment_received','!=',0)->get();
     }
   }
   else
   {
     if ($iid == 0) 
     {
       $invoices = invoice::whereMonth('created_at', $month)->where('payment_received','!=',0)->get();
     }
     else
     {
      $invoices = invoice::whereMonth('created_at', $month)->where('iid',$iid)->where('payment_received','!=',0)->get();
    }
  }

}
else
{

  if ($month == 0) 
  {
    if ($iid == 0) 
    {
     $invoices = invoice::where('c_name',$c_name)->where('payment_received','!=',0)->get();
   }
   else
   {
     $invoices = invoice::where('c_name', $c_name)->where('iid',$iid)->where('payment_received','!=',0)->get();
   }
 }
 else
 {
   if ($iid == 0) 
   {
     $invoices = invoice::whereMonth('created_at', $month)->where('c_name', $c_name)->where('payment_received','!=',0)->get();
   }
   else
   {
    $invoices = invoice::whereMonth('created_at', $month)->where('iid',$iid)->where('c_name', $c_name)->where('payment_received','!=',0)->get();
  }
}

}
return view('list_invoices_received')->with('companies', $allcompany)->with('brokers', $allbroker)->with('invoices', $invoices)->with('allinvoices', $allinvoices);
}
}
public function update(Request $request)
{

  $data=$request->input();
  invoice::where('bid',$data['userid'])->Update(['name' => $data['name'],  'phone'=>$data['phone'],'addresses'=>$data['addresses']]);
  $invoices = invoice::get()->toArray();

  return view('list_invoices', ['invoices'=>$invoices]);

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
    public function received(Request $request)
    {
      try {
       $data=$request->input();
       $invoice = invoice::where('iid',$data['iid'])->first();
       $received=$invoice['payment_received'];
       $received=$received+$data['Amount'];
       invoice::where('iid',$data['iid'])->Update(['payment_received' => $received]);
       $company = company::where('name',$invoice['c_name'])->first();
       $company_receieved = $company['received_cost'];
       $company_receieved=$company_receieved+$data['Amount'];
       company::where('name',$invoice['c_name'])->Update(['received_cost' => $company_receieved]);
       notify()->success('invoice updated successfully!');
       return $invoice;




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
             $request->session()->flash('alert-success', 'payment updated successfully!');
    return redirect()->back();



        // echo "<pre>";
        // print_r($postdata);
        // die();
    }
    public function delete($id)
    {

     $invoice = invoice::where('bid',$id)->first()->toArray();
         //$invoice = invoice::get()->toArray();
     $biltys = bilty::get()->toArray();

     foreach ($biltys as $bilty)
     {
       bilty::where('iid',$invoice['iid'])->Update(['invoiced' => 'no','iid' => null ]);

     }
         // company::where('name',$invoice['iid'])->Update(['invoiced' => 'no','iid' => null ]);
     invoice::where('bid',$id)->delete();

      //   echo "<pre>";
      // print_r($food);

     return view('list_invoices', ['invoices'=>$invoice]);
   }
 }
