<?
$block_wrapper_attributes = get_block_wrapper_attributes();
?>
<div <? echo $block_wrapper_attributes; ?>>
  <div class="gallery-thumbnails">
    <? echo $content; ?>
  </div>
  <div>
    <img class="image-preview" />
  </div>
</div>