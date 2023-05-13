<div>
   <a href="/event/{{$event->id}}">Nume:{{$event->name}}</a>
   <img src="{{asset('storage/'.$event->image)}}" alt="" style="width: 100px;">
   <div>{{$event->description}}</div>
   <div>{{$event->date}}</div>
   <div>Durata: {{$event->time}}</div>
   <div>Limita: {{$event->limit}}</div>
   <div>Tema: {{$event->type}}</div>
</div>
