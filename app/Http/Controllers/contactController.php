<?php

namespace App\Http\Controllers;

use App\contact_us;
use Illuminate\Http\Request;

class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        {
        

        $data = $request->input();

        if (!empty($data))
        {
           

            try
            {
                $newcontact_us = new contact_us();
                $newcontact_us->first_name = $data['first_name'];
                $newcontact_us->last_name = $data['last_name'];
                $newcontact_us->subject = $data['subject'];
                $newcontact_us->phone = $data['phone'];
                $newcontact_us->messege = $data['message'];
                $newcontact_us->save();

            }
            catch(\Exception $exp)
            {
                ?><script>       
                    alert("<?php echo $exp->getmessage()?>");          
                    </script><?php  
                    return redirect()->back();
            }
            ?><script>       
            alert("your request submitted");          
            </script><?php  
            return redirect()->back();

            }
                else
                {
                    ?><script>       
                    alert("field is empty");          
                    </script><?php  
                }

            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contact_controller  $contact_controller
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $message = contact_us::get()->toArray();

       return view('list_message', ['messages'=>$message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contact_controller  $contact_controller
     * @return \Illuminate\Http\Response
     */
    public function edit(contact_controller $contact_controller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contact_controller  $contact_controller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contact_controller $contact_controller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contact_controller  $contact_controller
     * @return \Illuminate\Http\Response
     */
    public function destroy(contact_controller $contact_controller)
    {
        //
    }
}
