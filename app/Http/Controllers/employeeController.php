<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\employee;

class employeeController extends Controller
{
     public function create(Request $request)
    {

        $data = $request->input();

        if (!empty($data))
        {


           try
           {
            $newemployee = new employee();
            $newemployee->employee_name = $data['name'];
            $newemployee->salary = $data['salary'];
            $newemployee->address = $data['Address'];
            $newemployee->designation = $data['designation'];
            $newemployee->phone = $data['phone'];
            $newemployee->save();
            notify()->success('employee added successfully!');

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
    $request->session()->flash('alert-success', 'User Added successfully!');
    return redirect()->back();

    }
    else
    {
    	echo "error";
      return redirect()->back();
    }

  }
    public function show()
    {

       $employees = employee::get()->toArray();

       return view('create_employee', ['employees'=>$employees]);
        //
    }
    public function showall()
    {

        $employees = employee::get()->toArray();

       return $employees;
        //
    }
     public function showall_admin()
    {

       $employee = employee::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

       return view('list_employees', ['employees'=>$employee]);
        //
    }
     public function view($id)
    {

        $employees = employee::where('eid',$id)->first()->toArray();

       return view('view_employees', ['employees'=>$employees]);
        
    }
       public function update_form($id)
   {

   $employee = employee::where('eid',$id)->first()->toArray();
   $employees = employee::get()->toArray();

   return view('update_employee')->with('employee', $employee)->with('employees', $employees);


   }
     public function return_employee($id)
    {

       $employee = employee::where('eid',$id)->first()->toArray();

       return $employee;
        
    }
    public function edit($id)
    {
        $employees = employee::where('eid',$id)->first()->toArray();
      // echo "<pre>";
      // print_r($userdata);

      // echo $id;
      // die();
      return view('edit_employees', ['employees'=>$employees]);
      
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
          employee::where('eid',$data['eid'])->Update(['employee_name' => $data['name'],  'salary'=>$data['salary'],'address'=>$data['Address'],  'designation'=>$data['designation'],'phone'=>$data['phone']]);
          
             notify()->success('employee update successfully!');

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

        
  $employees = employee::get()->toArray();
       return view('create_employee', ['employees'=>$employees]);

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
        employee::where('bid',$id)->delete();
         $employee = employee::get()->toArray();

      //   echo "<pre>";
      // print_r($food);

       return view('list_employees', ['employees'=>$employee]);
    }
}
