<?php
if (!c::get('analytics', false)) return;

// Register blueprints
$kirby->set('blueprint', 'fields/analytics',  __DIR__ . '/blueprints/fields/analytics.yml');

// Register snippets
$kirby->set('snippet', 'analytics', __DIR__ . '/snippets/analytics.php');
