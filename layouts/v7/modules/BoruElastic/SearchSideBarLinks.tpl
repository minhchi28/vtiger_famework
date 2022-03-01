{strip}
<div class="quickLinksDiv">
	<h3 align="center" style="font-size:29px; padding-bottom: 15px;">Filter Results</h3>
	<p onclick="window.location.href='index.php?module=BoruElastic&view=List&query={$QUERY}'" id="BoruElastic_sideBar_link_LBL_RECORDS_LIST"
		class="{if $MODSELECTED eq 'none'}selectedQuickLink{else}unSelectedQuickLink{/if}"><a class="quickLinks" href="index.php?module=BoruElastic&view=List&query={$QUERY}">
			<strong>All Results ({$COUNT})</strong>
	</a></p>
	{foreach item=enmod from=$ENABLED_MODULES}
	<p onclick="window.location.href='?module=BoruElastic&view=List&relmod={$enmod.name}&query={$QUERY}'" id="{$MODULE}_sideBar_link_{Vtiger_Util_Helper::replaceSpaceWithUnderScores($enmod.tablabel)}"
		class="{if $MODSELECTED eq $enmod.name}selectedQuickLink{else}unSelectedQuickLink{/if}"><a class="quickLinks" href="?module=BoruElastic&view=List&relmod={$enmod.name}&query={$QUERY}">
			<strong>{vtranslate($enmod.tablabel, $MODULE)} ({$enmod.count})</strong>
	</a></p>
	{/foreach}
</div>
{/strip}