    <?php echo escs_draw_form('cart_quantity', escs_href_link(FILENAME_PRODUCT_INFO, escs_get_all_get_params(array('action')) . 'action=add_product')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
  if ($product_check['total'] < 1) {
?>
      <tr>
        <td><?php new infoBox(array(array('text' => TEXT_PRODUCT_NOT_FOUND))); ?></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . escs_href_link(FILENAME_DEFAULT) . '">' . escs_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
    $product_info_query = escs_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id, product_image2, product_image3, product_image4, product_image5, product_image6, product_image7, product_image8, product_image9, product_image10 from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = escs_db_fetch_array($product_info_query);

    escs_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and language_id = '" . (int)$languages_id . "'");

    if ($new_price = escs_get_products_special_price($product_info['products_id'])) {
// ***** Begin Separate price per customer mod *****
            global $customer_id;
          $customer_group_query = escs_db_query("select customers_group_id from " . TABLE_CUSTOMERS . "        where customers_id =  '" . $customer_id . "'");
          $customer_group = escs_db_fetch_array($customer_group_query);

        $scustomer_group_price_query = escs_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id']. "' and customers_group_id =  '" . $customer_group['customers_group_id'] . "'");
        if ($scustomer_group_price = escs_db_fetch_array($scustomer_group_price_query))
        $product_info['products_price']= $scustomer_group_price['customers_group_price'];
// ***** Begin Separate price per customer mod *****
      $products_price = '<s>' . $currencies->display_price($product_info['products_price'], escs_get_tax_rate($product_info['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, escs_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
    } else {
//************Begin Separate Price per Customer mod **************
//     $products_price = $currencies->display_price($product_info['products_price'], escs_get_tax_rate($product_info['products_tax_class_id']));
global $customer_id;
$customer_group_query = escs_db_query("select customers_group_id from " . TABLE_CUSTOMERS . " where customers_id =  '" . $customer_id . "'");
$customer_group = escs_db_fetch_array($customer_group_query);
$customer_group_price_query = escs_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $HTTP_GET_VARS['products_id'] . "' and customers_group_id =  '" . $customer_group['customers_group_id'] . "'");
if ( $customer_group['customers_group_id'] != 0) {
  if ($customer_group_price = escs_db_fetch_array($customer_group_price_query)) {
    $products_price = $currencies->display_price($customer_group_price['customers_group_price'], escs_get_tax_rate($product_info['products_tax_class_id']));
  } else {
      $products_price = $currencies->display_price($product_info['products_price'], escs_get_tax_rate($product_info['products_tax_class_id']));
    }
} else {
    $products_price = $currencies->display_price($product_info['products_price'], escs_get_tax_rate($product_info['products_tax_class_id']));
  }
//***********End Separate Price per Customer mod **************
    }

    if (escs_not_null($product_info['products_model'])) {
      $products_name = $product_info['products_name'] . '<br><span class="smallText">[' . $product_info['products_model'] . ']</span>';
    } else {
      $products_name = $product_info['products_name'];
    }
?>

      <tr>
      	<td align="right">
      		<table border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td>
      					<table border="0" cellspacing="0" cellpadding="10">
      						<tr>
      							<td bgcolor="#ffffcc">
							      	<? print escs_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART); ?><br>
							    </td>
							</tr>
						</table>
				    </td>
				</tr>
			</table>
			<br>
      	</td>
      </tr>
      <tr valign="top">
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr valign="top">
            <td class="pageHeading" valign="top"><?php echo $products_name; ?></td>
            <td class="pageHeading" align="right" valign="top"><?php echo $products_price; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main">
        <table border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
        <td width="95%" class="main">
        <?php echo stripslashes($product_info['products_description']); ?>
        <p><br></p>
		</td>
		<td width="5%" align="center" class="main">
<?php
    for($i=1;$i<=10;$i++)
    {
      $image_name = '';
      if($i == 1)
      {
        $image_name = 'products_image';
      }
      else
      {
        $image_name = 'product_image' . $i;
      }
    if (escs_not_null($product_info[$image_name])) {
?>

<script language="javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . escs_href_link(FILENAME_POPUP_IMAGE, 'image=' . $product_info[$image_name]) . '\\\')">' . escs_image(DIR_WS_IMAGES . $product_info[$image_name], addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . escs_href_link(DIR_WS_IMAGES . $product_info[$image_name]) . '" target="_blank">' . escs_image(DIR_WS_IMAGES . $product_info['products_image'], $product_info['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
</noscript>


<?php
    }
    }
?>
</td>
</tr>
</table>

<?php
    $products_attributes_query = escs_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = escs_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
?>
          <table border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td class="main" colspan="2"><?php echo TEXT_PRODUCT_OPTIONS; ?></td>
            </tr>
<?php
      $products_options_name_query = escs_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = escs_db_fetch_array($products_options_name_query)) {
        $products_options_array = array();
        $products_options_query = escs_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = escs_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], escs_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }

        if (isset($cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }
?>
            <tr>
              <td class="main"><?php echo $products_options_name['products_options_name'] . ':'; ?></td>
              <td class="main"><?php echo escs_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute); ?></td>
            </tr>
<?php
      }
?>
          </table>
<?php
    }
?>
        </td>
      </tr>
      <tr>
      	<td>
	<?php include(DIR_WS_MODULES . FILENAME_DYNAMIC_MOPICS); ?>
	</td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    $reviews_query = escs_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'");
    $reviews = escs_db_fetch_array($reviews_query);
    if ($reviews['count'] > 0) {
?>
      <tr>
        <td class="main"><?php echo TEXT_CURRENT_REVIEWS . ' ' . $reviews['count']; ?></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    }

    if (escs_not_null($product_info['products_url'])) {
?>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_MORE_INFORMATION, escs_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false)); ?></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    }

    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_DATE_AVAILABLE, escs_date_long($product_info['products_date_available'])); ?></td>
      </tr>
<?php
    } else {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_DATE_ADDED, escs_date_long($product_info['products_date_added'])); ?></td>
      </tr>
<?php
    }
?>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main"><?php echo '<a href="' . escs_href_link(FILENAME_PRODUCT_REVIEWS, escs_get_all_get_params()) . '">' . escs_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS) . '</a>'; ?></td>
                <td class="main" align="right"><?php echo escs_draw_hidden_field('products_id', $product_info['products_id']) . escs_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART); ?></td>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php

//Commented for x-sell
//    if ((USE_CACHE == 'true') && empty($SID)) {
//      echo escs_cache_also_purchased(3600);
//    } else {
//      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
//    }
//  }
//Added for x sell
   if ( (USE_CACHE == 'true') && !SID) {
    echo escs_cache_also_purchased(3600);
     include(DIR_WS_MODULES . FILENAME_XSELL_PRODUCTS);
   } else {
     include(DIR_WS_MODULES . FILENAME_XSELL_PRODUCTS);
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }
   }
?>
        </td>
      </tr>
    </table></form>