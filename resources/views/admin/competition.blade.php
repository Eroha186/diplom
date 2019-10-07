@extends('admin.main')

@section('content')
    <div class="wrap-a-com-work">
        @foreach($works as $work)
            <p><a href="{{route('competition-work', ['id' => $idCompetition, 'workId' => $work->id])}}">{{$work->title}}</a></p>
        @endforeach
    </div>
@endsection