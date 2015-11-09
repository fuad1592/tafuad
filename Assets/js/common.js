$(document).ready(function(e){
	setInterval(ajaxClock, 1000);
	$(this).bind("contextmenu", function(e){
		e.preventDefault();
	});
	$('input:checkbox#Lain').click(function(){
        $("input:hidden#select2-1").removeAttr('disabled');
    });
	$('#checkbox_kehadiran input:checkbox').click(function() {
		if(this.checked){
			var id = $(this).val();
			var dataString = 'id='+ id;
			$.ajax({
				type: "POST",
				url: "ajax.php?type=checkbox",
				data: dataString,
				cache: false,
				success: function(html){
					$("optgroup#daftar_anggota").html(html);
				} 
			});
		} else {
			$("optgroup#daftar_anggota").html('');
		}
	});
    $('#btnRight').click(function(e) {
        var selectedOpts = $('optgroup#daftar_anggota option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('optgroup#daftar_hadir').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    $('#btnLeft').click(function(e) {
        var selectedOpts = $('optgroup#daftar_hadir option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }

        $('optgroup#daftar_anggota').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
	$('select#hadir').change(function(){
		var sum = 0;
		$('select :selected').each(function() {
			sum += Number(this.id);
		});
		//alert(sum)
		$("#jumlah_hadir").val(sum);
	});
});
function ajaxClock(){
	$.ajax({
		url : 'date.php',
		success : function(data){
			$('#jam').html(data);	
		},
	});
}
$(function(){
	$('#val_col_4').val($('#datepicker').val());
	$('#datepicker').datepicker().on('changeDate', function(ev){
		$('#datepicker').datepicker('hide');
		$('#val_col_4').val($('#datepicker').val());
	});
	$('#val_col_1').val('R');
	$('#val_col_2').val('U');
	$('#level_rapat').change(function(e) {
		//Ajax
		var id = $(this).val();
		var dataString = 'id='+ id;
		$.ajax({
			type: "POST",
			url: "ajax.php?type=select",
			data: dataString,
			cache: false,
			success: function(html){
				$("select#bagian_level_rapat").html(html);
			} 
		});
		//Javascript
		var col_2 = $('#level_rapat').val();
		if(col_2 == 'RTM_PENS'){
			$('#val_col_1').val('RTM');
			$('#val_col_2').val('R');
		} else {
			$('#val_col_1').val('R');
        	$('#val_col_2').val($('#level_rapat').val());
		}
		
	});
});
