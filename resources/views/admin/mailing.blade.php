@extends('admin.main')

@section('content')
    <div class="wrap-mailing">
        <div class="mailing-option">
            <form action="">
                <select name="template" id="template">
                    <option value="0">Выберите шаблон</option>
                    @foreach($templates as $template)
                        <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="mail-demo"></div>
    </div>
@endsection