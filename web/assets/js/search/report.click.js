$('.visit-website').click(function() {
    /* makes a report */
    $.post(Routing.generate('listing_clickreport', { info: $(this).data('info') }));
});
