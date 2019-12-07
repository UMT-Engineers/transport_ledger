<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\QueryException;
use App\company;

class companyController extends Controller
{
         public function create(Request $request)
    {

        $data = $request->input();

        if (!empty($data))
        {


           try
           {
            $newcompany = new company();
            $newcompany->name = $data['name'];
            $newcompany->phone = $data['phone'];
            $newcompany->address = $data['address'];
            $newcompany->PTN = $data['PTN'];
            $newcompany->NTN = $data['NTN'];
            $newcompany->save();
            notify()->success('company added successfully!');

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
    $request->session()->flash('alert-success', 'User Added successfully!');
    return redirect()->back();
           
        }
        else
        {
            return redirect()->back();
        }
        
    } 
    public function show()
    {

       $companys = company::get()->toArray();

       return view('list_companies', ['companies'=>$companys]);
        //
    }
    public function showall()
    {

        $companys = company::get()->toArray();

       return $companys;
        //
    }
     public function showall_admin()
    {

       $company = company::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

       return view('list_companies', ['companys'=>$company]);
        //
    }
    public function payment_received($cid,$payment)
  {
    $companys = company::where('cid',$bid)->first();
    $received=$payment;
    $received=$received+$companys['received_cost'];
    $result=company::where('cid',$bid)->Update(['received_cost' => $received ]);
 return $result;
  }
    public function total_receiveable()
  {
    $companys = company::get()->toArray();
    $total_receiveable=0;
   foreach ($companys as $company ) {
       $total_receiveable=$total_receiveable+($company['total_cost']-$company['received_cost']);
   }
   return $total_receiveable;
   }
     public function view($id)
    {

        $companys = company::where('cid',$id)->first()->toArray();

       return view('view_companys', ['companys'=>$companys]);
        
    }
    public function update_form($id)
   {

   $company = company::where('cid',$id)->first()->toArray();

    return view('update_company', ['company'=>$company]);

   }
      public function return_company($id)
    {

        $company = company::where('cid',$id)->first()->toArray();

       return $company;
        
    }
    public function edit($id)
    {
        $companys = company::where('cid',$id)->first()->toArray();
      // echo "<pre>";
      // print_r($userdata);

      // echo $id;
      // die();
      return view('edit_companys', ['companys'=>$companys]);
      
    }
    public function update(Request $request)
    {

      $data=$request->input();
      try {


        company::where('cid',$data['cid'])->Update(['name' => $data['name'],  'phone'=>$data['phone'],'address'=>$data['address'],  'PTN'=>$data['PTN'],'NTN'=>$data['NTN']]);
        $companys = company::get()->toArray();
      } catch (Exception $e) {
        ?><script>       
          alert("<?php $exp->getmessage() ?>");          
          </script><?php  
          return redirect()->back();
        }
        ?><script>       
          alert("company updated successfully");          
          </script><?php  

          return view('list_companies', ['companies'=>$companys]);

        // echo "<pre>";
        // print_r($postdata);
        // die();
    }
  
     public function invoiced($id , $cost, $tax)
    {
      try {
        $company = company::where('cid',$id)->first()->toArray();
        $tax_value = ($cost/100)*$tax;
          $total_cost=$company['total_cost'];
          $total_cost=$total_cost+($cost+$tax_value);
          company::where('cid',$id)->Update(['total_cost' => $total_cost]);

          notify()->success('company update successfully!');
    
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
          $request->session()->flash('alert-success', 'User update successfully!');
    return redirect()->back();

        // echo "<pre>";
        // print_r($postdata);
        // die();
  }
    public function delete($id)
    {
        company::where('cid',$id)->delete();
         $company = company::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

       return view('list_companys', ['companys'=>$company]);
    }
}
