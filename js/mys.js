function funcBefore() {
	$("#wait").show()
}
function funcBefore2() {
	$("#wait2").show()
}
function gcaptch() {
	document.getElementById('captcha222').src = '../captcha.php?' + Math.random()
}
function preload() {
	$('#results5').slideUp();
	var url = $("#url").val();
	$.ajax({
		url: '/info.php',
		type: 'POST',
		cache: false,
		data: {
			'url': url,
		},
		dataType: 'html',
		beforeSend: funcBefore,
		success: function (a) {
			$('#results5').html(a);
			$("#wait").hide();
			$('#results5').slideDown()
		}
	})
}
function logingo() {
	$('#results').hide();
	var login_vk = $("#login_vk").val();
	var pass_vk = $("#pass_vk").val();
	var captcha_sid = $("#captcha_sid").val();
	var captcha_key = $("#captcha_key").val();
	$.ajax({
		url: '/check.php',
		type: 'POST',
		cache: false,
		data: {
			'login_vk': login_vk,
			'pass_vk': pass_vk,
			'captcha_sid': captcha_sid,
			'captcha_key': captcha_key,
		},
		dataType: 'html',
		beforeSend: funcBefore,
		success: function (a) {
			$('#results').html(a + "");
			$("#wait").hide();
			$('#results').show()
		}
	})
}
function nakrutka() {
	$('#results2').hide();
	var url = $("#url").val();
	var captcha = $("#captcha").val();
	$.ajax({
		url: '/go.php',
		type: 'POST',
		cache: false,
		data: {
			'url': url,
			'captcha': captcha
		},
		dataType: 'html',
		beforeSend: funcBefore2,
		success: function (a) {
			$('#results2').html(a + "");
			$("#wait2").hide();
			document.getElementById('captcha222').src = '../captcha.php?' + Math.random();
			$('#results2').show()
		}
	})
}