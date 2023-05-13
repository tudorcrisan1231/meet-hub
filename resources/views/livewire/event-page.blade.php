<main>
    <div class="main_container_fluid" style="font-size: 1.6rem; color:white; position:relative;">
    <div class="profile_btn-nav">
        <a href="{{route('home')}}" class="profile_btn-nav_link" id="logout_profile" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.875 19.3l-6.6-6.6q-.15-.15-.213-.325T4 12q0-.2.063-.375t.212-.325l6.6-6.6q.275-.275.688-.287t.712.287q.3.275.313.688T12.3 6.1L7.4 11h11.175q.425 0 .713.288t.287.712q0 .425-.287.713t-.713.287H7.4l4.9 4.9q.275.275.288.7t-.288.7q-.275.3-.7.3t-.725-.3Z"/></svg>
        </a>
    </div>
        @if($event->image)
            <img src="{{asset('storage/'.$event->image)}}" alt="" style="width: 100%;">
        @else
            <img class="img_banner" src="https://theperfectroundgolf.com/wp-content/uploads/2022/04/placeholder.png" alt="" style="width: 100%;">
        @endif
        <div class="info_cont">
        <div class="info_event">Nume: <span class="info_dim">{{$event->name}}</span></div>
        <div class="info_event">Descriere: <span class="info_dim">{{$event->description}}</span></div>
        <div class="info_event">Locatie: <span class="info_dim">{{$geo_location}}</span></div>

        @php
            //calculate the diffrence in days and hours between the current date and the event date
            $date1 = strtotime($event->date);
            $date2 = strtotime(date("Y-m-d"));
            $diff = abs($date1 - $date2);
            $hours = floor($diff / (60*60));
            $diff = floor($diff / (60*60*24));
        @endphp
        <div class="info_event">Incepe in: <span class="info_dim">{{$event->date}} la {{$event->hour}} (in {{$diff}} zile SAU {{$hours}} ore)</span></div>

        <div class="info_event">Durata: <span class="info_dim">{{$event->time}} ore</span></div>

        @php
            $locuri_libere = $event->limit - count($participants);
            if($locuri_libere < 0){
                $locuri_libere = 0;
            }
        @endphp
        <div class="info_event">Limita: <span class="info_dim">{{$event->limit}} persoane (locuri libere {{$locuri_libere}})</span></div>

        <div class="info_event">Tema: <span class="info_dim">{{$event->type}}</span></div>

        <div class="info_event org">Organizator: 
            @isset($organizator->photo)
                <div><img class="img_banner_prof" src="{{asset('storage/'.$organizator->photo)}}" alt=""></div>
            @else
                <div><img class="img_banner_prof" src="{{asset('images/placeholder.png')}}" alt=""></div>
            @endisset
            <div><span class="info_dim">{{$organizator->name}}</span></div>
        </div>

        <div >Participanti: 
            <div class="info_event org">
                @foreach ($participants as $participant)
                    @isset($participant->photo)
                        <div><img class="img_part" src="{{asset('storage/'.$participant->photo)}}" alt=""></div>
                    @else
                        <div><img width="200" src="{{asset('images/placeholder.png')}}" alt=""></div>
                    @endisset
                    
                    <div>nume: <span class="info_dim">{{$participant->name}}</span></div>
                @endforeach
            </div>
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
</main>