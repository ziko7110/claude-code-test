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
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-title {
            margin: 0;
        }
        
        .theme-toggle {
            background: none;
            border: 2px solid white;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .theme-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
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
        
        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #1a1a1a;
            color: #e0e0e0;
        }
        
        body.dark-mode .header {
            background-color: #2d3748;
        }
        
        body.dark-mode .card {
            background-color: #2d3748;
            color: #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        body.dark-mode .todo-item {
            background-color: #374151;
            border-color: #4a5568;
            color: #e0e0e0;
        }
        
        body.dark-mode .todo-item.completed {
            background-color: #2d3748;
        }
        
        body.dark-mode .todo-description {
            color: #a0a0a0;
        }
        
        body.dark-mode .form-control {
            background-color: #374151;
            border-color: #4a5568;
            color: #e0e0e0;
        }
        
        body.dark-mode .form-control:focus {
            background-color: #4a5568;
            border-color: #007bff;
            outline: none;
        }
        
        body.dark-mode .alert-success {
            background-color: #1f2937;
            color: #10b981;
            border-color: #10b981;
        }
        
        body.dark-mode .alert-error {
            background-color: #1f2937;
            color: #ef4444;
            border-color: #ef4444;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="header-content">
                <h1 class="header-title">Todo アプリ</h1>
                <button class="theme-toggle" onclick="toggleTheme()">
                    <span id="theme-icon">🌙</span>
                    <span id="theme-text">ダーク</span>
                </button>
            </div>
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

    <script>
        // Theme toggle functionality
        function toggleTheme() {
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');
            const themeText = document.getElementById('theme-text');
            
            if (body.classList.contains('dark-mode')) {
                body.classList.remove('dark-mode');
                themeIcon.textContent = '🌙';
                themeText.textContent = 'ダーク';
                localStorage.setItem('theme', 'light');
            } else {
                body.classList.add('dark-mode');
                themeIcon.textContent = '☀️';
                themeText.textContent = 'ライト';
                localStorage.setItem('theme', 'dark');
            }
        }
        
        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            const body = document.body;
            const themeIcon = document.getElementById('theme-icon');
            const themeText = document.getElementById('theme-text');
            
            if (savedTheme === 'dark') {
                body.classList.add('dark-mode');
                themeIcon.textContent = '☀️';
                themeText.textContent = 'ライト';
            } else {
                themeIcon.textContent = '🌙';
                themeText.textContent = 'ダーク';
            }
        });
    </script>
</body>
</html>