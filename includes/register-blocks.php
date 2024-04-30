<?php

function sandbox_register_blocks()
{
  $blocks = [
    // ['name' => 'blocky'],
    // ['name' => 'basic'],
    ['name' => 'character'],
    ['name' => 'slider'],
    ['name' => 'slide']
  ];

  foreach ($blocks as $block) {
    register_block_type(
      SANDBOX__BLOCK_DIR . $block['name'],
      isset($block['options']) ? $block['options'] : []
    );
  }
}
add_action('init', 'sandbox_register_blocks');
