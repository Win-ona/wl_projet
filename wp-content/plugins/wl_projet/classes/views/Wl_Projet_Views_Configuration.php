<?php

class Wl_Projet_Views_Configuration {

    public function display(){

        $configs = Wl_Projet_Crud_Index::getConfiguration();

        ?>

        <div class="wrap" id="wl_projet_param_update">
            <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>

            <div class="notice notice-info notice-alt is-dismissible hide update-message">
                <p><?php _e('Mise à jour effectuée avec succès !'); ?></p>
            </div>
            <form>
                <label for="pays">Choisissez les pays qui doivent être disponibles: </label>
                <div>
                    <select name="pays" id="pays" multiple>
                        <?php foreach ($configs as $config): ?>
                            <option value="<?php print $config['id'] ?>" <?php if ($config['disponibilité'] == 1) print 'selected';?> > <?php print $config['pays'] ?>  </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <button class="button button-primary left update" id="updateButton">
                        <?php _e('Update'); ?>
                    </button>
                </div>
            </form>
        </div>
<?php
    }
}