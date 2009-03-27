<?php echo escs_draw_form('affiliate_signup',  escs_href_link(FILENAME_AFFILIATE_SIGNUP, '', 'SSL'), 'post') . escs_draw_hidden_field('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
        <td>
<?php
  if (isset($HTTP_GET_VARS['affiliate_email_address'])) $a_email_address = escs_db_prepare_input($HTTP_GET_VARS['affiliate_email_address']);
  $affiliate['affiliate_country_id'] = STORE_COUNTRY;

  require(DIR_WS_MODULES . 'affiliate_account_details.php');
?>
        </td>
      </tr>
      <tr>
        <td align="right" class="main"><br><?php echo escs_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
      </tr>
    </table></form>