@extends('admin/main')

@section('content')
    <div id="publ-tabs">
        <ul class="tabs">
            <li class="competition-tab tab competition-tab_active" data-tab="1">Модерирование</li>
            <li class="competition-tab tab" data-tab="2">Создание конкурса</li>
            {{--            <li class="competition-tab tab" data-tab="2">Создание конкурса</li>--}}
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
                                <a href="{{route('a-competition', ['id' => $competition->id])}}" class="button transparent-btn">Модерировать</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-content competition-tab-content" data-tab="2">
            <form action="{{route('create-competition')}}" class="create-competition" enctype="multipart/form-data" method="POST">
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
                    <input name="date-begin" type="date" class="form-control" id="createDateBegin"
                           placeholder="Название конкурса">
                </div>
                <div class="form-group">
                    <label for="createDataEnd">Дата завершения</label>
                    <input name="date-end" type="date" class="form-control" id="createDataEnd">
                </div>
                <div class="form-group">
                    <input type="submit" value="Создать">
                </div>
            </form>
        </div>
    </div>
@endsection
