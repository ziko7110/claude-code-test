@extends('layouts.app')

@section('title', 'Todo一覧')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Todo一覧</h2>
        <a href="{{ route('todos.create') }}" class="btn">新しいTodoを作成</a>
    </div>

    @if(count($todos) > 0)
        @foreach($todos as $todo)
            <div class="todo-item {{ $todo['completed'] ? 'completed' : '' }}">
                <div class="todo-title {{ $todo['completed'] ? 'completed' : '' }}">
                    {{ $todo['title'] }}
                </div>
                
                @if($todo['description'])
                    <div class="todo-description">
                        {{ $todo['description'] }}
                    </div>
                @endif
                
                <div class="todo-actions">
                    <form action="{{ route('todos.toggle', $todo['id']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $todo['completed'] ? 'btn-warning' : 'btn-success' }}">
                            {{ $todo['completed'] ? '未完了にする' : '完了にする' }}
                        </button>
                    </form>
                    
                    <a href="{{ route('todos.show', $todo['id']) }}" class="btn">詳細</a>
                    <a href="{{ route('todos.edit', $todo['id']) }}" class="btn">編集</a>
                    
                    <form action="{{ route('todos.destroy', $todo['id']) }}" method="POST" style="display: inline;" 
                          onsubmit="return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p>Todoがありません。<a href="{{ route('todos.create') }}">新しいTodoを作成</a>してください。</p>
    @endif
</div>
@endsection