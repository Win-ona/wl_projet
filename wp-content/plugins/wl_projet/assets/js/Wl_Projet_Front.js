jQuery( document ).ready(function() {

    jQuery('#prospect_inscription').on('submit', function(e) {

        e.stopPropagation();
        e.preventDefault();

        let formData = new FormData();
        formData.append('action', 'prospectsInscription');
        formData.append('security', wlprojetscript.security);

        jQuery('#prospect_inscription').find('input, textarea, select').each( function(i){
            var id = jQuery(this).attr('id');
            if (typeof id !== 'undefined')
                formData.append(id, jQuery(this).val());
        });

        jQuery("#loading").show();

        jQuery.ajax({
            url: wlprojetscript.ajax_url,
            xhrFields: {
                withCredentials: true
            },
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            success: function(rs, textStatus, jqXHR) {
                console.log(rs);
                jQuery("#loading").hide();
                return false;
            }
        })

        return false


    });

});
