< script >
    $(".deleteBtn").click(function() {
        var $row = $(this).prev();
        var postID = parseInt($row.text());
        window.location.href = "includes/deletePost.inc.php?postID=" + postID;
    }); <
/script>    

<
script >

    var fixmeTop = $('#getFixed').offset().top - 80;
$(window).scroll(function() {
    var currentScroll = $(window).scrollTop();
    if (currentScroll >= fixmeTop) {
        $('#getFixed').css({
            position: 'fixed',
            top: '80px',
            width: '15vw'
        });
    } else {
        $('#getFixed').css({
            position: 'static'
        });
    }

});

<
/script>


<
script >
    $(window).on("scroll", function() {
        if ($(window).scrollTop()) {
            $('nav').addClass('black');
        } else {
            $('nav').removeClass('black');
        }
    }) <
    /script> <
    script >
    $('.welcomeBtn').click(function() {
        $(document.getElementById('welcomeContainer')).fadeOut(300);

        $('html, body').delay(500).animate({
            scrollTop: $('#start').offset().top - 80
        }, 2000);

    }); <
/script> <
script >
    function showWelcome() {
        document.getElementById('welcomeContainer').style.display = 'block';
    }

function scroller() {
    $('html, body').delay(300).animate({
        scrollTop: $('#start').offset().top - 80
    }, 900);
} <
/script>