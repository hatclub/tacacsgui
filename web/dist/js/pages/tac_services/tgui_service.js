
var tgui_service = {
  formSelector_add: 'form#addServiceForm',
  formSelector_edit: 'form#editServiceForm',
  select_cmd_add: '#addServiceForm .select_cmd_cisco',
  select_cmd_edit: '#editServiceForm .select_cmd_cisco',
  select_cmd_h3c_add: '#addServiceForm .select_cmd_h3c',
  select_cmd_h3c_edit: '#editServiceForm .select_cmd_h3c',
  select_cmd_junos_ao_add: '#addServiceForm .select_cmd_junos_ao',
  select_cmd_junos_ao_edit: '#editServiceForm .select_cmd_junos_ao',
  select_cmd_junos_do_add: '#addServiceForm .select_cmd_junos_do',
  select_cmd_junos_do_edit: '#editServiceForm .select_cmd_junos_do',
  select_cmd_junos_ac_add: '#addServiceForm .select_cmd_junos_ac',
  select_cmd_junos_ac_edit: '#editServiceForm .select_cmd_junos_ac',
  select_cmd_junos_dc_add: '#addServiceForm .select_cmd_junos_dc',
  select_cmd_junos_dc_edit: '#editServiceForm .select_cmd_junos_dc',
  init: function() {
    var self = this;

    this.csvParser = new tgui_csvParser(this.csv);

    tgui_sortable.init();

    /*Select2 Cisco CMD Set*/
    this.cmdSelect2 = new tgui_select2({
      ajaxUrl : API_LINK+"tacacs/cmd/list/",
      template: this.selectionTemplate_cmd,
      add: this.select_cmd_add,
      edit: this.select_cmd_edit,
    });
    $(this.select_cmd_add).select2(this.cmdSelect2.select2Data());
    $(this.select_cmd_edit).select2(this.cmdSelect2.select2Data());
    /*Select2 Cisco CMD Set*///END
    /*Select2 H3C CMD Set*/
    this.cmd_h3cSelect2 = new tgui_select2({
      ajaxUrl : API_LINK+"tacacs/cmd/list/",
      template: this.selectionTemplate_cmd,
      add: this.select_cmd_h3c_add,
      edit: this.select_cmd_h3c_edit,
    });
    $(this.select_cmd_h3c_add).select2(this.cmd_h3cSelect2.select2Data());
    $(this.select_cmd_h3c_edit).select2(this.cmd_h3cSelect2.select2Data());
    /*Select2 H3C CMD Set*///END
    /*Select2 JunOS CMD Set*/
    this.cmd_junos_aoSelect2 = new tgui_select2({
      ajaxUrl : API_LINK+"tacacs/cmd/list/",
      template: this.selectionTemplate_cmd,
      extra: {type: 'junos'},
      add: this.select_cmd_junos_ao_add,
      edit: this.select_cmd_junos_ao_edit,
    });
    $(this.select_cmd_junos_ao_add).select2(this.cmd_junos_aoSelect2.select2Data());
    $(this.select_cmd_junos_ao_edit).select2(this.cmd_junos_aoSelect2.select2Data());
    /*Select2 JunOS CMD Set*///END
    /*Select2 JunOS CMD Set*/
    this.cmd_junos_doSelect2 = new tgui_select2({
      ajaxUrl : API_LINK+"tacacs/cmd/list/",
      template: this.selectionTemplate_cmd,
      extra: {type: 'junos'},
      add: this.select_cmd_junos_do_add,
      edit: this.select_cmd_junos_do_edit,
    });
    $(this.select_cmd_junos_do_add).select2(this.cmd_junos_doSelect2.select2Data());
    $(this.select_cmd_junos_do_edit).select2(this.cmd_junos_doSelect2.select2Data());
    /*Select2 JunOS CMD Set*///END
    /*Select2 JunOS CMD Set*/
    this.cmd_junos_acSelect2 = new tgui_select2({
      ajaxUrl : API_LINK+"tacacs/cmd/list/",
      template: this.selectionTemplate_cmd,
      extra: {type: 'junos'},
      add: this.select_cmd_junos_ac_add,
      edit: this.select_cmd_junos_ac_edit,
    });
    $(this.select_cmd_junos_ac_add).select2(this.cmd_junos_acSelect2.select2Data());
    $(this.select_cmd_junos_ac_edit).select2(this.cmd_junos_acSelect2.select2Data());
    /*Select2 JunOS CMD Set*///END
    /*Select2 JunOS CMD Set*/
    this.cmd_junos_dcSelect2 = new tgui_select2({
      ajaxUrl : API_LINK+"tacacs/cmd/list/",
      template: this.selectionTemplate_cmd,
      extra: {type: 'junos'},
      add: this.select_cmd_junos_dc_add,
      edit: this.select_cmd_junos_dc_edit,
    });
    $(this.select_cmd_junos_dc_add).select2(this.cmd_junos_dcSelect2.select2Data());
    $(this.select_cmd_junos_dc_edit).select2(this.cmd_junos_dcSelect2.select2Data());
    /*Select2 JunOS CMD Set*///END

    //console.log( $($(this.formSelector_edit + ' .nav-pills-edit > li > a')[0]).attr('href') );
    for (var u = 0; u < $(this.formSelector_edit + ' .nav-pills-edit > li > a').length; u++) {
      $($(this.formSelector_edit + ' .nav-pills-edit > li > a')[u]).attr('href', $($(this.formSelector_edit + ' .nav-pills-edit > li > a')[u]).attr('href') + '_edit');
    }
    for (var d = 0; d < $(this.formSelector_edit + ' .tab-content-edit > .tab-pane').length; d++) {
      $(this.formSelector_edit + '  .tab-content-edit > .tab-pane')[d].id = $(this.formSelector_edit + '  .tab-content-edit > .tab-pane')[d].id + '_edit';
    }

    /*cleare forms when modal is hided*/
    $('#addService').on('hidden.bs.modal', function(){
    	self.clearForm();
    })
    $('#editService').on('hidden.bs.modal', function(){
    	self.clearForm();
    })/*cleare forms*///end

    $('#addService').on('show.bs.modal', function(){
    	//self.cmdSelect2.preSelection(0, 'add');
    })
  },
  add: function() {
    console.log('Adding new service');
    var self = this;
    var formData = tgui_supplier.getFormData(self.formSelector_add);
    var ajaxProps = {
      url: API_LINK+"tacacs/services/add/",
      data: formData
    };//ajaxProps END

    formData.cisco_wlc_roles = tgui_device_patterns.pattern.cisco.wlc.get(self.formSelector_add);
    formData.h3c_cmd = ( tgui_device_patterns.pattern.h3c.general.cmd.get(self.formSelector_add) ) ? tgui_device_patterns.pattern.h3c.general.cmd.get(self.formSelector_add) : '';
    formData.cisco_rs_cmd = ( tgui_device_patterns.pattern.cisco.rs.cmd.get(self.formSelector_add) ) ? tgui_device_patterns.pattern.cisco.rs.cmd.get(self.formSelector_add) : '';
    formData.junos_cmd_ao = ( tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_add, 'ao') ) ? tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_add, 'ao') : '';
    formData.junos_cmd_do = ( tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_add, 'do') ) ? tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_add, 'do') : '';
    formData.junos_cmd_ac = ( tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_add, 'ac') ) ? tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_add, 'ac') : '';
    formData.junos_cmd_dc = ( tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_add, 'dc') ) ? tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_add, 'dc') : '';

    formData.cisco_rs_autocmd = (tgui_sortable.get( self.formSelector_add).separate.autocmd) ? tgui_sortable.get( self.formSelector_add).separate.autocmd.join(';;') : '';

    // console.log(formData);
    // return;
    ajaxRequest.send(ajaxProps).then(function(resp) {
      if (tgui_supplier.checkResponse(resp.error, self.formSelector_add)){
        return;
      }
      tgui_error.local.show({type:'success', message: "Service "+ $(self.formSelector_add + ' input[name="name"]').val() +" was added"})
      $("#addService").modal("hide");
      tgui_status.changeStatus(resp.changeConfiguration)
      self.clearForm();
      setTimeout( function () {dataTable.table.ajax.reload()}, 2000 );
    }).fail(function(err){
      tgui_error.getStatus(err, ajaxProps)
    })
    return this;
  },
  getService: function(id, name) {
    var self = this;
    var ajaxProps = {
      url: API_LINK+"tacacs/services/edit/",
      type: "GET",
      data: {
        "name": name,
        "id": id,
      }
    };//ajaxProps END

    ajaxRequest.send(ajaxProps).then(function(resp) {
      tgui_supplier.fulfillForm(resp.service, self.formSelector_edit);
      tgui_device_patterns.fill(resp.service, self.formSelector_edit);
      //$(self.formSelector_edit + ' input[name="priv-lvl-preview"]').val( ( parseInt(resp.service['priv-lvl']) > -1) ? resp.service['priv-lvl'] :  "Undefined");
      tgui_device_patterns.pattern.cisco.wlc.fill(resp.service.cisco_wlc_roles, self.formSelector_edit)
      tgui_device_patterns.pattern.cisco.rs.cmd.fill(resp.service.cisco_rs_cmd, self.formSelector_edit)
      tgui_device_patterns.pattern.junos.general.cmd.fill(resp.service.junos_cmd_ao, self.formSelector_edit, 'ao')
      tgui_device_patterns.pattern.junos.general.cmd.fill(resp.service.junos_cmd_do, self.formSelector_edit, 'do')
      tgui_device_patterns.pattern.junos.general.cmd.fill(resp.service.junos_cmd_ac, self.formSelector_edit, 'ac')
      tgui_device_patterns.pattern.junos.general.cmd.fill(resp.service.junos_cmd_dc, self.formSelector_edit, 'dc')
      $(self.formSelector_edit + ' [name="cisco_rs_autocmd"]').val(resp.service.cisco_rs_autocmd);
      tgui_device_patterns.pattern.cisco.rs.autocmd.fill(resp.service.cisco_rs_autocmd, self.formSelector_edit);
      tgui_device_patterns.pattern.h3c.general.cmd.fill(resp.service.h3c_cmd, self.formSelector_edit)
      $( ".select2-selection__rendered" ).sortable();
      $( ".select2-selection__rendered" ).disableSelection();
      $('#editService').modal('show')
    }).fail(function(err){
      tgui_error.getStatus(err, ajaxProps)
    })
  },
  edit: function() {
    console.log('Editing service');
    var self = this;
    var formData = tgui_supplier.getFormData(self.formSelector_edit, true);
    delete(formData.cisco_wlc_roles);
    if ( tgui_device_patterns.pattern.cisco.wlc.diff(self.formSelector_edit) ) {
      //console.log( tgui_device_patterns.pattern.cisco.wlc.get(self.formSelector_edit) );
      formData.cisco_wlc_roles = tgui_device_patterns.pattern.cisco.wlc.get(self.formSelector_edit);
    }
    if ( tgui_device_patterns.pattern.cisco.rs.cmd.diff(self.formSelector_edit) ){
      //console.log(tgui_device_patterns.pattern.cisco.rs.cmd.get(self.formSelector_edit));
      formData.cisco_rs_cmd = tgui_device_patterns.pattern.cisco.rs.cmd.get(self.formSelector_edit)
    }
    if ( tgui_device_patterns.pattern.cisco.rs.autocmd.diff(tgui_sortable.get( self.formSelector_edit).separate.autocmd, self.formSelector_edit) ){
      formData.cisco_rs_autocmd = ( tgui_sortable.get( self.formSelector_edit).separate.autocmd ) ? tgui_sortable.get( self.formSelector_edit).separate.autocmd.join(';;') : '';
    }
    if ( tgui_device_patterns.pattern.h3c.general.cmd.diff(self.formSelector_edit) ){
      //console.log(tgui_device_patterns.pattern.cisco.rs.cmd.get(self.formSelector_edit));
      formData.h3c_cmd = tgui_device_patterns.pattern.h3c.general.cmd.get(self.formSelector_edit)
    }
    if ( tgui_device_patterns.pattern.junos.general.cmd.diff(self.formSelector_edit, 'ao') ){
      formData.junos_cmd_ao = tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_edit, 'ao')
    }
    if ( tgui_device_patterns.pattern.junos.general.cmd.diff(self.formSelector_edit, 'do') ){
      formData.junos_cmd_do = tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_edit, 'do')
    }
    if ( tgui_device_patterns.pattern.junos.general.cmd.diff(self.formSelector_edit, 'ac') ){
      formData.junos_cmd_ac = tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_edit, 'ac')
    }
    if ( tgui_device_patterns.pattern.junos.general.cmd.diff(self.formSelector_edit, 'dc') ){
      formData.junos_cmd_dc = tgui_device_patterns.pattern.junos.general.cmd.get(self.formSelector_edit, 'dc')
    }
    //formData.cisco_rs_autocmd = tgui_sortable.get( self.formSelector_edit).separate.autocmd.join(';;');
    var ajaxProps = {
      url: API_LINK+"tacacs/services/edit/",
      type: 'POST',
      data: formData
    };//ajaxProps END

    if ( ! tgui_supplier.checkChanges(ajaxProps.data, ['id']) ) return false;

    ajaxRequest.send(ajaxProps).then(function(resp) {
      if (tgui_supplier.checkResponse(resp.error, self.formSelector_edit)){
        return;
      }
      tgui_error.local.show({type:'success', message: "Service "+ $(self.formSelector_edit + ' input[name="name"]').val() +" was edited"})
      $("#editService").modal("hide");
      tgui_status.changeStatus(resp.changeConfiguration)
      self.clearForm();
      setTimeout( function () {dataTable.table.ajax.reload()}, 2000 );
    }).fail(function(err){
      tgui_error.getStatus(err, ajaxProps)
    })
    return this;
  },
  delete: function(id, name, flag) {
    id = id || 0;
    flag = (flag !== undefined) ? false : true;
    name = name || 'undefined';
    if (flag && !confirm("Do you want delete '"+name+"'?")) return;
    var ajaxProps = {
      url: API_LINK+"tacacs/services/delete/",
      data: {
        "name": name,
        "id": id,
      }
    };//ajaxProps END
    ajaxRequest.send(ajaxProps).then(function(resp) {
      if( parseInt(resp.result) != 1) {
        tgui_error.local.show( {type:'error', message: "Oops! Unknown error appeared :("} ); return;
      }
      tgui_error.local.show({type:'success', message: "Service "+ name +" was deleted"})
      tgui_status.changeStatus(resp.changeConfiguration)
      setTimeout( function () {dataTable.table.ajax.reload()}, 2000 );
    }).fail(function(err){
      tgui_error.getStatus(err, ajaxProps)
    })
    return this;
  },
  csv: {
    columnsRequired: ['name'],
    fileInputId: '#csv-file',
    ajaxLink: 'tacacs/services/add/',
    ajaxItem: 'services',
    outputId: '#csvParserOutput',
    ajaxHandler: function(resp,index){
      var item = 'service';
      if (resp.error && resp.error.status){
        var error_message = '';
        for (v in resp.error.validation){
          if (!(resp.error.validation[v] == null)){
            for (num in resp.error.validation[v]){
              error_message+='<p class="text-danger">'+resp.error.validation[v][num]+'</p>';
            }
            this.csvParserOutput({tag: error_message, response: index});
          }
        }
      }
      if (resp[item] && resp[item].name) {
        this.csvParserOutput({tag: '<p class="text-success">Service <b>'+ resp[item].name + '</b> was added!</p>', response: index});
        tgui_status.changeStatus(resp.changeConfiguration)
      }
      this.csvParserOutput({tag: '<hr>'});
    },
    finalAnswer: function() {
      this.csvParserOutput({message: 'End of CSV file. Reload database.'})
      setTimeout( function () {dataTable.table.ajax.reload()}, 2000 );
    }
  },
  selectionTemplate_cmd: function(data){
    var output='';//'<div class="selectCmdOption">';
      output += '<text>'+data.text+'</text>';
      //output += '</div>'
    return output;
  },
  clearForm: function() {
    tgui_supplier.clearForm();
    /*---*/
    $('.nav.nav-tabs a[href="#general_info"]').tab('show');//select first tab
  	$('.nav.nav-tabs a[href="#general_info_edit"]').tab('show');//select first tab
    //console.log($('.nav-pills li a[data-init="true"]'));
  	$('.nav-pills li a[data-init="true"]').tab('show');//select first pills
    //tgui_device_patterns.pattern.cisco.wlc.clear();
    tgui_device_patterns.clear();
  }
}

// var service_templates = {
//   cisco: {
//     wlc: {
//       right: function(o) {
//         var formId = '#' + $($(o).closest('form')).attr('id');
//         $(formId + ' [name="cisco_wlc_roles_selected"]').append($(formId + ' [name="cisco_wlc_roles"] option:selected'));
//       },
//       left: function(o) {
//         var formId = '#' + $($(o).closest('form')).attr('id');
//         $(formId + ' [name="cisco_wlc_roles"]').append($(formId + ' [name="cisco_wlc_roles_selected"] option:selected'));
//       },
//       clear: function() {
//         $('[name="cisco_wlc_roles_selected"]').empty();
//         $('[name="cisco_wlc_roles"]').empty().append('<option value="0">ALL (0)</option>' +
//         '<option value="2">LOBBY (2)</option>'+
//         '<option value="4">MONITOR (4)</option>'+
//         '<option value="8">WLAN (8)</option>'+
//         '<option value="10">CONTROLLER (10)</option>'+
//         '<option value="20">WIRELESS (20)</option>'+
//         '<option value="40">SECURITY (40)</option>'+
//         '<option value="80">MANAGEMENT (80)</option>'+
//         '<option value="100">COMMANDS (100)</option>');
//       }
//     }
//   }
// }
