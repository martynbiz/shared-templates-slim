<ol class="breadcrumb">
    <li><a href="/accounts" data-action="list_accounts">Accounts</a></li>
    <li><a href="/accounts/{{ id }}" data-id="{{ id }}" data-action="show_account">{{ name }}</a></li>
    <li class="active">delete</li>
</ol>


<div class="panel panel-default">
    <div class="panel-body">
        <form method="POST" action="/accounts/{{ account.id }}" name="accounts_update">
            <p>Are you sure you want to delete '{{ account.name }}'</p>
            
            <input type="hidden" name="_METHOD" value="DELETE"/>
            
            <input type="submit" name="submit" value="Delete" class="btn btn-primary" role="button">
            <a href="/accounts" class="btn btn-default" role="button" data-action="list_accounts">Cancel</a>
        </form>
    </div>
</div>
