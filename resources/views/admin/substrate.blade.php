@extends("admin/main")

@section("content")
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
        <input type="text" name="name" id="substrate-name" class="form-control" style="max-width: 260px;">
        <label for="substrate-file">Добавьте файл</label>
        <input type="file" id="substrate-file" name="substrate-file">
        <input type="submit" style="max-width: 120px" value="Загрузить">
    </form>
@endsection