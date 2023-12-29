@extends('dashboard.layouts.master')

@section('content')
    <div class="mt-5">
        <h2 class="display-5 p-3 text-light"><span style="color:#FF8201;">U</span>nbscription <span style="color:#FF8201;">R</span>equests</h2>
    </div>
    <div class="mx-5 my-5 d-flex flex-row justify-content-center">
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telegram No.</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($unsubscribes as $unsubscribe)
                    <tr>
                        <th scope="row">{{ $unsubscribe->id }}</th>
                        <td>{{ $unsubscribe->first_name }}</td>
                        <td>{{ $unsubscribe->last_name }}</td>
                        <td>{{ $unsubscribe->email }}</td>
                        <td>{{ $unsubscribe->telegram }}</td>
                        @if ($unsubscribe->status == 1)
                            <td style="color: green;">Completed</td>
                            <td style="color: ;">No Actions Available</td>
                        @endif
                        @if ($unsubscribe->status == 0)
                            <td style="color: orange;">Requested</td>
                            <td style="cursor: pointer;">
                                <a style="text-decoration: none;" href="{{ route('complete', $unsubscribe->id) }}">
                                    &#9989;
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6">No Unsubscription Requests Yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end pr-5">
        {!! $unsubscribes->links() !!}
    </div>
@endsection
