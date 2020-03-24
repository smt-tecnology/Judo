var hola = 0

function contador() {
    if (hola == 0) {
        hola = 1;
        console.log(hola)
    } else {
        hola = 0
        console.log(hola)
    }
}


$('.menuicono').click(function() {
    if (hola == 0) {
        contador()
        $('.listanavmobile').slideDown(1000);

        $('.listanavmobile').toggleClass('opening');


    } else if (hola == 1) {
        contador()
        $('.listanavmobile').slideUp(1000);
        $('.listanavmobile').toggleClass('opening ');


    }


});