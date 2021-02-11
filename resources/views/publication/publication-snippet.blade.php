
<div class="row p15">
    @foreach($publications as $publication)


    <div class="col-12 d-flex pub-item">
        <img src="{{asset('images/main_page/doc.png')}}" style="width: 32px; height: 40px; margin-right: 16px;" alt="">
        <div>

           <a href="/publication/{{$publication->id}}">{{$publication->title}}</a>
           <p><span>{{$publication->kind->name}} • {{$publication->education->name}}</span>            <span id="tags">
              @foreach ($publication->themes as $theme) 
              {{$theme->name}} <span>•</span>

              @endforeach
          </span></p>
          <p> {{$publication->annotation}}</p>

          <div class="d-flex mb-2">
             @foreach ($publication->files as $file)
             @php
             $filetype = explode('.', $file->url);
             if($filetype[1] == 'jpg' OR $filetype[1] == 'jpeg' OR  $filetype[1] == 'png') {
             @endphp
             <a href="/storage/{{$file->url}}" data-fancybox="gallery"><img class="img-fluid publication-thumb" width="50" src="/storage/{{$file->url}}" alt=""></a>
             @php
         } 
         @endphp
         @endforeach
     </div>
     <p class="main-page__last_pub-item-3 mb-0"><span>{{ date("d.m.Y", strtotime($publication->date_add)) }}</span>    <span>{{$publication->user->f}} {{$publication->user->i}} {{$publication->user->o}},
        {{$publication->user->stuff}},
        {{$publication->user->town}},
        {{$publication->user->job}}</span></p>
    </div>
</div>
       <!--  <div class="col-xl-12 publication-card">
            <div class="row">
                <div class="col-xl-10">
                    <div class="publication-card__title">
                        <a href="/publication/{{$publication->id}}">{{$publication->title}}</a>
                    </div>
                </div>
            </div>
            <div class="publish-card__date">Опубликовано {{ date("d.m.Y", strtotime($publication->date_add)) }}</div>
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
        </div> -->

        @endforeach
    </div>
<!-- <div class="row">
    <div class="col-xl-3">
        <a href="{{route('form-publication')}}" class="publish-publication">Опубликовать работу</a>
    </div>
</div> -->
<div class="pagination">
    {{$publications->links('paginate')}}
</div>
