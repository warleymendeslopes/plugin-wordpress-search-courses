
<?php
global $wpdb;
$name_table = $wpdb->prefix . "hulled_config_search";
$config_json = hulled_search_return_config();
if(!empty($_POST['submit_config_hulled_search'])):
    $data_config= array(
        'chaveapi' => $_POST['chaveapi'],
        'cpfcnpj'  => $_POST['cpf_cnpj_serach_hulled'],
        'email'    => $_POST['search_hulled_email'],
        'linkapi'  => $_POST['link_api_serach_hulled'],
    );
    
    if( $config_json->ID == true) {
        $wpdb->update($name_table,$data_config, array('ID' => $config_json->ID));
    }else{
        $wpdb->insert($name_table,$data_config);
        $my_id = $wpdb->insert_id;
    }
    header("Refresh:0");
endif;
?>
<div id="wpbody" role="main">
    <div class="wrap">

        <div class="title_search_hulled displayflex-hulled">
            <h1><?php echo esc_html('Search '); ?></h1> <?PHP echo  VERSIONPLUGINSEARCH; ?>
        </div>
        <form method="POST" novalidate="novalidate">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row"><label for="blogname">Chave API</label></th>
                        <td><input require name="chaveapi" type="text" class="regular-text hulled-input-admin-search" placeholder="63972bf80a0dd4000b80ca64" value="<?php echo $config_json->chaveapi; ?>"></td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="blogdescription">CPF/CNPJ</label></th>
                        <td><input require name="cpf_cnpj_serach_hulled" type="text" class="regular-text hulled-input-admin-search" placeholder="88398158808" value="<?php echo $config_json->cpfcnpj; ?>">
                            <p class="description" id="tagline-description">Deve-se inserir o CPF ou CNPJ do parceiro</p>
                        </td>
                    </tr>


                    <tr>
                        <th scope="row"><label for="siteurl">Link acesso API (URL)</label></th>
                        <td><input require name="link_api_serach_hulled" type="url" id="siteurl" placeholder="https://api-lyratec.institutoprominas.com.br" class="regular-text code hulled-input-admin-search" value="<?php echo $config_json->linkapi; ?>"></td>
                    </tr>


                    <tr>
                        <th scope="row"><label for="new_admin_email">Email</label></th>
                        <td><input require name="search_hulled_email" type="email" id="new_admin_email" aria-describedby="new-admin-email-description" placeholder="seuemail@gmail.com" class="regular-text ltr hulled-input-admin-search" value="<?php echo $config_json->email; ?>">
                            <p class="description" id="new-admin-email-description">Deve-se inserir o email de contato do parceiro.</strong></p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="submit"><input type="submit" name="submit_config_hulled_search" id="submit" class="button button-primary" value="Salvar alterações"></p>
        </form>
    </div>
</div>
