<?php
    $progress_backup = null;
    if (isset($info['info_status']['progress']))
    {
        $progress_backup = array(
            'progress'  => $info['info_status']['progress']['percentage'],
            'all'       => $info['info_status']['progress']['all'],
        );
    }

    $ico_status_backup = "status_clock.png";
    if ($status_type == 'error')
    {
        $ico_status_backup = "status_error.png";
    }
    else
    {
        switch($status['code'])
        {
            case $syno::STATUS_IDLE:
            case $syno::STATUS_IDLE_CANCEL:
            case $syno::STATUS_IDLE_FAILED:
                $ico_status_backup = "status_warn.png";
                break;

            case $syno::STATUS_IDLE_COMPLETED:
                $ico_status_backup = "status_ok.png";
                break;
            
            case $syno::STATUS_BACKUP_RUN:
                $ico_status_backup = "status_update.png";
                break;
        }
    }    
?>

<div class="panel panel-primary abb-panel-main">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo _("Status Backup") ?></h3>
    </div>
    <div class="panel-body">
        <div class="element-container">
            <div class="row">
                <div class="col-md-6">

                    <div class="media">
                        <div class="media-body">
                            <div class="page-header">
                                <h2><?php echo _('Connection Info:')?></h2>
                            </div>
                            <div class="element-container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label class="control-label" for="ABB_Info_Serv"><?php echo _('Server Address:')?></label>
                                                </div>
                                                <div class="col-md-9"><?php echo $info['server']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label class="control-label" for="ABB_Info_Username"><?php echo _('Username:')?></label>
                                                </div>
                                                <div class="col-md-9"><?php echo $info['user']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9 row-separation"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="button" id="btn-server-logout" class="btn btn-danger btn-sm btn-block"><?php echo _("Logout from Server") ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="media-right">
                            <a href="<?php echo $info['portal']?>"  target="_blank">
                                <img class="media-object" src="/admin/assets/synologyabb/images/abb_ico_64.png" alt="<?php echo _('Portal Recovery')?>" title="<?php echo _('Portal Recovery')?>">
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="media">
                        <div class="media-body">
                            <div class="page-header">
                                <h2><?php echo sprintf(_('Backup Info (%s):'), $info['info_status']['msg']); ?></h2>
                            </div>
                            <div class="element-container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label class="control-label" for="ABB_Info_lastbackup"><?php echo _('Last Backup Time:')?></label>
                                                </div>
                                                <div class="col-md-9"><?php echo $info['lastbackup']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label class="control-label" for="ABB_Info_nextbackup"><?php echo _('Next Backup Time:')?></label>
                                                </div>
                                                <div class="col-md-9"><?php echo $info['nextbackup']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9 row-separation"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="button" id="btn-force-refresh" class="btn btn-default btn-sm btn-block"><?php echo _("Force refresh") ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media-right">
                            <img class="media-object" src="/admin/assets/synologyabb/images/<?php echo $ico_status_backup?>" alt="<?php echo $info['info_status']['msg']; ?>" title="<?php echo $info['info_status']['msg']; ?>">
                        </div>
                    </div>

                </div>
            </div>
            <?php if (is_null($progress_backup)): ?>
                <div class="row">
                <div class="col-md-12">

                    <div class="media">
                        <div class="media-body">
                            <div class="page-header">
                                <h3><?php echo _('Service Status:')?></h3>
                            </div>
                            <div class="element-container">
                                <div class="row">
                                    <div class="col-md-12"><?php echo $info['server_status']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="media-right">
                            <img class="media-object" src="/admin/assets/synologyabb/images/ico_info.png">
                        </div>
                    </div>

                </div>
            </div>
            <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron" id="box_copy_progress">
                        <div class="container">
                            <h1><?php echo $info['info_status']['msg']; ?></h1>
                            <p><?php echo $progress_backup['all'] ?></p>
                            <p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $progress_backup['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress_backup['progress'] ?>%;">
                                    <?php echo $progress_backup['progress'] ?>%
                                    </div>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
    <div class="panel-footer panel-version">
		<b><?php echo sprintf( _("Agent Version: %s"), $syno->getAgentVersion() ); ?></b>
	</div>
</div>

<div class="modal fade" id="LogoutFromServer" tabindex="-1" role="dialog" aria-labelledby="LogoutFromServerTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg modal-dialog-danger" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="LogoutFromServerTitle"><?php echo _("Disconnect Device from Server"); ?></h4>
            </div>
            <div class="modal-body">
                <form method="post" id="formlogout">
                    <input type="hidden" id="module" name="module" value="synologyabb"> 
                    <input type="hidden" id="command" name="command" value="setagentlogout">
                    <div class="form-group">
                        <label for="ABBUser"><?php echo _("Username") ?></label>
                        <input type="text" class="form-control" name="ABBUser" id="ABBUser" placeholder="<?php echo _("Username") ?>" required="required">
                    </div>
                    <div class="form-group">
                        <label for="ABBPassword"><?php echo _("Password")?></label>
                        <input type="password" class="form-control" name="ABBPassword" id="ABBPassword" placeholder="<?php echo _("Password")?>" required="required">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="ABBLogoutNow" class="btn btn-danger btn-block"><?php echo _("Logout from Server")?></button>
                <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#btn-server-logout").click( function()
	{
        fpbxConfirm("<?php echo _("Are you sure you want to disconnect this device from the backup server?"); ?>",
			"<?php echo _("YES"); ?>", "<?php echo _("NO")?>",
			function()
			{
				$('#LogoutFromServer').modal('show');
			}
		);
    });

    $("#btn-force-refresh").click( function()
	{
        timerStop();
        boxLoading(true);
        fpbxToast("<?php echo _("Started data update process..."); ?>", '', 'info');
        var post_data = {
            module	: 'synologyabb',
            command	: 'setagentreconnect',
        };

        $.post(window.FreePBX.ajaxurl, post_data, function()
        {
            window.setTimeout(loadStatusForceRefresh, 500);
        });
    });

    $('#LogoutFromServer').on('show.bs.modal', function (e)
    {
        $(this).find(':input[type=text], :input[type=password]').val("");
    })

    $('#LogoutFromServer').keypress((e) => {
		if (e.which === 13) {
			$("#ABBLogoutNow").trigger("click");
		}
	});
	function validaFormABB()
	{
		if($("#ABBUser").val() == "")
		{
			fpbxToast("<?php echo _("The Username field cannot be empty!"); ?>", '', 'warning');
			$("#ABBUser").focus();
			return false;
		}
		if($("#ABBPassword").val() == "")
		{
			fpbxToast("<?php echo _("The Password field cannot be empty!"); ?>", '', 'warning');
			$("#ABBPassword").focus();
			return false;
		}
		return true;
	}
    $("#ABBLogoutNow").click( function()
	{
		if(validaFormABB())
		{
			timerStop();
			boxLoading(true);
			var form = $("#formlogout");
			var post_data = form.serialize();

			form.find(':input:not(:disabled)').prop('disabled',true);

			$.post(window.FreePBX.ajaxurl, post_data, function(res)
			{
				var data 	= res.data;
				var error 	= data.error;
				if(error.code === 0)
				{
                    $('#LogoutFromServer').modal('hide');
					fpbxToast('<i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;' + '<?php echo _('Device Successfully Disconnected!'); ?>', '', 'success');
					window.setTimeout(loadStatusForceRefresh, 1000);
				}
				else
				{
					fpbxToast('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;' + error.msg, '', 'warning');
					form.find(':input(:disabled)').prop('disabled', false);
					switch(error.code)
					{
						case 612:
							$("#ABBUser").focus();
							break;
					}
					boxLoading(false);
					loadStatus();
				}
			});
		}
	});
</script>