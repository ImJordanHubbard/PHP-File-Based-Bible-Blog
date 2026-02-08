# PHP File-Based Blog

This repository contains a small PHP project that turns a static site into a simple blog for Bible study articles.

The aim of the project is to understand how PHP can be used to reduce repetition, load content dynamically, and reuse shared layout, without using a database, framework, or CMS.

---

## What This Project Is

The site is a file-based blog.

Each article is stored as its own PHP file. PHP is used to:
- List available articles
- Load the correct article when a link is clicked
- Reuse the same header, navigation, and footer across pages

Everything is kept explicit so it is easy to see what is happening and why.

---

## Where Things Live

- `/posts`  
  Contains all Bible study articles.  
  Each file returns a set of details (title, date, category, etc.) and the article content as HTML.

- `/partials`  
  Contains shared layout files such as the header, navigation, and footer.  
  These are included where needed to avoid repeating the same markup.

- `/assets`  
  Contains CSS, JavaScript, images, and video.  
  These files are served directly by the web server.

---

## How Pages Work

### Homepage (`index.php`)

The homepage lists all available articles.

It:
- Looks through the `/posts` folder
- Loads each article file
- Creates a short excerpt from the content
- Sorts articles by date
- Displays them as clickable cards

Simple JavaScript is used on this page to filter articles by category and book without reloading the page.

---

### Article Page (`post.php`)

Each article is viewed through a single PHP file.

When a URL like:

/gospels/genealogy-of-jesus-new-beginnings

is requested, the server passes the category and slug to `post.php`.

That file:
- Finds the matching article file
- Redirects to a consistent lowercase URL if needed
- Shows a 404 page if no article exists
- Outputs the article content and details

---

## URLs

Clean, readable URLs are handled using a small Apache rewrite rule.

Real files (such as images, CSS, and JavaScript) are not affected and load normally.

---

## Why This Approach

This project avoids a database and framework on purpose.

The goal is to:
- Learn how PHP works in a real site
- Keep content easy to edit and version-control
- Understand how requests, files, and includes fit together
- Avoid unnecessary complexity while learning

Each part of the site exists to solve a clear, practical problem and nothing more.

---

## Summary

This project shows how PHP can add structure and flexibility to a small site while remaining simple, readable, and easy to maintain.

It is designed to be understood first, not scaled prematurely.
