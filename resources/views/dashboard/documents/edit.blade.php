@extends('dashboard.layouts.master')

@section('content')
    <form class="aboutquote" action="{{ route('document.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <h2 class="display-5 p-3 text-light"><span style="color:#FF8201;">U</span>pload <span
                    style="color:#FF8201;">D</span>ocuments</h2>
        </div>
        <div style="text-align: center;" class="text-light ">
            <label>*note: Select a new file .</label>
        </div>
        <div class="form-floating mb-3">
            <input type="hidden"name="id" value="{{ $documents->id }}">
            <input type="text" class="form-control" id="floatingInput" placeholder="" name="name" value="{{ $documents->name }}">
            <label for="floatingInput" style="color: #FF8201;">Enter Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="" name="category" value="{{ $documents->category }}">
            <label for="floatingInput" style="color: #000;">Enter Category</label>
        </div>
        <div class="mb-3">
            <input type="file" name="file" class="form-control">
        </div>
        <div class="row d-flex justify-content-center mx-1">
            <p class="text-white text-center">*Current PDF thats in use.</p>
            <iframe src="/assets/docs/{{ $documents->file }}" width="100%"
                height="300"></iframe>
        </div>
        <div class="mb-3 d-flex flex-row justify-content-center text-white">
            <div class="d-flex flex-row justify-content-center mr-2">Activate &nbsp;<input type="radio" name="status"
                    value="1" class="mt-1" checked /></div>
            <div class="d-flex flex-row justify-content-center">Deactivate&nbsp;<input type="radio" name="status"
                    value="0" class="mt-1" /></div>
        </div>
        <div align="center" class="row">
            <div class="col"><a href="{{ route('document.index') }}" class="btn subbtn btn-block">Back</a></div>
            <div class="col"><button type="submit" class="btn subbtn btn-block">Add</button></div>
        </div>
    </form>
@endsection
