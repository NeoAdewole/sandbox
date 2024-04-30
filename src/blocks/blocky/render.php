<?php
/* 
* Path: src/blocks/blocky/render.php
* Playground block template file
* 
*/

// Create id attribute allowing for custom "anchor" value.

$id = $attributes['id'] ?? '';
if ($id) {
  $id = ' id="' . esc_attr($id) . '"';
}
$content = $attributes['content'] ?? '';
$className = $attributes['className'] ?? '';

?>

<div <?php echo get_block_wrapper_attributes(); ?> venue="rendered">
  <h2>Blocky Block</h2>
  <p><?php echo $content; ?></p>
  <p><?php echo $className; ?></p>
  <p><?php echo $id; ?></p>
</div>