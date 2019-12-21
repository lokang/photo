<div class="card border-light mt-2">
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Names</th>
                <th>action</th>
            </tr>
            <?php foreach($users as $user) : ?>
            <tr>
                <td><?=$user['name'] ?></td>
                <td><a href="/admin/deleteUser/<?php echo $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a> </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>