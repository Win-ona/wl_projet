jQuery( document ).ready(function() {

    jQuery("#updateButton").click(function (e)
    {
        e.stopPropagation();
        e.preventDefault();

        const datas =
            {
                action: "changeDisponibility",
                security: Wlprojetscript.security,
                idDisponible: jQuery("#pays").val(),
            };

        jQuery.post(ajaxurl, datas, function (rs)
        {
            jQuery(".is-dismissible").show("slow");

            setTimeout(() => {
                jQuery(".is-dismissible").hide("slow");
            }, "4500");
            return false;
        });
    })

    jQuery(".accessible_majeur").change(function (e)
    {
        e.stopPropagation();
        e.preventDefault();

        var _this = jQuery(this);
        let datas;

        if(this.checked)
            datas =
                {
                    'action': "changeAccessibility",
                    'security': Wlprojetscript.security,
                    'updateAccess':  jQuery(this).data('id'),
                    'valueAccess' : 1
                };
        else if(!(this.checked))
            datas =
                {
                    'action': "changeAccessibility",
                    'security': Wlprojetscript.security,
                    'updateAccess':  jQuery(this).data('id'),
                    'valueAccess' : 0
                };


        jQuery.post(ajaxurl, datas, function (rs)
        {
            jQuery(".is-dismissible").show("slow");

            setTimeout(() => {
                jQuery(".is-dismissible").hide("slow");
            }, "4500");
            return false;
        });
    })

    jQuery(".note_country").change(function (e)
    {
        e.stopPropagation();
        e.preventDefault();

        var _this = jQuery(this);

        const datas =
            {
                'action': "changeNote",
                'security': Wlprojetscript.security,
                'idNote':  jQuery(this).data('id'),
                'valueNote': jQuery(this).val()
            };

        jQuery.post(ajaxurl, datas, function (rs)
        {
            jQuery(".is-dismissible").show("slow");

            setTimeout(() => {
                jQuery(".is-dismissible").hide("slow");
            }, "4500");
            return false;
        });
    })

});