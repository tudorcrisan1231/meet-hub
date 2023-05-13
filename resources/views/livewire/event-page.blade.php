<div style="font-size: 1.6rem; color:white; position:relative;">
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

    @php
        $locuri_libere = $event->limit - count($participants);
        if($locuri_libere < 0){
            $locuri_libere = 0;
        }
    @endphp
    <div>Limita: {{$event->limit}} persoane (locuri libere {{$locuri_libere}})</div>

    <div>Tema: {{$event->type}}</div>

    <div>Organizator: 
        @isset($organizator->photo)
            <div><img src="{{asset('storage/'.$organizator->photo)}}" alt=""></div>
        @else
            <div><img src="{{asset('images/placeholder.png')}}" alt=""></div>
        @endisset
        <div>{{$organizator->name}}</div>
    </div>

    <div>Participanti: 
        <div>
            @foreach ($participants as $participant)
                @isset($participant->photo)
                    <div><img width="200" src="{{asset('storage/'.$participant->photo)}}" alt=""></div>
                @else
                    <div><img width="200" src="{{asset('images/placeholder.png')}}" alt=""></div>
                @endisset
                
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
        @if($locuri_libere > 0)
            <div class="button_login_register" wire:click="participate">
                Participa
            </div>
        @else
            <div class="button_login_register">
                Toate locurile sunt ocupate :(
            </div>
        @endif
    @else
        <div class="button_login_register" wire:click="unparticipate">
            Nu mai participa
        </div>
        <div class="button_login_register" wire:click="openChat">
            Open chat
        </div>
    @endif

    @if($openChat)
        <div class="card_main" style="position: fixed;">
            <div class="card_events" >
                @foreach ($chats as $chat)
                    @php
                        $user = \App\Models\User::find($chat->sender_id);
                    @endphp
                    <div style="display: flex; flex-direction:column;" class="@if($chat->sender_id == auth()->user()->id) chat_right @else chat_left @endif">
                        <div>
                            @isset($user->photo)
                                <img src="{{asset('storage/'.$user->photo)}}" alt="">
                            @else
                                <img src="{{asset('images/placeholder.png')}}" alt="">
                            @endisset
                           
                            <div>{{$user->name}}</div>
                        </div>
                        <div>
                            {{$chat->message}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card_btns">
                <input type="text" placeholder="Mesajul tau" wire:model="chat_message">
                <div class="button_login_register" wire:click="sendMessage">
                    Trimite
                </div>
            </div>

            <div class="button_login_register" wire:click="closeChat">
                inchide chat
            </div>
        </div>
    @endif

    <style>
        .chat_right{
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .chat_left{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
    </style>
</div>
