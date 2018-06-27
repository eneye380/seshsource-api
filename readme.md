# SeshSource API

The backend API for [SeshSource.com](http://seshsource.com), a directory and ticketing platform for cannabis events.

## App Structure

Laravel follows the MVC pattern. Models interact with the database or data stores. Controllers grab the data from models and parse it. And the views display the data directed by controllers.

## Necessary Features (MVP)


## Directory

* Events searchable by date
* Events shown by location or category
* User profiles for event organizers
* Calendar view with events
* List/card view
* List of all cities, states, etc + archive pages

## E-Commerce

* Buy free or paid tickets
* Generate PDF of ticket
* Email PDF to user
* Email business about new purchase
* Mobile-friendly web-app to scan tickets at event

## Organizer Tools

* Dashboard for managing events
* Create events
* Edit event
* Delete event
* Create ticket types for specific events (free, VIP, etc)
* See (+ print) list of event attendeees
* See (+ print) list of orders

## Future Features

* Organizer Tools: Custom templates for PDFs
* Organizer Tools: Create discount codes
* Organizer Tools: Manage employees
* Directory: Search by map
* Text messages notifications using Twilio

## Progress

* [✅] - Authentication and Passport integrated
* [✅] - Migrations and models created
* [✅] - UUIDs integrated on all necessary models
* [✅] - Events CRUD functionality
* [✅] - Token Generation
* [✅] - Added CORS support
* [] - Filtering and Searching interface
* [] - Orders CRUD
* [] - Reviews CRUD
* [] - Users CRUD
* [] - Ticket Types CRUD
* [] - Tickets CRUD
* [] - Check-Ins CRUD
* [] - Ticket Templates CRUD
* [] - Unit testing
* [] - Validation for POST endpoints
* [] - Users - "Create new organizer" endpoint
* [] - API Documentation
* [] - Seeders for development (admin, organizer, customer accounts + events, etc)

## Database Structure

**Tables**:

* Events
* Event Meta
* Orders
* Order Items
* Check-ins (table used to track ticket use at events)
* Packages (Pricing tables / privileges for users -- maybe v2)
* Carts
* Users
* Reviews
* Ticket Types (General Admission vs VIP)
* Discount Codes
* Ticket Templates
* Categories
* Categories Relationships
* Newsletters
* Newsletter Subscribers (pivot table of users that connects to newsletter)

### Events

* event_id
* title
* slug
* description (LONGTEXT)
* video_embed (TEXT - youtube/vimeo)
* start_date (DATETIME)
* end_date (DATETIME)
* latitude
* longitude
* street_address
* city
* state
* postal_code
* country
* website
* email
* organizer_id
* view_count
* rating
* event_logo
* featured_img
* terms (LONGTEXT - terms and conditions)
* created_date
* updated_date

### Event Meta

* event_meta_id
* event_id
* meta_type
* meta_value

### Check-ins

When you check in, a ticket is scanned for a QR code that represents the unique ticket UUID. The API is queried for this UUID on a special authenticated endpoint and it creates a new Check In entry, as well as updating the ticket to be used.

* checkin_id
* status (default = not checked in vs checked in vs refund or something)
* event_id (relationship)
* ticket_id (relationship)
* created_date
* updated_date

### Ticket Templates

* template_id
* event_id
* name
* ticket_size (A4, A5, etc)
* orientation (portrait, landscape)
* ticket_background
* font
* ticket_content (content block values stored with JSON)
* * Event Logo
* * Ticket Type
* * Event Name
* * Event Date & Time
* * Event Location
* * Ticket Owner Name
* * Ticket Description
* * QR Code
* * Terms & Conditions
* * Custom image / Logo
* * Google Map
* * Sponsor Logos
* * Ticket Buyer Name
* * Ticket Code
* * Ticket ID



### Users

* type (defaults to reviewer vs business)

### User Meta

* instagram
* twitter
* facebook
* tumblr
* linkedin

### Orders

* order_id
* status
* order_date
* customer_id
* payment_gateway
* discount
* order_total

### Order Items

* item_id
* ticket_type (pivot to Ticket Types)
* price (pricer per ticket -- doubles down in database on price instead of relationship to ticket types just in case business changes prices after purchase)
* quantity

### Tickets

Individual tickets need to be created so we can scan unique ticket IDs, since Order Items can have multiple tickets per entry. 

* ticket_id
* status (boolean -- has ticket been used? default false)
* ticket_type (pivot) - from here you get ticket_template pivot
* event_id (pivot)
* order_item (pivot) - from here you get order_id, user pivot, etc

### Ticket Types

* ticket_type_id
* event_id
* title (free ticket, etc)
* description
* price
* max_each (max to sell per customer)
* max_quantity (max to sell)


### Reviews

* review_id
* status (visible or not)
* user_id
* rating
* review

## Development

I use Laradock for easily spinning up a Laravel-compatible Docker container with all the services I need (Redis, Memcached, etc). Make sure you run all Docker commands from the `laradock` subdirectory, and not the project root.

### Spin up the Docker container:

`cd laradock`
`docker-compose up -d nginx mysql phpmyadmin redis workspace `

### Run a command inside the container:

`docker-compose exec workspace php artisan migrate`

### Spin up the server:

You can spin up a server that doesn't have a mySQL DB using the PHP CLI. Just swap the SQL settings in the ENV file. 

Run this from the project root:

`php artisan serve`

### Generating JWT tokens for testing

https://stackoverflow.com/questions/41376928/laravel-5-3-passport-jwt-authentication
http://pix.toile-libre.org/upload/original/1483094937.png

1. Send POST request to `http://localhost/api/token` with email and password as form data.
2. An object is returned from the request with an `accessToken` and `token` property. The `accessToken` is the JWT token you can use for authorization headers.

### Admin Accounts

Create a new user (SQL or using website registration) and then edit the type column in the Users table (change from 'customer' to 'admin'). If you generate a JWT token for this user, you can make higher level requests to API (UPDATE, DELETE, etc)

> Similar process for creating organizers for the time being

## Creating tokens

### Client app

Create a "test app" or client using the following command ([see Laravel docs](https://laravel.com/docs/5.6/passport#issuing-access-tokens)):

`php artisan passport:client`

### Personal access token

You can create your own access token using:

`php artisan passport:client --personal`

> Use the `createToken()` method on the User model to generate one programatically. See the `token()` method in the `/app/Http/Controllers/Api/UsersController.php` class.