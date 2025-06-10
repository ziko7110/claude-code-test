<?php
$title = 'Todo詳細';
ob_start();
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Todo詳細</h2>
        <a href="<?php echo route('todos.index'); ?>" class="btn">一覧に戻る</a>
    </div>
    
    <div class="todo-item <?php echo $todo['completed'] ? 'completed' : ''; ?>">
        <div class="todo-title <?php echo $todo['completed'] ? 'completed' : ''; ?>">
            <?php echo htmlspecialchars($todo['title']); ?>
        </div>
        
        <?php if ($todo['description']): ?>
            <div class="todo-description">
                <?php echo htmlspecialchars($todo['description']); ?>
            </div>
        <?php endif; ?>
        
        <div style="margin-bottom: 15px;">
            <strong>ステータス:</strong> 
            <span style="color: <?php echo $todo['completed'] ? '#28a745' : '#dc3545'; ?>;">
                <?php echo $todo['completed'] ? '完了' : '未完了'; ?>
            </span>
        </div>
        
        <div style="margin-bottom: 15px;">
            <strong>作成日:</strong> <?php echo date('Y年m月d日 H:i', strtotime($todo['created_at'])); ?>
        </div>
        
        <?php if ($todo['updated_at'] != $todo['created_at']): ?>
            <div style="margin-bottom: 15px;">
                <strong>更新日:</strong> <?php echo date('Y年m月d日 H:i', strtotime($todo['updated_at'])); ?>
            </div>
        <?php endif; ?>
        
        <div class="todo-actions">
            <form action="<?php echo route('todos.toggle', [$todo['id']]); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <button type="submit" class="btn <?php echo $todo['completed'] ? 'btn-warning' : 'btn-success'; ?>">
                    <?php echo $todo['completed'] ? '未完了にする' : '完了にする'; ?>
                </button>
            </form>
            
            <a href="<?php echo route('todos.edit', [$todo['id']]); ?>" class="btn">編集</a>
            
            <form action="<?php echo route('todos.destroy', [$todo['id']]); ?>" method="POST" style="display: inline;" 
                  onsubmit="return confirm('本当に削除しますか？')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>