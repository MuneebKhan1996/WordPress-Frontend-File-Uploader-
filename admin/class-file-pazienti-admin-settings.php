<?php

class File_Pazienti_Admin_Settings{

    public function __construct(){
        add_action("admin_menu", array($this, "fp_add_new_menu_items"));
        add_action('wp_ajax_fp_file_delete_ajax' , array($this, 'fp_file_delete_ajax'));
		add_action('wp_ajax_nopriv_fp_file_delete_ajax' , array($this, 'fp_file_delete_ajax'));
    }

    public function fp_add_new_menu_items(){
        add_menu_page(
            esc_html__("File Pazienti"),
            esc_html__("File Pazienti"),
            "manage_options",
            "fp-options",
            array($this, "fp_admin_menu_item"),
            "dashicons-plus-alt",
            100
        );
    }

    public function fp_admin_menu_item(){
            
        $res = $wpdb->get_results("select p1.post_content, p1.post_name, p1.post_mime_type, p1.guid
            FROM {$wpdb->posts} p1
            WHERE p1.post_type LIKE 'attachment' AND p1.post_mime_type LIKE 'application/msword' OR p1.post_mime_type LIKE  'application/vnd.openxmlformats-officedocument.wordprocessingm' OR p1.post_mime_type LIKE 'application/pdf'
        ");

        $path = wp_upload_dir()['path'];


        echo '<h2>File Pazienti</h2>';

        echo '<div class="fp_table_wrap">';
        echo '<table class="fb_table">';
        echo '  <head>';
        echo '      <th>';
        echo '          Patient Name';
        echo '      </th>';
        echo '      <th>';
        echo '          File Name';
        echo '      </th>';
        echo '      <th>';
        echo '          Download File';
        echo '      </th>';
        echo '      <th>';
        echo '          Select';
        echo '      </th>';
        echo '  </head>';
        echo '  <body>';

        foreach ( $res as $key => $value ){
            $value = (array)$value;
            $user_name = $value['post_content'];
            echo '<tr>';
            echo '  <td>'.$value['post_content'].'</td>';
            echo '  <td>'.$value['post_name'].'</td>';
            echo '  <td><a href="'.$value['guid'].'" target="_blank"><button>Download</button></a></td>';
            echo '  <td><input type="checkbox" name="fp_files" value="'.$value["post_name"].'" /></td>';
            echo '</tr>';            
        }

        echo '  </body>';
        echo '</table>';
        echo '</div>';
        echo '<br />';
        echo '<br />';
        echo '<div class="fp_delete_button_wrap">';
        echo '<button class="btn btn-danger" id="fp-delete-button">Delete</button>';
        echo '</div>';
    }

    public function fp_file_delete_ajax(){
        global $wpdb;
        $checked = $_REQUEST['checked'];

        for( $i = 0; $i < sizeof($checked); $i++){
            $wpdb->delete( $wpdb->posts, array( 'post_name' => $checked[$i] ));
        }

        echo $checked;
        die;
    }

}