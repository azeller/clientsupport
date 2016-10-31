<?php
switch ($modx->event->name) {
    case 'OnManagerPageBeforeRender':
        $clientsupport = $modx->getService('clientsupport', 'ClientSupport', $modx->getOption('clientsupport.core_path', null, $modx->getOption('core_path').'components/clientsupport/').'model/clientsupport/', array());
        if (!($clientsupport instanceof ClientSupport)) {
            return;
        }
        $assetsUrl = $modx->getOption('clientsupport.assets_url', null, $modx->getOption('assets_url', null, MODX_ASSETS_URL).'components/clientsupport/');

        if ($modx->user) {
            $name = $modx->user->get('username');
            $email = '';
            $profile = $modx->user->getOne('Profile');
            if ($profile) {
                $name = $profile->get('fullname');
                $email = $profile->get('email');
            }
        }
        $modx->regClientStartupHTMLBlock('<script type="text/javascript">
        Ext.onReady(function() {
            ClientSupport.config = '.$modx->toJSON($clientsupport->options).';
            ClientSupport.config.user_name = "'.$name.'";
            ClientSupport.config.user_email = "'.$email.'";
            ClientSupport.config.connector_url = "'.$clientsupport->options['connectorUrl'].'";
        });
        </script>');
        $modx->regClientCSS($assetsUrl.'css/mgr.css');
        $modx->regClientStartupScript($assetsUrl.'js/mgr/clientsupport.js');

        $modx->controller->addLexiconTopic('clientsupport:default');
        break;
}
return;
