<ol class="breadcrumb">
    <li><a href="/accounts" data-action="list_accounts">Accounts</a></li>
    <li class="active">{{ account.name }}</li>
</ol>

<table class="table table-striped">
    <tr>
        <th>id</th>
        <td>{{ account.id }}</td>
    </tr>
    <tr>
        <th>name</th>
        <td>{{ account.name }}</td>
    </tr>
    <tr>
        <th>amount</th>
        <td>{{ account.amount }}</td>
    </tr>
    <tr>
        <th>created_at</th>
        <td>{{ account.created_at }}</td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td>{{ account.updated_at }}</td>
    </tr>
    <tr>
    </tr>
</table>

<div>
    <a href="/accounts/{{ account.id }}/edit" data-action="edit_account" data-id="{{ id }}" class="btn btn-primary" role="button">Edit</a>
</div>