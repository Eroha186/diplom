<?php

Breadcrumbs::register('home', function($breadcrumbs) {
	$breadcrumbs->push('Главная', route('home'));
});

Breadcrumbs::register('competitions', function($breadcrumbs) {
	$breadcrumbs->parent('home', route('home'));
	$breadcrumbs->push('Конкурсы', route('competitions'));
});

Breadcrumbs::register('arch-competitions', function($breadcrumbs) {
	$breadcrumbs->parent('home', route('home'));
	$breadcrumbs->push('Архив конкурсы', route('arch-competitions'));
});

Breadcrumbs::register('publications', function($breadcrumbs) {
	$breadcrumbs->parent('home', route('home'));
	$breadcrumbs->push('Публикации', route('publications'));
});

Breadcrumbs::register('form-publication', function($breadcrumbs) {
  $breadcrumbs->parent('home', route('home'));
  $breadcrumbs->push('Публикации', route('publications'));
  $breadcrumbs->push('Заявление на публикацию', route('form-publication'));
});

Breadcrumbs::register('publication', function ($breadcrumbs, $publication) {
   $breadcrumbs->parent('publications', route('publications'));
   $breadcrumbs->push($publication->title, route('publication', $publication->id));
});
