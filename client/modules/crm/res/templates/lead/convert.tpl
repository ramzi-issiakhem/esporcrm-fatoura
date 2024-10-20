<div class="header page-header">{{{header}}}</div>

{{#each scopeList}}
<div class="record" {{#ifNotEqual this "Opportunity"}} style="display: none" {{/ifNotEqual}} >
    <label style="user-select: none; cursor: pointer;" class="text-large">
        <input
            type="checkbox"
            class="check-scope form-checkbox"
            data-scope="{{./this}}"
            checked
        >
        <span>{{translate this category='scopeNames'}}</span>
    </label>
    <div class="edit-container-{{toDom this}} hide">
    {{{var this ../this}}}
    </div>
</div>
{{/each}}

<div class="button-container margin-top">
    <div class="btn-group">
        <button class="btn btn-primary" data-action="convert">{{translate 'Convert' scope='Lead'}}</button>
        <button class="btn btn-default" data-action="cancel">{{translate 'Cancel'}}</button>
    </div>
</div>
