var ClientSupport = function(config) {
    config = config || {};
ClientSupport.superclass.constructor.call(this,config);
};
Ext.extend(ClientSupport,Ext.Component,{
    page:{},
    window:{},
    grid:{},
    tree:{},
    panel:{},
    combo:{},
    config: {},
    supportWindow: function() {
        var supportWindow = MODx.load({
            xtype: 'clientsupport-window-support'
            ,listeners: {
                'success': {fn:function() { console.log('yay') },scope:this}
            }
        });
        supportWindow.show();
        console.log(ClientSupport.config.connectorUrl);
    }
});
Ext.reg('clientsupport',ClientSupport);
ClientSupport = new ClientSupport();

ClientSupport.window.Support = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('clientsupport.help')
        ,closeAction: 'close'
        ,width: 650
        ,modal: true
        ,cls: 'clientsupport'
        ,url: ClientSupport.config.connectorUrl
        ,action: 'mgr/support/send'
        ,labelAlign: 'left'
        ,labelWidth: 160
        ,cancelBtnText: _('clientsupport.form.cancel')
        ,saveBtnText: _('clientsupport.form.submit')
        ,fields: [{
            html: '<h2>'+_('clientsupport.header')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            html: '<p>'+_('clientsupport.help.description')+'</p>'
            ,border: true
            ,style: {
                padding: '5px 0 10px 0'
            }
        },{
            xtype: 'textfield'
            ,fieldLabel: _('clientsupport.name')
            ,name: 'name'
            ,anchor: '100%'
            ,height: 'auto'
            ,allowBlank: false
        },{
            xtype: 'textfield'
            ,fieldLabel: _('clientsupport.email')
            ,name: 'email'
            ,anchor: '100%'
            ,height: 'auto'
            ,allowBlank: false
        },{
            xtype: 'textfield'
            ,fieldLabel: _('clientsupport.problem')
            ,name: 'problem'
            ,anchor: '100%'
            ,height: 'auto'
            ,allowBlank: false
        },{
            xtype: 'label'
            ,text: _('clientsupport.problem.label')
            ,cls: 'desc-under'
            ,style: {
                paddingLeft: '165px'
            }
        },{
            xtype: 'textarea'
            ,fieldLabel: _('clientsupport.problem.description')
            ,name: 'description'
            ,anchor: '100%'
            ,height: 120
        },{
            xtype: 'label'
            ,text: _('clientsupport.notice')
            ,cls: 'desc-under'
            ,style: {
                padding: '5px 0 10px 0'
            }
        }]
    });
    ClientSupport.window.Support.superclass.constructor.call(this,config);
};
Ext.extend(ClientSupport.window.Support,MODx.Window);
Ext.reg('clientsupport-window-support',ClientSupport.window.Support);