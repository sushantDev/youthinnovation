(function($) {
  Drupal.behaviors.competition_entry_review_project_feedback_form = {
    attach: function(context) {
      // not used this code because we use #ajax in the form
      //$('#competition-entry-review-project-feedback-form', context).submit(function (event){
        //var stars_value = $('select', $(this)).val();
        //var feedback_value = $.trim($('textarea', $(this)).val());
        //var messages = '';
        //$('.fivestar-widget', $(this)).removeClass('error');
        //$('.form-textarea', $(this)).removeClass('error');
        //if(isNaN(stars_value)) {
          //$('.fivestar-widget', $(this)).addClass('error');
          //messages += '<div>'+Drupal.t('Stars rating field is required.')+'</div>';
          //event.preventDefault();
        //}
        //if(feedback_value == '') {
          //$('.form-textarea', $(this)).addClass('error');
          //messages += '<div>'+Drupal.t('Feedback field is required.')+'</div>';
          //event.preventDefault();
        //}
        //if(messages != '') {
          //$('.messages.error', $(this)).remove();
          //$('.form-item-feedback', $(this)).before('<div class="messages error">'+messages+'</div>');
        //}
      //});
      
      // quick tip
      $('.quick-tips .form-checkbox', context).click(function() {
        var item_number = $(this).attr('data-item-number');
        var another_parent_class = $(this).parent().parent().parent().parent().hasClass('field-name-taxonomy-vocabulary-14') ? 'field-name-taxonomy-vocabulary-15' : 'field-name-taxonomy-vocabulary-14';
        $("."+another_parent_class+" [data-item-number="+item_number+"]").attr('checked', false);
      });
      
      // sticky functionality
      if($('.competition-entry-review-project-feedback-form.stickable', context).length > 0) {
        document.stickyFeedbackFormTop = $('.competition-entry-review-project-feedback-form.stickable', context).offset().top;
        competition_entry_review_sticky_feedback(context);
        $(window).scroll(function() {  
          competition_entry_review_sticky_feedback(context);  
        });
      }
    }
  }
  
  function competition_entry_review_sticky_feedback(context){  
    var scrollTop = $(window).scrollTop();  

    //stickyFeedbackFormTop is original vertical position of sticky nav. it is saved on Drupal.behaviors
    if (scrollTop > document.stickyFeedbackFormTop) {   
      $('.competition-entry-review-project-feedback-form.stickable', context).addClass('sticky');
    } else {  
      $('.competition-entry-review-project-feedback-form.stickable', context).removeClass('sticky');
    }
  }
})(jQuery);
