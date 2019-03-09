<!DOCTYPE html>
<!---->
<?php
///CONFIGURATION FILE///
require __DIR__ . '/config.php';
///PAGE VARIABLES///START
$PAGE_HEADER = 'MAVIS LDAP Auth';
$PAGE_SUBHEADER = 'MAVIS module that can auth user via LDAP';
$PAGE_TITLE = 'TacacsGUI';
$PAGE_SUBTITLE = 'MAVIS LDAP Auth';
$BREADCRUMB = array(
	'Home' => [
		'name' => 'MAVIS',
		'href' => '',
		'icon' => 'fa fa-cog',
		'class' => ''  //last item should have active class!!
	],
	'Tacacs' => [
		'name' => 'LDAP Auth',
		'href' => '',
		'icon' => 'fa fa-cog',
		'class' => 'active'  //last item should have active class!!
	],
);
///!!!!!////
$ACTIVE_MENU_ID=[900,920];
$ACTIVE_SUBMENU_ID=920;
///!!!!!////
///PAGE VARIABLES///END
?>
<html>

<?php
require __DIR__ . '/templates/header.php';
?>
<!--ADDITIONAL CSS FILES START-->

	<!-- iCheck -->
	<link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
<!--ADDITIONAL CSS FILES END-->
<?php

require __DIR__ . '/templates/body_start.php';

?>
<!--MAIN CONTENT START-->
<style>
.ldap-container {
	position: relative;
}
</style>
<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title">LDAP Settings</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
				<div class="form-group enabled">
					<label>MAVIS LDAP Module</label>
					<div class="checkbox icheck">
						<p class="empty-paragraph"></p>
			      <input class="bootstrap-toggle" name="enabled" data-type="checkbox" data-default="unchecked" data-pickup="true" data-toggle="toggle" type="checkbox" data-on="<i class='fa fa-check'></i> Enabled" data-off="<i class='fa fa-close'></i> Disabled" data-onstyle="success" data-offstyle="warning">
						<input type="hidden" name="enabled_native" value="">
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="ldap-container">
		<div class="disabled_shield"></div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group type">
					<label>LDAP Type</label>
					<select class="form-control" name="type" data-type="select" data-default="" data-pickup="true">
						<option value="microsoft" selected>Microsoft</option>
						<option value="openldap">OpenLDAP</option>
						<!-- <option value="tacacs_schema" disabled>Tacacs Schema</option> -->
					</select>
					<input type="hidden" name="type_native" value="">
					<p class="help-block">if you don't know what to choose leave it as default (first value)</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group group_selection">
					<label>User will manually select tacacs group</label>
					<div class="checkbox icheck">
						<p class="empty-paragraph"></p>
						<input class="bootstrap-toggle" name="group_selection" data-type="checkbox" data-default="checked" data-pickup="true" data-toggle="toggle" type="checkbox" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-close'></i> No" data-onstyle="success" data-offstyle="warning" checked>
						<input type="hidden" name="group_selection_native" value="">
					</div>
				</div>
			</div>
			<!-- <div class="col-sm-4">
				<div class="form-group scope">
					<label>LDAP Scope</label>
					<select class="form-control" name="scope" data-type="select" data-default="" data-pickup="true">
						<option value="sub" selected>sub</option>
						<option value="base">base</option>
						<option value="one">one</option>
					</select>
					<input type="hidden" name="scope_native" value="">
					<p class="help-block">if you don't know what to choose leave it as default (first value)</p>
                </div>
			</div> -->
			<div class="col-sm-4">
				<div class="form-group">
					<label>TLS Support</label>
					<div class="checkbox icheck">
						<label>
						<input type="checkbox" name="tls" data-type="checkbox" data-default="unchecked" data-pickup="true"> Use TLS
						</label>
						<input type="hidden" name="tls_native" value="">
					</div>
					<p class="help-block">by default unchecked</p>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group hosts">
					<label>LDAP Hosts</label>
					<input type="text" class="form-control" name="hosts" data-type="input" data-default="" data-pickup="true" placeholder="10.2.1.2, 10.2.3.2"/>
					<p class="help-block">comma-separated list of IP addresses or hostnames (<text class="text-warning">don't try to set port here</text>), e.g. <i>10.2.1.2, 10.2.3.2</i></p>
					<input type="hidden" name="hosts_native" value="">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group port">
					<label>Port</label>
					<input type="text" class="form-control" name="port" data-type="input" data-default="" data-pickup="true" placeholder="389"/>
					<p class="help-block">default 389, global catalog is 3268</p>
					<input type="hidden" name="port_native" value="">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group user">
					<label>LDAP User</label>
					<input type="text" class="form-control" name="user" data-type="input" data-default="" data-pickup="true" placeholder="LDAP User Name"/>
					<p class="help-block">user to use for LDAP bind if server doesn't permit anonymous searches, e.g. tacacs@example.com</p>
					<input type="hidden" name="user_native" value="">
        </div>
			</div>
			<div class="col-sm-4">
				<div class="form-group password">
					<label>LDAP Password</label>
					<input type="password" class="form-control" name="password" data-type="input" data-default="" data-pickup="true" placeholder="LDAP User Password"/>
					<p class="help-block">password for LDAP User</p>
					<input type="hidden" name="password_native" value="">
        </div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-sm-4">
				<div class="checkbox icheck password_hide">
					<label>
						<input type="checkbox" name="password_hide" data-type="checkbox" data-default="" data-pickup="true"> Hide password
					</label>
					<p class="help-block">if checked password of the LDAP user will be hided in the global configuration, checked by default</p>
					<input type="hidden" name="password_hide_native" value="">
				</div>
			</div>
		</div> -->
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group base">
					<label>LDAP Base</label>
					<input type="text" class="form-control" name="base" data-type="input" data-default="" data-pickup="true" placeholder="E.g. dc=domain,dc=name"/>
					<p class="help-block">base DN of your LDAP server, e.g. dc=domain,dc=name</p>
					<input type="hidden" name="base_native" value="">
	      </div>
			</div>
			<div class="col-sm-4">
				<div class="form-group filter">
					<label>LDAP Search Attribute</label>
					<input type="text" class="form-control" name="filter" data-type="input" data-default="" data-pickup="true" placeholder="E.g. sAMAccountName"/>
					<input type="hidden" name="filter_native" value="">
					<p class="help-block">LDAP search attribute, e.g. sAMAccountName</p>
        </div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-sm-4 memberOf">
				<div class="form-group">
					<label>Use attribute <code>memperOf</code></label>
					<div class="checkbox icheck memberOf">
						<label>
						<input type="checkbox" name="memberOf" data-type="checkbox" data-default="" data-pickup="true"> Use attribute <b>memperOf</b>
						</label>
					</div>
					<input type="hidden" name="memberOf_native" value="">
					<p class="help-block">use the memberOf attribute for determining group membership</p>
        </div>
			</div>
			<div class="col-sm-4">
				<div class="form-group group_prefix_flag">
					<label>Use AD Group Prefix</label>
					<div class="checkbox icheck group_prefix_flag">
						<label>
						<input type="checkbox" name="group_prefix_flag" data-type="checkbox" data-default="" data-pickup="true"> Use AD Group Prefix
						</label>
						<input type="hidden" name="group_prefix_flag_native" value="">
					</div>
					<p class="help-block">by default unchecked</p>
        </div>
			</div>
			<div class="col-sm-4">
				<div class="form-group group_prefix">
					<label>AD Group Prefix</label>
					<input type="text" class="form-control" name="group_prefix" data-type="input" data-default="" data-pickup="true" placeholder="tacacs"/>
					<p class="help-block">an AD group starting with this prefix will be used as the user's TACACS+ group membership. The value of AD_GROUP_PREFIX will be stripped from the group name</p>
					<input type="hidden" name="group_prefix_native" value="">
        </div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group cache_conn">
					<label>Cache Connection</label>
					<div class="checkbox icheck cache_conn">
						<label>
						<input type="checkbox" name="cache_conn" data-type="checkbox" data-default="" data-pickup="true"> Cache Connection
						</label>
						<input type="hidden" name="cache_conn_native" value="">
					</div>
					<p class="help-block">keep connection to LDAP server open</p>
        </div>
			</div>
			<div class="col-sm-4">
				<div class="form-group fallthrough">
					<label>FallThrough</label>
					<div class="checkbox icheck fallthrough">
						<label>
						<input type="checkbox" name="fallthrough" data-type="checkbox" data-default="" data-pickup="true"> FallThrough
						</label>
						<input type="hidden" name="fallthrough_native" value="">
					</div>
					<p class="help-block">if searching for the user in LDAP fails, try the next MAVIS module (if any)</p>
        </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group path">
					<label>MAVIS Module Path</label>
					<input type="text" class="form-control" name="path" data-type="input" data-default="" data-pickup="true" placeholder="Path"/>
					<input type="hidden" name="path_native" value="">
					<p class="help-block text-red">don't change it if you not sure, default -> /usr/local/lib/mavis/mavis_tacplus_ldap.pl</p>
        </div>
			</div>
		</div>
		</div>
	</div> -->
	<div class="tgui_expander">
		<div class="header">
			<h4><i class="fa fa-plus-square"></i> Advanced Settings </h4>
		</div>
		<div class="body">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group enable_login">
						<label for="enable_login">Enable password as Login</label><p class="empty-paragraph"></p>
						<input type="checkbox" class="form-control bootstrap-toggle" name="enable_login"  data-type="checkbox" data-default="unchecked" data-pickup="true" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-close'></i> No" data-onstyle="success" data-offstyle="warning" data-width="100">
						<input type="hidden" name="enable_login_native" data-type="input" data-default="">
						<p class="help-block">user can use your own ldap password to get privilege mode</p>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group pap_login">
						<label for="pap_login">PAP password as Login</label><p class="empty-paragraph"></p>
						<input type="checkbox" class="form-control bootstrap-toggle" name="pap_login"  data-type="checkbox" data-default="unchecked" data-pickup="true" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-close'></i> No" data-onstyle="success" data-offstyle="warning" data-width="100">
						<input type="hidden" name="pap_login_native" data-type="input" data-default="">
						<p class="help-block">user can use your own ldap password if pap password will require</p>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group message_flag">
						<label for="message_flag">Show default message</label><p class="empty-paragraph"></p>
						<input type="checkbox" class="form-control bootstrap-toggle" name="message_flag"  data-type="checkbox" data-default="unchecked" data-pickup="true" data-toggle="toggle" data-on="<i class='fa fa-check'></i> Yes" data-off="<i class='fa fa-close'></i> No" data-onstyle="success" data-offstyle="warning" data-width="100">
						<input type="hidden" name="message_flag_native" data-type="input" data-default="">
						<p class="help-block">show default message, it contain Common Name of user, client ip, device ip and date</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div> <!-- /.box-body -->
<div class="box-footer">
	<button class="btn btn-success btn-sm btn-flat ladda-button" data-style="slide-left" onclick="tgui_ldap.save(this)">Apply</button>
	<button class="btn btn-warning btn-sm btn-flat ladda-button" data-style="expand-right" onclick="tgui_ldap.test(this)"><span class="ladda-label">Test Connection</span></button>
	<text class="ldap-test error text-danger" style="display: none;"></text>
	<text class="ldap-test success text-success" style="display: none;">Success</text>
</div>
</div>

<div class="box box-warning">
	<div class="box-header with-border">
		<h3 class="box-title">Check LDAP</h3>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-xs-12">
				<p>Here you can verify access for specific user that belongs to AD. Use <b>it only for test purposes</b>! Because <b>it doesn't hide the password</b>.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-sm-6">
				<div class="form-group test_username">
					<label>Username</label>
					<input type="text" class="form-control" name="test_username" data-type="input" data-default="" placeholder="Username of AD user"/>
					<p class="help-block">username of AD user</p>
        </div>
			</div>
			<div class="col-sm-4 col-sm-6">
				<div class="form-group test_password">
					<label>Password</label>
					<input type="password" class="form-control" name="test_password" data-type="input" data-default="" placeholder="Password of AD user"/>
					<p class="help-block">password of that user</p>
        </div>
			</div>
		</div>
<pre class="check_result">
Info will appeared here
</pre>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<button class="btn btn-warning btn-flat" onclick="tgui_ldap.tester()">Check connection</button>
	</div>
</div>

<!--MAIN CONTENT END-->

<?php

require __DIR__ . '/templates/body_end.php';

?>

<?php

require __DIR__ . '/templates/footer_end.php';

?>
<!-- ADDITIONAL JS FILES START-->
	<!-- iCheck -->
	<script src="/plugins/iCheck/icheck.min.js"></script>

	<!-- main Object -->
  <script src="dist/js/pages/mavis_ldap/tgui_ldap.js"></script>
	<!-- main js MAIN Functions -->
  <script src="dist/js/pages/mavis_ldap/main.js"></script>

<!-- ADDITIONAL JS FILES END-->
</body>

</html>
