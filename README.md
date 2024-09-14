# livewire-tables
Simple way to create (advanced) tables for laravel livewire for Bootstrap 5

# Requirements
- PHP 8.2
- Laravel 10 or higher
- Livewire 3.0.0 or higher
- Bootstrap 5
- (Optional) Spatie permissions
- (Optional) Font awesome

# How to install
`composer require nalletje/livewire-tables`

# How does it work?
Since i don't have a lot of spare times, i didn't create extended documentation, but you can see in the folder _examples how it works.
Can't get it to work or found a problem? Feel free to ask.

# Current functionality
- Build tables based on queries (and relations)
- Data search (query)
- Actions for one or more selected rows
- Actions with form
- (Query) Filters
- Route buttons
- transform column result

# What will the future bring
I don't have a schedule or a deadline at this time, i use this package for some (personal) projects.
While developing this projects i will extend features on the "need" base.
I could see features like:
- Filters: Select2 library usage
- Filters: Option search

# Upgrading to 0.1.0
There are breaking changes for Actions, the handle function returns a Message object now instead of a string
See examples.
