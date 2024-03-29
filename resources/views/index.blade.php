@extends('layouts.main')
@section('title')
   Service requests::Jim's Offroad Service
@endsection
@section('content')
  @include('message')
  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Let's get your vehicle back on the trail!</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- List Tickets -->
  <section class="bg-light section" data-page="list">
    <div class="container">
      <div class="row">
        @if(count($requests) > 0)
          <table class="table table-striped">
            <thead>
              <th>Ticket #</th>
              <th>Client Name</th>
              <th>Status</th>
              <th>Last Update</th>
              <th>Action</th>
            </thead>
            <tbody>              
                @foreach($requests AS $request)
                  <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->client_name }}</td>
                    <td>{{ $request->status }}</td>
                    <td>{{ $request->updated_at->format('m/d/Y h:i a') }}</td>
                    <td>
                      <a href="{{ route('edit',[$request->id]) }}" class="btn btn-primary">EDIT</a> &nbsp; 
                      <a href="{{ route('delete',[$request->id]) }}" class="btn btn-danger delete-button">DELETE</a>
                    </td>                
                  </tr>
                @endforeach              
            </tbody>
          </table>
          {{ $requests->links() }}
        @else
            <p class="top-pad">No requests found matching your search criteria</p>
        @endif
      </div>
    </div>
  </section>

@endsection

@push('scripts')
    <script>
      $(function() {
        $("a.delete-button").click(function () {
          return confirm('Are you sure you want to delete this service request?');
        });
      });
    </script>
@endpush