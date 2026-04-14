<?php
namespace App\Http\Controllers\Owner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\User;
use App\Models\Unit;
use App\Models\ContactBclean;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use Illuminate\Support\Carbon;


class ServiceController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
          //$services=DB::table('services')->where('owner_id',Auth::id())->orderBy('id','desc')->paginate(20);  
         $currentDate = Carbon::now()->toDateString();
          $services=DB::table('services')->where('owner_id',Auth::id())->whereDate('departure_date', '>=', $currentDate)
        ->orderBy('arrival_date', 'asc')
        ->paginate(20); 
          return view('owner/services', compact('services')); 
    }


    public function owner_get_date($id = null)
    {
        $currentDate = Carbon::now()->toDateString();
        if (isset($id) && !is_numeric($id)) {
            $services=DB::table('services')->where('owner_id',Auth::id())->whereDate('departure_date', '>=', $currentDate)
        ->orderBy('arrival_date', 'asc')
        ->paginate(20);  
            return view('owner/services', compact('services')); 
        }

        $services_array=array();
        if (isset($id)) {
            $services_array[$id]=DB::table('services')->where('unit', $id)->where('owner_id',Auth::id())->whereDate('departure_date', '>=', $currentDate)
        ->orderBy('arrival_date', 'asc')
        ->paginate(20); 
        }else{
            $unit_type=unit_type_owner_array(Auth::id());
            foreach ($unit_type as $key => $unit) {
               $services_array[$unit->id]=DB::table('services')->where('unit', $unit->id)->where('owner_id',Auth::id())->whereDate('departure_date', '>=', $currentDate)
        ->orderBy('arrival_date', 'asc')
        ->paginate(20);   
           }

       }
       return view('owner/unit_services', compact('services_array','id'));  
   }

   public function owner_edit_date($id = null)
   {
    $currentDate = Carbon::now()->toDateString();
     if (isset($id) && !is_numeric($id)) {
        $services=DB::table('services')->where('owner_id',Auth::id())->whereDate('departure_date', '>=', $currentDate)
        ->orderBy('arrival_date', 'asc')
        ->paginate(20);   
        return view('owner/services_edit_all', compact('services')); 
    }

    $services_array=array();
    if (isset($id)) {
        $services_array[$id]=DB::table('services')->where('unit', $id)->where('owner_id',Auth::id())->whereDate('departure_date', '>=', $currentDate)
        ->orderBy('arrival_date', 'asc')
        ->paginate(20); 
    }else{
        $unit_type=unit_type_owner_array(Auth::id());
        foreach ($unit_type as $key => $unit) {
         $services_array[$unit->id]=DB::table('services')->where('unit', $unit->id)->where('owner_id',Auth::id())->whereDate('departure_date', '>=', $currentDate)
        ->orderBy('arrival_date', 'asc')
        ->paginate(20); 
     }

 }
 return view('owner/edit_unit_services', compact('services_array','id'));  
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner/add_service'); 
    }

    public function owner_create_date($id)
    {
        return view('owner/add_service', compact('id')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $servicsfields = $request->post();
        $errors = [];    

        foreach ($servicsfields['service'] as $key => $service) {
            $unit_id = $service['unit'];
            $Unitdata = Unit::find($unit_id);
            $arrivalDateTime = '';
            $departureDateTime = '';

            if (!isset($service['checkin'])) {
                $arrivalDateTime = date('Y-m-d H:i:s', strtotime($service['arrival_date'] . ' ' . $Unitdata->checkin));
            } else {
                $arrivalDateTime = date('Y-m-d H:i:s', strtotime($service['arrival_date'] . ' ' . $service['arrival_time']));
            }

            if (!isset($service['checkout'])) {
                $departureDateTime = date('Y-m-d H:i:s', strtotime($service['departure_date'] . ' ' . $Unitdata->checkout));
            } else {
                $departureDateTime = date('Y-m-d H:i:s', strtotime($service['departure_date'] . ' ' . $service['departure_time']));
            }

            if ($departureDateTime < $arrivalDateTime) {
                $errors[$key] = "Checkout Date ". $departureDateTime." must be greater than Arrival Date ".$arrivalDateTime." for " . $service['guest_name'];
            }
        }
        if (!empty($errors)) {
            echo json_encode(['status' => 'unsuccess','errors' => $errors]);
            exit();
        } 
     /***************************************** Check here Checkout Date & Arrival Date will be unique in Array*****************************************************/
        $servicedata=array();
        foreach ($servicsfields['service'] as $key => $service) {
            $unit_id=$service['unit'];
            $Unitdata = Unit::find($unit_id);

            $arrival_time=$service['arrival_time'];
            $departure_time=$service['departure_time'];


            if (!isset($service['checkin'])) {
                $arrival_time=$Unitdata->checkin;
            }
            if (!isset($service['checkout'])) {
                $departure_time=$Unitdata->checkout;
            }

            $servicsfields['service'][$key]['unit_arrival_time']=$Unitdata->checkin;
            $servicsfields['service'][$key]['unit_departure_time']=$Unitdata->checkout;


            $servicsfields['service'][$key]['arrival_date']= date('Y-m-d H:i:s', strtotime($service['arrival_date'] . ' ' . $arrival_time));
            $servicsfields['service'][$key]['departure_date']=date('Y-m-d H:i:s', strtotime($service['departure_date'] . ' ' . $departure_time));
            $servicsfields['service'][$key]['arrival_time']= date('H:i:s', strtotime($arrival_time));
            $servicsfields['service'][$key]['departure_time']=date('H:i:s', strtotime($departure_time));

            $servicedata[$key]['arrival_date']= date('Y-m-d H:i:s', strtotime($service['arrival_date'] . ' ' . $arrival_time));
            $servicedata[$key]['departure_date']= date('Y-m-d H:i:s', strtotime($service['departure_date'] . ' ' . $departure_time));
        }

       /* foreach ($servicedata as $key => $entry) {
            $arrivalDate = $entry['arrival_date'];
            $departureDate = $entry['departure_date'];
            foreach ($servicedata as $otherKey => $otherEntry) {
                if ($otherKey !== $key) {
                    $otherArrival = $otherEntry['arrival_date'];
                    $otherDeparture = $otherEntry['departure_date'];
                    if (($otherArrival >= $arrivalDate && $otherArrival <= $departureDate) ||
                        ($otherDeparture >= $arrivalDate && $otherDeparture <= $departureDate)
                    ) {
                        $errors[$key] = "Duplicate Entries found between the specified Arrival Date ($arrivalDate) and Checkout Date ($departureDate)";
                    break;
                }
            }
        }
    }*/

    
// Convert dates to \DateTime objects and store them with their original keys
$entries = array();
foreach ($servicedata as $key => $entry) {
    $entries[$key] = array(
        'arrival_date' => new \DateTime($entry['arrival_date']),
        'departure_date' => new \DateTime($entry['departure_date'])
    );
}
// Check if each arrival_date is greater than the previous departure_date
$previousDeparture = null;
foreach ($entries as $key => $entry) {
    $currentArrival = $entry['arrival_date'];
    if ($previousDeparture !== null) {
        // Check if the current arrival_date is not greater than the previous departure_date
        if ($currentArrival < $previousDeparture) {
            $errors[$key] = "Error: Arrival Date ({$currentArrival->format('Y-m-d H:i:s')}) must be greater than the previous Checkout Date ({$previousDeparture->format('Y-m-d H:i:s')})";
        }
    }
    // Update the previous Checkout date to the current entry's Checkout date
    $previousDeparture = $entry['departure_date'];
}


    if (!empty($errors)) {
        echo json_encode(['status' => 'unsuccess', 'errors' => $errors]);
        exit();
    }


    /***************************************** Check here Checkout Date & Arrival Date will be unique in Databse*****************************************************/
    foreach ($servicsfields['service'] as $key => $entry) { 
        $unit_id=$service['unit'];
        $Unitdata = Unit::find($unit_id); 
        $checkinTime=$Unitdata->checkin; 
        $checkoutTime=$Unitdata->checkout;    
        $arrivalDate = $entry['arrival_date'];
        $departureDate = $entry['departure_date'];
        // $conflicts =Service::where('unit', $entry['unit'])
        // ->where('arrival_date', '>=', $entry['arrival_date'])
        // ->where('departure_date', '<=', $entry['departure_date'])
        // ->exists();

        $conflicts = Service::where('unit', $entry['unit'])->where(function ($query) use ($arrivalDate, $departureDate) {
            $query->where('arrival_date', '<=', $arrivalDate)
            ->where('departure_date', '>=', $arrivalDate)
            ->orWhere(function ($query) use ($arrivalDate, $departureDate) {
              $query->where('arrival_date', '<=', $departureDate)
              ->where('departure_date', '>=', $departureDate);
          });
        })->exists();

     // $arrivalDate=date('Y-m-d H:i:s A', strtotime($arrivalDate));
     // $arrivalDate=date('Y-m-d H:i:s A', strtotime($arrivalDate));
        if ($conflicts) {
            $errors[$key] = "Entries found between the specified Arrival Date ".$arrivalDate." and Checkout Date ".$departureDate." in the database.";
        }

    }
    if (!empty($errors)) {
        echo json_encode(['status' => 'unsuccess', 'errors' => $errors]);
        exit();
    }   
/***************************************** Save Data *****************************************************/


        unset($servicsfields['_token']);

        $mail_data=array();
        foreach ($servicsfields['service'] as $key => $services) {             
         $data = new Service;
         $lastRecord = Service::where('unit', $unit_id)->orderBy('id', 'desc')->first();
         if ($lastRecord) {
            $data->old_room_code=$lastRecord->room_code; 
         }
         $data->user_id = Auth::id(); 
         $data->owner_id = Auth::id();


         $arrival_date_check = date('Y-m-d', strtotime($services['arrival_date']));
         $existing_arrival_date = Service::where('unit', $unit_id)->whereDate('departure_date', 'like', '%' . $arrival_date_check . '%') ->first();
         if ($existing_arrival_date) {
            $existing_arrival_date->b2b = 1; 
            $existing_arrival_date->update();
        }

        
         foreach ($services as $key => $service) {
            $data->$key=$service;         
        } 
          
        $data->save(); 

        $lastInsertedId = $data->id;
        $departure_date_check = date('Y-m-d', strtotime($data->departure_date));
        $existingService = Service::where('unit', $unit_id)->whereDate('arrival_date', 'like', '%' . $departure_date_check . '%')->where('id', '!=', $lastInsertedId)->first();
        if ($existingService) {
            $data->b2b = 1;
            $data->save(); 
        } 


        $lastservics = Service::find($lastInsertedId);
        $mail_data[$lastInsertedId] =array(
        'arrival_date' => $lastservics->arrival_date,
        'arrival_time' => $lastservics->arrival_time,
        'departure_date' => $lastservics->departure_date,
        'departure_time' => $lastservics->departure_time,
        'room_code' => $lastservics->room_code,
        'notes' => $lastservics->notes,
        'url' => route('services.edit', $lastInsertedId),
        'user' => Auth::user()->name,
    );    

    }

    // $userEmail= 'datatest@bcleanhi.com';
    // Mail::send('emails.add_service_date', $mail_data, function($message) use ($userEmail) {
    //     $message->to($userEmail, 'Rental Project Database')
    //     ->subject('Rental Project Database - Add Date');
    //     $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); 
    // });

    // $userEmail = 'datatest@bcleanhi.com';
    // Mail::send('emails.add_service_date', compact('mail_data'), function($message) use ($userEmail) {
    //     $message->to($userEmail, 'Rental Project Database')
    //     ->subject('Rental Project Database - Add Date');
    //     $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); 
    // });





    
    //return redirect('owner-services')->with('status', 'Servics Added Sucessfully');   
      $response = [
        'status' => 'success',
        'message' => 'Services added successfully.',
        'redirect' => route('owner-services.create') 
    ];
    return response()->json($response);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $service = Service::find($id);
       if ($service->owner_id != auth()->id()) {
        return redirect('owner-services')->with('status', 'You do not have any permission to write, edit, update or delete this entry.');   
       }
       return view('owner/view_service', compact('service','id')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $service = Service::find($id);
       if ($service->owner_id != auth()->id()) {
        return redirect('owner-services')->with('status', 'You do not have any permission to write, edit, update or delete this entry.');   
       }
       $query =User::query();
       $user_data=$query->where('role', '=','cleaner')->get();
       return view('owner/edit_service', compact('service','user_data','id')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

     $data = Service::find($id);
     if ($data->owner_id != auth()->id()) {
        return redirect('owner-services')->with('status', 'You do not have any permission to write, edit, update or delete this entry.');   
    } 

    $unit_id=$data->unit;   
    $servicsfields=$request->post();
    $arrivalDateTime = '';
    $departureDateTime = '';

    $Unitdata = Unit::find($unit_id);
    $arrivalDateTime = '';
    $departureDateTime = '';


    $data->checkin = isset($_POST['checkin']) ? 1 : 0;  
    $data->checkout = isset($_POST['checkout']) ? 1 : 0; 

    if (!isset($servicsfields['checkin'])) {
        $arrivalDateTime = date('Y-m-d H:i:s', strtotime($servicsfields['arrival_date'] . ' ' . $Unitdata->checkin));
    } else {
        $arrivalDateTime = date('Y-m-d H:i:s', strtotime($servicsfields['arrival_date'] . ' ' . $servicsfields['arrival_time']));
    }

    if (!isset($servicsfields['checkout'])) {
        $departureDateTime = date('Y-m-d H:i:s', strtotime($servicsfields['departure_date'] . ' ' . $Unitdata->checkout));
    } else {
        $departureDateTime = date('Y-m-d H:i:s', strtotime($servicsfields['departure_date'] . ' ' . $servicsfields['departure_time']));
    }



    //$arrivalDateTime = date('Y-m-d H:i:s', strtotime($servicsfields['arrival_date'] . ' ' . $servicsfields['arrival_time']));
    //$departureDateTime = date('Y-m-d H:i:s', strtotime($servicsfields['departure_date'] . ' ' . $servicsfields['departure_time']));

    if ($departureDateTime < $arrivalDateTime) {
        $errorsmsg= "Checkout Date ". $departureDateTime." must be greater than Arrival Date ".$arrivalDateTime." for " . $servicsfields['guest_name'];
        $errors = new \Illuminate\Support\MessageBag(['custom_error' => $errorsmsg]);
        return redirect()->back()->withErrors($errors)->withInput();
    }

    $servicsfields['arrival_date']= $arrivalDateTime;
    $servicsfields['departure_date']=$departureDateTime;  

    $arrivalDate=$arrivalDateTime;
    $departureDate= $departureDateTime;  

    // $conflictingEntry = Service::where('unit', $data->unit)
    // ->where('id', '!=', $id)
    // ->where(function ($query) use ($arrivalDate,$departureDate) {
    //     $query->where('arrival_date', '<=', $arrivalDate)
    //     ->where('departure_date', '>=', $departureDate);
    // })->exists();

    //  $conflictingEntry = Service::where('unit', $data->unit)
    // ->where('id', '!=', $id)
    // ->where(function ($query) use ($arrivalDate, $departureDate) {
    //         $query->where('arrival_date', '<=', $arrivalDate)
    //         ->where('departure_date', '>=', $arrivalDate)
    //         ->orWhere(function ($query) use ($arrivalDate, $departureDate) {
    //           $query->where('arrival_date', '<=', $departureDate)
    //           ->where('departure_date', '>=', $departureDate);
    //       });
    //     })->exists();


    $conflictingEntry = Service::where('unit', $data->unit)
    ->where('id', '!=', $id)
    ->where(function ($query) use ($arrivalDate, $departureDate) {
        $query->where(function ($query) use ($arrivalDate, $departureDate) {
            // New arrival date is inside an existing booking
            $query->where('arrival_date', '<=', $arrivalDate)
                  ->where('departure_date', '>=', $arrivalDate);
        })
        ->orWhere(function ($query) use ($arrivalDate, $departureDate) {
            // New departure date is inside an existing booking
            $query->where('arrival_date', '<=', $departureDate)
                  ->where('departure_date', '>=', $departureDate);
        })
        ->orWhere(function ($query) use ($arrivalDate, $departureDate) {
            // New booking fully overlaps an existing booking
            $query->where('arrival_date', '>=', $arrivalDate)
                  ->where('departure_date', '<=', $departureDate);
        });
    })->exists();


    if ($conflictingEntry) {
       $errors = new \Illuminate\Support\MessageBag(['custom_error' => "Entries found between the specified Arrival Date ($arrivalDate) and Checkout Date ($departureDate) in the database."]);        
       return redirect()->back()->withErrors($errors)->withInput();

   }
  
    unset($servicsfields['_token']);
    unset($servicsfields['_method']);

    $arrival_date_check_1 = date('Y-m-d', strtotime($data->arrival_date));
    $arrival_date_check_2 = date('Y-m-d', strtotime($servicsfields['arrival_date']));



    $existingService_1 = Service::where('unit', $unit_id)->whereDate('departure_date', 'like', '%' . $arrival_date_check_1 . '%')->where('id', '!=', $id)->first();
      if ($existingService_1) {
        $existingService_1->b2b = 0; 
        $existingService_1->update();
    }
    $existingService_2 = Service::where('unit', $unit_id)->whereDate('departure_date', 'like', '%' . $arrival_date_check_2 . '%')->where('id', '!=', $id)->first();
    if ($existingService_2) {
        $existingService_2->b2b = 1; 
        $existingService_2->update();
    }






$departure_date_check_1 = date('Y-m-d', strtotime($data->departure_date));
$departure_date_check_2 = date('Y-m-d', strtotime($servicsfields['departure_date']));

    $existingService_1 = Service::where('unit', $unit_id)->whereDate('arrival_date', 'like', '%' . $departure_date_check_1 . '%')->where('id', '!=', $id)->first();
    if ($existingService_1) {
        $data->b2b = 0; 
    }
    $existingService_2 = Service::where('unit', $unit_id)->whereDate('arrival_date', 'like', '%' . $departure_date_check_2 . '%')->where('id', '!=', $id)->first();
    if ($existingService_2) {
        $data->b2b = 1; 
    }


    foreach ($servicsfields as $key => $servicsfield) {
        $data->$key=$servicsfield;         
    }        
    $data->update(); 
    $mail_data = [
        'arrival_date' => $data->arrival_date,
        'arrival_time' => $data->arrival_time, 
        'departure_date' => $data->departure_date, 
        'departure_time' => $data->departure_time, 
        'room_code' => $data->room_code,
        'notes' => $data->notes, 
        'url' => route('services.edit', $id),
        'user' => Auth::user()->name,
    ];
    $userEmail= 'datatest@bcleanhi.com';
    //$userEmail= 'ashish.test20986@gmail.com';
    Mail::send('emails.edit_service_date', $mail_data, function($message) use ($userEmail) {
        $message->to($userEmail, 'Rental Project Database')
        ->subject('Rental Project Database - Edit Date');
        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); 
    });
    return redirect()->route('owner.owner_get_date',$data->unit)->with('status', 'Servics Updated Sucessfully'); 
}

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $id)
    {
       $data = Service::find($id);
       $unit_id=$data->unit;
       $arrival_date_check = date('Y-m-d', strtotime($data->arrival_date));
        $arrival_services =Service::where('unit', $unit_id)->whereDate('departure_date', 'like', '%' . $arrival_date_check . '%')->where('id', '!=', $id)->first();

        if ($arrival_services) {
            $arrival_services->b2b = 0;
            $arrival_services->update();
        }

    $data->delete();
    $mail_data = [
        'service_id' => $id,
        'url' => route('services.index'),
        'user' => Auth::user()->name,
    ];
    $userEmail= 'datatest@bcleanhi.com';
    Mail::send('emails.destroy_service_date', $mail_data, function($message) use ($userEmail) {
        $message->to($userEmail, 'Rental Project Database')
        ->subject('Rental Project Database - Destroy Date');
        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); 
    });
    return redirect()->back()->with('status', 'Service has been deleted successfully');
}

    public function owner_contact_bclean()
    {
                    
       $user = User::find(Auth::id());
       return view('owner/contact_bclean', compact('user'));  
    }

     public function post_contact_bclean(Request $request){
        $contactccleanfields=$request->post();        
        unset($contactccleanfields['_token']);
        $data = new ContactBclean;
        $data->user_id = Auth::id(); 
        foreach ($contactccleanfields as $key => $contactccleanfield) {         
         $data->$key=$contactccleanfield; 
    }    
    $data->save(); 
    return redirect()->back()->with('status', 'Contact BClean has been added successfully.'); 

    }


}
