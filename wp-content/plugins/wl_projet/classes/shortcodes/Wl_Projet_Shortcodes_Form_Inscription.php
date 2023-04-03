<?php
add_shortcode('INSCRIPTION', array('Wl_Projet_Shortcodes_Form_Inscription', 'display'));

class Wl_Projet_Shortcodes_Form_Inscription {

    static public function display($atts) {


        $atts= '<form id="inscription_prospect">
                <fieldset>
                    <legend><?php _e("Your coords") ?></legend>
                    <div>
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom">
                        <label for="email">Mail</label>
                        <input type="text" id="email" name="email">
                        <label for="sexe">Sexe</label>
                        <select name="sexe" id="sexe" required="required">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                        </select>
                        <label for="dateNaissance">Date de Naissance</label>
                        <input type="date" id="dateNaissance" name="dateNaissance">
                        <button id="btn">Submit</button>
                    </div>
                </fieldset>
            </form>';

        return $atts;

    }

}