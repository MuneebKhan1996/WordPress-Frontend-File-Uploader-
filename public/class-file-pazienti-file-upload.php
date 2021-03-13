<?php 

class File_Pazienti_File_Upload{
    public function __construct(){
        add_shortcode('file-pazienti', array($this, 'fp_file_upload_shortcode'));
        add_action( 'template_redirect', array($this, 'fp_file_store' ));
    }

    public function fp_file_upload_shortcode(){
        $output  ='<form method="post" enctype="multipart/form-data">';
        $output .=' <h4>Scegli il documento da caricare</h4><br>';
        $output .=' <div class="fp-input-details">';
        $output .='     <label>Inserisci il tuo nome</label>';
        $output .='     <input type="text" id="fp-user-name" name="fp_user_name" class="fp_user_name" required/> <br>';
        $output .=' </div>';
        $output .=' <div class="fp-input-details">';
        $output .='     <input type="file" name="fileToUpload[]" id="fileToUpload" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingm, application/pdf" multiple/><br>';
        $output .=' </div>';
        $output .=' <div class="fp-input-details">';
        $output .='     <input type="submit" name="submit" id="fp-submit" value="Upload File" name="submit" />';
        $output .=' </div>';
        $output .='</form>';
        return $output;
    }

    public function fp_file_store(){

        $upload_overrides = array( 'test_form' => false );
        if(isset($_FILES['fileToUpload'])){
            $files = $_FILES['fileToUpload'];
            if (strlen($_FILES['fileToUpload']['error'][0] > 0) ){
                echo 'Muneeb';
            } else {
                if ( $_FILES ) {
                    $files = $_FILES['fileToUpload'];
                    foreach ($files['name'] as $key => $value) {
                        if ($files['name'][$key]) {
                            $file = array(
                                'name'     => $files['name'][$key],
                                'type'     => $files['type'][$key],
                                'tmp_name' => $files['tmp_name'][$key],
                                'error'    => $files['error'][$key],
                                'size'     => $files['size'][$key]
                            );
                            $_FILES = array("fileToUpload" => $file);
                            foreach ($_FILES as $file => $array) {
                                $this->fp_file_store_single($file, $_POST['fp_user_name']);
                            }
                        }
                    }
                }
            }
        }
        
    }

    public function fp_file_store_single($file, $name){

        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
    
        $check = media_handle_upload($file, 0, array('post_content' => $name));
        
    }
}