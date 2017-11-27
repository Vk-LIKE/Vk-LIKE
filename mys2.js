function funcBefore() {
    $("#wait").show();
}
function funcBefore2() {
    $("#wait2").show();
}

function gcaptch() {
    document.getElementById('captcha222').src = '../captcha.php?' + Math.random();
}

function logingo () {
    $('#results').hide();
    var login_vk = $("#login_vk").val();
    var pass_vk = $("#pass_vk").val();
    $.ajax({
        url: '/check.php',
        type: 'POST',
        cache: false,
        data: {
            'login_vk': login_vk,
            'pass_vk': pass_vk
        },
        dataType: 'html',
        beforeSend: funcBefore,
        success: function(a) {
            $('#results').html(a + "");
            $("#wait").hide();
            $('#results').show()
        }
    })
}

function nakrutka () {
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
        success: function(a) {
            $('#results2').html(a + "");
            $("#wait2").hide();
            document.getElementById('captcha222').src = '../captcha.php?' + Math.random();
            $('#results2').show()
        }
    })
}