<style type="text/css">
.content-area-boru {
    padding-left: 70px;
    width: 98%;
    min-height: 768px;
}
.block{
	background: #ffffff;
    border: 1px solid #F3F3F3;
    padding-left: 15px;
    padding-right: 15px;
}
</style>
{strip}
<div class="main-container main-container-{$MODULE}">
<div id="modnavigator" class="module-nav">
    <div class="hidden-xs hidden-sm mod-switcher-container">
        {include file="partials/Menubar.tpl"|vtemplate_path:$MODULE}
    </div>
</div>
	<div class="listViewPageDiv">
		<div class="listViewContentDiv" id="listViewContents" style="background: #f9f9f9;">
			<span class="btn-toolbar span8">
					<div align="center" >
						<h4 class="fieldBlockHeader" style="margin: 0px"><strong>Results For: {$QUERY}</strong></h4>
					</div>
				</span>
				<span >
					<div class="clearfix"></div>
					<input type="hidden" id="recordsCount" value=""/>
					<input type="hidden" id="selectedIds" name="selectedIds" />
					<input type="hidden" id="excludedIds" name="excludedIds" />
				</span>
			<div class="padding-left1per content-area-boru" style="width: 94%; ">
				<div class="listViewTopMenuDiv noprint">
					<div class="row-fluid listViewActionsDiv">
						<div class="content-area-boru">
							{if $MODSELECTED eq 'none'}
								{include file="SearchViewResults.tpl"|vtemplate_path:$MODULE}
							{else}
								{include file="SearchViewResultsModule.tpl"|vtemplate_path:$MODULE}
							{/if}			
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
{/strip}