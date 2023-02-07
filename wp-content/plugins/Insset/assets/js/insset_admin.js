jQuery( document ).ready(function() {

    jQuery('.deleteButton').on('click', function(e){

        e.stopPropagation();
        e.preventDefault();

        var _this =jQuery(this);

        let data ={
            'action' : 'remove_newsletter',
            'security' : inssetscript.security,
            'idDelete' : jQuery(this).data('id'),
        }

        jQuery.post(ajaxurl, data, function(rs){
            _this.closest('tr').fadeOut('slow');
            jQuery('delete_confirmation').removeClass('hide');
            return false;
        })
    });

    return false;
});