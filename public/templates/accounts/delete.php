<h2><a href="/accounts">Accounts</a> | <a href="/accounts/{{ id }}">{{ account.name }}</a> | delete</h2>

<form method="POST" action="/accounts/{{ account.id }}" name="accounts_update">
    <p>Are you sure you want to delete '{{ account.name }}'</p>
    
    <input type="hidden" name="_METHOD" value="DELETE"/>
    
    <input type="submit" name="submit" value="Delete">
    <a href="/accounts">Cancel</a>
</form>