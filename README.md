# The Project
This project (Stock-Control-WordPress) is part of a selection process for [__Altran Brazil__](https://www.altran.com.br/).

The process consists in develop a simple stock-control system with 3 Custom Posts Types:

|    Product   |     |     Order    |     |    Client    |
| ------------ | --- | ------------ | --- | ------------ |
|  ID          |     |  ID          |     |     ID       |
|  Description |     |  Product ID  |     |     Name     |
|  Price       |     |  Client ID   |     |     E-Mail   |
|              |     |              |     |     Phone    |

## Objective
- Create the Custom Post Types for each entity
- Create the Custom Fields (Meta) for each Custom Post Type

## Usage
This project it's all ready for use, but some things have to be checked first.
### DataBase
This project was be developed using MySQL, so you'll can import the [sql file](https://github.com/LeonardoLpds/stock-control-wordpress/blob/master/stock-control.sql) in my repository to your database (you'll need create a database called stock-control-wordpress).

##### Database and host configuration
after import my sql file, you have to change (if needed) the wp_option table. At that table you'll find the option `siteurl` and `home`, just change the value of those options as needed.

### Installing
After you did the configurations above, you are able to proceed the WordPress default installation.

## The Plugin
In this project I created a plugin for wordpress, if you going to plugins page you'll see a plugin called `Stock Control`

![alt text](http://ap.imagensbrasil.org/images/plugins-page.png "Plugins Page")

that plugin is responsible by create the Custom Post Types and those Custom Fields.

### Code
Basically all code was created at [stock-control plugin folder](http://github.com/LeonardoLpds/stock-control-wordpress/tree/master/wp-content/plugins/stock-control), all other things here is just a simple WordPress site

#### In Other Projects
If you want to add this plugin in your WordPress website, just copy the plugin folder to your site and active the plugin. After that, the Custom Post Types and Custom Fields will be shown on your admin page.

### Template
The template I used was created by [Lacy Morrow](https://github.com/lacymorrow) and was able to download at [WordPress.org](https://wordpress.org/themes/casper/)

#### Template Configuration
For show the custom fields at a detail page (single post page) you'll need call the function get_post_custom() or get_post_meta() passing the post id and the custom field name, and print the return in content-single.php of your template. You can see this [here](https://github.com/LeonardoLpds/stock-control-wordpress/blob/master/wp-content/themes/casper/content-single.php)
