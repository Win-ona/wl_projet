jQuery( document ).ready(function() {

    jQuery('#inscription_prospect').on('submit', function (e) {

        e.stopPropagation();
        e.preventDefault();

        let formData = new FormData();
        formData.append('action', 'prospectsInscription');
        formData.append('security', Wlprojetscript.security);

        jQuery('#inscription_prospect').find('input, textarea, select').each(function (i) {
            var id = jQuery(this).attr('id');
            if (typeof id !== 'undefined')
                formData.append(id, jQuery(this).val());
        });

        jQuery("#loading").show();

        jQuery.ajax({
            url: Wlprojetscript.ajax_url,
            xhrFields: {
                withCredentials: true
            },
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            success: function (rs, textStatus, jqXHR)
            {

                //aller à la page suivante
                window.sessionStorage.setItem("Authorisation", "step1,step2");
                window.location = "http://localhost/wordpress/wordpress/2023/03/29/formulaire-de-selection-pays/";
            },
        });
    })


    //boucle for pour passer de du pays selectionné 1 au pays sélectioné 5
    for (let i = 1; i < 5; i++) {
        jQuery('#Wlprojetscript' + i).change(() => {
            jQuery('#Wlprojetscript' + (i + 1) + "_container").removeClass(
                "disable-select-pays"
            );
            //bouton pays 1/2/3/4/5
            if (i == 1)
                jQuery('#Wl_Projet_pays_selectionnes-submit').removeClass(
                    "disable-select-pays"
                );
        });
    }

    //Ajax du formulaire des pays sélectionnés
    jQuery('#Wl_Projet_pays_selectionnes').submit(function (e) {
        e.stopPropagation();
        e.preventDefault();

        let formData = new FormData();
        formData.append("action", "Wl_Projetselect_pays");
        formData.append("security", Wlprojetscript.security);

        jQuery('#Wl_Projet_pays_selectionnes').find('input, select').each(function (i) {
            let id = jQuery(this).attr("id");
            if (typeof id !== "undefined") formData.append(id, jQuery(this).val());
        });


        jQuery('#hd-loading-container').show();


        jQuery.ajax(
            {
                url: Wlprojetscript.ajax_url,
                xhrFields:
                    {
                        withCredentials: true,
                    },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: "post",
                success: function (rs, textStatus, jqXHR) {

                    window.sessionStorage.setItem("Authorisation", "step1,step2,step3");
                    window.location.replace("http://localhost/wordpress/wordpress/2023/03/27/formulaire-dinscription/");

                    return false;
                },
            });
    });
});


