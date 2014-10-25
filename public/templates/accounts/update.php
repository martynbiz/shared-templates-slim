<h2><a href="/accounts">Accounts</a> | <a href="/accounts/{{ id }}">{{ account.name }}</a> | edit</h2>

<form method="POST" action="/accounts/{{ account.id }}" name="accounts_update">
    <?php include '_form.php'; ?>
    
    <input type="hidden" name="_METHOD" value="PUT"/>
    
    <input type="submit" name="submit" value="Update">
</form>