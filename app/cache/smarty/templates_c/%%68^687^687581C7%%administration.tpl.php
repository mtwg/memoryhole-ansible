<?php /* Smarty version 2.6.11, created on 2014-12-24 10:55:37
         compiled from modules/Connectors/tpls/administration.tpl */ ?>
<table class='edit view small' width="100%" border="0" cellspacing="1" cellpadding="0" >		
	<tr valign="top">
		<td width="35%">
			<table  border="0" cellspacing="2" cellpadding="0" >	
				<tr valign='top'>
					<td><img src="<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorConfig.gif" name="connectorConfig" onclick="document.location.href='index.php?module=Connectors&action=ModifyProperties';"
						onMouseOver="document.connectorConfig.src='<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorConfigOver.gif'"
						onMouseOut="document.connectorConfig.src='<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorConfig.gif'"></td>
					<td>&nbsp;&nbsp;</td>
					<td><b><?php echo $this->_tpl_vars['mod']['LBL_MODIFY_PROPERTIES_TITLE']; ?>
</b><br/>
						<?php echo $this->_tpl_vars['mod']['LBL_MODIFY_PROPERTIES_DESC']; ?>

					</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				<tr valign='top'>
					<td><img src="<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorEnable.gif" name="enableImage" onclick="document.location.href='index.php?module=Connectors&action=ModifyDisplay';"
						onMouseOver="document.enableImage.src='<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorEnableOver.gif'"
						onMouseOut="document.enableImage.src='<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorEnable.gif'"></td>
					<td>&nbsp;&nbsp;</td>
					<td><b><?php echo $this->_tpl_vars['mod']['LBL_MODIFY_DISPLAY_TITLE']; ?>
</b><br/>
						<?php echo $this->_tpl_vars['mod']['LBL_MODIFY_DISPLAY_DESC']; ?>

					</td>
				</tr>			
			</table>
		</td>
		<td width="10%">&nbsp;</td>
		<td width="35%">
			<table  border="0" cellspacing="2" cellpadding="0">	   
				<tr valign='top'>
					<td><img src="<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorMap.gif" name="connectorMapImg" onclick="document.location.href='index.php?module=Connectors&action=ModifyMapping';"
						onMouseOver="document.connectorMapImg.src='<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorMapOver.gif'"
						onMouseOut="document.connectorMapImg.src='<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorMap.gif'"></td>
					<td>&nbsp;&nbsp;</td>
					<td><b><?php echo $this->_tpl_vars['mod']['LBL_MODIFY_MAPPING_TITLE']; ?>
</b><br/>
						<?php echo $this->_tpl_vars['mod']['LBL_MODIFY_MAPPING_DESC']; ?>

					</td>
				</tr>

				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>


				<tr valign='top'>
					<td>
					    <img src="<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorSearchFields.gif" name="connectorSearchImg" onclick="document.location.href='index.php?module=Connectors&action=ModifySearch';"
						onMouseOver="document.connectorSearchImg.src='<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorSearchFieldsOver.gif'"
						onMouseOut="document.connectorSearchImg.src='<?php echo $this->_tpl_vars['IMG']; ?>
icon_ConnectorSearchFields.gif'">
				    </td>
					<td>&nbsp;&nbsp;</td>
					<td>
					    					    <b><?php echo $this->_tpl_vars['mod']['LBL_MODIFY_SEARCH_TITLE']; ?>
</b><br/>
						<?php echo $this->_tpl_vars['mod']['LBL_MODIFY_SEARCH_DESC']; ?>

											</td>	
				</tr>

			</table>
		</td>				
		<td width="20%">&nbsp;</td>
	</tr>
</table>