@extends('admin/main')

@section('content')
    <div id="publ-tabs">
        <ul class="tabs">
            <li class="publ-tab tab publ-tab_active" data-tab="1">Модерирование</li>
            <li class="publ-tab tab" data-tab="2">Добавление тем</li>
        </ul>
        <div class="tab-content content_active publ-tab-content" data-tab="1">
            <div class="publications-list">
                @foreach($publications as $publication)
                    <div style="width: 100%;" class="publication-card">
                        <div class="row">
                            <div class="col-xl-10">
                                <div class="publication-card__title">
                                    <a href="/publication/{{$publication->id}}">{{$publication->title}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="publish-card__date">Опублековано {{$publication->date_add}}</div>
                        <div class="row">
                            <div class="col-xl-10">
                                <div class="publication-card__author">Автор
                                    {{$publication->author->f}} {{$publication->author->i}}. {{$publication->author->i}}.,
                                    {{$publication->author->stuff}},
                                    {{$publication->author->town}},
                                    {{$publication->author->job}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-10">
                                <div class="publication-card__descr">
                                    {{$publication->annotation}}
                                </div>
                            </div>
                        </div>
                        <div class="publication-card__img">
                            @if(isset($publication['doc']))
                                <div class="img file">
                                    <img src="{{asset("/images/doc.svg")}}" alt="">
                                </div>
                            @endif
                            @if(isset($publication['ppt']))
                                <div class="img file">
                                    <img src="{{asset("/images/ppt.svg")}}" alt="">
                                </div>
                            @endif
                        </div>
                        <div class="publication-card__tags">
                            @foreach($publication->theme as $theme)
                                <div class="tag">{{$theme->name}}</div>
                            @endforeach
                        </div>
                    </div>

                @endforeach
                    <div class="pagination">
                        {{ $publications->links('paginate') }}
                    </div>
            </div>
        </div>
        <div class="tab-content publ-tab-content" data-tab="2">
            <div class="wrapper" style="display: flex;">
                <div class="wrapper-list">
                    <div class="list-header">
                        Темы
                    </div>
                    <ul class="list-body">
                        @foreach($themes as $theme)
                            <li class="list-body__item">{{$theme->name}}</li>
                        @endforeach  
                        <li class="list-body__item ta-center">+</li>
                    </ul>
                </div>
                <div class="wrapper-form">
                    <form action="" class="add-form">
                        <textarea name="add" cols="30" rows="7">Введите темы разделяя их переносом строки
                        </textarea>
                        <button class="add">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
@endsection
