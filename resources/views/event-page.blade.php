@extends('layouts.main')

@section('content')

@livewire('event-page', ['event_id' => $id])

@endsection