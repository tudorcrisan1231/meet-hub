<div class="card-content card-content-search" >
    <div class="card-content-search_lat" style="display: none;">{{json_decode($event->location)[0]}}</div>
    <div class="card-content-search_long" style="display: none;">{{json_decode($event->location)[1]}}</div>
    <div>
        <div class="div_location">
            <svg class="icon_location" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12q.825 0 1.413-.588T14 10q0-.825-.588-1.413T12 8q-.825 0-1.413.588T10 10q0 .825.588 1.413T12 12Zm0 10q-4.025-3.425-6.012-6.362T4 10.2q0-3.75 2.413-5.975T12 2q3.175 0 5.588 2.225T20 10.2q0 2.5-1.988 5.438T12 22Z"/></svg>
            <h1 class="title_location">{{$event->name}}</h1>
            <div class="date_location">({{$event->date}} for {{$event->time}} hours)</div>
        </div>
        <div class="div_location">
            <div class="date_location">Limit: {{$event->limit}} people</div>
            <div class="date_location">Theme: {{$event->type}}</div>
        </div>
    </div>

    <div class="date_location">
        <a class="profile_btn-nav_link" href="/event/{{$event->id}}">Details</a>
    </div>
</div>
