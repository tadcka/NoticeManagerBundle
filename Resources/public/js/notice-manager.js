$(document).ready(function () {
    $('div.block_notices').on('click', 'a.alert-notice-href', function () {
        $(this).parent("div.alert-notice").hide("slow");
    });
});
