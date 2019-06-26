@if($breadcrumbs)
	<ul class="breadcrumb">
		@foreach ($breadcrumbs as $breadcrumb)
			@if (!$breadcrumb->last)
				<li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li> <span style="margin: 0px 3px;">>></span>
			@else
				<li> <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
			@endif
		@endforeach
	</ul>
@endif