<div class="row p15">
    @foreach($publications as $publication)
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
                        {{$publication->user->f}} {{$publication->user->i}}. {{$publication->user->i}}.,
                        {{$publication->user->stuff}},
                        {{$publication->user->town}},
                        {{$publication->user->job}}
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
                @foreach($publication->themes as $theme)
                    <div class="tag">{{$theme->name}}</div>
                @endforeach
            </div>
        </div>

    @endforeach
</div>
<div class="row">
    <div class="col-xl-3">
        <a href="{{route('form-publication')}}" class="publish-publication">Опубликовать работу</a>
    </div>
</div>
<div class="pagination">
    {{$publications->links('paginate')}}
</div>
