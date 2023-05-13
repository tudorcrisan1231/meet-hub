<div>
   <div>Nume:{{$event->name}}</div>
   <img src="{{asset('storage/'.$event->image)}}" alt="" style="width: 100px;">
   <div>{{$event->description}}</div>
   <div>{{$event->date}}</div>
   <div>Durata: {{$event->time}}</div>
   <div>Limita: {{$event->limit}}</div>
   <div>Tema: {{$event->type}}</div>
</div>
