@extends('layouts.app')

@section('title', 'Todo編集')

@section('content')
<div class="card">
    <h2>Todo編集</h2>
    
    <form action="{{ route('todos.update', $todo['id']) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" class="form-control" 
                   value="{{ old('title', $todo['title']) }}" required maxlength="255">
            @error('title')
                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">説明（任意）</label>
            <textarea id="description" name="description" class="form-control" 
                      rows="4" maxlength="1000">{{ old('description', $todo['description']) }}</textarea>
            @error('description')
                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-success">更新</button>
            <a href="{{ route('todos.index') }}" class="btn">キャンセル</a>
        </div>
    </form>
</div>
@endsection