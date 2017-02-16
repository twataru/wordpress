$.ajax({
    type: "post",
    url: "http://" + location.hostname + "/wp-admin/admin-ajax.php",
    data: {
        'action': "foo", //phpでフックした関数名
    }
})
.done( function( response ){
    //JSON.parse( response ) でjs配列に変換
    console.log( response );
})
.fail( function(){
    console.log( 'fail' )
});