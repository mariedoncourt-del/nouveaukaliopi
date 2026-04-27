<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url('/assets/vendor/jquery/jquery.min.js') ?>"></script>


<script src="<?php echo base_url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/vendor/jquery.easing/jquery.easing.min.js') ?>"></script>

<script>
// SECURITY P0.2 - Intercepteur global jQuery pour injecter le token CSRF
// dans toutes les requêtes AJAX (header X-CSRF-TOKEN + variable globale).
(function() {
    var tokenName = document.querySelector('meta[name="csrf-token-name"]');
    var tokenHash = document.querySelector('meta[name="csrf-token"]');
    if (tokenName && tokenHash && window.jQuery) {
        var name = tokenName.getAttribute('content');
        var hash = tokenHash.getAttribute('content');
        window.KALIOPI_CSRF = { name: name, hash: hash };
        jQuery.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': hash },
            beforeSend: function(xhr, settings) {
                if (settings.type && settings.type.toUpperCase() !== 'GET') {
                    if (typeof settings.data === 'string' && settings.data.indexOf(name + '=') === -1) {
                        settings.data += (settings.data ? '&' : '') + name + '=' + encodeURIComponent(hash);
                    }
                }
            }
        });
    }
})();
</script>

</body>

</html>