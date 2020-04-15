{{--<script--}}
{{--	src="https://code.jquery.com/jquery-3.4.1.min.js"--}}
{{--	integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="--}}
{{--	crossorigin="anonymous"></script>--}}
{{--<script src="{{ asset('js/select2.full.min.js') }}"></script>--}}
{{--<script src="{{asset('/js/manifest.js')}}"></script>--}}
{{--<script src="{{asset('/js/vendor.js')}}"></script>--}}
{{--<script src="{{asset('/js/app.js')}}"></script>--}}
{{--<script src="/js/manifest.js"></script>--}}
{{--<script src="/js/vendor.js"></script>--}}
{{--<script src="/js/app.js"></script>--}}
<script src="{{ asset('/js/manifest.js') }}"></script>
<script src="{{ asset('/js/vendor.js') }}"></script>
{{--<script src="{{ asset('/js/uploader/js/jquery.dm-uploader.min.js') }}"></script>--}}
<script src="{{ asset('/js/app.js') }}"></script>
@if(isset($substrates))
    @foreach($substrates as $substrate)
        @if($substrate->active_for_publ)
            <script>
                $(function () {
                    $("#substrate").trigger('change');
                })
            </script>
        @endif
    @endforeach
@endif