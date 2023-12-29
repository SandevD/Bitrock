@extends('dashboard.layouts.master')

@section('content')
<form class="aboutquote" action="" method="POST">
    @csrf
    <div>
        <h2 class="display-5 p-3 text-light"><span style="color:#FF8201;">U</span>pdate <span style="color:#FF8201;">D</span>etails</h2>
    </div>
    <div style="text-align: center;" class="text-light">
        <label>*note: You can divide the quote into sections for colour changes.</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="section_one" 
        value="{{ $whyus->value?->section_one }}">
        <label for="floatingInput">Section One</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="section_two" 
        value="{{ $whyus->value?->section_two }}">
        <label for="floatingInput" style="color: #FF8201;">Section Two</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="section_three" 
        value="{{ $whyus->value?->section_three }}">
        <label for="floatingInput">Section Three</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="section_four" 
        value="{{ $whyus->value?->section_four }}">
        <label for="floatingInput" style="color: #FF8201;">Section Four</label>
    </div>
    <div class="pb-3"> 
        <textarea id="w3review" class="form-control" rows="4" name="description" placeholder="Enter Description...">
            {{ $whyus->value?->description }}
        </textarea>
    </div>
    <div align="center">
        <button type="submit" class="btn subbtn btn-block">Update</button>
    </div>
</form>
@endsection