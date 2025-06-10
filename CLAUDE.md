# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a simple, database-free Todo application using plain PHP with session-based data management.

## Common Commands

- Start development server: `php -S localhost:8000 -t public`

## Architecture

- **Simple MVC Pattern**: Custom lightweight MVC implementation
- **Session Storage**: No database required - uses PHP sessions
- **Views**: Plain PHP templates with inline CSS styling
- **Routes**: Custom routing system with RESTful patterns

## Key Components

- `SimpleTodoController.php` - Main controller with CRUD operations
- `simple_routes.php` - Custom routing handler
- `helpers.php` - Utility functions and collection class
- `public/index.php` - Application entry point
- `resources/views/` - PHP template files

## Features

- CSRF protection for forms
- Server-side validation
- Session-based data persistence
- RESTful routing patterns