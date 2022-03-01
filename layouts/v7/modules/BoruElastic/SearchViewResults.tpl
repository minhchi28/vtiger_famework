{strip}


        {foreach item=MOD from=$ENABLED_MODULES}
			{if $MOD.count gt 0}
				<div class="fieldBlockContainer block">
    				<div class="bottomscroll-div">
						{assign var=MODSELECTED value=$MOD.name}
						<h4 class="fieldBlockHeader" style="padding-top: 15px;">{$MOD.tablabel} ({$MOD.count})</h4><hr>
						{include file="SearchViewResultsEntries.tpl"|vtemplate_path:$MODULE}
					</div>
				</div>
				<br>
			{/if}
		{/foreach}
</div>
{/strip}