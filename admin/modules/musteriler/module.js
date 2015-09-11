$(document).ready(function(){
	
	$('select[name=musteri_id]').change(function(){
		window.location = '?s=display&dispatch=musteriler.odeme_add&musteri_id='+$(this).val();
	});
	
});