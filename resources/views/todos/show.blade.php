@extends('layouts.app')

@section('title', 'Todo詳細')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Todo詳細</h2>
        <a href="{{ route('todos.index') }}" class="btn">一覧に戻る</a>
    </div>
    
    <div class="todo-item {{ $todo['completed'] ? 'completed' : '' }}">
        <div class="todo-title {{ $todo['completed'] ? 'completed' : '' }}">
            {{ $todo['title'] }}
        </div>
        
        @if($todo['description'])
            <div class="todo-description">
                {{ $todo['description'] }}
            </div>
        @endif
        
        <div style="margin-bottom: 15px;">
            <strong>ステータス:</strong> 
            <span style="color: {{ $todo['completed'] ? '#28a745' : '#dc3545' }};">
                {{ $todo['completed'] ? '完了' : '未完了' }}
            </span>
        </div>
        
        <div style="margin-bottom: 15px;">
            <strong>作成日:</strong> {{ date('Y年m月d日 H:i', strtotime($todo['created_at'])) }}
        </div>
        
        @if($todo['updated_at'] != $todo['created_at'])
            <div style="margin-bottom: 15px;">
                <strong>更新日:</strong> {{ date('Y年m月d日 H:i', strtotime($todo['updated_at'])) }}
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
            
            <a href="{{ route('todos.edit', $todo['id']) }}" class="btn">編集</a>
            
            <form action="{{ route('todos.destroy', $todo['id']) }}" method="POST" style="display: inline;" 
                  onsubmit="return confirm('本当に削除しますか？')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </div>
    </div>
</div>
@endsection