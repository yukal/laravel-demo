Test task within the Laravel framework usage.

Hello, this is a simple task, the essence of the task is to evaluate your skills in working with laravel,
to study the style of writing code.

1. Create 3 migrations to the database using Artisan:
   - Table "Genres" with fields:
     - ID
     - Genre name

   - Table Movies with fields:
     - ID
     - Movie name
     - Publication status
     - Link to poster

   - Table of relationships between movies and genres

2. Create seeds for test filling of the above tables
3. Create models, controllers, for creating, displaying, editing and deleting records.

4. When creating a record in the movies table, an image with a movie poster should be loaded
(if the image is missing, a default image should be attached to the record.
Also, the movie should not be published, the publication of the record should be provided for by a separate method.

5. Create REST API controllers for selecting and paginating data in json format

  - genres (displays a list of all genres)
  - genres/id (displays a list of all movies in a given genre, broken down into pages
  - movies - displays all movies, broken down into pages
  - movies/id - displays a specific movie by ID

A movie should always contain the genres to which it belongs and a link to the image

( ! ) Attention, there should be a minimum amount of logic in the controllers. All incoming request data should be validated, especially files.
