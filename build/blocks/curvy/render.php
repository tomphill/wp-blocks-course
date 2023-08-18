<?
$block_wrapper_attributes = get_block_wrapper_attributes([
  'class' => 'alignfull'
]);
$normalPath =
  "M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z";
$invertedPath =
  "M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z";

$topTransform = "scaleX(" . ($attributes['topFlipX'] ? "-1" : "1") . ") rotate(" . ($attributes['topFlipY'] ? "180deg" : "0") . ")";
$bottomTransform = "scaleY(-1) scaleX(" . ($attributes['bottomFlipX'] ? "-1" : "1") . ") rotate(" . ($attributes['bottomFlipY'] ? "180deg" : "0") . ")";
//wp_send_json($content);
?>
<div <? echo $block_wrapper_attributes; ?>>
  <div class="curve top-curve" style="display: <? echo $attributes['enableTopCurve'] ? "block" : "none" ?>; transform: <? echo $topTransform; ?>; height: <? echo $attributes['topHeight'] ?>px;">
    <svg style="height: <? echo $attributes['topHeight'] ?>px; width: <? echo $attributes['topWidth'] ?>%" preserveAspectRatio="none" viewBox="0 0 1200 120">
      <path fill="<? echo $attributes['topColor'] ?? "white" ?>" d="<? echo $attributes['topFlipY'] ? $invertedPath : $normalPath; ?>"></path>
    </svg>
  </div>
  <div style="position: relative; z-index: 1;">
    <? echo $content; ?>
  </div>
  <div class="curve bottom-curve" style="z-index: 0; display: <? echo $attributes['enableBottomCurve'] ? "block" : "none" ?>; transform: <? echo $bottomTransform; ?>; height: <? echo $attributes['bottomHeight'] ?>px;">
    <svg style="height: <? echo $attributes['bottomHeight'] ?>px; width: <? echo $attributes['bottomWidth'] ?>%" preserveAspectRatio="none" viewBox="0 0 1200 120">
      <path fill="<? echo $attributes['bottomColor'] ?? "white" ?>" d="<? echo $attributes['bottomFlipY'] ? $invertedPath : $normalPath; ?>"></path>
    </svg>
  </div>
</div>