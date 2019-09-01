@php	
	use App\Meliorate\ViewHelper;
	$viewHelper = new ViewHelper();
@endphp

@extends('layouts.main')
@section('content')
  {{-- Create Ticket Form --}}
  <section class="bg-light section" data-page="edit">
    <div class="container">
        <form method="POST" action="{{ route('update', [$serviceRequest->id]) }}">
            {{csrf_field()}}             
            @include('error-div')
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Owner Information</h5>    
                            <div class="form-group">
                                <label for="lastname">Name</label> @include('required')
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value="{{ $serviceRequest->client_name }}">
                            </div>
                             <div class="form-group">
                                <label for="phone">Phone Number</label> @include('required')
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required="required" value="{{ $serviceRequest->client_phone }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label> @include('required')
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required="required" value="{{ $serviceRequest->client_email }}">
                            </div>      
                        </div>
                    </div>  
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Vehicle Information</h5>                                   
                            <div class="form-group">
                                <label for="make">Vehicle Make</label> @include('required')
                                <select class="form-control" id="make" name="make" required="required">
                                    {!! $viewHelper->dropdown('Vehicle Make', $makes, $selectedMake->id ?? 0) !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="model">Vehicle Model</label> @include('required')
                                <select class="form-control" id="model" name="model" required="required">
                                    {!! $viewHelper->dropdown('Vehicle Model', $models, $serviceRequest->vehicle_model_id ?? 0) !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Service Description</label> @include('required')
                                <textarea class="form-control" id="description" name="description" rows="3" required="required">{{ $serviceRequest->description }}</textarea>
                            </div>                
                        </div>
                    </div>  
                </div>
            </div>        
            <div class="row top-pad">
                <div class="col-md-6">
                </div> 
                <div class="col-md-4">                    
                    <select class="form-control" id="status" name="status" required="required">
                        <option value="">Select Request Status</option>
                        @foreach($statusOptions as $value => $text)
                            <option value="{{ $value }}" @if($value == $serviceRequest->status) selected="selected" @endif>{{ $text }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary float-right">Edit Request</button>
                </div>                
            </div>   
        </form>     
    </div>
  </section>

@endsection

@push('scripts')
    <script src={{ asset("js/load-models.js") }}></script>
@endpush