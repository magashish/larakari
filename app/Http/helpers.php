<?php
use App\Models\User;
use App\Models\Unit;
use App\Models\Service;

if(!function_exists('unit_type_array')){
	function unit_type_array()
	{  
		$unit_type =Unit::query()->orderBy('name', 'asc')->get();
		return $unit_type;
	}
}

if(!function_exists('unit_type_owner_array')){
	function unit_type_owner_array($id)
	{
		$query =Unit::query();
		$unit_type=$query->where('owner_id', $id)->get();
		return $unit_type; 
	}
}

if(!function_exists('get_unit_detail')){
	function get_unit_detail($id)
	{
		$unit =Unit::find($id);		
		return $unit; 
	}
}


if(!function_exists('bed_type_array')){
	function bed_type_array()
	{
		$bed_type=array('single' => 'Single','full' => 'Full','queen' => 'Queen','king' => 'King','double' => 'Double');
		return $bed_type;  
	}
}

if(!function_exists('owner_status_array')){
	function owner_status_array()
	{
		$owner_status= array('1' => 'Active', '2' => 'DeActive');
		return $owner_status;  
	}
}

if(!function_exists('cleaner_status_array')){
	function cleaner_status_array()
	{
		$cleaner_status= array('3' => 'Full Time', '4' => 'Part Time');
		return $cleaner_status;  
	}
}


if(!function_exists('get_userdata')){
	function get_userdata($id)
	{
         $User_data= User::find($id);		
         return $User_data;  
	}
}

if(!function_exists('get_owner_Users')){
	function get_owner_Users()
	{
		$query =User::query();
		$user_data=$query->where('role', 'owner')->get();
		return $user_data;  
	}
}

if(!function_exists('get_cleaner_Users')){
	function get_cleaner_Users()
	{
		$query =User::query();
		$user_data=$query->where('role', 'cleaner')->get();
		return $user_data;  
	}
}

if(!function_exists('bed_size_array')){
	function bed_size_array()
	{
		//$bed_size= array('a' => 'A', 'b' => 'B');
		$bed_size= array('T','1T','2T','D','2D','3D','Q','2Q','3Q','K','2K','3K');
		return $bed_size;  
	}
}

if(!function_exists('sofa_size_array')){
	function sofa_size_array()
	{
		$sofa_size= array('No' => 'No','Yes' => 'Yes');
		return $sofa_size;  
	}
}

if(!function_exists('futon_size_array')){
	function futon_size_array()
	{
		$futon_size= array('c' => 'C', 'd' => 'D');
		return $futon_size;  
	}
}

if(!function_exists('timeEntries_array')){
	function timeEntries_array()
	{
		$timeEntries = array(
			'09:00:00' => '9:00 AM',
			'10:00:00' => '10:00 AM',
			'11:00:00' => '11:00 AM',
			'12:00:00' => '12:00 PM',
			'13:00:00' => '1:00 PM',
			'14:00:00' => '2:00 PM',
			'15:00:00' => '3:00 PM',
			'16:00:00' => '4:00 PM',
			'17:00:00' => '5:00 PM',
			'18:00:00' => '6:00 PM',
			'19:00:00' => '7:00 PM',
			'20:00:00' => '8:00 PM',
			'21:00:00' => '9:00 PM'
		);
		return $timeEntries;  
	}
}



if(!function_exists('checkin_time_array')){
	function checkin_time_array()
	{
		$timeEntries = array(
			'15:00:00' => '3:00 PM',
			'16:00:00' => '4:00 PM'
		);
		return $timeEntries;  
	}
}

if(!function_exists('checkout_time_array')){
	function checkout_time_array()
	{
		$timeEntries = array(	
			'11:00:00' => '11:00 AM',
			'12:00:00' => '12:00 PM'
		);
		return $timeEntries;  
	}
}




if(!function_exists('insert_checkin_time_array')){
	function insert_checkin_time_array()
	{
		$timeEntries = array(
			'09:00:00' => '9:00 AM',
			'10:00:00' => '10:00 AM',
			'11:00:00' => '11:00 AM',
			'12:00:00' => '12:00 PM',
			'13:00:00' => '1:00 PM',
			'14:00:00' => '2:00 PM',
			'15:00:00' => '3:00 PM'
		
		);
		return $timeEntries;  
	}
}

if(!function_exists('insert_checkout_time_array')){
	function insert_checkout_time_array()
	{
		$timeEntries = array(	
			'12:00:00' => '12:00 PM',
			'13:00:00' => '1:00 PM',
			'14:00:00' => '2:00 PM',
			'15:00:00' => '3:00 PM',
			'16:00:00' => '4:00 PM',
			'17:00:00' => '5:00 PM',
			'18:00:00' => '6:00 PM',
			'19:00:00' => '7:00 PM',
			'20:00:00' => '8:00 PM',
			'21:00:00' => '9:00 PM'
		);
		return $timeEntries;  
	}
}



if(!function_exists('assigncleaner_get_new_code')){
	function assigncleaner_get_new_code($id,$departure_date,$unit_id,$room_code)
	{
       
       $room_code='';
		$arrival_date_check = date('Y-m-d', strtotime($departure_date));
		//$existing_arrival_date = Service::where('unit', $unit_id)->where('id', '!=', $id)->whereDate('arrival_date', 'like', '%' . $arrival_date_check . '%') ->first();
		$existing_arrival_date = Service::where('unit', $unit_id)
		->where('id', '!=', $id)
		->where(function ($query) use ($arrival_date_check) {
			$query->whereDate('arrival_date', 'like', '%' . $arrival_date_check . '%')
			->orWhere('arrival_date', '>', $arrival_date_check);
		})
		->orderBy('arrival_date', 'ASC')
		->first();

		if ($existing_arrival_date) {
			return $existing_arrival_date->room_code; 
			//return $existing_arrival_date->room_code.'  '.$existing_arrival_date->id.' id'.$id; 
		}
		//return $room_code;  
	}
}




