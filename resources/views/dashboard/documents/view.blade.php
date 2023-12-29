@extends('dashboard.layouts.master')

@section('content')
    <div class="mt-5">
        <h2 class="display-5 p-3 text-light"><span style="color:#FF8201;">D</span>ocuments</h2>
    </div>
    <div class="d-flex flex-row justify-content-center"><a href="{{ route('document.add') }}" class="btn subbtn btn-block">Add
            Documents</a></div>
    <div class="mx-5 my-5 d-flex flex-row justify-content-center">
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">File</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $document)
                    <tr>
                        <th scope="row">{{ $document->id }}</th>
                        <td>{{ $document->name }}</td>
                        <td>{{ $document->category }}</td>
                        <td>{{ $document->file }}</td>
                        @if ($document->status)
                            <td class="text-center text-success text-bold">&#x2713;</td>
                        @endif
                        @if (!$document->status)
                            <td class="text-center text-danger">&#x274C;</td>
                        @endif
                        <td class="text-center">
                            <div class="d-flex flex-row justify-content-center">
                                <span class="text-warning" style="cursor:pointer; text-decoration:none;"><a class="text-warning" href="{{ route('document.edit', $document->id) }}">&#x270E;</a></span>
                                <span class="ml-3 text-danger" style="cursor:pointer; text-decoration:none;"><a class="text-danger" onclick="deleteFunction()">&#x44;</a></span>
                            </div>
                        </td>
                        <form action="{{ route('document.delete', $document->id) }}" id="deleteForm" method="GET">
                            @csrf
                        </form>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6">No Documents <a href="{{ route('document.add') }}">Added</a> Yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

<script>
    function deleteFunction() {
        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Hey',
            message: 'Are you sure about that?',
            position: 'center',
            buttons: [
                ['<a><b>YES</b></a>', function(instance, toast) {
                    deleteForm.submit(),
                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');

                }, true],
                ['<button>NO</button>', function(instance, toast) {

                    instance.hide({
                        transitionOut: 'fadeOut'
                    }, toast, 'button');

                }],
            ],
            onClosing: function(instance, toast, closedBy) {
                console.info('Closing | closedBy: ' + closedBy);
            },
            onClosed: function(instance, toast, closedBy) {
                console.info('Closed | closedBy: ' + closedBy);
            }
        });
    }
</script>
