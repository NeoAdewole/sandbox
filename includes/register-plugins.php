<?php

function sandbox_register_plugins()
{
  $plugins = [
    [
      'name' => 'Regenerate Thumbnails',
      'slug' => 'regenerate-thumbnails',
      'required' => false
    ],
    [
      'name' => 'Clear Blocks Plugin',
      'slug' => 'clearblocks',
      'required' => true,
      'source' => get_template_directory() . '/plugins/clearblocks.zip'
    ]
  ];
  $config = [
    'id' => 'cleatcut',
    'menu' => 'tgmpa-install-plugins',
    'parent_slug' => 'themes.php',
    'capability' => 'edit_theme_options',
    'has_notices' => true,
    'dismissable' => true
  ];

  tgmpa($plugins, $config);
}
