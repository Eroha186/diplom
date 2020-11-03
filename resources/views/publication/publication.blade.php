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
            {{$publication->kind->name}}
        </h2>
        <div class="row">
            <div class="col-xl-12 competitions__descr">
               {{$publication->annotation}}
            </div>
            <a href="/form-publication" class="publish-publication"><img src="{{asset('images/upload.svg')}}" alt=""><span>Добавить работу</span></a>
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
              
                <div class="publication-content__viewport">
                    <div class="row">
                        <div class="col-xl-12 h940">
                           <div class="publication-content__text" id="readable">
            <input type="text" id="publication-content__text" class="hide" value="{{$publication->text}}">
            
        </div>
        <div class="text-center publication-content__image" >
                  @foreach($publication->images as $image)
              <a href="{{Storage::url($image)}}" data-fancybox="gallery">  <img src="{{Storage::url($image)}}"  alt=""></a>
            @endforeach

            </div>
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
                     <div class="publication-content__passage">
            @foreach($publication->images as $image)
              <a href="{{Storage::url($image)}}" data-fancybox="gallery">  <img src="{{Storage::url($image)}}" width="100" alt=""></a>
            @endforeach
        </div>
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
                      @if(isset($publication->doc))
                    <div class="download-block doc-block"><a href="{{Storage::url($publication->doc)}}"><img src="{{asset('images/doc2.svg')}}" alt="">СКАЧАТЬ (.doc) </a></div>
                       @endif
                       @if(isset($publication->ppt))
                    <div class="download-block ppt-block"><a href="{{Storage::url($publication->ppt)}}"><img src="{{asset('images/ptt.svg')}}" alt="">СКАЧАТЬ (.ptt)</a></div>
                      @endif
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

        
       
        <div class="row">
        <div class="col-xl-12">
            <div class="share-work">
                <p>Понравился материал? Поделитесь с друзьями!</p>
                <ul class="share-works">
                    <li class="social-item" id="social-vk" title="Вконтакте"><a href=""><i class="fab fa-vk"></i></a></li>
                    <li class="social-item" id="social-fb" title="Фейсбук"><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li class="social-item" id="social-tw" title="Твиттер"><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li class="social-item" id="social-ok" title="Одноклассники"><a href=""><i class="fab fa-odnoklassniki"></i></a></li>
                    <li class="social-item" id="social-tg" title="Телеграм"><a href=""><i class="fab fa-telegram-plane"></i></a></li>
                </ul>
            </div>
        </div>
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
