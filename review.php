<?php 
require 'includes/dbhandler.php';
require 'includes/header.php'; 
require 'includes/review-helper.php';
?>

<main>
    <span id="testAvg"></span>
    <div class = "container" align = "center" style = "max-width: 800px">
        <div class = "my-auto">
            <form id = "review-form" action = "includes/review-helper.php" method = "post">
                <div class = "container">
                    <i class = "fa fa-star fa-2x star-rev" data-index = "1"></i>
                    <i class = "fa fa-star fa-2x star-rev" data-index = "2"></i>
                    <i class = "fa fa-star fa-2x star-rev" data-index = "3"></i>
                    <i class = "fa fa-star fa-2x star-rev" data-index = "4"></i>
                    <i class = "fa fa-star fa-2x star-rev" data-index = "5"></i>
                </div>
                <div class = "form-group" style = "margin-top: 16px;">
                    <label class = "title-label" form = "review-title" style = "width: 100%;"></label>
                    <input type = "text" name = "review-title" id = "review-title" style = "width: 100%; margin-bottom: 16px;" placeholder = "Your title"></input>
                    <textarea style = "resize: none; overflow-wrap: anywhere;" class = "form-control" id = "review-text" name = "review" placeholder = "Your review here..." cols = "50" rows = "3"></textarea>
                    <input type = "hidden" name = "rating" id = "rating"></input>
                    <input type = "hidden" name = "item_id" value = "<?php echo($_GET['id']); ?>"></input>
                </div>
                <div class = "form-group">
                    <button name = "review-submit" class = "btn btn-info">Post Review</button>
                </div>
            </form>
        </div>
    </div>
    <span id="review_list"></span>
</main>
<script type="text/javascript">

var rateIndex = -1;
var id = <?php echo($_GET['id']); ?>;

$(document).ready(function() {
    reset_star();

    // get reviews
    xhr_getter('display-reviews.php?id=', "review_list");
    //avg();
    xhr_getter('includes/get-ratings.php?id=', "testAvg");

    if (localStorage.getItem('rating') != null) {
        setStars(parseInt(localStorage.getItem('rating')));
    }
    $('.star-rev').on('click', function() {
        rateIndex = parseInt($(this).data('index'));
        localStorage.setItem('rating', rateIndex);
    });
    $('.star-rev').mouseover(function() {
        reset_star();
        var currIndex = parseInt($(this).data('index'));
        setStars(currIndex);

    });
    $('.star-rev').mouseleave(function() {
        reset_star();

        if (rateIndex != -1) {
            setStars(rateIndex);
        }
    });


    function reset_star() {
        $('.star-rev').css('color', 'grey');
    }

    function setStars(max) {
        for (var i = 0; i < max; i++) {
            $('.star-rev:eq('+i+')').css('color', 'grey');
        }
        document.getElementById('rating').value = parseInt(localStorage.getItem('rating'));
    }

    //Used to interchangeably send GET requests for review display data.
    function xhr_getter(prefix, element) {
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function() {
            if (this.readyState = 4 && status == 200) {
                document.getElementById(element).innerHTML = this.responseText;
            }
        };

        url = prefix + id;
        xhttp.open("GET", url, true);
        xhttp.send();
    }
});
</script>