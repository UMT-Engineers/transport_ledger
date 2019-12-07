<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\bilty;
use App\broker;
use App\Http\Controllers\brokerController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\ledgerController;
use Illuminate\Database\QueryException;
use PDF;
use Session;

class biltyController extends Controller
{

  public function create(Request $request)
  {

    $data = $request->input();

    if (!empty($data))
    {


     try
     {
      $newbilty = new bilty();
      $newbilty->bid = $data['bid'];
      $newbilty->cid = $data['cid'];
      $newbilty->receiving_company = $data['receiving_company'];
      $weight=$data['c_weight'];
      $newbilty->c_weight = $weight;
      $newbilty->r_weight = 0;
      $crate= $data['c_rate'];
      $newbilty->c_rate =$crate;
      $newbilty->departure = $data['departure'];
      $newbilty->destination = $data['destination'];
      $newbilty->builty_no = $data['builty_no'];
      $newbilty->car_no = $data['car_no'];
      $newbilty->driver_name = $data['driver_name'];
      $newbilty->cnic = $data['cnic'];

      $total_cost=round($weight*$crate);

      $newbilty->total_cost = $total_cost;

      $newbilty->b_rate = $data['b_rate'];
      $pay_broker=$weight*$data['b_rate'];


      echo  $newbilty->debit_cost = $total_cost-$pay_broker;


      $newbilty->save();
      notify()->success('bilty added successfully!');

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
    $request->session()->flash('alert-success', 'bilty Added successfully!');
    return redirect()->back();

    }
    else
    {
      return redirect()->back();
    }

  } 
  public function login_check(Request $request)
    {
      $data = $request->input();

      $username=$data['username'];
      $password=$data['password'];
        

        if (!empty(DB::select("select * from users where name = '$username' and password = '$password'"))) {
           $user=DB::select("select id from users where name = '$username' and password = '$password'");
          
           $_SESSION["username"] = "$username";
           $request->session()->put('user',$username);

           $brokers = new brokerController;
           $allbroker=$brokers->showall();
           $companies = new companyController;
           $allcompany=$companies->showall();

    $biltys = bilty::get()->toArray();

           
    return view('home')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);
        } else {
          ?><script>       
      alert("wrong username password");          
      </script><?php
          return view('login');
        }
        
    }
  public function show_home()
  {

    

    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();

    $biltys = bilty::get()->toArray();

  return view('main_home')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);


  }
   public function ret(){
    return redirect()->back();
   }
  public function builty_form()
  {

    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();

    return view('create_bilty')->with('companies', $allcompany)->with('brokers', $allbroker);
        //
  }
  public function show()
  {
    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();

    $biltys = bilty::latest('created_at')->get()->toArray();


    return view('list_bilty')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);
        //
  }
  public function selected_for_invoice(Request $request)
  {

    $data = $request->input();

    if (!empty($data))
    {
      $bilties=$_POST['bilty'];
      $tax=$_POST['tax'];
    }
    $imploded_arr = implode(',', $bilties);



    $total=0;
    $i=0;

    $biltys=DB::select("select * from bilties where buid IN ($imploded_arr)");
       // conver stdclass object to arrat
    $biltys=json_decode(json_encode($biltys), true);

    $companies = new companyController;       
    $brokers = new brokerController; 
    $invoice = new invoiceController();

    foreach ($biltys as $bilty)
    {
     $i++;
     $total=$total+$bilty['total_cost'];
   }
    $company=$companies->return_company($biltys[0]['cid']);
    $newinvoice=$invoice->create($i,$total,$company['name'],$tax);
    $invoice_no=$newinvoice;
   $companies->invoiced($biltys[0]['cid'], $total ,$tax);
   

   
   foreach ($biltys as $bilty)
   {
    bilty::where('buid',$bilty['buid'])->Update(['invoiced' => 'yes','iid' => $newinvoice ]);
  }

  $data = array('biltys' => $biltys,'company' => $company ,'tax' => $tax ,'invoice_no' => $invoice_no);

      //   echo "<pre>";
      // print_r($data);
  return view('bill_table')->with('data', $data);

}
public function show_reached()
  {
    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();

    $biltys=DB::select("select * from bilties where r_weight != '0.00' and invoiced ='no'");
       // conver stdclass object to arrat
    $biltys=json_decode(json_encode($biltys), true);


    return view('list_bilty_reached')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);
        //
  }
  public function show_unreached()
  {
    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();

    $biltys=DB::select("select * from bilties where r_weight = '0.00' ");
       // conver stdclass object to arrat
    $biltys=json_decode(json_encode($biltys), true);


    return view('list_bilty')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);
        //
  }
  public function unreached()
  {
    $biltys=DB::select("select * from bilties where r_weight = '0.00'");
       // conver stdclass object to arrat
    $biltys=json_decode(json_encode($biltys), true);

     $total=0;
    foreach ($biltys as $bilty ) {
    $total++;
    }
   return $total;
  }
  public function show_invoiced()
  {
    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();

    $biltys=DB::select("select * from bilties where invoiced = 'yes'");
       // conver stdclass object to arrat
    $biltys=json_decode(json_encode($biltys), true);


    return view('list_bilty_invoiced')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);
        //
  }
  
public function print_bill(Request $request)
{
 $data = $request->input();

 if (!empty($data))
 {

  $bilties=$_POST['bilty'];
  $tax=$_POST['tax'];
  $invoice_no=$_POST['invoice_no'];

}

$imploded_arr = implode(',', $bilties);
$biltys=DB::select("select * from bilties where buid IN ($imploded_arr)");
  // conver stdclass object to arrat
$biltys=json_decode(json_encode($biltys), true);
if (isset($_POST['Company']))
   {

    $companies = new companyController;       
    $company=$companies->return_company($biltys[0]['cid']);
   }
   else
   {
    $companies = new brokerController;       
    $company=$companies->return_broker($biltys[0]['bid']);

   }

$data = array('biltys' => $biltys,'company' => $company ,'tax' => $tax , 'invoice_no' => $invoice_no );

view()->share('data',$data);


if ($_POST['pdf']=='Print_bill') 
{
 $pdf = PDF::loadView('bill')->setPaper('a4', 'potrait');
 return $pdf->download('bill.pdf');
}
else
{
 $pdf = PDF::loadView('invoice')->setPaper('a4', 'potrait');
 return $pdf->download('invoice.pdf');
}



}
public function showall()
{

  $biltys = bilty::get()->toArray();

  return $biltys;
        //
}

public function print_bilty($id)
{

  $bilty = bilty::where('buid',$id)->first();

  view()->share('bilty',$bilty);

  $pdf = PDF::loadView('bilty')->setPaper('a4', 'landscape');
  return $pdf->download('bilty'.$bilty['buid'].'.pdf');

}
public function view($id)
{

  $bilty = bilty::where('buid',$id)->first();

  return view('bilty', ['bilty'=>$bilty]);

}
public function update_form($id)
{

 $id;
 $biltys = bilty::where('buid',$id)->first()->toArray();

 return view('update_bilty_form', ['bilty'=>$biltys]);

}
public function builty_chart()
{
  

  $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
  if (DB::table('bilties')->latest()->first()) {
    $last = DB::table('bilties')->latest()->first();
    $timestamp = strtotime($last->created_at);
    echo $month = date('m', $timestamp);
       echo $year =date('Y',$timestamp);

  }
  else{
    $month=date('m');
    $year=date('Y');

  }
       
      if ($month-5>=0) 
      {
        
        $t_bilties=array();
        $j=0;
        for ($i=$month-5; $i <=$month ; $i++) 
        { 
          $biltys=bilty::whereMonth('created_at', $i)->get();
          $total_bilties=0;
          foreach ($biltys as $b) {
            $total_bilties++; 
          }
          $mon[$j]=$months[$i];
          $t_bilties[$j]=$total_bilties;

          $j++;
          }

        }
         return $data = array('t_bilties' => $t_bilties , 'month' => $mon);

}
public function search(Request $request)
{


  $data = $request->input();
  $page =$data['page'];
  $cid=$data['cid'];
  $bid=$data['bid'];
  $month=$data['month'];
  $buid=$data['buid'];
  $brokers = new brokerController;
  $allbroker=$brokers->showall();
  $companies = new companyController;
  $allcompany=$companies->showall();

  // $biltys=DB::select("select * from bilties where cid = '$id'");
  // conver stdclass object to array
  // $biltys=json_decode(json_encode($biltys), true);


  if ($page == 'list_bilty') 
  {
    if ($cid == 0 ) 
    {
      if ($bid == 0) 
      {
        if ($month == 0) 
        {
          if ($buid == 0) 
          {
           $biltys = bilty::get()->toArray(); 
         }
         else
         {
           $biltys = bilty::where('buid',$buid)->get();
         }
       }
       else
       {
         if ($buid == 0) 
         {
           $biltys = bilty::whereMonth('created_at', $month)->get();
         }
         else
         {
          $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->get();
        }
      }
      
    }
    else
    {
      if ($month == 0) 
      {
        if ($buid == 0) 
        {
         $biltys = bilty::where('bid',$bid)->get(); 
       }
       else
       {
         $biltys = bilty::where('bid', $bid)->where('buid',$buid)->get();

       }
     }
     else
     {
       if ($buid == 0) 
       {
         $biltys = bilty::whereMonth('created_at', $month)->where('bid',$bid)->get();
       }
       else
       {
        $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('bid',$bid)->get();
      }
    }
  }
}

else
{
  if ($bid == 0) 
  {
    if ($month == 0) 
    {
      if ($buid == 0) 
      {
       $biltys = bilty::where('cid',$cid)->get();
     }
     else
     {
       $biltys = bilty::where('cid', $cid)->where('buid',$buid)->get();
     }
   }
   else
   {
     if ($buid == 0) 
     {
       $biltys = bilty::whereMonth('created_at', $month)->where('cid', $cid)->get();
     }
     else
     {
      $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('cid', $cid)->get();
    }
  }

}
else
{
  if ($month == 0) 
  {
    if ($buid == 0) 
    {
     $biltys = bilty::where('bid',$bid)->where('cid',$cid)->get(); 
   }
   else
   {
     $biltys = bilty::where('bid', $bid)->where('buid',$buid)->where('cid',$cid)->get();

   }
 }
 else
 {
   if ($buid == 0) 
   {
     $biltys = bilty::whereMonth('created_at', $month)->where('bid',$bid)->where('cid',$cid)->get();
   }
   else
   {
    $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('bid',$bid)->where('cid',$cid)->get();
  }
}
}
}
return view('list_bilty')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);
}
elseif ($page == 'list_bilty_invoiced') 
{
  if ($cid == 0 ) 
  {
    if ($bid == 0) 
    {
      if ($month == 0) 
      {
        if ($buid == 0) 
        {
         $biltys = bilty::where('invoiced','yes')->get(); 
       }
       else
       {
         $biltys = bilty::where('buid',$buid)->where('invoiced','yes')->get();
       }
     }
     else
     {
       if ($buid == 0) 
       {
         $biltys = bilty::whereMonth('created_at', $month)->where('invoiced','yes')->get();
       }
       else
       {
        $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('invoiced','yes')->get();
      }
    }

  }
  else
  {
    if ($month == 0) 
    {
      if ($buid == 0) 
      {
       $biltys = bilty::where('bid',$bid)->where('invoiced','yes')->get(); 
     }
     else
     {
       $biltys = bilty::where('bid', $bid)->where('buid',$buid)->where('invoiced','yes')->get();

     }
   }
   else
   {
     if ($buid == 0) 
     {
       $biltys = bilty::whereMonth('created_at', $month)->where('bid',$bid)->where('invoiced','yes')->get();
     }
     else
     {
      $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('bid',$bid)->where('invoiced','yes')->get();
    }
  }
}
}
else
{
  if ($bid == 0) 
  {
    if ($month == 0) 
    {
      if ($buid == 0) 
      {
       $biltys = bilty::where('cid',$cid)->where('invoiced','yes')->get();
     }
     else
     {
       $biltys = bilty::where('cid', $cid)->where('buid',$buid)->where('invoiced','yes')->get();
     }
   }
   else
   {
     if ($buid == 0) 
     {
       $biltys = bilty::whereMonth('created_at', $month)->where('cid', $cid)->where('invoiced','yes')->get();
     }
     else
     {
      $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('cid', $cid)->where('invoiced','yes')->get();
    }
  }

}
else
{
  if ($month == 0) 
  {
    if ($buid == 0) 
    {
     $biltys = bilty::where('bid',$bid)->where('cid',$cid)->where('invoiced','yes')->get(); 
   }
   else
   {
     $biltys = bilty::where('bid', $bid)->where('buid',$buid)->where('cid',$cid)->where('invoiced','yes')->get();

   }
 }
 else
 {
   if ($buid == 0) 
   {
     $biltys = bilty::whereMonth('created_at', $month)->where('bid',$bid)->where('cid',$cid)->where('invoiced','yes')->get();
   }
   else
   {
    $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('bid',$bid)->where('cid',$cid)->where('invoiced','yes')->get();
  }
}
}
}
return view('list_bilty_invoiced')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);
}
else
{
  if ($cid == 0 ) 
  {
    if ($bid == 0) 
    {
      if ($month == 0) 
      {
        if ($buid == 0) 
        {
         $biltys = bilty::where('invoiced','no')->where('r_weight','!=',0)->get(); 
       }
       else
       {
         $biltys = bilty::where('buid',$buid)->where('invoiced','no')->where('r_weight','!=',0)->get();
       }
     }
     else
     {
       if ($buid == 0) 
       {
         $biltys = bilty::whereMonth('created_at', $month)->where('invoiced','no')->where('r_weight','!=',0)->get();
       }
       else
       {
        $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('invoiced','no')->where('r_weight','!=',0)->get();
      }
    }

  }
  else
  {
    if ($month == 0) 
    {
      if ($buid == 0) 
      {
       $biltys = bilty::where('bid',$bid)->where('invoiced','no')->where('r_weight','!=',0)->get(); 
     }
     else
     {
       $biltys = bilty::where('bid', $bid)->where('buid',$buid)->where('invoiced','no')->where('r_weight','!=',0)->get();

     }
   }
   else
   {
     if ($buid == 0) 
     {
       $biltys = bilty::whereMonth('created_at', $month)->where('bid',$bid)->where('invoiced','no')->where('r_weight','!=',0)->get();
     }
     else
     {
      $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('bid',$bid)->where('invoiced','no')->where('r_weight','!=',0)->get();
    }
  }
}
}
else
{
  if ($bid == 0) 
  {
    if ($month == 0) 
    {
      if ($buid == 0) 
      {
       $biltys = bilty::where('cid',$cid)->where('invoiced','no')->where('r_weight','!=',0)->get();
     }
     else
     {
       $biltys = bilty::where('cid', $cid)->where('buid',$buid)->where('invoiced','no')->where('r_weight','!=',0)->get();
     }
   }
   else
   {
     if ($buid == 0) 
     {
       $biltys = bilty::whereMonth('created_at', $month)->where('cid', $cid)->where('invoiced','no')->where('r_weight','!=',0)->get();
     }
     else
     {
      $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('cid', $cid)->where('invoiced','no')->where('r_weight','!=',0)->get();
    }
  }

}
else
{
  if ($month == 0) 
  {
    if ($buid == 0) 
    {
     $biltys = bilty::where('bid',$bid)->where('cid',$cid)->where('invoiced','no')->where('r_weight','!=',0)->get(); 
   }
   else
   {
     $biltys = bilty::where('bid', $bid)->where('buid',$buid)->where('cid',$cid)->where('invoiced','no')->where('r_weight','!=',0)->get();

   }
 }
 else
 {
   if ($buid == 0) 
   {
     $biltys = bilty::whereMonth('created_at', $month)->where('bid',$bid)->where('cid',$cid)->where('invoiced','no')->where('r_weight','!=',0)->get();
   }
   else
   {
    $biltys = bilty::whereMonth('created_at', $month)->where('buid',$buid)->where('bid',$bid)->where('cid',$cid)->where('invoiced','no')->where('r_weight','!=',0)->get();
  }
}
}
}
return view('list_bilty_reached')->with('companies', $allcompany)->with('brokers', $allbroker)->with('biltys', $biltys);
}
}
public function edit($id)
{
  $biltys = bilty::where('buid',$id)->first()->toArray();
      // echo "<pre>";
      // print_r($userdata);

      // echo $id;
      // die();
  return view('edit_biltys', ['biltys'=>$biltys]);

}

public function update(Request $request)
{

  $data=$request->input();
  try {
   bilty::where('buid',$data['buid'])->Update(['receiving_company' => $data['receiving_company'] , 'c_weight' => $data['weight'] , 'r_weight' => $data['r_weight'] , 'c_rate' => $data['c_rate'] , 'departure' => $data['departure'] , 'destination' => $data['destination'] , 'builty_no' => $data['builty_no'] , 'car_no' => $data['car_no'] , 'driver_name' => $data['driver_name'] , 'cnic' => $data['cnic']  ,'b_rate' =>  $data['b_rate']]);
     ?><script>       
    alert("bilty updated successfully");          
    </script><?php  

 } catch (\Exception $exp) {
   ?><script>       
    alert("<?php $exp->getmessage() ?>");          
    </script><?php  
    return redirect()->back();
  }
  catch(QueryException $ex)
            {
              $request->session()->flash('alert-danger',$ex->getmessage());
              return redirect()->back();
            }
   $request->session()->flash('alert-success', 'bilty updated successfully!');
    return redirect()->back();


    $biltys = bilty::get()->toArray();

    return view('list_biltys', ['biltys'=>$biltys]);
        // echo "<pre>";
        // print_r($postdata);
        // die();
  }
  public function Reached(Request $request)
  {

    
    try {
      $data=$request->input();
      bilty::where('buid',$data['buid'])->Update(['r_weight' => $data['r_weight']]);
    $bilty = bilty::where('buid',$data['buid'])->first();
    $pay_to_broker=$bilty['b_rate']*$data['r_weight'];
   $broker = broker::where('bid',$bilty['bid'])->first();
    $cost=$broker['total_cost']+$pay_to_broker;
    broker::where('bid',$bilty['bid'])->Update(['total_cost' => $cost ]);
    bilty::where('buid',$data['buid'])->Update(['pay_to_broker' => $pay_to_broker]);
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
    $request->session()->flash('alert-success', 'Bilty Reached successfully!');
    return redirect()->back();
  }
  public function delete($id)
  {
    bilty::where('buid',$id)->delete();
    $bilty = bilty::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

    return redirect()->back();
  }
}
