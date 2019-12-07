<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\ledger;
use App\voucher;
use App\company;
use App\broker;
use Illuminate\Database\QueryException;
use PDF;

class ledgerController extends Controller
{
 public function create($description , $iid , $credit , $debit )
 {


  {


   try
   {
    $newledger = new ledger();
    $newledger->description = $description;
    $newledger->vid = $iid;
    $newledger->debit = $debit;
    $newledger->credit = $credit;


    $newledger->save();
    notify()->success('bilty added successfully!');
    

  }
  catch(\Exception $exp)
  {
    $request->session()->flash('alert-danger', $exp->getmessage());
             return redirect()->back();
    }
    session()->flash('alert-success', 'ledger Added successfully!');
    return redirect()->back();

    }
    

  } 
  public function homechart()
  {
    

    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
      
        // echo "<pre>";
        // print_r($months);
       if (DB::table('ledgers')->latest()->first()) {
        $last =  DB::table('ledgers')->latest()->first();
         $timestamp = strtotime($last->created_at);
        echo $month = date('m', $timestamp);
       echo $year =date('Y',$timestamp);
       }
       else
       {
        $month=date('m');
    $year=date('Y');
       }

       
        $ledgers=array();
        $mon=array();
        $debit=array();
        $credit=array();

      if ($month-5>0) {
        $j=0;
        for ($i=$month-5; $i <=$month ; $i++) { 
          $m=$i;
          $ledger=ledger::whereMonth('created_at', $m)->whereYear('created_at',$year)->get();
          $total_debit=0;
          $total_credit=0;
          $ledmonth= "";
          foreach ($ledger as $led) {
            $total_debit=$total_debit+$led['debit'];   
            $total_credit=$total_credit+$led['credit']; 

            
          }
          $mon[$j]=$months[$i];
          $debit[$j]=$total_debit;
          $credit[$j]=$total_credit;
          $j++;
        }
    }
      else
      {
        $year--;
       $j=0;
        for ($i=$month-5+12; $i <=$month ; $i++) { 
          $m=$i;
          $ledger=ledger::whereMonth('created_at', $m)->whereYear('created_at',$year)->get();
          $total_debit=0;
          $total_credit=0;
          $ledmonth= "";
          foreach ($ledger as $led) {
            $total_debit=$total_debit+$led['debit'];   
            $total_credit=$total_credit+$led['credit']; 

            
          }
          if ($i==12) {
            $i=0;
            $year++;
          }
          $mon[$j]=$months[$i];
          $debit[$j]=$total_debit;
          $credit[$j]=$total_credit;
          $j++;
        }
      }
      return $data = array('debit' => $debit,'credit' => $credit , 'month' => $mon);
  }
public function pr_chart() //payable receiveable chart
{
  
  $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
  if (DB::table('companies')->latest()->first()&&DB::table('brokers')->latest()->first()) {
    $last_receiveable = DB::table('companies')->latest()->first();
  $last_payable = DB::table('brokers')->latest()->first();
  $timestamp = strtotime($last_receiveable->created_at);

       echo $month = date('m', $timestamp);
       echo $year =date('Y',$timestamp);
    # code...
  }
  else{
     $month=date('m');
    $year=date('Y');
  }
       

       $mon=array();
       $payable=array();
       $receiveable=array();

      if ($month-5>0) {
        
        $j=0;
        for ($i=$month-5; $i <=$month ; $i++) { 
          $receive=company::whereMonth('created_at', $i)->whereYear('created_at',$year)->get();
          $pay=broker::whereMonth('created_at', $i)->get();
          $total_receiveable=0;
          $total_payable=0;
          $ledmonth= "";
          foreach ($receive as $r) {
           $total_receiveable=$total_receiveable+($r['total_cost']-$r['received_cost']);   
              
          }
          foreach ($pay as $p) {  
            $total_payable=$total_payable+($p['total_cost']-$p['received_cost']);  
            
          }
          $mon[$j]=$months[$i];
          $payable[$j]=$total_payable;
          $receiveable[$j]=$total_receiveable;
          $j++;
        }


 
   }
   else
   {
       $year--;
        $j=0;
        for ($i=$month-5; $i <=$month ; $i++) { 
          $receive=company::whereMonth('created_at', $i)->whereYear('created_at',$year)->get();
          $pay=broker::whereMonth('created_at', $i)->whereYear('created_at',$year)->get();
          $total_receiveable=0;
          $total_payable=0;
          $ledmonth= "";
          foreach ($receive as $r) {
           $total_receiveable=$total_receiveable+($r['total_cost']-$r['received_cost']);   
              
          }
          foreach ($pay as $p) {  
            $total_payable=$total_payable+($p['total_cost']-$p['received_cost']);  
            
          }

          if ($i==12) {
            $i=0;
            $year++;
          }
          $mon[$j]=$months[$i];
          $payable[$j]=$total_payable;
          $receiveable[$j]=$total_receiveable;
          $j++;
        }
   }
 return $data = array('payable' => $payable,'receiveable' => $receiveable , 'month' => $mon);
}
  public function total_debit()
  {
    $ledgers = ledger::get()->toArray();
    $total_debit=0;
   foreach ($ledgers as $ledger ) {
    $total_debit=$total_debit+$ledger['debit'];
   }

   return $total_debit;
    
  }
  public function total_credit()
  {
    $ledgers = ledger::get()->toArray();
    $total_credit=0;
   foreach ($ledgers as $ledger ) {
       $total_credit=$total_credit+$ledger['credit'];
   }

   return $total_credit;
    
  }
  public function show()
  {
    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();
     $employees = new employeeController;
    $allemployee=$employees->showall();

    $ledgers =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('invoices', 'invoices.iid', '=', 'vouchers.iid')
    ->join('companies' , 'invoices.c_name','=','companies.name')
    ->select('ledgers.Description','invoices.c_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','invoices.iid','invoices.total_cost','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','companies.PTN','companies.NTN','companies.phone','companies.address','companies.cid')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
    $ledgers1 =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('brokers', 'brokers.bid', '=', 'vouchers.bid')
    ->select('ledgers.Description','brokers.name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','brokers.bid','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','brokers.PTN','brokers.NTN','brokers.phone','brokers.address')
    ->get();
    $ledgers1=json_decode(json_encode($ledgers1), true);
    $ledgers2 =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('employees', 'employees.eid', '=', 'vouchers.eid')
    ->select('ledgers.Description','employees.employee_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','employees.eid','vouchers.employee_operation','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','vouchers.bid')
    ->get();
    $ledgers2=json_decode(json_encode($ledgers2), true);

    $ledger = array_merge($ledgers,$ledgers1,$ledgers2);
    return view('list_ledger')->with('companies', $allcompany)->with('brokers', $allbroker)->with('employees', $allemployee)->with('ledgers', $ledger)->with('type', 'all')->with('print', 'no');
        //
  }
  public function show_companies()
  {
    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();
      $employees = new employeeController;
    $allemployee=$employees->showall();
    $ledgers =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('invoices', 'invoices.iid', '=', 'vouchers.iid')
    ->join('companies' , 'invoices.c_name','=','companies.name')
    ->select('ledgers.Description','invoices.c_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','invoices.iid','invoices.total_cost','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','companies.PTN','companies.NTN','companies.phone','companies.address','companies.cid')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
       // echo "<pre>";
       // print_r($ledgers);

    return view('list_ledger')->with('companies', $allcompany)->with('brokers', $allbroker)->with('employees', $allemployee)->with('ledgers', $ledgers)->with('type', 'company')->with('print', 'no');
        //
  }
  public function show_brokers()
  {
    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();
      $employees = new employeeController;
    $allemployee=$employees->showall();
    $ledgers =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('brokers', 'brokers.bid', '=', 'vouchers.bid')
    ->select('ledgers.Description','brokers.name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','brokers.bid','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','brokers.PTN','brokers.NTN','brokers.phone','brokers.address')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
// echo "<pre>";
//       print_r($ledgers);

    return view('list_ledger')->with('companies', $allcompany)->with('brokers', $allbroker)->with('employees', $allemployee)->with('ledgers', $ledgers)->with('type', 'broker')->with('print', 'no');
        //
  }
  public function show_employees()
  {
    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();
      $employees = new employeeController;
    $allemployee=$employees->showall();
    $ledgers =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('employees', 'employees.eid', '=', 'vouchers.eid')
    ->select('ledgers.Description','employees.employee_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','employees.eid','vouchers.employee_operation','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','vouchers.bid')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
// echo "<pre>";
//print_r($ledgers);

    return view('list_ledger')->with('companies', $allcompany)->with('brokers', $allbroker)->with('employees', $allemployee)->with('ledgers', $ledgers)->with('type', 'employee')->with('print', 'no');
        //
  }
  public function search(Request $request)
  {

    $data = $request->input();

    $type=$data['type'];
    $month=$data['month'];

    $brokers = new brokerController;
    $allbroker=$brokers->showall();
    $companies = new companyController;
    $allcompany=$companies->showall();
      $employees = new employeeController;
    $allemployee=$employees->showall();
if($data['type']=='company')
{
  if ($month==0) {
    $ledgers =DB::table('vouchers')
    ->join('invoices', 'invoices.iid', '=', 'vouchers.iid')
    ->where('invoices.c_name', '=', $data['c_name'])
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('companies' , 'invoices.c_name','=','companies.name')
    ->select('ledgers.Description','invoices.c_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','invoices.iid','invoices.total_cost','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','companies.PTN','companies.NTN','companies.phone','companies.address','companies.cid')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
  }
  else
  {
    $ledgers =DB::table('vouchers')
    ->join('invoices', 'invoices.iid', '=', 'vouchers.iid')
    ->where('invoices.c_name', '=', $data['c_name'])
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->whereMonth('ledgers.created_at', $month)
    ->join('companies' , 'invoices.c_name','=','companies.name')
    ->select('ledgers.Description','invoices.c_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','invoices.iid','invoices.total_cost','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','companies.PTN','companies.NTN','companies.phone','companies.address','companies.cid')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
  }

}
elseif ($data['type']=='broker') {

   if ($month==0) {
     
   $ledgers =DB::table('vouchers')
    ->join('brokers', 'brokers.bid', '=', 'vouchers.bid')
    ->where('brokers.name', $data['b_name'])
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->select('ledgers.Description','brokers.name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','brokers.bid','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','brokers.PTN','brokers.NTN','brokers.phone','brokers.address')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);

   }
   else
   {

   $ledgers =DB::table('vouchers')
    ->join('brokers', 'brokers.bid', '=', 'vouchers.bid')
    ->where('brokers.name', $data['b_name'])
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->whereMonth('ledgers.created_at', $month)
    ->select('ledgers.Description','brokers.name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','brokers.bid','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','brokers.PTN','brokers.NTN','brokers.phone','brokers.address')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
   }

}
elseif ($data['type']=='employee') {
   if ($month==0) {
       $ledgers =DB::table('vouchers')
    ->join('employees', 'employees.eid', '=', 'vouchers.eid')
    ->where('employees.employee_name', $data['e_name'])
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->select('ledgers.Description','employees.employee_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','employees.eid','vouchers.employee_operation','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','vouchers.bid')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
   }
   else{
       $ledgers =DB::table('vouchers')
    ->join('employees', 'employees.eid', '=', 'vouchers.eid')
    ->where('employees.employee_name', $data['e_name'])
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
        ->whereMonth('ledgers.created_at', $month)
    ->select('ledgers.Description','employees.employee_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','employees.eid','vouchers.employee_operation','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','vouchers.bid')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
   }

}
else{
$ledgers3 =DB::table('vouchers')
    ->join('invoices', 'invoices.iid', '=', 'vouchers.iid')
    ->where('invoices.c_name', '=', $data['c_name'])
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('companies' , 'invoices.c_name','=','companies.name')
    ->select('ledgers.Description','invoices.c_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','invoices.iid','invoices.total_cost','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','companies.PTN','companies.NTN','companies.phone','companies.address','companies.cid')
    ->get();
    $ledgers3=json_decode(json_encode($ledgers3), true);
   $ledgers1 =DB::table('vouchers')
    ->join('brokers', 'brokers.bid', '=', 'vouchers.bid')
    ->where('brokers.name', $data['b_name'])
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->select('ledgers.Description','brokers.name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','brokers.bid','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','brokers.PTN','brokers.NTN','brokers.phone','brokers.address')
    ->get();
    $ledgers1=json_decode(json_encode($ledgers1), true);
    $ledgers2 =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->join('employees', 'employees.eid', '=', 'vouchers.eid')
    ->select('ledgers.Description','employees.employee_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','employees.eid','vouchers.employee_operation','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','vouchers.bid')
    ->get();
    $ledgers2=json_decode(json_encode($ledgers2), true);

    $ledgers = array_merge($ledgers3,$ledgers1,$ledgers2);
}
  return view('list_ledger')->with('companies', $allcompany)->with('brokers', $allbroker)->with('employees', $allemployee)->with('ledgers', $ledgers)->with('type', $data['type'])->with('print', 'yes');
        //
  }
  public function showall()
  {

    $ledgers = ledger::get()->toArray();

    return $ledgers;
        //
  }
 public function print_ledger(Request $request)
 {
 $data = $request->input();

 if (!empty($data))
 {
  $ledger=$_POST['ledger'];
 }

  $imploded_arr = implode(',', $ledger);

   if($data['type']=='company')
{
  
    $ledgers =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->wherein('ledgers.lid', $ledger)
    ->join('invoices', 'invoices.iid', '=', 'vouchers.iid')
    ->join('companies' , 'invoices.c_name','=','companies.name')
    ->select('ledgers.Description','invoices.c_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','invoices.iid','invoices.total_cost','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','companies.PTN','companies.NTN','companies.phone','companies.address','companies.cid','vouchers.type')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
}
elseif ($data['type']=='broker') {
  $ledgers =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->wherein('ledgers.lid', $ledger)
    ->join('brokers', 'brokers.bid', '=', 'vouchers.bid')
    ->select('ledgers.Description','brokers.name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','brokers.bid','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','brokers.PTN','brokers.NTN','brokers.phone','brokers.address','vouchers.type')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
}
elseif ($data['type']=='employee') {
     $ledgers =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->wherein('ledgers.lid', $ledger)
    ->join('employees', 'employees.eid', '=', 'vouchers.eid')
    ->select('ledgers.Description','employees.employee_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','employees.eid','vouchers.employee_operation','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','vouchers.bid','vouchers.type')
    ->get();
    $ledgers=json_decode(json_encode($ledgers), true);
}
else{
   
    $ledgers1 =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->wherein('ledgers.lid', $ledger)
    ->join('invoices', 'invoices.iid', '=', 'vouchers.iid')
    ->join('companies' , 'invoices.c_name','=','companies.name')
    ->select('ledgers.Description','invoices.c_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','invoices.iid','invoices.total_cost','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','companies.PTN','companies.NTN','companies.phone','companies.address','companies.cid')
    ->get();
    $ledgers1=json_decode(json_encode($ledgers1), true);
    $ledgers2 =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->wherein('ledgers.lid', $ledger)
    ->join('brokers', 'brokers.bid', '=', 'vouchers.bid')
    ->select('ledgers.Description','brokers.name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','brokers.bid','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','brokers.PTN','brokers.NTN','brokers.phone','brokers.address')
    ->get();
    $ledgers2=json_decode(json_encode($ledgers2), true);
    $ledgers3 =DB::table('vouchers')
    ->join('ledgers', 'ledgers.vid', '=', 'vouchers.id')
    ->wherein('ledgers.lid', $ledger)
    ->join('employees', 'employees.eid', '=', 'vouchers.eid')
    ->select('ledgers.Description','employees.employee_name','ledgers.updated_at','ledgers.debit', 'ledgers.credit','employees.eid','vouchers.employee_operation','vouchers.vid','vouchers.payee','vouchers.type','ledgers.lid','vouchers.bid')
    ->get();
    $ledgers3=json_decode(json_encode($ledgers3), true);

    $ledgers = array_merge($ledgers1,$ledgers2,$ledgers3);
}

//echo "<pre>";
//print_r($ledgers);

  //return view('ledger')->with('ledger', $ledgers);
        //

view()->share('ledger', $ledgers);


  $pdf = PDF::loadView('ledger')->setPaper('a4', 'potrait');
  return $pdf->download('ledger.pdf');




}
 public function view($id)
 {

  $ledgers = ledger::where('bid',$id)->first()->toArray();

  return view('view_ledgers', ['ledgers'=>$ledgers]);

 }
public function return_ledger($id)
 {

 $ledger = ledger::where('bid',$id)->first()->toArray();

 return $ledger;

 }

}
