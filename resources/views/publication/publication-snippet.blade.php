@foreach($publications as $publication)
    <div class="row p15">
        <div class="col-xl-12 publication-card">
            <div class="row">
                <div class="col-xl-10">
                    <div class="publication-card__title">
                        <a href="/publication/{{$publication->id}}">{{$publication->title}}</a>
                    </div>
                </div>
            </div>
            <div class="publish-card__date">Опублековано {{$publication->date_add}}</div>
            <div class="row">
                <div class="col-xl-10">
                    <div class="publication-card__author">Автор
                        {{$publication->author->f}} {{$publication->author->i}}. {{$publication->author->i}}.,
                        {{$publication->author->stuff}},
                        {{$publication->author->town}},
                        {{$publication->author->job}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10">
                    <div class="publication-card__descr">
                        {{$publication->annotation}}
                    </div>
                </div>
            </div>
            <div class="publication-card__img">
                @if(isset($publication['doc']))
                    <div class="img file">
                        <img src="{{asset("/images/doc.svg")}}" alt="">
                    </div>
                @endif
                @if(isset($publication['ppt']))
                    <div class="img file">
                        <img src="{{asset("/images/ppt.svg")}}" alt="">
                    </div>
                @endif
            </div>
            <div class="publication-card__tags">
                @foreach($publication->theme as $theme)
                    <div class="tag">{{$theme->name}}</div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
