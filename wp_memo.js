$.ajax({
    type: "post",
    url: "http://" + location.hostname + "/wp-admin/admin-ajax.php",
    data: {
        'action': "foo", //php�Ńt�b�N�����֐���
    }
})
.done( function( response ){
    console.log( response );
})
.fail( function(){
    console.log( 'fail' )
});