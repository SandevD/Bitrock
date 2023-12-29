@extends('dashboard.layouts.master')

@section('content')
<form class="aboutquote" action="" method="POST">
    @csrf
    <div>
    <h2 class="display-5 p-3 text-light"><span style="color:#FF8201;">U</span>pdate <span style="color:#FF8201;">D</span>etails</h2>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="contact" 
        value="{{ $contactus->value?->contact }}">
        <label for="floatingInput">Enter Contact Number</label>
    </div>
    <div class="pb-3"> 
        <textarea id="w3review" class="form-control" rows="4" name="address" placeholder="Enter Address">
            {{ $contactus->value?->address }}
        </textarea>
    </div>
    <div align="center">
        <button type="submit" class="btn subbtn btn-block">Update</button>
    </div>
</form>
@endsection