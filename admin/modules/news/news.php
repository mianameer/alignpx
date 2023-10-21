<?php
include "../../includes/config.php";
include "../../includes/functions.php";
?>
<?php
include "../../includes/header.php";
include "../../includes/sidebar.php"; ?>
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    <div id="content" class="main-content">
        <div class="row" id="blogd">
        </div>
    </div>
</div>

</div>

<?php include "../../includes/footer.php"; ?>
<script>
    var apiEndpoint = 'https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=aab4705b729e4d08bf639a337a501aee'; // Replace with your API URL
    var cursorTimer;
    var requestInterval = 10000;

    function makeAPIRequest() {
        console.log("kjsdn");

        $.ajax({
            url: apiEndpoint,
            method: 'GET',
            success: function(responseData) {
                $("#blogd").html('');
                for (let i = 0; i < responseData.articles.length; i++) {
                    const element = responseData.articles[i];
                    var htmlContent = `<div style="margin: 10px;" class="">
                    <div class="card component-card_9">
                        <a href="` + element.url + `" target="_blank" rel="noopener noreferrer">
                        <img src="` + element.urlToImage + `" class="card-img-top" alt="widget-card-2"></a>
                        <div class="card-body">
                            <p class="meta-date">date</p>

                            <h5 class="card-title">` + element.title + `</h5>
                            <p class="card-text">` +
                        element.description + `</p>
                            <div class="meta-info">
                                <div class="meta-user">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-title rounded-circle">BBC</span>
                                    </div>
                                    <div class="user-name">` + element.source.name + `</div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>`

                    $("#blogd").append(htmlContent);
                }

            },
            error: function() {
                $('#api-response').html('Error fetching data from the API');
            }
        });
    }

    function resetCursorTimer() {
        clearTimeout(cursorTimer);
        cursorTimer = setTimeout(function() {
            makeAPIRequest();
            resetCursorTimer();
        }, requestInterval);
    }

    // Initial API request
    makeAPIRequest();

    // Start the cursor inactivity timer
    resetCursorTimer();

    // Track cursor movements
    $(document).mousemove(function() {
        resetCursorTimer();
    });
</script>