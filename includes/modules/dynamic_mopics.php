      	<table width="100%">
<?php
	$products_id = (($product_info['products_id']) ? $product_info['products_id'] : $product_info_values['products_id']);
	$products_name = (($product_info['products_name']) ? $product_info['products_name'] : $product_info_values['products_name']);
	$image_name = (($product_info['products_image']) ? $product_info['products_image'] : $product_info_values['products_image']);
	$thumb_len = ((MAIN_THUMB_IN_SUBDIR == 'true') ? strlen(IN_IMAGE_THUMBS) : 0);
	$image_base = substr($image_name, $thumb_len, -4);
	$image_ext = '.' . THUMB_IMAGE_TYPE;
	$image_path = DIR_WS_IMAGES . IN_IMAGE_THUMBS;

	if (is_file(DIR_FS_CATALOG . $image_path . $image_base . MORE_PICS_EXT . '1' . $image_ext)) {

	echo '      <tr width="100%">';

    $row = 0;
	$i = 1;
	while(is_file(DIR_FS_CATALOG . $image_path . $image_base . MORE_PICS_EXT . $i . $image_ext)) {
	  $image = $image_base . MORE_PICS_EXT . $i . $image_ext;
      $row++;
?>
		<td align="center" class="smallText">
<script language="javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . escs_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $products_id . '&pic=' . $i) . '\\\')">' . escs_image($image_path . $image, addslashes($products_name), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . escs_href_link($image_path . $image) . '" target="_blank">' . escs_image($image_path . $image, $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
</noscript>
		</td>
<?php
	  $i++;
      if ( (($row / THUMBS_PER_ROW) == floor($row / THUMBS_PER_ROW)) && (is_file(DIR_FS_CATALOG . $image_path . $image_base . MORE_PICS_EXT . $i . $image_ext)) ) {
		echo ' 	    </tr>';
		echo '      <tr width="100%">';
      }
	}

	echo '	    </tr>';

    } else {
?>
      <tr width="100%">
		<td align="left" class="smallText"><?php //echo TEXT_NO_MOPICS;
 ?></td>
	  </tr>
<?php
    }
?>
		</table>