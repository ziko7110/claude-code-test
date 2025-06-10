<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Todo App'; ?></title>
    <style>
        :root {
            /* Light mode colors */
            --bg-color: #f5f5f5;
            --text-color: #333;
            --header-bg: #007bff;
            --header-text: white;
            --card-bg: white;
            --border-color: #ddd;
            --btn-primary-bg: #007bff;
            --btn-primary-hover: #0056b3;
            --btn-danger-bg: #dc3545;
            --btn-danger-hover: #c82333;
            --btn-success-bg: #28a745;
            --btn-success-hover: #218838;
            --btn-warning-bg: #ffc107;
            --btn-warning-hover: #e0a800;
            --alert-success-bg: #d4edda;
            --alert-success-text: #155724;
            --alert-success-border: #c3e6cb;
            --alert-error-bg: #f8d7da;
            --alert-error-text: #721c24;
            --alert-error-border: #f5c6cb;
            --completed-bg: #f8f9fa;
            --description-color: #666;
            --completed-text: #6c757d;
            --shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        [data-theme="dark"] {
            /* Dark mode colors */
            --bg-color: #1a1a1a;
            --text-color: #e0e0e0;
            --header-bg: #2c3e50;
            --header-text: #ecf0f1;
            --card-bg: #2c2c2c;
            --border-color: #555;
            --btn-primary-bg: #3498db;
            --btn-primary-hover: #2980b9;
            --btn-danger-bg: #e74c3c;
            --btn-danger-hover: #c0392b;
            --btn-success-bg: #27ae60;
            --btn-success-hover: #229954;
            --btn-warning-bg: #f39c12;
            --btn-warning-hover: #d68910;
            --alert-success-bg: #1e4d2b;
            --alert-success-text: #a3d9a5;
            --alert-success-border: #28a745;
            --alert-error-bg: #4d1e1e;
            --alert-error-text: #f5c6cb;
            --alert-error-border: #dc3545;
            --completed-bg: #3a3a3a;
            --description-color: #b0b0b0;
            --completed-text: #888;
            --shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            background-color: var(--header-bg);
            color: var(--header-text);
            padding: 20px 0;
            margin-bottom: 30px;
            transition: background-color 0.3s ease;
        }
        
        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 {
            text-align: left;
            margin: 0;
        }
        
        .theme-toggle {
            background: none;
            border: 2px solid var(--header-text);
            color: var(--header-text);
            padding: 8px 16px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .theme-toggle:hover {
            background-color: var(--header-text);
            color: var(--header-bg);
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--btn-primary-bg);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        
        .btn:hover {
            background-color: var(--btn-primary-hover);
        }
        
        .btn-danger {
            background-color: var(--btn-danger-bg);
        }
        
        .btn-danger:hover {
            background-color: var(--btn-danger-hover);
        }
        
        .btn-success {
            background-color: var(--btn-success-bg);
        }
        
        .btn-success:hover {
            background-color: var(--btn-success-hover);
        }
        
        .btn-warning {
            background-color: var(--btn-warning-bg);
            color: #212529;
        }
        
        .btn-warning:hover {
            background-color: var(--btn-warning-hover);
        }
        
        .card {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
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
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
            background-color: var(--card-bg);
            color: var(--text-color);
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--btn-primary-bg);
        }
        
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: var(--alert-success-bg);
            color: var(--alert-success-text);
            border: 1px solid var(--alert-success-border);
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        
        .alert-error {
            background-color: var(--alert-error-bg);
            color: var(--alert-error-text);
            border: 1px solid var(--alert-error-border);
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        
        .todo-item {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: var(--card-bg);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        
        .todo-item.completed {
            opacity: 0.7;
            background-color: var(--completed-bg);
        }
        
        .todo-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .todo-title.completed {
            text-decoration: line-through;
            color: var(--completed-text);
        }
        
        .todo-description {
            color: var(--description-color);
            margin-bottom: 10px;
            transition: color 0.3s ease;
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
            <button class="theme-toggle" onclick="toggleTheme()">
                <span class="theme-icon" id="theme-icon">🌙</span>
                <span class="theme-text" id="theme-text">ダーク</span>
            </button>
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
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeButton(newTheme);
        }
        
        function updateThemeButton(theme) {
            const themeIcon = document.getElementById('theme-icon');
            const themeText = document.getElementById('theme-text');
            
            if (theme === 'dark') {
                themeIcon.textContent = '☀️';
                themeText.textContent = 'ライト';
            } else {
                themeIcon.textContent = '🌙';
                themeText.textContent = 'ダーク';
            }
        }
        
        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            updateThemeButton(savedTheme);
        });
    </script>
</body>
</html>