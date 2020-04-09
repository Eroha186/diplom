@extends('admin/main')

@section('content')
    <div id="publ-tabs">
        <ul class="tabs">
            <li class="publ-tab tab publ-tab_active" data-tab="1">Модерирование</li>
            <li class="publ-tab tab" data-tab="2">Добавление тем</li>
            <li class="publ-tab tab" data-tab="3">Выбор подложки</li>
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
                                    {{$publication->user->f}} {{$publication->user->i}}. {{$publication->user->i}}
                                    .,
                                    {{$publication->user->stuff}},
                                    {{$publication->user->town}},
                                    {{$publication->user->job}}
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
                            @foreach($publication->themes as $theme)
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
                            <li class="list-body__item" data-id="{{$theme->id}}">{{$theme->name}}</li>
                        @endforeach
                    </ul>
                    <div class="ta-center adding">+</div>
                </div>
                <div class="wrapper-form publication-themes-form">
                    <form action="" class="add-form">
                        <textarea name="theme" cols="30" rows="7" id="themes"
                                  placeholder="Введите темы разделяя их переносом строки..."></textarea>
                        <button class="add">Добавить</button>
                    </form>
                    <form action="" class="edition-form">
                        <input type="text" name="theme" id="theme">
                        <div class="wrap-button">
                            <button class="del">Удалить</button>
                            <button class="editing">Редактировать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-content publ-tab-content" data-tab="3">
            <div class="publ-substrate">
                <div class="form-group">
                    <form action="{{ route("active-substrate-for-publication") }}" method="POST">
                        {{ csrf_field() }}
                        <label for="substrate">Подложка для награды</label>
                        <select name="substrate" id="substrate" class="form-control">
                            <option value="0">Выбирете подложку</option>
                            @foreach($substrates as $substrate)
                                <option value="{{$substrate->id}}"
                                        @if($substrate->active_for_publ) selected="selected" @endif>
                                    {{$substrate->name}}
                                </option>
                            @endforeach
                        </select>
                        <button class="mt-lg-3">Активировать подложку</button>
                    </form>
                </div>
                <div class="img-example">
                </div>
            </div>
        </div>
    </div>
@endsection
