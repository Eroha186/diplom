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
                <div class="a-work__img">

                </div>
                <div class="a-work-info">
                    <div class="a-work__name">

                    </div>
                    <div class="a-work__participant">

                    </div>
                    <div class="a-work__teacher">

                    </div>
                    <div class="a-work__location">

                    </div>
                    <div class="a-work__descr">

                    </div>
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
@endsection
