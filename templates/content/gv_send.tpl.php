<table width="100%" border="0" cellspacing="2" cellpadding="1">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                <td align="right">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>
        <?php
  if ($HTTP_GET_VARS['action'] == 'process') {
?>
        <tr>
          <td class="main"> <?php echo TEXT_SUCCESS; ?><br>
            <br>
            <?php echo 'gv '.$id1; ?></td>
        </tr>
        <tr>
          <td align="right"><br>
            <a href="<?php echo escs_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo escs_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></a></td>
        </tr>
        <?php
  }
  if ($HTTP_GET_VARS['action'] == 'send' && !$error) {
    // validate entries
      $gv_amount = (double) $gv_amount;
      $gv_query = escs_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
      $gv_result = escs_db_fetch_array($gv_query);
      $send_name = $gv_result['customers_firstname'] . ' ' . $gv_result['customers_lastname'];
?>
        <tr>
          <td><form action="<?php echo escs_href_link(FILENAME_GV_SEND, 'action=process', 'NONSSL'); ?>" method="post">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                  <td class="main"><?php echo sprintf(MAIN_MESSAGE, $currencies->format($HTTP_POST_VARS['amount']), $HTTP_POST_VARS['to_name'], $HTTP_POST_VARS['email'], $HTTP_POST_VARS['to_name'], $currencies->format($HTTP_POST_VARS['amount']), $send_name); ?></td>
                </tr>
                <?php
      if ($HTTP_POST_VARS['message']) {
?>
                <tr>
                  <td class="main"><?php echo sprintf(PERSONAL_MESSAGE, $gv_result['customers_firstname']); ?></td>
                </tr>
                <tr>
                  <td class="main"><?php echo stripslashes($HTTP_POST_VARS['message']); ?></td>
                </tr>
                <?php
      }

      echo escs_draw_hidden_field('send_name', $send_name) . escs_draw_hidden_field('to_name', $HTTP_POST_VARS['to_name']) . escs_draw_hidden_field('email', $HTTP_POST_VARS['email']) . escs_draw_hidden_field('amount', $gv_amount) . escs_draw_hidden_field('message', $HTTP_POST_VARS['message']);
?>
                <tr>
                  <td class="main"><?php echo escs_image_submit('button_back.gif', IMAGE_BUTTON_BACK, 'name=back') . '</a>'; ?></td>
                  <td align="right"><br>
                    <?php echo escs_image_submit('button_send.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <?php
  } elseif ($HTTP_GET_VARS['action']=='' || $error) {
?>
        <tr>
          <td class="main"><?php echo HEADING_TEXT; ?></td>
        </tr>
        <tr>
          <td><form action="<?php echo escs_href_link(FILENAME_GV_SEND, 'action=send', 'NONSSL'); ?>" method="post">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                  <td class="main"><?php echo ENTRY_NAME; ?><br>
                    <?php echo escs_draw_input_field('to_name', $HTTP_POST_VARS['to_name']);?></td>
                </tr>
                <tr>
                  <td class="main"><?php echo ENTRY_EMAIL; ?><br>
                    <?php echo escs_draw_input_field('email', $HTTP_POST_VARS['email']); if ($error) echo $error_email; ?></td>
                </tr>
                <tr>
                  <td class="main"><?php echo ENTRY_AMOUNT; ?><br>
                    <?php echo escs_draw_input_field('amount', $HTTP_POST_VARS['amount'], '', '', false); if ($error) echo $error_amount; ?></td>
                </tr>
                <tr>
                  <td class="main"><?php echo ENTRY_MESSAGE; ?><br>
                    <?php echo escs_draw_textarea_field('message', 'soft', 50, 15, stripslashes($HTTP_POST_VARS['message'])); ?></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                  <?php
    $back = sizeof($navigation->path)-2;
?>
                  <td class="main"><?php echo '<a href="' . escs_href_link($navigation->path[$back]['page'], escs_array_to_string($navigation->path[$back]['get'], array('action')), $navigation->path[$back]['mode']) . '">' . escs_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                  <td class="main" align="right"><?php echo escs_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <?php
  }
?>
      </table></td>
  </tr>
</table>

