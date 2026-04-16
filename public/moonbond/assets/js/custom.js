$(document).ready(function() {
    document.documentElement.style.setProperty('--animate-duration', '4s');

    (function() {
        var quotes = $(".exp");
        var quoteIndex = -1;

        function showNextQuote() {
            ++quoteIndex;
            quotes
                .eq(quoteIndex % quotes.length)
                .show()
                .addClass("animate__animated animate__fadeInUp")
                .delay(7000)
                // .removeClass("animate__animated animate__fadeInUp")
                // .addClass("animate__animated animate__fadeOutUp")
                .fadeOut(3000, showNextQuote);
        }

        showNextQuote();
    })();
});
// .eq(quoteIndex % quotes.length)
// // .fadeIn(3000)
// .show()
// .addClass("animate__animated animate__fadeInDown")
// .delay(5000)
// // .fadeOut(3000, showNextQuote);
// .removeClass("animate__animated animate__fadeInDown")
// .addClass("animate__animated animate__fadeOutDown")
// .hide()
// .removeClass("animate__animated animate__fadeOutDown")
// showNextQuote()