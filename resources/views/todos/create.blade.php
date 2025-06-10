@extends('layouts.app')

@section('title', 'Todo作成')

@section('content')
<div class="card">
    <h2>新しいTodo作成</h2>
    
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" class="form-control" 
                   value="{{ old('title') }}" required maxlength="255">
            @error('title')
                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">説明（任意）</label>
            <textarea id="description" name="description" class="form-control" 
                      rows="4" maxlength="1000">{{ old('description') }}</textarea>
            @error('description')
                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-success">作成</button>
            <a href="{{ route('todos.index') }}" class="btn">キャンセル</a>
        </div>
    </form>
</div>
@endsection