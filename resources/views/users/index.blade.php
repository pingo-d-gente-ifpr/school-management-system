<x-app-layout>
    <h1>Usuários</h1>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->email}}</td>
              </tr>
            @endforeach
        </tbody>
      </table>
</x-app-layout>
