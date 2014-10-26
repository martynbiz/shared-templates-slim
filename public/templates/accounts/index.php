<ol class="breadcrumb">
    <li class="active">Accounts</li>
</ol>

<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>amount</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{# accounts }}
            <tr>
                <td>{{ id }}</td>
                <td>{{ name }}</td>
                <td>{{ amount }}</td>
                <td>
                    <a href="/accounts/{{ id }}">Show</a> |
                    <a href="/accounts/{{ id }}/edit">Edit</a> |
                    <a href="/accounts/{{ id }}/delete">Delete</a>
                </td>
            </tr>
        {{/ accounts }}
    </tbody>
</table>

<div>
    <a href="/accounts/create" class="btn btn-primary" role="button">New</a>
</div>