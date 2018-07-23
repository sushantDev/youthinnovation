$('.blog-post').click(function() {
    var url = $(this).data('url');
    $.ajax({
        url : url,
        success: function (response) {
            $.magnificPopup.open({
                items: {
                    src: response,
                    type: 'inline'
                },
                callbacks: {
                    close: function() {
                        setTimeout(function(){
                            $(document.documentElement).css('overflow', 'hidden');
                        }, 50);
                    }
                }
            });
        },
        error: function () {
            console.log('Error');
        }
    })
});