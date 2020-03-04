@extends('admin.main')

@section('content')
    <div class="wrap-mailing">
        <div class="mailing-option">
            <form action="">
                <select name="template" id="">
                    <option value="0">Выберите шаблон</option>
                </select>
            </form>
        </div>
        <div class="mail-demo"></div>
    </div>
@endsection