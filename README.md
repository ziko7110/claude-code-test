# シンプル Todo アプリ

データベースを使わないシンプルなTodo管理アプリケーションです。セッションベースでデータを管理します。

## 機能

- Todoの作成、編集、削除
- Todo の完了/未完了の切り替え
- Todo の詳細表示
- レスポンシブデザイン
- CSRF保護
- バリデーション機能

## セットアップ

1. 開発サーバーの起動:
   ```bash
   php -S localhost:8000 -t public
   ```

アプリケーションは `http://localhost:8000` で利用できます。

## プロジェクト構造

- `public/index.php` - エントリーポイント
- `SimpleTodoController.php` - Todoコントローラー
- `simple_routes.php` - ルーティング設定
- `helpers.php` - ヘルパー関数
- `resources/views/todos/` - Todoビューファイル

## 技術的な特徴

- **データベース不要**: セッションベースでデータを管理
- **フレームワーク軽量**: 最低限のPHP機能のみ使用
- **CSRF保護**: フォーム送信時のセキュリティ確保
- **バリデーション**: サーバーサイドでの入力検証