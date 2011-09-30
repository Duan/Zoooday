/* $Id: README.txt,v 1.3.2.2 2010/09/26 05:38:29 aland Exp $ */

-- SUMMARY --

Name is a module that provides a formatting function for names, a CCK name field
with integrated Token support and a FAPI name element.


-- REQUIREMENTS --

* None

-- RECOMMENDATIONS --

* CCK to provide the Name field element
* Token to provide additional tokens

-- INSTALLATION --

* Standard installation, see http://drupal.org/node/70151 for further
information.

-- UPGRADING --

As of version , the module has been refactored. It is vital that
you run update.php and check any custom code based on this module.

Of significance is the refactoring of name_construct_components()
into a token based formatting parser similar to the PHP date()
function. This function has been removed.

Also, user defined formats have replaced the old fixed formats.
The old fixed formats have been converted into standard formats
that can be changed or deleted from the database.

Existing fields should continue to function as per normal.

-- CONFIGURATION --

The upgrade or default install provides a simple set of configured name format
string and seperators. These are optional and can be change.

* Global
  1) Default format
     This is a fallback format when a custom format has been deleted.
  2) Seperators
     These are used to define the i, j, k characters in the format string.

* Formats
  You can define any format string that you want. Each of these are included
  in the list of display options for each CCK name field.
  
-- FEATURES --

-- Field

There is a single new CCK name called Name. This contains a configurable
selection of the following name parts:

1) Title (a select field)
2) Given name
3) Middle name(s)
4) Family name
5) Generational suffix (a select field)
6) Credentials

At least the given or family name must be selected when defining the field. You
can use any user defined format to display the name components.

-- The name_format() function

This function provides the core display functionality in the module. It accepts
an array of name components, a format string and additional settings array.

This is for future use, and contains the object and token key from the scope
that the name_format() function was called. This is intended to provide
additional token support internally inside the format string.

This format string is similar to the PHP date() functions' format string.

* t Replaced with the names title component.
* g Replaced with the names given component.
* m Replaced with the names middle component.
* f Replaced with the names family component.
* c Replaced with the names credentials component.
* s Replaced with the names generational suffix component.
* x Replaced with the first letter of the names given component.
* y Replaced with the first letter of the names middle component.
* z Replaced with the first letter of the names family component.
* e Replaced with either the names given or family component.
    Given component has preference.
* E Replaced with either the names given or family component.
    Family component has preference.

There are three configurable global seperator settings. These can be used via:

* i Replaced with the first global seperator.
* j Replaced with the first global seperator.
* k Replaced with the first global seperator.

Un-recognized characters are inserted directly into the formatted name string.
It is recommended that you escape these in case the character is used in future
versions of the module.

The numbers 0-9 are reserved for future use.

You can prevent a recognized character in the format string from being expanded
by escaping it with a preceding backslash (\).

Additionally to these simple tokens, the format parameter string is parsed for
three additional character sets:

Modifier characters

These apply simple string manulipulation functions to the following replaced
token, character or group.

These include:

* L Converts the next token to all lowercase.
* U Converts the next token to all uppercase.
* F Converts the first letter to uppercase.
* T Trims whitespace around the next token.
* S Ensures that the next token is safe for the display.

Conditional characters

These allow simple look ahead and look behind functions to conditionally insert
a token, character or group.

 * = Insert the token, character or group, if and only if the next token,
     character or group after it is not empty.
     
     For example, inserting a seperator between the given and family name.
     
     Inserts a single whitespace.
     
     "g f" will always insert a single space between the components.
     "gif" will always insert the global defined seperator between the components.
     
     Conditionally inserts the globally defined seperator.
     
     "g= f" will conditionally insert a single space between the components.
     "g=if" will conditionally insert the global defined between the components.
     
 * = Skip the token, character or group, if and only if the next token,
     character or group after it is not empty.
     
 * | Uses the previous token, character or group unless empty, otherwise it uses
     this token, character or group.
     
     The two special characters for given or family can easily be defined with
     the following equivalent format strings
     
     "g|f" is equal to "e"
     "f|g" is equal to "E"
     
Grouping characters

Normally, the conditional or modifier characters are applied to the first 
character or character replacment that follows them. Grouping a set of 
characters with brackets makes the system to apply these modifiers or conditions
to the entire group.

For example:

"Ug Uf Uc" could be replaced with "U(g f c)".

Adding a conditional statement to the format string for the space would be
represented as "U(g=if=ic)".
     
Multiple values are supported via the core fields engine.

-- USAGE --

Simply create a Name field and follow the instructions. 

Of note is that you can tie the generational and title into a vocabulary, to
enable sharing of the same options in all name fields.

There are five built-in formatters to control the output.

Full – the complete name using all parts.
Given Family – the given and family names.

Given – the given name, but has a fallback to the surname if empty
Family – the family name, but has a fallback to the given name if empty
Formal – the title and family name components. If the family name is empty, the
given name is used.

You should be able to use the Custom Formatter module to define up more
combinations, but I have not personally tried this.

Note: The format of these two change with the users’ language. In Chinese, the
family name comes before the given and / or middle names. Please let me know if
other locales require this reversed ordering.

-- RELATED MODULES --

* Fullname field for CCK
  A similar module for Drupal 5 CCK, but with support for two concurrent name
  field sets for each entry. A legal and preferred set of:
  
  prefix, firstname, middlename, lastname, and suffix
   
  http://drupal.org/project/cck_fullname
  
* Namefield
  An "experiment" Drupal 5 development module.

  http://drupal.org/project/namefield

-- REFERENCES --

Drupal 6

For details about CCK:
  http://drupal.org/handbook/modules/cck

Drupal 7

For details about Fields API:
  http://drupal.org/node/443536
For details about Drupal 7 FAPI:
  http://api.drupal.org/api/drupal/developer--topics--forms_api.html/7
  http://api.drupal.org/api/drupal/developer--topics--forms_api_reference.html/7
  
-- CONTACT --

Current maintainers:

* Alan D. - http://drupal.org/user/54136

If you want to help or be involved please contact me.

If you find any issues please lodge an issue after checking that the issue
is not a duplicate of an existing issue.
