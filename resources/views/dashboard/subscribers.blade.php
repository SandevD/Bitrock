@extends('dashboard.layouts.master')

@section('content')
    <div class="mt-5">
        <h2 class="display-5 p-3 text-light"><span style="color:#FF8201;">S</span>ubscriptions</h2>
    </div>
    <div class="mx-5 my-5 d-flex flex-row justify-content-center">
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Transaction No.</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telegram No.</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subscribers as $subscriber)
                    <tr>
                        <th scope="row">{{ $subscriber->id }}</th>
                        <th>{{ $subscriber->transaction_no }}</th>
                        <td>{{ $subscriber->first_name }}</td>
                        <td>{{ $subscriber->last_name }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>{{ $subscriber->telegram }}</td>
                        <td>{{ $subscriber->created_at }}</td>
                        @if ($subscriber->status == 0)
                            <td style="color: red;">Cancelled</td>
                        @endif
                        @if ($subscriber->status == 1)
                            <td style="color: green;">Completed</td>
                        @endif
                        @if ($subscriber->status == 2)
                            <td style="color: orange;">Processing</td>
                        @endif
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6">No Subscribers Yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end pr-5">
        {!! $subscribers->links() !!}
    </div>
@endsection
