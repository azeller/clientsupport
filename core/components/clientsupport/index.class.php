<?php
require_once dirname(__FILE__) . '/model/clientsupport/clientsupport.class.php';
/**
 * @package clientsupport
 */

abstract class ClientSupportBaseManagerController extends modExtraManagerController {
    /** @var ClientSupport $clientsupport */
    public $clientsupport;
    public function initialize() {
        $this->clientsupport = new ClientSupport($this->modx);

        $this->addCss($this->clientsupport->getOption('cssUrl').'mgr.css');
        $this->addJavascript($this->clientsupport->getOption('jsUrl').'mgr/clientsupport.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            ClientSupport.config = '.$this->modx->toJSON($this->clientsupport->options).';
            ClientSupport.config.connector_url = "'.$this->clientsupport->getOption('connectorUrl').'";
        });
        </script>');
        
        parent::initialize();
    }
    public function getLanguageTopics() {
        return array('clientsupport:default');
    }
    public function checkPermissions() { return true;}
}