<?php
/* bof catdesc for bts1a */
// Get the category name and description from the database
    $category_query = escs_db_query("select cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");
    $category = escs_db_fetch_array($category_query);
/* bof catdesc for bts1a */
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
                        <td class="pageHeading">
<?php
/* bof catdesc for bts1a, replacing "echo HEADING_TITLE;" by "categories_heading_title" */
             //if ( (ALLOW_CATEGORY_DESCRIPTIONS == 'true') && (escs_not_null($category['categories_heading_title'])) ) {
             //    echo $category['categories_heading_title'];
             //  } //else {
             //    echo HEADING_TITLE;
             //  }
/* eof catdesc for bts1a */ ?>
			<?
				if(isset($HTTP_GET_VARS['manufacturers_id']))
				{
					$manufacturers_query_here = escs_db_query("select manufacturers_name from manufacturers where manufacturers_id = '" .
						escs_db_prepare_input($HTTP_GET_VARS['manufacturers_id']) . "'");
					$manufacturers_here = escs_db_fetch_array($manufacturers_query_here);
					print $manufacturers_here['manufacturers_name'];
				}
				if(isset($HTTP_GET_VARS['cPath']))
				{
					$category_query_here = escs_db_query("select categories_name from categories_description where categories_id = '" .
						escs_db_prepare_input($HTTP_GET_VARS['cPath']) . "'");
					$category_here = escs_db_fetch_array($category_query_here);
					print $category_here['categories_name'];
				}
			?>
            </td>
<?php
// optional Product List Filter
    if (PRODUCT_LIST_FILTER > 0) {
      if (isset($HTTP_GET_VARS['manufacturers_id'])) {
        $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' order by cd.categories_name";
      } else {
        $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
      }
      $filterlist_query = escs_db_query($filterlist_sql);
      if (escs_db_num_rows($filterlist_query) > 1) {
        echo '            <td align="center" class="main">' . escs_draw_form('filter', FILENAME_DEFAULT, 'get') . TEXT_SHOW . '&nbsp;';
        if (isset($HTTP_GET_VARS['manufacturers_id'])) {
          echo escs_draw_hidden_field('manufacturers_id', $HTTP_GET_VARS['manufacturers_id']);
          $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
        } else {
          echo escs_draw_hidden_field('cPath', $cPath);
          $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
        }
        echo escs_draw_hidden_field('sort', $HTTP_GET_VARS['sort']);
        while ($filterlist = escs_db_fetch_array($filterlist_query)) {
          $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        }
        echo escs_draw_pull_down_menu('filter_id', $options, (isset($HTTP_GET_VARS['filter_id']) ? $HTTP_GET_VARS['filter_id'] : ''), 'onchange="this.form.submit()"');
        echo '</form></td>' . "\n";
      }
    }

// Get the right image for the top-right
    $image = DIR_WS_IMAGES . 'table_background_list.gif';
    if (isset($HTTP_GET_VARS['manufacturers_id'])) {
      $image = escs_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'");
      $image = escs_db_fetch_array($image);
      $image = $image['manufacturers_image'];
    } elseif ($current_category_id) {
      $image = escs_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
      $image = escs_db_fetch_array($image);
      $image = $image['categories_image'];
    }
?>
            <td align="right"><?php echo escs_image(DIR_WS_IMAGES . $image, HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
	  <?php if ( (ALLOW_CATEGORY_DESCRIPTIONS == 'true') && (escs_not_null($category['categories_description'])) ) { ?>
	  <tr>
            <td align="left" colspan="2" class="category_desc"><?php echo $category['categories_description']; ?></td>
	  </tr>
	  <?php } ?>
        </table></td>
      </tr>
      <tr>
        <td><?php echo escs_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><?php include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL); ?></td>
      </tr>
    </table>
