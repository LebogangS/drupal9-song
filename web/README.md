# Accenture Song

This is an accenture song codebase

## Setting up the environment

After cloning this codebase you may need to make changes in .lando.yml
file where you may have to make connections to your database.

After cloning it go to the main folder "drupal9-song" and run below command
to install dependencies:

```bash
composer install
```

After dependencies have successfully installed, configure and run lando
by following below instructions:

```bash
lando init
```

```python
# From where should we get your app's codebase?
Choose : current working directory
# What recipe do you want to use?
Choose : drupal9
# Where is your webroot relative to the init destination?
Type: web
# What do you want to call this app?
Type any name you like
```

Now run below command:

```bash
lando start
```

You can use any of the links provided to load the site in browser.

## There are 2 options to setup the database

## Option 1

Now run below command to install database from this repository:

```bash
lando db-import accenturesong.sql.gz
```
Refresh your browser to have the new database loaded.

You can use below user details for admin access to the CMS:
Username: lebogang.selema@accenture.com
Password: Accenture123!

## Option 2

Continue with manual drupal installation. (You can accept default values and fill in vlaues
on last step on installation)

After Drupal successfully installs you need to login into the CMS and enable "Accenture Song"
module.

In permissions, allow 'Anonymous user' and 'Authenticated user' to below access to Product
content type:
```python
Product: Create new content
Product: Delete any content
Product: Delete revisions
Product: Edit any content
```

Navigate to '/admin/config/services/jsonapi' and check 'Accept all JSON:API create, read, update, 
and delete operations.' then save

## Populating the database

You can redirect to '/admin/content/all-products' to explore start using this module. (This can also 
be done by clicking on 'Configuration' link in the menu links then 'Accenture Song Products' link 
on the config page)

On this product page, you will see a page that looks like 'sample.png' image in this repository.
If you have used clean installation you will not see any product on this page.

You can add a new product by clicking on 'Add Product' button on this products page. (Which will take you
to '/admin/config/accenture_song/create-product'). Fill in the fields then click on 'Create Product' to 
create the product. You will be redirected to Products page with latest content.

Update any product by clicking on 'View' button associated with it. (This will take you to 
'/admin/config/accenture_song/update-product/{{uuid}}'). Update any field you need to update then click on 
'Update Product' to update the product. You will be redirected to Products page with latest content.

To delete any product, click on 'Delete' button associated with the product.
