<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    private function getTodos()
    {
        return session('todos', []);
    }

    private function saveTodos($todos)
    {
        session(['todos' => $todos]);
    }

    private function generateId()
    {
        return uniqid();
    }

    public function index()
    {
        $todos = collect($this->getTodos())->sortByDesc('created_at')->values();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $todos = $this->getTodos();
        $newTodo = [
            'id' => $this->generateId(),
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ];

        $todos[] = $newTodo;
        $this->saveTodos($todos);

        return redirect()->route('todos.index')->with('success', 'Todoが作成されました。');
    }

    public function show($id)
    {
        $todos = $this->getTodos();
        $todo = collect($todos)->firstWhere('id', $id);
        
        if (!$todo) {
            return redirect()->route('todos.index')->with('error', 'Todoが見つかりません。');
        }

        return view('todos.show', compact('todo'));
    }

    public function edit($id)
    {
        $todos = $this->getTodos();
        $todo = collect($todos)->firstWhere('id', $id);
        
        if (!$todo) {
            return redirect()->route('todos.index')->with('error', 'Todoが見つかりません。');
        }

        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
        ]);

        $todos = $this->getTodos();
        $todoIndex = collect($todos)->search(function ($todo) use ($id) {
            return $todo['id'] === $id;
        });

        if ($todoIndex === false) {
            return redirect()->route('todos.index')->with('error', 'Todoが見つかりません。');
        }

        $todos[$todoIndex]['title'] = $request->title;
        $todos[$todoIndex]['description'] = $request->description;
        $todos[$todoIndex]['updated_at'] = now()->toDateTimeString();

        $this->saveTodos($todos);

        return redirect()->route('todos.index')->with('success', 'Todoが更新されました。');
    }

    public function destroy($id)
    {
        $todos = $this->getTodos();
        $todos = collect($todos)->reject(function ($todo) use ($id) {
            return $todo['id'] === $id;
        })->values()->all();

        $this->saveTodos($todos);
        return redirect()->route('todos.index')->with('success', 'Todoが削除されました。');
    }

    public function toggle($id)
    {
        $todos = $this->getTodos();
        $todoIndex = collect($todos)->search(function ($todo) use ($id) {
            return $todo['id'] === $id;
        });

        if ($todoIndex !== false) {
            $todos[$todoIndex]['completed'] = !$todos[$todoIndex]['completed'];
            $todos[$todoIndex]['updated_at'] = now()->toDateTimeString();
            $this->saveTodos($todos);
        }

        return redirect()->route('todos.index');
    }
}