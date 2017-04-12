<?php
require_once dirname(dirname(__FILE__)) . '/index.class.php';
/**
 * Loads the home page.
 *
 * @package clientsupport
 * @subpackage controllers
 */
class ClientSupportHomeManagerController extends ClientSupportBaseManagerController
{
    public function process(array $scriptProperties = array())
    {
        return;
    }
    public function getPageTitle()
    {
        return $this->modx->lexicon('clientsupport');
    }
    public function loadCustomCssJs()
    {
        return;
    }

}