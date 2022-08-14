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
From where should we get your app's codebase?
    Choose : current working directory
What recipe do you want to use?
    Choose : drupal9
Where is your webroot relative to the init destination?
    Type: web
What do you want to call this app?
    Type any name you like

Now run below command:

```bash
lando start
```

You can use any of the links provided now and continue with drupal installation.
You don't need any specific database.

After Drupal successfully installs you can login into the CMS and enable "Accenture Song"
module.

You need to create a content type called Product and the machine name should be 'product'
with below fields and field types:
    field_description => Text (formatted, long)
    field_price => Number (float)
    field_sku => Text (plain)
You can delete the body field. We don't need it. We need the Title field.

In permissions, allow 'Anonymous user' and 'Authenticated user' to below access to Product
content type:
    Product: Create new content
    Product: Delete any content
    Product: Delete revisions
    Product: Edit any content

You now have access to the module functionality.
You can redirect to '/admin/content/all-products' to explore it
