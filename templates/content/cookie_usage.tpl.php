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
      <tr>
        <td class="main"><table border="0" width="40%" cellspacing="0" cellpadding="0" align="right">
          <tr>
            <td><?php new infoBoxHeading(array(array('text' => BOX_INFORMATION_HEADING))); ?></td>
          </tr>
          <tr>
            <td><?php new infoBox(array(array('text' => BOX_INFORMATION))); ?></td>
          </tr>
        </table><?php echo TEXT_INFORMATION; ?></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
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
    </table>

