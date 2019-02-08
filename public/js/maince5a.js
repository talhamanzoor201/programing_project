'use strict';

/*

Main javascript functions to init most of the elements

#1. CHAT APP
#2. CALENDAR INIT
#3. FORM VALIDATION
#4. DATE RANGE PICKER
#5. DATATABLES
#6. EDITABLE TABLES
#7. FORM STEPS FUNCTIONALITY
#8. SELECT 2 ACTIVATION
#9. CKEDITOR ACTIVATION
#10. CHARTJS CHARTS http://www.chartjs.org/
#11. MENU RELATED STUFF
#12. CONTENT SIDE PANEL TOGGLER
#13. EMAIL APP
#14. FULL CHAT APP
#15. CRM PIPELINE
#16. OUR OWN CUSTOM DROPDOWNS 
#17. BOOTSTRAP RELATED JS ACTIVATIONS
#18. TODO Application
#19. Fancy Selector
#20. SUPPORT SERVICE
#21. Onboarding Screens Modal
#22. Colors Toggler
#23. Auto Suggest Search
#24. Element Actions

*/

// ------------------------------------
// HELPER FUNCTIONS TO TEST FOR SPECIFIC DISPLAY SIZE (RESPONSIVE HELPERS)
// ------------------------------------

function is_display_type(display_type) {
    return $('.display-type').css('content') == display_type || $('.display-type').css('content') == '"' + display_type + '"';
}

function not_display_type(display_type) {
    return $('.display-type').css('content') != display_type && $('.display-type').css('content') != '"' + display_type + '"';
}

$(function () {

    // #1. CHAT APP

    $('.floated-chat-btn, .floated-chat-w .chat-close').on('click', function () {
        $('.floated-chat-w').toggleClass('active');
        return false;
    });

    $('.message-input').on('keypress', function (e) {
        if (e.which == 13) {
            $('.chat-messages').append('<div class="message self"><div class="message-content">' + $(this).val() + '</div></div>');
            $(this).val('');
            var $messages_w = $('.floated-chat-w .chat-messages');
            $messages_w.scrollTop($messages_w.prop("scrollHeight"));
            $messages_w.perfectScrollbar('update');
            return false;
        }
    });

    $('.floated-chat-w .chat-messages').perfectScrollbar();

});

// #11. MENU RELATED STUFF

// INIT MOBILE MENU TRIGGER BUTTON
$('.mobile-menu-trigger').on('click', function () {
    $('.menu-mobile .menu-and-user').slideToggle(200, 'swing');
    return false;
});


// #12. CONTENT SIDE PANEL TOGGLER

$('.content-panel-toggler, .content-panel-close, .content-panel-open').on('click', function () {
    $('.all-wrapper').toggleClass('content-panel-active');
});

// #13. EMAIL APP

$('.more-messages').on('click', function () {
    $(this).hide();
    $('.older-pack').slideDown(100);
    $('.aec-full-message-w.show-pack').removeClass('show-pack');
    return false;
});

$('.ae-list').perfectScrollbar({wheelPropagation: true});

$('.ae-list .ae-item').on('click', function () {
    $('.ae-item.active').removeClass('active');
    $(this).addClass('active');
    return false;
});


// #14. FULL CHAT APP
function add_full_chat_message($input) {
    $('.chat-content').append('<div class="chat-message self"><div class="chat-message-content-w"><div class="chat-message-content">' + $input.val() + '</div></div><div class="chat-message-date">1:23pm</div><div class="chat-message-avatar"><img alt="" src="img/avatar1.jpg"></div></div>');
    $input.val('');
    var $messages_w = $('.chat-content-w');
    $messages_w.scrollTop($messages_w[0].scrollHeight);
}

$('.chat-btn a').on('click', function () {
    add_full_chat_message($('.chat-input input'));
    return false;
});
$('.chat-input input').on('keypress', function (e) {
    if (e.which == 13) {
        add_full_chat_message($(this));
        return false;
    }
});

// #21. Onboarding Screens Modal


// #24. Element Actions
$('.element-action-fold').on('click', function () {
    var $wrapper = $(this).closest('.element-wrapper');
    $wrapper.find('.element-box-tp, .element-box').toggle(0);
    var $icon = $(this).find('i');

    if ($wrapper.hasClass('folded')) {
        $icon.removeClass('os-icon-plus-circle').addClass('os-icon-minus-circle');
        $wrapper.removeClass('folded');
    } else {
        $icon.removeClass('os-icon-minus-circle').addClass('os-icon-plus-circle');
        $wrapper.addClass('folded');
    }
    return false;
})

