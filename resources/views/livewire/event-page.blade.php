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


        <div class="info_event">Organizator: 
            <div class="participanti">
                
                <a href="/profile?user={{$organizator->id}}" class="participanti_item">
                    @isset($organizator->photo)
                        <img class="img_banner_prof" src="{{asset('storage/'.$organizator->photo)}}" alt="">
                    @else
                        <img class="img_banner_prof" src="{{asset('images/placeholder.png')}}" alt="">
                    @endisset
                    
                    <div><span class="info_dim">{{$organizator->name}}</span></div>
                </a>
             
            </div>
        </div>

        <div class="info_event">Participanti: 
            <div class="participanti">
                @foreach ($participants as $participant)
                    <a href="/profile?user={{$participant->id}}" class="participanti_item">
                        @isset($participant->photo)
                           <img class="img_part" src="{{asset('storage/'.$participant->photo)}}" alt="">
                        @else
                           <img width="200" src="{{asset('images/placeholder.png')}}" alt="">
                        @endisset
                        
                        <div><span class="info_dim">{{$participant->name}}</span></div>
                    </a>
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
        <div class="event_btns">
            @if(auth()->user()->id != $organizator->id && !$participate)
                @if($locuri_libere > 0)
                    <div class="button_login_register event_paticipa" wire:click="participate">
                        Participa
                    </div>
                @else
                    <div class="button_login_register event_paticipa">
                        Toate locurile sunt ocupate :(
                    </div>
                @endif
            @else
                <div class="button_login_register" wire:click="unparticipate" style="background-color: var(--orange)">
                    Nu mai participa
                </div>
                <div class="button_login_register" wire:click="openChat">
                    Open chat
                </div>
            @endif
        </div>


        @if($openChat)
            <div class="card_main card_chats" style="position: fixed;">
                <div class="card_events card_chats_container" >
                    @foreach ($chats as $chat)
                        @php
                            $user = \App\Models\User::find($chat->sender_id);
                        @endphp
                        <div class="chat @if($chat->sender_id == auth()->user()->id) chat_right @else chat_left @endif">
                            <div class="chat_user">
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
                <div class="chat_btns">
                    <div class="button_login_register" wire:click="closeChat">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7q-.275.275-.7.275t-.7-.275L12 13.4Z"/></svg>
                    </div>
                    <input type="text" class="chat_btns_input" placeholder="Mesajul tau" wire:model="chat_message">
                    <div class="button_login_register" wire:click="sendMessage">
                        <div>Trimite</div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"><path fill="currentColor" d="M0 2v8.5L15 13L0 15.5V24l26-11L0 2z"/></svg>
                    </div>
                    
                </div>
            </div>
        @endif

        <style>
            .event_paticipa{
                grid-column: 1/-1;
            }
            .event_btns{
                display: grid;
                grid-template-columns: 30% 1fr;
                gap: 1rem;
                width: 100%;
                padding: 1rem 2.5%;
            }
            .event_btns>*{
                margin: 0;
                width: 100%;
                text-align: center;
            }
            .info_cont{
                border-left: none;
            }
            .participanti{
                display: flex;
                flex-wrap: wrap;
                gap: 2rem;
            }
            .participanti_item{
                display: flex;
                align-items: center;
                gap: .5rem;
                text-decoration: none;
            }
            .participanti_item img{
                width: 2.5rem;
                height: 2.5rem;
                border-radius: 50%;
            }
            .card_chats{
                
                height: 65%;
            }
            .card_chats_container{
                padding: 1rem 2.5%;
            }
            .chat_btns_input{
                width: 100%;
                border-radius: 5px;
                border: 1px solid #000;
                padding: 5px;
                font-size: 1.6rem;
                font-family: inherit;
                height: 100%;
            }
            .chat_btns{
                display: grid;
                grid-template-columns:  max-content 1fr  max-content;
                align-items: center;
                gap: 10px;
                padding: .5rem 0;
                border-top: 1px solid rgba(255,255,255,.3);
                padding: 1rem 2.5%;
            }
            .chat_btns .button_login_register{
                width: max-content !important;
                height: 100%;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: .5rem;
            }
            .chat_btns .button_login_register svg{
                width: 20px;
                height: 20px;
            }
            .chat{
                display: flex;
                flex-direction: column;
                margin-bottom: 1.5rem;
            }
            .chat_user{
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 1.4rem;
                font-weight: bold;
            }
            .chat_user img{
                width: 3rem;
                height: 3rem;
                border-radius: 50%;
            }
            .chat_right{
                display: flex;
                flex-direction: column;
                align-items: flex-end;
                text-align: right;
            }
            .chat_left{
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
        </style>
    </div>
</main>