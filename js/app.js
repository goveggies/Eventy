$( document ).ready(function() {
    $('#btn_video').click(function() {
      console.log('clicked');
      $(this).addClass('hidden');
      $('#btn_exitVideo').removeClass('hidden');
      $( "#video" ).append( "<video id='preview'></video>" );
        
        
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
            scanner.addListener('scan', function (content) {
            console.log('correctly scanned');
            $('#video').append("<p style='color:green'>" + content + "</p>");
                $('#btn_exitVideo').click();
            //$('#video video').remove();
            scanner.stop();
        });
        Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
        $('#video').append("<p style='color:red'> Pas de caméra trouvé. </p>");
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    });
    
    
    
    $('#btn_exitVideo').click(function() {
        console.log('exit ordered');
        $(this).addClass('hidden');
        $('#btn_video').removeClass('hidden');
        
        $('#video video').remove();
    })
    
    
    /*
    * Generate a QRCODE in JS.
    * Deprecated, now in PHP.
    */
    // $('#qrcode').qrcode("U83U8EU8DU89U89");

    
    
});
