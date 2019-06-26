<?php

Breadcrumbs::register('home', function($breadcrumbs) {
	$breadcrumbs->push('Главная', route('home'));
});

Breadcrumbs::register('competitions', function($breadcrumbs) {
	$breadcrumbs->parent('home', route('home'));
	$breadcrumbs->push('Конкурсы', route('competitions'));
});