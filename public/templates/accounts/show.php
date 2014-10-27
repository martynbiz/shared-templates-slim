<ol class="breadcrumb">
    <li><a href="/accounts" data-action="list_accounts">Accounts</a></li>
    <li class="active">{{ name }}</li>
</ol>

<table class="table table-striped">
    <tr>
        <th>id</th>
        <td>{{ id }}</td>
    </tr>
    <tr>
        <th>name</th>
        <td>{{ name }}</td>
    </tr>
    <tr>
        <th>amount</th>
        <td>{{ amount }}</td>
    </tr>
    <tr>
        <th>created_at</th>
        <td>{{ created_at }}</td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td>{{ updated_at }}</td>
    </tr>
    <tr>
    </tr>
</table>

<div>
    <a href="/accounts/{{ id }}/edit" data-action="edit_account" data-id="{{ id }}" class="btn btn-primary" role="button">Edit</a>
</div>