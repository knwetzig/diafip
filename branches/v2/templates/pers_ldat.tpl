{**************************************************************
Smarty-Template für die Ansicht von Personendaten (Liste)

$Rev$
$Author$
$Date$
$URL$

    call:   pers_class.php
    class:  Person
    proc:   sview
    param:  dialog[???][0] feldname
                       [1] inhalt (evt. weitere arrays)
                       [2] label
                       [3] Tooltip (soweit vorhanden)

***** (c) DIAF e.V. *******************************************}

<table width="100%" {if $darkBG}class="darkBG"{/if}>
    <colgroup><col width="150px"><col><col></colgroup>

{* --Name-- *}
    <tr>
        <td colspan="2">
            <div style="white-space:normal" class="fett">
            {if !empty($dialog['pname'][1])}{$dialog['pname'][1]}{/if}
            {if !empty($dialog['aliases'][1])}
                <span style="font-weight:normal">                (
                    {foreach $dialog['aliases'][1] as $alias}
                        {$alias}{if $alias@last}{else},&nbsp;{/if}
                    {/foreach}
                </span>
            {/if}
            </div>
        </td>

{* --Bearbeitungssymbole-- *}
        <td class="re">
            <form action='{$dlg['phpself']}' method="post">
                <span class="note">ID:&nbsp;{$dialog['id'][1]}&nbsp;</span>

                {if isset($dialog['edit'])}
                    <button
                        class={if $darkBG}"small_dk"{else}"small"{/if}
                        name="aktion"
                        onmouseover="return overlib('{$dialog['edit'][3]}',DELAY,1000);"
                        onmouseout="return nd();"
                        value="edit"><img src="images/edit.png" /></button>
                {/if}

                {if isset($dialog['del'])}
                    <button
                        class={if $darkBG}"small_dk"{else}"small"{/if}
                        name="aktion"
                        onmouseover="return overlib('{$dialog['del'][3]}',DELAY,1000);"
                        onmouseout="return nd();"
                        value="del" /><img src="images/del.png" /></button>
                {/if}

                <input type="hidden" name="form" value="true" />
                <input type="hidden" name="sektion" value="{$dialog['bereich'][1]}" />
                <input type="hidden" name="id" value="{$dialog['id'][1]}" />
            </form>
        </td>
    </tr>

{* --Geburtstagszeile-- *}
    {if !empty($dialog['gtag'][1]) OR !empty($dialog['gort'][1])}<tr>
        <td class="re">
            {if !empty($dialog['gtag'][2])}{$dialog['gtag'][2]}:{/if}
        </td>
        <td>
            {if !empty($dialog['gtag'][1])}{$dialog['gtag'][1]}{/if}
            {if !empty($dialog['gort'][1])}
                &nbsp;{$dialog['gort'][2]}&nbsp;{$dialog['gort'][1]['ort']}
                &nbsp;({$dialog['gort'][1]['land']},&nbsp;{$dialog['gort'][1]['bland']})
            {/if}
        </td>
        <td >{*<img src="images/platzhalter.png" width="100" height="135" alt="bild" />*}</td>
    </tr>{/if}

{* --Todeszeile-- *}
    {if !empty($dialog['ttag'][1]) OR !empty($dialog['tort'][1])}<tr>
        <td class="re">
            {if !empty($dialog['ttag'][1])}{$dialog['ttag'][2]}{/if}
        </td>
        <td>{if !empty($dialog['ttag'][1])}{$dialog['ttag'][1]}{/if}
            {if !empty($dialog['tort'][1])}
                &nbsp;{$dialog['tort'][2]}&nbsp;{$dialog['tort'][1]['ort']}
                &nbsp;({$dialog['tort'][1]['land']},&nbsp;{$dialog['tort'][1]['bland']})
            {/if}
        </td>
    </tr>{/if}

</table>