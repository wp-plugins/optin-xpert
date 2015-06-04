(function($) {


$(document).ready(function(){

  	$("#lightbox-layout").imagepicker();
  	$("#flyer-layout").imagepicker();
  	$("#stickytop-layout").imagepicker();

    var layoutCustom = function(){
        var addon = $("#layout_custom").find("option:selected").attr("data-addon");
        $("tr.addon-settings").addClass("hide");
        $("tr[data-addon="+addon+"]").removeClass('hide');
    };

  	$(document).on('change', '#layout_custom', layoutCustom);
    layoutCustom();


  	$(document).on('change', '#optin_type_hook', function(){
		var addon_layout = $(this).find("option:selected").attr("data-addon-layout");
		$("tr.addon-settings-layout").addClass("layout-hide");
		$("tr[data-addon-layout="+addon_layout+"]").removeClass('layout-hide');
	});

	$('tr.addon-settings-layout.'+layout_style).removeClass('layout-hide');

});


$(function() {
  $('#post_id, #page_id ').selectize({});
});



// $(document).on('keyup', '#editor_input', function(){
// 	alert('sd');
// });


jQuery(document).ready(function($){
    // Prepare the variable that holds our custom media manager.
    var tgm_media_frame;
    
    // Bind to our click event in order to open up the new media experience.
    $(document.body).on('click.tgmOpenMediaManager', '.tx-open-media', function(e){
        // Prevent the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( tgm_media_frame ) {
            tgm_media_frame.open();
            return;
        }

        /**
         * The media frame doesn't exist let, so let's create it with some options.
         *
         * This options list is not exhaustive, so I encourage you to view the
         * wp-includes/js/media-views.js file to see some of the other default
         * options that can be utilized when creating your own custom media workflow.
         */
        tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
            /**
             * We can pass in a custom class name to our frame, so we do
             * it here to provide some extra context for styling our
             * media workflow. This helps us to prevent overwriting styles
             * for other media workflows.
             */
            className: 'media-frame tgm-media-frame',

            frame: 'select',

            /**
             * We can determine whether or not we want to allow users to be able
             * to upload multiple files at one time by setting this parameter to
             * true or false. It defaults to true, but we only want the user to
             * upload one file, so let's set it to false.
             */
            multiple: false,

            /**
             * We can set a custom title for our media workflow. I've localized
             * the script with the object 'tgm_nmp_media' that holds our
             * localized stuff and such. Let's populate the title with our custom
             * text.
             */
            title: 'Select Your image',

            /**
             * We can force what type of media to show when the user views his/her
             * library. Since we are uploading an image, let's limit the view to
             * images only.
             */
            library: {
                type: 'image'
            },

           
            button: {
                text:  'Upload Image'
            }
        });

        
        tgm_media_frame.on('select', function(){
            // Grab our attachment selection and construct a JSON representation of the model.
            var media_attachment = tgm_media_frame.state().get('selection').first().toJSON();
           // console.log(tgm_media_frame.state());
            // Send the attachment URL to our custom input field via jQuery.
            //$('#tx-new-media-image').val(JSON.stringify(media_attachment.url));
            $('#tx-new-media-image').val(media_attachment.url);
        });

        // Now that everything has been set, let's open up the frame.
        tgm_media_frame.open();
    });
});
	
}(jQuery));