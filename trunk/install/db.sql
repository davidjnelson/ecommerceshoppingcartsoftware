# drop existing tables if they exist
#DROP TABLE IF EXISTS address_book
#DROP TABLE IF EXISTS address_format
#DROP TABLE IF EXISTS admin
#DROP TABLE IF EXISTS admin_files
#DROP TABLE IF EXISTS admin_groups
#DROP TABLE IF EXISTS affiliate_affiliate
#DROP TABLE IF EXISTS affiliate_banners
#DROP TABLE IF EXISTS affiliate_banners_history
#DROP TABLE IF EXISTS affiliate_clickthroughs
#DROP TABLE IF EXISTS affiliate_payment_status
#DROP TABLE IF EXISTS affiliate_sales
#DROP TABLE IF EXISTS banners
#DROP TABLE IF EXISTS banners_history
#DROP TABLE IF EXISTS categories
#DROP TABLE IF EXISTS categories_description
#DROP TABLE IF EXISTS configuration
#DROP TABLE IF EXISTS configuration_group
#DROP TABLE IF EXISTS counter
#DROP TABLE IF EXISTS counter_history
#DROP TABLE IF EXISTS countries
#DROP TABLE IF EXISTS coupon_email_track
#DROP TABLE IF EXISTS coupon_gv_customer
#DROP TABLE IF EXISTS coupon_gv_queue
#DROP TABLE IF EXISTS coupon_redeem_track
#DROP TABLE IF EXISTS coupons
#DROP TABLE IF EXISTS coupons_description
#DROP TABLE IF EXISTS currencies
#DROP TABLE IF EXISTS customers
#DROP TABLE IF EXISTS customers_basket
#DROP TABLE IF EXISTS customers_basket_attributes
#DROP TABLE IF EXISTS customers_info
#DROP TABLE IF EXISTS geo_zones
#DROP TABLE IF EXISTS languages
#DROP TABLE IF EXISTS manufacturers
#DROP TABLE IF EXISTS manufacturers_info
#DROP TABLE IF EXISTS newsletters
#DROP TABLE IF EXISTS orders
#DROP TABLE IF EXISTS orders_products
#DROP TABLE IF EXISTS orders_products_attributes
#DROP TABLE IF EXISTS orders_products_download
#DROP TABLE IF EXISTS orders_products_download
#DROP TABLE IF EXISTS orders_status
#DROP TABLE IF EXISTS orders_status_history
#DROP TABLE IF EXISTS orders_total
#DROP TABLE IF EXISTS paypalipn_txn
#DROP TABLE IF EXISTS products
#DROP TABLE IF EXISTS products_attributes
#DROP TABLE IF EXISTS products_attributes_download
#DROP TABLE IF EXISTS products_description
#DROP TABLE IF EXISTS products_groups
#DROP TABLE IF EXISTS products_notifications
#DROP TABLE IF EXISTS products_options
#DROP TABLE IF EXISTS products_options_values
#DROP TABLE IF EXISTS products_options_values_to_products_options
#DROP TABLE IF EXISTS products_to_categories
#DROP TABLE IF EXISTS products_xsell
#DROP TABLE IF EXISTS reviews
#DROP TABLE IF EXISTS reviews_description
#DROP TABLE IF EXISTS sessions
#DROP TABLE IF EXISTS specials
#DROP TABLE IF EXISTS tax_class
#DROP TABLE IF EXISTS tax_rates
#DROP TABLE IF EXISTS whos_online
#DROP TABLE IF EXISTS zones
#DROP TABLE IF EXISTS zones_to_geo_zones
#DROP TABLE IF EXISTS ls_conversations
#DROP TABLE IF EXISTS ls_techs

# Table structure for table `address_book`
#
# Creation: Aug 30, 2003 at 12:15 AM
# Last update: Sep 12, 2003 at 09:42 AM
#

CREATE TABLE `address_book` (
  `address_book_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `entry_gender` char(1) NOT NULL default '',
  `entry_company` varchar(32) default NULL,
  `entry_firstname` varchar(32) NOT NULL default '',
  `entry_lastname` varchar(32) NOT NULL default '',
  `entry_street_address` varchar(64) NOT NULL default '',
  `entry_suburb` varchar(32) default NULL,
  `entry_postcode` varchar(10) NOT NULL default '',
  `entry_city` varchar(32) NOT NULL default '',
  `entry_state` varchar(32) default NULL,
  `entry_country_id` int(11) NOT NULL default '0',
  `entry_zone_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`address_book_id`),
  KEY `idx_address_book_customers_id` (`customers_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

# --------------------------------------------------------

#
# Table structure for table `address_format`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `address_format` (
  `address_format_id` int(11) NOT NULL auto_increment,
  `address_format` varchar(128) NOT NULL default '',
  `address_summary` varchar(48) NOT NULL default '',
  PRIMARY KEY  (`address_format_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `address_format`
#

INSERT INTO `address_format` VALUES (1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country', '$city / $country');
INSERT INTO `address_format` VALUES (2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
INSERT INTO `address_format` VALUES (3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country');
INSERT INTO `address_format` VALUES (4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
INSERT INTO `address_format` VALUES (5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');

# --------------------------------------------------------

#
# Table structure for table `admin`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 12:44 AM
#

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL auto_increment,
  `admin_groups_id` int(11) default NULL,
  `admin_firstname` varchar(32) NOT NULL default '',
  `admin_lastname` varchar(32) default NULL,
  `admin_email_address` varchar(96) NOT NULL default '',
  `admin_password` varchar(40) NOT NULL default '',
  `admin_created` datetime default NULL,
  `admin_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `admin_logdate` datetime default NULL,
  `admin_lognum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`admin_id`),
  UNIQUE KEY `admin_email_address` (`admin_email_address`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

#
# Dumping data for table `admin`
#

INSERT INTO `admin` VALUES (1, 1, 'Default', 'Admin', 'admin@localhost.com', '05cdeb1aeaffec1c7ae3f12c570a658c:81', '2003-07-17 11:35:03', '2003-08-02 19:43:11', '2003-08-10 22:21:07', 46);


# --------------------------------------------------------

#
# Table structure for table `admin_files`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 07, 2003 at 08:48 PM
#

CREATE TABLE `admin_files` (
  `admin_files_id` int(11) NOT NULL auto_increment,
  `admin_files_name` varchar(64) NOT NULL default '',
  `admin_files_is_boxes` tinyint(5) NOT NULL default '0',
  `admin_files_to_boxes` int(11) NOT NULL default '0',
  `admin_groups_id` set('1','2') NOT NULL default '1',
  PRIMARY KEY  (`admin_files_id`)
) TYPE=MyISAM AUTO_INCREMENT=76 ;

#
# Dumping data for table `admin_files`
#

INSERT INTO `admin_files` VALUES (1, 'administrator.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (2, 'configuration.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (3, 'catalog.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (4, 'modules.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (5, 'customers.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (6, 'taxes.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (7, 'localization.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (8, 'reports.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (9, 'tools.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (10, 'admin_members.php', 0, 1, '1');
INSERT INTO `admin_files` VALUES (11, 'admin_files.php', 0, 1, '1');
INSERT INTO `admin_files` VALUES (12, 'configuration.php', 0, 2, '1');
INSERT INTO `admin_files` VALUES (13, 'categories.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (14, 'products_attributes.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (15, 'manufacturers.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (16, 'reviews.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (17, 'specials.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (18, 'products_expected.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (19, 'modules.php', 0, 4, '1');
INSERT INTO `admin_files` VALUES (20, 'customers.php', 0, 5, '1');
INSERT INTO `admin_files` VALUES (21, 'orders.php', 0, 5, '1');
INSERT INTO `admin_files` VALUES (22, 'countries.php', 0, 6, '1');
INSERT INTO `admin_files` VALUES (23, 'zones.php', 0, 6, '1');
INSERT INTO `admin_files` VALUES (24, 'geo_zones.php', 0, 6, '1');
INSERT INTO `admin_files` VALUES (25, 'tax_classes.php', 0, 6, '1');
INSERT INTO `admin_files` VALUES (26, 'tax_rates.php', 0, 6, '1');
INSERT INTO `admin_files` VALUES (27, 'currencies.php', 0, 7, '1');
INSERT INTO `admin_files` VALUES (28, 'languages.php', 0, 7, '1');
INSERT INTO `admin_files` VALUES (29, 'orders_status.php', 0, 7, '1');
INSERT INTO `admin_files` VALUES (30, 'stats_products_viewed.php', 0, 8, '1');
INSERT INTO `admin_files` VALUES (31, 'stats_products_purchased.php', 0, 8, '1');
INSERT INTO `admin_files` VALUES (32, 'stats_customers.php', 0, 8, '1');
INSERT INTO `admin_files` VALUES (33, 'backup.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (34, 'banner_manager.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (35, 'cache.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (36, 'define_language.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (37, 'file_manager.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (38, 'mail.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (39, 'newsletters.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (40, 'server_info.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (41, 'whos_online.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (42, 'banner_statistics.php', 0, 9, '1');
INSERT INTO `admin_files` VALUES (43, 'affiliate.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (44, 'affiliate_affiliates.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (45, 'affiliate_clicks.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (46, 'affiliate_banners.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (47, 'affiliate_contact.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (48, 'affiliate_invoice.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (49, 'affiliate_payment.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (50, 'affiliate_popup_image.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (51, 'affiliate_sales.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (52, 'affiliate_statistics.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (53, 'affiliate_summary.php', 0, 43, '1');
INSERT INTO `admin_files` VALUES (54, 'gv_admin.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (55, 'coupon_admin.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (56, 'gv_queue.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (57, 'gv_mail.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (58, 'gv_sent.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (59, 'paypalipn.php', 1, 0, '1');
INSERT INTO `admin_files` VALUES (60, 'paypalipn_tests.php', 0, 59, '1');
INSERT INTO `admin_files` VALUES (61, 'paypalipn_txn.php', 0, 59, '1');
INSERT INTO `admin_files` VALUES (62, 'coupon_restrict.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (64, 'xsell_products.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (65, 'easypopulate.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (68, 'define_mainpage.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (70, 'edit_orders.php', 0, 5, '1');
INSERT INTO `admin_files` VALUES (71, 'validproducts.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (72, 'validcategories.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (73, 'listcategories.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (74, 'listproducts.php', 0, 54, '1');
INSERT INTO `admin_files` VALUES (75, 'new_attributes.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (76, 'edit_header.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (77, 'edit_footer.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (78, 'affiliate_enable_disable.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (79, 'ssl_security.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (81, 'store_info_pages.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (83, 'affiliate_edit_terms.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (84, 'affiliate_edit_info.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (85, 'live_support.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (86, 'ls_answercall.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (87, 'ls_comm_exit.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (88, 'ls_comm_main.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (89, 'ls_commwindow.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (90, 'ls_exit.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (91, 'ls_hangup.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (92, 'ls_messages.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (93, 'ls_newcall.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (94, 'ls_session_close.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (95, 'ls_start.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (96, 'ls_comm_top.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (97, 'edit_color_scheme.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (98, 'stats_ad_results.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (99, 'dbanalyze.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (100, 'dbcheck.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (101, 'dboptimize.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (102, 'dbrepair.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (103, 'dbstatus.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (104, 'marketing_tutorial.php', 0, 3, '1');
INSERT INTO `admin_files` VALUES (105, 'create_seo_catalog.php', 0, 3, '1');

# --------------------------------------------------------

#
# Table structure for table `admin_groups`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `admin_groups` (
  `admin_groups_id` int(11) NOT NULL auto_increment,
  `admin_groups_name` varchar(64) default NULL,
  PRIMARY KEY  (`admin_groups_id`),
  UNIQUE KEY `admin_groups_name` (`admin_groups_name`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

#
# Dumping data for table `admin_groups`
#

INSERT INTO `admin_groups` VALUES (1, 'Top Administrator');
INSERT INTO `admin_groups` VALUES (2, 'Marketing');

# --------------------------------------------------------

#
# Table structure for table `affiliate_affiliate`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 12, 2003 at 09:49 AM
#

CREATE TABLE `affiliate_affiliate` (
  `affiliate_id` int(11) NOT NULL auto_increment,
  `affiliate_gender` char(1) NOT NULL default '',
  `affiliate_firstname` varchar(32) NOT NULL default '',
  `affiliate_lastname` varchar(32) NOT NULL default '',
  `affiliate_dob` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_email_address` varchar(96) NOT NULL default '',
  `affiliate_telephone` varchar(32) NOT NULL default '',
  `affiliate_fax` varchar(32) NOT NULL default '',
  `affiliate_password` varchar(40) NOT NULL default '',
  `affiliate_homepage` varchar(96) NOT NULL default '',
  `affiliate_street_address` varchar(64) NOT NULL default '',
  `affiliate_suburb` varchar(64) NOT NULL default '',
  `affiliate_city` varchar(32) NOT NULL default '',
  `affiliate_postcode` varchar(10) NOT NULL default '',
  `affiliate_state` varchar(32) NOT NULL default '',
  `affiliate_country_id` int(11) NOT NULL default '0',
  `affiliate_zone_id` int(11) NOT NULL default '0',
  `affiliate_agb` tinyint(4) NOT NULL default '0',
  `affiliate_company` varchar(60) NOT NULL default '',
  `affiliate_company_taxid` varchar(64) NOT NULL default '',
  `affiliate_commission_percent` decimal(4,2) NOT NULL default '0.00',
  `affiliate_payment_check` varchar(100) NOT NULL default '',
  `affiliate_payment_paypal` varchar(64) NOT NULL default '',
  `affiliate_payment_bank_name` varchar(64) NOT NULL default '',
  `affiliate_payment_bank_branch_number` varchar(64) NOT NULL default '',
  `affiliate_payment_bank_swift_code` varchar(64) NOT NULL default '',
  `affiliate_payment_bank_account_name` varchar(64) NOT NULL default '',
  `affiliate_payment_bank_account_number` varchar(64) NOT NULL default '',
  `affiliate_date_of_last_logon` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_number_of_logons` int(11) NOT NULL default '0',
  `affiliate_date_account_created` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_date_account_last_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_lft` int(11) NOT NULL default '0',
  `affiliate_rgt` int(11) NOT NULL default '0',
  `affiliate_root` int(11) NOT NULL default '0',
  PRIMARY KEY  (`affiliate_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

# --------------------------------------------------------

#
# Table structure for table `affiliate_banners`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `affiliate_banners` (
  `affiliate_banners_id` int(11) NOT NULL auto_increment,
  `affiliate_banners_title` varchar(64) NOT NULL default '',
  `affiliate_products_id` int(11) NOT NULL default '0',
  `affiliate_banners_image` varchar(64) NOT NULL default '',
  `affiliate_banners_group` varchar(10) NOT NULL default '',
  `affiliate_banners_html_text` text,
  `affiliate_expires_impressions` int(7) default '0',
  `affiliate_expires_date` datetime default NULL,
  `affiliate_date_scheduled` datetime default NULL,
  `affiliate_date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_date_status_change` datetime default NULL,
  `affiliate_status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`affiliate_banners_id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

# --------------------------------------------------------

#
# Table structure for table `affiliate_banners_history`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `affiliate_banners_history` (
  `affiliate_banners_history_id` int(11) NOT NULL auto_increment,
  `affiliate_banners_products_id` int(11) NOT NULL default '0',
  `affiliate_banners_id` int(11) NOT NULL default '0',
  `affiliate_banners_affiliate_id` int(11) NOT NULL default '0',
  `affiliate_banners_shown` int(11) NOT NULL default '0',
  `affiliate_banners_clicks` tinyint(4) NOT NULL default '0',
  `affiliate_banners_history_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`affiliate_banners_history_id`,`affiliate_banners_products_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

# --------------------------------------------------------

#
# Table structure for table `affiliate_clickthroughs`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `affiliate_clickthroughs` (
  `affiliate_clickthrough_id` int(11) NOT NULL auto_increment,
  `affiliate_id` int(11) NOT NULL default '0',
  `affiliate_clientdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_clientbrowser` varchar(200) default 'Could Not Find This Data',
  `affiliate_clientip` varchar(50) default 'Could Not Find This Data',
  `affiliate_clientreferer` varchar(200) default 'none detected (maybe a direct link)',
  `affiliate_products_id` int(11) default '0',
  `affiliate_banner_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`affiliate_clickthrough_id`),
  KEY `refid` (`affiliate_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

# --------------------------------------------------------

#
# Table structure for table `affiliate_payment`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `affiliate_payment` (
  `affiliate_payment_id` int(11) NOT NULL auto_increment,
  `affiliate_id` int(11) NOT NULL default '0',
  `affiliate_payment` decimal(15,2) NOT NULL default '0.00',
  `affiliate_payment_tax` decimal(15,2) NOT NULL default '0.00',
  `affiliate_payment_total` decimal(15,2) NOT NULL default '0.00',
  `affiliate_payment_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_payment_last_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_payment_status` int(5) NOT NULL default '0',
  `affiliate_firstname` varchar(32) NOT NULL default '',
  `affiliate_lastname` varchar(32) NOT NULL default '',
  `affiliate_street_address` varchar(64) NOT NULL default '',
  `affiliate_suburb` varchar(64) NOT NULL default '',
  `affiliate_city` varchar(32) NOT NULL default '',
  `affiliate_postcode` varchar(10) NOT NULL default '',
  `affiliate_country` varchar(32) NOT NULL default '0',
  `affiliate_company` varchar(60) NOT NULL default '',
  `affiliate_state` varchar(32) NOT NULL default '0',
  `affiliate_address_format_id` int(5) NOT NULL default '0',
  `affiliate_last_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`affiliate_payment_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Table structure for table `affiliate_payment_status`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `affiliate_payment_status` (
  `affiliate_payment_status_id` int(11) NOT NULL default '0',
  `affiliate_language_id` int(11) NOT NULL default '1',
  `affiliate_payment_status_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`affiliate_payment_status_id`,`affiliate_language_id`),
  KEY `idx_affiliate_payment_status_name` (`affiliate_payment_status_name`)
) TYPE=MyISAM;

#
# Dumping data for table `affiliate_payment_status`
#

INSERT INTO `affiliate_payment_status` VALUES (0, 1, 'Pending');
INSERT INTO `affiliate_payment_status` VALUES (0, 2, 'Offen');
INSERT INTO `affiliate_payment_status` VALUES (0, 3, 'Pendiente');
INSERT INTO `affiliate_payment_status` VALUES (1, 1, 'Paid');
INSERT INTO `affiliate_payment_status` VALUES (1, 2, 'Ausgezahlt');
INSERT INTO `affiliate_payment_status` VALUES (1, 3, 'Pagado');

# --------------------------------------------------------

#
# Table structure for table `affiliate_payment_status_history`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `affiliate_payment_status_history` (
  `affiliate_status_history_id` int(11) NOT NULL auto_increment,
  `affiliate_payment_id` int(11) NOT NULL default '0',
  `affiliate_new_value` int(5) NOT NULL default '0',
  `affiliate_old_value` int(5) default NULL,
  `affiliate_date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_notified` int(1) default '0',
  PRIMARY KEY  (`affiliate_status_history_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Table structure for table `affiliate_sales`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:48 PM
#

CREATE TABLE `affiliate_sales` (
  `affiliate_id` int(11) NOT NULL default '0',
  `affiliate_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_browser` varchar(100) NOT NULL default '',
  `affiliate_ipaddress` varchar(20) NOT NULL default '',
  `affiliate_orders_id` int(11) NOT NULL default '0',
  `affiliate_value` decimal(15,2) NOT NULL default '0.00',
  `affiliate_payment` decimal(15,2) NOT NULL default '0.00',
  `affiliate_clickthroughs_id` int(11) NOT NULL default '0',
  `affiliate_billing_status` int(5) NOT NULL default '0',
  `affiliate_payment_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `affiliate_payment_id` int(11) NOT NULL default '0',
  `affiliate_percent` decimal(4,2) NOT NULL default '0.00',
  `affiliate_salesman` int(11) NOT NULL default '0',
  PRIMARY KEY  (`affiliate_orders_id`,`affiliate_id`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `banners`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `banners` (
  `banners_id` int(11) NOT NULL auto_increment,
  `banners_title` varchar(64) NOT NULL default '',
  `banners_url` varchar(255) NOT NULL default '',
  `banners_image` varchar(64) NOT NULL default '',
  `banners_group` varchar(10) NOT NULL default '',
  `banners_html_text` text,
  `expires_impressions` int(7) default '0',
  `expires_date` datetime default NULL,
  `date_scheduled` datetime default NULL,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_status_change` datetime default NULL,
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`banners_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Table structure for table `banners_history`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `banners_history` (
  `banners_history_id` int(11) NOT NULL auto_increment,
  `banners_id` int(11) NOT NULL default '0',
  `banners_shown` int(5) NOT NULL default '0',
  `banners_clicked` int(5) NOT NULL default '0',
  `banners_history_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`banners_history_id`)
) TYPE=MyISAM AUTO_INCREMENT=40 ;

#
# Table structure for table `categories`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 07, 2003 at 11:54 AM
#

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL auto_increment,
  `categories_image` varchar(64) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  `sort_order` int(3) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`categories_id`),
  KEY `idx_categories_parent_id` (`parent_id`)
) TYPE=MyISAM AUTO_INCREMENT=24 ;

#
# Table structure for table `categories_description`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 07, 2003 at 11:54 AM
#
# gift vouchers

CREATE TABLE `categories_description` (
  `categories_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `categories_name` varchar(32) NOT NULL default '',
  `categories_heading_title` varchar(64) default NULL,
  `categories_description` text,
  PRIMARY KEY  (`categories_id`,`language_id`),
  KEY `idx_categories_name` (`categories_name`)
) TYPE=MyISAM;

#
# Table structure for table `configuration`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:37 AM
#

CREATE TABLE `configuration` (
  `configuration_id` int(11) NOT NULL auto_increment,
  `configuration_title` varchar(64) NOT NULL default '',
  `configuration_key` varchar(64) NOT NULL default '',
  `configuration_value` varchar(255) NOT NULL default '',
  `configuration_description` varchar(255) NOT NULL default '',
  `configuration_group_id` int(11) NOT NULL default '0',
  `sort_order` int(5) default NULL,
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `use_function` varchar(255) default NULL,
  `set_function` varchar(255) default NULL,
  PRIMARY KEY  (`configuration_id`)
) TYPE=MyISAM AUTO_INCREMENT=421 ;

#
# Dumping data for table `configuration`
#

INSERT INTO `configuration` VALUES (1, 'Store Name', 'STORE_NAME', 'osCommerce', 'The name of my store', 1, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (2, 'Store Owner', 'STORE_OWNER', 'Harald Ponce de Leon', 'The name of my store owner', 1, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (3, 'E-Mail Address', 'STORE_OWNER_EMAIL_ADDRESS', 'root@localhost', 'The e-mail address of my store owner', 1, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (4, 'E-Mail From', 'EMAIL_FROM', 'osCommerce <root@localhost>', 'The e-mail address used in (sent) e-mails', 1, 4, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (5, 'Country', 'STORE_COUNTRY', '223', 'The country my store is located in <br><br><b>Note: Please remember to update the store zone.</b>', 1, 6, NULL, '2003-07-17 10:29:22', 'escs_get_country_name', 'escs_cfg_pull_down_country_list(');
INSERT INTO `configuration` VALUES (6, 'Zone', 'STORE_ZONE', '1', 'The zone my store is located in', 1, 7, '2003-09-12 09:51:09', '2003-07-17 10:29:22', 'escs_cfg_get_zone_name', 'escs_cfg_pull_down_zone_list(');
INSERT INTO `configuration` VALUES (7, 'Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', 1, 8, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'asc\', \'desc\'),');
INSERT INTO `configuration` VALUES (8, 'Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', 1, 9, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'products_name\', \'date_expected\'),');
INSERT INTO `configuration` VALUES (9, 'Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language\'s currency when it is changed', 1, 10, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (10, 'Send Extra Order Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', 1, 11, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (11, 'Use Search-Engine Safe URLs (still in development)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'true', 'Use search-engine safe urls for all site links', 1, 12, '2003-08-06 03:41:57', '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (12, 'Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', 1, 14, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (13, 'Allow Guest To Tell A Friend', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Allow guests to tell a friend about a product', 1, 15, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (14, 'Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', 1, 17, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'and\', \'or\'),');
INSERT INTO `configuration` VALUES (15, 'Store Address and Phone', 'STORE_NAME_ADDRESS', 'Store Name\nAddress\nCountry\nPhone', 'This is the Store Name, Address and Phone used on printable documents and displayed online', 1, 18, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_textarea(');
INSERT INTO `configuration` VALUES (16, 'Show Category Counts', 'SHOW_COUNTS', 'true', 'Count recursively how many products are in each category', 1, 19, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (17, 'Tax Decimal Places', 'TAX_DECIMAL_PLACES', '0', 'Pad the tax value this amount of decimal places', 1, 20, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (18, 'Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'false', 'Display prices with tax included (true) or add the tax at the end (false)', 1, 21, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (19, 'First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Minimum length of first name', 2, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (20, 'Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Minimum length of last name', 2, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (21, 'Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', 'Minimum length of date of birth', 2, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (22, 'E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Minimum length of e-mail address', 2, 4, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (23, 'Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Minimum length of street address', 2, 5, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (24, 'Company', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Minimum length of company name', 2, 6, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (25, 'Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Minimum length of post code', 2, 7, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (26, 'City', 'ENTRY_CITY_MIN_LENGTH', '3', 'Minimum length of city', 2, 8, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (27, 'State', 'ENTRY_STATE_MIN_LENGTH', '2', 'Minimum length of state', 2, 9, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (28, 'Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Minimum length of telephone number', 2, 10, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (29, 'Password', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Minimum length of password', 2, 11, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (30, 'Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', 'Minimum length of credit card owner name', 2, 12, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (31, 'Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', 'Minimum length of credit card number', 2, 13, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (32, 'Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Minimum length of review text', 2, 14, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (33, 'Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', 'Minimum number of best sellers to display', 2, 15, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (34, 'Also Purchased', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Minimum number of products to display in the \'This Customer Also Purchased\' box', 2, 16, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (35, 'Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Maximum address book entries a customer is allowed to have', 3, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (36, 'Search Results', 'MAX_DISPLAY_SEARCH_RESULTS', '10', 'Amount of products to list', 3, 2, '2003-08-06 12:35:41', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (37, 'Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Number of \'number\' links use for page-sets', 3, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (38, 'Special Products', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '3', 'Maximum number of products on special to display', 3, 4, '2003-08-06 12:35:27', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (39, 'New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '3', 'Maximum number of new products to display in a category', 3, 5, '2003-08-06 12:35:10', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (40, 'Products Expected', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '3', 'Maximum number of products expected to display', 3, 6, '2003-08-06 12:36:07', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (41, 'Manufacturers List', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', 'Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list', 3, 7, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (42, 'Manufacturers Select Size', 'MAX_MANUFACTURERS_LIST', '1', 'Used in manufacturers box; when this value is \'1\' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.', 3, 7, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (43, 'Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Used in manufacturers box; maximum length of manufacturers name to display', 3, 8, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (44, 'New Reviews', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Maximum number of new reviews to display', 3, 9, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (45, 'Selection of Random Reviews', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'How many records to select from to choose one random product review', 3, 10, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (46, 'Selection of Random New Products', 'MAX_RANDOM_SELECT_NEW', '10', 'How many records to select from to choose one random new product to display', 3, 11, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (47, 'Selection of Products on Special', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'How many records to select from to choose one random product special to display', 3, 12, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (48, 'Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'How many categories to list per row', 3, 13, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (49, 'New Products Listing', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Maximum number of new products to display in new products page', 3, 14, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (50, 'Best Sellers', 'MAX_DISPLAY_BESTSELLERS', '10', 'Maximum number of best sellers to display', 3, 15, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (51, 'Also Purchased', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Maximum number of products to display in the \'This Customer Also Purchased\' box', 3, 16, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (52, 'Customer Order History Box', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Maximum number of products to display in the customer order history box', 3, 17, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (53, 'Order History', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Maximum number of orders to display in the order history page', 3, 18, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (54, 'Small Image Width', 'SMALL_IMAGE_WIDTH', '100', 'The pixel width of small images', 4, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (55, 'Small Image Height', 'SMALL_IMAGE_HEIGHT', '80', 'The pixel height of small images', 4, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (56, 'Heading Image Width', 'HEADING_IMAGE_WIDTH', '57', 'The pixel width of heading images', 4, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (57, 'Heading Image Height', 'HEADING_IMAGE_HEIGHT', '40', 'The pixel height of heading images', 4, 4, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (58, 'Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'The pixel width of subcategory images', 4, 5, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (59, 'Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '57', 'The pixel height of subcategory images', 4, 6, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (60, 'Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', 4, 7, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (61, 'Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', 4, 8, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (62, 'Gender', 'ACCOUNT_GENDER', 'true', 'Display gender in the customers account', 5, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (63, 'Date of Birth', 'ACCOUNT_DOB', 'true', 'Display date of birth in the customers account', 5, 2, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (64, 'Company', 'ACCOUNT_COMPANY', 'true', 'Display company in the customers account', 5, 3, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (65, 'Suburb', 'ACCOUNT_SUBURB', 'true', 'Display suburb in the customers account', 5, 4, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (66, 'State', 'ACCOUNT_STATE', 'true', 'Display state in the customers account', 5, 5, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (67, 'Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'cc.php;cod.php;freecharger.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cc.php;cod.php;paypal.php)', 6, 0, '2003-09-12 09:40:28', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (68, 'Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_coupon.php;ot_gv.php;ot_total.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', 6, 0, '2003-07-29 15:35:41', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (69, 'Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php;freeshipper.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', 6, 0, '2003-09-12 09:39:34', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (70, 'Enable Cash On Delivery Module', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Do you want to accept Cash On Delevery payments?', 6, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (71, 'Payment Zone', 'MODULE_PAYMENT_COD_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2003-07-17 10:29:22', 'escs_get_zone_class_title', 'escs_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (72, 'Sort order of display.', 'MODULE_PAYMENT_COD_SORT_ORDER', '200', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (73, 'Set Order Status', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2003-07-17 10:29:22', 'escs_get_order_status_name', 'escs_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (74, 'Enable Credit Card Module', 'MODULE_PAYMENT_CC_STATUS', 'True', 'Do you want to accept credit card payments?', 6, 0, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (75, 'Split Credit Card E-Mail Address', 'MODULE_PAYMENT_CC_EMAIL', '', 'If an e-mail address is entered, the middle digits of the credit card number will be sent to the e-mail address (the outside digits are stored in the database with the middle digits censored)', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (76, 'Sort order of display.', 'MODULE_PAYMENT_CC_SORT_ORDER', '100', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (77, 'Payment Zone', 'MODULE_PAYMENT_CC_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2003-07-17 10:29:22', 'escs_get_zone_class_title', 'escs_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (78, 'Set Order Status', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '1', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2003-07-17 10:29:22', 'escs_get_order_status_name', 'escs_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (84, 'Default Currency', 'DEFAULT_CURRENCY', 'USD', 'Default Currency', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (85, 'Default Language', 'DEFAULT_LANGUAGE', 'en', 'Default Language', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (86, 'Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (87, 'Display Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', 'Do you want to display the order shipping cost?', 6, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (88, 'Sort Order', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', 'Sort order of display.', 6, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (89, 'Allow Free Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'true', 'Do you want to allow free shipping?', 6, 3, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (90, 'Free Shipping For Orders Over', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '6000', 'Provide free shipping for orders over the set amount.', 6, 4, NULL, '2003-07-17 10:29:22', 'currencies->format', NULL);
INSERT INTO `configuration` VALUES (91, 'Provide Free Shipping For Orders Made', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Provide free shipping for orders sent to the set destination.', 6, 5, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'national\', \'international\', \'both\'),');
INSERT INTO `configuration` VALUES (92, 'Display Sub-Total', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Do you want to display the order sub-total cost?', 6, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (93, 'Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Sort order of display.', 6, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (94, 'Display Tax', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', 'Do you want to display the order tax value?', 6, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (95, 'Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', 'Sort order of display.', 6, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (96, 'Display Total', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', 'Do you want to display the total order value?', 6, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (97, 'Sort Order', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '800', 'Sort order of display.', 6, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (98, 'Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '223', 'Select the country of origin to be used in shipping quotes.', 7, 1, NULL, '2003-07-17 10:29:22', 'escs_get_country_name', 'escs_cfg_pull_down_country_list(');
INSERT INTO `configuration` VALUES (99, 'Postal Code', 'SHIPPING_ORIGIN_ZIP', '85014', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.', 7, 2, '2003-07-29 15:06:38', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (100, 'Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', 7, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (101, 'Package Tare weight.', 'SHIPPING_BOX_WEIGHT', '0', 'What is the weight of typical packaging of small to medium packages?', 7, 4, '2003-07-29 15:06:50', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (102, 'Larger packages - percentage increase.', 'SHIPPING_BOX_PADDING', '10', 'For 10% enter 10', 7, 5, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (103, 'Display Product Image', 'PRODUCT_LIST_IMAGE', '1', 'Do you want to display the Product Image?', 8, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (104, 'Display Product Manufaturer Name', 'PRODUCT_LIST_MANUFACTURER', '0', 'Do you want to display the Product Manufacturer Name?', 8, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (105, 'Display Product Model', 'PRODUCT_LIST_MODEL', '0', 'Do you want to display the Product Model?', 8, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (106, 'Display Product Name', 'PRODUCT_LIST_NAME', '2', 'Do you want to display the Product Name?', 8, 4, '2003-09-08 23:04:04', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (107, 'Display Product Price', 'PRODUCT_LIST_PRICE', '3', 'Do you want to display the Product Price', 8, 5, '2003-09-08 23:04:39', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (108, 'Display Product Quantity', 'PRODUCT_LIST_QUANTITY', '0', 'Do you want to display the Product Quantity?', 8, 6, '2003-09-12 23:17:58', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (109, 'Display Product Weight', 'PRODUCT_LIST_WEIGHT', '0', 'Do you want to display the Product Weight?', 8, 7, '2003-09-12 23:17:48', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (110, 'Display Buy Now column', 'PRODUCT_LIST_BUY_NOW', '4', 'Do you want to display the Buy Now column?', 8, 8, '2003-09-08 23:04:54', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (111, 'Display Category/Manufacturer Filter (0=disable; 1=enable)', 'PRODUCT_LIST_FILTER', '1', 'Do you want to display the Category/Manufacturer Filter?', 8, 9, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (112, 'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 'PREV_NEXT_BAR_LOCATION', '2', 'Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 8, 10, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (113, 'Check stock level', 'STOCK_CHECK', 'true', 'Check to see if sufficent stock is available', 9, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (114, 'Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', 9, 2, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (115, 'Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', 9, 3, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (116, 'Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', 9, 4, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (117, 'Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', 9, 5, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (118, 'Store Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Store the time it takes to parse a page', 10, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (119, 'Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', 'Directory and filename of the page parse time log', 10, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (120, 'Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', 10, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (121, 'Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'true', 'Display the page parse time (store page parse time must be enabled)', 10, 4, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (122, 'Store Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Store the database queries in the page parse time log (PHP4 only)', 10, 5, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (123, 'Use Cache', 'USE_CACHE', 'false', 'Use caching features', 11, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (124, 'Cache Directory', 'DIR_FS_CACHE', '/tmp/', 'The directory where the cached files are saved', 11, 2, '2003-07-17 10:42:27', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (125, 'E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.', 12, 1, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'sendmail\', \'smtp\'),');
INSERT INTO `configuration` VALUES (126, 'E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', 12, 2, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'LF\', \'CRLF\'),');
INSERT INTO `configuration` VALUES (127, 'Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', 12, 3, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (128, 'Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', 12, 4, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (129, 'Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', 12, 5, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (130, 'Enable download', 'DOWNLOAD_ENABLED', 'true', 'Enable the products download functions.', 13, 1, '2003-07-29 15:38:22', '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (131, 'Download by redirect', 'DOWNLOAD_BY_REDIRECT', 'true', 'Use browser redirection for download. Disable on non-Unix systems.', 13, 2, '2003-09-07 15:39:33', '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (132, 'Expiry delay (days)', 'DOWNLOAD_MAX_DAYS', '7', 'Set number of days before the download link expires. 0 means no limit.', 13, 3, NULL, '2003-07-17 10:29:22', NULL, '');
INSERT INTO `configuration` VALUES (133, 'Maximum number of downloads', 'DOWNLOAD_MAX_COUNT', '5', 'Set the maximum number of downloads. 0 means no download authorized.', 13, 4, NULL, '2003-07-17 10:29:22', NULL, '');
INSERT INTO `configuration` VALUES (134, 'Enable GZip Compression', 'GZIP_COMPRESSION', 'false', 'Enable HTTP GZip compression.', 14, 1, '2003-08-12 00:20:39', '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (135, 'Compression Level', 'GZIP_LEVEL', '5', 'Use this compression level 0-9 (0 = minimum, 9 = maximum).', 14, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (136, 'Session Directory', 'SESSION_WRITE_DIRECTORY', '/tmp', 'If sessions are file based, store them in this directory.', 15, 1, '2003-08-05 12:12:28', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO `configuration` VALUES (137, 'Force Cookie Use', 'SESSION_FORCE_COOKIE_USE', 'False', 'Force the use of sessions when cookies are only enabled.', 15, 2, '2003-09-07 22:28:12', '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (138, 'Check SSL Session ID', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.', 15, 3, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (139, 'Check User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Validate the clients browser user agent on every page request.', 15, 4, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (140, 'Check IP Address', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Validate the clients IP address on every page request.', 15, 5, NULL, '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (141, 'Prevent Spider Sessions', 'SESSION_BLOCK_SPIDERS', 'True', 'Prevent known spiders from starting a session.', 15, 6, '2003-07-17 10:34:45', '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (142, 'Recreate Session', 'SESSION_RECREATE', 'True', 'Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).', 15, 7, '2003-07-17 10:35:04', '2003-07-17 10:29:22', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (143, 'PRODUCT DESCRIPTIONS use WYSIWYG HTMLAREA?', 'HTML_AREA_WYSIWYG_DISABLE', 'Enable', 'Enable/Disable WYSIWYG box', 112, 0, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Enable\', \'Disable\'),');
INSERT INTO `configuration` VALUES (144, 'Product Description Basic/Advanced Version?', 'HTML_AREA_WYSIWYG_BASIC_PD', 'Basic', 'Basic Features FASTER<br>Advanced Features SLOWER', 112, 10, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Basic\', \'Advanced\'),');
INSERT INTO `configuration` VALUES (145, 'Product Description Layout Width', 'HTML_AREA_WYSIWYG_WIDTH', '505', 'How WIDE should the HTMLAREA be in pixels (default: 505)', 112, 15, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (146, 'Product Description Layout Height', 'HTML_AREA_WYSIWYG_HEIGHT', '240', 'How HIGH should the HTMLAREA be in pixels (default: 240)', 112, 19, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (147, 'CUSTOMER EMAILS use WYSIWYG HTMLAREA?', 'HTML_AREA_WYSIWYG_DISABLE_EMAIL', 'Enable', 'Use WYSIWYG Area in Email Customers', 112, 20, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Enable\', \'Disable\'),');
INSERT INTO `configuration` VALUES (148, 'Customer Email Basic/Advanced Version?', 'HTML_AREA_WYSIWYG_BASIC_EMAIL', 'Basic', 'Basic Features FASTER<br>Advanced Features SLOWER', 112, 21, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Basic\', \'Advanced\'),');
INSERT INTO `configuration` VALUES (149, 'Customer Email Layout Width', 'EMAIL_AREA_WYSIWYG_WIDTH', '505', 'How WIDE should the HTMLAREA be in pixels (default: 505)', 112, 25, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (150, 'Customer Email Layout Height', 'EMAIL_AREA_WYSIWYG_HEIGHT', '140', 'How HIGH should the HTMLAREA be in pixels (default: 140)', 112, 29, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (151, 'NEWSLETTER EMAILS use WYSIWYG HTMLAREA?', 'HTML_AREA_WYSIWYG_DISABLE_NEWSLETTER', 'Enable', 'Use WYSIWYG Area in Email Newsletter', 112, 30, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Enable\', \'Disable\'),');
INSERT INTO `configuration` VALUES (152, 'Newsletter Email Basic/Advanced Version?', 'HTML_AREA_WYSIWYG_BASIC_NEWSLETTER', 'Basic', 'Basic Features FASTER<br>Advanced Features SLOWER', 112, 32, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Basic\', \'Advanced\'),');
INSERT INTO `configuration` VALUES (153, 'Newsletter Email Layout Width', 'NEWSLETTER_EMAIL_WYSIWYG_WIDTH', '505', 'How WIDE should the HTMLAREA be in pixels (default: 505)', 112, 35, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (154, 'Newsletter Email Layout Height', 'NEWSLETTER_EMAIL_WYSIWYG_HEIGHT', '140', 'How HIGH should the HTMLAREA be in pixels (default: 140)', 112, 39, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (155, 'DEFINE MAINPAGE use WYSIWYG HTMLAREA?', 'HTML_AREA_WYSIWYG_DISABLE_DEFINE', 'Enable', 'Use WYSIWYG Area in Define Mainpage', 112, 40, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Enable\', \'Disable\'),');
INSERT INTO `configuration` VALUES (156, 'Define Mainpage Basic/Advanced Version?', 'HTML_AREA_WYSIWYG_BASIC_DEFINE', 'Basic', 'Basic Features FASTER<br>Advanced Features SLOWER', 112, 41, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Basic\', \'Advanced\'),');
INSERT INTO `configuration` VALUES (157, 'Define Mainpage Layout Width', 'DEFINE_MAINPAGE_WYSIWYG_WIDTH', '605', 'How WIDE should the HTMLAREA be in pixels (default: 505)', 112, 42, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (158, 'Define Mainpage Layout Height', 'DEFINE_MAINPAGE_WYSIWYG_HEIGHT', '300', 'How HIGH should the HTMLAREA be in pixels (default: 140)', 112, 43, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (159, 'GLOBAL - User Interface Font Type', 'HTML_AREA_WYSIWYG_FONT_TYPE', 'Times New Roman', 'User Interface Font Type<br>(not saved to product description)', 112, 45, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'Arial\', \'Courier New\', \'Georgia\', \'Impact\', \'Tahoma\', \'Times New Roman\', \'Verdana\', \'Wingdings\'),');
INSERT INTO `configuration` VALUES (160, 'GLOBAL - User Interface Font Size', 'HTML_AREA_WYSIWYG_FONT_SIZE', '12', 'User Interface Font Size (not saved to product description)<p><b>10 Equals 10 pt', 112, 50, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\\\'8\\\', \\\'10\\\', \\\'12\\\', \\\'14\\\', \\\'18\\\', \\\'24\\\', \\\'36\\\'),');
INSERT INTO `configuration` VALUES (161, 'GLOBAL - User Interface Font Colour', 'HTML_AREA_WYSIWYG_FONT_COLOUR', 'Black', 'White, Black, C0C0C0, Red, FFFFFF, Yellow, Pink, Blue, Gray, 000000, ect..<br>basically any colour or HTML colour code!<br>(not saved to product description)', 112, 55, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (162, 'GLOBAL - User Interface Background Colour', 'HTML_AREA_WYSIWYG_BG_COLOUR', 'White', 'White, Black, C0C0C0, Red, FFFFFF, Yellow, Pink, Blue, Gray, 000000, ect..<br>basically any colour or html colour code!<br>(not saved to product description)', 112, 60, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO `configuration` VALUES (163, 'GLOBAL - ALLOW DEBUG MODE?', 'HTML_AREA_WYSIWYG_DEBUG', '0', 'Moniter Live-html, It updates as you type in a 2nd field above it.<p>Disable Debug = 0<br>Enable Debug = 1<br>Default = 0 OFF', 112, 65, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'escs_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (164, 'E-Mail Address', 'AFFILIATE_EMAIL_ADDRESS', '<affiliate@localhost.com>', 'The E Mail Address for the Affiliate Programm', 900, 1, '2003-07-17 21:46:04', '2003-07-17 13:48:39', NULL, NULL);

INSERT INTO `configuration` VALUES (500, 'Enable Affiliate Program', 'ENABLE_AFFILIATE_PROGRAM', 'no', 'Would you like your store to have an affiliate program or not, enabling other people to earn commissions selling your products via a link on their websites.', 900, 25, '2003-07-17 21:46:04', '2003-07-17 13:48:39', NULL, NULL);

INSERT INTO `configuration` VALUES (165, 'Affiliate Pay Per Sale Payment % Rate', 'AFFILIATE_PERCENT', '10.0000', 'Percentage Rate for the Affiliate Program', 900, 2, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO `configuration` VALUES (166, 'Payment Threshold', 'AFFILIATE_THRESHOLD', '50.00', 'Payment Threshold for paying affiliates', 900, 3, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO `configuration` VALUES (167, 'Cookie Lifetime', 'AFFILIATE_COOKIE_LIFETIME', '7200', 'How long does the click count (seconds) if customer comes back', 900, 4, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO `configuration` VALUES (168, 'Billing Time', 'AFFILIATE_BILLING_TIME', '30', 'Orders billed must be at least "30" days old.<br>This is needed if a order is refunded', 900, 5, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO `configuration` VALUES (169, 'Order Min Status', 'AFFILIATE_PAYMENT_ORDER_MIN_STATUS', '3', 'The status an order must have at least, to be billed', 900, 6, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO `configuration` VALUES (170, 'Pay Affiliates with check', 'AFFILIATE_USE_CHECK', 'true', 'Pay Affiliates with check', 900, 7, NULL, '2003-07-17 13:48:39', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (171, 'Pay Affiliates with PayPal', 'AFFILIATE_USE_PAYPAL', 'true', 'Pay Affiliates with PayPal', 900, 8, NULL, '2003-07-17 13:48:39', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (172, 'Pay Affiliates by Bank', 'AFFILIATE_USE_BANK', 'true', 'Pay Affiliates by Bank', 900, 9, NULL, '2003-07-17 13:48:39', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (173, 'Individual Affiliate Percentage', 'AFFILATE_INDIVIDUAL_PERCENTAGE', 'true', 'Allow per Affiliate provision', 900, 10, NULL, '2003-07-17 13:48:39', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (174, 'Use Affiliate-tier', 'AFFILATE_USE_TIER', 'false', 'Multilevel Affiliate provisions', 900, 11, '2003-07-17 21:46:43', '2003-07-17 13:48:39', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (175, 'Number of Tierlevels', 'AFFILIATE_TIER_LEVELS', '0', 'Number of Tierlevels', 900, 12, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO `configuration` VALUES (176, 'Percentage Rate for the Tierlevels', 'AFFILIATE_TIER_PERCENTAGE', '8.00;5.00;1.00', 'Percent Rates for the tierlevels<br>Example: 8.00;5.00;1.00', 900, 13, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO `configuration` VALUES (177, 'Display Total', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', 'Do you want to display the Discount Coupon value?', 6, 1, NULL, '2003-07-26 14:23:49', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (178, 'Sort Order', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '9', 'Sort order of display.', 6, 2, NULL, '2003-07-26 14:23:49', NULL, NULL);
INSERT INTO `configuration` VALUES (179, 'Include Shipping', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'true', 'Include Shipping in calculation', 6, 5, NULL, '2003-07-26 14:23:49', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (180, 'Include Tax', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'false', 'Include Tax in calculation.', 6, 6, NULL, '2003-07-26 14:23:49', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (181, 'Re-calculate Tax', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'None', 'Re-Calculate Tax', 6, 7, NULL, '2003-07-26 14:23:49', NULL, 'escs_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO `configuration` VALUES (182, 'Tax Class', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', 'Use the following tax class when treating Discount Coupon as Credit Note.', 6, 0, NULL, '2003-07-26 14:23:49', 'escs_get_tax_class_title', 'escs_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (183, 'Display Total', 'MODULE_ORDER_TOTAL_GV_STATUS', 'true', 'Do you want to display the Gift Voucher value?', 6, 1, NULL, '2003-07-26 14:23:56', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (184, 'Sort Order', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', '740', 'Sort order of display.', 6, 2, NULL, '2003-07-26 14:23:56', NULL, NULL);
INSERT INTO `configuration` VALUES (185, 'Queue Purchases', 'MODULE_ORDER_TOTAL_GV_QUEUE', 'true', 'Do you want to queue purchases of the Gift Voucher?', 6, 3, NULL, '2003-07-26 14:23:56', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (186, 'Include Shipping', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 'true', 'Include Shipping in calculation', 6, 5, NULL, '2003-07-26 14:23:56', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (187, 'Include Tax', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 'false', 'Include Tax in calculation.', 6, 6, NULL, '2003-07-26 14:23:56', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (188, 'Re-calculate Tax', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 'None', 'Re-Calculate Tax', 6, 7, NULL, '2003-07-26 14:23:56', NULL, 'escs_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO `configuration` VALUES (189, 'Tax Class', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', '0', 'Use the following tax class when treating Gift Voucher as Credit Note.', 6, 0, NULL, '2003-07-26 14:23:56', 'escs_get_tax_class_title', 'escs_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (190, 'Credit including Tax', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 'false', 'Add tax to purchased Gift Voucher when crediting to Account', 6, 8, NULL, '2003-07-26 14:23:56', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (211, 'Allow Category Descriptions', 'ALLOW_CATEGORY_DESCRIPTIONS', 'true', 'Allow use of full text descriptions for categories', 1, 19, '2003-08-29 16:47:38', '2003-08-02 13:42:39', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (269, 'Main Big Pic Extension', 'BIG_PIC_EXT', '_big', 'This is if you name your main big image like IMAGE_big.jpg, you would put <b>_big</b> here.  Otherwise leave it blank', 99, 6, '2003-08-08 22:11:00', '2003-08-08 02:40:20', NULL, NULL);
INSERT INTO `configuration` VALUES (270, 'Mo Pics Thumbnail Image Type', 'THUMB_IMAGE_TYPE', 'gif', 'The file type of the mopic thumbnails', 99, 7, '2003-09-04 13:23:08', '2003-08-08 02:40:20', NULL, 'escs_cfg_select_option(array(\'jpg\', \'gif\', \'png\', \'bmp\'),');
INSERT INTO `configuration` VALUES (264, 'Big Images Directory', 'IN_IMAGE_BIGIMAGES', 'images_big/', 'The directory inside catalog/ images where your big images are stored.', 99, 1, NULL, '2003-08-08 02:40:20', NULL, NULL);
INSERT INTO `configuration` VALUES (271, 'Mo Pics Big Image Type', 'BIG_IMAGE_TYPE', 'gif', 'The file type of the mopic big images', 99, 8, '2003-09-04 13:23:15', '2003-08-08 02:40:20', NULL, 'escs_cfg_select_option(array(\'jpg\', \'gif\', \'png\', \'bmp\'),');
INSERT INTO `configuration` VALUES (265, 'Thumbnail Images Directory', 'IN_IMAGE_THUMBS', 'thumbs/', 'The directory inside catalog/ images where you extra image thumbs are stored.', 99, 2, NULL, '2003-08-08 02:40:20', NULL, NULL);
INSERT INTO `configuration` VALUES (266, 'Main Thumbnail In Thumb Directory', 'MAIN_THUMB_IN_SUBDIR', 'true', 'If you store your main thumb in the thumbnail directory set this true.  If it is in the main image dir, set it false.', 99, 3, '2003-09-13 01:37:07', '2003-08-08 02:40:20', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (267, 'Number of Pics per Row', 'THUMBS_PER_ROW', '4', 'How Many images to show per row.', 99, 4, NULL, '2003-08-08 02:40:20', NULL, NULL);
INSERT INTO `configuration` VALUES (268, 'Mo Pics Extension', 'MORE_PICS_EXT', '_pic', 'The addition to your image name for the mopics', 99, 5, NULL, '2003-08-08 02:40:20', NULL, NULL);
INSERT INTO `configuration` VALUES (407, 'Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '100', 'Sort order of display.', 6, 0, NULL, '2003-09-12 09:39:27', NULL, NULL);
INSERT INTO `configuration` VALUES (405, 'Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', 6, 0, NULL, '2003-09-12 09:39:27', 'escs_get_tax_class_title', 'escs_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (406, 'Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, NULL, '2003-09-12 09:39:27', 'escs_get_zone_class_title', 'escs_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (403, 'Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', 6, 0, NULL, '2003-09-12 09:39:27', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (404, 'Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'The shipping cost for all orders using this shipping method.', 6, 0, NULL, '2003-09-12 09:39:27', NULL, NULL);
INSERT INTO `configuration` VALUES (355, 'Tax Class', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', 6, 0, NULL, '2003-09-07 11:43:52', 'escs_get_tax_class_title', 'escs_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (354, 'Free Shipping Cost', 'MODULE_SHIPPING_FREESHIPPER_COST', '0.00', 'What is the Shipping cost? The Handling fee will also be added.', 6, 6, NULL, '2003-09-07 11:43:52', NULL, NULL);
INSERT INTO `configuration` VALUES (353, 'Enable Free Shipping', 'MODULE_SHIPPING_FREESHIPPER_STATUS', '1', 'Do you want to offer Free shipping?', 6, 5, NULL, '2003-09-07 11:43:52', NULL, NULL);
INSERT INTO `configuration` VALUES (352, 'Set Order Status', 'MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID', '3', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2003-09-07 11:43:17', 'escs_get_order_status_name', 'escs_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (350, 'Sort order of display.', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER', '300', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2003-09-07 11:43:17', NULL, NULL);
INSERT INTO `configuration` VALUES (351, 'Payment Zone', 'MODULE_PAYMENT_FREECHARGER_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2003-09-07 11:43:17', 'escs_get_zone_class_title', 'escs_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (349, 'Enable Free Charge Module', 'MODULE_PAYMENT_FREECHARGER_STATUS', 'True', 'Do you want to accept Free Charge payments?', 6, 1, NULL, '2003-09-07 11:43:17', NULL, 'escs_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (356, 'Shipping Zone', 'MODULE_SHIPPING_FREESHIPPER_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, NULL, '2003-09-07 11:43:52', 'escs_get_zone_class_title', 'escs_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (357, 'Sort Order', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', '600', 'Sort order of display.', 6, 0, NULL, '2003-09-07 11:43:52', NULL, NULL);
INSERT INTO `configuration` VALUES (358, 'Downloads Controller Update Status Value', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', '100000', 'What orders_status resets the Download days and Max Downloads - Default is 4', 13, 90, '2003-09-07 13:13:56', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `configuration` VALUES (359, 'Downloads Controller Download on hold message', 'DOWNLOADS_CONTROLLER_ON_HOLD_MSG', '<BR><font color="FF0000">NOTE: Downloads are not available until payment has been confirmed</font>', 'Downloads Controller Download on hold message', 13, 91, '2003-02-18 13:22:32', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `configuration` VALUES (360, 'Downloads Controller Order Status Value', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', '2', 'Downloads Controller Order Status Value - Default=2', 13, 92, '2003-09-07 13:14:39', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO `configuration` VALUES (361, 'Printable Catalog-Customer Discount in Catalog', 'PRODUCT_LIST_CUSTOMER_DISCOUNT', '0', 'Setting to 1 will display the catalog with a customer discount applied if logged in. It will display pricing without discount if not logged in. (only valid if Members Discount Mod is loaded. Default if Mod not present is 0)', 899, 1, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (362, 'Printable Catalog-Number of Page Breaks Displayed', 'PRODUCT_LIST_PAGEBREAK_NUMBERS_PERPAGE', '10', 'How page breaks numbers to display?', 899, 2, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (363, 'Printable Catalog-Results Per Page', 'PRODUCT_LIST_CATALOG_PERPAGE', '10', 'How many products do you want to list per page?', 899, 3, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (364, 'Printable Catalog-Length of the Description Text', 'PRODUCT_LIST_DESCRIPTION_LENGTH', '400', 'How many characters in the description to display?', 899, 4, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (365, 'Printable Catalog-Image column', 'PRODUCT_LIST_CATALOG_IMAGE', '1', 'Do you want to display the Image column?', 899, 5, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (366, 'Printable Catalog-Options column', 'PRODUCT_LIST_CATALOG_OPTIONS', '0', 'Do you want to display the Options colum?', 899, 6, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (367, 'Printable Catalog-Name column', 'PRODUCT_LIST_CATALOG_NAME', '1', 'Do you want to display the Name column?', 899, 7, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (368, 'Printable Catalog-Manufacturers column', 'PRODUCT_LIST_CATALOG_MANUFACTURERS', '0', 'Do you want to display the Manufacturers column?', 899, 8, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (369, 'Printable Catalog-Description column', 'PRODUCT_LIST_CATALOG_DESCRIPTION', '0', 'Do you want to display the Products Description column?', 899, 9, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (370, 'Printable Catalog-Categories column', 'PRODUCT_LIST_CATALOG_CATEGORIES', '1', 'Do you want to display the Categories column?', 899, 10, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (371, 'Printable Catalog-Model column', 'PRODUCT_LIST_CATALOG_MODEL', '1', 'Do you want to display the Model column?', 899, 11, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (372, 'Printable Catalog-UPC column', 'PRODUCT_LIST_CATALOG_UPC', '0', 'Do you want to display the UPC column? (only valid if Members Discount Mod is loaded Default if not present is 0)', 899, 12, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (373, 'Printable Catalog-Quantity column', 'PRODUCT_LIST_CATALOG_QUANTITY', '0', 'Do you want to display the Quantity column?', 899, 13, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (374, 'Printable Catalog-Weight column', 'PRODUCT_LIST_CATALOG_WEIGHT', '0', 'Do you want to display the Weight column?', 899, 14, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (375, 'Printable Catalog-Price column', 'PRODUCT_LIST_CATALOG_PRICE', '1', 'Do you want to display the Price column?', 899, 15, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (376, 'Printable Catalog-Date column', 'PRODUCT_LIST_CATALOG_DATE', '0', 'Do you want to display the Product Date Added column?', 899, 16, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (377, 'Printable Catalog-Show the Date?', 'PRODUCT_LIST_CATALOG_DATE_SHOW', '0', 'Do you want to display the Product Date Added (only valid if Display Printable Catalog Date column=1)', 899, 17, '2003-09-07 21:09:02', '2003-09-07 21:09:02', NULL, NULL);
INSERT INTO `configuration` VALUES (378, '<B>Down for Maintenance: ON/OFF</B>', 'DOWN_FOR_MAINTENANCE', 'false', 'Down for Maintenance <br>(true=on false=off)', 16, 1, '2003-09-07 21:57:33', '2003-09-07 21:43:00', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (379, 'Down for Maintenance: filename', 'DOWN_FOR_MAINTENANCE_FILENAME', 'down_for_maintenance.php', 'Down for Maintenance filename Default=down_for_maintenance.php', 16, 2, NULL, '2003-09-07 21:43:00', NULL, '');
INSERT INTO `configuration` VALUES (380, 'Down for Maintenance: Hide Header', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 'false', 'Down for Maintenance: Hide Header <br>(true=hide false=show)', 16, 3, NULL, '2003-09-07 21:43:00', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (381, 'Down for Maintenance: Hide Column Left', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 'false', 'Down for Maintenance: Hide Column Left <br>(true=hide false=show)', 16, 4, NULL, '2003-09-07 21:43:00', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (382, 'Down for Maintenance: Hide Column Right', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 'false', 'Down for Maintenance: Hide Column Right <br>(true=hide false=show)r', 16, 5, NULL, '2003-09-07 21:43:00', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (383, 'Down for Maintenance: Hide Footer', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 'false', 'Down for Maintenance: Hide Footer <br>(true=hide false=show)', 16, 6, NULL, '2003-09-07 21:43:00', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (384, 'Down for Maintenance: Hide Prices', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 'true', 'Down for Maintenance: Hide Prices <br>(true=hide false=show)', 16, 7, '2003-09-07 21:55:34', '2003-09-07 21:43:00', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (385, 'Down For Maintenance (exclude this IP-Address)', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', '', 'This IP Address is able to access the website while it is Down For Maintenance (like webmaster)', 16, 8, '2003-09-07 21:56:14', '2003-03-21 21:20:07', NULL, NULL);
INSERT INTO `configuration` VALUES (386, 'NOTIFY PUBLIC Before going Down for Maintenance: ON/OFF', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 'false', 'Give a WARNING some time before you put your website Down for Maintenance<br>(true=on false=off)<br>If you set the \'Down For Maintenance: ON/OFF\' to true this will automaticly be updated to false', 16, 9, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (387, 'Date and hours for notice before maintenance', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', '16/05/2003  between the hours of 2-3 PM', 'Date and hours for notice before maintenance website, enter date and hours for maintenance website', 16, 10, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);
INSERT INTO `configuration` VALUES (388, 'Display when webmaster has enabled maintenance', 'DISPLAY_MAINTENANCE_TIME', 'false', 'Display when Webmaster has enabled maintenance <br>(true=on false=off)<br>', 16, 11, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (389, 'Display website maintenance period', 'DISPLAY_MAINTENANCE_PERIOD', 'false', 'Display Website maintenance period <br>(true=on false=off)<br>', 16, 12, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'escs_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (390, 'Website maintenance period', 'TEXT_MAINTENANCE_PERIOD_TIME', '2h00', 'Enter Website Maintenance period (hh:mm)', 16, 13, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);

INSERT INTO `configuration` VALUES (501, 'Enable/Disable Live Support', 'ENABLE_DISABLE_LIVE_SUPPORT', 'yes', 'Enter Website Maintenance period (hh:mm)', 901, 13, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);


# --------------------------------------------------------

#
# Table structure for table `configuration_group`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 07, 2003 at 09:43 PM
#

CREATE TABLE `configuration_group` (
  `configuration_group_id` int(11) NOT NULL auto_increment,
  `configuration_group_title` varchar(64) NOT NULL default '',
  `configuration_group_description` varchar(255) NOT NULL default '',
  `sort_order` int(5) default NULL,
  `visible` int(1) default '1',
  PRIMARY KEY  (`configuration_group_id`)
) TYPE=MyISAM AUTO_INCREMENT=901 ;

#
# Dumping data for table `configuration_group`
#

INSERT INTO `configuration_group` VALUES (1, 'My Store', 'General information about my store', 1, 1);
INSERT INTO `configuration_group` VALUES (2, 'Minimum Values', 'The minimum values for functions / data', 2, 1);
INSERT INTO `configuration_group` VALUES (3, 'Maximum Values', 'The maximum values for functions / data', 3, 1);
INSERT INTO `configuration_group` VALUES (4, 'Images', 'Image parameters', 4, 1);
INSERT INTO `configuration_group` VALUES (5, 'Customer Details', 'Customer account configuration', 5, 1);
INSERT INTO `configuration_group` VALUES (6, 'Module Options', 'Hidden from configuration', 6, 0);
INSERT INTO `configuration_group` VALUES (7, 'Shipping/Packaging', 'Shipping options available at my store', 7, 1);
INSERT INTO `configuration_group` VALUES (8, 'Product Listing', 'Product Listing    configuration options', 8, 1);
INSERT INTO `configuration_group` VALUES (9, 'Stock', 'Stock configuration options', 9, 1);
INSERT INTO `configuration_group` VALUES (10, 'Logging', 'Logging configuration options', 10, 1);
INSERT INTO `configuration_group` VALUES (11, 'Cache', 'Caching configuration options', 11, 1);
INSERT INTO `configuration_group` VALUES (12, 'E-Mail Options', 'General setting for E-Mail transport and HTML E-Mails', 12, 1);
INSERT INTO `configuration_group` VALUES (13, 'Download', 'Downloadable products options', 13, 1);
INSERT INTO `configuration_group` VALUES (14, 'GZip Compression', 'GZip compression options', 14, 1);
INSERT INTO `configuration_group` VALUES (15, 'Sessions', 'Session options', 15, 1);
INSERT INTO `configuration_group` VALUES (112, 'WYSIWYG Editor 1.7', 'HTMLArea 1.7 Options', 15, 1);
INSERT INTO `configuration_group` VALUES (900, 'Affiliate Program', 'Options for the Affiliate Program', 50, 1);
INSERT INTO `configuration_group` VALUES (99, 'Dynamic MoPics', 'The options which configure Dynamic MoPics.', 99, 1);
INSERT INTO `configuration_group` VALUES (899, 'Printable Catalog', 'Options for Printable Catalog', 899, 1);
INSERT INTO `configuration_group` VALUES (16, 'Site Maintenance', 'Site Maintenance Options', 16, 1);
INSERT INTO `configuration_group` VALUES (901, 'Live Support', 'Live Support Options', 901, 1);

# --------------------------------------------------------

#
# Table structure for table `counter`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `counter` (
  `startdate` char(8) default NULL,
  `counter` int(12) default NULL
) TYPE=MyISAM;

#
# Dumping data for table `counter`
#

INSERT INTO `counter` VALUES ('20030717', 1995);

# --------------------------------------------------------

#
# Table structure for table `counter_history`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `counter_history` (
  `month` char(8) default NULL,
  `counter` int(12) default NULL
) TYPE=MyISAM;

#
# Table structure for table `countries`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL auto_increment,
  `countries_name` varchar(64) NOT NULL default '',
  `countries_iso_code_2` char(2) NOT NULL default '',
  `countries_iso_code_3` char(3) NOT NULL default '',
  `address_format_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`countries_id`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Dumping data for table `countries`
#

INSERT INTO `countries` VALUES (1, 'Afghanistan', 'AF', 'AFG', 1);
INSERT INTO `countries` VALUES (2, 'Albania', 'AL', 'ALB', 1);
INSERT INTO `countries` VALUES (3, 'Algeria', 'DZ', 'DZA', 1);
INSERT INTO `countries` VALUES (4, 'American Samoa', 'AS', 'ASM', 1);
INSERT INTO `countries` VALUES (5, 'Andorra', 'AD', 'AND', 1);
INSERT INTO `countries` VALUES (6, 'Angola', 'AO', 'AGO', 1);
INSERT INTO `countries` VALUES (7, 'Anguilla', 'AI', 'AIA', 1);
INSERT INTO `countries` VALUES (8, 'Antarctica', 'AQ', 'ATA', 1);
INSERT INTO `countries` VALUES (9, 'Antigua and Barbuda', 'AG', 'ATG', 1);
INSERT INTO `countries` VALUES (10, 'Argentina', 'AR', 'ARG', 1);
INSERT INTO `countries` VALUES (11, 'Armenia', 'AM', 'ARM', 1);
INSERT INTO `countries` VALUES (12, 'Aruba', 'AW', 'ABW', 1);
INSERT INTO `countries` VALUES (13, 'Australia', 'AU', 'AUS', 1);
INSERT INTO `countries` VALUES (14, 'Austria', 'AT', 'AUT', 5);
INSERT INTO `countries` VALUES (15, 'Azerbaijan', 'AZ', 'AZE', 1);
INSERT INTO `countries` VALUES (16, 'Bahamas', 'BS', 'BHS', 1);
INSERT INTO `countries` VALUES (17, 'Bahrain', 'BH', 'BHR', 1);
INSERT INTO `countries` VALUES (18, 'Bangladesh', 'BD', 'BGD', 1);
INSERT INTO `countries` VALUES (19, 'Barbados', 'BB', 'BRB', 1);
INSERT INTO `countries` VALUES (20, 'Belarus', 'BY', 'BLR', 1);
INSERT INTO `countries` VALUES (21, 'Belgium', 'BE', 'BEL', 1);
INSERT INTO `countries` VALUES (22, 'Belize', 'BZ', 'BLZ', 1);
INSERT INTO `countries` VALUES (23, 'Benin', 'BJ', 'BEN', 1);
INSERT INTO `countries` VALUES (24, 'Bermuda', 'BM', 'BMU', 1);
INSERT INTO `countries` VALUES (25, 'Bhutan', 'BT', 'BTN', 1);
INSERT INTO `countries` VALUES (26, 'Bolivia', 'BO', 'BOL', 1);
INSERT INTO `countries` VALUES (27, 'Bosnia and Herzegowina', 'BA', 'BIH', 1);
INSERT INTO `countries` VALUES (28, 'Botswana', 'BW', 'BWA', 1);
INSERT INTO `countries` VALUES (29, 'Bouvet Island', 'BV', 'BVT', 1);
INSERT INTO `countries` VALUES (30, 'Brazil', 'BR', 'BRA', 1);
INSERT INTO `countries` VALUES (31, 'British Indian Ocean Territory', 'IO', 'IOT', 1);
INSERT INTO `countries` VALUES (32, 'Brunei Darussalam', 'BN', 'BRN', 1);
INSERT INTO `countries` VALUES (33, 'Bulgaria', 'BG', 'BGR', 1);
INSERT INTO `countries` VALUES (34, 'Burkina Faso', 'BF', 'BFA', 1);
INSERT INTO `countries` VALUES (35, 'Burundi', 'BI', 'BDI', 1);
INSERT INTO `countries` VALUES (36, 'Cambodia', 'KH', 'KHM', 1);
INSERT INTO `countries` VALUES (37, 'Cameroon', 'CM', 'CMR', 1);
INSERT INTO `countries` VALUES (38, 'Canada', 'CA', 'CAN', 1);
INSERT INTO `countries` VALUES (39, 'Cape Verde', 'CV', 'CPV', 1);
INSERT INTO `countries` VALUES (40, 'Cayman Islands', 'KY', 'CYM', 1);
INSERT INTO `countries` VALUES (41, 'Central African Republic', 'CF', 'CAF', 1);
INSERT INTO `countries` VALUES (42, 'Chad', 'TD', 'TCD', 1);
INSERT INTO `countries` VALUES (43, 'Chile', 'CL', 'CHL', 1);
INSERT INTO `countries` VALUES (44, 'China', 'CN', 'CHN', 1);
INSERT INTO `countries` VALUES (45, 'Christmas Island', 'CX', 'CXR', 1);
INSERT INTO `countries` VALUES (46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1);
INSERT INTO `countries` VALUES (47, 'Colombia', 'CO', 'COL', 1);
INSERT INTO `countries` VALUES (48, 'Comoros', 'KM', 'COM', 1);
INSERT INTO `countries` VALUES (49, 'Congo', 'CG', 'COG', 1);
INSERT INTO `countries` VALUES (50, 'Cook Islands', 'CK', 'COK', 1);
INSERT INTO `countries` VALUES (51, 'Costa Rica', 'CR', 'CRI', 1);
INSERT INTO `countries` VALUES (52, 'Cote D\'Ivoire', 'CI', 'CIV', 1);
INSERT INTO `countries` VALUES (53, 'Croatia', 'HR', 'HRV', 1);
INSERT INTO `countries` VALUES (54, 'Cuba', 'CU', 'CUB', 1);
INSERT INTO `countries` VALUES (55, 'Cyprus', 'CY', 'CYP', 1);
INSERT INTO `countries` VALUES (56, 'Czech Republic', 'CZ', 'CZE', 1);
INSERT INTO `countries` VALUES (57, 'Denmark', 'DK', 'DNK', 1);
INSERT INTO `countries` VALUES (58, 'Djibouti', 'DJ', 'DJI', 1);
INSERT INTO `countries` VALUES (59, 'Dominica', 'DM', 'DMA', 1);
INSERT INTO `countries` VALUES (60, 'Dominican Republic', 'DO', 'DOM', 1);
INSERT INTO `countries` VALUES (61, 'East Timor', 'TP', 'TMP', 1);
INSERT INTO `countries` VALUES (62, 'Ecuador', 'EC', 'ECU', 1);
INSERT INTO `countries` VALUES (63, 'Egypt', 'EG', 'EGY', 1);
INSERT INTO `countries` VALUES (64, 'El Salvador', 'SV', 'SLV', 1);
INSERT INTO `countries` VALUES (65, 'Equatorial Guinea', 'GQ', 'GNQ', 1);
INSERT INTO `countries` VALUES (66, 'Eritrea', 'ER', 'ERI', 1);
INSERT INTO `countries` VALUES (67, 'Estonia', 'EE', 'EST', 1);
INSERT INTO `countries` VALUES (68, 'Ethiopia', 'ET', 'ETH', 1);
INSERT INTO `countries` VALUES (69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1);
INSERT INTO `countries` VALUES (70, 'Faroe Islands', 'FO', 'FRO', 1);
INSERT INTO `countries` VALUES (71, 'Fiji', 'FJ', 'FJI', 1);
INSERT INTO `countries` VALUES (72, 'Finland', 'FI', 'FIN', 1);
INSERT INTO `countries` VALUES (73, 'France', 'FR', 'FRA', 1);
INSERT INTO `countries` VALUES (74, 'France, Metropolitan', 'FX', 'FXX', 1);
INSERT INTO `countries` VALUES (75, 'French Guiana', 'GF', 'GUF', 1);
INSERT INTO `countries` VALUES (76, 'French Polynesia', 'PF', 'PYF', 1);
INSERT INTO `countries` VALUES (77, 'French Southern Territories', 'TF', 'ATF', 1);
INSERT INTO `countries` VALUES (78, 'Gabon', 'GA', 'GAB', 1);
INSERT INTO `countries` VALUES (79, 'Gambia', 'GM', 'GMB', 1);
INSERT INTO `countries` VALUES (80, 'Georgia', 'GE', 'GEO', 1);
INSERT INTO `countries` VALUES (81, 'Germany', 'DE', 'DEU', 5);
INSERT INTO `countries` VALUES (82, 'Ghana', 'GH', 'GHA', 1);
INSERT INTO `countries` VALUES (83, 'Gibraltar', 'GI', 'GIB', 1);
INSERT INTO `countries` VALUES (84, 'Greece', 'GR', 'GRC', 1);
INSERT INTO `countries` VALUES (85, 'Greenland', 'GL', 'GRL', 1);
INSERT INTO `countries` VALUES (86, 'Grenada', 'GD', 'GRD', 1);
INSERT INTO `countries` VALUES (87, 'Guadeloupe', 'GP', 'GLP', 1);
INSERT INTO `countries` VALUES (88, 'Guam', 'GU', 'GUM', 1);
INSERT INTO `countries` VALUES (89, 'Guatemala', 'GT', 'GTM', 1);
INSERT INTO `countries` VALUES (90, 'Guinea', 'GN', 'GIN', 1);
INSERT INTO `countries` VALUES (91, 'Guinea-bissau', 'GW', 'GNB', 1);
INSERT INTO `countries` VALUES (92, 'Guyana', 'GY', 'GUY', 1);
INSERT INTO `countries` VALUES (93, 'Haiti', 'HT', 'HTI', 1);
INSERT INTO `countries` VALUES (94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1);
INSERT INTO `countries` VALUES (95, 'Honduras', 'HN', 'HND', 1);
INSERT INTO `countries` VALUES (96, 'Hong Kong', 'HK', 'HKG', 1);
INSERT INTO `countries` VALUES (97, 'Hungary', 'HU', 'HUN', 1);
INSERT INTO `countries` VALUES (98, 'Iceland', 'IS', 'ISL', 1);
INSERT INTO `countries` VALUES (99, 'India', 'IN', 'IND', 1);
INSERT INTO `countries` VALUES (100, 'Indonesia', 'ID', 'IDN', 1);
INSERT INTO `countries` VALUES (101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1);
INSERT INTO `countries` VALUES (102, 'Iraq', 'IQ', 'IRQ', 1);
INSERT INTO `countries` VALUES (103, 'Ireland', 'IE', 'IRL', 1);
INSERT INTO `countries` VALUES (104, 'Israel', 'IL', 'ISR', 1);
INSERT INTO `countries` VALUES (105, 'Italy', 'IT', 'ITA', 1);
INSERT INTO `countries` VALUES (106, 'Jamaica', 'JM', 'JAM', 1);
INSERT INTO `countries` VALUES (107, 'Japan', 'JP', 'JPN', 1);
INSERT INTO `countries` VALUES (108, 'Jordan', 'JO', 'JOR', 1);
INSERT INTO `countries` VALUES (109, 'Kazakhstan', 'KZ', 'KAZ', 1);
INSERT INTO `countries` VALUES (110, 'Kenya', 'KE', 'KEN', 1);
INSERT INTO `countries` VALUES (111, 'Kiribati', 'KI', 'KIR', 1);
INSERT INTO `countries` VALUES (112, 'Korea, Democratic People\'s Republic of', 'KP', 'PRK', 1);
INSERT INTO `countries` VALUES (113, 'Korea, Republic of', 'KR', 'KOR', 1);
INSERT INTO `countries` VALUES (114, 'Kuwait', 'KW', 'KWT', 1);
INSERT INTO `countries` VALUES (115, 'Kyrgyzstan', 'KG', 'KGZ', 1);
INSERT INTO `countries` VALUES (116, 'Lao People\'s Democratic Republic', 'LA', 'LAO', 1);
INSERT INTO `countries` VALUES (117, 'Latvia', 'LV', 'LVA', 1);
INSERT INTO `countries` VALUES (118, 'Lebanon', 'LB', 'LBN', 1);
INSERT INTO `countries` VALUES (119, 'Lesotho', 'LS', 'LSO', 1);
INSERT INTO `countries` VALUES (120, 'Liberia', 'LR', 'LBR', 1);
INSERT INTO `countries` VALUES (121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1);
INSERT INTO `countries` VALUES (122, 'Liechtenstein', 'LI', 'LIE', 1);
INSERT INTO `countries` VALUES (123, 'Lithuania', 'LT', 'LTU', 1);
INSERT INTO `countries` VALUES (124, 'Luxembourg', 'LU', 'LUX', 1);
INSERT INTO `countries` VALUES (125, 'Macau', 'MO', 'MAC', 1);
INSERT INTO `countries` VALUES (126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 1);
INSERT INTO `countries` VALUES (127, 'Madagascar', 'MG', 'MDG', 1);
INSERT INTO `countries` VALUES (128, 'Malawi', 'MW', 'MWI', 1);
INSERT INTO `countries` VALUES (129, 'Malaysia', 'MY', 'MYS', 1);
INSERT INTO `countries` VALUES (130, 'Maldives', 'MV', 'MDV', 1);
INSERT INTO `countries` VALUES (131, 'Mali', 'ML', 'MLI', 1);
INSERT INTO `countries` VALUES (132, 'Malta', 'MT', 'MLT', 1);
INSERT INTO `countries` VALUES (133, 'Marshall Islands', 'MH', 'MHL', 1);
INSERT INTO `countries` VALUES (134, 'Martinique', 'MQ', 'MTQ', 1);
INSERT INTO `countries` VALUES (135, 'Mauritania', 'MR', 'MRT', 1);
INSERT INTO `countries` VALUES (136, 'Mauritius', 'MU', 'MUS', 1);
INSERT INTO `countries` VALUES (137, 'Mayotte', 'YT', 'MYT', 1);
INSERT INTO `countries` VALUES (138, 'Mexico', 'MX', 'MEX', 1);
INSERT INTO `countries` VALUES (139, 'Micronesia, Federated States of', 'FM', 'FSM', 1);
INSERT INTO `countries` VALUES (140, 'Moldova, Republic of', 'MD', 'MDA', 1);
INSERT INTO `countries` VALUES (141, 'Monaco', 'MC', 'MCO', 1);
INSERT INTO `countries` VALUES (142, 'Mongolia', 'MN', 'MNG', 1);
INSERT INTO `countries` VALUES (143, 'Montserrat', 'MS', 'MSR', 1);
INSERT INTO `countries` VALUES (144, 'Morocco', 'MA', 'MAR', 1);
INSERT INTO `countries` VALUES (145, 'Mozambique', 'MZ', 'MOZ', 1);
INSERT INTO `countries` VALUES (146, 'Myanmar', 'MM', 'MMR', 1);
INSERT INTO `countries` VALUES (147, 'Namibia', 'NA', 'NAM', 1);
INSERT INTO `countries` VALUES (148, 'Nauru', 'NR', 'NRU', 1);
INSERT INTO `countries` VALUES (149, 'Nepal', 'NP', 'NPL', 1);
INSERT INTO `countries` VALUES (150, 'Netherlands', 'NL', 'NLD', 1);
INSERT INTO `countries` VALUES (151, 'Netherlands Antilles', 'AN', 'ANT', 1);
INSERT INTO `countries` VALUES (152, 'New Caledonia', 'NC', 'NCL', 1);
INSERT INTO `countries` VALUES (153, 'New Zealand', 'NZ', 'NZL', 1);
INSERT INTO `countries` VALUES (154, 'Nicaragua', 'NI', 'NIC', 1);
INSERT INTO `countries` VALUES (155, 'Niger', 'NE', 'NER', 1);
INSERT INTO `countries` VALUES (156, 'Nigeria', 'NG', 'NGA', 1);
INSERT INTO `countries` VALUES (157, 'Niue', 'NU', 'NIU', 1);
INSERT INTO `countries` VALUES (158, 'Norfolk Island', 'NF', 'NFK', 1);
INSERT INTO `countries` VALUES (159, 'Northern Mariana Islands', 'MP', 'MNP', 1);
INSERT INTO `countries` VALUES (160, 'Norway', 'NO', 'NOR', 1);
INSERT INTO `countries` VALUES (161, 'Oman', 'OM', 'OMN', 1);
INSERT INTO `countries` VALUES (162, 'Pakistan', 'PK', 'PAK', 1);
INSERT INTO `countries` VALUES (163, 'Palau', 'PW', 'PLW', 1);
INSERT INTO `countries` VALUES (164, 'Panama', 'PA', 'PAN', 1);
INSERT INTO `countries` VALUES (165, 'Papua New Guinea', 'PG', 'PNG', 1);
INSERT INTO `countries` VALUES (166, 'Paraguay', 'PY', 'PRY', 1);
INSERT INTO `countries` VALUES (167, 'Peru', 'PE', 'PER', 1);
INSERT INTO `countries` VALUES (168, 'Philippines', 'PH', 'PHL', 1);
INSERT INTO `countries` VALUES (169, 'Pitcairn', 'PN', 'PCN', 1);
INSERT INTO `countries` VALUES (170, 'Poland', 'PL', 'POL', 1);
INSERT INTO `countries` VALUES (171, 'Portugal', 'PT', 'PRT', 1);
INSERT INTO `countries` VALUES (172, 'Puerto Rico', 'PR', 'PRI', 1);
INSERT INTO `countries` VALUES (173, 'Qatar', 'QA', 'QAT', 1);
INSERT INTO `countries` VALUES (174, 'Reunion', 'RE', 'REU', 1);
INSERT INTO `countries` VALUES (175, 'Romania', 'RO', 'ROM', 1);
INSERT INTO `countries` VALUES (176, 'Russian Federation', 'RU', 'RUS', 1);
INSERT INTO `countries` VALUES (177, 'Rwanda', 'RW', 'RWA', 1);
INSERT INTO `countries` VALUES (178, 'Saint Kitts and Nevis', 'KN', 'KNA', 1);
INSERT INTO `countries` VALUES (179, 'Saint Lucia', 'LC', 'LCA', 1);
INSERT INTO `countries` VALUES (180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1);
INSERT INTO `countries` VALUES (181, 'Samoa', 'WS', 'WSM', 1);
INSERT INTO `countries` VALUES (182, 'San Marino', 'SM', 'SMR', 1);
INSERT INTO `countries` VALUES (183, 'Sao Tome and Principe', 'ST', 'STP', 1);
INSERT INTO `countries` VALUES (184, 'Saudi Arabia', 'SA', 'SAU', 1);
INSERT INTO `countries` VALUES (185, 'Senegal', 'SN', 'SEN', 1);
INSERT INTO `countries` VALUES (186, 'Seychelles', 'SC', 'SYC', 1);
INSERT INTO `countries` VALUES (187, 'Sierra Leone', 'SL', 'SLE', 1);
INSERT INTO `countries` VALUES (188, 'Singapore', 'SG', 'SGP', 4);
INSERT INTO `countries` VALUES (189, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1);
INSERT INTO `countries` VALUES (190, 'Slovenia', 'SI', 'SVN', 1);
INSERT INTO `countries` VALUES (191, 'Solomon Islands', 'SB', 'SLB', 1);
INSERT INTO `countries` VALUES (192, 'Somalia', 'SO', 'SOM', 1);
INSERT INTO `countries` VALUES (193, 'South Africa', 'ZA', 'ZAF', 1);
INSERT INTO `countries` VALUES (194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 1);
INSERT INTO `countries` VALUES (195, 'Spain', 'ES', 'ESP', 3);
INSERT INTO `countries` VALUES (196, 'Sri Lanka', 'LK', 'LKA', 1);
INSERT INTO `countries` VALUES (197, 'St. Helena', 'SH', 'SHN', 1);
INSERT INTO `countries` VALUES (198, 'St. Pierre and Miquelon', 'PM', 'SPM', 1);
INSERT INTO `countries` VALUES (199, 'Sudan', 'SD', 'SDN', 1);
INSERT INTO `countries` VALUES (200, 'Suriname', 'SR', 'SUR', 1);
INSERT INTO `countries` VALUES (201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1);
INSERT INTO `countries` VALUES (202, 'Swaziland', 'SZ', 'SWZ', 1);
INSERT INTO `countries` VALUES (203, 'Sweden', 'SE', 'SWE', 1);
INSERT INTO `countries` VALUES (204, 'Switzerland', 'CH', 'CHE', 1);
INSERT INTO `countries` VALUES (205, 'Syrian Arab Republic', 'SY', 'SYR', 1);
INSERT INTO `countries` VALUES (206, 'Taiwan', 'TW', 'TWN', 1);
INSERT INTO `countries` VALUES (207, 'Tajikistan', 'TJ', 'TJK', 1);
INSERT INTO `countries` VALUES (208, 'Tanzania, United Republic of', 'TZ', 'TZA', 1);
INSERT INTO `countries` VALUES (209, 'Thailand', 'TH', 'THA', 1);
INSERT INTO `countries` VALUES (210, 'Togo', 'TG', 'TGO', 1);
INSERT INTO `countries` VALUES (211, 'Tokelau', 'TK', 'TKL', 1);
INSERT INTO `countries` VALUES (212, 'Tonga', 'TO', 'TON', 1);
INSERT INTO `countries` VALUES (213, 'Trinidad and Tobago', 'TT', 'TTO', 1);
INSERT INTO `countries` VALUES (214, 'Tunisia', 'TN', 'TUN', 1);
INSERT INTO `countries` VALUES (215, 'Turkey', 'TR', 'TUR', 1);
INSERT INTO `countries` VALUES (216, 'Turkmenistan', 'TM', 'TKM', 1);
INSERT INTO `countries` VALUES (217, 'Turks and Caicos Islands', 'TC', 'TCA', 1);
INSERT INTO `countries` VALUES (218, 'Tuvalu', 'TV', 'TUV', 1);
INSERT INTO `countries` VALUES (219, 'Uganda', 'UG', 'UGA', 1);
INSERT INTO `countries` VALUES (220, 'Ukraine', 'UA', 'UKR', 1);
INSERT INTO `countries` VALUES (221, 'United Arab Emirates', 'AE', 'ARE', 1);
INSERT INTO `countries` VALUES (222, 'United Kingdom', 'GB', 'GBR', 1);
INSERT INTO `countries` VALUES (223, 'United States', 'US', 'USA', 2);
INSERT INTO `countries` VALUES (224, 'United States Minor Outlying Islands', 'UM', 'UMI', 1);
INSERT INTO `countries` VALUES (225, 'Uruguay', 'UY', 'URY', 1);
INSERT INTO `countries` VALUES (226, 'Uzbekistan', 'UZ', 'UZB', 1);
INSERT INTO `countries` VALUES (227, 'Vanuatu', 'VU', 'VUT', 1);
INSERT INTO `countries` VALUES (228, 'Vatican City State (Holy See)', 'VA', 'VAT', 1);
INSERT INTO `countries` VALUES (229, 'Venezuela', 'VE', 'VEN', 1);
INSERT INTO `countries` VALUES (230, 'Viet Nam', 'VN', 'VNM', 1);
INSERT INTO `countries` VALUES (231, 'Virgin Islands (British)', 'VG', 'VGB', 1);
INSERT INTO `countries` VALUES (232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1);
INSERT INTO `countries` VALUES (233, 'Wallis and Futuna Islands', 'WF', 'WLF', 1);
INSERT INTO `countries` VALUES (234, 'Western Sahara', 'EH', 'ESH', 1);
INSERT INTO `countries` VALUES (235, 'Yemen', 'YE', 'YEM', 1);
INSERT INTO `countries` VALUES (236, 'Yugoslavia', 'YU', 'YUG', 1);
INSERT INTO `countries` VALUES (237, 'Zaire', 'ZR', 'ZAR', 1);
INSERT INTO `countries` VALUES (238, 'Zambia', 'ZM', 'ZMB', 1);
INSERT INTO `countries` VALUES (239, 'Zimbabwe', 'ZW', 'ZWE', 1);

# --------------------------------------------------------

#
# Table structure for table `coupon_email_track`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `coupon_email_track` (
  `unique_id` int(11) NOT NULL auto_increment,
  `coupon_id` int(11) NOT NULL default '0',
  `customer_id_sent` int(11) NOT NULL default '0',
  `sent_firstname` varchar(32) default NULL,
  `sent_lastname` varchar(32) default NULL,
  `emailed_to` varchar(32) default NULL,
  `date_sent` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`unique_id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

#
# Table structure for table `coupon_gv_customer`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 12, 2003 at 09:45 AM
#

CREATE TABLE `coupon_gv_customer` (
  `customer_id` int(5) NOT NULL default '0',
  `amount` decimal(8,4) NOT NULL default '0.0000',
  PRIMARY KEY  (`customer_id`),
  KEY `customer_id` (`customer_id`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `coupon_gv_queue`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 12, 2003 at 09:45 AM
#

CREATE TABLE `coupon_gv_queue` (
  `unique_id` int(5) NOT NULL auto_increment,
  `customer_id` int(5) NOT NULL default '0',
  `order_id` int(5) NOT NULL default '0',
  `amount` decimal(8,4) NOT NULL default '0.0000',
  `date_created` datetime NOT NULL default '0000-00-00 00:00:00',
  `ipaddr` varchar(32) NOT NULL default '',
  `release_flag` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`unique_id`),
  KEY `uid` (`unique_id`,`customer_id`,`order_id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

# --------------------------------------------------------

#
# Table structure for table `coupon_redeem_track`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `coupon_redeem_track` (
  `unique_id` int(11) NOT NULL auto_increment,
  `coupon_id` int(11) NOT NULL default '0',
  `customer_id` int(11) NOT NULL default '0',
  `redeem_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `redeem_ip` varchar(32) NOT NULL default '',
  `order_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`unique_id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

#
# Table structure for table `coupons`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL auto_increment,
  `coupon_type` char(1) NOT NULL default 'F',
  `coupon_code` varchar(32) NOT NULL default '',
  `coupon_amount` decimal(8,4) NOT NULL default '0.0000',
  `coupon_minimum_order` decimal(8,4) NOT NULL default '0.0000',
  `coupon_start_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `coupon_expire_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `uses_per_coupon` int(5) NOT NULL default '1',
  `uses_per_user` int(5) NOT NULL default '0',
  `restrict_to_products` varchar(255) default NULL,
  `restrict_to_categories` varchar(255) default NULL,
  `restrict_to_customers` text,
  `coupon_active` char(1) NOT NULL default 'Y',
  `date_created` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`coupon_id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

# --------------------------------------------------------

#
# Table structure for table `coupons_description`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `coupons_description` (
  `coupon_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '0',
  `coupon_name` varchar(32) NOT NULL default '',
  `coupon_description` text,
  KEY `coupon_id` (`coupon_id`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `currencies`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `currencies` (
  `currencies_id` int(11) NOT NULL auto_increment,
  `title` varchar(32) NOT NULL default '',
  `code` char(3) NOT NULL default '',
  `symbol_left` varchar(12) default NULL,
  `symbol_right` varchar(12) default NULL,
  `decimal_point` char(1) default NULL,
  `thousands_point` char(1) default NULL,
  `decimal_places` char(1) default NULL,
  `value` float(13,8) default NULL,
  `last_updated` datetime default NULL,
  PRIMARY KEY  (`currencies_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

#
# Dumping data for table `currencies`
#

INSERT INTO `currencies` VALUES (1, 'US Dollar', 'USD', '$', '', '.', ',', '2', '1.00000000', '2003-07-17 10:29:23');
INSERT INTO `currencies` VALUES (2, 'Euro', 'EUR', '', 'EUR', '.', ',', '2', '1.10360003', '2003-07-17 10:29:23');

# --------------------------------------------------------

#
# Table structure for table `customers`
#
# Creation: Sep 12, 2003 at 10:02 AM
# Last update: Sep 12, 2003 at 12:59 PM
#

CREATE TABLE `customers` (
  `customers_id` int(11) NOT NULL auto_increment,
  `customers_gender` char(1) NOT NULL default '',
  `customers_firstname` varchar(32) NOT NULL default '',
  `customers_lastname` varchar(32) NOT NULL default '',
  `customers_dob` datetime NOT NULL default '0000-00-00 00:00:00',
  `customers_email_address` varchar(96) NOT NULL default '',
  `customers_default_address_id` int(11) NOT NULL default '0',
  `customers_telephone` varchar(32) NOT NULL default '',
  `customers_fax` varchar(32) default NULL,
  `customers_password` varchar(40) NOT NULL default '',
  `customers_newsletter` char(1) default NULL,
  `customers_group_name` varchar(27) NOT NULL default 'Retail',
  `customers_group_id` int(11) NOT NULL default '0',
  `customers_advertiser` varchar(30), 
  `customers_referer_url` varchar(255), 
  PRIMARY KEY  (`customers_id`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

# --------------------------------------------------------

#
# Table structure for table `customers_basket`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `customers_basket` (
  `customers_basket_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `products_id` tinytext NOT NULL,
  `customers_basket_quantity` int(2) NOT NULL default '0',
  `final_price` decimal(15,4) NOT NULL default '0.0000',
  `customers_basket_date_added` varchar(8) default NULL,
  PRIMARY KEY  (`customers_basket_id`)
) TYPE=MyISAM AUTO_INCREMENT=67 ;

#
# Table structure for table `customers_basket_attributes`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `customers_basket_attributes` (
  `customers_basket_attributes_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `products_id` tinytext NOT NULL,
  `products_options_id` int(11) NOT NULL default '0',
  `products_options_value_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`customers_basket_attributes_id`)
) TYPE=MyISAM AUTO_INCREMENT=34 ;

#
# Table structure for table `customers_info`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:37 AM
#

CREATE TABLE `customers_info` (
  `customers_info_id` int(11) NOT NULL default '0',
  `customers_info_date_of_last_logon` datetime default NULL,
  `customers_info_number_of_logons` int(5) default NULL,
  `customers_info_date_account_created` datetime default NULL,
  `customers_info_date_account_last_modified` datetime default NULL,
  `global_product_notifications` int(1) default '0',
  PRIMARY KEY  (`customers_info_id`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `geo_zones`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `geo_zones` (
  `geo_zone_id` int(11) NOT NULL auto_increment,
  `geo_zone_name` varchar(32) NOT NULL default '',
  `geo_zone_description` varchar(255) NOT NULL default '',
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`geo_zone_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Dumping data for table `geo_zones`
#

INSERT INTO `geo_zones` VALUES (1, 'Florida', 'Florida local sales tax zone', NULL, '2003-07-17 10:29:23');

# --------------------------------------------------------

#
# Table structure for table `languages`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `languages` (
  `languages_id` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL default '',
  `code` char(2) NOT NULL default '',
  `image` varchar(64) default NULL,
  `directory` varchar(32) default NULL,
  `sort_order` int(3) default NULL,
  PRIMARY KEY  (`languages_id`),
  KEY `IDX_LANGUAGES_NAME` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=4 ;

#
# Dumping data for table `languages`
#

INSERT INTO `languages` VALUES (1, 'English', 'en', 'icon.gif', 'english', 1);
INSERT INTO `languages` VALUES (2, 'Deutsch', 'de', 'icon.gif', 'german', 2);
INSERT INTO `languages` VALUES (3, 'Español', 'es', 'icon.gif', 'espanol', 3);

# --------------------------------------------------------

#
# Table structure for table `manufacturers`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `manufacturers` (
  `manufacturers_id` int(11) NOT NULL auto_increment,
  `manufacturers_name` varchar(32) NOT NULL default '',
  `manufacturers_image` varchar(64) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`manufacturers_id`),
  KEY `IDX_MANUFACTURERS_NAME` (`manufacturers_name`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

#
# Table structure for table `manufacturers_info`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `manufacturers_info` (
  `manufacturers_id` int(11) NOT NULL default '0',
  `languages_id` int(11) NOT NULL default '0',
  `manufacturers_url` varchar(255) NOT NULL default '',
  `url_clicked` int(5) NOT NULL default '0',
  `date_last_click` datetime default NULL,
  PRIMARY KEY  (`manufacturers_id`,`languages_id`)
) TYPE=MyISAM;

#
# Table structure for table `newsletters`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `newsletters` (
  `newsletters_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `module` varchar(255) NOT NULL default '',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_sent` datetime default NULL,
  `status` int(1) default NULL,
  `locked` int(1) default '0',
  PRIMARY KEY  (`newsletters_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Table structure for table `orders`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `customers_name` varchar(64) NOT NULL default '',
  `customers_company` varchar(32) default NULL,
  `customers_street_address` varchar(64) NOT NULL default '',
  `customers_suburb` varchar(32) default NULL,
  `customers_city` varchar(32) NOT NULL default '',
  `customers_postcode` varchar(10) NOT NULL default '',
  `customers_state` varchar(32) default NULL,
  `customers_country` varchar(32) NOT NULL default '',
  `customers_telephone` varchar(32) NOT NULL default '',
  `customers_email_address` varchar(96) NOT NULL default '',
  `customers_address_format_id` int(5) NOT NULL default '0',
  `delivery_name` varchar(64) NOT NULL default '',
  `delivery_company` varchar(32) default NULL,
  `delivery_street_address` varchar(64) NOT NULL default '',
  `delivery_suburb` varchar(32) default NULL,
  `delivery_city` varchar(32) NOT NULL default '',
  `delivery_postcode` varchar(10) NOT NULL default '',
  `delivery_state` varchar(32) default NULL,
  `delivery_country` varchar(32) NOT NULL default '',
  `delivery_address_format_id` int(5) NOT NULL default '0',
  `billing_name` varchar(64) NOT NULL default '',
  `billing_company` varchar(32) default NULL,
  `billing_street_address` varchar(64) NOT NULL default '',
  `billing_suburb` varchar(32) default NULL,
  `billing_city` varchar(32) NOT NULL default '',
  `billing_postcode` varchar(10) NOT NULL default '',
  `billing_state` varchar(32) default NULL,
  `billing_country` varchar(32) NOT NULL default '',
  `billing_address_format_id` int(5) NOT NULL default '0',
  `payment_method` varchar(32) NOT NULL default '',
  `cc_type` varchar(20) default NULL,
  `cc_owner` varchar(64) default NULL,
  `cc_number` varchar(32) default NULL,
  `cc_expires` varchar(4) default NULL,
  `last_modified` datetime default NULL,
  `date_purchased` datetime default NULL,
  `orders_status` int(5) NOT NULL default '0',
  `orders_date_finished` datetime default NULL,
  `currency` char(3) default NULL,
  `currency_value` decimal(14,6) default NULL,
  PRIMARY KEY  (`orders_id`)
) TYPE=MyISAM AUTO_INCREMENT=36 ;

#
# Table structure for table `orders_products`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `orders_products` (
  `orders_products_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `products_id` int(11) NOT NULL default '0',
  `products_model` varchar(12) default NULL,
  `products_name` varchar(64) NOT NULL default '',
  `products_price` decimal(15,4) NOT NULL default '0.0000',
  `final_price` decimal(15,4) NOT NULL default '0.0000',
  `products_tax` decimal(7,4) NOT NULL default '0.0000',
  `products_quantity` int(2) NOT NULL default '0',
  PRIMARY KEY  (`orders_products_id`)
) TYPE=MyISAM AUTO_INCREMENT=44 ;

#
# Table structure for table `orders_products_attributes`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `orders_products_attributes` (
  `orders_products_attributes_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `orders_products_id` int(11) NOT NULL default '0',
  `products_options` varchar(32) NOT NULL default '',
  `products_options_values` varchar(32) NOT NULL default '',
  `options_values_price` decimal(15,4) NOT NULL default '0.0000',
  `price_prefix` char(1) NOT NULL default '',
  PRIMARY KEY  (`orders_products_attributes_id`)
) TYPE=MyISAM AUTO_INCREMENT=23 ;

#
# Table structure for table `orders_products_download`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `orders_products_download` (
  `orders_products_download_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `orders_products_id` int(11) NOT NULL default '0',
  `orders_products_filename` varchar(255) NOT NULL default '',
  `download_maxdays` int(2) NOT NULL default '0',
  `download_count` int(2) NOT NULL default '0',
  PRIMARY KEY  (`orders_products_download_id`)
) TYPE=MyISAM AUTO_INCREMENT=16 ;

#
# Table structure for table `orders_status`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 07, 2003 at 01:12 PM
#

CREATE TABLE `orders_status` (
  `orders_status_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `orders_status_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name` (`orders_status_name`)
) TYPE=MyISAM;

#
# Dumping data for table `orders_status`
#

INSERT INTO `orders_status` VALUES (1, 1, 'Pending');
INSERT INTO `orders_status` VALUES (1, 2, 'Offen');
INSERT INTO `orders_status` VALUES (1, 3, 'Pendiente');
INSERT INTO `orders_status` VALUES (2, 1, 'Processing');
INSERT INTO `orders_status` VALUES (2, 2, 'In Bearbeitung');
INSERT INTO `orders_status` VALUES (2, 3, 'Proceso');
INSERT INTO `orders_status` VALUES (3, 1, 'Delivered');
INSERT INTO `orders_status` VALUES (3, 2, 'Versendet');
INSERT INTO `orders_status` VALUES (3, 3, 'Entregado');
INSERT INTO `orders_status` VALUES (99999, 3, 'Procesando Paypal');
INSERT INTO `orders_status` VALUES (99999, 1, 'Paypal Processing');
INSERT INTO `orders_status` VALUES (100000, 1, 'Updated');
INSERT INTO `orders_status` VALUES (100000, 2, 'Updated');
INSERT INTO `orders_status` VALUES (100000, 3, 'Updated');

# --------------------------------------------------------#
# Table structure for table `orders_status_history`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `orders_status_history` (
  `orders_status_history_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `orders_status_id` int(5) NOT NULL default '0',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `customer_notified` int(1) default '0',
  `comments` text,
  PRIMARY KEY  (`orders_status_history_id`)
) TYPE=MyISAM AUTO_INCREMENT=46 ;

#
# Table structure for table `orders_total`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
# Last check: Aug 30, 2003 at 12:35 AM
#

CREATE TABLE `orders_total` (
  `orders_total_id` int(10) unsigned NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `text` varchar(255) NOT NULL default '',
  `value` decimal(15,4) NOT NULL default '0.0000',
  `class` varchar(32) NOT NULL default '',
  `sort_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`orders_total_id`),
  KEY `idx_orders_total_orders_id` (`orders_id`)
) TYPE=MyISAM AUTO_INCREMENT=92 ;

#
# Table structure for table `paypalipn_txn`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 12, 2003 at 09:40 AM
#

CREATE TABLE `paypalipn_txn` (
  `paypalipn_txn_id` int(11) NOT NULL auto_increment,
  `txn_id` varchar(17) NOT NULL default '',
  `ipn_result` varchar(10) NOT NULL default '',
  `receiver_email` varchar(255) NOT NULL default '',
  `business` varchar(255) NOT NULL default '',
  `item_name` varchar(96) NOT NULL default '',
  `item_number` int(11) NOT NULL default '0',
  `quantity` int(11) NOT NULL default '0',
  `invoice` varchar(255) NOT NULL default '',
  `custom` varchar(255) NOT NULL default '',
  `option_name1` varchar(255) NOT NULL default '',
  `option_selection1` varchar(255) NOT NULL default '',
  `option_name2` varchar(255) NOT NULL default '',
  `option_selection2` varchar(255) NOT NULL default '',
  `num_cart_items` int(11) NOT NULL default '0',
  `payment_status` varchar(10) NOT NULL default '',
  `pending_reason` varchar(10) NOT NULL default '',
  `payment_date` varchar(100) NOT NULL default '',
  `settle_amount` varchar(32) NOT NULL default '',
  `settle_currency` varchar(32) NOT NULL default '',
  `exchange_rate` varchar(32) NOT NULL default '',
  `payment_gross` decimal(15,4) NOT NULL default '0.0000',
  `payment_fee` decimal(15,4) NOT NULL default '0.0000',
  `mc_gross` decimal(15,4) NOT NULL default '0.0000',
  `mc_fee` decimal(15,4) NOT NULL default '0.0000',
  `mc_currency` varchar(10) NOT NULL default '',
  `tax` varchar(32) NOT NULL default '',
  `txn_type` varchar(10) NOT NULL default '',
  `for_auction` varchar(255) NOT NULL default '',
  `memo` varchar(255) NOT NULL default '',
  `first_name` varchar(32) NOT NULL default '',
  `last_name` varchar(32) NOT NULL default '',
  `address_street` varchar(64) NOT NULL default '',
  `address_city` varchar(64) NOT NULL default '',
  `address_state` varchar(64) NOT NULL default '',
  `address_zip` varchar(10) NOT NULL default '',
  `address_country` varchar(32) NOT NULL default '',
  `address_status` varchar(11) NOT NULL default '',
  `payer_email` varchar(96) NOT NULL default '',
  `payer_id` varchar(128) NOT NULL default '',
  `payer_status` varchar(15) NOT NULL default '',
  `payment_type` varchar(7) NOT NULL default '',
  `notify_version` varchar(5) NOT NULL default '',
  `verify_sign` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`paypalipn_txn_id`),
  KEY `txn_id` (`txn_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

#
# Table structure for table `products`
#
# Creation: Sep 09, 2003 at 12:20 AM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `products` (
  `products_id` int(11) NOT NULL auto_increment,
  `products_quantity` int(4) NOT NULL default '0',
  `products_model` varchar(25) default NULL,
  `products_image` varchar(64) default NULL,
  `products_price` decimal(15,4) NOT NULL default '0.0000',
  `products_date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `products_last_modified` datetime default NULL,
  `products_date_available` datetime default NULL,
  `products_weight` decimal(5,2) NOT NULL default '0.00',
  `products_status` tinyint(1) NOT NULL default '0',
  `products_tax_class_id` int(11) NOT NULL default '0',
  `manufacturers_id` int(11) default NULL,
  `products_ordered` int(11) NOT NULL default '0',
  `products_ship_price` decimal(15,4) NOT NULL default '0.0000',
  `product_image2` varchar(64), 
  `product_image3` varchar(64), 
  `product_image4` varchar(64),
  `product_image5` varchar(64), 
  `product_image6` varchar(64), 
  `product_image7` varchar(64), 
  `product_image8` varchar(64), 
  `product_image9` varchar(64), 
  `product_image10` varchar(64), 
  PRIMARY KEY  (`products_id`),
  KEY `idx_products_date_added` (`products_date_added`)
) TYPE=MyISAM AUTO_INCREMENT=65;

#
# Table structure for table `products_attributes`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 07, 2003 at 10:35 PM
#

CREATE TABLE `products_attributes` (
  `products_attributes_id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `options_id` int(11) NOT NULL default '0',
  `options_values_id` int(11) NOT NULL default '0',
  `options_values_price` decimal(15,4) NOT NULL default '0.0000',
  `price_prefix` char(1) NOT NULL default '',
  PRIMARY KEY  (`products_attributes_id`)
) TYPE=MyISAM AUTO_INCREMENT=32 ;

#
# Table structure for table `products_attributes_download`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 07, 2003 at 12:05 PM
#

CREATE TABLE `products_attributes_download` (
  `products_attributes_id` int(11) NOT NULL default '0',
  `products_attributes_filename` varchar(255) NOT NULL default '',
  `products_attributes_maxdays` int(2) default '0',
  `products_attributes_maxcount` int(2) default '0',
  PRIMARY KEY  (`products_attributes_id`)
) TYPE=MyISAM;

#
# Table structure for table `products_description`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:37 AM
#

CREATE TABLE `products_description` (
  `products_id` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL default '1',
  `products_name` varchar(64) NOT NULL default '',
  `products_description` text,
  `products_url` varchar(255) default NULL,
  `products_viewed` int(5) default '0',
  PRIMARY KEY  (`products_id`,`language_id`),
  KEY `products_name` (`products_name`)
) TYPE=MyISAM AUTO_INCREMENT=65 ;

#
# Table structure for table `products_groups`
#
# Creation: Sep 12, 2003 at 10:05 AM
# Last update: Sep 12, 2003 at 11:24 PM
#

CREATE TABLE `products_groups` (
  `customers_group_id` int(11) NOT NULL default '0',
  `customers_group_price` decimal(15,4) NOT NULL default '0.0000',
  `products_id` int(11) NOT NULL default '0',
  `products_price` decimal(15,4) NOT NULL default '0.0000'
) TYPE=MyISAM;

#
# Dumping data for table `products_groups`
#

INSERT INTO `products_groups` VALUES (1, '22.0000', 42, '39.9900');
INSERT INTO `products_groups` VALUES (1, '15.0000', 6, '39.9900');

# --------------------------------------------------------

#
# Table structure for table `products_notifications`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `products_notifications` (
  `products_id` int(11) NOT NULL default '0',
  `customers_id` int(11) NOT NULL default '0',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`products_id`,`customers_id`)
) TYPE=MyISAM;

#
# Table structure for table `products_options`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `products_options` (
  `products_options_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `products_options_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`products_options_id`,`language_id`)
) TYPE=MyISAM;


#
# Table structure for table `products_options_values`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `products_options_values` (
  `products_options_values_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `products_options_values_name` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`products_options_values_id`,`language_id`)
) TYPE=MyISAM;

#
# Table structure for table `products_options_values_to_products_options`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `products_options_values_to_products_options` (
  `products_options_values_to_products_options_id` int(11) NOT NULL auto_increment,
  `products_options_id` int(11) NOT NULL default '0',
  `products_options_values_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`products_options_values_to_products_options_id`)
) TYPE=MyISAM AUTO_INCREMENT=14 ;

#
# Table structure for table `products_to_categories`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 07, 2003 at 10:38 PM
#

CREATE TABLE `products_to_categories` (
  `products_id` int(11) NOT NULL default '0',
  `categories_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`products_id`,`categories_id`)
) TYPE=MyISAM;

#
# Table structure for table `products_xsell`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:25 AM
#

CREATE TABLE `products_xsell` (
  `ID` int(10) NOT NULL auto_increment,
  `products_id` int(10) unsigned NOT NULL default '1',
  `xsell_id` int(10) unsigned NOT NULL default '1',
  `sort_order` int(10) unsigned NOT NULL default '1',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM AUTO_INCREMENT=30 ;

#
# Table structure for table `reviews`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 12, 2003 at 09:42 AM
#

CREATE TABLE `reviews` (
  `reviews_id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `customers_id` int(11) default NULL,
  `customers_name` varchar(64) NOT NULL default '',
  `reviews_rating` int(1) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  `reviews_read` int(5) NOT NULL default '0',
  PRIMARY KEY  (`reviews_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Table structure for table `reviews_description`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `reviews_description` (
  `reviews_id` int(11) NOT NULL default '0',
  `languages_id` int(11) NOT NULL default '0',
  `reviews_text` text NOT NULL,
  PRIMARY KEY  (`reviews_id`,`languages_id`)
) TYPE=MyISAM;

#
# Table structure for table `sessions`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `sessions` (
  `sesskey` varchar(32) NOT NULL default '',
  `expiry` int(11) unsigned NOT NULL default '0',
  `value` text NOT NULL,
  PRIMARY KEY  (`sesskey`)
) TYPE=MyISAM;



#
# Table structure for table `specials`
#
# Creation: Sep 12, 2003 at 11:49 AM
# Last update: Sep 12, 2003 at 11:49 AM
#

CREATE TABLE `specials` (
  `specials_id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `specials_new_products_price` decimal(15,4) NOT NULL default '0.0000',
  `specials_date_added` datetime default NULL,
  `specials_last_modified` datetime default NULL,
  `expires_date` datetime default NULL,
  `date_status_change` datetime default NULL,
  `status` int(1) NOT NULL default '1',
  `customers_group_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`specials_id`)
) TYPE=MyISAM AUTO_INCREMENT=5 ;

#
# Table structure for table `tax_class`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `tax_class` (
  `tax_class_id` int(11) NOT NULL auto_increment,
  `tax_class_title` varchar(32) NOT NULL default '',
  `tax_class_description` varchar(255) NOT NULL default '',
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`tax_class_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Dumping data for table `tax_class`
#

INSERT INTO `tax_class` VALUES (1, 'Taxable Goods', 'The following types of products are included non-food, services, etc', '2003-07-17 10:29:23', '2003-07-17 10:29:23');

# --------------------------------------------------------

#
# Table structure for table `tax_rates`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `tax_rates` (
  `tax_rates_id` int(11) NOT NULL auto_increment,
  `tax_zone_id` int(11) NOT NULL default '0',
  `tax_class_id` int(11) NOT NULL default '0',
  `tax_priority` int(5) default '1',
  `tax_rate` decimal(7,4) NOT NULL default '0.0000',
  `tax_description` varchar(255) NOT NULL default '',
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`tax_rates_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Dumping data for table `tax_rates`
#

INSERT INTO `tax_rates` VALUES (1, 1, 1, 1, '7.0000', 'FL TAX 7.0%', '2003-07-17 10:29:23', '2003-07-17 10:29:23');

# --------------------------------------------------------

#
# Table structure for table `whos_online`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Sep 13, 2003 at 01:38 AM
#

CREATE TABLE `whos_online` (
  `customer_id` int(11) default NULL,
  `full_name` varchar(64) NOT NULL default '',
  `session_id` varchar(128) NOT NULL default '',
  `ip_address` varchar(15) NOT NULL default '',
  `time_entry` varchar(14) NOT NULL default '',
  `time_last_click` varchar(14) NOT NULL default '',
  `last_page_url` varchar(64) NOT NULL default ''
) TYPE=MyISAM;

#
# Table structure for table `zones`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `zones` (
  `zone_id` int(11) NOT NULL auto_increment,
  `zone_country_id` int(11) NOT NULL default '0',
  `zone_code` varchar(32) NOT NULL default '',
  `zone_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`zone_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Dumping data for table `zones`
#

INSERT INTO `zones` VALUES (1, 223, 'AL', 'Alabama');
INSERT INTO `zones` VALUES (2, 223, 'AK', 'Alaska');
INSERT INTO `zones` VALUES (3, 223, 'AS', 'American Samoa');
INSERT INTO `zones` VALUES (4, 223, 'AZ', 'Arizona');
INSERT INTO `zones` VALUES (5, 223, 'AR', 'Arkansas');
INSERT INTO `zones` VALUES (6, 223, 'AF', 'Armed Forces Africa');
INSERT INTO `zones` VALUES (7, 223, 'AA', 'Armed Forces Americas');
INSERT INTO `zones` VALUES (8, 223, 'AC', 'Armed Forces Canada');
INSERT INTO `zones` VALUES (9, 223, 'AE', 'Armed Forces Europe');
INSERT INTO `zones` VALUES (10, 223, 'AM', 'Armed Forces Middle East');
INSERT INTO `zones` VALUES (11, 223, 'AP', 'Armed Forces Pacific');
INSERT INTO `zones` VALUES (12, 223, 'CA', 'California');
INSERT INTO `zones` VALUES (13, 223, 'CO', 'Colorado');
INSERT INTO `zones` VALUES (14, 223, 'CT', 'Connecticut');
INSERT INTO `zones` VALUES (15, 223, 'DE', 'Delaware');
INSERT INTO `zones` VALUES (16, 223, 'DC', 'District of Columbia');
INSERT INTO `zones` VALUES (17, 223, 'FM', 'Federated States Of Micronesia');
INSERT INTO `zones` VALUES (18, 223, 'FL', 'Florida');
INSERT INTO `zones` VALUES (19, 223, 'GA', 'Georgia');
INSERT INTO `zones` VALUES (20, 223, 'GU', 'Guam');
INSERT INTO `zones` VALUES (21, 223, 'HI', 'Hawaii');
INSERT INTO `zones` VALUES (22, 223, 'ID', 'Idaho');
INSERT INTO `zones` VALUES (23, 223, 'IL', 'Illinois');
INSERT INTO `zones` VALUES (24, 223, 'IN', 'Indiana');
INSERT INTO `zones` VALUES (25, 223, 'IA', 'Iowa');
INSERT INTO `zones` VALUES (26, 223, 'KS', 'Kansas');
INSERT INTO `zones` VALUES (27, 223, 'KY', 'Kentucky');
INSERT INTO `zones` VALUES (28, 223, 'LA', 'Louisiana');
INSERT INTO `zones` VALUES (29, 223, 'ME', 'Maine');
INSERT INTO `zones` VALUES (30, 223, 'MH', 'Marshall Islands');
INSERT INTO `zones` VALUES (31, 223, 'MD', 'Maryland');
INSERT INTO `zones` VALUES (32, 223, 'MA', 'Massachusetts');
INSERT INTO `zones` VALUES (33, 223, 'MI', 'Michigan');
INSERT INTO `zones` VALUES (34, 223, 'MN', 'Minnesota');
INSERT INTO `zones` VALUES (35, 223, 'MS', 'Mississippi');
INSERT INTO `zones` VALUES (36, 223, 'MO', 'Missouri');
INSERT INTO `zones` VALUES (37, 223, 'MT', 'Montana');
INSERT INTO `zones` VALUES (38, 223, 'NE', 'Nebraska');
INSERT INTO `zones` VALUES (39, 223, 'NV', 'Nevada');
INSERT INTO `zones` VALUES (40, 223, 'NH', 'New Hampshire');
INSERT INTO `zones` VALUES (41, 223, 'NJ', 'New Jersey');
INSERT INTO `zones` VALUES (42, 223, 'NM', 'New Mexico');
INSERT INTO `zones` VALUES (43, 223, 'NY', 'New York');
INSERT INTO `zones` VALUES (44, 223, 'NC', 'North Carolina');
INSERT INTO `zones` VALUES (45, 223, 'ND', 'North Dakota');
INSERT INTO `zones` VALUES (46, 223, 'MP', 'Northern Mariana Islands');
INSERT INTO `zones` VALUES (47, 223, 'OH', 'Ohio');
INSERT INTO `zones` VALUES (48, 223, 'OK', 'Oklahoma');
INSERT INTO `zones` VALUES (49, 223, 'OR', 'Oregon');
INSERT INTO `zones` VALUES (50, 223, 'PW', 'Palau');
INSERT INTO `zones` VALUES (51, 223, 'PA', 'Pennsylvania');
INSERT INTO `zones` VALUES (52, 223, 'PR', 'Puerto Rico');
INSERT INTO `zones` VALUES (53, 223, 'RI', 'Rhode Island');
INSERT INTO `zones` VALUES (54, 223, 'SC', 'South Carolina');
INSERT INTO `zones` VALUES (55, 223, 'SD', 'South Dakota');
INSERT INTO `zones` VALUES (56, 223, 'TN', 'Tennessee');
INSERT INTO `zones` VALUES (57, 223, 'TX', 'Texas');
INSERT INTO `zones` VALUES (58, 223, 'UT', 'Utah');
INSERT INTO `zones` VALUES (59, 223, 'VT', 'Vermont');
INSERT INTO `zones` VALUES (60, 223, 'VI', 'Virgin Islands');
INSERT INTO `zones` VALUES (61, 223, 'VA', 'Virginia');
INSERT INTO `zones` VALUES (62, 223, 'WA', 'Washington');
INSERT INTO `zones` VALUES (63, 223, 'WV', 'West Virginia');
INSERT INTO `zones` VALUES (64, 223, 'WI', 'Wisconsin');
INSERT INTO `zones` VALUES (65, 223, 'WY', 'Wyoming');
INSERT INTO `zones` VALUES (66, 38, 'AB', 'Alberta');
INSERT INTO `zones` VALUES (67, 38, 'BC', 'British Columbia');
INSERT INTO `zones` VALUES (68, 38, 'MB', 'Manitoba');
INSERT INTO `zones` VALUES (69, 38, 'NF', 'Newfoundland');
INSERT INTO `zones` VALUES (70, 38, 'NB', 'New Brunswick');
INSERT INTO `zones` VALUES (71, 38, 'NS', 'Nova Scotia');
INSERT INTO `zones` VALUES (72, 38, 'NT', 'Northwest Territories');
INSERT INTO `zones` VALUES (73, 38, 'NU', 'Nunavut');
INSERT INTO `zones` VALUES (74, 38, 'ON', 'Ontario');
INSERT INTO `zones` VALUES (75, 38, 'PE', 'Prince Edward Island');
INSERT INTO `zones` VALUES (76, 38, 'QC', 'Quebec');
INSERT INTO `zones` VALUES (77, 38, 'SK', 'Saskatchewan');
INSERT INTO `zones` VALUES (78, 38, 'YT', 'Yukon Territory');
INSERT INTO `zones` VALUES (79, 81, 'NDS', 'Niedersachsen');
INSERT INTO `zones` VALUES (80, 81, 'BAW', 'Baden-Württemberg');
INSERT INTO `zones` VALUES (81, 81, 'BAY', 'Bayern');
INSERT INTO `zones` VALUES (82, 81, 'BER', 'Berlin');
INSERT INTO `zones` VALUES (83, 81, 'BRG', 'Brandenburg');
INSERT INTO `zones` VALUES (84, 81, 'BRE', 'Bremen');
INSERT INTO `zones` VALUES (85, 81, 'HAM', 'Hamburg');
INSERT INTO `zones` VALUES (86, 81, 'HES', 'Hessen');
INSERT INTO `zones` VALUES (87, 81, 'MEC', 'Mecklenburg-Vorpommern');
INSERT INTO `zones` VALUES (88, 81, 'NRW', 'Nordrhein-Westfalen');
INSERT INTO `zones` VALUES (89, 81, 'RHE', 'Rheinland-Pfalz');
INSERT INTO `zones` VALUES (90, 81, 'SAR', 'Saarland');
INSERT INTO `zones` VALUES (91, 81, 'SAS', 'Sachsen');
INSERT INTO `zones` VALUES (92, 81, 'SAC', 'Sachsen-Anhalt');
INSERT INTO `zones` VALUES (93, 81, 'SCN', 'Schleswig-Holstein');
INSERT INTO `zones` VALUES (94, 81, 'THE', 'Thüringen');
INSERT INTO `zones` VALUES (95, 14, 'WI', 'Wien');
INSERT INTO `zones` VALUES (96, 14, 'NO', 'Niederösterreich');
INSERT INTO `zones` VALUES (97, 14, 'OO', 'Oberösterreich');
INSERT INTO `zones` VALUES (98, 14, 'SB', 'Salzburg');
INSERT INTO `zones` VALUES (99, 14, 'KN', 'Kärnten');
INSERT INTO `zones` VALUES (100, 14, 'ST', 'Steiermark');
INSERT INTO `zones` VALUES (101, 14, 'TI', 'Tirol');
INSERT INTO `zones` VALUES (102, 14, 'BL', 'Burgenland');
INSERT INTO `zones` VALUES (103, 14, 'VB', 'Voralberg');
INSERT INTO `zones` VALUES (104, 204, 'AG', 'Aargau');
INSERT INTO `zones` VALUES (105, 204, 'AI', 'Appenzell Innerrhoden');
INSERT INTO `zones` VALUES (106, 204, 'AR', 'Appenzell Ausserrhoden');
INSERT INTO `zones` VALUES (107, 204, 'BE', 'Bern');
INSERT INTO `zones` VALUES (108, 204, 'BL', 'Basel-Landschaft');
INSERT INTO `zones` VALUES (109, 204, 'BS', 'Basel-Stadt');
INSERT INTO `zones` VALUES (110, 204, 'FR', 'Freiburg');
INSERT INTO `zones` VALUES (111, 204, 'GE', 'Genf');
INSERT INTO `zones` VALUES (112, 204, 'GL', 'Glarus');
INSERT INTO `zones` VALUES (113, 204, 'JU', 'Graubünden');
INSERT INTO `zones` VALUES (114, 204, 'JU', 'Jura');
INSERT INTO `zones` VALUES (115, 204, 'LU', 'Luzern');
INSERT INTO `zones` VALUES (116, 204, 'NE', 'Neuenburg');
INSERT INTO `zones` VALUES (117, 204, 'NW', 'Nidwalden');
INSERT INTO `zones` VALUES (118, 204, 'OW', 'Obwalden');
INSERT INTO `zones` VALUES (119, 204, 'SG', 'St. Gallen');
INSERT INTO `zones` VALUES (120, 204, 'SH', 'Schaffhausen');
INSERT INTO `zones` VALUES (121, 204, 'SO', 'Solothurn');
INSERT INTO `zones` VALUES (122, 204, 'SZ', 'Schwyz');
INSERT INTO `zones` VALUES (123, 204, 'TG', 'Thurgau');
INSERT INTO `zones` VALUES (124, 204, 'TI', 'Tessin');
INSERT INTO `zones` VALUES (125, 204, 'UR', 'Uri');
INSERT INTO `zones` VALUES (126, 204, 'VD', 'Waadt');
INSERT INTO `zones` VALUES (127, 204, 'VS', 'Wallis');
INSERT INTO `zones` VALUES (128, 204, 'ZG', 'Zug');
INSERT INTO `zones` VALUES (129, 204, 'ZH', 'Zürich');
INSERT INTO `zones` VALUES (130, 195, 'A Coruña', 'A Coruña');
INSERT INTO `zones` VALUES (131, 195, 'Alava', 'Alava');
INSERT INTO `zones` VALUES (132, 195, 'Albacete', 'Albacete');
INSERT INTO `zones` VALUES (133, 195, 'Alicante', 'Alicante');
INSERT INTO `zones` VALUES (134, 195, 'Almeria', 'Almeria');
INSERT INTO `zones` VALUES (135, 195, 'Asturias', 'Asturias');
INSERT INTO `zones` VALUES (136, 195, 'Avila', 'Avila');
INSERT INTO `zones` VALUES (137, 195, 'Badajoz', 'Badajoz');
INSERT INTO `zones` VALUES (138, 195, 'Baleares', 'Baleares');
INSERT INTO `zones` VALUES (139, 195, 'Barcelona', 'Barcelona');
INSERT INTO `zones` VALUES (140, 195, 'Burgos', 'Burgos');
INSERT INTO `zones` VALUES (141, 195, 'Caceres', 'Caceres');
INSERT INTO `zones` VALUES (142, 195, 'Cadiz', 'Cadiz');
INSERT INTO `zones` VALUES (143, 195, 'Cantabria', 'Cantabria');
INSERT INTO `zones` VALUES (144, 195, 'Castellon', 'Castellon');
INSERT INTO `zones` VALUES (145, 195, 'Ceuta', 'Ceuta');
INSERT INTO `zones` VALUES (146, 195, 'Ciudad Real', 'Ciudad Real');
INSERT INTO `zones` VALUES (147, 195, 'Cordoba', 'Cordoba');
INSERT INTO `zones` VALUES (148, 195, 'Cuenca', 'Cuenca');
INSERT INTO `zones` VALUES (149, 195, 'Girona', 'Girona');
INSERT INTO `zones` VALUES (150, 195, 'Granada', 'Granada');
INSERT INTO `zones` VALUES (151, 195, 'Guadalajara', 'Guadalajara');
INSERT INTO `zones` VALUES (152, 195, 'Guipuzcoa', 'Guipuzcoa');
INSERT INTO `zones` VALUES (153, 195, 'Huelva', 'Huelva');
INSERT INTO `zones` VALUES (154, 195, 'Huesca', 'Huesca');
INSERT INTO `zones` VALUES (155, 195, 'Jaen', 'Jaen');
INSERT INTO `zones` VALUES (156, 195, 'La Rioja', 'La Rioja');
INSERT INTO `zones` VALUES (157, 195, 'Las Palmas', 'Las Palmas');
INSERT INTO `zones` VALUES (158, 195, 'Leon', 'Leon');
INSERT INTO `zones` VALUES (159, 195, 'Lleida', 'Lleida');
INSERT INTO `zones` VALUES (160, 195, 'Lugo', 'Lugo');
INSERT INTO `zones` VALUES (161, 195, 'Madrid', 'Madrid');
INSERT INTO `zones` VALUES (162, 195, 'Malaga', 'Malaga');
INSERT INTO `zones` VALUES (163, 195, 'Melilla', 'Melilla');
INSERT INTO `zones` VALUES (164, 195, 'Murcia', 'Murcia');
INSERT INTO `zones` VALUES (165, 195, 'Navarra', 'Navarra');
INSERT INTO `zones` VALUES (166, 195, 'Ourense', 'Ourense');
INSERT INTO `zones` VALUES (167, 195, 'Palencia', 'Palencia');
INSERT INTO `zones` VALUES (168, 195, 'Pontevedra', 'Pontevedra');
INSERT INTO `zones` VALUES (169, 195, 'Salamanca', 'Salamanca');
INSERT INTO `zones` VALUES (170, 195, 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife');
INSERT INTO `zones` VALUES (171, 195, 'Segovia', 'Segovia');
INSERT INTO `zones` VALUES (172, 195, 'Sevilla', 'Sevilla');
INSERT INTO `zones` VALUES (173, 195, 'Soria', 'Soria');
INSERT INTO `zones` VALUES (174, 195, 'Tarragona', 'Tarragona');
INSERT INTO `zones` VALUES (175, 195, 'Teruel', 'Teruel');
INSERT INTO `zones` VALUES (176, 195, 'Toledo', 'Toledo');
INSERT INTO `zones` VALUES (177, 195, 'Valencia', 'Valencia');
INSERT INTO `zones` VALUES (178, 195, 'Valladolid', 'Valladolid');
INSERT INTO `zones` VALUES (179, 195, 'Vizcaya', 'Vizcaya');
INSERT INTO `zones` VALUES (180, 195, 'Zamora', 'Zamora');
INSERT INTO `zones` VALUES (181, 195, 'Zaragoza', 'Zaragoza');

# --------------------------------------------------------

#
# Table structure for table `zones_to_geo_zones`
#
# Creation: Aug 11, 2003 at 11:43 PM
# Last update: Aug 11, 2003 at 11:43 PM
#

CREATE TABLE `zones_to_geo_zones` (
  `association_id` int(11) NOT NULL auto_increment,
  `zone_country_id` int(11) NOT NULL default '0',
  `zone_id` int(11) default NULL,
  `geo_zone_id` int(11) default NULL,
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`association_id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

#
# Dumping data for table `zones_to_geo_zones`
#

INSERT INTO `zones_to_geo_zones` VALUES (1, 223, 18, 1, NULL, '2003-07-17 10:29:23');

# Table structure for table `ls_conversations`
#

CREATE TABLE ls_conversations (
  id int(11) NOT NULL auto_increment,
  guest varchar(255) NOT NULL default '',
  tech varchar(255) NOT NULL default '',
  session_id varchar(255) NOT NULL default '',
  message varchar(255) NOT NULL default '',
  tech_reply tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

#
# Dumping data for table `ls_conversations`
#

# --------------------------------------------------------

#
# Table structure for table `ls_techs`
#

CREATE TABLE ls_techs (
  tech_id int(11) NOT NULL auto_increment,
  support_tech varchar(20) NOT NULL default '',
  password varchar(25) NOT NULL default '',
  support_group varchar(255) NOT NULL default '',
  status varchar(10) default NULL,
  helping varchar(255) NOT NULL default '',
  PRIMARY KEY  (tech_id),
  UNIQUE KEY yech_id (tech_id)
) TYPE=MyISAM;

#
# Dumping data for table `ls_techs`
#

INSERT INTO ls_techs VALUES (1, 'Sales', '', 'Sales', 'no', '');

CREATE TABLE ls_status (
  id int(255) NOT NULL auto_increment, 
  session_id varchar(255) NOT NULL default '', 
  status tinyint(1) NOT NULL default '1', 
  PRIMARY KEY (id) 
) TYPE=MyISAM; 
