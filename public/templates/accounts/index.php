<h2>Accounts</h2>

<table width="100%" cellpadding="10" border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>amount</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>deleted_at</th>
    </tr>
    {{# accounts }}
        <tr>
            <td>{{ id }}</td>
            <td>{{ name }}</td>
            <td>{{ amount }}</td>
            <td>{{ created_at }}</td>
            <td>{{ updated_at }}</td>
            <td>
                <a href="/accounts/{{ id }}">Show</a> |
                <a href="/accounts/{{ id }}/edit">Edit</a> |
                <a href="/accounts/{{ id }}/delete">Delete</a>
            </td>
        </tr>
    {{/ accounts }}
</table>

<div>
    <a href="/accounts/create">Create</a>
</div>