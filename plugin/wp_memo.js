$.ajax({
    type: "post",
    url: "http://" + location.hostname + "/wp-admin/admin-ajax.php",
    data: {
        'action': "foo", //phpでフックした関数名
    }
})
.done( function( response ){
    console.log( response );
})
.fail( function(){
    console.log( 'fail' )
});