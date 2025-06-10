<?php
$title = 'Todo作成';
ob_start();
?>

<div class="card">
    <h2>新しいTodo作成</h2>
    
    <form action="<?php echo route('todos.store'); ?>" method="POST">
        <?php echo csrf_field(); ?>
        
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" class="form-control" 
                   value="<?php echo htmlspecialchars(old('title')); ?>" required maxlength="255">
            <?php if (isset($_SESSION['errors']['title'])): ?>
                <div class="error"><?php echo $_SESSION['errors']['title']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="description">説明（任意）</label>
            <textarea id="description" name="description" class="form-control" 
                      rows="4" maxlength="1000"><?php echo htmlspecialchars(old('description')); ?></textarea>
            <?php if (isset($_SESSION['errors']['description'])): ?>
                <div class="error"><?php echo $_SESSION['errors']['description']; ?></div>
            <?php endif; ?>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-success">作成</button>
            <a href="<?php echo route('todos.index'); ?>" class="btn">キャンセル</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
unset($_SESSION['errors'], $_SESSION['old']);
include __DIR__ . '/../layout.php';
?>