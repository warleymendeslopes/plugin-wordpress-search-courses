<?php

/**
 * running all the necessary cdns for the plugin to work correctly
 */
   // wp_enqueue_script('hulled_jquery_search', 'https://code.jquery.com/jquery-3.6.0.slim.min.js');
    wp_enqueue_style('hulled_modal_search', plugins_url('assets/hulled_modal_search.css', __FILE__));


    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.slim.min.js','','',false);
    wp_enqueue_script('popper_ajax_search', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js','','',false);

    wp_enqueue_script('main_js_search', plugins_url('assets/js/main.js', __FILE__), '','', true);


/**
 * Funcao valida os requisitos para que o plugin funcione corretamente
 * 
 * Undocumented function
 *
 * @return void
 */
function hulled_init_plugin_search(){
    $config_json = hulled_search_return_config();
    if (version_compare(phpversion(), SEARCHPHPVERSION, '>=')) {    
        if( $config_json->ID == true) {
            include_once plugin_dir_path( __FILE__ ) . 'class-search-template-loader.php';  
            require_once plugin_dir_path( __FILE__ ) . 'api/piaget_services.php';
        }else{
            add_action( 'admin_notices', 'lytex_check_config_plugin' );
        }

    }else{
        add_action( 'admin_notices', 'lytex_check_version_php' );
    }
}
    
/**
 * Funcao exibe o erro de versao do PHP
 * 
 * Undocumented function
 *
 * @return void
 */
function lytex_check_version_php() {
    echo '<div class="notice notice-error is-dismissible"><p>' . sprintf( __( 'The minimum PHP version compatible with Lytex Pagamentos plugin is '.SEARCHPHPVERSION.'. Please, update your PHP version.', 'Hulled-plugins-search' )) . '</p></div>';
}


function lytex_check_config_plugin(){
    echo '<div class="notice notice-error is-dismissible"><p>' . sprintf( __( 'It seems that the plugin Search is not configured yet, for it to work correctly you need to enter your API credentials.', 'Hulled-plugins-search' )) . '</p></div>';
}


/**
 * creating admin panel menu
 * Undocumented function
 *
 * @return void
 */
function hulled_create_menu_admin(){
        add_menu_page( 
            'Search', 
            'Search', 
            'edit_posts', 
            'theme-settings', 
            'hulled_page_admin_search', 
            'dashicons-rest-api' 
            );
}
add_action('admin_menu', 'hulled_create_menu_admin');


/**
 * function responsible for calling the configuration page in the admin panel menu
 * Undocumented function
 *
 * @return void
 */
function hulled_page_admin_search(){
    require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
}


/**
 * Undocumented function
 *
 * @return void
 */
function hulled_search_courses(){
    $api = new PiagetService();
    $areas = $api->get_area();

    $meal_planner_template_loader = new Gamajo_Template_Loader();
    $data = array( 'foo' => 'pesquisar agora', 'areas' => $areas );

    $meal_planner_template_loader->set_template_data( $data );
    $meal_planner_template_loader->get_template_part( 'search' );
}
add_shortcode('search_courses', 'hulled_search_courses');


/**
 * create database plugin
 * Undocumented function
 *
 * @return void
 */
function hulled_create_local_database_search() {
    global $wpdb;
    $sql2 = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix ."hulled_config_search` (
    	`ID` INT(8) NOT NULL AUTO_INCREMENT, 
    	`chaveapi` VARCHAR(200) NOT NULL,
    	`cpfcnpj` VARCHAR(200) NOT NULL,
    	`email` VARCHAR(200) NOT NULL,
        `linkapi` VARCHAR(200) NOT NULL,
    	PRIMARY KEY (`id`)
    	)";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql2);
}
add_action( 'init', 'hulled_create_local_database_search' );


/**
 * retorna todos os dados de configuracao feitos no painel
 * do plugin
 *
 * @return mixed
 */
function hulled_search_return_config(){
    global $wpdb;
    $name_table = $wpdb->prefix . "hulled_config_search";
    $config = $wpdb->get_results($wpdb->prepare("SELECT * FROM  $name_table" ));
    $config_json = $config[0];
    return $config_json;
}


/**
 * usando o AJAX para listar os cursos de determinadas areas,
 * chamando  o template especifico e passando as informacoes vinda da api
 * Undocumented function
 *
 * @return void
 */
function hulled_search_list_course_per_area(){
    ob_start();
            echo "teste ajax ";
            $area = $_POST['area'];
            $meal_planner_template_loader = new Gamajo_Template_Loader();
            $data = array( 'area' => $area);
        
            $meal_planner_template_loader->set_template_data( $data );
            $meal_planner_template_loader->get_template_part( 'list-course-per-area' );

    $html = ob_get_clean();
    wp_send_json($html);
}
add_action('wp_ajax_hulled_search_list_course_per_area', 'hulled_search_list_course_per_area');
add_action('wp_ajax_nopriv_hulled_search_list_course_per_area', 'hulled_search_list_course_per_area');


/**
 * Retorna as certificadores para listagem de cursos
 * 
 * Undocumented function
 *
 * @return void
 */
function get_active_certifiers(){
    return 'Faculdade ÚNICA|Faculdade Prominas';
}



function ppr($data){
    echo "<pre>";
        print_r($data);
    echo "</pre>";
}