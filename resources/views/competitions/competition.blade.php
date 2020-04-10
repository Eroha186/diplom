<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $competition->title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('styles')
</head>
<body>
@include('header_footer/header')

<section class="competitions__main bg-arch">
    <div class="container">
        <h2 class="section-title">
            {{$competition->title}}
        </h2>
        <div class="row">
            <div class="col-xl-6 competitions__descr">
                {{$competition->annotation}}
            </div>
            <div class="cake">
                <img src="{{asset('/images/cake.png')}}" alt="Пироженое">
            </div>
        </div>
    </div>
</section>

<section class="filters">
    <div class="container">
        {!!
            ($competition->status == 1 || $competition->status == 2) ?
                Breadcrumbs::render('arch-competition', $competition) :
                Breadcrumbs::render('competition', $competition)
        !!}

        @if(($competition->status == 1 || $competition->status == 2))
            <h4 style="margin-bottom: 35px;">Результаты конкурса</h4>
        @else
            <h4 style="margin-bottom: 35px;">Всего подано заявок: {{$works->count}}</h4>

            <div class="row">
                <div class="col-xl-4">
                    <a href="{{route('form-competition').'?id='.$id}}" class="participate-competition">Участвовать в
                        конкурсе</a>
                </div>
            </div>
        @endif

        <div class="filter-nominations">
            <div class="all-nomination nomination">
                <span class="filter-nomination {{(0 == $filterInfo['nomination'])? "filter-nomination_active" : ""}}" data-value="0">Все номинации</span>
            </div>
            @foreach($competition->nominations as $nomination)
                <div class="nomination">
                    <span class="filter-nomination {{($nomination->id == $filterInfo['nomination'])? "filter-nomination_active" : ""}}" data-value="{{$nomination->id}}">{{$nomination->name}}</span>
                </div>
            @endforeach
        </div>



        <form action="{{route('search-work', ['id' => $id])}}" method="get" class="search-competition">

        </form>

        @if($competition->status == 1)
            <h4 style="margin-bottom: 35px;">Конкурс закончен. Подводятся итоги</h4>
        @endif
        @if($competition->status == 2)
            <table class="result-work">
                <tr class="dedicated">
                    <th>ФИО участника <br>Куратор</th>
                    <th>Название работы, наименование ОУ, город</th>
                    <th>Место</th>
                </tr>
                @foreach($works as $work)
                    @if($work->place > 0)
                        <tr {{ $loop->iteration % 2 == 1 ? "class='dedicated'": "" }}>
                            <td>
                                {{ $work->fc }} {{ $work->ic }} {{ $work->oc }}
                                <br>
                                {{ $work->user->f }} {{ $work->user->i }} {{ $work->user->o }}
                            </td>
                            <td>
                                {{ $work->title }}
                                <br>
                                 {{ $work->user->stuff }}, г. {{ $work->user->town }}
                            </td>
                            <td>
                                @switch($work->place)
                                    @case(1)
                                        I
                                        @break
                                    @case(2)
                                        II
                                        @break
                                    @case(3)
                                        III
                                        @break
                                @endswitch
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        @endif

        <h4 style="margin-bottom: 15px;">Работы участников</h4>
        <div class="filter" style="margin-bottom: 15px;">
            Сортировать по:
            <div class="placement-date">
                <span
                    class="filter-name filter-name-competition {{(isset($filterInfo['column-competition']) && $filterInfo['column-competition'] == 'date_add') ? "filter-name_active" : "" }}"
                    data-condition="{{(isset($filterInfo['column-competition']) && $filterInfo['column-competition'] == 'date_add') ? $filterInfo['filter-competition'] : '1' }}"
                    data-column="date_add">дате размещения </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
            <div class="filters-name">
                <span
                    class="filter-name filter-name-competition {{(isset($filterInfo['column-competition']) && $filterInfo['column-competition'] == 'title') ? "filter-name_active" : "" }}"
                    data-condition="{{(isset($filterInfo['column-competition']) && $filterInfo['column-competition'] == 'title') ? $filterInfo['filter-competition'] : '1' }}"
                    data-column="title">имени </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
        </div>
        <div class="pagination">
            {{ $works->links('paginate') }}
        </div>
    </div>
</section>

<section class="result-competition">

</section>

<section class="works-list">
    <div class="container">
        <div class="works-wrap">
            @foreach($works as $work)
                <div class="work">
                    <div class="work__img">
                        @if($work->file->type == 'image')
                            <img src="{{Storage::url($work->file->url)}}" alt="картника">
                        @endif
                        @if($work->file->type == 'doc')
                            <img src="{{asset("/images/doc.svg")}}" alt="иконка документа">
                        @endif
                        @if($work->file->type == 'ppt')
                            <img src="{{asset("/images/ppt.svg")}}" alt="иконка презинтации">
                        @endif
                    </div>
                    <a href="{{route('competition-work', ['id' => $competition->id, 'work-id' => $work->id])}}" class="work__title">
                        {{$work->title}}
                    </a>
                    <div class="work__name">
                        {{$work->ic}} {{$work->fc}}
                    </div>
                    <div class="work__teacher">
                        Куратор: {{$work->user->f}} {{$work->user->i}} {{$work->user->o}}
                    </div>
                    <div class="work__location">
                        {{$work->user->stuff}}, г.{{$work->user->town}}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $works->links('paginate') }}
        </div>
    </div>
</section>

@include('script')
</body>
</html>
