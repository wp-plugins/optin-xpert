jQuery(document).ready(function($){

  switch (lightbox_layout) {
    case 'lightbox-layout1':
      $('.modal-content.clearfix').addClass('lightbox_layout1');
      break;

    case 'lightbox-layout2':
      $('.modal-content.clearfix').addClass('lightbox_layout2');
      break;

    case 'lightbox-layout3':
      $('.modal-content.clearfix').addClass('lightbox_layout3');
      break;
  }

  switch (flyer_layout) {
    case 'flyer-layout1':
      $('.flyin-optin-content').addClass('flyer_layout1');
      break;

    case 'flyer-layout2':
      $('.flyin-optin-content, .flyin-optin-image').addClass('flyer_layout2');
      break;

    case 'flyer-layout3':
      $('.flyin-optin-content, .optin-flyin-display, .flyin-optin-image').addClass('flyer_layout3');
      break;
  }

  switch (stickytop_layout) {
    case 'stickytop-layout1':
      $('.stickytop-wrapper').addClass('stickytop_layout1');
      break;

    case 'stickytop-layout2':
      $('.stickytop-wrapper').addClass('stickytop_layout2');
      break;

    case 'stickytop-layout3':
      $('.stickytop-wrapper').addClass('stickytop_layout3');
      break;
  }



    $("#tx-optin-form").submit(function(e){
      e.preventDefault();
      var email = $(this).find("input[name=optin_mail]").val();

      subscribeToMailingList(email);
    });

    var subscribeToMailingList = function(email){
      var data = {
        'action': 'tx_optin_subscribe_action',
        'email': email
      };

      $.post("", data, function(response) {
        if(response.sent){
          // alert("Hey!! Watting for special");

           $(".email-subscribe").fadeOut("slow");  
           $(".email-subscribe").modal('hide');
           $("#tx-optin-form input[name=optin_mail]").val("");       

        } else {
          // alert("please try again later");
        }
      });

    };


});