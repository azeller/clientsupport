var ClientSupport = function(config) {
    config = config || {};
ClientSupport.superclass.constructor.call(this,config);
};
Ext.extend(ClientSupport,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('clientsupport',ClientSupport);
ClientSupport = new ClientSupport();