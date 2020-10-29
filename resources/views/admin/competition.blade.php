@extends('admin.main')

@section('content')
    <div  class="wrap-a-com-work">
        <ul class="tabs">
            <li class="work-tab tab work-tab_active" data-tab="1">Модерация</li>
            <li class="work-tab tab" data-tab="2">Определения места</li>
        </ul>
        <div class="tab-content content_active work-tab-content" data-tab="1">
            @foreach($worksForModeration as $work)
                @if($work->moderation == 0)
                <p><a href="{{route('competition-work', ['id' => $idCompetition, 'workId' => $work->id])}}">{{$work->title}}</a></p>
                @endif
            @endforeach
        </div>
        <div class="tab-content work-tab-content" data-tab="2">
            @foreach ($worksForDebriefing as $work)
                @if($work->moderation == 2 && $work->place == 0)
                    <form class="wrap-a-work" data-id={{$work->id}}>
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
                        <div class="place-wrap">
                            <select class="place" data-id="{{$work->id}}">
                                <option value="0">Выберите место</option>
                                <option value="1">Первое</option>
                                <option value="2">Второе</option>
                                <option value="3">Третье</option>
                                <option value="4">Лауреат</option>
                            </select>
                        </div> 
                    </form>
                @endif
            @endforeach
        </div>
    </div>
@endsection