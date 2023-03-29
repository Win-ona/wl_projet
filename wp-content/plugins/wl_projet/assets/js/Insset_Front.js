jQuery( document ).ready(function() {

    jQuery('#winona').on('submit', function(e) {
        e.stopPropagation();
        e.preventDefault();
        
        let formData = new FormData();
        formData.append('action', 'insset_newsletter');
        formData.append('security', inssetscript.security);

        jQuery('#winona').find('input, textarea, select').each( function(i){
            var id = jQuery(this).attr('id');
            if (typeof id !== 'undefined')
                formData.append(id, jQuery(this).val());
        });

        jQuery("#loading").show();

        jQuery.ajax({
            url: inssetscript.ajax_url,
            xhrFields: {
                withCredentials: true
            },
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            success: function(rs, textStatus, jqXHR) {
                jQuery("#loading").hide();
                return false;
            }
        })
        
        return false;

    });

});