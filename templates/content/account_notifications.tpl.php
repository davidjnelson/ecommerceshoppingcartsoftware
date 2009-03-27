    <?php echo escs_draw_form('account_notifications', escs_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL')) . escs_draw_hidden_field('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo MY_NOTIFICATIONS_TITLE; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main"><?php echo MY_NOTIFICATIONS_DESCRIPTION; ?></td>
                <td><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo GLOBAL_NOTIFICATIONS_TITLE; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox('product_global')">
                    <td class="main" width="30"><?php echo escs_draw_checkbox_field('product_global', '1', (($global['global_product_notifications'] == '1') ? true : false), 'onclick="checkBox(\'product_global\')"'); ?></td>
                    <td class="main"><b><?php echo GLOBAL_NOTIFICATIONS_TITLE; ?></b></td>
                  </tr>
                  <tr>
                    <td width="30">&nbsp;</td>
                    <td class="main"><?php echo GLOBAL_NOTIFICATIONS_DESCRIPTION; ?></td>
                  </tr>
                </table></td>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($global['global_product_notifications'] != '1') {
?>
      <tr>
        <td class="main"><b><?php echo NOTIFICATIONS_TITLE; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
    $products_check_query = escs_db_query("select count(*) as total from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$customer_id . "'");
    $products_check = escs_db_fetch_array($products_check_query);
    if ($products_check['total'] > 0) {
?>
                  <tr>
                    <td class="main" colspan="2"><?php echo NOTIFICATIONS_DESCRIPTION; ?></td>
                  </tr>
<?php
      $counter = 0;
      $products_query = escs_db_query("select pd.products_id, pd.products_name from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_NOTIFICATIONS . " pn where pn.customers_id = '" . (int)$customer_id . "' and pn.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by pd.products_name");
      while ($products = escs_db_fetch_array($products_query)) {
?>
                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="checkBox('products[<?php echo $counter; ?>]')">
                    <td class="main" width="30"><?php echo escs_draw_checkbox_field('products[' . $counter . ']', $products['products_id'], true, 'onclick="checkBox(\'products[' . $counter . ']\')"'); ?></td>
                    <td class="main"><b><?php echo $products['products_name']; ?></b></td>
                  </tr>
<?php
        $counter++;
      }
    } else {
?>
                  <tr>
                    <td class="main"><?php echo NOTIFICATIONS_NON_EXISTING; ?></td>
                  </tr>
<?php
    }
?>
                </table></td>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo '<a href="' . escs_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . escs_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td align="right"><?php echo escs_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></form>
