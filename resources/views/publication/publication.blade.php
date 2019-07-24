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
            <div class="col-xl-6 competitions__descr">
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
            <div class="col-xl-7">
                <div class="row">
                    <div class="col-xl-11 publication-content__title">{{$publication->title}}</div>
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
                <div class="publication-content__viewport">
                    <div class="row">
                        <div class="col-xl-12 h940">
                            тут будет показ презентации, но пока что нет
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <a href="{{Storage::url($publication->doc)}}" class="btn green filled-btn" download>Скачать
                            текст</a>
                    </div>
                    <div class="col-xl-6">
                        <a href="{{Storage::url($publication->ppt)}}" class="btn orange filled-btn" download>Скачать
                            презентацию</a>
                    </div>

                </div>
            </div>
            <div class="col-xl-4  offset-md-1 new-publication">
                <div class="title">Новые публикации</div>
                @foreach ($newPublications as $newPublication)
                    <div class="new-publication__snippet">
                        <div class="new-publication__snippet-img">
                            <img src="{{$newPublication['file'] == 'doc' ? asset('images/doc.svg') :
                            $newPublication['file'] == 'pdf' ? asset('images/pdf.svg') :
                            $newPublication['file'] == 'ppt' ? asset('images/ppt.svg') : ''}}" alt="Иконка">
                        </div>
                        <div class="new-publication__snippet-descr">
                            <a href="{{route('publication', ['id' => $newPublication->id])}}" class="title">
                                {{$newPublication->title}}
                            </a>
                            <div class="author">
                                Автор: {{$newPublication->author->f}} {{$newPublication->author->i}}
                                .{{$newPublication->author->o}}.,
                                {{$newPublication->author->job}}
                                <span>г.{{$newPublication->author->town}}, {{$newPublication->author->stuff}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="publication-content__text" id="readable">
            <input type="text" id="publication-content__text" class="hide" value="{{$publication->text}}">
        </div>
        <div class="publication-content__passage">
            @foreach($images as $image)
                <img src="{{Storage::url($image)}}" alt="">
            @endforeach
        </div>
    </div>
</section>
@include('script')
</body>
</html>
