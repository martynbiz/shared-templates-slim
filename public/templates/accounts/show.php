<h2><a href="/accounts">Accounts</a> | {{ account.name }}</h2>

<table cellpadding="10" border="1">
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
        <th>deleted_at</th>
        <td>{{ account.deleted_at }}</td>
    </tr>
    <tr>
    </tr>
</table>

<div>
    <a href="/accounts/{{ account.id }}/edit" data-method="edit" data-id="{{ id }}">Edit</a>
</div>