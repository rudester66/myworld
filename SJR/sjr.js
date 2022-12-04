window.addEventListener("load", function () {
    /* the var is inputted after the READY statement so to pick up the variables
     * once the page (DOM) has loaded
     */
    var modal = UIkit.modal("#modal");
    var reportModal = UIkit.modal("#reportModal");
    let body = $('body');

    var waiting = "<a class='uk-text-danger uk-text-large uk-icon-refresh uk-icon-spin'></a> &nbsp; <a class='uk-text-danger uk-text-large '>Please be patient while information is retrieved!</a>";

    $('body').on("mouseenter", ".theMenu", function () {
        $('#menuDiv').removeClass('uk-hidden');
    });
    $('body').on("mouseleave", ".theMenu", function () {
        $('#menuDiv').addClass('uk-hidden');
    });

    smiSticky();

});

//Checks that all the tables heights are over 0, then setSMISticky
function smiSticky() {
    //  Wait until DOM loaded
    if (document.readyState == 'complete') {
// console.log("here");
        //  Get a list of Divs with class of smiSticky
        var stickyArray = document.querySelectorAll('.smiSticky');
        // console.log(stickyArray);
        stickyArray.forEach(function (div) {
            let className = '';
            let hiddenDiv = '';
            //  check if the parent element is either hidden UIKIT tab (li) or a UIKIT hidden Div

            if (div.parentElement.tagName == 'LI' && div.parentElement.hasAttributes('aria-hidden')) {
                //  Check if UIKIT LI tab
                hiddenDiv = div.parentElement.classList.contains('uk-active');
                className = 'uk-active';
                //  add uk-active class to show the element then run setSMISTicky
                div.parentElement.classList.add(className);

                setSMISticky(div);
                if (!hiddenDiv) {
                    //  Add the uk-hidden or uk-active class if required
                    div.parentElement.classList.remove(className);
                }
            } else {
                //  Check if hidden div
                hiddenDiv = div.parentElement.classList.contains('uk-hidden');
                className = 'uk-hidden';
                //  Remove uk-hidden class to sho the then run setSMISTicky
                div.parentElement.classList.remove(className);

                setSMISticky(div);

                if (hiddenDiv) {
                    //  Add the uk-hidden or uk-active class if required
                    div.parentElement.classList.add(className);
                }
            }
        });
    }
}

function setSMISticky(div) {
    div.classList.remove('smiStickyNew');
    div.classList.add('uk-overflow-auto');

    //  Set the div height
    let hght = parseInt(div.attributes.hght.value);
    div.style.height = hght;

    // Only add the below if scrollHeight is bigger that hght
    if (div.scrollHeight > hght) {
        if (div.clientHeight < hght) {
            hght = (hght - 15);
        }

        let tableDiv = document.querySelector('#' + div.id);
        let footer = tableDiv.querySelector('tfoot');

        if (footer === null) {
            //  No footer exists, create a blank tfoot and add to end of table
            let tfoot = document.createElement("TFOOT");
            tableDiv.appendChild(tfoot);
            footer = tableDiv.querySelector('tfoot');
        }
        console.log(div.id, hght, footer);
        footer.style.transform = "translateY(" + ((tableDiv.scrollHeight * -1) + hght) + "px)";
        footer.style.backgroundColor = 'white';

        //  eventListener works for click but no scroll
        tableDiv.addEventListener("scroll", function () {

            let translate = "translateY(" + this.scrollTop + "px)";
            let footer = this.querySelector("tfoot");
            let header = this.querySelector("thead");

            header.style.transform = translate;
            header.style.backgroundColor = 'white';

            // if (tableDiv.querySelector("tfoot") != null) {
            // console.log( ((this.scrollHeight * -1) + (this.scrollTop + hght)), this.scrollTop, this.scrollHeight, hght);
            var translateBottom = "translateY(" + ((this.scrollHeight * -1) + (this.scrollTop + hght)) + "px)";
            footer.style.transform = translateBottom;
            footer.style.backgroundColor = 'white';

        });
    }
}


function showErrorBar(errorText) {
    // Get the snackbar DIV
    var x = document.getElementById("errorBar");

    x.innerHTML = errorText;
    // Add the "show" class to DIV
    x.className = "show";

    // After 5 seconds, remove the show class from DIV
    setTimeout(function () {
        x.className = x.className.replace("show", "");
    }, 5000);
}

function showSnackBar(snackText) {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");

    x.innerHTML = snackText;
    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function () {
        x.className = x.className.replace("show", "");
    }, 3000);
}

function showNotificationBar(notificationText) {
    // Get the snackbar DIV
    var x = document.getElementById("notificationBar");

    x.innerHTML = notificationText;
    // Add the "show" class to DIV
    x.className = "show";

}


