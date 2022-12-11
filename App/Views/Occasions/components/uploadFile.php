<div class="uk-container uk-hidden" id="uploadFileDiv">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
        <h3 class="uk-card-title">Upload Files</h3>
        <div class="js-upload uk-placeholder uk-text-center">
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle">Attach binaries by dropping them here or</span>
            <div uk-form-custom>
                <input type="file" multiple>
                <span class="uk-link">selecting one</span>
            </div>
        </div>

        <progress id="progressbar" class="uk-progress" value="0" max="100" hidden></progress>

    </div>


    <script>

        // var bar = document.getElementById('js-progressbar');
        var bar = $("#progressbar")[0];
        UIkit.upload('.js-upload', {
            url: '/Occasions?mode=uploadImagesFiles&occasionID=<?php echo $obj->getRequests()['occasionID']; ?>',
            multiple: true,

            beforeSend: function () {
                // console.log('beforeSend', arguments);
            },
            beforeAll: function () {
                // console.log('beforeAll', arguments);
            },
            load: function () {
                // console.log('load', arguments);
            },
            error: function () {
                // console.log('error', arguments);
            },
            complete: function () {
                console.log('complete', arguments[0].response);
            },

            loadStart: function (e) {
                // console.log('loadStart', arguments);
                bar.removeAttribute('hidden');
                bar.max = e.total;
                bar.value = e.loaded;
            },

            progress: function (e) {
                // console.log('progress', arguments);

                bar.max = e.total;
                bar.value = e.loaded;
            },

            loadEnd: function (e) {
                // console.log('loadEnd', arguments);

                bar.max = e.total;
                bar.value = e.loaded;
            },

            completeAll: function () {
                // console.log('completeAll', arguments);

                setTimeout(function () {
                    bar.setAttribute('hidden', 'hidden');
                }, 1000);

                // console.log('complete', response[0].response);
                alert('Upload Completed');
                window.location.href = "/Occasions?occasionID=<?php echo $obj->getRequests()['occasionID']; ?>";
            }

        });

    </script>
</div>