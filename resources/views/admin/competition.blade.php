@extends('admin.main')

@section('content')
    <div  class="wrap-a-com-work">
        <ul class="tabs">
            <li class="work-tab tab work-tab_active" data-tab="1">Модерация</li>
            <li class="work-tab tab" data-tab="2">Определения места</li>
        </ul>
        <div class="tab-content content_active work-tab-content" data-tab="1">
            @foreach($works as $work)
                @if($work->moderation == 0)
                <p><a href="{{route('competition-work', ['id' => $idCompetition, 'workId' => $work->id])}}">{{$work->title}}</a></p>
                @endif
            @endforeach
        </div>
        <div class="tab-content work-tab-content" data-tab="2">
            @foreach ($works as $work)
                @if($work->moderation == 2)
                    <div class="wrap-a-work">
                        <div class="img" >
                            <img style="width: 250px; height: 250px" src="{{Storage::url($work['file']['url'])}}">
                        </div>
                        <div class="annotation">
                            {{$work->annotation}}
                        </div>
                        <div class="author">
                            <div class="work__name">
                                {{$work->ic}} {{$work->fc}}
                            </div>
                            <div class="work__teacher">
                                Куратор: {{$work->user->f}} {{$work->user->i}} {{$work->user->o}}
                            </div>
                            <div class="work__location">
                                {{$work->user->stuff}}, г.{{$work->user->town}}
                            </div>  
                        </div>
                        <div class="palace">
                                    <label for = "first">Первое место</label>
                                    <input id = "first" name = "place" type="radio">
                                    <label for = "second">Второе место</label>
                                    <input id = "second" name = "place" type="radio">
                                    <label for = "third">Третье место</label>
                                    <input id = "third" name = "place" type="radio">
                                    <label for = "laurat">Лаурят</label>
                                    <input id = "laurat" name = "place" type="radio">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection