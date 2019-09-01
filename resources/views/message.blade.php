@if (session('flash_message'))
    <div class="alert alert-{{ session('flash_level') }}">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{session('flash_message')}}
    </div>
@endif
