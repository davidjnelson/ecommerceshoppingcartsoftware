<div align="center">
<a href="javascript:;" onclick="javascript:top.window.close();">
<?php
//$thumb_len = ((MAIN_THUMB_IN_SUBDIR == 'true') ? strlen(IN_IMAGE_THUMBS) : 0);
//$thumbs = ((MAIN_THUMB_IN_SUBDIR == 'true') ? IN_IMAGE_THUMBS : '');
//$image_base = substr($products['products_image'], $thumb_len, -4);
//$image_base = $products['products_image'];
//$image_ext = '.' . BIG_IMAGE_TYPE;
//$image_path = DIR_WS_IMAGES; // . IN_IMAGE_BIGIMAGES;
//$image_addon = (($_GET['pic']) ? MORE_PICS_EXT . $_GET['pic'] : BIG_PIC_EXT);

/*
   if the big image isn't shown uncomment the next line, and check the path:
   maybe you have to remove '/'. or adjust the path, depends on your configuration
*/
 //echo DIR_FS_CATALOG . $image_path . $image_base . $image_addon . $image_ext . '<br>';

	//$image = $image_path . $image_base;
$image = DIR_WS_IMAGES . $HTTP_GET_VARS['image'];

  echo escs_image($image, $products_values['products_name'], '', '', 'lowsrc="images/pixel_trans.gif"');
?>
</a>
</div>