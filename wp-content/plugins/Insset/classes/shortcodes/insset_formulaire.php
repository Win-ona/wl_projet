<?php

add_shortcode('FORMULAIRE', array('insset_formulaire', 'display'));


class insset_formulaire {

    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'addjs'), 0);
        return;
    }

    static function display($atts) {
        $atts= '<form id="winona">
                    <fieldset>
                        <legend><?php _e("Your coords") ?></legend>
                        <div>
                            <label for="firstname">Firstname</label>
                            <input type="text" id="firstname" name="firstname">
                            <label for="lastname">Lastname</label>
                            <input type="text" id="lastname" name="lastname">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email">
                            <label for="zipcode">zipcode</label>
                            <input type="text" id="zipcode" name="zipcode">
                        </div>
                    </fieldset>
                    <button id="btn">Submit</button>
                </form>';

return $atts;
    }

}