<?php

class Wl_Projet_Crud_Index
{
    static function getConfiguration()
    {
        global $wpdb;

        $table_name_pays = $wpdb->prefix . WL_PROJET_BASENAME .'_pays';

        //ajouter résultat dans la base de donnée
        $sql = "SELECT * FROM $table_name_pays";

        return $wpdb->get_results($sql, 'ARRAY_A');
    }
    static public function update_disponibility($idDisponible ){

        if (!$idDisponible)
            return;


        global $wpdb;

        $table_name_config = $wpdb->prefix . WL_PROJET_BASENAME . '_pays';

        $Pays_non_disponibleSql = "SELECT `id` FROM $table_name_config";
        $Pays_non_disponible = $wpdb->get_results($Pays_non_disponibleSql, 'ARRAY_A');


        if ($Pays_non_disponible)
            foreach ($Pays_non_disponible as $value)
                if($value !==$idDisponible)
                    $wpdb->update($table_name_config, array('disponibilité' => 0), array('id' => $value['id']));

        foreach ($idDisponible as $id)
            $wpdb->update($table_name_config, array('disponibilité' => 1), array('id' => $id));

        return "Mise à jour effectuée avec succès !";


    }

    static public function update_accessibility($updateAccessibility, $valueAccessibility){

        if(!$updateAccessibility && !$valueAccessibility)
            return;

        global $wpdb;

        $table_name_config = $wpdb->prefix . WL_PROJET_BASENAME . '_pays';

        if($updateAccessibility)
            $wpdb->update($table_name_config, array('accessible_majeur_uniquement' => $valueAccessibility), array('id' => $updateAccessibility));

        return "Mise à jour effectuée avec succès !";

    }

    public function update_note($idNote, $valueNote){

        if(!$idNote && !$valueNote)
            return;

        global $wpdb;

        $table_name = $wpdb->prefix . WL_PROJET_BASENAME . '_pays';

        if($idNote && $valueNote)
            $wpdb->update($table_name , array('note' => $valueNote), array('id' => $idNote));

        return "Mise à jour effectuée avec succès !";

    }

    public function ajout(){

        global $wpdb;

        $wpdb->insert($wpdb->prefix . WL_PROJET_BASENAME . '_prospects' , ['id'=>0] );
        $lastId = $wpdb->insert_id;
        return $lastId;

    }

    public function ajout_data($lastId, $cle, $valeur){

        global $wpdb;

        $table_name = $wpdb->prefix . WL_PROJET_BASENAME . '_prospectsdata';

        $wpdb->insert(
            $table_name,
            array(
                'id' => $lastId,
                'cle' => $cle,
                'valeur' => $valeur,
            )
        );

    }
    public static function getAge()
    {

        // il n'y as pas de système d'authentification donc on récupère toujours le premier prospect ( une nouvelle inscription dans le formulaire remplace la première ligne )
        global $wpdb;
        $table_prospects = $wpdb->prefix . WL_PROJET_BASENAME . '_prospectsdata';

        $sqlAge = "SELECT `valeur` FROM $table_prospects WHERE `id`=1 AND `cle`='dateNaissance'";
        $prospect = $wpdb->get_results($sqlAge, 'ARRAY_A');

        $dateNaissance = $prospect['0']['valeur'];
        $dateActuelle = date("Y-m-d");
        $dateDiff = date_diff(date_create($dateNaissance), date_create($dateActuelle));
        $age = $dateDiff->format('%y');

        if ($age >= 18) {
            // si le prospect est majeur
            $table_pays= $wpdb->prefix . WL_PROJET_BASENAME . '_pays';

            $sql = "SELECT * FROM $table_pays WHERE `disponibilité`=1 AND `accessibilité`=1";

            return $wpdb->get_results($sql, 'ARRAY_A');

        } else {

            // si le prospect est mineur
            $table_pays = $wpdb->prefix . WL_PROJET_BASENAME . '_pays';

            $sql = "SELECT * FROM $table_pays WHERE `disponibilité`=1 AND `accessibilité`=0";

            return $wpdb->get_results($sql, 'ARRAY_A');
        }
    }
}
