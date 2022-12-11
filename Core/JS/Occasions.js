window.addEventListener("load", function () {
    /* the var is inputted after the READY statement so to pick up the variables
     * once the page (DOM) has loaded
     */
    var modal = UIkit.modal("#modal");
    var reportModal = UIkit.modal("#reportModal");
    let body = $('body');

    var waiting = "<a class='uk-text-danger uk-text-large uk-icon-refresh uk-icon-spin'></a> &nbsp; <a class='uk-text-danger uk-text-large '>Please be patient while information is retrieved!</a>";

    body.on('change', "#month", function(){
        let mth = $(this).val();
        window.location.href = '/Occasions?month=' +mth;
    })

    body.on("click", '#uploadFileButton', function(){
        if($('#uploadFileDiv').hasClass('uk-hidden')){
            $('#uploadFileDiv').removeClass('uk-hidden');
        } else {
            $('#uploadFileDiv').addClass('uk-hidden');
        }
    })

})