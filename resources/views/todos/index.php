<?php
$title = 'Todo一覧';
ob_start();
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Todo一覧</h2>
        <a href="<?php echo route('todos.create'); ?>" class="btn">新しいTodoを作成</a>
    </div>

    <?php if (count($todos) > 0): ?>
        <?php foreach ($todos as $todo): ?>
            <div class="todo-item <?php echo $todo['completed'] ? 'completed' : ''; ?>">
                <div class="todo-title <?php echo $todo['completed'] ? 'completed' : ''; ?>">
                    <?php echo htmlspecialchars($todo['title']); ?>
                </div>
                
                <?php if ($todo['description']): ?>
                    <div class="todo-description">
                        <?php echo htmlspecialchars($todo['description']); ?>
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
                    
                    <a href="<?php echo route('todos.show', [$todo['id']]); ?>" class="btn">詳細</a>
                    <a href="<?php echo route('todos.edit', [$todo['id']]); ?>" class="btn">編集</a>
                    
                    <form action="<?php echo route('todos.destroy', [$todo['id']]); ?>" method="POST" style="display: inline;" 
                          onsubmit="return confirm('本当に削除しますか？')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Todoがありません。<a href="<?php echo route('todos.create'); ?>">新しいTodoを作成</a>してください。</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>