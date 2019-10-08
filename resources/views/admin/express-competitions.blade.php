@extends('admin.main')

@section('content')
    <form action="{{route('create-competition', ['flag' => 1])}}" class="create-competition" enctype="multipart/form-data" method="POST">
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
            <input type="submit" value="Создать">
        </div>
    </form>
@endsection