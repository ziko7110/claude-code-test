<?php

class SimpleTodoController {
    
    private function getTodos() {
        return session('todos') ?: [];
    }

    private function saveTodos($todos) {
        session(['todos' => $todos]);
    }

    private function generateId() {
        return uniqid();
    }

    private function validate($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $ruleString) {
            $ruleList = explode('|', $ruleString);
            
            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($data[$field])) {
                    $errors[$field] = "{$field}は必須です。";
                    break;
                }
                
                if (strpos($rule, 'max:') === 0) {
                    $max = (int)substr($rule, 4);
                    if (isset($data[$field]) && strlen($data[$field]) > $max) {
                        $errors[$field] = "{$field}は{$max}文字以下で入力してください。";
                        break;
                    }
                }
            }
        }
        
        return $errors;
    }

    public function index() {
        $todos = collect($this->getTodos())->sortByDesc('created_at')->values();
        return view('todos/index', compact('todos'));
    }

    public function create() {
        return view('todos/create');
    }

    public function store() {
        $errors = $this->validate($_POST, [
            'title' => 'required|max:255',
            'description' => 'max:1000',
        ]);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('/todos/create');
            return;
        }

        $todos = $this->getTodos();
        $newTodo = [
            'id' => $this->generateId(),
            'title' => $_POST['title'],
            'description' => $_POST['description'] ?? '',
            'completed' => false,
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => now()->format('Y-m-d H:i:s'),
        ];

        $todos[] = $newTodo;
        $this->saveTodos($todos);
        
        $_SESSION['success'] = 'Todoが作成されました。';
        redirect('/');
    }

    public function show($id) {
        $todos = $this->getTodos();
        $todo = collect($todos)->firstWhere('id', $id);
        
        if (!$todo) {
            $_SESSION['error'] = 'Todoが見つかりません。';
            redirect('/');
            return;
        }

        return view('todos/show', compact('todo'));
    }

    public function edit($id) {
        $todos = $this->getTodos();
        $todo = collect($todos)->firstWhere('id', $id);
        
        if (!$todo) {
            $_SESSION['error'] = 'Todoが見つかりません。';
            redirect('/');
            return;
        }

        return view('todos/edit', compact('todo'));
    }

    public function update($id) {
        $errors = $this->validate($_POST, [
            'title' => 'required|max:255',
            'description' => 'max:1000',
        ]);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect("/todos/{$id}/edit");
            return;
        }

        $todos = $this->getTodos();
        $todoIndex = collect($todos)->search(function ($todo) use ($id) {
            return $todo['id'] === $id;
        });

        if ($todoIndex === false) {
            $_SESSION['error'] = 'Todoが見つかりません。';
            redirect('/');
            return;
        }

        $todos[$todoIndex]['title'] = $_POST['title'];
        $todos[$todoIndex]['description'] = $_POST['description'] ?? '';
        $todos[$todoIndex]['updated_at'] = now()->format('Y-m-d H:i:s');

        $this->saveTodos($todos);
        
        $_SESSION['success'] = 'Todoが更新されました。';
        redirect('/');
    }

    public function destroy($id) {
        $todos = $this->getTodos();
        $todos = collect($todos)->reject(function ($todo) use ($id) {
            return $todo['id'] === $id;
        })->values()->all();

        $this->saveTodos($todos);
        $_SESSION['success'] = 'Todoが削除されました。';
        redirect('/');
    }

    public function toggle($id) {
        $todos = $this->getTodos();
        $todoIndex = collect($todos)->search(function ($todo) use ($id) {
            return $todo['id'] === $id;
        });

        if ($todoIndex !== false) {
            $todos[$todoIndex]['completed'] = !$todos[$todoIndex]['completed'];
            $todos[$todoIndex]['updated_at'] = now()->format('Y-m-d H:i:s');
            $this->saveTodos($todos);
        }

        redirect('/');
    }
}