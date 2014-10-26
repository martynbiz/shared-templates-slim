<ol class="breadcrumb">
    <li class="active">Accounts</li>
</ol>

<table class="table table-striped">
    <thead>
        <tr>
            <th>name</th>
            <th>amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{# accounts }}
            <tr>
                <td>{{ name }}</td>
                <td>{{ amount }}</td>
                <td>
                    <a href="/accounts/{{ id }}" data-id="{{ id }}" data-action="show_account">Show</a> |
                    <a href="/accounts/{{ id }}/edit" data-id="{{ id }}" data-action="edit_account">Edit</a> |
                    <a href="/accounts/{{ id }}/delete" data-id="{{ id }}" data-action="delete_account">Delete</a>
                </td>
            </tr>
        {{/ accounts }}
    </tbody>
</table>

<div>
    <a href="/accounts/create" class="btn btn-primary" role="button" data-action="new_account">New</a>
</div>