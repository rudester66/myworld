window.addEventListener("load", function () {
    /* the var is inputted after the READY statement so to pick up the variables
     * once the page (DOM) has loaded
     */
    var modal = UIkit.modal("#modal");
    var reportModal = UIkit.modal("#reportModal");
    let body = $('body');

    var waiting = "<a class='uk-text-danger uk-text-large uk-icon-refresh uk-icon-spin'></a> &nbsp; <a class='uk-text-danger uk-text-large '>Please be patient while information is retrieved!</a>";


    body.on("keyup", '.searchInput', function(){
        let table = $(this).attr('table');
        let txt = $(this).val();
        $.ajax({
            type: "POST",
            url: 'Homes',
            data: { mode: 'searchTable', table:table, txt:txt },
            success: function (msg) {
                console.log(msg);
            }
        });


    })



});