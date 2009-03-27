<?php
/*
  $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  Ecommerce Shopping Cart Software
  http://www.ecommerceshoppingcartsoftware.org

  Copyright (c) 2004 Ecommerce Shopping Cart Software Developers.  Portions Copyright (c) 2001-2004 osCommerce: http://www.oscommerce.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $cat = array(array('title' => BOX_HEADING_CONFIGURATION,
//Admin begin
                     'access' => escs_admin_check_boxes('configuration.php'),
//Admin end
                     'image' => 'configuration.gif',
                     'href' => escs_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1'),
                     'children' => array(array('title' => BOX_CONFIGURATION_MYSTORE, 'link' => escs_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1')),
                                         array('title' => BOX_CONFIGURATION_LOGGING, 'link' => escs_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=10')),
                                         array('title' => BOX_CONFIGURATION_CACHE, 'link' => escs_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=11')))),
               array('title' => BOX_HEADING_MODULES,
//Admin begin
                     'access' => escs_admin_check_boxes('modules.php'),
//Admin end
                     'image' => 'modules.gif',
                     'href' => escs_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment'),
                     'children' => array(array('title' => BOX_MODULES_PAYMENT, 'link' => escs_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment')),
                                         array('title' => BOX_MODULES_SHIPPING, 'link' => escs_href_link(FILENAME_MODULES, 'selected_box=modules&set=shipping')))),
               array('title' => BOX_HEADING_CATALOG,
//Admin begin
                     'access' => escs_admin_check_boxes('catalog.php'),
//Admin end
                     'image' => 'catalog.gif',
                     'href' => escs_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'),
                     'children' => array(array('title' => CATALOG_CONTENTS, 'link' => escs_href_link(FILENAME_CATEGORIES, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_MANUFACTURERS, 'link' => escs_href_link(FILENAME_MANUFACTURERS, 'selected_box=catalog')))),
               array('title' => BOX_HEADING_LOCATION_AND_TAXES,
//Admin begin
                     'access' => escs_admin_check_boxes('taxes.php'),
//Admin end
                     'image' => 'location.gif',
                     'href' => escs_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'),
                     'children' => array(array('title' => BOX_TAXES_COUNTRIES, 'link' => escs_href_link(FILENAME_COUNTRIES, 'selected_box=taxes')),
                                         array('title' => BOX_TAXES_GEO_ZONES, 'link' => escs_href_link(FILENAME_GEO_ZONES, 'selected_box=taxes')))),
               array('title' => BOX_HEADING_CUSTOMERS,
//Admin begin
                     'access' => escs_admin_check_boxes('customers.php'),
//Admin end
                     'image' => 'customers.gif',
                     'href' => escs_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'),
                     'children' => array(array('title' => BOX_CUSTOMERS_CUSTOMERS, 'link' => escs_href_link(FILENAME_CUSTOMERS, 'selected_box=customers')),
                                         array('title' => BOX_CUSTOMERS_ORDERS, 'link' => escs_href_link(FILENAME_ORDERS, 'selected_box=customers')))),
               array('title' => BOX_HEADING_LOCALIZATION,
//Admin begin
                     'access' => escs_admin_check_boxes('localization.php'),
//Admin end
                     'image' => 'localization.gif',
                     'href' => escs_href_link(FILENAME_CURRENCIES, 'selected_box=localization'),
                     'children' => array(array('title' => BOX_LOCALIZATION_CURRENCIES, 'link' => escs_href_link(FILENAME_CURRENCIES, 'selected_box=localization')),
                                         array('title' => BOX_LOCALIZATION_LANGUAGES, 'link' => escs_href_link(FILENAME_LANGUAGES, 'selected_box=localization')))),
               array('title' => BOX_HEADING_REPORTS,
//Admin begin
                     'access' => escs_admin_check_boxes('reports.php'),
//Admin end
                     'image' => 'reports.gif',
                     'href' => escs_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports'),
                     'children' => array(array('title' => REPORTS_PRODUCTS, 'link' => escs_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports')),
                                         array('title' => REPORTS_ORDERS, 'link' => escs_href_link(FILENAME_STATS_CUSTOMERS, 'selected_box=reports')))),
array('title' => BOX_HEADING_AFFILIATE,
                     'image' => 'affiliate.gif',
                     'href' => escs_href_link(FILENAME_AFFILIATE_SUMMARY, 'selected_box=affiliate'),
                     'children' => array(array('title' => BOX_AFFILIATE, 'link' => escs_href_link(FILENAME_AFFILIATE, 'selected_box=affiliate')),
                                         array('title' => BOX_AFFILIATE_BANNERS, 'link' => escs_href_link(FILENAME_AFFILIATE_BANNERS, 'selected_box=affiliate')))),
//Admin begin
       	       array('title' => BOX_HEADING_MY_ACCOUNT,
                     'access' => 'true',
                     'image' => 'my_account.gif',
                     'href' => escs_href_link(FILENAME_ADMIN_ACCOUNT),
                     'children' => array(array('title' => HEADER_TITLE_ACCOUNT, 'link' => escs_href_link(FILENAME_ADMIN_ACCOUNT),
						'access' => 'true'),
						array('title' => HEADER_TITLE_LOGOFF, 'link' => escs_href_link(FILENAME_LOGOFF),
                                               'access' => 'true'))),
               array('title' => BOX_HEADING_ADMINISTRATOR,
                     'access' => escs_admin_check_boxes('administrator.php'),
                     'image' => 'administrator.gif',
                     'href' => escs_href_link(escs_selected_file('administrator.php'), 'selected_box=administrator'),
                     'children' => array(array('title' => BOX_ADMINISTRATOR_MEMBER, 'link' => escs_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator'),
                                               'access' => escs_admin_check_boxes(FILENAME_ADMIN_MEMBERS, 'sub_boxes')),
                                         array('title' => BOX_ADMINISTRATOR_BOXES, 'link' => escs_href_link(FILENAME_ADMIN_FILES, 'selected_box=administrator'),
                                               'access' => escs_admin_check_boxes(FILENAME_ADMIN_FILES, 'sub_boxes')))),
//Admin end
               array('title' => BOX_HEADING_TOOLS,
//Admin begin
                     'access' => escs_admin_check_boxes('tools.php'),
//Admin end
                     'image' => 'tools.gif',
                     'href' => escs_href_link(FILENAME_BACKUP, 'selected_box=tools'),
                     'children' => array(array('title' => TOOLS_BACKUP, 'link' => escs_href_link(FILENAME_BACKUP, 'selected_box=tools')),
                                         array('title' => TOOLS_BANNERS, 'link' => escs_href_link(FILENAME_BANNER_MANAGER, 'selected_box=tools')),
                                         array('title' => TOOLS_FILES, 'link' => escs_href_link(FILENAME_FILE_MANAGER, 'selected_box=tools')))));

  $languages = escs_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Ecommerce Shopping Cart Software Administration</title>
<style type="text/css"><!--
a { color:#080381; text-decoration:none; }
a:hover { color:#aabbdd; text-decoration:underline; }
a.text:link, a.text:visited { color: #000000; text-decoration: none; }
a:text:hover { color: #000000; text-decoration: underline; }
a.main:link, a.main:visited { color: #ffffff; text-decoration: none; }
A.main:hover { color: #ffffff; text-decoration: underline; }
a.sub:link, a.sub:visited { color: #dddddd; text-decoration: none; }
A.sub:hover { color: #dddddd; text-decoration: underline; }
.heading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px; font-weight: bold; line-height: 1.5; color: #D3DBFF; }
.main { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 17px; font-weight: bold; line-height: 1.5; color: #ffffff; }
.sub { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; line-height: 1.5; color: #dddddd; }
.text { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; line-height: 1.5; color: #000000; }
.menuBoxHeading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #ffffff; font-weight: bold; background-color: #7187bb; border-color: #7187bb; border-style: solid; border-width: 1px; }
.infoBox { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #080381; background-color: #f2f4ff; border-color: #7187bb; border-style: solid; border-width: 1px; }
.smallText { font-family: Verdana, Arial, sans-serif; font-size: 10px; }
//--></style>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/browser.js">/************************************************ Jim's DHTML Menu v5.0- © Jim Salyer (jsalyer@REMOVETHISmchsi.com)* Visit Dynamic Drive: http://www.dynamicdrive.com for script and instructions* This notice must stay intact for use***********************************************/</script><script type="text/javascript" src="config.js"></script>
<body onload="init(); alert('You must save your work every 15 minutes or it will be lost.  For security reasons, you are logged out after 15 minutes of inactivity.');" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="init()">
<br>&nbsp;
<br>&nbsp;
<br>


<div align="center">
<table border="0" cellspacing="0" cellpadding="4" width="65%">
<tr>
<td class="helpText">
To get started with Ecommerce Shopping Cart Software, click on each of the links above.  The advanced menu contains settings which are for fine tuning your store, which you'll probably never need to change..
</td>
</tr>
</table>


<table border="0" width="440" cellspacing="0" cellpadding="2">
                  <tr>
                    <td valign="top"><br>
<?php
  $heading = array();
  $contents = array();
  $orders_contents = '';
  $orders_status_query = escs_db_query("select orders_status_name, orders_status_id from " . TABLE_ORDERS_STATUS . " where language_id = '" . $languages_id . "'");
  while ($orders_status = escs_db_fetch_array($orders_status_query)) {
    $orders_pending_query = escs_db_query("select count(*) as count from " . TABLE_ORDERS . " where orders_status = '" . $orders_status['orders_status_id'] . "'");
    $orders_pending = escs_db_fetch_array($orders_pending_query);
//Admin begin
//    $orders_contents .= '<a href="' . escs_href_link(FILENAME_ORDERS, 'selected_box=customers&status=' . $orders_status['orders_status_id']) . '">' . $orders_status['orders_status_name'] . '</a>: ' . $orders_pending['count'] . '<br>';
    if (escs_admin_check_boxes(FILENAME_ORDERS, 'sub_boxes') == true) {
      $orders_contents .= '<a href="' . escs_href_link(FILENAME_ORDERS, 'selected_box=customers&status=' . $orders_status['orders_status_id']) . '">' . $orders_status['orders_status_name'] . '</a>: ' . $orders_pending['count'] . '<br>';
    } else {
      $orders_contents .= '' . $orders_status['orders_status_name'] . ': ' . $orders_pending['count'] . '<br>';
    }
//Admin end
  }
  $orders_contents = substr($orders_contents, 0, -4);

  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="infoBoxHeading"',
                     'text'  => BOX_TITLE_ORDERS);

  $contents[] = array('params' => 'class="infoBoxContent"',
                      'text'  => $orders_contents);

  $box = new box;
  echo $box->menuBox($heading, $contents);

  echo '<br>';

  $customers_query = escs_db_query("select count(*) as count from " . TABLE_CUSTOMERS);
  $customers = escs_db_fetch_array($customers_query);
  $products_query = escs_db_query("select count(*) as count from " . TABLE_PRODUCTS . " where products_status = '1'");
  $products = escs_db_fetch_array($products_query);
  $reviews_query = escs_db_query("select count(*) as count from " . TABLE_REVIEWS);
  $reviews = escs_db_fetch_array($reviews_query);

  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="infoBoxHeading"',
                     'text'  => BOX_TITLE_STATISTICS);

  $contents[] = array('params' => 'class="infoBoxContent"',
                      'text'  => BOX_ENTRY_CUSTOMERS . ' ' . $customers['count'] . '<br>' .
                                 BOX_ENTRY_PRODUCTS . ' ' . $products['count'] . '<br>' .
                                 BOX_ENTRY_REVIEWS . ' ' . $reviews['count']);

  $box = new box;
  echo $box->menuBox($heading, $contents);

  echo '<br>';

  $contents = array();

  if (getenv('HTTPS') == 'on') {
    $size = ((getenv('SSL_CIPHER_ALGKEYSIZE')) ? getenv('SSL_CIPHER_ALGKEYSIZE') . '-bit' : '<i>' . BOX_CONNECTION_UNKNOWN . '</i>');
    $contents[] = array('params' => 'class="helpText"',
                        'text' => escs_image(DIR_WS_ICONS . 'locked.gif', ICON_LOCKED, '', '', 'align="right"') . sprintf(BOX_CONNECTION_PROTECTED, $size));
  } else {
    $contents[] = array('params' => 'class="helpText"',
                        'text' => escs_image(DIR_WS_ICONS . 'unlocked.gif', ICON_UNLOCKED, '', '', 'align="right"') . BOX_CONNECTION_UNPROTECTED);
  }

  $box = new box;
  echo $box->tableBlock($contents);
?>

<!--

put back in when admin is completely translated for all ui screens

<table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr><?php echo escs_draw_form('languages', 'index.php', '', 'get'); ?>
                        <td align="center" class="text"><br>Choose Language: <?php echo escs_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"'); ?></td>
                      </form></tr>
                    </table>
-->
                    </td>
                    </tr>
                    </table>



                    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

</div>

</body>

</html>
