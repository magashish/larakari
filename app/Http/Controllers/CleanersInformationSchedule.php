<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class CleanersInformationSchedule extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = date('Y-m-d');
        if (isset($_GET['dateInput'])) {
           $currentDate=$_GET['dateInput'];
        }

        $servicesin = Service::whereDate('arrival_date', $currentDate)->get();
        $services_checkin_ids_array=array();
        foreach ($servicesin as $key => $service) {
            array_push($services_checkin_ids_array,$service->unit);  
        }

        $services_carry_over_date = Service::whereDate('carry_over_date', $currentDate)->get();

        //$departure_date = Service::whereDate('departure_date', $currentDate)->get();
        //$departure_date = Service::whereDate('departure_date', $currentDate)->get();

        $departure_date = Service::where(function ($query) use ($currentDate) {
            $query->whereDate('departure_date', $currentDate)
            ->whereDate('carry_over_date', $currentDate);
        })
        ->orWhere(function ($query) use ($currentDate) {
            $query->whereDate('departure_date', $currentDate)
            ->whereNull('carry_over_date');
        })
        ->get();
        $servicesout = $departure_date->merge($services_carry_over_date)->unique('id');
        $services_checkout_ids_array=array();
        foreach ($servicesout as $key => $service) {
            array_push($services_checkout_ids_array,$service->unit);            
        }


        // echo "<pre>";
        // print_r($services_checkin_ids_array);

        // echo "<pre>";
        // print_r($services_checkout_ids_array);

        // echo "i am here ";
        // exit();

        return view('services_assign_cleaners_table', compact('currentDate','servicesin','servicesout','services_checkin_ids_array','services_checkout_ids_array'));  
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
