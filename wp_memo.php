<?php

function foo() {

    $ini      = parse_ini_file( /*iniファイル*/);
    $data     = getBar( /*URL*/ );
    $response = array();

    if ( !is_wp_error( $data ) ) {
        $response[ "rsp" ]  = WP_HTTP::OK;
        $response[ "body" ] = $data;
    } else {
        $response[ "rsp" ]  = $data->get_error_code();
        $response[ "body" ] = $data->get_error_message( $response[ "rsp" ] );
    }
    echo json_encode( $response );									//json形式で渡す
    die;
}

add_action( 'wp_ajax_foo' ,'foo' );			//ログインユーザー用フック
add_action( 'wp_ajax_nopriv_foo' ,'foo' );	//未ログインユーザー用フック

function getBar( $url ) {
    $response = wp_remote_get( $url ,array( 'timeout' => 20 ) );	//GETメソッドを送信する。
    if ( is_wp_error( $response ) ) {
        return $response;
    }
    $rsp = wp_remote_retrieve_response_code( $response ); 			//wp_remote系関数のレスポンスコードを取得する。
    if ( $rsp !== WP_Http::OK ) {
        $message = buzz;
        return new WP_Error( $rsp ,$message );
    }
    return wp_remote_retrieve_body( $response );					//bodyを取得
}

function setBar() {
    wp_enqueue_script( 'js' ,/*スクリプトへのパス*/ ,array( 'jquery' ) ,false ,true );	// wp_enqueue_script(シンボル ,ソースパス ,前提スクリプト ,ファイルのバージョン ,head{false}かbody{true}か );
    wp_enqueue_style( 'css' ,plugins_url( /*スタイルへのパス*/ ,__FILE__ ) );				//  wp_enqueue_style( シンボル ,ソースパス ,前提スタイル ,ファイルのバージョン ,メディア )
    $set = file_get_contents( __DIR__ . '/temp.html' );
    return $set;
}

add_shortcode( 'Bar' ,'setBar' );
