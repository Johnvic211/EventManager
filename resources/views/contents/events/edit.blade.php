@extends('layouts.app')

@section('contents')

<div class="container">
    <div class="mt-5">
        <a href="{{ route('events.index') }}" class="btn btn-secondary btn-md active mb-4" role="button" aria-pressed="true">< Go back</a>

        <form action="{{ route('events.update', ['event' => $event]) }}" method="POST">

            @csrf
            @method('PUT')

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="event" id="event" placeholder="Event Name" value="{{ $event->event }}">
                <label for="event-">Event Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="venue" id="venue" placeholder="Venue" value="{{ $event->venue }}">
                <label for="venue">Venue</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="date" id="date" placeholder="Date of Event" value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}">
                <label for="date">Date of Event</label>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ $event->description }}</textarea>
              </div>

            @include('components.form_errors')

            <input type="submit" value="Save changes" class="btn btn-success">
        </form>
    </div>
</div>

@endsection