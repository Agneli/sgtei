//Login
$(function() {

    $("#box-login").fadeIn(3000);

    $("#login").focus(function() {
        if ($(this).val() == "Login") {
            $(this).val("");
        }
    });
    $("#login").focusout(function() {
        if ($(this).val() == "") {
            $(this).val("Login");
        }
    });

//Senha
    $("#pass").focus(function() {
        if ($(this).val() == "Senha") {
            $(this).val("");
            this.type = 'password';
        }
    });
    $("#pass").focusout(function() {
        if ($(this).val() == "") {
            $(this).val("Senha");
            this.type = 'text';
        }
    });
});

//Hide-Show sub-menus
$(function() {
    $("#sm-default").show();

    //default
    $(".menu").hover(function() {
        $(".nav-2").hide();
        $("#sm-default").show();
    });

    //peoples
    $("#peoples").hover(function() {
        $(".nav-2").hide();
        $("#sm-peoples").show();
    });

    //vehicles
    $("#vehicles").hover(function() {
        $(".nav-2").hide();
        $("#sm-vehicles").show();
    });

    //routes
    $("#routes").hover(function() {
        $(".nav-2").hide();
        $("#sm-routes").show();
    });

    //monthly
    $("#monthly").hover(function() {
        $(".nav-2").hide();
        $("#sm-monthly").show();
    });

    //expenses
    $("#expenses").hover(function() {
        $(".nav-2").hide();
        $("#sm-expenses").show();
    });

    //monthly
    $("#reports").hover(function() {
        $(".nav-2").hide();
        $("#sm-reports").show();
    });

    //fuel
    $("#fuel").hover(function() {
        $(".nav-2").hide();
        $("#sm-fuel").show();
    });

    //values
    $("#values").hover(function() {
        $(".nav-2").hide();
        $("#sm-values").show();
    });

    //logout
    $("#logout").hover(function() {
        $(".nav-2").hide();
        $("#sm-default").show();
    });
});

//Login
$(function() {
    $("#help").click(function() {
        $("#box-help").fadeIn();
    });

    $("#close").click(function() {
        $("#box-help").fadeOut();
    });
});

//Mask
//RA <-> CNH 
$(function() {
    $("#ra").unmask();
    $("#phone").mask("(99) 9999-9999");
    $("#cellular").mask("(99) 9999-9999");
    $("#plate").mask("aaa-9999");


//RA <-> CNH
    $("input[name='type']").change(function() {
        if ($("input[name='type']:checked").val() == 's') {
            $("#lb-document").html("R.A:");
            $("input[name='document']").prop('type', 'text');
            $("input[name='document']").attr("id", "ra");
            $("#ra").unmask();
            $(".level").hide();
        } else if ($("input[name='type']:checked").val() == 'd') {
            $("#lb-document").html("CNH:");
            $("input[name='document']").prop('type', 'text');
            $("input[name='document']").attr("id", "cnh");
            $("#cnh").mask("99999999999");
            $(".level").hide();
        } else if ($("input[name='type']:checked").val() == 'u') {
            $(".level").show();
            $("#lb-document").html("Senha:");
            $("input[name='document']").prop('type', 'password');
            $("input[name='document']").attr("id", "pass");
            $("#pass").unmask();
        }
    });

    //Autonomy
    $("#autonomy").mask("99");

});

//Fix Height
$(function() {
    var height = $("main > .content").height();
    $("main > .content").css('height', height);
});

//Messages
function sucess() {
    $(".sucess").slideDown();
    $(".sucess").delay(3000).slideUp();
}
;

function error() {
    $(".error").slideDown();
    $(".error").delay(3000).slideUp();
}
;

function up_sucess() {
    $(".up_sucess").slideDown();
    $(".up_sucess").delay(3000).slideUp();
}
;

function up_error() {
    $(".up_error").slideDown();
    $(".up_error").delay(3000).slideUp();
}
;

function fields() {
    $(".fields").slideDown();
    $(".fields").delay(3000).slideUp();
}
;

function email() {
    $(".email").slideDown();
    $(".email").delay(3000).slideUp();
}
;

function numeric(field) {
    $(".numeric .field").text(field);
    $(".numeric").slideDown();
    $(".numeric").delay(3000).slideUp();
}
;

//Ajax
$(function() {
    $("select[name=route]").change(function() {
        beforeSend:$("select[name=value]").html('<option value="0">Carregando...</option>');
        beforeSend:$("select[name=vehicle]").html('<option value="0">Carregando...</option>');

        $.post("layout/select-value.php", {
            id: $(this).val()
        }, function(get_value) {
            complete:$("select[name=value]").html(get_value);
        });

        $.post("layout/select-vehicles-cont.php", {
            id: $(this).val()
        }, function(get_vehicle) {
            complete:$("select[name=vehicle]").html(get_vehicle);
        });
    });
});