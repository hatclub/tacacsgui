<h4>High Availability Settings</h4>
<div class="box box-solid">
  <div class="box-body">
    <form id="haForm">
      <!--<p> <b>Status:</b> <text>Not-Configured</text> </p>-->
    <div class="row">
      <div class="col-sm-3">
        <div class="form-group role">
          <label>Select Role</label>
          <select class="form-control" placeholder="Select Role" name="role" data-type="input" data-pickup="true" onchange="$('.ha_conf').hide();$('.ha_conf_'+$(this).val()).show();">
            <option value="disabled">disabled</option>
            <option value="master">master</option>
            <option value="slave">slave</option>
          </select>
          <input type="hidden" name="role_native" value="">
          <input type="hidden" name="rootpw" value="" data-type="input" data-pickup="true">
          <input type="hidden" name="slave_id" value="" data-type="input" data-pickup="true">
        </div>
      </div>
      <div class="ha_conf ha_conf_master">
        <div class="col-sm-9">
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group psk_master">
                <label for="psk_master">Pre-Shared Key</label>
                <div class="input-group">
                  <input type="text" class="form-control psk_master" name="psk_master" data-type="input" data-default="" data-pickup="true" placeholder="Pre-Shared Key" value="" autocomplete="off">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-warning btn-flat" onclick="$('.ha_conf_master input.psk_master').val(tgui_supplier.random( 32 ))">Generate</button>
                  </div>
                  <!-- /btn-group -->
                </div>
                <input type="hidden" name="ha_psk_native" value="">
                <p class="text-muted">pre-shared key must be the same between all members of high availability</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-7">
              <div class="form-group interf_ip">
                <label>Listen Interface</label>
                <select class="form-control" placeholder="Select Interface" name="interf_ip" data-type="input" data-pickup="true">

                </select>
                <input type="hidden" name="interf_ip_native" value="">
              </div>
            </div>
          </div><!--.row-->
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group slaves_ip">
                <label for="slaves_ip">List of Slave's ip addresses</label>
                <textarea type="text" class="form-control" name="slaves_ip" data-type="input" data-default="" data-pickup="true" placeholder="Slaves ip addresses" value=""></textarea>
                <p class="help-block">e.g. 10.1.1.2,10.1.1.4</p>
              </div>
            </div>
          </div><!--.row-->
        </div>
      </div>
      <div class="ha_conf ha_conf_slave" style="display:none;">
        <div class="col-sm-9">
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group psk_slave">
                <label for="psk_slave">Pre-Shared Key</label>
                <input type="text" class="form-control" name="psk_slave" data-type="input" data-default="" data-pickup="true" placeholder="Pre-Shared Key" value="" autocomplete="off">
                <input type="hidden" name="psk_slave_native" value="">
                <p class="text-muted">pre-shared key must be the same between all members of high availability</p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group ipaddr_master">
                <label for="ipaddr_master">IP Address of Master</label>
                <input type="text" class="form-control" name="ipaddr_master" data-type="input" data-default="" data-pickup="true" placeholder="IP Address" value="" autocomplete="off">
                <input type="hidden" name="ha_masterip_native" value="">
                <p class="text-muted">pre-shared key must be the same between all members of high availability</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    <div class="row ha_save_log_div">
      <div class="col-xs-12">
        <button class="btn btn-flat btn-warning ladda-button" data-style="expand-right" onclick="tgui_apiHA.status(this)"><span class="ladda-label">Status</span></button>
        <button class="btn btn-flat btn-success" onclick="tgui_apiHA.save()">Save Settings</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <hr>
        <h4>HA Log...</h4>
<pre class="ha_save_log">Some debug info will appear here
</pre>
      </div>
    </div>
    <hr>
    <h4>List of HA Members</h4>
    <div class="table-responsive">
      <table class="table table-striped" name="ha_list">
        <tr>
          <td>Role</td>
          <td>Address</td>
          <td>Location</td>
          <td>Status</td>
          <td>Last Check</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="overlay">
    <i class="fa fa-refresh fa-spin"></i>
  </div>
</div>

<!--modal rootpw-->
<div class="modal modal-warning fade" id="modal-rootpw">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa fa-fw fa-exclamation-triangle"></i> MySQL root Password required!</h4>
      </div>
      <div class="modal-body">
        <form id="rootpwForm" onsubmit="return tgui_apiHA.rootpw()">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group rootpw has-error">
              <label for="rootpw">MySQL root Password</label>
              <input type="password" class="form-control" name="rootpw" placeholder="Enter root password">
              <p class="text-muted">type mysql root password</p>
            </div>
          </div>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" onclick="tgui_apiHA.rootpw(true)">Close</button>
        <button type="button" class="btn btn-outline" onclick="tgui_apiHA.rootpw()">Send</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!--modal rootpw-->
