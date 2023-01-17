Thank you for applying to a development position at SingleLineOrient and agreeing to complete our coding challenge.

The challenge is extremely simple:

# Context

The goal of this coding project is to create a web interface through which a user can upload Books, Author, and Library data to the cloud and be able to easily retrieve and search / filter for it.

# Database Schema

## Books
We are expecting you to create a very simple books table that can store 2 types of data "name" and "year". The books are related to Authors in a way that a single Author could have many books but a book can only belong to 1 Author. The books are related to a library in a way that a single book may belong to multiple libraries and a library may have multiple books. A book is always related to an author but it is possible it does not belong to any library.

## Author
We are expecting you to create a very simple authors table that can store 3 types of data "name", "birth date", and "genre" (the genre of the books he writes). Authors are related to books in a way that an author can have multiple books. It is possible an author may not own any books.

## Library
We are expecting you to create a very simple library table that can store 2 types of data "name" and "address". The library is related to books in a way that a single library can own multiple books and a single book can belong to multiple libraries. Libraries must always have books.

# Frontend

## Books HTML Table

What we want to see in the frontend is an HTML table that shows a list of ALL the books in the system with the following columns:

Book Name
Book Year
Author Name
Author Genre
Library Name
Library Address
Actions

The actions column should contain 2 possible actions "edit" and "delete". Moreover there should be an "Add Book" button in the top right corner of the books table.

 
## Add Book Form

The add book form should contain fields for:

Book Name
Book Year

We also want to be able to create an author or link a book to an existing author from this same form. The fields for this should be:

Author Name
Author Birth Date
Author Year

We also want to be able to create a library or link to an existing library from this same form. The fields for this should be:

Library Name
Library Address

## Edit Book Form

Should contain and behave the same as the "Add Book Form" with the difference that the data will be persisted in the book we are editing instead of creating a new book. It will also load the existing data for the book selected.

## Delete Action

Soft deletes a book

# Technologies

Please use PHP and Laravel to code a REST API that will handle the backend of our Book system. 
The frontend technologies that you decide to use it's up to you JS, jQuery, Vue, Angular, PHP or something entirely different.

# Deliverables

We are expecting to see the completed work as outlined above in working condition. You should use best practices to the best of your availability and include unit tests for the REST API to prove your code works. Also please include instructions on how to run your code so our selection team can easily run it and review.


