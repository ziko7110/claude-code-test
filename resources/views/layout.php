<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Todo App'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        
        .header h1 {
            text-align: center;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn:hover {
            background-color: #0056b3;
        }
        
        .btn-danger {
            background-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        .btn-success {
            background-color: #28a745;
        }
        
        .btn-success:hover {
            background-color: #218838;
        }
        
        .btn-warning {
            background-color: #ffc107;
            color: #212529;
        }
        
        .btn-warning:hover {
            background-color: #e0a800;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .todo-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: white;
        }
        
        .todo-item.completed {
            opacity: 0.7;
            background-color: #f8f9fa;
        }
        
        .todo-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .todo-title.completed {
            text-decoration: line-through;
            color: #6c757d;
        }
        
        .todo-description {
            color: #666;
            margin-bottom: 10px;
        }
        
        .todo-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <h1>Todo アプリ</h1>
        </div>
    </div>

    <div class="container">
        <?php if (session('success')): ?>
            <div class="alert alert-success">
                <?php echo session('success'); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (session('error')): ?>
            <div class="alert alert-error">
                <?php echo session('error'); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php echo $content; ?>
    </div>
</body>
</html>