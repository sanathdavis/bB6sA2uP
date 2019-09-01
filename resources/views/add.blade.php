@php	
	use App\Meliorate\ViewHelper;
	$viewHelper = new ViewHelper();
@endphp

@extends('layouts.main')
@section('content')
  {{-- Create Ticket Form --}}
  <section class="bg-light section" data-page="add">
    <div class="container">
        <form method="POST" action="{{ route('store') }}">
            {{csrf_field()}}             
            @include('error-div')
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Owner Information</h5>       
                            <div class="form-group">
                                <label for="name">Name</label> @include('required')
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value="{{ old('name') }}">
                            </div>
                             <div class="form-group">
                                <label for="phone">Phone Number</label> @include('required')
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required="required" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label> @include('required')
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required="required" value="{{ old('email') }}">
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
                                    {!! $viewHelper->dropdown('Vehicle Make', $makes, old('make')) !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="model">Vehicle Model</label> @include('required')
                                <select disabled class="form-control" id="model" name="model" required="required"></select>
                            </div>
                            <div class="form-group">
                                <label for="description">Service Description</label> @include('required')
                                <textarea class="form-control" id="description" name="description" rows="3" required="required"></textarea>
                            </div>                
                        </div>
                    </div>  
                </div>
            </div>        
            <div class="row top-pad">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary float-right">Create Request</button>
                </div>                
            </div>   
        </form>     
    </div>
  </section>

@endsection

@push('scripts')
    <script src={{ asset("js/load-models.js") }}></script>
@endpush