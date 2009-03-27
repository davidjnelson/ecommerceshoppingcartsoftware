function init()
{
	//Main Menu items:
	menus[0] = new menu(22, "horizontal", 2, 2, -2, -2, "#87cefa", "#000000", "Verdana,Helvetica", 7, 
		"bold", "bold", "black", "white", 1, "gray", 2, "rollover:tridown.gif:tridown.gif", false, true, true, false, 0, true, 4, 4, "black");
	menus[0].addItem("#", 135, "center", "Configuration", 1);
	menus[0].addItem("#", 115, "center", "Catalog", 2);
	menus[0].addItem("#", 115, "center", "Affiliates", 3);
	menus[0].addItem("#", 115, "center", "Locations/Taxes", 4);
	//menus[0].addItem("#", 135, "center", "Vouchers/Coupons", 5);
	menus[0].addItem("#", 120, "center", "Reports", 6);
	menus[0].addItem("#", 125, "center", "Tools", 7);
	menus[0].addItem("#", 110, "center", "Advanced", 8);


	// configuration
	menus[1] = new menu(160, "vertical", 0, 0, -5, -5, "#87cefa", "#000000", "Verdana,Helvetica", 7, "bold", 
		"bold", "black", "white", 1, "gray", 2, 62, false, true, false, true, 6, true, 4, 4, "black");
	menus[1].addItem("configuration.php?gID=1", 22, "left", "My Store", 0);
	menus[1].addItem("admin_members.php", 22, "left", "Admin Permissions", 0);
	menus[1].addItem("configuration.php?gID=7", 22, "left", "Shipping/Packaging", 0);
	menus[1].addItem("configuration.php?gID=9", 22, "left", "Stock", 0);
	menus[1].addItem("configuration.php?gID=13", 22, "left", "Download", 0);
	menus[1].addItem("modules.php?set=shipping", 22, "left", "Shipping Choices", 0);
	menus[1].addItem("modules.php?set=payment", 22, "left", "Payment Processors", 0);
	menus[1].addItem("configuration.php?gID=16", 22, "left", "Site Maintenance", 0);
	menus[1].addItem("edit_header.php", 22, "left", "Edit Header", 0);
	menus[1].addItem("edit_footer.php?action=view", 22, "left", "Edit Footer", 0);
	menus[1].addItem("ssl_security.php", 22, "left", "SSL Security", 0);
	menus[1].addItem("store_info_pages.php", 22, "left", "Store Info Pages", 0);
	menus[1].addItem("edit_color_scheme.php", 22, "left", "Edit Color Scheme", 0);
	
	// catalog
	menus[2] = new menu(125, "vertical", 0, 0, 0, 0, "#87cefa", "#000000", "Verdana,Helvetica", 7, "bold", 
		"bold", "black", "white", 1, "gray", 2, "rollover:tri.gif:tri.gif", false, true, false, false, 0, true, 4, 4, "black");
	menus[2].addItem("categories.php", 22, "left", "Categories/Products", 0);
	menus[2].addItem("products_attributes.php", 22, "left", "Product Attributes", 0);
	menus[2].addItem("manufacturers.php", 22, "left", "Manufacturers", 0);
	menus[2].addItem("reviews.php", 22, "left", "Reviews", 0);
	menus[2].addItem("specials.php", 22, "left", "Specials", 0);
	menus[2].addItem("xsell_products.php", 22, "left", "Cross Sell Products", 0);
	menus[2].addItem("easypopulate.php", 22, "left", "Database Import", 0);
	menus[2].addItem("define_mainpage.php", 22, "left", "Homepage Text", 0);
	menus[2].addItem("new_attributes.php", 22, "left", "Attribute Manager", 0);
	menus[2].addItem("products_expected.php", 22, "left", "Products Expected", 0);

	// affiliates
	menus[3] = new menu(125, "vertical", 0, 0, 0, 0, "#87cefa", "#000000", "Verdana,Helvetica", 7, "bold", "bold", "black", "white", 1, "gray", 2, ">>", false, true, false, false, 0, true, 4, 4, "black");
	menus[3].addItem("affiliate_enable_disable.php", 22, "left", "Enable/Disable", 0);
	menus[3].addItem("configuration.php?gID=900", 22, "left", "Settings", 0);
	menus[3].addItem("affiliate_summary.php", 22, "left", "Affiliate Summary", 0);
	menus[3].addItem("affiliate_affiliates.php", 22, "left", "List Affiliates", 0);
	menus[3].addItem("affiliate_payment.php", 22, "left", "Payment", 0);
	menus[3].addItem("affiliate_sales.php", 22, "left", "Sales", 0);
	menus[3].addItem("affiliate_banners.php", 22, "left", "Banners", 0);
	menus[3].addItem("affiliate_contact.php", 22, "left", "Contact", 0);
	menus[3].addItem("affiliate_edit_terms.php", 22, "left", "Edit Terms", 0);
	menus[3].addItem("affiliate_edit_info.php", 22, "left", "Edit Info Page", 0);
	
	// locations /taxes
	menus[4] = new menu(130, "vertical", 0, 0, 0, 0, "#87cefa", "#000000", "Verdana,Helvetica", 7, "bold", "bold", "black", "white", 1, "gray", 2, ">>", false, true, false, false, 0, true, 4, 4, "black");
	menus[4].addItem("countries.php", 22, "left", "Countries", 0);
	menus[4].addItem("zones.php", 22, "left", "Zones", 0);
	menus[4].addItem("geo_zones.php", 22, "left", "Tax Zones", 0);
	menus[4].addItem("tax_classes.php", 22, "left", "Tax Classes", 0);
	menus[4].addItem("tax_rates.php", 22, "left", "Tax Rates", 0);
	menus[4].addItem("currencies.php", 22, "left", "Currencies", 0);
	menus[4].addItem("orders_status.php", 22, "left", "Orders Status", 0);
	
	// coupons/vouchers
	menus[5] = new menu(145, "vertical", 0, 0, 0, 0, "#87cefa", "#000000", "Verdana,Helvetica", 7, "bold", "bold", "black", "white", 1, "gray", 2, ">>", false, true, false, false, 0, true, 4, 4, "black");
	//menus[5].addItem("coupon_admin.php", 22, "left", "Coupon Admin", 0);
	//menus[5].addItem("gv_queue.php", 22, "left", "Gift Voucher Queue", 0);
	//menus[5].addItem("gv_mail.php", 22, "left", "Mail Gift Voucher", 0);
	//menus[5].addItem("gv_sent.php", 22, "left", "Gift Vouchers Sent", 0);
	
	
	// reports
	menus[6] = new menu(130, "vertical", 0, 0, 0, 0, "#87cefa", "#000000", "Verdana,Helvetica", 7, "bold", "bold", "black", "white", 1, "gray", 2, ">>", false, true, false, false, 0, true, 4, 4, "black");
	menus[6].addItem("customers.php", 22, "left", "Customers", 0);
	menus[6].addItem("orders.php", 22, "left", "Orders", 0);
	menus[6].addItem("stats_products_viewed.php", 22, "left", "Products Viewed", 0);
	menus[6].addItem("stats_products_purchased.php", 22, "left", "Products Purchased", 0);
	menus[6].addItem("stats_customers.php", 22, "left", "Customer Orders", 0);
	menus[6].addItem("paypalipn_txn.php?action=view", 22, "left", "Paypal IPN", 0);
	
	// tools
	menus[7] = new menu(135, "vertical", 0, 0, 0, 0, "#87cefa", "#000000", "Verdana,Helvetica", 7, "bold", "bold", "black", "white", 1, "gray", 2, ">>", false, true, false, false, 0, true, 4, 4, "black");
	menus[7].addItem("backup.php", 22, "left", "Database Backup", 0);
	menus[7].addItem("banner_manager.php", 22, "left", "Banner Manager", 0);
	menus[7].addItem("mail.php", 22, "left", "Send Email", 0);
	menus[7].addItem("newsletters.php", 22, "left", "Newsletter Manager", 0);
	menus[7].addItem("server_info.php", 22, "left", "Server Info", 0);
	menus[7].addItem("whos_online.php", 22, "left", "Who's Online", 0);
	menus[7].addItem("http://www.ecommerceshoppingcartsoftware.org", 22, "left", "Support Site", 0);
	menus[7].addItem("../index.php", 22, "left", "Your Store", 0);
	menus[7].addItem("live_support.php", 22, "left", "Live Support", 0);
	menus[7].addItem("stats_ad_results.php", 22, "left", "Ad Tracker Results", 0);
	menus[7].addItem("marketing_tutorial.php", 22, "left", "Marketing Tutorial", 0);
	menus[7].addItem("paypalipn_tests.php?action=view", 22, "left", "Paypal IPN Test", 0);
	menus[7].addItem("logoff.php", 22, "left", "Log Out Of Admin", 0);
	
	// advanced
	menus[8] = new menu(130, "vertical", 0, 0, 0, 0, "#87cefa", "#000000", "Verdana,Helvetica", 7, "bold", 
		"bold", "black", "white", 1, "gray", 2, ">>", false, true, false, false, 0, true, 4, 4, "black");
	//menus[8].addItem("cache.php", 22, "left", "Cache Control", 0);
	//menus[8].addItem("file_manager.php", 22, "left", "File Manager", 0);
	menus[8].addItem("configuration.php?gID=2", 22, "left", "Minimum Values", 0);
	menus[8].addItem("configuration.php?gID=3", 22, "left", "Maximum Values", 0);
	menus[8].addItem("configuration.php?gID=4", 22, "left", "Images", 0);
	menus[8].addItem("configuration.php?gID=5", 22, "left", "Customer Details", 0);
	menus[8].addItem("configuration.php?gID=8", 22, "left", "Product Listing", 0);
	menus[8].addItem("configuration.php?gID=899", 22, "left", "Printable Catalog", 0);
	menus[8].addItem("configuration.php?gID=10", 22, "left", "Logging", 0);
	menus[8].addItem("configuration.php?gID=11", 22, "left", "Cache", 0);
	menus[8].addItem("configuration.php?gID=12", 22, "left", "Email Options", 0);
	menus[8].addItem("configuration.php?gID=14", 22, "left", "Gzip Compression", 0);
	menus[8].addItem("configuration.php?gID=15", 22, "left", "Sessions", 0);
	menus[8].addItem("modules.php?set=ordertotal", 22, "left", "Order Total", 0);
	//menus[8].addItem("configuration.php?gID=112", 22, "left", "WYSIWYG Editor", 0);
	//menus[8].addItem("configuration.php?gID=99", 22, "left", "Dynamic Mopics", 0);
	menus[8].addItem("dbanalyze.php", 22, "left", "Analyze Database", 0);
	menus[8].addItem("dbcheck.php", 22, "left", "Check Database", 0);
	menus[8].addItem("dboptimize.php", 22, "left", "Optimize Database", 0);
	menus[8].addItem("dbrepair.php", 22, "left", "Repair Database", 0);
	menus[8].addItem("dbstatus.php", 22, "left", "Database Status", 0);	
	

} //OUTER CLOSING BRACKET. EVERYTHING ADDED MUST BE ABOVE THIS LINE.