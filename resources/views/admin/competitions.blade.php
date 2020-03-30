@extends('admin/main')

@section('content')
    <div id="publ-tabs">
        <ul class="tabs">
            <li class="competition-tab tab competition-tab_active" data-tab="1">Модерирование</li>
            <li class="competition-tab tab" data-tab="2">Создание конкурса</li>
            <li class="competition-tab tab" data-tab="3">Добавление подложек</li>
            <li class="competition-tab tab" data-tab="4">Создание типов конкурсов</li>
        </ul>
        <div class="tab-content content_active competition-tab-content" data-tab="1">
            <div class="a-work">
                <div class="competition-wrap">
                    @foreach ($competitions as $competition)
                        <div class="competition">
                            <div class="competition__img">
                                <img src="{{Storage::url($competition->cover)}}" alt="">
                            </div>
                            <div class="competition__descr ta-center">
                                <div class="title">
                                    {{$competition->title}}
                                </div>
                                <div class="name">
                                    {{$competition->type->name}}
                                </div>
                                <div class="date-time">
                                    С {{date("d.m.Y", strtotime($competition->date_begin))}}
                                    <span>по {{date("d.m.Y", strtotime($competition->date_end))}}</span>
                                </div>
                                <a href="{{route('a-competition', ['id' => $competition->id])}}"
                                   class="button transparent-btn">Модерировать</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-content competition-tab-content" data-tab="2">
            <form action="{{route('create-competition', ['flag' => 0])}}" class="create-competition"
                  enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                @if (count($errors) > 0 || Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            @if (Session::has('error'))
                                <li>{{ Session::get('error') }}</li>
                            @endif
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="createTitle">Название конкурса</label>
                    <input name="title" type="text" class="form-control" id="createTitle"
                           placeholder="Название конкурса">
                </div>
                <div class="form-group">
                    <label for="createAnnotation">Описание</label>
                    <textarea name="annotation" type="text" class="form-control" id="createAnnotation"
                              placeholder="Описание конкурса" cols="30" rows="7"></textarea>
                </div>
                <div class="form-group">
                    <label for="createCover">Обложка конкурса</label>
                    <input name="cover" type="file" class="form-control" id="createCover">
                </div>
                <div class="form-group">
                    <select name="type-competition" id="createTypeCompetition" class="input-style">
                        <option value="0">Выбирите тип конкурса</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="createDateBegin">Дата начала</label>
                    <input name="date-begin" type="date" class="form-control" id="createDateBegin" required>
                </div>
                <div class="form-group">
                    <label for="createDataEnd">Дата завершения</label>
                    <input name="date-end" type="date" class="form-control" id="createDataEnd" required>
                </div>
                <div class="form-group">
                    <label for="substrate">Подложка для награды</label>
                    <select name="substrate" id="substrate" class="form-control">
                        <option value="0">Выбирете подложку</option>
                        @foreach($substrates as $substrate)
                            <option value="{{$substrate->id}}">{{$substrate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Создать">
                </div>
            </form>
            <div class="img-example">

            </div>
        </div>
        <div class="tab-content competition-tab-content" data-tab="3">
            <form action="{{route('a-add-substrate')}}" class="substrate-form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if (count($errors) > 0 || Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            @if (Session::has('error'))
                                <li>{{ Session::get('error') }}</li>
                            @endif
                        </ul>
                    </div>
                @endif
                <label for="substrate-name">Название подложки</label>
                <input type="text" name="name" id="substrate-name" style="max-width: 260px;">
                <label for="substrate-file">Добавьте файл</label>
                <input type="file" id="substrate-file" name="substrate-file">
                <input type="submit" style="max-width: 120px">
            </form>
        </div>
        <div class="tab-content competition-tab-content" data-tab="4">
            <div class="wrapper" style="display: flex;">
                <div class="wrapper-list">
                    <div class="list-header">
                        Темы
                    </div>
                    <ul class="list-body">
                        @foreach($types as $type)
                            <li class="list-body__item" data-id="{{$type->id}}">{{$type->name}}</li>
                        @endforeach
                    </ul>
                    <div class="ta-center adding">+</div>
                </div>
                <div class="wrapper-form competition-type-form">
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
    </div>
@endsection
