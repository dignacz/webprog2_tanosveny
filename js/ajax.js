function npok() {
    $.post(
        "ajax.php",
        {"op" : "np"},
        function(data) {
            //$("#npselect").html('<option value="0">Válasszon ...</option>');
            $("<option>").val("0").text("Válasszon ...").appendTo("#npselect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                //$("#npselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
                $("<option>").val(lista[i].id).text(lista[i].nev).appendTo("#npselect");
        },
        "json"                                                    
    );
};

function varosok() {
    $("#varosselect").html("");
    $("#tanosvenyselect").html("");
    $(".adat").html("");
    var npid = $("#npselect").val();
    if (npid != 0) {
        $.post(
            "ajax.php",
            {"op" : "varos", "id" : npid},
            function(data) {
                $("#varosselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#varosselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
            },
            "json"                                                    
        );
    }
}

function tanosvenyek() {
    $("#tanosvenyselect").html("");
    $(".adat").html("");
    var varosid = $("#varosselect").val();
    if (varosid != 0) {
        $.post(
            "ajax.php",
            {"op" : "tanosveny", "id" : varosid},
            function(data) {
                $("#tanosvenyselect").html('<option value="0">Válasszon ...</option>');
                var lista = data.lista;
                for(i=0; i<lista.length; i++)
                    $("#tanosvenyselect").append('<option value="'+lista[i].id+'">'+lista[i].nev+'</option>');
            },
            "json"                                                    
        );
    }
}

function tanosveny() {
    $(".adat").html("");
    var tanosvenyid = $("#tanosvenyselect").val();
    if (tanosvenyid != 0) {
        $.post(
            "ajax.php",
            {"op" : "info", "id" : tanosvenyid},
            function(data) {
                $("#nev").text(data.nev);
                $("#hossz").text(data.hossz);
                $("#allomas").text(data.allomas);
                $("#ido").text(data.ido);
                $("#vezetes").text(data.vezetes);
            },
            "json"                                                    
        );
    }
}

$(document).ready(function() {
   npok();
   
   $("#npselect").change(varosok);
   $("#varosselect").change(tanosvenyek);
   $("#tanosvenyselect").change(tanosveny);
   
   $(".adat").hover(function() {
        $(this).css({"color" : "white", "background-color" : "black"});
    }, function() {
        $(this).css({"color" : "black", "background-color" : "white"});
    });
});