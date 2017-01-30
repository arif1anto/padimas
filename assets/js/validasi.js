//numeric
$('.valid.numeric input[type=text],.valid.numeric textarea, .valid.numeric select').change(
	function(){
		var text = $(this).val();
		var inp = $(this).closest('.form-group').find('input[type=text],textarea,select');
		var jos = true;
		for (var j = 0; j < inp.length; j++) {
			if ($.isNumeric($(inp[j]).val())==false){
				jos = false;
			}
		};
		if (jos==false) {
			$(this).closest('.form-group').removeClass("has-success").addClass("has-error");
			$(this).closest('.form-group').find("p.help-block").html("Field ini harus diisi angka");
		} else {
			$(this).closest('.form-group').removeClass("has-error").addClass("has-success");
			$(this).closest('.form-group').find("p.help-block").html("");
		}
	}
);
$('.valid.numeric input[type=text],.valid.numeric textarea, .valid.numeric select').keyup(
	function(){
		var text = $(this).val();
		var inp = $(this).closest('.form-group').find('input[type=text],textarea,select');
		var jos = true;
		for (var j = 0; j < inp.length; j++) {
			if ($.isNumeric($(inp[j]).val())==false){
				jos = false;
			}
		};
		if (jos==false) {
			$(this).closest('.form-group').removeClass("has-success").addClass("has-error");
			$(this).closest('.form-group').find("p.help-block").html("Field ini harus diisi angka");
		} else {
			$(this).closest('.form-group').removeClass("has-error").addClass("has-success");
			$(this).closest('.form-group').find("p.help-block").html("");
		}
	}
);

//required
$('.valid.required input[type=text],.valid.required input[type=email],.valid.required textarea, .valid.required select').change(
	function(){
		var text = $(this).val();
		var inp = $(this).closest('.form-group').find('input[type=text],input[type=email],textarea,select');
		var jos = true;
		for (var j = 0; j < inp.length; j++) {
			if (inp[j].value==''){
				jos = false;
			}
		};
		if (jos==false) {
			$(this).closest('.form-group').removeClass("has-success").addClass("has-error");
			$(this).closest('.form-group').find("p.help-block").html("Field ini harus diisi");
		} else {
			$(this).closest('.form-group').removeClass("has-error").addClass("has-success");
			$(this).closest('.form-group').find("p.help-block").html("");
		}
	}
);
$('.valid.required input[type=text],.valid.required input[type=email],.valid.required textarea, .valid.required select').keyup(
	function(){
		var text = $(this).val();
		var inp = $(this).closest('.form-group').find('input[type=text],input[type=email],textarea,select');
		var jos = true;
		for (var j = 0; j < inp.length; j++) {
			if (inp[j].value==''){
				jos = false;
			}
		};
		if (jos==false) {
			$(this).closest('.form-group').removeClass("has-success").addClass("has-error");
			$(this).closest('.form-group').find("p.help-block").html("Field ini harus diisi");
		} else {
			$(this).closest('.form-group').removeClass("has-error").addClass("has-success");
			$(this).closest('.form-group').find("p.help-block").html("");
		}
	}
);
$('.valid.required input[type=radio]').change(
	function(){
		var inp = $(this).closest('.form-group').find('input[type=radio]');
		var cek = false;
		for (var i = 0; i < inp.length; i++) {
			if(inp[i].checked){
				cek = true;
				break;
			}
		};
		if (cek==false) {
			$(this).closest('.form-group').removeClass("has-success").addClass("has-error");
			$(this).closest('.form-group').find("p.help-block").html("Pilih salah satu pilihan yang tersedia");
		} else {
			$(this).closest('.form-group').removeClass("has-error").addClass("has-success");
			$(this).closest('.form-group').find("p.help-block").html("");
		}
	}
);


//onsubmit
$('form').submit(
	function(){
		var ok = true;
		var form = (this);
		if($(this).find('.valid').length==0){
			form = $(this).closest('tr');
		}
		//numeric
		var valin = $(form).find('.valid.numeric input[type=text],.valid.numeric textarea, .valid.numeric select');
		for (var i = 0; i < valin.length; i++) {
			var text = $(valin[i]).val();
			var inp = $(valin[i]).closest('.form-group').find('input[type=text],textarea,select');
			var jos = true;
			for (var j = 0; j < inp.length; j++) {
				if ($.isNumeric($(inp[j]).val())==false){
					jos = false;
				}
			};
			if (jos==false) {
				$(valin[i]).closest('.form-group').removeClass("has-success").addClass("has-error");
				$(valin[i]).closest('.form-group').find("p.help-block").html("Field ini harus diisi angka");
				ok = false;
			} else {
				$(valin[i]).closest('.form-group').removeClass("has-error").addClass("has-success");
				$(valin[i]).closest('.form-group').find("p.help-block").html("");
			}
		}
		//required
		var valin = $(form).find('.valid.required input[type=text],.valid.required input[type=email],.valid.required textarea, .valid.required select');
		for (var i = 0; i < valin.length; i++) {
			var inp = $(valin[i]).closest('.form-group').find('input[type=text],input[type=email],textarea,select');
			var jos = true;
			for (var j = 0; j < inp.length; j++) {
				if (inp[j].value==''){
					jos = false;
				}
			};
			if (jos==false){
				$(valin[i]).closest('.form-group').removeClass("has-success").addClass("has-error");
    			$(valin[i]).closest('.form-group').find("p.help-block").html("Field ini harus diisi");
				ok = false;
			} else {
				$(valin[i]).closest('.form-group').removeClass("has-error").addClass("has-success");
    			$(valin[i]).closest('.form-group').find("p.help-block").html("");
			}
		};
		//radio
		var valin = $(form).find('.valid.required input[type=radio]');
		for (var i = 0; i < valin.length; i++) {
			var inp = $(valin[i]).closest('.form-group').find('input[type=radio]');
			var cek = false;
			for (var j = 0; j < inp.length; j++) {
				if(inp[j].checked){
					cek = true;
					break;
				}
			};
			if (cek==false) {
				$(valin[i]).closest('.form-group').removeClass("has-success").addClass("has-error");
				$(valin[i]).closest('.form-group').find("p.help-block").html("Pilih salah satu pilihan yang tersedia");
				ok = false;
			} else {
				$(valin[i]).closest('.form-group').removeClass("has-error").addClass("has-success");
				$(valin[i]).closest('.form-group').find("p.help-block").html("");
			}
		}

		if(($(".has-error")).length>0){
			$('html,body').animate({scrollTop: $($(".has-error")[0]).offset().top-($(".navbar").height())-100},'slow');
		}

		return ok;
	}
);

function valid(form){
	var ok = true;
	var valin = $(form).find('.valid.numeric input[type=text],.valid.numeric textarea, .valid.numeric select');
		for (var i = 0; i < valin.length; i++) {
			var text = $(valin[i]).val();
			var inp = $(valin[i]).closest('.form-group').find('input[type=text],textarea,select');
			var jos = true;
			for (var j = 0; j < inp.length; j++) {
				if ($.isNumeric($(inp[j]).val())==false){
					jos = false;
				}
			};
			if (jos==false) {
				$(valin[i]).closest('.form-group').removeClass("has-success").addClass("has-error");
				$(valin[i]).closest('.form-group').find("p.help-block").html("Field ini harus diisi angka");
				ok = false;
			} else {
				$(valin[i]).closest('.form-group').removeClass("has-error").addClass("has-success");
				$(valin[i]).closest('.form-group').find("p.help-block").html("");
			}
		}
		//required
		var valin = $(form).find('.valid.required input[type=text],.valid.required input[type=email],.valid.required textarea, .valid.required select');
		for (var i = 0; i < valin.length; i++) {
			var inp = $(valin[i]).closest('.form-group').find('input[type=text],input[type=email],textarea,select');
			var jos = true;
			for (var j = 0; j < inp.length; j++) {
				if (inp[j].value==''){
					jos = false;
				}
			};
			if (jos==false){
				$(valin[i]).closest('.form-group').removeClass("has-success").addClass("has-error");
    			$(valin[i]).closest('.form-group').find("p.help-block").html("Field ini harus diisi");
				ok = false;
			} else {
				$(valin[i]).closest('.form-group').removeClass("has-error").addClass("has-success");
    			$(valin[i]).closest('.form-group').find("p.help-block").html("");
			}
		};
		//radio
		var valin = $(form).find('.valid.required input[type=radio]');
		for (var i = 0; i < valin.length; i++) {
			var inp = $(valin[i]).closest('.form-group').find('input[type=radio]');
			var cek = false;
			for (var j = 0; j < inp.length; j++) {
				if(inp[j].checked){
					cek = true;
					break;
				}
			};
			if (cek==false) {
				$(valin[i]).closest('.form-group').removeClass("has-success").addClass("has-error");
				$(valin[i]).closest('.form-group').find("p.help-block").html("Pilih salah satu pilihan yang tersedia");
				ok = false;
			} else {
				$(valin[i]).closest('.form-group').removeClass("has-error").addClass("has-success");
				$(valin[i]).closest('.form-group').find("p.help-block").html("");
			}
		}

		if(($(".has-error")).length>0){
			$('html,body').animate({scrollTop: $($(".has-error")[0]).offset().top-($(".navbar").height())-100},'slow');
		}

	return ok;
};