@extends('dashboard.layouts.master')

@section('content')
<form class="aboutquote" action="" method="POST">
    @csrf
    <div>
    <h2 class="display-5 p-3 text-light"><span style="color:#FF8201;">U</span>pdate <span style="color:#FF8201;">F</span>ooter</h2>
    </div>
    <div style="text-align: center;" class="text-light">
        <label>*note: You can divide the content into sections for colour changes.</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="section_one"
        value="{{ $footer->value?->section_one }}">
        <label for="floatingInput">Section One</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="section_two"
        value="{{ $footer->value?->section_two }}">
        <label for="floatingInput" style="color:#ff8201;">Section Two</label>
    </div>
    <div align="center">
        <button type="submit" class="btn subbtn btn-block">Update</button>
    </div>
</form>
@endsection