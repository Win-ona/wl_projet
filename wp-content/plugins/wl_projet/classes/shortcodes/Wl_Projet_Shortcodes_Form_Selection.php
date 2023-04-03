<?php

add_shortcode('SELECTION', array('Wl_Projet_Shortcodes_Form_selection', 'display'));

//classe pour faire un formulaire pour sélectionner les pays que l'utilisateur veut
class Wl_Projet_Shortcodes_Form_selection
{

    static function display($atts)
    {

        $Wl_Projet_Crud_Index = new Wl_Projet_Crud_Index();

        //récupèrer la valeur du résultat grace au crud pour le mettre dans la variable pays selectionnés
        $ListePays = $Wl_Projet_Crud_Index->getAge();
        $paysListe = "";


        foreach ($ListePays as $config) :
            $paysListe .= '<option value="' . $config['id'] . '">' . $config['pays'] . '</option>';
        endforeach;

        //fomulaire en html pour sélectionner les pays
        return "
            <script src=\"https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js\</script>
            <script id=\"Script_Modal\" type=\"text/x-handlebars-template\" src=\"".plugins_url(WL_PROJET_PLUGIN_NAME."/assets/Handlebars/Handlebars.hbs")."\"></script>
    
        <form id='Wl_Projet_pays_selectionnes'>
            
        <h3>Liste des pays</h3>
        
        // formulaire pour selectionner pays 1
        <div>
            <label >Selectionné votre pays</label>
            <select name='pays1' id='Wl_Projet_pays1' required='required'  style='display: block;'>
            <option > Veuillez sélectionner un pays </option>" . $paysListe . "
            </select>
        </div>

        // formulaire pour selectionner pays 2
        <div class='disable-select-pays' id='pays2_container'>
            <label >Selectionné votre pays</label>
            <select name='pays2' id='Wl_Projet_pays2'  style='display: block;'>
            <option> Veuillez sélectionner un pays </option> " . $paysListe . "
            </select>
        </div>

        // formulaire pour selectionner pays 3
        <div class='disable-select-pays' id='pays3_container'>
            <label>Selectionné votre pays</label>
            <select name='pays3' id='Wl_Projet_pays3'  style='display: block;'>
            <option >Veuillez sélectionner un pays</option> " . $paysListe . "
            </select>
        </div>

        // formulaire pour selectionner pays 4
        <div class='disable-select-pays' id='pays4_container'>
            <label> Selectionné votre pays</label>
            <select name='pays4' id='Wl_Projet_pays4'  style='display: block;'>
            <option> Veuillez sélectionner un pays  </option> " . $paysListe . "
           </select>
        </div>
        
        // formulaire pour selectionner pays 5
        <div class='disable-select-pays' id='pays5_container'>
            <label> Selectionné votre pays</label>
            <select name='pays5' id='Wl_Projet_pays5'  style='display: block;'>
            <option> Veuillez sélectionner un pays  </option> " . $paysListe . "
           </select>
        </div>

        
            <button class='disable-select-pays' id='Wl_Projet_pays_selectionnes-submit'>Validez mes choix</button>
        </form>
        
        <ul class='hd_pays_list_container'>
        </ul>
            <input type=\"button\" id=\"hd-form-final\" value=\"Oui,je suis d'accord\"></input>
            <div id='handlebarsModalBox'></div>

    ";

    }

}