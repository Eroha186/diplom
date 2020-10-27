@extends('admin.main')

@section('content')
    <div style="display: flex">
        <form action="{{route('create-express-competition')}}" class="create-competition"
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
                    <option value="0">Выберите тип конкурса</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @foreach($nominations as $nomination)
                    <label for="nomination-{{ $nomination->id }}">{{ $nomination->name }}</label>
                    <input type="checkbox" id="nomination-{{ $nomination->id }}" name="nominations[]" value="{{ $nomination->id }}">
                @endforeach
            </div>
            <div class="form-group">
                <label for="substrate">Подложка для награды</label>
                <select name="substrate" id="substrate" class="form-control">
                    <option value="0">Выберите подложку</option>
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
@endsection