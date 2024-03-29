<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
  <a class="navbar-brand" href="{{ route('home') }}"><img src="/img/logo.png" style="max-height:75px;">Jim's Offroad Service</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item" id="list">
        <a class="nav-link" href="{{ route('home') }}">Current Tickets</a>
      </li>
      <li class="nav-item" id="add">
        <a class="nav-link" href="{{ route('add') }}">Create a Ticket</a>
      </li>
    </ul>
  </div>   
  <div class="row">
      <div class="col-12">
        <form method="POST" action="{{ route('search') }}">
          {{ csrf_field() }}
          <div class="input-group float-right">
            <input class="form-control border-secondary py-2" type="search" placeholder="Search Requests" value="{{ session('search') }}" name="search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    Search
                </button>
            </div>
          </div>
        </form>
      </div>
  </div>
</nav>
