## Supported Fields
- Text
- True False

## Usage
This small introduction will get you up and running with the ACF Builder

### Creating A Field
To create a field first pick a field type you want to create for example a text field. Start by first calling the correct class like so

```php
$myField = new TextField('My Field Name');
```

This will create a field object with the bare minimum set. To customize the field you can use all the different setters this objects provides you with. **ADD LINK TO PHP CODE DOC CLASS FIELD SETTERS**

### Creating A Field Group
To create a field group you can use the following class

```php
$myFieldGroup = new FieldGroup('My Field Group name');
```

### Adding A Field To Your Field Group
Adding a field to your field group is easing and only involves one function.

```php
$myFieldGroup->addField($myField);
```

### Creating A Group Location
When your are creating a field group you want to add a location so that it doesn't show up everywhere. This can be done with the following code

```php
$location = new GroupLocation();

$location->add('post_type', '==', 'post');

$myFieldGroup->addLocation($location);
```
#### AND Statement
Simple Right? let's say you want to do an AND statement this can be done with the following code

```php
$location = new GroupLocation();

$location->add('post_type', '==', 'post');

$location->add('post_type', '==', 'my_post_type');

$myFieldGroup->addLocation($location);
```

#### OR Statement
Does it support OR locations. Yes it supports this to adding an OR location can be done with the following code

```php
$location = new GroupLocation();

$location->add('post_type', '==', 'post');

$myFieldGroup->addLocation($location);

$otherLocation = new GroupLocation();

$location->add('post_type', '==', 'my_post_type');

$myFieldGroup->addLocation($otherLocation);
```