<!DOCTYPE html>
<html>
<head>
    <title>User List</title>

    <style>
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        img {
            width: 50px;
            height: 50px;
        }

        .btn {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
        }

        .edit { background: blue; }
        .delete { background: red; }
    </style>

    <script>
        function confirmDelete() {
            return confirm("Are you sure?");
        }
    </script>
</head>

<body>

<h2 style="text-align:center;">User Records</h2>

<table>
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>CNIC</th>
    <th>Phone</th>
    <th>Comments</th>
    <th>Photo</th>
    <th>Action</th>
</tr>

@foreach($users as $u)
<tr>
    <td>{{ $u->name }}</td>
    <td>{{ $u->email }}</td>
    <td>{{ $u->cnic }}</td>
    <td>{{ $u->telephone }}</td>
    <td>{{ $u->comments }}</td>

    <td>
        <img src="{{ asset('uploads/'.$u->photo) }}">
    </td>

    <td>
        <a href="/edit/{{$u->id}}" class="btn edit">Edit</a>
        <a href="/delete/{{$u->id}}" class="btn delete" onclick="return confirmDelete()">Delete</a>
    </td>
</tr>
@endforeach

</table>

</body>
</html>