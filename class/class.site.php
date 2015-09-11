<?php
class site extends core {
	
	function __construct(){
	}
	
	function __destruct(){
	}
		
	function musteri_online(){
		$username = $_SESSION["client_username"];
		$password = $_SESSION["client_password"];
		$id = $_SESSION["client_id"];
		if($username!="" && $password!=""){
			$query = mysql_query("SELECT kullanici_adi,sifre,id FROM musteriler WHERE kullanici_adi='".$username."' AND sifre='".$password."' AND id='".$id."'");
			$count = mysql_num_rows($query);
			if($count==1){
				return true;
			}else return false;
		}else return false;
	}

    function istatistik_olustur($date1,$date2=""){
        $date2 = date('Y-m-d',strtotime($date1." first day of next month"));

        // echo $date1." ----------- ";
        // echo $date2;

        $date1ex = explode("-",$date1);
        $date2ex = explode("-",$date2);

        $query1 = $this->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE baslangic_tarih>='".$date1."' AND baslangic_tarih<'".$date2."'");
        $query2 = $this->get_data("SELECT ROUND(SUM(fiyat), 2) AS toplam_fiyat FROM projeler WHERE bitis_tarih>='".$date1."' AND bitis_tarih<'".$date2."'");
        $query3 = $this->get_data("SELECT ROUND(SUM(tutar), 2) AS toplam_fiyat FROM odemeler WHERE odeme_tarihi>='".$date1."' AND odeme_tarihi<'".$date2."'");

        $total["yil"] = $date1ex[0];
        $total["ay"] = $date1ex[1];
        $total["ay_yil"] = $date1;
        $total["baslanan_proje"] = mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE baslangic_tarih>='".$date1."' AND baslangic_tarih<'".$date2."'"));
        $total["biten_proje"] = mysql_num_rows(mysql_query("SELECT id FROM projeler WHERE bitis_tarih>='".$date1."' AND bitis_tarih<'".$date2."'"));
        $total["baslanan_proje_toplam_fiyat"] = number_format($query1["toplam_fiyat"],2);
        $total["biten_proje_toplam_fiyat"] = number_format($query2["toplam_fiyat"],2);
        $total["toplam_odenen_fiyat"] = number_format($query3["toplam_fiyat"],2);

        // $this->line_print($total);

        $data = $this->get_row("istatistikler","*","WHERE yil='".$total["yil"]."' AND ay='".$total["ay"]."'");
        if($data) $this->quick_edit("istatistikler","WHERE yil='".$total["yil"]."' AND ay='".$total["ay"]."'",$total,"İstatistikler güncellendi.","İstatistikler güncellenemedi.");
        else $this->quick_add("istatistikler",$total,"İstatistikler güncellendi.","İstatistikler güncellenemedi.");

        // echo 'İstatistik oluşturuldu.';
    }
	
}



class site_pager {

    var $total_records = NULL;
    var $start = NULL;
    var $scroll_page = NULL;
    var $per_page = NULL;
    var $total_pages = NULL;
    var $current_page = NULL;
    var $page_links = NULL;

    function total_pages($pager_url, $total_records, $scroll_page, $per_page, $current_page){
        $this->url = $pager_url;
        $this->total_records = $total_records;
        $this->scroll_page = $scroll_page;
        $this->per_page = $per_page;
        if(!is_numeric($current_page)){
            $this->current_page = 1;
        }else{
            $this->current_page = $current_page;
        }
        if($this->current_page == 1) $this->start = 0; else $this->start =($this->current_page - 1) * $this->per_page;
        $this->total_pages = ceil($this->total_records / $this->per_page);
    }

    function page_links($inactive_page_tag, $pager_url_last){
        if($this->total_pages <= $this->scroll_page){
            if($this->total_records <= $this->per_page){
                $loop_start = 1;
                $loop_finish = $this->total_pages;
            }else{
                $loop_start = 1;
                $loop_finish = $this->total_pages;
            }
        }else{
            if($this->current_page < intval($this->scroll_page / 2) + 1){
                $loop_start = 1;
                $loop_finish = $this->scroll_page;
            }else{
                $loop_start = $this->current_page - intval($this->scroll_page / 2);
                $loop_finish = $this->current_page + intval($this->scroll_page / 2);
                if($loop_finish > $this->total_pages) $loop_finish = $this->total_pages;
            }
        }
        for($i = $loop_start; $i <= $loop_finish; $i++){
            if($i == $this->current_page){
                $this->page_links .= '<a href="#" class="page active">'.$i.'</a>';
            }else{
                $this->page_links .= '<a href="'.$this->url.$i.$pager_url_last.'" class="page">'.$i.'</a>';
            }
        }
    }

    function previous_page($previous_page_text, $pager_url_last){
        if($this->current_page > 1){
            $this->previous_page = '<a href="'.$this->url.($this->current_page - 1).$pager_url_last.'" class="prev">'.$previous_page_text.'</a>';
        }else{
            $this->previous_page = '<a href="#" class="prev">'.$previous_page_text.'</a>';			
		}
    }

    function next_page($next_page_text, $pager_url_last){
        if($this->current_page < $this->total_pages){
            $this->next_page = '<a href="'.$this->url.($this->current_page + 1).$pager_url_last.'" class="next">'.$next_page_text.'</a>';
        }else{
            $this->next_page = '<a href="#" class="next">'.$next_page_text.'</a>';
		}
    }

    function first_page($first_page_text, $pager_url_last){
        if($this->current_page > 1){
            $this->first_page = '<li><a href="'.$this->url.'1'.$pager_url_last.'">'.$first_page_text.'</a></li>'; // :)
        }
    }

    function last_page($last_page_text, $pager_url_last){
        if($this->current_page < $this->total_pages){
            $this->last_page = '<li><a href="'.$this->url.$this->total_pages.$pager_url_last.'">'.$last_page_text.'</a></li>';
        }
    }

    function pager_set($pager_url, $total_records, $scroll_page, $per_page, $current_page, $inactive_page_tag, $previous_page_text, $next_page_text, $first_page_text, $last_page_text, $pager_url_last){
        $this->total_pages($pager_url, $total_records, $scroll_page, $per_page, $current_page);
        $this->page_links($inactive_page_tag, $pager_url_last);
        $this->previous_page($previous_page_text, $pager_url_last);
        $this->next_page($next_page_text, $pager_url_last);
        $this->first_page($first_page_text, $pager_url_last);
        $this->last_page($last_page_text, $pager_url_last);
    }
	
}

?>