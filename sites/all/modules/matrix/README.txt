*************
** README: **
*************

DESCRIPTION:
-----------
This module provides a field type for cck with table view of textfields. 


REQUIREMENTS:
-------------
The matrix.module requires the content.module to be installed.


INSTALLATION:
-------------

1. Place the entire matrix directory into your Drupal modules/
   directory.


2. Enable the matrix module by navigating to:

     administer > modules

   Enabling the matrix module will create the necessary database 
   tables for you.


USING THE MATRIX MODULE:
------------------------
After enableing the module, you can create a new field. Choose the Matrix field, at the moment only
textfield widgets are available. On the configuration page, there will appear two large fieldsets, one
for setting the columns and one for the rows. Fill in your wanted labels for rows/columns, empty fields
won't appear in the node-form.


TODO:
-----
 * Allow users/administrators to add cols and rows dynamically
 * Adding other widgets
 

Author:
-------
Original Author:
Matthias Hutterer
mh86@drupal.org
m_hutterer@hotmail.com

Current Maintainer:
Aaron Fulton
aaron@webtolife.org