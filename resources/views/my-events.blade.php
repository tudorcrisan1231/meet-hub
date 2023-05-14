@extends('layouts.main')

@section('content')

<div class="card_content_my_events_MAIN">
<div class="profile_btn-nav">
        <a href="{{route('home')}}" class="profile_btn-nav_link" id="logout_profile" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.875 19.3l-6.6-6.6q-.15-.15-.213-.325T4 12q0-.2.063-.375t.212-.325l6.6-6.6q.275-.275.688-.287t.712.287q.3.275.313.688T12.3 6.1L7.4 11h11.175q.425 0 .713.288t.287.712q0 .425-.287.713t-.713.287H7.4l4.9 4.9q.275.275.288.7t-.288.7q-.275.3-.7.3t-.725-.3Z"/></svg>
        </a>
    <h5 class="my_events_title">
        @if($joined == 1)
            My Joined Events
        @else
            My Created Events
        @endif
    </h5>
    </div>
    <div>
    
    @if(count($events) > 0)
        @foreach ($events as $event)
        <div class="card_content_my_events">
                <div class="div_location">
                    <svg class="icon_location" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12q.825 0 1.413-.588T14 10q0-.825-.588-1.413T12 8q-.825 0-1.413.588T10 10q0 .825.588 1.413T12 12Zm0 10q-4.025-3.425-6.012-6.362T4 10.2q0-3.75 2.413-5.975T12 2q3.175 0 5.588 2.225T20 10.2q0 2.5-1.988 5.438T12 22Z"/></svg>
                    <h1 class="title_location">{{$event->name}}</h1>
                    <div class="date_location">({{$event->date}} for {{$event->time}} hours)</div>
                </div>
                <div class="div_location">
                    <div class="date_location">Limit: {{$event->limit}}</div>
                    <div class="date_location">Theme: {{$event->type}}</div>
                </div>
                <div class="date_location">
                    <a class="profile_btn-nav_link" href="/event/{{$event->id}}">Details</a>
                </div>
            </div>
        @endforeach
    @else
        <h1 class="title_location">You have no events</h1>
    @endif
</div>
 
</div>

@endsection