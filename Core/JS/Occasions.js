window.addEventListener("load", function () {
    /* the var is inputted after the READY statement so to pick up the variables
     * once the page (DOM) has loaded
     */
    var modal = UIkit.modal("#modal");
    var reportModal = UIkit.modal("#reportModal");
    let body = $('body');

    var waiting = "<a class='uk-text-danger uk-text-large uk-icon-refresh uk-icon-spin'></a> &nbsp; <a class='uk-text-danger uk-text-large '>Please be patient while information is retrieved!</a>";

    body.on('change', "#month", function () {
        let mth = $(this).val();
        window.location.href = '/Occasions?month=' + mth;
    })

    body.on("click", '#uploadFileButton', function () {
        if ($('#uploadFileDiv').hasClass('uk-hidden')) {
            $('#uploadFileDiv').removeClass('uk-hidden');
        } else {
            $('#uploadFileDiv').addClass('uk-hidden');
        }
    })


    body.on("click", "#showOccasionTagsDiv", function () {
        let el = document.getElementById("occasionsEdit");
        if ($(this).attr('showHide') == 'show') {
            $(this).attr('showHide', 'hide');
            el.style.zIndex = "100";
            $('#occasionsEdit').animate({
                width: "95%",
            }, 2500);
            $('#occasionsEditTagsDiv').removeClass('uk-hidden');
            $('#occasionsEditDetailsDiv').removeClass('uk-width-1-1');
            $('#occasionsEditDetailsDiv').addClass('uk-width-1-4');
        } else {
            $(this).attr('showHide', 'show');
            $('#occasionsEdit').animate({
                width: "18%",
            }, 2500, "linear", function(){
                el.style.zIndex = "0";
                $('#occasionsEditTagsDiv').addClass('uk-hidden');
                $('#occasionsEditDetailsDiv').removeClass('uk-width-1-4');
                $('#occasionsEditDetailsDiv').addClass('uk-width-1-1');
            });
        }

    })

})