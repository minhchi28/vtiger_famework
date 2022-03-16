{*
    Author: Khang Phan
    Date: 2022.03.13
    Purpose: Template for Inventory modules export PDF
*}

{if $LINEITEM_FIELDS['discount_amount']}
    {assign var=ITEM_DISCOUNT_AMOUNT_VIEWABLE value=$LINEITEM_FIELDS['discount_amount']->isViewable()}
{/if}
{if $LINEITEM_FIELDS['discount_percent']}
    {assign var=ITEM_DISCOUNT_PERCENT_VIEWABLE value=$LINEITEM_FIELDS['discount_percent']->isViewable()}
{/if}
{if $LINEITEM_FIELDS['hdnS_H_Percent']}
    {assign var=SH_PERCENT_VIEWABLE value=$LINEITEM_FIELDS['hdnS_H_Percent']->isViewable()}
{/if}
{if $LINEITEM_FIELDS['hdnDiscountAmount']}
    {assign var=DISCOUNT_AMOUNT_VIEWABLE value=$LINEITEM_FIELDS['hdnDiscountAmount']->isViewable()}
{/if}
{if $LINEITEM_FIELDS['hdnDiscountPercent']}
    {assign var=DISCOUNT_PERCENT_VIEWABLE value=$LINEITEM_FIELDS['hdnDiscountPercent']->isViewable()}
{/if}

{strip}
    <table width="500px">
        <tr>
            {* Update by Tung Bui - 23/09/2021 - Fix issue logo in export template *}
            <td width="250px">
                {if !empty($COMPANY_MODEL->getLogoPath())}<img src="{$COMPANY_MODEL->getLogoPath()}" height="60px" width="auto" rowspan="6"/>{/if}
            </td>
            <td width="250px">
                <table style="font-size: 26px; text-align: right">
                    {if !empty($COMPANY_MODEL->get('organizationname'))}<tr><td><b>{$COMPANY_MODEL->get('organizationname')}</b></td></tr>{/if}
                    {if !empty($COMPANY_MODEL->get('address'))}<tr><td>{$COMPANY_MODEL->get('address')}</td></tr>{/if}
                    {if !empty($COMPANY_CITY_INFO)}<tr><td>{$COMPANY_CITY_INFO}</td></tr>{/if}
                    {if !empty($COMPANY_MODEL->get('phone'))}<tr><td>{vtranslate('Phone', $MODULE_NAME)}: {$COMPANY_MODEL->get('phone')}</td></tr>{/if}
                    {if !empty($COMPANY_MODEL->get('website'))}<tr><td>{vtranslate('Website: ', $MODULE_NAME)}{$COMPANY_MODEL->get('website')}</td></tr>{/if}            
                    {if !empty($COMPANY_MODEL->get('vatid'))}<tr><td>{vtranslate('LBL_TAX_CODE', $MODULE_NAME)}: {$COMPANY_MODEL->get('vatid')}</td></tr>{/if}
                </table>
            </td>
            {* END Update by Tung Bui - 23/09/2021*}
        </tr>
        
    </table>
    
    <h1 style="text-align: center; font-size: 60px">{vtranslate('LBL_PDF_TITLE', $MODULE_NAME)}</h1>

    <br/>

    {if $MODULE_NAME neq 'PurchaseOrder'}
        <div class="content" style="font-size: 30px; line-height: 1.2em">
            {if !empty($CONTACT_NAME)}
                <div><b>{vtranslate('LBL_INVENTORY_PDF_DEAR_PERSON', $MODULE_NAME)}: {($CONTACT_NAME)}</b></div>  
                {if !empty($RECORD_MODEL->get('account_id'))}
                    <div><b>{vtranslate('SINGLE_Accounts', $MODULE_NAME)}: {getParentName($RECORD_MODEL->get('account_id'))}</b></div>
                {/if}
            {else}
                <div><b>{vtranslate('LBL_INVENTORY_PDF_DEAR', $MODULE_NAME)}: {getParentName($RECORD_MODEL->get('account_id'))}</b></div>
            {/if}
            
            <div><b>{vtranslate('LBL_INVENTORY_PDF_PURPOSE', $MODULE_NAME)}: {vtranslate("SINGLE_`$MODULE_NAME`", $MODULE_NAME)} - {$RECORD_MODEL->get('label')}</b></div>
            <div><b>{$COMPANY_MODEL->get('organizationname')}</b> {vtranslate('LBL_INVENTORY_PDF_DEALING', $MODULE_NAME)}</div>
            <div>{$TXT_OPENNING}:</div>
        </div>

        <br/>
    {else}
        <div class="content" style="font-size: 30px; line-height: 1.2em">
            <div><b>{vtranslate("SINGLE_`$MODULE_NAME`", $MODULE_NAME)} - {$RECORD_MODEL->get('label')}</b></div>
        </div>
    {/if}

    <table cellpadding="4px" style="width: 100%; font-size: 28px; border: 1px solid black">
        <tr style="font-weight: bold; background-color: #ccc">
            <th width="50px" style="text-align: center">{vtranslate('Product Code', $MODULE_NAME)}</th>
            <th width="170px" style="text-align: center">{vtranslate('Product Name', $MODULE_NAME)}</th>
            <th width="50px" style="text-align: center">{vtranslate('SHORT_LBL_QUANTITY', $MODULE_NAME)}</th>
            <th width="65px" style="text-align: center">{vtranslate('LBL_LIST_PRICE', $MODULE_NAME)}</th>
            <th width="65px" style="text-align: center">{vtranslate('LBL_DISCOUNT', $MODULE_NAME)}</th>
            <th width="107px" style="text-align: center">{vtranslate('LBL_TOTAL', $MODULE_NAME)}</th>
        </tr>
        {foreach item=PRODUCT from=$PRODUCTS_DETAILS}
            <tr>
                <td width="50px">{$PRODUCT.product_code}</td>
                <td width="170px">
                    {$PRODUCT.product_name} <br/>
                </td>
                <td width="50px" style="text-align: right">{$PRODUCT.quantity}</td>
                <td width="65px" style="text-align: right">{$CURRENCY_SYMBOL} {$PRODUCT.price}</td>
                <td width="65px" style="text-align: right">
                    {if $PRODUCT.discount > 0} 
                        {$CURRENCY_SYMBOL} {$PRODUCT.discount}
                    {/if}
                </td>
                    
                <td width="107px" style="text-align: right">
                    {$CURRENCY_SYMBOL} {$PRODUCT.price_after_discount}
                    {if $TAX_TYPE eq 'individual'} 
                        <br/>
                        {vtranslate('LBL_TAX', $MODULE_NAME)}: {$CURRENCY_SYMBOL} {$PRODUCT.tax_amount}
                    {/if}
                </td>
            </tr>
        {/foreach}
        <tr>
            <td rowspan="7" colspan="2" width="220px">
            </td>
            <td colspan="4" width="287px">
                <tr>
                    <td width="182px">{vtranslate('LBL_ITEMS_TOTAL', $MODULE_NAME)}:</td>
                    <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$SUMMARY_DETAILS.net_total}</td>
                </tr>
                <tr>
                    <td width="182px">{vtranslate('Discount', $MODULE_NAME)}: {if $SUMMARY_DETAILS.discount_final_percent > 0} ({$SUMMARY_DETAILS.discount_final_percent}%){/if}</td>
                    <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$SUMMARY_DETAILS.discount}</td>
                </tr>
                {if ($TAX_TYPE neq 'individual') and ($SUMMARY_DETAILS.tax > 0)} 
                    <tr>
                        <td width="182px">{vtranslate('Tax', $MODULE_NAME)}: ({$SUMMARY_DETAILS.group_total_tax_percent}%)</td>
                        <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$SUMMARY_DETAILS.tax}</td>
                    </tr>
                {/if}
                {if ($SUMMARY_DETAILS.shipping_charges > 0)} 
                    <tr>
                        <td width="182px">{vtranslate('Shipping & Handling Charges', $MODULE_NAME)}</td>
                        <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$SUMMARY_DETAILS.shipping_charges}</td>
                    </tr>
                {/if}
                {if ($SUMMARY_DETAILS.shipping_tax > 0)} 
                    <tr>
                        <td width="182px">{vtranslate('Shipping & Handling Tax:', $MODULE_NAME)} ({$SUMMARY_DETAILS.sh_tax_percent}%)</td>
                        <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$SUMMARY_DETAILS.shipping_tax}</td>
                    </tr>
                {/if}
                {if ($SUMMARY_DETAILS.adjustment > 0)} 
                    <tr>
                        <td width="182px">{vtranslate('Adjustment', $MODULE_NAME)}:</td>
                        <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$SUMMARY_DETAILS.adjustment}</td>
                    </tr>
                {/if}
                <tr>
                    <td width="182px">{vtranslate('LBL_GRAND_TOTAL', $MODULE_NAME)}:</td>
                    <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$SUMMARY_DETAILS.grand_total}</td>
                </tr>  
                {* Added by Phuc on 2020.01.20 *}
                {if $MODULE_NAME == 'Invoice'}        
                    <tr>
                        <td width="182px">{vtranslate('LBL_RECEIVED', $MODULE_NAME)}</td>
                        <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$EXT_SUMMARY_DETAILS.received}</td>
                    </tr>                
                    <tr>
                        <td width="182px">{vtranslate('LBL_REMAINING', $MODULE_NAME)}</td>
                        <td width="97px" style="text-align: right">{$CURRENCY_SYMBOL} {$EXT_SUMMARY_DETAILS.balance}</td>
                    </tr>
                {/if}
                {* Ended by Phuc *}
            </td>
        </tr>
    </table>

    <br />
    
    {if !empty($RECORD_MODEL->getDisplayValue('terms_conditions'))}
        <table cellpadding="4px" style="width: 507px; font-size: 28px; border: 1px solid black">
            <tr style="font-weight: bold; background-color: #ccc"><th>{vtranslate('Terms & Conditions', $MODULE_NAME)}</th></tr>
            <tr>
                {* Update by Tung Bui - 23/09/2021 - Fix issue display breakline *}
                <td>{nl2br($RECORD_MODEL->getDisplayValue('terms_conditions'))}</td>
                {* END Update by Tung Bui - 23/09/2021*}
            </tr>
        </table>
    {/if}

    <br />

    {if !empty($ASSIGNED_USER_MODEL->getId())}
        <div style="font-size: 30px; line-height: 1.2em">
            <div>{$TXT_ENDING}:</div>
            <div style="font-size: 28px">
                <div><i>{trim(getUserFullName($ASSIGNED_USER_MODEL->getId()))}</i></div>
                {if !empty($ASSIGNED_USER_MODEL->get('phone_mobile'))}<div><i>{vtranslate('Phone', $MODULE_NAME)}: {$ASSIGNED_USER_MODEL->get('phone_mobile')}</i></div>{/if}
                {if !empty($ASSIGNED_USER_MODEL->get('email1'))}<div><i>{vtranslate('Email', $MODULE_NAME)}: {$ASSIGNED_USER_MODEL->get('email1')}</i></div>{/if}
            </div>
        </div>
    {/if}

    <br />

    <div style="font-size: 30px">{vtranslate('LBL_INVENTORY_PDF_KINDY_FAREWELL', $MODULE_NAME)}</div>
{/strip}