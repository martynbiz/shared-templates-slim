<ol class="breadcrumb">
    <li><a href="/accounts">Accounts</a></li>
    <li><a href="/accounts/{{ account.id }}">{{ account.name }}</a></li>
    <li class="active">delete</li>
</ol>


<div class="panel panel-default">
    <div class="panel-body">
        <form method="POST" action="/accounts/{{ account.id }}" name="accounts_update">
            <p>Are you sure you want to delete '{{ account.name }}'</p>
            
            <input type="hidden" name="_METHOD" value="DELETE"/>
            
            <input type="submit" name="submit" value="Delete" class="btn btn-primary" role="button">
            <a href="/accounts" class="btn btn-default" role="button">Cancel</a>
        </form>
    </div>
</div>
