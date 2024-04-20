<!-- resources/views/components/UserList.blade.php -->
@props(['users'])

<div class="card">
    <div class="card-header">
        <h1>قائمة المستخدمين</h1>
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item">{{ $user['name'] }}</li>
            @endforeach
        </ul>
    </div>
</div>
