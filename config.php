<?php
session_start();

# MySql Bilgileri
define("db_host","localhost");
define("db_user","root");
define("db_pass","root");
define("db_name","istakip");

# Title bilgileri
define("admin_title","<strong>İşGüç</strong>Takip v1.1");
define("admin_login_title","<strong>İşGüç</strong>Takip v1.1");

# Yönetim Paneli Üst Menü Linkleri
$top_menu_links = array(
	"home" => array("title"=>"Başlangıç", "link"=>"home.home", "icon"=>"fa-dashboard"),
	"musteriler" => array("title"=>"Müşteri Takibi", "link"=>"musteriler.list", "icon"=>"fa-users"),
	"projeler" => array("title"=>"Proje Takibi", "link"=>"musteriler.projeler", "icon"=>"fa-archive"),
	"odemeler" => array("title"=>"Ödeme Takibi", "link"=>"musteriler.odemeler", "icon"=>"fa-dollar"),
	"stats" => array("title"=>"İstatistikler", "link"=>"home.stats", "icon"=>"fa-info-circle"),
	"admins" => array("title"=>"Kullanıcılar", "link"=>"admins.list", "icon"=>"fa-user"),
	// "admins_groups" => array("title"=>"Yönetici Grupları", "link"=>"admins_groups.list", "icon"=>"fa-unlock-alt"),
	// "database_backups" => array("title"=>"Veritabanı Yedek İşlemleri", "link"=>"database_backups.list", "icon"=>"fa-database"),
	// "general" => array("title"=>"Site Genel Ayarlar", "link"=>"general.general&map=1", "icon"=>"fa-gear")
);

$client_top_menu_links = array(
	"home" => array("title"=>"Başlangıç", "link"=>"musteriler.home", "icon"=>"fa-dashboard"),
	"projeler" => array("title"=>"Proje Takibi", "link"=>"musteriler.projeler", "icon"=>"fa-archive"),
	"odemeler" => array("title"=>"Ödeme Takibi", "link"=>"musteriler.odemeler", "icon"=>"fa-dollar"),
	// "admins_groups" => array("title"=>"Yönetici Grupları", "link"=>"admins_groups.list", "icon"=>"fa-unlock-alt"),
	// "database_backups" => array("title"=>"Veritabanı Yedek İşlemleri", "link"=>"database_backups.list", "icon"=>"fa-database"),
	// "general" => array("title"=>"Site Genel Ayarlar", "link"=>"general.general&map=1", "icon"=>"fa-gear")
);

# Yönetim Paneli Sol Menü Linkleri 
$menu_links = array(
	"home" => array("title"=>"Başlangıç", "link"=>"home.home", "icon"=>"fa-dashboard"),
);

# Yönetim Paneli İzin Ayarları
$permissions_modules = array(
	/* Standart Modüller */
	"admins_groups" => array(
		"title" => "Yönetici Grupları",
		"permissions" => array("list","add","edit","delete"),
		"permissions_descs" => array("Liste","Oluşturma","Düzenleme","Silme")
	),
	"admins" => array(
		"title" => "Yöneticiler",
		"permissions" => array("list","add","edit","delete"),
		"permissions_descs" => array("Liste","Oluşturma","Düzenleme","Silme")
	),
	"database_backups" => array(
		"title" => "Database Yedekleri",
		"permissions" => array("list","add","delete"),
		"permissions_descs" => array("Liste","Oluşturma","Silme")
	)
	/* Standart Modüller */
);

/* Sabit Diziler */
$proje_durum = array(
	0 => '<span class="text-primary">Yapım Aşamasında</span>',
	1 => '<span class="text-success">Tamamlandı</span>'
);

$odeme_durum = array(
	0 => '<span class="text-danger">Ödeme Bekleniyor</span>',
	1 => '<span class="text-success">Tamamlandı</span>'
);

?>