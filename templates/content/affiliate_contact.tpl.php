<table border="0" width="100%" cellspacing="0" cellpadding="0">
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
<?php
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'success')) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_SUCCESS; ?></td>
          </tr>
          <tr>
            <td align="right"><br><a href="<?php echo escs_href_link(FILENAME_AFFILIATE_SUMMARY); ?>"><?php echo escs_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></a></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td><?php echo escs_draw_form('contact_us', escs_href_link(FILENAME_AFFILIATE_CONTACT, 'action=send')); ?><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_NAME; ?><br><?php echo escs_draw_input_field('name', $affiliate['affiliate_firstname'] . ' ' . $affiliate['affiliate_lastname'], 'size=40'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_EMAIL; ?><br><?php echo escs_draw_input_field('email', $affiliate['affiliate_email_address'], 'size=40'); if ($error) echo ENTRY_EMAIL_ADDRESS_CHECK_ERROR; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_ENQUIRY; ?></td>
          </tr>
          <tr>
            <td><?php echo escs_draw_textarea_field('enquiry', 'soft', 50, 15, $HTTP_POST_VARS['enquiry']); ?></td>
          </tr>
          <tr>
            <td class="main" align="right"><br><?php echo escs_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
          </tr>
        </table></form></td>
      </tr>
<?php
  }
?>
    </table>