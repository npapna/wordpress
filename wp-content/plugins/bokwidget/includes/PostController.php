<?php



function do_something(){

    if( $_SERVER['REQUEST_METHOD']=='POST' ) {
        $fname = trim($_POST['firstname']);
        $lname = trim($_POST['lastname']);
        $email = trim($_POST['email']);

        $object = new stdClass();

        if( empty( $fname ) ){
            $object->firstname = "First name is required.";
        }
        if( empty( $lname) ){
            $object->lastname = "Last name is required.";
        }
        if( empty( $email ) ){
            $object->email = "Email is required.";
        }

        if(empty( $email ) || empty( $lname) || empty( $fname ) ){
            $object->status ="Failed";
        }else{
            $object->status ="Success";

            global $wpdb;
            $wpdb->insert('wp_register', array(
                'first_name' =>$fname,
                'last_name' =>$lname,
                'email' =>$email
            ));
        }
    }

    wp_send_json_success(array(
        'response' => $object
    ));

    // wp_create_user($_POST['username'],$_POST['password'], $_POST['email']);
}

