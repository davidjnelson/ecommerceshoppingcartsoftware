    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
                        <td class="pageHeading">
             <?php
               if ( (ALLOW_CATEGORY_DESCRIPTIONS == 'true') && (escs_not_null($category['categories_heading_title'])) ) {
                 echo $category['categories_heading_title'];
               } else {
                 echo HEADING_TITLE;
               }
             ?>
	  <?php if ( (ALLOW_CATEGORY_DESCRIPTIONS == 'true') && (escs_not_null($category['categories_description'])) ) { ?>
	  <tr>
            <td align="left" colspan="2" class="category_desc"><?php echo $category['categories_description']; ?></td>
	  </tr>
	  <?php } ?>
            </td>
            <td class="pageHeading" align="right"></td>
          </tr>

	          </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <!--
          <tr>
            <td class="main"><?php echo escs_customer_greeting(); ?></td>
          </tr>
        -->
          <tr>
            <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFINE_MAINPAGE); ?></td>
          </tr>
          <tr>
            <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td><br><?php include(DIR_WS_MODULES . FILENAME_DEFAULT_SPECIALS); ?></td>
          </tr>
          <tr>
            <td><br><?php include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS); ?></td>
          </tr>
<?php
    include(DIR_WS_MODULES . FILENAME_UPCOMING_PRODUCTS);
?>
        </table></td>
      </tr>
    </table>