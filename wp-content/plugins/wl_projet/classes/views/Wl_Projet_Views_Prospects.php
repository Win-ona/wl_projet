<?php

class Wl_Projet_Prospects
{
    public function display(){


        $Wp_Projet_Liste = new Wl_Projet_Prospects(); //création de la table prospects

        $tempscreen = get_current_screen();
        $this->_screen = $tempscreen->base;
?>
        <div class="wrap">

            <h1 class="wp-heading-inline"><?php print get_admin_page_title(); ?></h1>
            <hr class="wp-header-end" />

            <div class="notice notice-info notice-alt is-dismissible hide delete-confirmation">
                <p><?php _e('Updated done!'); ?></p>
            </div>

            <?php self::toolbar(); ?>

            <div class="wrap" id="list-table">

                <form id="list-table-form" method="post">
                    <?php
                    $page  = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRIPPED);
                    $paged = filter_input(INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT);
                    printf('<input type="hidden" name="page" value="%s" />', $page);
                    printf('<input type="hidden" name="paged" value="%d" />', $paged);
                    $Wp_Projet_Liste->prepare_items();
                    $Wp_Projet_Liste->display();
                    ?>
                </form>

            </div>
        </div>
    <?php
    }

    private function toolbar()
    {
    ?>
        <div>
            <form action="<?php print admin_url('admin-post.php'); ?>" method="post">
                <table>
                    <tbody>
                        <tr>
                            <?php if (defined('WL_PROJET_BASENAME')) : ?>
                                <td>
                                    <a href="<?php print plugins_url(WL_PROJET_BASENAME . '/classes/export/Wl_Insset_Export_XML.php'); ?>" class="button button-secondary">
                                        Export CSV
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
<?php

    }
}