@extends('layouts.app')

@section('contents')

<style>
    th, td {
        text-align: center;
        vertical-align: middle
    }
</style>

<div class="container">
    <div class="mt-5">

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <a class="btn btn-primary mb-2" href="{{ route('events.create') }}">&plus; ADD EVENT</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">EVENT</th>
                    <th scope="col">VENUE</th>
                    <th scope="col">DATE</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->event }}</td>
                        <td>{{ $event->venue }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</td>
                        <td>{{ $event->description }}</td>
                        <td>
                            <div class="d-flex flex-row bd-highlight mb-2" style="margin-top: 8px">
                                <a href="{{ route('events.edit', ['event' => $event]) }}" class="btn btn-success m-1">Edit</a>
                                
                                <form action="{{ route('events.destroy', ['event' => $event]) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" style="margin-top: 3.5px">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <p>No data to show</p>
                    @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection