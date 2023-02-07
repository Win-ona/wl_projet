<?php

add_action('wp_enqueue_scripts', 'insset_scripts', -1);

function insset_scripts() {
    wp_enqueue_script('jquery-new', get_template_directory_uri() .'-child/assets/js/jquery.min.js', array(), '3.6.3', true);
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'-child/style.css' );
    wp_enqueue_style( 'materialize-style', get_template_directory_uri().'-child/assets/css/materialize.min.css' );
    wp_enqueue_style( 'materializet-style', get_template_directory_uri().'-child/assets/js/materialize.mis.js' );
    wp_enqueue_style( 'ghpages-style', get_template_directory_uri().'-child/assets/css/ghpages.css' );


}

add_action('wp_footer', 'loading_circle');

function loading_circle() {
    print '
        <div id="loading" class="row white">
            <div class="col s12">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-yellow">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    <div class="spinner-layer spinner-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="gap-patch">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}

?>