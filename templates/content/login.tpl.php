    <?php echo escs_draw_form('login', escs_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>

<?php
  if ($messageStack->size('login') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('login'); ?></td>
      </tr>

<?php
  }

  if ($cart->count_contents() > 0) {
?>
      <tr>
        <td class="smallText"></td>
      </tr>

<?php
  }
?>
      <tr valign="top">
        <td>










        <table border="0" width="100%" cellspacing="0" cellpadding="16">
          <tr valign="top">
            <td width="50%" height="100%" valign="top">
            <table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td><table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td class="main" valign="top"><b><?php echo HEADING_NEW_CUSTOMER; ?></b><br>&nbsp;<br><?php echo TEXT_NEW_CUSTOMER_INTRODUCTION . '<br><br>' . '<a href="' . escs_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . escs_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="1">

            <table border="0" cellspacing="0" cellpadding="0" height="100%" width="1">
            <tr>
            <td bgcolor="black">
            </td>
            </tr>
            </table>

            </td>
            <td width="50%" valign="top">

            <table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td><table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="main" colspan="2"><b><?php echo HEADING_RETURNING_CUSTOMER; ?></b><br>&nbsp;<br><?php echo TEXT_RETURNING_CUSTOMER; ?><br>&nbsp;<br></td>
                  </tr>
                  <tr>
                    <td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
                    <td class="main"><?php echo escs_draw_input_field('email_address'); ?></td>
                  </tr>
                  <tr>
                    <td class="main"><b><?php echo ENTRY_PASSWORD; ?></b></td>
                    <td class="main"><?php echo escs_draw_password_field('password'); ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                  </tr>
                  <tr>
                    <td class="smallText" colspan="2"><?php echo '<a href="' . escs_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td align="right"><?php echo escs_image_submit('button_login.gif', IMAGE_BUTTON_LOGIN); ?></td>
                        <td width="10"><?php echo escs_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>





          </tr>
        </table></td>
      </tr>
    </table></form>

