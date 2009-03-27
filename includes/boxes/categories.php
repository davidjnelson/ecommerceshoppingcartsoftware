<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  $boxHeading = BOX_HEADING_CATEGORIES;
  $corner_left = 'rounded';
  $corner_right = 'square';

  function escs_show_category($counter) {

// BoF - Contribution Category Box Enhancement 1.1
    global $tree, $boxContent, $cPath_array, $cat_name;

    for ($i=0; $i<$tree[$counter]['level']; $i++) {
      $boxContent .= "&nbsp;&nbsp;";
    }
    $cPath_new = 'cPath=' . $tree[$counter]['path'];
    $boxContent .= '<a href="';
    $boxContent .= escs_href_link(FILENAME_DEFAULT, $cPath_new) . '">';

    if (escs_has_category_subcategories($counter)) {
      $boxContent .= escs_image(DIR_WS_IMAGES . 'pointer_blue.gif', '');
    }
    else {
      $boxContent .= escs_image(DIR_WS_IMAGES . 'pointer_blue_light.gif', '');
    }

    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $boxContent .= '<b>';
    }

    if ($cat_name == $tree[$counter]['name']) {
      $boxContent .= '<span class="errorText">';
    }

// display category name
    $boxContent .= $tree[$counter]['name'];

                if ($cat_name == $tree[$counter]['name']) {
                        $boxContent .= '</span>';
    }

    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $boxContent .= '</b>';
    }
//         EoF Category Box Enhancement

    $boxContent .= '</a>';

    if (SHOW_COUNTS == 'true') {
      $products_in_category = escs_count_products_in_category($counter);
      if ($products_in_category > 0) {
        $boxContent .= '&nbsp;(' . $products_in_category . ')';
      }
    }

    $boxContent .= '<br>';

    if ($tree[$counter]['next_id'] != false) {
      escs_show_category($tree[$counter]['next_id']);
    }
  }
?>
<!-- categories //-->
<?php
// BoF - Contribution Category Box Enhancement 1.1
 if (isset($cPath_array)) {
                for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
                                $categories_query = escs_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
                                if (escs_db_num_rows($categories_query) > 0)
                                $categories = escs_db_fetch_array($categories_query);
                }
        $cat_name = $categories['categories_name'];
        }
// EoF Category Box Enhancement

  $boxContent = '';
  $tree = array();

  $categories_query = escs_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
  while ($categories = escs_db_fetch_array($categories_query))  {
    $tree[$categories['categories_id']] = array('name' => $categories['categories_name'],
                                                'parent' => $categories['parent_id'],
                                                'level' => 0,
                                                'path' => $categories['categories_id'],
                                                'next_id' => false);

    if (isset($parent_id)) {
      $tree[$parent_id]['next_id'] = $categories['categories_id'];
    }

    $parent_id = $categories['categories_id'];

    if (!isset($first_element)) {
      $first_element = $categories['categories_id'];
    }
  }

  //------------------------
  if (escs_not_null($cPath)) {
    $new_path = '';
    reset($cPath_array);
    while (list($key, $value) = each($cPath_array)) {
      unset($parent_id);
      unset($first_id);
      $categories_query = escs_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$value . "' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
      if (escs_db_num_rows($categories_query)) {
        $new_path .= $value;
        while ($row = escs_db_fetch_array($categories_query)) {
          $tree[$row['categories_id']] = array('name' => $row['categories_name'],
                                               'parent' => $row['parent_id'],
                                               'level' => $key+1,
                                               'path' => $new_path . '_' . $row['categories_id'],
                                               'next_id' => false);

          if (isset($parent_id)) {
            $tree[$parent_id]['next_id'] = $row['categories_id'];
          }

          $parent_id = $row['categories_id'];

          if (!isset($first_id)) {
            $first_id = $row['categories_id'];
          }

          $last_id = $row['categories_id'];
        }
        $tree[$last_id]['next_id'] = $tree[$value]['next_id'];
        $tree[$value]['next_id'] = $first_id;
        $new_path .= '_';
      } else {
        break;
      }
    }
  }
  escs_show_category($first_element);

  require(DIR_WS_TEMPLATES . TEMPLATENAME_BOX);
?>
<!-- categories_eof //-->
