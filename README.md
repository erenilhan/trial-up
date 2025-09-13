# Actor Information App

This is a simple Laravel app for managing actor information.

## What This App Does

- Users can add actor information
- The app uses AI to read descriptions and get actor details
- All actor information is saved in a database
- Users can see all actors in a table

## How to Use

### Setup
1. Copy the project files
2. Run `composer install` to get all packages
3. Copy `.env.example` to `.env` and add your settings:
   - Database information
   - OpenAI API key: `OPENAI_API_KEY=your_key_here`
   - OpenAI model: `OPENAI_MODEL=gpt-4o-mini`
4. Run `php artisan migrate` to create database tables

### Adding an Actor
1. Go to the actor form page
2. Enter an email address
3. Write a description about the actor
4. The app will use AI to find: name, address, height, weight, gender, age
5. Click submit to save

### Viewing Actors
- Go to the actors table page to see all saved actors

## Main Files

- `app/Models/Actor.php` - Actor data model
- `app/Http/Controllers/ActorController.php` - Handles forms and saving
- `tests/` - Simple tests for the app

## Tests

Run tests with: `php artisan test`

The tests check:
- Actor model works correctly
- Controller has all needed methods
- Basic functionality works
