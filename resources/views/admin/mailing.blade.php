@extends('admin.main')

@section('content')
    <div id="publ-tabs">
        <ul class="tabs">
            <li class="competition-tab tab competition-tab_active" data-tab="1">Начать рассылку</li>
            <li class="competition-tab tab" data-tab="2">История рассылок</li>
        </ul>
        <div class="tab-content content_active competition-tab-content" data-tab="1">
            <div class="wrap-mailing">
                <div class="mailing-option">
                    @if($newMailing)
                        <form action="{{ route('a-global-mailing') }}" method="POST" class="form-mailing">
                            {{ csrf_field() }}
                            <label for="theme">Тема письма</label>
                            <input type="text" class="form-control" id="theme" name="theme">
                            <label for="template">Шаблон</label>
                            <select name="template" class="form-control" id="template">
                                <option value="0">Выберите шаблон</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>
                            <button>Начать рассылку</button>
                        </form>
                    @else
                        <h1>Рассылка еще идет</h1>
                        <div class="progress-wrap progress" data-progress-percent="100">
                            <div class="progress-bar progress"></div>
                        </div>

                        <a href="{{ route('a-end_mailing') }}" class="button transparent-btn">Отменить рассылку</a>

                        <script>
                            setInterval(() => {
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: '/admin/progress',
                                    type: 'GET',
                                    success: function (e) {
                                        $('.progress-wrap').attr('data-progress-percent', (e.now / e.all) * 100);

                                        moveProgressBar();
                                    }
                                });
                            }, 1000);

                            function moveProgressBar() {
                                var getPercent = ($('.progress-wrap').attr('data-progress-percent') / 100);
                                var getProgressWrapWidth = $('.progress-wrap').width();
                                var progressTotal = getPercent * getProgressWrapWidth;
                                var animationLength = 250;

                                // on page load, animate percentage bar to data percentage length
                                // .stop() used to prevent animation queueing
                                $('.progress-bar').stop().animate({
                                    left: progressTotal
                                }, animationLength);

                                if(getPercent * 100 === 100) {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 350)
                                }
                            }
                        </script>
                    @endif
                </div>
                <div class="mail-demo"></div>

            </div>
        </div>
        <div class="tab-content competition-tab-content" data-tab="2">
            <div class="history-mailing">
                <table class="history-mailing__table">
                    <tr class="text-center">
                        <th>№</th>
                        <th>Номер шаблона</th>
                        <th>Кол-во отправленных сообщений</th>
                        <th>Статус</th>
                        <th>Дата рассылки</th>
                    </tr>
                    @foreach($items as $item)
                        <tr class="text-center">
                            <td >{{ $item->id }}</td>
                            <td >{{ $item->template_id }}</td>
                            <td >{{ $item->number_mail }}</td>
                            <td >{{ $item->status }}</td>
                            <td >{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection