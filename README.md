# PHP File-Based Bible Blog

This repository contains my first PHP project, created to extend my existing HTML and CSS knowledge by introducing server-side rendering with PHP.

The project converts a static site into a simple dynamic blog that displays Bible study articles stored as individual PHP files.

## Project Purpose

The primary goal of this project was to understand how PHP can be used to:

- Reduce repetition in static HTML
- Introduce shared layouts and reusable components (Navigation, Header, Footer)
- Dynamically load content
- Add basic logic to an otherwise static site

Rather than building a complex application, the focus was on learning how PHP enhances static websites.

## How It Works

- Study articles are stored as PHP files in an internal posts directory
- The homepage lists available studies
- Clicking a post dynamically loads its content
- Common layout elements are reused across pages

No database, CMS, or framework is used.

## Concepts Practised

- PHP includes and execution flow
- Turning static HTML into reusable templates
- Basic routing with query parameters
- Separating content from layout
- Maintaining clean, readable markup
- Styling with plain CSS

## Folder Structure

- `/posts`  
  Individual Bible study articles as PHP files

- `index.php`  
  Homepage listing available studies

- `post.php`  
  Single post renderer

- `bootstrap.php`  
  Shared configuration and helper logic

- `style.css`  
  Site styling

- `script.js`  
  Minimal client-side behaviour

- `sitemap.xml` and `robots.txt`  
  Basic SEO support

## Design Choices

This project intentionally avoids a database to keep the focus on:

- Core PHP mechanics
- File-based content management
- Simplicity and transparency
- Easy editing and version control of content

Each post remains human-readable and self-contained.

## Learning Outcome

This project marks my first step beyond static HTML and CSS. It demonstrates how PHP can introduce structure, reuse, and dynamism to a site while remaining simple, understandable, and purpose-driven.
