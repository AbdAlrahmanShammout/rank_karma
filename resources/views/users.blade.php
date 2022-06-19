@if(count($users)> 0)
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th> img</th>
            <th> id</th>
            <th> username</th>
            <th> karma score</th>
            <th> Rank</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr @if($currentId == $user->id) class="active" @endif>
                <td><img src="{{$user->url}}" alt="profile Pic" height="50" width="50"></td>
                <td> {{$user->id}} </td>
                <td> {{$user->username}} </td>
                <td> {{$user->karma_score}} </td>
                <td> {{$user->rank_}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p> No users found..</p>
@endif


