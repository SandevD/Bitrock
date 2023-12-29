@extends('dashboard.layouts.master')

@section('content')
<form class="aboutquote" action="" method="POST">
    @csrf
    <div>
    <h2 class="display-5 p-3 text-light"><span style="color:#FF8201;">U</span>pdate <span style="color:#FF8201;">P</span>ortfolio</h2>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="title1" 
        value="{{ $portfolio->value?->title1 }}">
        <label for="floatingInput" style="color: #FF8201;">Enter Title One</label>
    </div>
    <div class="pb-3"> 
        <textarea id="w3review" class="form-control" rows="4" name="description1" placeholder="Enter description for title one...">{{ $portfolio->value?->description1 }}</textarea>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="title2" 
        value="{{ $portfolio->value?->title2 }}">
        <label for="floatingInput" style="color: #FF8201;">Enter Title Two</label>
    </div>
    <div class="pb-3"> 
        <textarea id="w3review" class="form-control" rows="4" name="description2" placeholder="Enter description for title two...">{{ $portfolio->value?->description2 }}</textarea>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="title3" 
        value="{{ $portfolio->value?->title3 }}">
        <label for="floatingInput" style="color: #FF8201;">Enter Title Three</label>
    </div>
    <div class="pb-3"> 
        <textarea id="w3review" class="form-control" rows="4" name="description3" placeholder="Enter description for title three...">{{ $portfolio->value?->description3 }}</textarea>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" placeholder="" name="title4" 
        value="{{ $portfolio->value?->title4 }}">
        <label for="floatingInput" style="color: #FF8201;">Enter Title Four</label>
    </div>
    <div class="pb-3"> 
        <textarea id="w3review" class="form-control" rows="4" name="description4" placeholder="Enter description for title four...">{{ $portfolio->value?->description4 }}</textarea>
    </div>
    <div align="center">
        <button type="submit" class="btn subbtn btn-block">Update</button>
    </div>
</form>
@endsection