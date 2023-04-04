<?php

add_shortcode('FIN', array('Wl_Projet_Shortcodes_Form_Fin', 'display'));

class Wl_Projet_Shortcodes_Form_Fin {

    static public function display($atts) {


        $atts= '<form id="selection_fin">
                <fieldset>
                    <legend><?php _e("Your coords") ?></legend>
                    <div>
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom">
                        <label for="email">Mail</label>
                        <input type="text" id="email" name="email">
                    </div>
                </fieldset>
            </form>';

        return $atts;

    }

}