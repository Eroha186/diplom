@extends('account/account')

@section('nav')
    @include('account/nav')
@endsection

@section('account-content')

    <div class="my-publications">
        <h2 class="section-title">
            Мои публикации
        </h2>
        <div class="table-publication">
            <table>
                <tr class="table-title">
                    <th class="number">№</th>
                    <th class="date-time">Дата добавления</th>
                    <th class="name-publication">Название работы</th>
                    <th class="author">Автор</th>
                    <th class="status">Статус</th>
                    <th class="certificate">Сертификат публикации СМИ</th>
{{--                    <th class="partcipation">Участие в конкурсах</th>--}}
                </tr>
                @foreach($publications as $publication)
                    <tr class="cell-item">
                        <td class="number ta-center">{{$loop->iteration}}</td>
                        <td class="date-time ta-center">{{$publication->date_add}}</td>
                        <td>
                            <a href="/publication/{{$publication->id}}"
                               class="name-publication standart-link">{{$publication->title}}</a>
                        </td>
                        <td class="author ta-center">
                            {{$publication->author->f}} {{$publication->author->i}}. {{$publication->author->i}}.
                        </td>
                        <td class="status ta-center">
                            @if($publication->moderation == 0)
                                Модерация
                            @elseif($publication->moderation == 2)
                                Опубликовано
                            @else
                                Отклонено
                            @endif
                        </td>
                        <td class="certificate ta-center">
                            <a href="#" class="button download-button">Скачать</a>
                        </td>

{{--                        <td class="participation ta-center">--}}
{{--                            <a href="#" class="button participation-button">Участвовать</a>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection