{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
{strip}
{assign var="totalCount" value=0}
{assign var="totalModulesSearched" value=count($MATCHING_RECORDS)}
{foreach key=module item=searchRecords from=$MATCHING_RECORDS}
    {assign var=modulesCount value=count($searchRecords)}
    {assign var="totalCount" value=$totalCount+$modulesCount}
{/foreach}
<div class="content-search-quick">
<div class="globalSearchResults">
	<div class="row-fluid">
		<div class="header highlightedHeader padding1per">
			<div class="row-fluid">
				<span class="span6"><strong>{vtranslate('LBL_SEARCH_RESULTS',$MODULE)}&nbsp;({$TOTAL})</strong></span>
				<span class="span6">
					<span class="pull-right">
						<a href="index.php?module=BoruElastic&view=List&query={$QUERY}">{vtranslate('List All',$MODULE)}</a>
					</span>
				</span>
			</div>
		</div>
		<div class="contents">
			{if $totalCount eq 100}
				<div class='alert alert-block'>
					<button type=button class="close" data-dismiss="alert">&times;</button>
					{if $SEARCH_MODULE}
						{vtranslate('LBL_GLOBAL_SEARCH_MAX_MESSAGE_FOR_MODULE', 'Vtiger')}
					{else}
						{vtranslate('LBL_GLOBAL_SEARCH_MAX_MESSAGE', 'Vtiger')}
					{/if}
				</div>
			{/if}
		{foreach key=module item=searchRecords from=$MATCHING_RECORDS name=matchingRecords}
			{assign var="modulesCount" value=count($searchRecords)}
			<label class="clearfix">
				<strong><a href="index.php?module=BoruElastic&view=List&relmod={$module}&query={$QUERY}">{vtranslate($module)}&nbsp;({$modulesCount} of {$COUNTS.$module})</a></strong>
				{if {$smarty.foreach.matchingRecords.index+1} eq 1}
					<span class="pull-right"><p class="muted">{vtranslate('LBL_CREATED_ON', $MODULE)}</small></p></span>
				{/if}
			</label>
			<ul class="nav">
			{foreach item=recordObject from=$searchRecords name=globalSearch}
				{assign var="ID" value="{$module}_globalSearch_row_{$smarty.foreach.globalSearch.index+1}"}
				{assign var=DETAILVIEW_URL value=$recordObject->getDetailViewUrl()}
				<li id="{$ID}">
					<a target="_blank" id="{$ID}_link" class="cursorPointer" {if stripos($DETAILVIEW_URL, 'javascript:')===0} 
							onclick='{$DETAILVIEW_URL|substr:strlen("javascript:")}' {else} onclick='window.location.href="{$DETAILVIEW_URL}"' {/if}>{$recordObject->getName()}
						<span id="{$ID}_time" class="pull-right" title="{Vtiger_Util_Helper::formatDateTimeIntoDayString($recordObject->get('createdtime'))}">{Vtiger_Util_Helper::formatDateDiffInStrings($recordObject->get('createdtime'))}</span>
					</a>
				</li>
			{foreachelse}
				<li>{vtranslate('LBL_NO_RECORDS', $module)}</li>
			{/foreach}
			</ul>
		{/foreach}
		</div>
	</div>
</div>
</div>
{/strip}
<style type="text/css">
.content-search-quick {
	z-index: 10001;
    position: fixed;
    padding: 0px;
    margin: 0px;
    width: 23%;
    top: 40px;
    left: 491px;
    text-align: left;
    color: rgb(0, 0, 0);
    background-color: rgb(255, 255, 255);
    cursor: default;
    border-radius: 2px !important;
    border: 0 !important;
}
.globalSearchResults {
  background: #ffffff;
  border: 1px solid #dddddd;
  border: 1px solid #c4c4c4;
  -webkit-box-shadow: 0 0 3px -1px #dddddd;
  -moz-box-shadow: 0 0 3px -1px #dddddd;
  box-shadow: 0 0 3px -1px #dddddd;
  min-width: 280px;
  min-height: 500px;
}
.globalSearchResults .highlightedHeader {
  background-color: #f5f5f5;
  background-image: -moz-linear-gradient(top, #f6f6f6, #f3f3f4);
  background-image: -ms-linear-gradient(top, #f6f6f6, #f3f3f4);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f6f6f6), to(#f3f3f4));
  background-image: -webkit-linear-gradient(top, #f6f6f6, #f3f3f4);
  background-image: -o-linear-gradient(top, #f6f6f6, #f3f3f4);
  background-image: linear-gradient(top, #f6f6f6, #f3f3f4);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6f6f6', endColorstr='#f3f3f4', GradientType=0);
  border-color: #f3f3f4 #f3f3f4 #cbcbcf;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  text-shadow: 0px 1px #ffffff;
  border-bottom: 1px solid #dddddd;
  color: #444444;
  padding: 8px 5px;
}
.globalSearchResults #showFilter {
  color: #666666;
}
.globalSearchResults .contents {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  word-wrap: break-word;
  padding: 5% 5% 10% 3%;
  max-height: 500px;
  min-width: 280px;
}
.globalSearchResults .contents > label {
  padding: 5px;
  border-bottom: 1px solid #dddddd;
}
.globalSearchResults .contents ul li a {
  margin: 5px 0;
  padding: 7px;
}
.globalSearchResults .contents ul li a span {
  color: #666666;
  opacity: 0.5;
  font-size: 0.8em;
}
.globalSearchResults .contents ul li a span p {
  margin: 0 !important;
}

</style>