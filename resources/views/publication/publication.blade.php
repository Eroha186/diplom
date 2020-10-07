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
            {{$publication->title}}
        </h2>
        <div class="row">
            <div class="col-xl-12 competitions__descr">
                В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие.
                Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в
                конкурсах для
                педагогов!
            </div>
            <a href="//localhost:3004/form-publication" class="publish-publication"><img src="//localhost:3004/images/upload.svg" alt=""><span>Добавить работу</span></a>
            <div class="cake">
                <img src="{{asset('/images/16941.svg')}}" alt="Пироженое">
            </div>
        </div>
    </div>
</section>

<section class="publication-content">
    <div class="container">
        {!!Breadcrumbs::render('publication', $publication)!!}
 <div class="col-xl-11 publication-content__title">{{$publication->title}}</div>
        <div class="row">
            <div class="col-xl-9">
                <div class="row">
                   
                </div>
                <div class="publication-content__tags">
                    @foreach($publication->themes as $theme)
                        <span class="tag">{{$theme->name}}</span>
                    @endforeach
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
                        @if(isset($publication->doc))
                            <a href="{{Storage::url($publication->doc)}}" class="btn green filled-btn" download>Скачать
                                текст</a>
                        @endif
                    </div>
                    <div class="col-xl-6">
                        @if(isset($publication->ppt))
                            <a href="{{Storage::url($publication->ppt)}}" class="btn green filled-btn" download>Скачать
                                текст</a>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-xl-3 pl-0">
               <div class="publication-content__info">
                <div class="publication-content__imgs">
                    <span>Изображения публикации</span>
                </div>
                <div class="caral">
                    <img src="{{asset('images/caral.svg')}}" alt="">
                </div>
                    <div class="publication-content__date">Дата публикации:<br> <span> {{ date("d.m.Y", strtotime($publication->date_add)) }}</span></div>
                <div class="publication-content__author">
                    Автор: <br>
                   <span> {{$publication->user->f}} {{$publication->user->i}} {{$publication->user->o}}
                   <!--  {{$publication->user->job}} в г.{{$publication->user->town}}, {{$publication->user->stuff}} --> </span>
                </div>
                <div class="publication-content__download">
                    <div class="download-block doc-block"><a href=""><img src="{{asset('images/doc2.svg')}}" alt="">СКАЧАТЬ (.doc) </a></div>
                    <div class="download-block ppt-block"><a href=""><img src="{{asset('images/ptt.svg')}}" alt="">СКАЧАТЬ (.ptt)</a></div>
                </div>
               </div>
            </div>
{{--            <div class="col-xl-4  offset-md-1 new-publication">--}}
{{--                <div class="title">Новые публикации</div>--}}
{{--                @foreach ($newPublications as $newPublication)--}}
{{--                    <div class="new-publication__snippet">--}}
{{--                        <div class="new-publication__snippet-img">--}}
{{--                            <img src="{{$newPublication['file'] == 'doc' ? asset('images/doc.svg') :--}}
{{--                            $newPublication['file'] == 'pdf' ? asset('images/pdf.svg') :--}}
{{--                            $newPublication['file'] == 'ppt' ? asset('images/ppt.svg') : ''}}" alt="Иконка">--}}
{{--                        </div>--}}
{{--                        <div class="new-publication__snippet-descr">--}}
{{--                            <a href="{{route('publication', ['id' => $newPublication->id])}}" class="title">--}}
{{--                                {{$newPublication->title}}--}}
{{--                            </a>--}}
{{--                            <div class="author">--}}
{{--                                Автор: {{$newPublication->user->f}} {{$newPublication->user->i}}--}}
{{--                                .{{$newPublication->user->o}}.,--}}
{{--                                {{$newPublication->user->job}}--}}
{{--                                <span>г.{{$newPublication->user->town}}, {{$newPublication->user->stuff}}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
        </div>
        <div class="publication-content__text" id="readable">
            <input type="text" id="publication-content__text" class="hide" value="{{$publication->text}}">
        </div>
        <div class="publication-content__passage">
            @foreach($publication->images as $image)
                <img src="{{Storage::url($image)}}" alt="">
            @endforeach
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->admin == 1 && $publication->moderation == 0)
        <div class="container">
            <div style="margin-top: 25px;" class="confirmation row">
                <div class="col-md-4">
                    <a href="{{route('a-confirmation-publ', ['id' => $publication->id])}}"
                       class="btn green filled-btn">Подтвердить</a>
                </div>
                <div class="col-md-4">
                    <a href="{{route('a-reject-publ', ['id' => $publication->id])}}"
                       class="btn orange filled-btn">Отклонить</a>
                </div>
            </div>
        </div>
    @endif
</section>
  @include('header_footer/newsletter')
  @include('header_footer/footer')
@include('script')
</body>
</html>
