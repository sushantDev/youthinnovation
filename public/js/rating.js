// Globals
var rating = $('.rating');

// Create rating popup
rating.on('click', function(e) {
    var self = $(this),
        userRating = $('<ul />').attr('class', 'user-rating animate');

    // Create stars if not already on page
    if (!self.find('.user-rating').length) {
        for (var i = 0; i < 5; i++) {
            userRating.prepend('<li data-rating="' + (i + 1) + '"><i class="fa fa-star"></i></li>');
        }

        // Add stars to page
        userRating.appendTo(self);
        setTimeout(function() {
            userRating.removeClass('animate');
        }, 50);
    }

    e.preventDefault();
    e.stopPropagation();
});

// Select rating
rating.on('click', '.user-rating li', function() {
    var self = $(this),
        rateVal = self.data('rating');

    setTimeout(function() {
        removeRating(rateVal);
    }, 300);
});

// Remove rating popup
function removeRating(rateVal) {
    rating.children('.user-rating').addClass('animate');
    setTimeout(function() {
        rating.children('.user-rating').remove();
    }, 350);

    if (rateVal) {
        // Ajax submit here

        rating.addClass('hide');
        setTimeout(function() {
            rating.text(rateVal).removeClass('hide');
        }, 150);
    }
}

$(document).on('click', function() {
    if (rating.children('.user-rating').length) {
        removeRating();
    }
});