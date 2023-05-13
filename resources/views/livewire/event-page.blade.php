<div style="font-size: 1.6rem; color:white;">
    @if($event->image)
        <img src="{{asset('storage/'.$event->image)}}" alt="" style="width: 100%;">
    @else
        <img src="https://theperfectroundgolf.com/wp-content/uploads/2022/04/placeholder.png" alt="" style="width: 100%;">
    @endif
   
    <div>Nume: {{$event->name}}</div>
    <div>Descriere: {{$event->description}}</div>
    <div>Locatie: {{$geo_location}}</div>

    @php
        //calculate the diffrence in days and hours between the current date and the event date
        $date1 = strtotime($event->date);
        $date2 = strtotime(date("Y-m-d"));
        $diff = abs($date1 - $date2);
        $hours = floor($diff / (60*60));
        $diff = floor($diff / (60*60*24));
    @endphp
    <div>Incepe in: {{$event->date}} la {{$event->hour}} (in {{$diff}} zile SAU {{$hours}} ore)</div>

    <div>Durata: {{$event->time}} ore</div>

    <div>Limita: {{$event->limit}} persoane</div>

    <div>Tema: {{$event->type}}</div>

    <div>Organizator: 
        <div><img src="{{asset('storage/'.$organizator->photo)}}" alt=""></div>
        <div>{{$organizator->name}}</div>
    </div>

    <div>Participanti: 
        <div>
            @foreach ($participants as $participant)
                @if($participant->photo)
                    <div><img width="200" src="{{asset('storage/'.$participant->photo)}}" alt=""></div>
                @else
                    <div><img width="200" src="https://www.pngitem.com/pimgs/m/146-1468479_my-profile-icon-blank-profile-picture-circle-hd.png" alt=""></div>
                @endif
                
                <div>nume: {{$participant->name}}</div>
            @endforeach
        </div>
    </div>

    @php
        $participate = false;
        foreach ($participants as $participant) {
            if($participant->id == auth()->user()->id){
                $participate = true;
            }
        }
    @endphp
    @if(auth()->user()->id != $organizator->id && !$participate)
        <div class="button_login_register" wire:click="participate">
            Participa
        </div>
    @else
        <div class="button_login_register" wire:click="unparticipate">
            Nu mai participa
        </div>
        <div class="button_login_register" wire:click="openChat">
            Open chat
        </div>
    @endif
</div>
