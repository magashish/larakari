@extends('layouts.app')
@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="container-fluid">

    <div class="container-fluid nss_style">
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800"><span class="insert_dates"><a href="{{ route('assigncleaner.index') }}">Assign Cleaner</a></span></h1> 
     </div>


     <div class="row">
      <div class="col-xl-12 col-md-12 mb-4 col-form-label text-md-end">
        <form class="service-assigncleaner"  action="{{ route('assigncleaner.index') }}" method="GET"  enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-4 offset-md-4 col-form-label text-md-end">
                    <label for="unit_type" class="col-form-label text-md-end">{{ __('Select The Date to View Cleaner') }}</label>
                    <input class="form-control" type="date" name="dateInput" id="dateInput" value="{{$currentDate}}">
                    <span class="all_dates"><a href="{{ route('services.services_assigncleaners') }}">View All Assign Cleaner</a></span>
                </div>
                <div class="col-md-6">              
                </div>
            </div>
        </form>

        @if($servicesin->isNotEmpty() || $servicesout->isNotEmpty())
        <span class="print_all_dates"> <a type="button" onclick="printDiv('printableArea')">Print Date</a></span>
        @endif


    </div>
</div>




<div class="col-xl-12 col-md-12 mb-4">
    <div class="date_mobile_section">
        <div>
            <div><strong>C/OUTS</strong></div>
        </div>

        @if ($servicesout->isNotEmpty())
        @foreach ($servicesout as $service)
        @php    $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); @endphp
        <div class="services_date_detail">
          <div class="services_date_name">
            <div class="guest_name">Unit {{ get_unit_detail($service->unit)->name }}</div>
            <div><strong> Date </strong> <span class="arrival_departure_date_value"> {{ \Carbon\Carbon::parse($service->departure_date)->format('F d') }}</span></div>
            <div><strong>Time Out</strong> {{ \Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '---' }}</div>
            <div><strong>B/B </strong> <span class="text_red">{{ $service->b2b == 1 ? 'B/B' : '' }}</span></div>   
        </div>
        <div class="services_date_detail_more"> 
           <div class="services_date_detail_action" style="display: none;"> 
              <div><strong>Old Code</strong> {{ $service->room_code }} </div>      
              <div><strong>I.D.</strong> {{ get_unit_detail($service->unit)->master_code }}</div>
              
                @if($service->b2b == 1)
                <div><strong>New Code</strong> 
                    {{ assigncleaner_get_new_code($service->id,$service->departure_date,$service->unit,$service->room_code) }}
                </div>
               @endif
            
             <div><strong>Bed</strong> @if (!empty($unserializedbed_size))
                {{ implode(', ', $unserializedbed_size) }}
                @else
                No data available
            @endif</div>
            <div><strong>Sofa </strong>{{ get_unit_detail($service->unit)->sofa_size }}</div>
            <div><strong>Notes </strong> {{ $service->notes }}</div> 
            <div><strong>Created At </strong> {{ \Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A') }}</div>     
            <form class="input-form service-edit-mobile"  method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               <input type="hidden" name="check" value="assigncleaner">
               <div class="row mb-3">
                <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Runner') }}</label>
                <div class="col-md-10">
                  <select id="runner" name="runner" class="form-control" tabindex="-1" aria-hidden="true">
                    <option value="">Select Runner</option>
                    @foreach (get_cleaner_Users() as $key => $user)
                    <option value="{{ $user->id }}" @if($service->runner == $user->id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Cleaner') }}</label>
            <div class="col-md-10">
               <select id="cleaner" name="cleaner" class="form-control" tabindex="-1" aria-hidden="true">
                <option value="">Select Cleaner</option>
                @foreach (get_cleaner_Users() as $key => $user)
                <option value="{{ $user->id }}" @if($service->cleaner == $user->id) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('   Cleaner Carry Over Date') }}</label>
        <div class="col-md-10">
            @if($service->b2b == 1)
       
        @else
        <input type="date" class="form-control carry_over_date" name="carry_over_date" value="{{ $service->carry_over_date; }}">
        @endif
           <!-- <input type="date" class="form-control carry_over_date" name="carry_over_date" value="{{ $service->carry_over_date; }}"> -->
       </div>
   </div>
   <div class="">
       <button type="submit" class="btn btn-success">Save</button>     
   </div> 
</form> 
</div>
<span class="date_detail_more"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
</div>
</div>
@endforeach
@else
<p>No dates are available right now.</p>
@endif

<div>
    <div><strong>C/IN</strong></div>
</div>
@if ($servicesin->isNotEmpty())
@foreach ($servicesin as $service)

@if(!in_array($service->unit, $services_checkout_ids_array)) 


@php    $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); @endphp
<div class="services_date_detail">
  <div class="services_date_name">
    <div class="guest_name">Unit {{ get_unit_detail($service->unit)->name }}</div>
    <div><strong> Date </strong> <span class="arrival_departure_date_value"> {{ \Carbon\Carbon::parse($service->arrival_date)->format('F d') }}</span></div>
    <div><strong>Time In</strong> {{ \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '---' }}</div>
</div>
<div class="services_date_detail_more"> 
   <div class="services_date_detail_action" style="display: none;"> 
      <div><strong>I.D.</strong> {{ get_unit_detail($service->unit)->master_code }}</div>

      
      @if(!in_array($service->unit, $services_checkout_ids_array)) 
      <div ><strong>New Code</strong> 
         {{ $service->room_code }} 
     </div>
     @endif 
            

      <div><strong>Bed</strong> @if (!empty($unserializedbed_size))
        {{ implode(', ', $unserializedbed_size) }}
        @else
        No data available
    @endif</div>
    <div><strong>Sofa </strong>{{ get_unit_detail($service->unit)->sofa_size }}</div>
    <div><strong>Notes </strong> {{ $service->notes }}</div> 
    <div><strong>Created At </strong> {{ \Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A') }}</div>         
    {{-- <form class="input-form service-edit-mobile"  method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
       @csrf
       @method('PUT')
       <input type="hidden" name="check" value="assigncleaner">
       <div class="row mb-3">
        <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Runner') }}</label>
        <div class="col-md-10">
          <select id="runner" name="runner" class="form-control" tabindex="-1" aria-hidden="true">
            <option value="">Select Runner</option>
            @foreach (get_cleaner_Users() as $key => $user)
            <option value="{{ $user->id }}" @if($service->runner == $user->id) selected @endif>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Cleaner') }}</label>
    <div class="col-md-10">
       <select id="cleaner" name="cleaner" class="form-control" tabindex="-1" aria-hidden="true">
        <option value="">Select Cleaner</option>
        @foreach (get_cleaner_Users() as $key => $user)
        <option value="{{ $user->id }}" @if($service->cleaner == $user->id) selected @endif>{{ $user->name }}</option>
        @endforeach
    </select>
</div>
</div>
<div class="row mb-3">
    <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Cleaner Carry Over Date') }}</label>
    <div class="col-md-10">
       <input type="date" class="form-control carry_over_date" name="carry_over_date" value="{{ $service->carry_over_date; }}">
   </div>
</div>
<div class="">
   <button type="submit" class="btn btn-success">Save</button>     
</div> 
</form> --}} 
</div>
<span class="date_detail_more"><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
</div>
</div>
 @endif 
@endforeach
@else
<p>No dates are available right now.</p>
@endif
</div>
</div>








<div class="date_desktop_section service-table">
    <table class="service-table table table-bordered">
        <tr>
            <th>Unit</th>
            <th>Date</th>
            <th>Time Out</th>
            <th>B/B</th>
            <th>Old Code</th>
            <th>I.D.</th>
            <th>New Code</th>                
            <th>Bed</th>
            <th>Sofa</th>
            <th>Runner</th>
            <th>Cleaner</th>
            <th>Cleaner Carry Over Date</th>
            <th class="service_notes">Notes</th>  
            <th>Action</th> 
            <th>Created At</th>            
        </tr>
        <tr>
            <td colspan="13">C/OUTS</td>
        </tr>
        @foreach ($servicesout as $service)
        @php    $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); @endphp
        <tr class="service_tr td_service_{{ $service->id }}">
         <form class="input-form service-add"  method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
           @csrf
           @method('PUT')
           <input type="hidden" name="check" value="assigncleaner">
           <td>{{ get_unit_detail($service->unit)->name }}</td>
           <td><span class="table_arrival_departure_date_value">{{ \Carbon\Carbon::parse($service->departure_date)->format('F d') }}</span></td>
           <td>{{ \Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '---' }}</td>           
           <td class="text_red">{{ $service->b2b == 1 ? 'B/B' : '' }}</td>
           <td>{{ $service->room_code }}</td> 
           <td>{{ get_unit_detail($service->unit)->master_code }} </td>      
           <td>
            @if($service->b2b == 1)
               {{ assigncleaner_get_new_code($service->id,$service->departure_date,$service->unit,$service->room_code) }}
            @endif
           </td>


           <td style="text-transform: capitalize;">@if (!empty($unserializedbed_size))
            {{ implode(', ', $unserializedbed_size) }}
            @else
            No data available
        @endif</td>
        <td style="text-transform: capitalize;">{{ get_unit_detail($service->unit)->sofa_size }}</td>
        <td>
         <select id="runner" name="runner" class="form-control" tabindex="-1" aria-hidden="true">
            <option value="">Select Runner</option>
            @foreach (get_cleaner_Users() as $key => $user)
            <option value="{{ $user->id }}" @if($service->runner == $user->id) selected @endif>{{ $user->name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select id="cleaner" name="cleaner" class="form-control" tabindex="-1" aria-hidden="true">
            <option value="">Select Cleaner</option>
            @foreach (get_cleaner_Users() as $key => $user)
            <option value="{{ $user->id }}" @if($service->cleaner == $user->id) selected @endif>{{ $user->name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        @if($service->b2b == 1)
       
        @else
        <input type="date" class="form-control carry_over_date" name="carry_over_date" value="{{ $service->carry_over_date; }}">
        @endif
    </td>

    <td class="notes">
        <div id="notes-{{ $service->id }}" class="notes-div" data-truncated-notes="{{ mb_substr($service->notes, 0, 50) }} @if (strlen($service->notes) > 50)....  @endif" data-full-notes="{{ $service->notes }}">
            {{ mb_substr($service->notes, 0, 50) }} @if (strlen($service->notes) > 50)....  @endif 
        </div>
        @if (strlen($service->notes) > 50)
        <a href="#" class="read-more-link" data-service-id="{{ $service->id }}">Read more</a>
        @endif
    </td>
    <td class="">
       <button type="submit" class="btn btn-success">Save</button>     
   </td> 
    <td>{{ \Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A') }}</td>
</form>       

</tr>
@endforeach
<tr>
    <td colspan="13">C/IN</td>
</tr>
@foreach ($servicesin as $service)

@if(!in_array($service->unit, $services_checkout_ids_array)) 

@php    $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); @endphp
<tr class="service_tr td_service_{{ $service->id }} {{ $service->b2b == 1 ? 'service_yellow' : '' }}">
    <form class="input-form service-add"  method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
       @csrf
       @method('PUT')
       <input type="hidden" name="check" value="assigncleaner">
       <td>{{ get_unit_detail($service->unit)->name }}</td>
       <td><span class="table_arrival_departure_date_value">{{ \Carbon\Carbon::parse($service->arrival_date)->format('F d') }}</td>
           <td>{{ \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '---' }}</td>           
           <td class="text_red"></td>
           <td></td> 
           <td>{{ get_unit_detail($service->unit)->master_code }}  </td>      
           <td>
                @if(!in_array($service->unit, $services_checkout_ids_array)) 
                   {{ $service->room_code }} 
                @endif 
          </td>

        <td style="text-transform: capitalize;">@if (!empty($unserializedbed_size))
            {{ implode(', ', $unserializedbed_size) }}
            @else
            No data available
        @endif</td>
        <td style="text-transform: capitalize;">{{ get_unit_detail($service->unit)->sofa_size }}</td>
        <td>
          
    </td>
    <td>
     
    </td>
    <td>
     
    </td>
    <td class="notes">
        <div id="notes-in-{{ $service->id }}" class="notes-div" data-truncated-notes="{{ mb_substr($service->notes, 0, 50) }} @if (strlen($service->notes) > 50)....  @endif" data-full-notes="{{ $service->notes }}">
            {{ mb_substr($service->notes, 0, 50) }} @if (strlen($service->notes) > 50)....  @endif 
        </div>
        @if (strlen($service->notes) > 50)
        <a href="#" class="read-more-link-in" data-service-id="{{ $service->id }}">Read more</a>
        @endif
    </td>  
    <td class="">
      {{-- <button type="submit" class="btn btn-success">Save</button>             --}}
  </td>  

  <td>{{ \Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A') }}</td>
</form>   

</tr>

@endif 


@endforeach
</table>
</div>

</div>


<div class="modal fade" id="unitinfo" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="unitinfoBody">

        </div>
    </div>
</div>
</div>
</div>








<div class="date_desktop_section service-table" id="printableArea" style="display:none">

    {{-- ✅ Custom Print Header (only visible when printing) --}}
    <div class="print-only-header">
        <span id="print-datetime"></span>
        <span class="print-title">Rental Project Database</span>
        <span></span>
    </div>

    <table style="border: 2px solid #000; border-collapse: collapse; width: 100%;">
        <tr style="border: 2px solid #000; padding: 8px; color: #000;">
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Unit</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Date</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Time Out</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>B/B</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Old Code</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>I.D.</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>New Code</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Run</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Clean</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Bed</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Notes</strong></th>
            <th style="border: 2px solid #000; padding: 8px; color: #000;"><strong>Created At</strong></th>
        </tr>

        <tr style="border: 2px solid #000; padding: 8px; color: #000; background-color: #FFFF00;">
            <td colspan="13" style="border: 2px solid #000; padding: 8px; color: #000;"><strong>C/OUTS</strong></td>
        </tr>

        @foreach ($servicesout as $service)
        @php $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); @endphp
        <tr class="service_tr td_service_{{ $service->id }}" style="border: 2px solid #000; padding: 8px; color: #000;">
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ get_unit_detail($service->unit)->name }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ \Carbon\Carbon::parse($service->departure_date)->format('d-m-y') }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ \Carbon\Carbon::parse($service->departure_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->departure_date)->format('h:i A') : '---' }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color:red;"><strong>{{ $service->b2b == 1 ? 'B/B' : '' }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ $service->room_code }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ get_unit_detail($service->unit)->master_code }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>
                @if($service->b2b == 1)
                    {{ assigncleaner_get_new_code($service->id,$service->departure_date,$service->unit,$service->room_code) }}
                @endif
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>
                @foreach (get_cleaner_Users() as $user)
                    @if($service->runner == $user->id) {{ $user->name }} @endif
                @endforeach
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>
                @foreach (get_cleaner_Users() as $user)
                    @if($service->cleaner == $user->id) {{ $user->name }} @endif
                @endforeach
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; text-transform: capitalize;"><strong>
                @if (!empty($unserializedbed_size)) {{ implode(', ', $unserializedbed_size) }} @else No data available @endif
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;" class="notes">
                <strong><div id="notes-{{ $service->id }}" class="notes-div">
                    {{ mb_substr($service->notes, 0, 50) }}@if(strlen($service->notes) > 50)...@endif
                </div></strong>
            </td>
            <td>{{ \Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A') }}</td>
        </tr>
        @endforeach

        <tr style="border: 2px solid #000; padding: 8px; color: #000; background-color: #FFFF00;">
            <td colspan="13" style="border: 2px solid #000; padding: 8px; color: #000;"><strong>C/IN</strong></td>
        </tr>

        @foreach ($servicesin as $service)
        @if(!in_array($service->unit, $services_checkout_ids_array))
        @php $unserializedbed_size = unserialize(get_unit_detail($service->unit)->bed_size); @endphp
        <tr class="service_tr td_service_{{ $service->id }}" style="border: 2px solid #000; padding: 8px; color: #000;">
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ get_unit_detail($service->unit)->name }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ \Carbon\Carbon::parse($service->arrival_date)->format('d-m-y') }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') !== '12:00 AM' ? \Carbon\Carbon::parse($service->arrival_date)->format('h:i A') : '---' }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ get_unit_detail($service->unit)->master_code }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"><strong>{{ $service->room_code }}</strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;"></td>
            <td style="border: 2px solid #000; padding: 8px; text-transform: capitalize;"><strong>
                @if (!empty($unserializedbed_size)) {{ implode(', ', $unserializedbed_size) }} @else No data available @endif
            </strong></td>
            <td style="border: 2px solid #000; padding: 8px; color: #000;" class="notes">
                <strong><div id="notes-in-{{ $service->id }}" class="notes-div">
                    {{ mb_substr($service->notes, 0, 50) }}@if(strlen($service->notes) > 50)...@endif
                </div></strong>
            </td>
            <td>{{ \Carbon\Carbon::parse($service->created_at)->format('l, d F Y \a\t h:i A') }}</td>
        </tr>
        @endif
        @endforeach
    </table>

    {{-- ✅ Custom Print Footer --}}
    <div class="print-only-footer">
        <span id="print-footer-datetime"></span>
        <span class="print-footer-title">Rental Project Database</span>
        <span>Page 1</span>
    </div>

</div>


{{-- ==============================
     STYLES
=============================== --}}
<style>
    /* Hide custom header/footer on screen — only show during print */
    .print-only-header,
    .print-only-footer {
        display: none;
    }

    @media print {

        /* ✅ Force browser to NOT show its own URL/title header/footer */
        /* The user should uncheck "Headers and footers" in the print dialog */

        @page {
            size: A4 landscape;
            margin: 15mm 10mm;
        }

        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            font-family: Arial, sans-serif;
        }

        /* ✅ Show our custom header */
        .print-only-header {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-bottom: 6px;
            margin-bottom: 8px;
            border-bottom: 2px solid #000;
            font-size: 12px;
            font-weight: bold;
        }

        .print-only-header .print-title {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        /* ✅ Show our custom footer */
        .print-only-footer {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-top: 6px;
            margin-top: 8px;
            border-top: 2px solid #000;
            font-size: 11px;
            font-family: Arial, sans-serif;
        }

        .print-only-footer .print-footer-title {
            font-weight: bold;
            text-align: center;
        }
    }
</style>


{{-- ==============================
     JAVASCRIPT
=============================== --}}
<script type="text/javascript">

    // Returns formatted date/time: Thursday, 05 February 2026 at 11:21 PM
    function getCurrentDateTime() {
        var now       = new Date();
        var days      = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var months    = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var dayName   = days[now.getDay()];
        var dd        = String(now.getDate()).padStart(2, '0');
        var monthName = months[now.getMonth()];
        var yyyy      = now.getFullYear();
        var hh        = now.getHours();
        var min       = String(now.getMinutes()).padStart(2, '0');
        var ampm      = hh >= 12 ? 'PM' : 'AM';
        hh            = hh % 12 || 12;
        hh            = String(hh).padStart(2, '0');
        return dayName + ', ' + dd + ' ' + monthName + ' ' + yyyy + ' at ' + hh + ':' + min + ' ' + ampm;
    }

    function printDiv(divId) {

        // ✅ Inject live date/time right before printing
        var dateTimeStr = getCurrentDateTime();
        document.getElementById('print-datetime').innerText        = dateTimeStr;
        document.getElementById('print-footer-datetime').innerText = 'Printed: ' + dateTimeStr;

        var printContents    = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        var style = `
            <style>
                @page {
                    size: A4 landscape;
                    margin: 15mm 10mm;
                }
                body {
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                }
                .print-only-header {
                    display: flex !important;
                    justify-content: space-between;
                    align-items: center;
                    width: 100%;
                    padding-bottom: 6px;
                    margin-bottom: 8px;
                    border-bottom: 2px solid #000;
                    font-size: 12px;
                    font-weight: bold;
                }
                .print-only-header .print-title {
                    font-size: 14px;
                    font-weight: bold;
                }
                .print-only-footer {
                    display: flex !important;
                    justify-content: space-between;
                    align-items: center;
                    width: 100%;
                    padding-top: 6px;
                    margin-top: 8px;
                    border-top: 2px solid #000;
                    font-size: 11px;
                }
                .print-only-footer .print-footer-title {
                    font-weight: bold;
                }
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
            </style>
        `;

        document.body.innerHTML = style + printContents;
        window.print();
        document.body.innerHTML = originalContents;

        // Restore any JS event bindings if needed
        location.reload();
    }
</script>



@endsection