<!doctype html>
<html lang="ru">
<head>
    @include('styles')
    <title>Публикация</title>
</head>
<body>
@include('header_footer.header')
<section class="publications__main bg-arch">
    <div class="container">
        <h2 class="section-title">
            Публикация материалов
        </h2>
        <div class="row">
            <div class="col-md-6 competitions__descr">
                В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие.
                Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в
                конкурсах для
                педагогов!
            </div>
            <div class="cake">
                <img src="{{asset('/images/cake.png')}}" alt="Пироженое">
            </div>
        </div>
    </div>
</section>

<section class="publication-content">
    <div class="container">
        {!!Breadcrumbs::render('publication', $publication)!!}

        <div class="row">
            <div class="col-md-6 publication-content__title">{{$publication->title}}</div>
        </div>
        <div class="publication-content__tags">
            @foreach($publication->theme as $theme)
                <span class="tag">{{$theme->name}}</span>
            @endforeach
        </div>
        <div class="publication-content__date">Опубликовано: {{$publication->date_add}}</div>
        <div class="publication-content__author">
            {{$publication->author->f}} {{$publication->author->i}} {{$publication->author->o}},
            {{$publication->author->job}} в г.{{$publication->author->town}}, {{$publication->author->stuff}}
        </div>
        <div class="publication-content__viewport"></div>
        <div class="row">
            <div class="col-md-2">
                <a href="{{Storage::url($publication->doc)}}" class="btn green" download>Скачать
                    текст</a>
            </div>
            <div class="col-md-3">
                <a href="{{Storage::url($publication->ppt)}}" class="btn orange" download>Скачать
                    презентацию</a>
            </div>

        </div>
        <div class="publication-content__text" id="readable">
            <input type="text" id="publication-content__text" class="hide" value="{{$publication->text}}">
        </div>
    </div>
</section>
@include('script')
</body>
</html>
